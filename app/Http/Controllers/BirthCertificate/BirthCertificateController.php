<?php

namespace App\Http\Controllers\BirthCertificate;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\BirthCertificate;
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;

class BirthCertificateController extends Controller
{

    public function store(Request $request)
    {
        $validated = $request->validate([
            'child_name' => 'required|string|max:100',
            'child_birthday' => 'required|date',
            'father_name' => 'required|string|max:100',
            'mother_name' => 'required|string|max:100',
            'birth_certificate_num' => 'required|string|max:100',
            'phone_num_1' => 'required|string',
            'phone_num_2' => 'nullable|string|',
            'email' => 'required|email',
            'residence' => 'required|string|max:100',
            'neighborhood' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'municipal_office' => 'required|string|max:100',
            'number_of_copies' => 'nullable|integer|max:100',
        ]);

        // On génère un numéro de demande commeçant par EAN pour extrait Avec Numero
        // ce numero sera la clé primaire dans la base de données
        $validated['asking_number'] = 'EAN-' . Str::uuid();

        BirthCertificate::create($validated);
        // return response()->json(['message' => 'Demande enregistrée avec succès'], 201);
        return response()->json($validated, 201);
    }

    // Trouver un extrait grace au numéro de demande
    public function show($asking_number): JsonResponse
    {
        $extrait = BirthCertificate::find($asking_number);
        if (!$extrait) {
            return response()->json(['message' => 'Extrait introuvable.'], 404);
        }
        return response()->json($extrait);
    }


    // Afficher tous les extraits ou pas selon le super admin ou admin 
    public function get_birth_certificate(Request $request)
    {
        $user = $request->user();

        if ($user->isSuperAdmin()) {
            $birthCertificates = BirthCertificate::all();
            return view('birthCertificate.index', compact('birthCertificates'));
        } elseif ($user->isAdmin()) {
            // on retourne les extrait si la localité de l'admin est celle de la demande
            $birthCertificates = BirthCertificate::where('city', $user->residence)->get();
            // return response()->json(
            // BirthCertificate::where('residence', $user->residence)->get());
                return view('birthCertificate.index', compact('birthCertificates'));
        }
    }

    public function birth_certificate_details(Request $request, $asking_number): View
{
    $user = $request->user();

    // Vérifie le rôle de l'utilisateur
    if (!($user->isSuperAdmin() || $user->isAdmin())) {
        abort(404, 'Extrait introuvable.');
    }
    // Récupère l'extrait
    $birthCertificate = BirthCertificate::findOrFail($asking_number);

    // Retourne la vue Blade avec les données
    return view('birthCertificate.details', compact('birthCertificate'));
}

}
