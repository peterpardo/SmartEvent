<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index() {
        $scripts = [
            asset('js/user/delete-user.js'),
            asset('js/user/add-workspace.js'),
        ];

        $users = User::all();
        $user = User::find(Auth::user()->id);

        // Check if normal user
        if($user->hasRole('user')) {
            $workspaces = $user->workspaces()->get();
        } else {
            $workspaces = false;
        }

        return view('index', [
            'users' => $users,
            'scripts' => $scripts,
            'workspaces' => $workspaces
        ]);
    }

    public function viewAccount($id) {
        $user = User::find($id);

        return view('users.view-account', [
            'user' => $user,
        ]);
    }

    public function addUser() {
        $user = User::find(Auth::user()->id);
        return view('users.add-user', [
            'user' => $user,
        ]);
    }

    public function add(Request $request) {
        Validator::make($request->all(), [
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email',
            ],
            'password' => ['required', 'confirmed',  Password::min(8)],
        ], [
            'fname.required' => 'The first name field is required',
            'lname.required' => 'The last name field is required',
        ])->validate();

        $user = User::create([
            'fname' => $request->input('fname'),
            'lname' => $request->input('lname'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        $user->assignRole('user');

        return redirect()->route('home')->with('success', 'User successfully created!');
    }

    public function viewUser($id) {
        $user = User::find($id);
        
        return view('users.view-user', [
            'user' => $user,
        ]);
    }

    public function edit(Request $request, $id) {
        $user = User::find($id);

        if($request->input('email') == $user->email) {
            Validator::make($request->all(), [
                'fname' => ['required', 'string', 'max:255'],
                'lname' => ['required', 'string', 'max:255'],
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                ],
            ], [
                'fname.required' => 'The first name field is required',
                'lname.required' => 'The last name field is required',
            ])->validate();
        } else {
            Validator::make($request->all(), [
                'fname' => ['required', 'string', 'max:255'],
                'lname' => ['required', 'string', 'max:255'],
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    'unique:users,email',
                ],
            ], [
                'fname.required' => 'The first name field is required',
                'lname.required' => 'The last name field is required',
            ])->validate();
        }

        $user->fname = $request->input('fname');
        $user->lname = $request->input('lname');
        $user->email = $request->input('email');
        $user->save();
        
        return back()->with('success', 'User successfully updated!');
    }

    public function delete($id) {
        User::destroy($id);

        return back()->with('success', 'User successfully deleted!');
    }
    
}
