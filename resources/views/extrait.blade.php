{{-- <div x-data="{ data: @json($data) }" class="container mt-5">
  <h4>Détails de l’extrait</h4>

  <p><strong>Nom :</strong> <span x-text="data.nomEnfant"></span></p>

</div> --}}


@extends('layouts.app')

@section('content')
<div x-data="extraitView()" x-init="init()" class="container mt-5">
  <h4>📄 Détails de l’extrait</h4>
  <p><strong>Nom :</strong> <span x-text="data.nom"></span></p>
  <p><strong>Numéro :</strong> <span x-text="data.numero"></span></p>
  <p><strong>Date de naissance :</strong> <span x-text="data.date_naissance"></span></p>
  <p><strong>Lieu de naissance :</strong> <span x-text="data.lieu_naissance"></span></p>
</div>

<script>
  function extraitView() {
    return {
      data: {},

      init() {
        const stored = localStorage.getItem('extraitData');
        if (stored) {
          this.data = JSON.parse(stored);
        }
      }
    }
  }
</script>
@endsection
