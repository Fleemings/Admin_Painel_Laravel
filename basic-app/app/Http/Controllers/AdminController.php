<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => ' User Logout Successfully',
            'alert-type' => 'success'
        );

        return redirect('/login')->with($notification);
    } // End METHOD

    public function Profile()
    {
        $id = Auth::id();
        $adminData = User::findOrFail($id);

        return view('/admin.adminProfile', compact('adminData'));
    } // End METHOD

    public function EditProfile()
    {
        $id = Auth::id();
        $editData = User::find($id);
        return view('/admin.adminProfileEdit', compact('editData'));
    }

    public function StoreProfile(Request $request)
    {
        $id = Auth::id();
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->username = $request->username;

        if ($request->file('profileImage')) {
            $file = $request->file('profileImage');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/adminImage'), $filename);
            $data['profileImage'] = $filename;
        }
        $data->save();
        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.profile')->with($notification);
    }

    public function ChangePassword()
    {
        return view('/admin.adminChangePassword');
    }

    public function UpdatePassword(Request $request)
    {   // rules of the password fild
        $validadeData = $request->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required',
            'confimpassword' => 'required|same:newpassword'
        ]);
        // password inside of database
        $hashesPassword = Auth::user()->password;
        // check if old password matches if the one inside of database
        if (Hash::check($request->oldpassword, $hashesPassword)) {
            // find the id
            $users = User::find(Auth::id());
            // insert the new incripted password in the database
            $users->password = bcrypt($request->newpassword);
            $users->save();
            session()->flash('message', 'Password Updated Successfully');
            return redirect()->back();
        } else {
            session()->flash('message', 'Old passaword does not match');
            return redirect()->back();
        }
    }
}
