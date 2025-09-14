<?php

namespace App\Http\Controllers\Backend;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\AdminInfoRequest;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class BackendController extends Controller
{
    public function login(){

        return view('backend.login');
    }
    public function forgot_password(){

        return view('backend.forgot-password');
    }
    public function index(){

        return view('backend.index');
    }

    public function account_settings() {
        return view('backend.account_settings');
    }



    public function update_account_settings(AdminInfoRequest $request)
    {
            /** @var User $user */
            $user = auth()->user();

            $data = $request->validated();

            if (! empty($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            } else {
                unset($data['password']);
            }

            $user->update($data);

            return redirect()
                ->route('admin.account_settings')
                ->with([
                    'message'    => 'Account updated successfully',
                    'alert-type' => 'success'
                ]);

    }



    public function remove_image(Request $request)
    {
        $user = User::findOrFail(auth()->id());

        if ($user->user_image) {
            $file = public_path("assets/users/{$user->user_image}");
            if (File::exists($file)) {
                unlink($file);
            }
            $user->user_image = null;
            $user->save();
        }

        return response()->json(['success' => true]);
    }



}