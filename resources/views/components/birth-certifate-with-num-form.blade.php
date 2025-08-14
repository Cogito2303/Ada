<div class="min-h-screen bg-gray-50 py">
  <div class="max-w-5xl mx-auto px-4">
    <h4 class="text-xl font-bold text-indigo-700 text-center mb-2 tracking-wide uppercase">
      Demande de copie d'extrait de naissance
    </h4>
    <!-- <form @submit.prevent="submitBirthCertificateWithNumForm()" x-data="birthCertificateWithNumForm()" x-init="$watch('residence', () => neighborhood=''); $watch('cityForAsk', () => municipalOffice='')" class="bg-white shadow-md rounded p-6 space-y-6"> -->
    <form id="birthCertificateWithNumForm" 
        @submit.prevent="submitForm()" 
        x-data="birthCertificateWithNumForm()" 
        x-init="
        $watch('residence', () => neighborhood = '');
        $watch('cityForAsk', () => municipalOffice = '');
        " 
      class="bg-white shadow-md rounded-lg px-6 py-8 space-y-6">
      @csrf
      <!-- SECTION EXTRAIT -->
      <fieldset class="border border-gray-300 rounded-xl p-2 space-y-4">
        <legend class="text-blue-600 font-semibold text-lg uppercase tracking-wide">
          Extrait
        </legend>

        <!-- Nom et prénom -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">
              Nom <span class="text-red-500">*</span>
            </label>
            <input type="text"
              required
              class="w-full border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
              placeholder="Entrez le nom" x-model="childLastName">
          </div>
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Prénom(s)</label>
            <input type="text"
              required
              class="w-full border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:ring-2 focus:ring-indigo-500"
              placeholder="Entrez les prénoms" x-model="childFirstName">
          </div>
        </div>

        <!-- Date de naissance sur une ligne à part -->
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-1">Date de naissance</label>
          <input type="date"
            required
            class="w-full border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:ring-2 focus:ring-indigo-500"
            x-model="childBirthday">
        </div>

        <!-- Parents -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Nom du père</label>
            <input type="text"
              required
              class="w-full border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:ring-2 focus:ring-indigo-500"
              x-model="fatherLastName">
          </div>
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Prénom du père</label>
            <input type="text"
              required
              class="w-full border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:ring-2 focus:ring-indigo-500"
              x-model="fatherFirstName">
          </div>
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Nom de la mère</label>
            <input type="text"
              required
              class="w-full border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:ring-2 focus:ring-indigo-500"
              x-model="motherLastName">
          </div>
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Prénom de la mère</label>
            <input type="text"
              required
              class="w-full border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:ring-2 focus:ring-indigo-500"
              x-model="motherFirstName">
          </div>
        </div>
        <!-- NUMÉRO D'EXTRAIT -->
        <fieldset class="border border-gray-200 rounded-lg p-2 space-y-2">
          <legend class="text-indigo-600 font-semibold text-sm uppercase tracking-wider mb-1">
            Numéro de l'extrait
          </legend>

          <div class="grid grid-cols-1 md:grid-cols-6 gap-4 items-center">

            <!-- Numéro d'acte -->
            <div class="md:col-span-2">
              <label class="block text-sm font-semibold text-gray-700 mb-1">N° d'acte</label>
              <input type="number"
                required
                class="w-full border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:ring-2 focus:ring-indigo-500"
                placeholder="Ex: 1342" x-model="certificateFirstNum">
            </div>

            <!-- Texte "du" -->
            <div class="md:col-span-1 text-center font-semibold text-gray-700">
              du
            </div>

            <!-- Jour -->
            <div class="md:col-span-1">
              <label class="block text-sm font-semibold text-gray-700 mb-1">Jour</label>
              <select
                class="w-full border border-gray-300 rounded-md px-3 py-2 shadow-sm bg-white focus:ring-2 focus:ring-indigo-500"
                x-model="certificateDay">
                <option></option>
                <template x-for="day in dayList" :key="day">
                  <option x-text="day" :value="day"></option>
                </template>
              </select>
            </div>

            <!-- Mois -->
            <div class="md:col-span-1">
              <label class="block text-sm font-semibold text-gray-700 mb-1">Mois</label>
              <select
                class="w-full border border-gray-300 rounded-md px-3 py-2 shadow-sm bg-white focus:ring-2 focus:ring-indigo-500"
                x-model="certificateMonth">
                <option></option>
                <template x-for="month in monthList" :key="month">
                  <option x-text="month" :value="month"></option>
                </template>
              </select>
            </div>

            <!-- Année -->
            <div class="md:col-span-1">
              <label class="block text-sm font-semibold text-gray-700 mb-1">Année</label>
              <input type="number"
                required
                class="w-full border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:ring-2 focus:ring-indigo-500"
                placeholder="2025" x-model="certificateYear" min="1900" maxlength="4">
            </div>
          </div>
        </fieldset>

      </fieldset>

      <!-- AUTRES INFOS -->
      <fieldset class="border border-gray-300 rounded-xl p-4 space-y-4">
        <legend class="text-indigo-600 font-semibold text-lg tracking-wide uppercase">
          Autres informations
        </legend>

        <!-- Téléphones -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Numéro de téléphone</label>
            <input type="text"
              required
              class="w-full border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:ring-2 focus:ring-indigo-500"
              placeholder="Contact 1" x-model="phoneNum1">
          </div>
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Numéro de téléphone 2</label>
            <input type="text"
              class="w-full border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:ring-2 focus:ring-indigo-500"
              placeholder="Contact 2" x-model="phoneNum2">
          </div>
        </div>

        <!-- Email sur une ligne à part -->
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
          <input type="email"
            class="w-full border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:ring-2 focus:ring-indigo-500"
            placeholder="exemple@domaine.com" x-model="email">
        </div>

        <!-- Résidence & Quartier -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Lieu d'habitation</label>
            <select
              class="w-full border border-gray-300 rounded-md px-3 py-2 bg-white shadow-sm focus:ring-2 focus:ring-indigo-500"
              x-model="residence">
              <option disabled selected value="">Choisir un lieu</option>
              <template x-for="(q, key) in residenceNeighborhood" :key="key">
                <option :value="key" x-text="key"></option>
              </template>
            </select>
          </div>
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Quartier</label>
            <select :disabled="!residence"
              class="w-full border border-gray-300 rounded-md px-3 py-2 bg-white shadow-sm focus:ring-2 focus:ring-indigo-500"
              x-model="neighborhood">
              <option value="">Choisir un quartier</option>
              <template x-if="residence">
                <template x-for="q in residenceNeighborhood[residence]" :key="q">
                  <option x-text="q"></option>
                </template>
              </template>
              <template x-if="!residence">
                <option disabled selected>Choisir le lieu  d'abord</option>
              </template>
            </select>
          </div>
        </div>

        <!-- Ville cible & Mairie -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Choisir une ville pour la demande</label>
            <select
              class="w-full border border-gray-300 rounded-md px-3 py-2 bg-white shadow-sm focus:ring-2 focus:ring-indigo-500"
              x-model="cityForAsk">
              <option disabled selected value="">Choisir une ville</option>
              <template x-for="(m, key) in cityMunicipalOffice" :key="key">
                <option :value="key" x-text="key"></option>
              </template>
            </select>
          </div>
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Mairie pour la demande</label>
            <select :disabled="!cityForAsk"
              class="w-full border border-gray-300 rounded-md px-3 py-2 bg-white shadow-sm focus:ring-2 focus:ring-indigo-500"
              x-model="municipalOffice">
              <option value="">Selectionner la Mairie</option>
              <template x-if="cityForAsk">
                <template x-for="m in cityMunicipalOffice[cityForAsk]" :key="m">
                  <option x-text="m"></option>
                </template>
              </template>
              <template x-if="!cityForAsk">
                <option disabled selected>Choisir la ville d'abord</option>
              </template>
            </select>
          </div>
        </div>

        <!-- Nombre de copies -->
        <div class="w-full md:w-1/3">
          <label class="block text-sm font-semibold text-gray-700 mb-1">
            Nombre de copie(s) <span class="text-red-500">*</span>
          </label>
          <input type="number"
            required
            class="w-full border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:ring-2 focus:ring-indigo-500"
            placeholder="Nombre de copies" x-model="numberOfCopies" min="1">
        </div>

        <!-- Message d’erreur -->
        <div class="text-red-500 text-sm" x-show="errorMessage" x-text="errorMessage"></div>
      </fieldset>

      <div class="text-center mt-6">
        <button type="submit"
          class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200"
          aria-label="Envoyer la demande">
          Envoyer la demande
        </button>
      </div>
    </form>
  </div>
</div>