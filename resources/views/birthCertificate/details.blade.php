@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-6">
    @if ($birthCertificate)
        <div id="birthCertificate-pdf" class="bg-white border border-gray-300 shadow-lg rounded-lg p-6 print:p-0">
            <h2 class="text-center text-lg md:text-2xl font-semibold uppercase mb-4 text-gray-700 leading-tight">
                République de Côte d’Ivoire<br>
                Acte de Naissance
            </h2>

            <div class="text-center mb-6">
                <span class="inline-block bg-blue-600 text-white rounded px-3 py-1 text-sm md:text-base font-medium">
                    Numéro de demande : {{ $birthCertificate->asking_number }}
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-800">
                <div>
                    <p><strong>👶 Nom de l’enfant :</strong> {{ $birthCertificate->child_name }}</p>
                    <p><strong>🎂 Date de naissance :</strong> {{ \Carbon\Carbon::parse($birthCertificate['child_birthday'])->format('d/m/Y') }}</p>
                    <p><strong>📄 Numéro de l'extrait :</strong> {{ $birthCertificate->birth_certificate_num }}</p>
                </div>
                <div>
                    <p><strong>👨 Nom du père :</strong> {{ $birthCertificate->father_name }}</p>
                    <p><strong>👩 Nom de la mère :</strong> {{ $birthCertificate->mother_name }}</p>
                </div>
            </div>

            <hr class="my-6 border-gray-300">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-800">
                <div>
                    <p><strong>🏙️ Ville :</strong> {{ $birthCertificate->city }}</p>
                    <p><strong>📍 Quartier :</strong> {{ $birthCertificate->neighborhood }}</p>
                    <p><strong>🏠 Lieu d’habitation :</strong> {{ $birthCertificate->residence }}</p>
                </div>
                <div>
                    <p><strong>🏢 Mairie :</strong> {{ $birthCertificate->municipal_office }}</p>
                    <p><strong>📞 Contact 1 :</strong> {{ $birthCertificate->phone_num_1 }}</p>
                    <p><strong>📞 Contact 2 :</strong> {{ $birthCertificate->phone_num_2 ?? '–' }}</p>
                    <p><strong>📧 Email :</strong> {{ $birthCertificate->email ?? '–' }}</p>
                </div>
            </div>

            <hr class="my-6 border-gray-300">

            <div class="text-right mt-6">
                <p class="italic text-gray-600">Fait le : {{ now()->format('d/m/Y') }}</p>
                <p class="font-bold text-gray-700">Le Responsable d’état civil</p>
                <p class="mt-8">__________________________</p>
            </div>
        </div>

        <div class="mt-4 text-right">
            <button onclick="printSection('birthCertificate-pdf')" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium py-2 px-4 rounded shadow-sm transition">
                🖨️ Imprimer l'extrait
            </button>
        </div>
    @else
        <p class="text-center text-red-600 font-semibold">❌ Aucun extrait trouvé.</p>
    @endif
</div>
@endsection

@push('scripts')
<script>
    function printSection(sectionId) {
        const content = document.getElementById(sectionId).innerHTML;
        const windowPrint = window.open('', '', 'width=800,height=600');
        windowPrint.document.write(`
            <html>
                <head>
                    <title>Extrait de naissance</title>
                    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
                    <style>
                        body { font-family: sans-serif; padding: 20px; }
                        @media print {
                            button { display: none; }
                        }
                    </style>
                </head>
                <body>${content}</body>
            </html>
        `);
        windowPrint.document.close();
        windowPrint.focus();
        windowPrint.print();
        windowPrint.close();
    }
</script>
@endpush