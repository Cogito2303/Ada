<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExtraitAvecNumero;
use Illuminate\Support\Str;

class ExtraitAvecNumeroController extends Controller
{
    //
     public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_enfant' => 'required|string|max:100',
            'date_naissance' => 'required|date',
            'nom_pere' => 'required|string|max:100',
            'nom_mere' => 'required|string|max:100',
            'numero_extrait' => 'required|string|max:100',
            'contact_1' => 'required|string|max:14',
            'contact_2' => 'string|max:14',
            'email' => 'string|max:100',
            'lieu_habitation' => 'required|string|max:150',
            'quartier' => 'required|string|max:100',
            'ville' => 'required|string|max:100',
            'mairie' => 'required|string|max:100',
        ]);
        // On génère un numéro de demande commeçant par EAN pour extrait Avec Numero
        // ce numero sera la clé primaire dans la base de données
        $validated['numero_demande'] = 'EAN-' . Str::uuid();
        // On sauvegarde dans la base de données
        // $extrait = ExtraitAvecNumero::create($validated);

        // return response()->json($extrait, 201);
        ExtraitAvecNumero::create([$request ->all()]);
        return response()->json('ça marche', 201);
    }

}
