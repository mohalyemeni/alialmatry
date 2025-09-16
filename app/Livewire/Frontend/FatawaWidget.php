<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Category;
use App\Models\Fatwa;
use Illuminate\Support\Facades\Schema;

class FatawaWidget extends Component
{
    public $categories;
    public $selectedCategorySlug = null;
    public $selectedCategoryId = null;
    public $fatawas;

    public $debug = true;
    protected $debugMessages = [];

    public function mount($initialCategorySlug = null)
    {
        $this->debugMessage("mount() start");

        try {

            $this->categories = Category::fatwas()
                ->active()
                ->orderByDesc('id')
                ->get();

            $this->debugMessage("Categories loaded, count: " . $this->categories->count());

        } catch (\Throwable $e) {
            $this->categories = collect();
            $this->debugMessage("Exception loading categories: " . $e->getMessage());
        }


        if ($initialCategorySlug) {
            $this->selectCategory($initialCategorySlug);
        } else {
            $this->loadFatawas();
        }
    }


    public function selectCategory($slug = null)
    {
        $this->debugMessage("selectCategory() called with slug: " . var_export($slug, true));

        $this->selectedCategorySlug = $slug;

        if ($slug) {
            $category = $this->categories->firstWhere('slug', $slug);

            if ($category) {
                $this->selectedCategoryId = $category->id;
                $this->debugMessage("Resolved selectedCategoryId: " . $this->selectedCategoryId);
            } else {
                $this->selectedCategoryId = null;
                $this->debugMessage("Category not found for slug: " . $slug);
            }
        } else {
            $this->selectedCategoryId = null;
            $this->debugMessage("Selected category cleared (null)");
        }

        $this->loadFatawas();
    }


    public function selectCategoryById($id = null)
    {
        $this->debugMessage("selectCategoryById() called with id: " . var_export($id, true));

        if ($id === null) {
            $this->selectedCategoryId = null;
            $this->selectedCategorySlug = null;
        } else {
            $category = $this->categories->firstWhere('id', $id);
            if ($category) {
                $this->selectedCategoryId = $category->id;
                $this->selectedCategorySlug = $category->slug;
                $this->debugMessage("Resolved selectedCategorySlug: " . $this->selectedCategorySlug);
            } else {
                $this->selectedCategoryId = null;
                $this->selectedCategorySlug = null;
                $this->debugMessage("Category not found for id: " . $id);
            }
        }

        $this->loadFatawas();
    }


    protected function loadFatawas()
    {
        $this->debugMessage("loadFatawas() start");
        $query = Fatwa::query()->where('status', 1);

        if ($this->selectedCategoryId) {
            $this->debugMessage("Filtering by category_id = {$this->selectedCategoryId}");
            $query->where('category_id', $this->selectedCategoryId);
        }

        try {
            if (Schema::hasColumn((new Fatwa)->getTable(), 'published_on')) {
                $this->fatawas = $query->orderByDesc('published_on')->get();
            } else {
                $this->fatawas = $query->orderByDesc('id')->get();
            }

            $this->debugMessage("Loaded fatawas count: " . $this->fatawas->count());

        } catch (\Throwable $e) {
            $this->fatawas = collect();
            $this->debugMessage("Exception loading fatawas: " . $e->getMessage());
        }

        $this->dispatch('fatawasLoaded');
        $this->emitDebugToBrowser();
    }

    protected function debugMessage($msg)
    {
        if ($this->debug) {
            $this->debugMessages[] = '[' . now()->format('H:i:s') . '] ' . $msg;
        }
    }

    protected function emitDebugToBrowser()
    {
        if ($this->debug) {
            $this->dispatch('fatawa-debug',
                messages: $this->debugMessages,
                selectedSlug: $this->selectedCategorySlug,
                selectedId: $this->selectedCategoryId,
                fatawasCount: $this->fatawas ? $this->fatawas->count() : 0
            );
        }
    }

    public function render()
    {
        return view('livewire.frontend.fatawa-widget');
    }
}