<div class="container py-2">
  <h4 class="mb-3 text-center">Demande copie d'extrait de naissance</h4>

  <form x-data="formulaireInterdependant()" x-init="$watch('lieu', () => quartier=''); $watch('ville', () => mairie='')" class="border rounded p-3 shadow-sm">
      {{-- AUTRES INFORMATIONS --}}
    <fieldset class="border p-2 mb-2">
        <legend class="float-none w-auto px-2">AUTRES INFORMATIONS</legend>
        <!-- Contact & Email -->
            <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label fw-bold">Contact</label>
                <input type="text" class="form-control" placeholder="Ex: 0707070707">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Email</label>
                <input type="email" class="form-control" placeholder="exemple@domaine.com">
            </div>
            </div>
            <!-- Lieu d'habitation & Quartier -->
        {{-- injection des lieux villes depuis le fichier app.js gerer par Alphine.js --}}
        <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label fw-bold">Lieu d'habitation</label>
            <select class="form-select" x-model="lieu">
            <option selected disabled value="">Choisir un lieu</option>
            <template x-for="(q, key) in villeQuartier" :key="key">
                <option :value="key" x-text="key"></option>
            </template>
            </select>
        </div>
        {{-- Injection du quartie qui depend de la ville --}}

        <div class="col-md-6">
            <label class="form-label fw-bold">Quartier</label>
            <select class="form-select" x-model="quartier" :disabled="!lieu">
            <template x-if="lieu">
                <template x-for="q in villeQuartier[lieu]" :key="q">
                <option x-text="q"></option>
                </template>
            </template>
            <template x-if="!lieu">
                <option selected disabled>Choisir le lieu d'abord</option>
            </template>
            </select>
        </div>
        </div>

        <!-- Ville cible & Mairie cible -->
    <div class="row mb-4">
      <div class="col-md-6">
        <label class="form-label fw-bold">Ville cible</label>
        {{-- injection des villes depuis le fichier app.js gerer par Alphine.js --}}
        <select class="form-select" x-model="ville">
          <option selected disabled value="">Choisir une ville</option>
          <template x-for="(m, key) in villeMairie" :key="key">
            <option :value="key" x-text="key"></option>
          </template>
        </select>
      </div>
      {{-- Injection de la mairie qui depend de la ville --}}
      <div class="col-md-6">
        <label class="form-label fw-bold">Mairie cible</label>
        <select class="form-select" x-model="mairie" :disabled="!ville">
          <template x-if="ville">
            <template x-for="m in villeMairie[ville]" :key="m">
              <option x-text="m"></option>
            </template>
          </template>
          <template x-if="!ville">
            <option selected disabled>Choisir la ville d'abord</option>
          </template>
        </select>
      </div>
    </div>

        {{-- Photo de l'extrait --}}
        <fieldset class="border p-2 mb-2">
            <legend class="float-none w-auto px-2">PHOTO DE L'EXTRAIT</legend>
            <div class="mb-3">
                <label class="form-label fw-bold">Télécharger une photo</label>
                <input type="file" class="form-control" accept=".jpg,.jpeg,.png,.pdf,.doc,.docx" />
            </div>
        </fieldset>

    </fieldset>
    {{-- BOUTON D'ENVOI --}}
    <div class="text-center">
       <button type="button" class="btn btn-success">
             Soumettre la demande
        </button>
    </div>

  </form>
</div>

