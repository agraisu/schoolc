<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function list()
    {
        $data['getRecord'] = User::getAdmin();
        $data['header_title'] = "Admin List";
        return view('admin.admin.list', $data);
    }

    public function add()
    {
        $data['header_title'] = "Add New Admin";
        return view('admin.admin.add', $data);
    }

    public function insert(Request $request)
    {
        request()->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'nullable|string|min:6', // Assuming password is optional and minimum length is 6
            // 'name' => 'required|string',
            // 'email' => [
            //     'required',
            //     'email',
            //     Rule::unique('users')->ignore($user->id),
            // ],

        ]);

        $user = new User;
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        $user->password = Hash::make($request->password);
        $user->user_type = 1;
        $user->save();

        return redirect('admin/admin/list')->with('success', "Admin Successfully created");
    }

    public function edit($id)
    {
        $data['getRecord'] = User::getSingle($id);
        if (!empty($data['getRecord']))
        {
            $data['header_title'] = "Edit Admin";
            return view('admin.admin.edit', $data);
        }
        else
        {
            abort(404);
        }
    }

    public function update($id, Request $request){
        request()->validate([
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'nullable|string|min:6',
        ]);

        //validate user details
        //ensures email is unique among the users, ignoring current user with the ID $user->id
        // $request->validate([
        //     'name' => 'required|string',
        //     'email' => [
        //         'required',
        //         'email',
        //         Rule::unique('users')->ignore($user->id),
        //     ],
        //     'password' => 'nullable|string|min:6', // Assuming password is optional and minimum length is 6
        // ]);
        //update user details
        $user = User::getSingle($id);
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        if (!empty($request->password))
        {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect('admin/admin/list')->with('success', "Admin Successfully Updated");
    }

    public function delete($id)
    {
        $user = User::getSingle($id);
        if ($user->id === Auth::id()) {
            return redirect()->back()->withError('You cannot delete your own account');
        }
        $user->is_delete = 1;
        $data['getRecord'] = User::getSingle($id);
        $user->save();
        return redirect('admin/admin/list')->with('success', "Admin Successfully Deleted");
    }
}
