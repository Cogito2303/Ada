
<div class="container py-5" x-data="extraitSearch()">
    <h2 class="mb-4 text-center">🔍 Recherche d’Extrait avec Numéro</h2>

    <!-- Formulaire de recherche -->
    <form @submit.prevent="searchExtrait" class="mb-4">
        <div class="row g-3">
            <div class="col-md-8 mx-auto">
                <input type="text" class="form-control" placeholder="Entrez le numéro de demande (EAN-...)" x-model="numeroDemande" required>
            </div>
            <div class="col-md-4 mx-auto text-center">
                <button type="submit" class="btn btn-primary w-100">
                    Rechercher
                </button>
            </div>
        </div>
    </form>

    <!-- Message de chargement -->
    <template x-if="loading">
        <div class="text-center">
            <div class="spinner-border text-primary" role="status"></div>
            <p class="mt-2">Recherche en cours...</p>
        </div>
    </template>

    <!-- Message d’erreur -->
    <template x-if="error">
        <div class="alert alert-danger text-center" x-text="error"></div>
    </template>

    <!-- Résultat PDF -->
    <template x-if="extrait">
        <div>
            <!-- Zone à exporter en PDF -->
            <div id="extrait-pdf" class="card mt-4 p-4 border border-dark shadow bg-white">
                <h3 class="text-center text-uppercase fw-bold mb-3">
                    République de Côte d’Ivoire<br>
                    Extrait d’Acte de Naissance
                </h3>

                <div class="mb-3 text-center">
                    <span class="badge bg-primary fs-6">Numéro de demande : <span x-text="extrait.numero_demande"></span></span>
                </div>

                <div class="row g-2 info">
                    <div class="col-md-6">
                        <p><strong>Nom de l’enfant :</strong> <span x-text="extrait.nom_enfant"></span></p>
                        <p><strong>Date de naissance :</strong> <span x-text="extrait.date_naissance"></span></p>
                        <p><strong>Numéro d’extrait :</strong> <span x-text="extrait.numero_extrait"></span></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Nom du père :</strong> <span x-text="extrait.nom_pere"></span></p>
                        <p><strong>Nom de la mère :</strong> <span x-text="extrait.nom_mere"></span></p>
                    </div>
                </div>

                <hr>

                <div class="row g-2 info">
                    <div class="col-md-6">
                        <p><strong>Ville :</strong> <span x-text="extrait.ville"></span></p>
                        <p><strong>Quartier :</strong> <span x-text="extrait.quartier"></span></p>
                        <p><strong>Lieu d’habitation :</strong> <span x-text="extrait.lieu_habitation"></span></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Mairie :</strong> <span x-text="extrait.mairie"></span></p>
                        <p><strong>Contact 1 :</strong> <span x-text="extrait.contact_1"></span></p>
                        <p><strong>Contact 2 :</strong> <span x-text="extrait.contact_2 || '–'"></span></p>
                        <p><strong>Email :</strong> <span x-text="extrait.email || '–'"></span></p>
                    </div>
                </div>

                <hr>

                <div class="text-end mt-4">
                    <p class="fst-italic">Fait le : <span x-text="new Date().toLocaleDateString()"></span></p>
                    <p class="fw-bold">Le Responsable d’état civil</p>
                    <p class="signature-area mt-5">__________________________</p>
                </div>
            </div>

            <!-- Boutons PDF -->
            <div class="text-end mt-3">
                <button class="btn btn-outline-secondary me-2" @click="telechargerPDF">
                    🖨️ Télécharger PDF rapide (Impression navigateur)
                </button>

                <button class="btn btn-outline-secondary" @click="exporterPDF">
                    🖨️ Exporter PDF officiel (html2pdf.js)
                </button>
            </div>
        </div>
    </template>
</div>

<!-- Style d'impression -->
<style>
@media print {
    body * {
        visibility: hidden !important;
    }
    #extrait-pdf, #extrait-pdf * {
        visibility: visible !important;
    }
    #extrait-pdf {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        font-family: 'Arial', sans-serif;
    }
}

#extrait-pdf {
    border: 1px solid #444;
    padding: 2rem;
    background-color: #fff;
    font-size: 14px;
    line-height: 1.6;
}

#extrait-pdf h3 {
    text-align: center;
    text-transform: uppercase;
    font-weight: bold;
    margin-bottom: 1rem;
}

#extrait-pdf .info p {
    margin: 0.25rem 0;
}
</style>

<!-- html2pdf.js CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>