<?php

namespace App\Http\Controllers\BirthCertificate;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\BirthCertificate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;

class BirthCertificateController extends Controller
{
    // Enregistrer un extrait de naissance avec numéro
    public function store(Request $request)
    {

        // $with = $request->query('with');
        $with = $request->input('with', $request->query('with'));

        if ($with === 'number') {
            $validated = $request->validate([
                'child_name' => 'required|string|max:100',
                'child_birthday' => 'required|date',
                'father_name' => 'required|string|max:100',
                'mother_name' => 'required|string|max:100',
                'birth_certificate_num' => 'required|string|max:100',
                'phone_num_1' => 'required|string',
                'phone_num_2' => 'nullable|string',
                'email' => 'required|email',
                'residence' => 'required|string|max:100',
                'neighborhood' => 'required|string|max:100',
                'city' => 'required|string|max:100',
                'municipal_office' => 'required|string|max:100',
                'number_of_copies' => 'nullable|integer|max:100',
            ]);
            $validated['asking_number'] = 'EAN-' . Str::uuid();
            BirthCertificate::create($validated);
            return response()->json('success', 201);

        } elseif ($with === 'picture') {

            $validated = $request->validate([
                'child_name' => 'required|string|max:100',
                'child_birthday' => 'required|date',
                'phone_num_1' => 'required|string',
                'phone_num_2' => 'nullable|string',
                'email' => 'required|email',
                'residence' => 'required|string|max:100',
                'neighborhood' => 'required|string|max:100',
                'city' => 'required|string|max:100',
                'municipal_office' => 'required|string|max:100',
                'number_of_copies' => 'nullable|integer|max:100',
                'picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            
            // Variable pour stocker le chemin de l'image
            $path = null;
            if ($request->hasFile('picture')) {
                $file = $request->file('picture');
                // Génère un nom unique avec extension d’origine
                $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                // Stocke le fichier avec ce nom dans le dossier birth_certificates sur le disque public
                $path = $file->storeAs('birth_certificates', $filename, 'public');
            }
            $validated['asking_number'] = 'EAP-' . Str::uuid(); // Génère un numéro de demande unique
            $validated['picture'] = $path; // Ajout du chemin dans les données à enregistrer
            // Enregistre l'extrait de naissance avec le chemin de l'image
            BirthCertificate::create($validated);
            return response()->json($validated, 201);
        }
        return response()->json(['error' => 'Paramètre "with" invalide.'], 400);
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

    // Afficher les détails d'un extrait de naissance
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
