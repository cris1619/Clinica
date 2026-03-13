<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $buscar = $request->buscar;

    $usuarios = User::with('roles')
        ->when($buscar, function ($query, $buscar) {
            return $query->where('name', 'like', "%$buscar%")
                         ->orWhere('email', 'like', "%$buscar%");
        })
        ->paginate(5);
        $totalUsuarios = User::count();
        $roles = Role::all();


    return view('administrador.usuarios.index', compact('usuarios','buscar','totalUsuarios','roles'));
}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();

    return view('administrador.usuarios.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
        'rol_id' => 'required'
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password)
    ]);

    $user->roles()->attach($request->rol_id);

    return redirect()->route('usuarios.index')
        ->with('success','Usuario creado correctamente');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
{
    $roles = Role::all();

    return view('administrador.usuarios.edit', compact('user','roles'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email'
    ]);

    $user->update([
        'name' => $request->name,
        'email' => $request->email
    ]);

    // actualizar rol
    $user->roles()->sync([$request->rol_id]);

    return redirect()->route('usuarios.index')
        ->with('success','Usuario actualizado correctamente');
}

    /**
     * Remove the specified resource from storage.
     */
 public function destroy(User $user)
{
    if ($user->id === auth()->id()) {
    return back()->with('error','No puedes eliminar tu propio usuario');
}
    // verificar si el usuario es administrador
    if ($user->roles->first()->nombre === 'administrador') {
        return redirect()->route('usuarios.index')
            ->with('error', 'No se puede eliminar un usuario administrador');
    }

    $user->delete();

    return redirect()->route('usuarios.index')
        ->with('success', 'Usuario eliminado correctamente');
}
public function updateRol(Request $request, User $user)
{
    $request->validate([
        'rol_id' => 'required|exists:roles,id'
    ]);

    $user->roles()->sync([$request->rol_id]);

    return redirect()->route('usuarios.index')
        ->with('success','Rol actualizado correctamente');
}
}
