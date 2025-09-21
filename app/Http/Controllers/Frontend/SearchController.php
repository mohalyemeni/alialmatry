<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'q' => ['required','string','min:1']
        ]);

        $term = trim(strip_tags($request->get('q')));
        $sources = config('search.sources', []);
        $results = [];

        foreach ($sources as $key => $cfg) {
            $modelClass = $cfg['model'] ?? null;
            $fields = $cfg['fields'] ?? [];
            $perPage = $cfg['per_page'] ?? 6;

            if (!$modelClass || !class_exists($modelClass) || empty($fields)) {
                continue;
            }

            try {
                $query = $modelClass::query();

                // بناء شروط where ديناميكياً على الحقول المحددة
                $query->where(function ($w) use ($fields, $term) {
                    foreach ($fields as $i => $field) {
                        if ($i === 0) {
                            $w->where($field, 'LIKE', "%{$term}%");
                        } else {
                            $w->orWhere($field, 'LIKE', "%{$term}%");
                        }
                    }
                });

                // لو الموديل يملك scopePublished (scopePublished) نستدعيه
                if (method_exists($modelClass, 'scopePublished')) {
                    $query = $query->published();
                }

                // ترتيب افتراضي
                if (schemaHasColumn($modelClass, 'created_at')) {
                    $query = $query->orderBy('created_at', 'desc');
                }

                // اختيار أعمدة للعرض (لا نسترجع الحقول الثقيلة دوماً)
                $select = array_unique(array_merge(['id'], array_slice($fields, 0, 1)));
                $items = $query->select($select)->paginate($perPage, ['*'], $key . '_page');

                $results[$key] = [
                    'items' => $items,
                    'config' => $cfg,
                ];
            } catch (\Throwable $e) {
                \Log::error("Search error for source {$key}: " . $e->getMessage());
                // تجاهل هذا المصدر لو فشل
            }
        }

        return view('frontend.search-results', [
            'q' => $term,
            'results' => $results,
        ]);
    }
}

/**
 * Helper بسيط: يحاول التحقق إن كان العمود موجود في جدول الموديل.
 * ملاحظة: يستخدم DB facade لذا يتطلب DB connection سليمة.
 */
if (!function_exists('schemaHasColumn')) {
    function schemaHasColumn($modelClass, $column)
    {
        try {
            $instance = new $modelClass;
            $table = $instance->getTable();
            return \Schema::hasColumn($table, $column);
        } catch (\Throwable $e) {
            return false;
        }
    }
}