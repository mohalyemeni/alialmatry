<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\UsefulLinkRequest;
use App\Models\UsefulLink;
use Illuminate\Http\Request;
use Carbon\Carbon;

class UsefulLinkController extends Controller
{

    public function index(Request $request)
    {
        if (! auth()->user()->ability('admin', 'manage_useful_links,show_useful_links')) {
            return redirect('admin/index');
        }

        $links = UsefulLink::with('creator')
            ->when($request->keyword, fn($q) => $q->where('title', 'like', '%'.$request->keyword.'%'))
            ->when($request->status !== null, fn($q) => $q->where('status', $request->status))
            ->orderBy($request->sort_by ?? 'created_at', $request->order_by ?? 'desc')
            ->paginate($request->limit_by ?? 10);

        return view('backend.useful_links.index', compact('links'));
    }

    public function create()
    {
        if (! auth()->user()->ability('admin', 'create_useful_link')) {
            return redirect('admin/index');
        }

        return view('backend.useful_links.create');
    }

    public function store(UsefulLinkRequest $request)
    {
        if (! auth()->user()->ability('admin', 'create_useful_link')) {
            return redirect('admin/index');
        }

        $input = $request->validated();
        $input['created_by'] = auth()->id();


        $input['published_on'] = $input['published_on'] ? Carbon::parse($input['published_on'])->format('Y-m-d H:i:s') : null;

        UsefulLink::create($input);

        return redirect()->route('admin.useful_links.index')->with([
            'message' => 'تم إضافة الرابط بنجاح',
            'alert-type' => 'success',
        ]);
    }


    public function edit($id)
    {
        if (! auth()->user()->ability('admin', 'update_useful_link')) {
            return redirect('admin/index');
        }

        $link = UsefulLink::findOrFail($id);

        return view('backend.useful_links.edit', compact('link'));
    }

    public function update(UsefulLinkRequest $request, $id)
    {
        if (! auth()->user()->ability('admin', 'update_useful_link')) {
            return redirect('admin/index');
        }

        $link = UsefulLink::findOrFail($id);
        $input = $request->validated();

        $input['updated_by'] = auth()->id();
        $input['published_on'] = $input['published_on'] ? Carbon::parse($input['published_on'])->format('Y-m-d H:i:s') : null;

        $link->update($input);

        return redirect()->route('admin.useful_links.index')->with([
            'message' => 'تم تحديث الرابط بنجاح',
            'alert-type' => 'success',
        ]);
    }

    public function destroy($id)
    {
        if (! auth()->user()->ability('admin', 'delete_useful_link')) {
            return redirect('admin/index');
        }

        $link = UsefulLink::findOrFail($id);
        $link->delete();

        return redirect()->route('admin.useful_links.index')->with([
            'message' => 'تم حذف الرابط بنجاح',
            'alert-type' => 'success',
        ]);
    }

    public function toggleStatus(Request $request)
    {
        if ($request->ajax()) {
            $request->validate([
                'useful_link_id' => 'required|integer|exists:useful_links,id',
            ]);

            $link = UsefulLink::findOrFail($request->useful_link_id);
            $link->status = ! $link->status;
            $link->save();

            return response()->json([
                'status' => $link->status,
                'useful_link_id' => $link->id,
            ]);
        }

        return response()->json(['error' => 'Invalid request'], 400);
    }
}
