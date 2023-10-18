<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\Vessel;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = Auth::id();
        $user = Vessel::where('id_user', $users)->get();;
        $data=Vessel::all();

        $inventory=Product::all();
        return view('index', compact('data','user','inventory'));
    }

    public function create()
{
    $users = User::all();
    $roles = Role::all();
    return view('auth.user', compact('roles','users'));
}
public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
        'roles' => 'required|array',
    ], [
        'required' => 'The field cannot be empty.',
    ]);
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ]);

    $user->assignRole($request->roles);

    return redirect()->route('user')
        ->with('success', 'User created successfully.');
}

public function edit(User $user)
{
    $roles = Role::all();
    return view('admin.users.edit', compact('user', 'roles'));
}

public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'edit_name3' => 'required|string|max:255',
            'edit_email3' => 'required|email',
            'edit_password3' => 'nullable|min:6',
            // Add other fields validation here
        ], [
            'required' => 'The field cannot be empty.',
        ]);

        // Update user's name and other fields as needed
        $user->name = $request->edit_name3;
        $user->email = $request->edit_email3;
        
        
        if ($request->edit_password) {
            $user->password = bcrypt($request->edit_password);
        }
        
        // Update other fields here

        $user->save();

        // Sync roles
        $user->syncRoles($request->input('edit_roles3'));

        return redirect()->route('user')->with('success', 'User Edit successfully.');
    }


public function destroy(User $user)
{
    $user->delete();
    return redirect()->route('user')->with('success', 'User deleted successfully.');
}
}
