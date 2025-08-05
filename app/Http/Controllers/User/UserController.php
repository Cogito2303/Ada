<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        abort_unless(auth()->user()->isSuperAdmin(), 403);

        $users = User::all();
        return view('users.index', compact('users'));
    }

    // Créer un user
      // On utilise le auth/register.blade.php généré par defaut par Jetstream
    // Pour creer un user
    public function create()
    {
        return view('users.create');
    }

     public function store(Request $request)
    {
         $request->validate([
        'name' => 'required|string',
        'email' => 'required|email|unique:users',
        'residence' => 'required|string',
        'neighborhood' => 'required|string',
        'password' => 'required|string|confirmed|min:8',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'residence' => $request->residence,
        'neighborhood' => $request->neighborhood,
        'password' => bcrypt($request->password),
        'role' => 'admin'
    ]);
    

    return redirect()->route('login')->with('success', 'Utilisateur créé avec succès.');

    }

    // Editer un user
    public function edit($id)
    {
        abort_unless(auth()->user()->isSuperAdmin(), 403);

        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));

    }

    // Mettre a jour un user
    public function update(Request $request, $id)
{
    abort_unless(auth()->user()->isSuperAdmin(), 403);
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $id],
        'role' => ['required', 'in:user,admin,super_admin'],
    ]);

    $user = User::findOrFail($id);

    $user->name = $request->name;
    $user->email = $request->email;
    $user->role = $request->role;
    $user->save();

    // Optionnel : enregistrement dans une table d’activité
    // activity()
    //     ->causedBy(auth()->user())
    //     ->performedOn($user)
    //     ->withProperties(['name' => $request->name, 'role' => $request->role])
    //     ->log("Mise à jour de l'utilisateur");
    return redirect()->route('users.index')
        ->with('success', "L'utilisateur a été mis à jour avec succès.");
}

    // supprimer un user
    public function destroy($id)
{
    abort_unless(auth()->user()->isSuperAdmin(), 403);
    $user = User::findOrFail($id);
    $user->delete();

    // Optionnel : enregistrer l'action
    // activity()
    //     ->causedBy(auth()->user())
    //     ->performedOn($user)
    //     ->log("Suppression de l'utilisateur");
    return redirect()->route('users.index')
        ->with('success', "L'utilisateur a été supprimé.");
}

// profile de user 
    public function profile(Request $request){
        $user = $request->user();
        if($user->isSuperAdmin()){
            return view ('profile.super.index');
        }
        elseif ($user->isAdmin()) {
            return view ('profile.admin.index');
            
        }
    }

    // Mettre à jour le profil
    public function update_profile(Request $request){
        $user = $request->user();
        if($user->isSuperAdmin()){
            return view ('profile.super.update');
        }
        elseif ($user->isAdmin()) {
            return view ('profile.admin.update');
            
        }
    }

    // Changer le status d'un user
    public function toggleStatus($id)
{
    $admin = User::findOrFail($id);
    $admin->is_active = !$admin->is_active;
    $admin->save();

    return back()->with('status', 'Statut mis à jour.');
}


}
