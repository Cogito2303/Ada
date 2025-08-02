{{-- Ce formulaire utilise bootstrap et alpine js qui utilise les notation x-model --}}
<div class="container py-3">
    <h4 class="mb-3 text-center">Demande copie d'extrait de naissance</h4>
  <form @submit.prevent =submitBirthCertificateWithNumForm()  x-data="birthCertificateWithNumForm()" x-init="$watch('residence', () => neighborhood=''); $watch('cityForAsk', () => municipalOffice='')" class="border rounded p-3 shadow-sm">

    {{-- INFORMATIONS SUR L'EXTRAIT DE NAISSANCE --}}
      <fieldset class="border p-2 mb-2">
        <legend class="float-none w-auto px-2">INFORMATION SUR L'EXTRAIT</legend>
        <div class="row mb-2">
            <!-- Nom & Prénom de l'enfant -->
            <div class="col-md-4">
                <label class="form-label fw-bold"> Nom </label> <span style="color: red">*</span>
                <input id="childLastNameId" type="text" class="form-control" placeholder="Entrez votre nom" x-model="childLastName">
                {{-- Pour afficher un message d'erreur --}}
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Prénom(s)</label>
                <input id="childFirstNameId" type="text" class="form-control" placeholder="Entrez votre prénom" x-model="childFirstName">
            </div>
             <div class="col-md-4">
                <label class="form-label fw-bold">Date de naissance</label>
                <input id="childBirthdayId" type="date" class="form-control" x-model="childBirthday">
            </div>
            <!-- Nom & Prénom des parents -->
            <div class="col-md-6 mt-3">
                <label class="form-label fw-bold">Nom du père sur l'extrait</label>
                <input id="fatherLastNameId" type="text" class="form-control" placeholder="Entrez le nom du père" x-model="fatherLastName">
            </div>
            <div class="col-md-6 mt-3">
                <label class="form-label fw-bold">Prénom du père sur l'extrait</label>
                <input id="fatherFirstNameId" type="text" class="form-control" placeholder="Entrez le prénom du père" x-model="fatherFirstName">
            </div>
            <div class="col-md-6 mt-3">
                <label class="form-label fw-bold">Nom de la mère sur l'extrait</label>
                <input id="motherLastNameId" type="text" class="form-control" placeholder="Entrez le nom de la mère" x-model="motherLastName">
            </div>
            <div class="col-md-6 mt-3">
                <label class="form-label fw-bold">Prénom de la mère sur l'extrait</label>
                <input id="motherFirstNameId" type="text" class="form-control" placeholder="Entrez le prénom de la mère" x-model="motherFirstName">
            </div>

             <!-- Numéro d'extrait -->
    <fieldset class="border mb-3 p-2 w-75 mx-auto">
      <legend class="float-none w-auto px-1 fw-bold">Numéro d'extrait</legend>
      <div class="row">
        <div class="col-md-3">
          <input id="certificateFirstNumId" type="number" class="form-control mb-1" placeholder="N° d'acte" x-model="certificateFirstNum">
        </div>

         <div class="col-md-1">
          {{-- ce input affiche juste le mot 'DU' --}}
            {{-- <input type="text" readonly class="form-control-plaintext fw-bold mb-1" value="DU"> --}}
            <label for="" class="text-centered fw-bold">du</label>
        </div>

         <div class="col-md-2 mb-1">
          <select id="certificateDayId" class="form-select" x-model="certificateDay">
            {{-- injection des jours depuis le fichier app.js gerer par Alpine.js --}}
            <option>Jour...</option>
            <template x-for="day in dayList" :key="day">
              <option x-text="day" :value="day"></option>
            </template>
          </select>
        </div>
        {{-- injection des mois depuis le fichier app.js gerer par Alpine.js --}}
        <div class="col-md-3 mb-1">
          <select id="certificateMonthId" class="form-select" x-model="certificateMonth">
            <option>Mois...</option>
            <template x-for="month in monthList" :key="month">
              <option x-text="month"></option>
            </template>
          </select>
        </div>
        <div class="col-md-2 mb-1">
          <input id="certificateYearId" type="number" class="form-control" min="1" placeholder="Année" x-model="certificateYear">
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
                <input id="phoneNum1Id" type="text" class="form-control" placeholder="Ex: 0707070707" x-model="phoneNum1">
            </div>

             <div class="col-md-4">
                <label class="form-label fw-bold">Contact 2</label>
                <input id="phoneNum2Id" type="text" class="form-control" placeholder="Ex: 0707070707" x-model="phoneNum2">
            </div>

            <div class="col-md-4">
                <label class="form-label fw-bold">Email</label>
                <input id="emailId" type="email" class="form-control" placeholder="exemple@domaine.com" x-model="email">
            </div>
            </div>
            <!-- place d'habitation & Quartier -->
        {{-- injection des placex villes depuis le fichier app.js gerer par Alpine.js --}}
        <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label fw-bold">Lieu de residence</label>
            <select id="residenceId" class="form-select" x-model="residence">
            <option selected disabled value="">Choisissez votre lieu de residence</option>
            <template x-for="(q, key) in residenceNeighborhood" :key="key">
                <option :value="key" x-text="key"></option>
            </template>
            </select>
        </div>
        {{-- Injection du quartie qui depend de la ville --}}

        <div class="col-md-6">
            <label class="form-label fw-bold">Quartier</label>
            <select id="neighborhoodId" class="form-select" x-model="neighborhood" :disabled="!residence">
                <option>Selectionne le quartier </option>
            <template x-if="residence">
                <template x-for="q in residenceNeighborhood[residence]" :key="q">
                <option x-text="q"></option>
                </template>
            </template>
            <template x-if="!residence">
                <option selected disabled>Choisissez le lieu de residence d'abord</option>
            </template>
            </select>
        </div>
        </div>

        <!-- Ville cible & Mairie cible -->
    <div class="row mb-4">
      <div class="col-md-6">
        <label class="form-label fw-bold">Ville cible</label>
        {{-- injection des villes depuis le fichier app.js gerer par Alpine.js --}}
        <select id="cityForAskId" class="form-select" x-model="cityForAsk">
          <option selected disabled value="">Choisir une ville</option>
          <template x-for="(m, key) in cityMunicipalOffice" :key="key">
            <option :value="key" x-text="key"></option>
          </template>
        </select>
      </div>
      {{-- Injection de la mairie qui depend de la ville --}}
      <div class="col-md-6">
        <label class="form-label fw-bold">Mairie cible</label>
        <select id="municipalOfficeId" class="form-select" x-model="municipalOffice" :disabled="!cityForAsk">
            <option>Selectionne la mairie </option>
          <template x-if="cityForAsk">
            <template x-for="m in cityMunicipalOffice[cityForAsk]" :key="m">
              <option x-text="m"></option>
            </template>
          </template>
          <template x-if="!cityForAsk">
            <option selected disabled>Choisir la ville d'abord</option>
          </template>
        </select>
      </div>
    </div>

            <div class="col-md-4">
                <label class="form-label fw-bold"> Nombre de Copie(s) </label> <span style="color: red">*</span>
                <input id="numberOfCopiesId" type="number" class="form-control" placeholder="Nombre de copies" x-model="numberOfCopies">
                {{-- Pour afficher un message d'erreur --}}
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
