<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }


    /**
     * @return \Illuminate\Contracts\Foundation\Application|
     * \Illuminate\Contracts\View\Factory|
     * \Illuminate\Contracts\View\View
     */
    public function profile()
    {
        $id = Auth::user()->id;

        $adminUser = User::findOrFail($id);

        return view('admin.admin_profile_view', compact('adminUser'));
    }
}
