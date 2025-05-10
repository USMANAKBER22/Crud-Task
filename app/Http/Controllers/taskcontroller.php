<?php

namespace App\Http\Controllers;

use App\Models\Crud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class taskcontroller extends Controller
{
    public function show(){

        $users = DB::table('crud_operation')->get(); 
    // return view('welcome', ['names' => $users]);

       return view('welcome', compact('users'));
    }

 
public function edit($id) {
   
    $user = DB::table('crud_operation')->where('id', $id)->first();


    return view('edit', compact('user'));
}


public function update(Request $request, $id) {

    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
    ]);

   
    DB::table('crud_operation')->where('id', $id)->update([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
    ]);

    return redirect('/')->with('success', 'User updated successfully!');
}

 public function store(Request $request){
      
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:crud_operation',
        ]);

        $userId = DB::table('crud_operation')->insertGetId([
            'name' => $request->name,
            'email' => $request->email,
        ]);

     
        $user = DB::table('crud_operation')->where('id', $userId)->first();

     
        return response()->json($user);
    }

    
  public function delete($id)
{
   
    $deleted = DB::table('crud_operation')->where('id', $id)->delete();

 
    if ($deleted) {
        return redirect('/')->with('success', 'User deleted successfully');
    } else {
        return redirect('/')->with('error', 'Error deleting user');
    }
}

}




    
