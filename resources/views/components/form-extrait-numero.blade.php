{{-- Ce formulaire utilise bootstrap et alpine js qui utilise les notation x-model --}}

<div class="container py-3">
    <h4 class="mb-3 text-center">Demande copie d'extrait de naissance</h4>

    {{-- x-data permet de specifier la source des données qui seront manipuler dans le formulaire --}}
    {{-- ici les données viennent du fichier app.js --}}
    {{-- x-init pour initialiser et charger les données de x-data --}}
    {{-- x_model pour recuperer les données des champs dans app.js, les verifier avant la soumission --}}
  <form @submit.prevent =submitFormulaireExtraitAvecNumero()  x-data="formulaireExtraitAvecNumero()" x-init="$watch('lieu', () => quartier=''); $watch('ville', () => mairie='')" class="border rounded p-3 shadow-sm">

    {{-- INFORMATIONS SUR L'EXTRAIT DE NAISSANCE --}}
      <fieldset class="border p-2 mb-2">
        <legend class="float-none w-auto px-2">INFORMATION SUR L'EXTRAIT</legend>
        <div class="row mb-2">
            <!-- Nom & Prénom de l'enfant -->
            <div class="col-md-4">
                <label class="form-label fw-bold"> Nom </label> <span style="color: red">*</span>
                <input type="text" class="form-control" placeholder="Entrez votre nom" x-model="nomEnfant">
                {{-- Pour afficher un message d'erreur --}}
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Prénom(s)</label>
                <input type="text" class="form-control" placeholder="Entrez votre prénom" x-model="prenomEnfant">
            </div>
             <div class="col-md-4">
                <label class="form-label fw-bold">Date de naissance</label>
                <input type="date" class="form-control" x-model="dateNaissance">
            </div>
            <!-- Nom & Prénom des parents -->
            <div class="col-md-6 mt-3">
                <label class="form-label fw-bold">Nom du père sur l'extrait</label>
                <input type="text" class="form-control" placeholder="Entrez le nom du père" x-model="nomPere">
            </div>
            <div class="col-md-6 mt-3">
                <label class="form-label fw-bold">Prénom du père sur l'extrait</label>
                <input type="text" class="form-control" placeholder="Entrez le prénom du père" x-model="prenomPere">
            </div>
            <div class="col-md-6 mt-3">
                <label class="form-label fw-bold">Nom de la mère sur l'extrait</label>
                <input type="text" class="form-control" placeholder="Entrez le nom de la mère" x-model="nomMere">
            </div>
            <div class="col-md-6 mt-3">
                <label class="form-label fw-bold">Prénom de la mère sur l'extrait</label>
                <input type="text" class="form-control" placeholder="Entrez le prénom de la mère" x-model="prenomMere">
            </div>

             <!-- Numéro d'extrait -->
    <fieldset class="border mb-3 p-2 w-75 mx-auto">
      <legend class="float-none w-auto px-1 fw-bold">Numéro d'extrait</legend>
      <div class="row">
        <div class="col-md-3">
          <input type="number" class="form-control mb-1" placeholder="N° d'acte" x-model="numeroActe">
        </div>

         <div class="col-md-1">
          {{-- ce input affiche juste le mot 'DU' --}}
            {{-- <input type="text" readonly class="form-control-plaintext fw-bold mb-1" value="DU"> --}}
            <label for="" class="text-centered fw-bold">du</label>
        </div>

         <div class="col-md-2 mb-1">
          <select class="form-select" x-model="jourActe">
            {{-- injection des jours depuis le fichier app.js gerer par Alpine.js --}}
            <option>Jour...</option>
            <template x-for="jour in jourList" :key="jour">
              <option x-text="jour" :value="jour"></option>
            </template>
          </select>
        </div>
        {{-- injection des mois depuis le fichier app.js gerer par Alpine.js --}}
        <div class="col-md-3 mb-1">
          <select class="form-select" x-model="moisActe">
            <option>Mois...</option>
            <template x-for="mois in moisList" :key="mois">
              <option x-text="mois"></option>
            </template>
          </select>
        </div>
        <div class="col-md-2 mb-1">
          <input type="number" class="form-control" min="1" placeholder="Année" x-model="anneeActe">
        </div>
      </div>
    </fieldset>
    </div>
      </fieldset>

      {{-- AUTRES INFORMATIONS --}}
    <fieldset class="border p-2 mb-2">
        <legend class="float-none w-auto px-2">AUTRES INFORMATIONS</legend>
        <!-- Contact & Email -->
            <div class="row mb-3">
            <div class="col-md-4">
                <label class="form-label fw-bold">Contact 1</label>
                <input type="text" class="form-control" placeholder="Ex: 0707070707" x-model="contact1">
            </div>

             <div class="col-md-4">
                <label class="form-label fw-bold">Contact 2</label>
                <input type="text" class="form-control" placeholder="Ex: 0707070707" x-model="contact2">
            </div>

            <div class="col-md-4">
                <label class="form-label fw-bold">Email</label>
                <input type="email" class="form-control" placeholder="exemple@domaine.com" x-model="email">
            </div>
            </div>
            <!-- Lieu d'habitation & Quartier -->
        {{-- injection des lieux villes depuis le fichier app.js gerer par Alpine.js --}}
        <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label fw-bold">Lieu d'habitation</label>
            <select class="form-select" x-model="lieu">
            <option  value="">Choisir un lieu</option>
            <template x-for="(q, key) in villeQuartier" :key="key">
                <option :value="key" x-text="key"></option>
            </template>
            </select>
        </div>
        {{-- Injection du quartie qui depend de la ville --}}

        <div class="col-md-6">
            <label class="form-label fw-bold">Quartier</label>
            <select class="form-select" x-model="quartier" :disabled="!lieu">
                <option>Selectionne le quartier </option>
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
        {{-- injection des villes depuis le fichier app.js gerer par Alpine.js --}}
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
            <option>Selectionne la mairie </option>
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
    {{-- Affichage du message d'erreur en cas d'invalidité d'un champ --}}
    <div class="text-danger mt-2" x-show="errorMessage" x-text="errorMessage"></div>

    </fieldset>
    {{-- BOUTON D'ENVOI --}}
    <div class="text-center">
      <button type="submit" class="btn btn-primary">Envoyer la demande</button>

    </div>

  </form>
</div>
