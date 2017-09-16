<?php

namespace App\Http\Controllers;


use App\User;


use Auth;
use Illuminate\Http\Request;


class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }





    // List all users
    public function index(Optimus $optimus)
    {
        $users = User::paginate(10);
        return view('pages.user', compact('optimus', 'users'));
    }





    // Add new user
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required|string',
            'phone'     => 'string|nullable',
            'email'     => 'required|email|max:255|unique:users',
            'password'  => 'required|confirmed',
        ]);

        $user               = new User();
        $user->name         = $request->input('name');
        $user->phone        = $request->input('phone');
        $user->email        = $request->input('email');
        $user->password     = bcrypt($request->input('password'));

        $user->save();
        return back()->with('message', 'User saved successfully')
            ->with('message-type', 'success');
    }





    // Update user
    public function update(Request $request, Optimus $optimus)
    {

        $id                 = $optimus->decode($request->input('id'));
        $user               = User::findOrFail($id);

        $this->validate($request, [
            'email' => 'required|email|max:255|unique:users,email,'.$user->email.',email',
            'password' => 'confirmed',
        ]);

        $user->name         = $request->input('name');
        $user->email        = $request->input('email');
        $user->phone        = $request->input('phone');

        if ($request->has('password'))
        {
            $user->password     = bcrypt($request->input('password'));
        }

        $user->save();
        return back()->with('message', 'User updated successfully')
            ->with('message-type', 'success');
    }





    // Search user
    public function search(Request $request, Optimus $optimus)
    {
        $keyword    = $request->input('q');
        $matched_users = User::where('name', 'like', '%'.$keyword.'%')
            ->orWhere('email', 'like', '%'.$keyword.'%');
        if ($request->ajax())
        {
            $users = $matched_users->take(5)->get();
            foreach ($users as $user)
            {
                $user->formatted_result = $user->name .' ('. $user->email .')';
            }
            return $users;
        }
        else
        {
            $users = $matched_users->paginate(10)->appends(['q' => $keyword]);
            return view('pages.user', compact('optimus', 'users'));
        }
    }





    // Show user
    public function show($user_id, Request $request, Optimus $optimus)
    {
        $id                 = $optimus->decode($user_id);
        $user               = User::findOrFail($id);

        return view('pages.user-show', compact('optimus', 'user'));
    }





    // Delete user
    public function destroy(Request $request, Optimus $optimus)
    {
        $id                 = $optimus->decode($request->input('id'));
        $user               = User::findOrFail($id);

        $user->delete();
        return redirect('user')->with('message', 'User deleted successfully')
            ->with('message-type', 'success');
    }

}
