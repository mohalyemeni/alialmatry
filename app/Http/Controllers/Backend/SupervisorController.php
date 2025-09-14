<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\SupervisorRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Models\UserPermissions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class SupervisorController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if (! $user->ability(
            ['admin'],
            ['manage_supervisors', 'show_supervisors'],
            ['validate_all' => false]
        )) {
            abort(403);
        }

        $supervisors = User::whereHas('roles', fn($q) => $q->where('name', 'supervisor'))
            ->when(request('keyword'), fn($q) => $q->search(request('keyword')))
            ->when(request('status'),  fn($q) => $q->whereStatus(request('status')))
            ->orderBy(request('sort_by', 'id'), request('order_by', 'desc'))
            ->paginate(request('limit_by', 10));

        return view('backend.supervisors.index', compact('supervisors'));
    }

    public function create()
    {
        $user = auth()->user();
        if (! $user->ability(
            ['admin'],
            ['create_supervisors'],
            ['validate_all' => false]
        )) {
            abort(403);
        }

        $permissions = Permission::all(['id', 'display_name']);
        return view('backend.supervisors.create', compact('permissions'));
    }

    public function store(SupervisorRequest $request)
    {
         $this->authorizeAction('create_supervisors');


        $input = $request->only([
            'first_name',
            'last_name',
            'username',
            'email',
            'mobile',
            'status',
        ]);
        $input['password'] = bcrypt($request->password);


        if ($uploaded = $request->file('user_image')) {
            $fileName = Str::slug($request->username) . '.' . $uploaded->getClientOriginalExtension();
            $path     = public_path("assets/users/{$fileName}");

            $manager = new ImageManager(new Driver());
            $image   = $manager->read($uploaded->getRealPath());
            $image->resize(300, 300, fn($c) => $c->aspectRatio());
            $image->save($path, 90);

            $input['user_image'] = $fileName;
        }

        $supervisor = User::create($input);
        $supervisor->markEmailAsVerified();
        $supervisor->attachRole(Role::whereName('supervisor')->first());

        if (! empty($request->permissions)) {
            $supervisor->permissions()->sync($request->permissions);
        }

        return redirect()
            ->route('admin.supervisors.index')
            ->with([
                'message'    => 'Created successfully',
                'alert-type' => 'success',
            ]);
    }


    public function show(User $supervisor)
    {
        $this->authorizeAction('display_supervisors');
        return view('backend.supervisors.show', compact('supervisor'));
    }

    public function edit(User $supervisor)
    {
        $this->authorizeAction('update_supervisors');
        $permissions = Permission::all(['id', 'display_name']);
        $supervisorPermissions = UserPermissions::where('user_id', $supervisor->id)->pluck('permission_id')->toArray();
        return view('backend.supervisors.edit', compact(
            'supervisor',
            'permissions',
            'supervisorPermissions'
        ));
    }



    public function update(SupervisorRequest $request, User $supervisor)
    {
         $this->authorizeAction('update_supervisors');

         $input = $request->only([
            'first_name',
            'last_name',
            'username',
            'email',
            'mobile',
            'status',
        ]);

        if ($request->filled('password')) {
            $input['password'] = bcrypt($request->password);
        }

        if ($uploaded = $request->file('user_image')) {
            $old = public_path("assets/users/{$supervisor->user_image}");
            if ($supervisor->user_image && file_exists($old)) {
                unlink($old);
            }

            $fileName = Str::slug($request->username) .'.'. $uploaded->getClientOriginalExtension();
            $savePath = public_path("assets/users/{$fileName}");

             $manager = new ImageManager(new Driver());
            $image   = $manager->read($uploaded->getRealPath());
            $image->resize(300, 300, fn($c) => $c->aspectRatio());
            $image->save($savePath, 90);

            $input['user_image'] = $fileName;
        }

         $supervisor->update($input);


        if (! empty($request->permissions)) {
            $supervisor->permissions()->sync($request->permissions);
        }

        return redirect()
            ->route('admin.supervisors.index')
            ->with([
                'message'    => 'Updated successfully',
                'alert-type' => 'success',
            ]);
    }


    public function destroy(User $supervisor)
    {
        $this->authorizeAction('delete_supervisors');
        if ($supervisor->user_image && File::exists("assets/users/{$supervisor->user_image}")) {
            unlink("assets/users/{$supervisor->user_image}");
        }
        $supervisor->delete();

        return redirect()
            ->route('admin.supervisors.index')
            ->with(['message'=>'Deleted successfully','alert-type'=>'success']);
    }

    public function remove_image(Request $request)
    {
        $this->authorizeAction('update_supervisors');

        $supervisor = User::findOrFail($request->supervisor_id);
        if ($supervisor->user_image) {
            $path = public_path("assets/users/{$supervisor->user_image}");
            unlink($path);
            $supervisor->user_image = null;
            $supervisor->save();
        }
        return response()->json(['success' => true]);
    }

    protected function authorizeAction(string $permission)
    {
        $user = auth()->user();
        if (! $user->ability(['admin'], [$permission], ['validate_all'=>false])) {
            abort(403);
        }
    }
    public function toggleStatus(Request $request)
{
    if (! $request->ajax()) {
        return response()->json(['status' => 'error', 'message' => 'طلب غير صالح.'], 400);
    }

    $request->validate([
        'supervisor_id' => 'required|integer|exists:users,id',
    ]);

    $supervisor = User::findOrFail($request->supervisor_id);
    $supervisor->status = ! $supervisor->status;
    $supervisor->save();

    return response()->json([
        'status'        => 'success',
        'message'       => 'تم تحديث الحالة بنجاح.',
        'new_status'    => (bool) $supervisor->status,
        'supervisor_id' => $supervisor->id,
    ]);
}

}
