<div class="min-h-screen bg-gray-50">
  <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 bg-white shadow-md rounded-xl p-8 space-y-6">

    <h2 class="text-xl font-bold text-center text-indigo-600 uppercase tracking-wide">
      Sélection du type de demande
    </h2>

    <form x-data="{ type: '' }" class="space-y-6">
      <div>
        <label class="block text-gray-700 font-semibold mb-2">Type de document</label>
        <select 
          class="w-full border border-gray-300 rounded-lg px-2 py-1 shadow-sm bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 placeholder-gray-400"
          x-model="type"
        >
          <option disabled selected value="">Choisir un document pour la demande</option>
          <option value="withNumber">Extrait avec numéro</option>
          <option value="withPicture">Extrait avec photo</option>
        </select>
      </div>

      <!-- Formulaires conditionnels via Alpine -->
      <template x-if="type === 'withNumber'">
    <x-birth-certifate-with-num-form />
  </template>

  <template x-if="type === 'withPicture'">
    <x-birth-certifate-with-picture-form />
  </template>

    </form>

  </div>
</div>
