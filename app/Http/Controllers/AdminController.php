<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Routing\Redirector
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = [
            'message' => 'You logged out successfully',
            'alert-type' => 'success'
        ];

        return redirect('/login')->with($notification);
    }


    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function profile()
    {
        $id = Auth::id();

        $adminUser = User::findOrFail($id);

        return view('admin.admin_profile_view', compact('adminUser'));
    }


    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function editProfile()
    {
        $id = Auth::id();

        $adminUser = User::findOrFail($id);

        return view('admin.admin_profile_edit', compact('adminUser'));
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeProfile(Request $request)
    {
        $id = Auth::id();

        $adminUser = User::findOrFail($id);

        if (!empty($request->name)) {
            $adminUser->name = $request->name;
        }

        if (!empty($request->email)) {
            $adminUser->email = $request->email;
        }

        if($request->file('profile_image')){
            $file = $request->file('profile_image');

            $filename = date('YmdHi').$file->getClientOriginalName();

            $file->move(public_path('upload/admin_images'), $filename);

            $adminUser->profile_image = $filename;
        }

        if($adminUser->save()){
            $notification = [
                'message' => 'Admin Profile Updated Successfully',
                'alert-type' => 'success'
            ];
        }else{
            $notification = [
                'message' => 'Admin Profile Updated Failed',
                'alert-type' => 'error'
            ];
        }
        return redirect()->route('admin.profile')->with($notification);
    }


    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function changePassword()
    {
        $id = Auth::id();

        $adminUser = User::findOrFail($id);

        return view('admin.admin_change_password', compact('adminUser'));
    }

    public function storePassword(Request $request)
    {
        $id = Auth::id();

        $adminUser = User::findOrFail($id);

        $validateData = $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required|same:new_password'
        ]);

        $hashedPassword = Auth::user()->getAuthPassword();
        if(Hash::check($request->old_password, $hashedPassword)) {
            $adminUser->password = bcrypt($request->new_password);
            $adminUser->save();

            session()->flash('message', 'Password updated successfully');
            return redirect()->back();
        }else{
            $notification = [
                'alert-type' => 'error'
            ];

            session()->flash('message', 'Old password does not match');
            return redirect()->back()->with($notification);
        }
    }
}
