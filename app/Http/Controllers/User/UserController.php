<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Jetstream\Jetstream;
use App\Actions\Fortify\PasswordValidationRules;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    use PasswordValidationRules;

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
        'name' => ['required', 'string', 'max:255'],
        'contact' => ['required', 'string', 'max:255'],
        'contact_2' => ['nullable', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => $this->passwordRules(),
        'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : [],
        'residence' => ['required', 'string', 'max:255'],
        'neighborhood' => ['required', 'string', 'max:255'],
        'municipal_office_city' => ['required', 'string', 'max:255'],
        'municipal_office' => ['required', 'string', 'max:255'],
    ]);

    // Utilisation directe de $request->validated() pour plus de clarté
    $input = $request->all();

    User::create([
        'name' => $input['name'],
        'contact' => $input['contact'],
        'contact_2' => $input['contact_2'] ?? null,
        'username' => $input['username'] ?? null,
        'email' => $input['email'],
        'password' => Hash::make($input['password']),
        'role' => 'admin',
        'residence' => $input['residence'] ?? 'Bouake',
        'neighborhood' => $input['neighborhood'] ?? 'Dar-es-Salam',
        'municipal_office_city' => $input['municipal_office_city'] ?? 'Bouake',
        'municipal_office' => $input['municipal_office'] ?? 'Bouake',
        'status' => true,
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
