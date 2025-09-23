<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\OldCategory;
use App\Models\Category;

class TransferSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('Starting data transfer from oldcategories to categories...');

        $oldImagesPath = public_path('old_uploads/categories/');
        $newImagesPath = public_path('assets/categories/');
        $testMode = false;
        $limit = 50;
        $chunkSize = 200;
        // ==================================

        $this->command->warn('About to TRUNCATE categories table. This will remove existing categories.');
        if (! $this->confirmProceed()) {
            $this->command->info('Aborted by user.');
            return;
        }

        Schema::disableForeignKeyConstraints();
        Category::truncate();
        Schema::enableForeignKeyConstraints();

        if (! File::exists($newImagesPath)) {
            File::makeDirectory($newImagesPath, 0755, true);
        }

        $baseQuery = OldCategory::query()->orderBy('cid');

        if ($testMode) {
            $this->command->warn("RUNNING IN TEST MODE. Only {$limit} records will be processed.");
            $oldTotal = $baseQuery->limit($limit)->count();
        } else {
            $oldTotal = $baseQuery->count();
        }

        if ($oldTotal === 0) {
            $this->command->warn('The oldcategories table is empty. No data to transfer.');
            return;
        }

        $this->command->info("Total categories to process: {$oldTotal}");
        $progressBar = $this->command->getOutput()->createProgressBar($oldTotal);
        $progressBar->start();

        DB::beginTransaction();
        try {
            if ($testMode) {
                $rows = $baseQuery->limit($limit)->get();
                foreach ($rows as $oldCat) {
                    $this->processAndInsertCategory($oldCat, $oldImagesPath, $newImagesPath);
                    $progressBar->advance(1);
                }
            } else {
                $baseQuery->chunkById($chunkSize, function ($oldCategories) use (&$progressBar, $oldImagesPath, $newImagesPath) {
                    $batch = [];
                    foreach ($oldCategories as $oldCat) {
                        $row = $this->prepareCategoryRow($oldCat, $oldImagesPath, $newImagesPath);
                        $batch[] = $row;
                        $progressBar->advance(1);
                    }
                    if (!empty($batch)) {
                        Category::insert($batch);
                    }
                }, 'cid');
            }

            $progressBar->finish();
            DB::commit();

            $maxId = Category::max('id');
            $next = $maxId ? ($maxId + 1) : 1;
            $tableName = (new Category())->getTable();
            DB::statement("ALTER TABLE `{$tableName}` AUTO_INCREMENT = {$next}");

            $this->command->info("\nData transfer completed successfully!");
        } catch (\Exception $e) {
            DB::rollBack();
            $this->command->error("\nMigration failed: " . $e->getMessage());
        }
    }

    protected function prepareCategoryRow($oldCat, $oldImagesPath, $newImagesPath)
    {
        $id = $oldCat->cid;
        $title = $oldCat->title ?? null;
        $description = $oldCat->content ?? null;
        $slugSource = $oldCat->guide ?? $title ?? 'category-' . uniqid();
        $slug = Str::slug($slugSource);

        $imgName = null;
        if (!empty($oldCat->img)) {
            $oldImageFile = $oldImagesPath . $oldCat->img;
            if (File::exists($oldImageFile)) {
                $ext = pathinfo($oldCat->img, PATHINFO_EXTENSION) ?: 'jpg';
                $imgName = 'cat_' . $id . '_' . time() . '.' . $ext;
                $newImageFile = $newImagesPath . $imgName;
                File::copy($oldImageFile, $newImageFile);
            }
        }

        $publishedOn = $oldCat->published_at ?? null;
        $createdAt = $oldCat->created_at ?? now();
        $updatedAt = $oldCat->modified_at ?? now();

        return [
            'id'               => $id,
            'title'            => $title,
            'description'      => $description,
            'slug'             => $slug,
            'img'              => $imgName, // null إذا لم تُنسخ صورة
            'meta_keywords'    => $oldCat->meta_keywords ?? null,
            'meta_description' => $oldCat->meta_description ?? null,
            'meta_slug'        => !empty($oldCat->guide) ? Str::slug($oldCat->guide) : null,
            'published_on'     => $publishedOn ? Carbon::parse($publishedOn) : null,
            'created_by'       => $oldCat->created_by ?? null,
            'updated_by'       => $oldCat->modified_by ?? ($oldCat->modified_at ?? null),
            'views'            => (int) ($oldCat->views ?? 0),
            'status'           => (int) ($oldCat->status ?? 0),
            'section'          => (int) ($oldCat->sections ?? 0),
            'featured'         => 0,
            'created_at'       => $createdAt ? Carbon::parse($createdAt) : now(),
            'updated_at'       => $updatedAt ? Carbon::parse($updatedAt) : now(),
        ];
    }

    protected function processAndInsertCategory($oldCat, $oldImagesPath, $newImagesPath)
    {
        $row = $this->prepareCategoryRow($oldCat, $oldImagesPath, $newImagesPath);

        Category::create($row);
    }

    protected function confirmProceed()
    {
        if (app()->runningInConsole() && !app()->runningUnitTests()) {
            return $this->command->confirm('Do you want to continue? This will delete current categories and import from old table. [y/N]', false);
        }
        return true;
    }
}