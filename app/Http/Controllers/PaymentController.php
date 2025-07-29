<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;


class PaymentController extends Controller
{
    //
   public function redirectToWave(Request $request)
{
    $reference = $request->reference;
    $extrait = session('extrait_payload');

    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . config('services.wave.api_key'),
        'Accept' => 'application/json',
    ])->post('https://api.wave.com/payment', [
        'amount' => 500,
        'reference' => $reference,
        'callback_url' => route('wave.webhook'),
        'customer_email' => $extrait['email'] ?? '',
    ]);

    if ($response->successful()) {
        // Stocker le lien de paiement dans la vue
        return view('wave.loader', ['url' => $response->json()['payment_url'], 'reference' => $reference]);
    }

    return redirect()->route('payment.failed');
}



    public function handleWebhook(Request $request)
{
    $payload = $request->all();

    if ($payload['status'] === 'success') {
        $reference = $payload['reference'];
        $extrait = session('extrait_payload'); // récupère les données de l'extrait

        // Enregistre l'extrait
        $extraitRecord = ExtraitAvecNumero::create($extrait);

        // Enregistre la transaction liée
        Transaction::create([
            'extrait_avec_numero_id' => $extraitRecord->id,
            'reference' => $reference,
            'amount' => 500,
            'status' => 'success',
            'response_payload' => $payload,
        ]);

        session()->forget('extrait_payload');

        return redirect()->route('payment.success');
    }

    return redirect()->route('payment.failed');
}

}
