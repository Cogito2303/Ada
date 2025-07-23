<?php

namespace App\Http\Controllers\Api;

use App\Models\FormulaireExtraitNumero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
class PaiementController extends Controller
{
  public function initialiser(Request $request)
  {
    // Simule Wave: génère une URL fictive
    return response()->json(['urlPaiement' => route('confirmation.simule', ['transaction_id' => uniqid(), 'nom' => $request->nom])]);
  }

  public function valider(Request $request)
  {
    $status = 'completed'; // Simule Wave (à remplacer par appel HTTP réel)
    if ($status === 'completed') {
      $formulaire = FormulaireExtraitNumero::create([
        ...$request->only([
          'nom','prenom','nomPere','prenomPere','nomMere','prenomMere',
          'numero_acte','jour','mois','annee','contact','email',
          'lieu','quartier','ville','mairie'
        ]),
        'transaction_id' => $request->transaction_id,
        'montant' => 1000 // montant simulé
      ]);
      return response()->json(['ok' => true, 'id' => $formulaire->id]);
    }
    return response()->json(['ok' => false], 400);
  }
}
