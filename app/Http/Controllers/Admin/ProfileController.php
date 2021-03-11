<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profile = Auth::user();
        return view('admin.profile.change_profile',compact('profile'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function update_avatar(Request $request)
    {
        $profile = User::find(Auth::id());
        $old_avatar = $profile->avatar;

        $this->validate($request, [
            'avatar' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        //storing new avatar image
        if ($request->hasFile('avatar')) {

            $image = $request->file('avatar');
            $image_original_name = $image->getClientOriginalName();
            $image_changed_name = str_replace(' ', '-', $image_original_name);
            $image_original_ext = $image->getClientOriginalExtension();
            $image_destination_name = time() . '_' . $image_changed_name;
            $image_destination_folder = "/uploads/images/user/avatars/";
            $image_destination_path = $image->move(public_path($image_destination_folder), $image_destination_name);
        }

        $profile->avatar = $image_destination_name;
        $profile->save();

        if (!empty($old_avatar)) {
            unlink(public_path("/uploads/images/user/avatars/$old_avatar"));
        }
        return redirect('admin/profile')->with('success', 'Profile image updated successfully!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function password()
    {
        $password = Auth::user();
        return view('admin.profile.change_password', compact('password'));
    }
    public function UserPassword()
    {
        $password = Auth::user();
        return view('change_password', compact('password'));
    }


    public function update_UserPassword(Request $request)
    {

        $password = User::find(Auth::id());

        $this->validate($request, [
            'old_password' => ['required', 'string', 'min:8'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed', 'different:old_password'],
        ]);
        if (Hash::check($request->old_password, $password->password)) {

            $password->password = Hash::make($request->new_password);
            $password->save();

            return back('/invoice')->with('success', 'Password updated successfully!');
        } else {
            return redirect('/invoice')->with('error', 'Old Password does not match!');
        }
    }
    public function update_password(Request $request)
    {

        $password = User::find(Auth::id());

        $this->validate($request, [
            'old_password' => ['required', 'string', 'min:8'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed', 'different:old_password'],
        ]);
        if (Hash::check($request->old_password, $password->password)) {

            $password->password = Hash::make($request->new_password);
            $password->save();

            return back('admin/password')->with('success', 'Password updated successfully!');
        } else {
            return redirect('admin/password')->with('error', 'Old Password does not match!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $profile = User::find(Auth::id());

        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['nullable', 'string', 'max:255', 'unique:users,username,' . $profile->id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $profile->id],
        ]);

        $profile->name = $request->name;
        $profile->email = $request->email;
        $profile->save();

        return redirect('admin/profile')->with('success', 'Profile updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
