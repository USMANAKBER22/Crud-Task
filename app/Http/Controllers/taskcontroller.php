<?php

namespace App\Http\Controllers;

use App\Models\Crud;
use Illuminate\Http\Request;

class taskcontroller extends Controller
{
    public function show()
    {
        $users = Crud::all(); 
        return view('welcome', compact('users'));
    }

    public function edit($id)
    {
        $user = Crud::findOrFail($id); 
        return view('edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'  => 'required',
            'email' => 'required|email',
        ]);

        $user = Crud::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect('/')->with('success', 'User updated successfully!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|max:255',
            'email' => 'required|email|max:255|unique:crud_operation,email',
        ]);

        $user = new Crud;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return response()->json($user); 
    }

    public function delete($id)
    {
        $user = Crud::find($id);

        if ($user) {
            $user->delete();
            return redirect('/')->with('success', 'User deleted successfully');
        }

        return redirect('/')->with('error', 'Error deleting user');
    }
}
