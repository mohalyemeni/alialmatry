<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CustomerRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Str;

class CustomerController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if (! $user->ability(
            ['admin'],
            ['manage_customers', 'show_customers'],
            ['validate_all' => false]
        )) {
            abort(403);
        }

        $customers = User::whereHas('roles', function($query) {
            $query->where('name', 'customer');
        })
            ->when(request('keyword'), fn($q) => $q->search(request('keyword')))
            ->when(request('status'),  fn($q) => $q->whereStatus(request('status')))
            ->orderBy(request('sort_by', 'id'), request('order_by', 'desc'))
            ->paginate(request('limit_by', 10));

        return view('backend.customers.index', compact('customers'));
    }

    public function create()
    {
        $user = auth()->user();
        if (! $user->ability(
            ['admin'],
            ['create_customers'],
            ['validate_all' => false]
        )) {
            abort(403);
        }



        return view('backend.customers.create' );
    }

    public function store(CustomerRequest $request)
    {
        $user = auth()->user();
        if (! $user->ability(
            ['admin'],
            ['create_customers'],
            ['validate_all' => false]
        )) {
            abort(403);
        }

        $input = [];
        $input['first_name']        = $request->first_name;
        $input['last_name']         = $request->last_name;
        $input['username']          = $request->username;
        $input['email']             = $request->email;
        $input['mobile']            = $request->mobile;

        $input['password']          = bcrypt($request->password);
        $input['status']            = $request->status;

        if ($uploaded = $request->file('user_image')) {
            $fileName = Str::slug($request->username) . '.' . $uploaded->getClientOriginalExtension();
            $path     = public_path("assets/users/{$fileName}");
            $manager  = new ImageManager(new Driver());
            $image    = $manager->read($uploaded->getRealPath());
            $image->scale(width: 300);
            $image->save($path, quality: 100);
            $input['user_image'] = $fileName;
        }

        $customer = User::create($input);
        $customer->markEmailAsVerified();

        $role = Role::whereName('customer')->first();
        $customer->attachRole($role);

        return redirect()
            ->route('admin.customers.index')
            ->with([
                'message'    => 'Created successfully',
                'alert-type' => 'success'
            ]);
    }


    public function show(User $customer)
    {
        $user = auth()->user();
        if (! $user->ability(
            ['admin'],
            ['display_customers'],
            ['validate_all' => false]
        )) {
            abort(403);
        }

        return view('backend.customers.show', compact('customer'));
    }

    public function edit(User $customer)
    {
        $user = auth()->user();
        if (! $user->ability(
            ['admin'],
            ['update_customers'],
            ['validate_all' => false]
        )) {
            abort(403);
        }

        return view('backend.customers.edit', compact('customer'));
    }

    public function update(CustomerRequest $request, User $customer)
    {
        $user = auth()->user();
        if (! $user->ability(
            ['admin'],
            ['update_customers'],
            ['validate_all' => false]
        )) {
            abort(403);
        }
        $input = [
            'first_name'        => $request->first_name,
            'last_name'         => $request->last_name,
            'username'          => $request->username,
            'email'             => $request->email,
            'mobile'            => $request->mobile,
            'status'            => $request->status,
        ];
        if ($request->filled('password')) {
            $input['password'] = bcrypt($request->password);
        }
        if ($uploaded = $request->file('user_image')) {
            $old = public_path("assets/users/{$customer->user_image}");
            if ($customer->user_image && file_exists($old)) {
                unlink($old);
            }
            $fileName = Str::slug($request->username) . '.' . $uploaded->getClientOriginalExtension();
            $savePath = public_path("assets/users/{$fileName}");

            $manager = new ImageManager(new Driver());
            $manager
                ->read($uploaded->getRealPath())
                ->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save($savePath, 90);

            $input['user_image'] = $fileName;
        }
        $customer->update($input);

        return redirect()
            ->route('admin.customers.index')
            ->with([
                'message'    => 'Updated successfully',
                'alert-type' => 'success'
            ]);
    }

    public function destroy(User $customer)
    {
        $user = auth()->user();
        if (! $user->ability(
            ['admin'],
            ['delete_customers'],
            ['validate_all' => false]
        )) {
            abort(403);
        }

        if (File::exists('assets/users/' . $customer->user_image)) {
            unlink('assets/users/' . $customer->user_image);
        }

        $customer->delete();

        return redirect()
            ->route('admin.customers.index')
            ->with([
                'message'    => 'Deleted successfully',
                'alert-type' => 'success'
            ]);
    }

    public function remove_image(Request $request)
    {
        $user = auth()->user();
        if (! $user->ability(
            ['admin'],
            ['update_customers'],
            ['validate_all' => false]
        )) {
            abort(403);
        }

        $customer = User::findOrFail($request->customer_id);
        if ($customer->user_image) {
            $path = public_path("assets/users/{$customer->user_image}");
            if (File::exists($path)) {
                File::delete($path);
            }
            $customer->user_image = null;
            $customer->save();
        }
        return response()->json(['success' => true]);
    }
        public function get_customers()
    {
        $customers = User::whereHas('roles', function($query){
            $query->where('name', 'customer');
        })
        ->when(\request()->input('query') != '', function ($query){
            $query->search(\request()->input('query'));
        })
        ->get(['id', 'first_name','last_name', 'email'])
        ->toArray();

        return response()->json($customers);
    }

}