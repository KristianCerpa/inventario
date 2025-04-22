<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
   /* public function index()
    {
        // Logic to display a list of users
        $users = User::all();
        return view('admin.users.index', compact('users'));
    } */

   public function create()
    {
        return view('auth.register'); // Asegúrate de que este sea el nombre correcto de tu vista
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'rol' => ['required', 'string', 'in:administrador,empleado'],
        ]);
    
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol' => $request->rol,
        ]);
    
        return redirect()->route('admin.users.create')->with('success', 'Usuario registrado exitosamente.');
    }
}