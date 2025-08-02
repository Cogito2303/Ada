<?php

namespace App\Http\Controllers\BirthCertificate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BirthCertificateWithNum;
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;

class BirthCertificateWithNumController extends Controller
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

    BirthCertificateWithNum::create($validated);
    // return response()->json(['message' => 'Demande enregistrée avec succès'], 201);
    return response()->json($validated, 201);
}

// Trouver un extrait grace au numéro de demande
public function show($asking_number): JsonResponse
    {
        $extrait = BirthCertificateWithNum::find($asking_number);
        if (!$extrait) {
        return response()->json(['message' => 'Extrait introuvable.'], 404);
        }
        return response()->json($extrait);
    }


    // Afficher le role 
    public function index(Request $request)
{
    $user = $request->user();

    if ($user->isSuperAdmin()) {
        return response()->json(BirthCertificateWithNum::all());
    }

    return response()->json(
        BirthCertificateWithNum::where('residence', $user->residence)->get()
    );
}
}
