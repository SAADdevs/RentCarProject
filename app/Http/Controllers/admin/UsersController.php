<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function userIndex()
    {
        $users = User::where('role', '!=', 'admin')->get();
        return view('admin.users.allUsers', ['users' => $users]);
    }

    public function edit($id)
    {
        $users = User::findOrFail($id);
        return view('admin.users.editUser', ['user'=>$users]);
    }
    public function updateUser(Request $request, $id)
{
    $user = User::find($id);
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'phone_number' => 'required|string|max:20',
        'city' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        'role' => 'required|in:owner,customer,admin',
    ]);
// dd($validatedData);
    $user->update($validatedData);

    return redirect()->route('users')->with('success', 'User updated successfully.');
}


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        //dd($user)
        $user->delete();
        return redirect()->route('users')->with('success', 'User deleted successfully.');
    }
}
