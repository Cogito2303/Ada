@extends('layouts.app')
@section('content')

  <div class="max-w-7xl mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold mb-4 text-gray-800">Liste des demandes</h2>
    <div class="flex justify-end mb-4">
    <a href="{{ route('ask') }}"
      class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded shadow hover:bg-green-700 transition">
      ➕ Faire une demande
    </a>
    </div>

    @if (count($birthCertificates) == 0)
    <h1 class="text-center text-2xl">Pas de document disponible</h1>
    @else
    <table class="min-w-full bg-white border border-gray-300 rounded shadow">
    <thead class="bg-gray-100">
      <tr>
      <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">#</th>
      <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Nom du demandeur</th>
      <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Extrait</th>
      <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Contact</th>
      <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Contact 2</th>
      <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Mairie</th>
      <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700"></th>
      <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Details/Impr</th>
      <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Status</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($birthCertificates as $certificate)
      <tr class="border-t">
      <td class="px-4 py-2 text-sm text-gray-600">{{ $loop->iteration }}</td>
      <td class="px-4 py-2 text-sm text-gray-600">{{ $certificate->child_name }}</td>
      <td class="px-4 py-2 text-sm text-gray-600">N° {{ $certificate->birth_certificate_num }}</td>
      <td class="px-4 py-2 text-sm text-gray-600">{{ $certificate->phone_num_1 }}</td>
      <td class="px-4 py-2 text-sm text-gray-600">{{ $certificate->phone_num_2 }}</td>
      <td class="px-4 py-2 text-sm text-gray-600"><strong>{{ $certificate->city }}</strong>
      ({{ $certificate->municipal_office }}) </td>
      <td class="px-4 py-2 text-sm text-gray-600">
      </td>
      <!-- Action -->
      <td class="px-4 py-2 text-sm text-gray-600">
    @if ($certificate->picture)
        <div class="flex items-center space-x-4">
            {{-- Lien pour voir l’image --}}
            <a href="{{ asset('storage/' . $certificate->picture) }}" target="_blank"
               class="inline-flex items-center text-sm text-blue-600 hover:underline hover:text-blue-800">
                Voir
            </a>

            {{-- Lien pour télécharger l’image --}}
            <a href="{{ asset('storage/' . $certificate->picture) }}" download="extrait-{{ $certificate->asking_number }}.jpg"
               class="inline-flex items-center text-sm text-green-600 hover:underline hover:text-green-800">
                Télécharger
            </a>
        </div>
    @else
        {{-- Lien vers les détails du certificat --}}
        <a href="{{ route('birth-certificate.details', $certificate->asking_number) }}" target="_blank"
           class="inline-flex items-center text-sm text-indigo-600 hover:underline hover:text-indigo-800">
            🖨️ Imprimer
        </a>
    @endif
</td>
      <!-- Status -->
      <td>
      @livewire('birth-certificate-status', ['certificate' => $certificate], key($certificate->id))
      </td>


      </tr>
    @endforeach
    </tbody>
    </table>
    @endif

  @endsection