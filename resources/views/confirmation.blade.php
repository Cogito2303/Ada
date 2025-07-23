<div class="container mt-4">
  <h4>🎉 Confirmation de demande</h4>
  <ul class="list-group">
    <li class="list-group-item"><strong>Nom :</strong> {{ $nom }}</li>
    <li class="list-group-item"><strong>Transaction :</strong> {{ $transaction_id }}</li>
    <li class="list-group-item"><strong>Montant payé :</strong> {{ $montant }} FCFA</li>
  </ul>
  <button onclick="window.print()" class="btn btn-success mt-3">Imprimer</button>
</div>
