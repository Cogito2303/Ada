<div class="container">
  <h3 class="mb-2 text-center">Demande de document</h3>
  <form x-data="{ type: '' }">
  <select class="form-select mb-3" x-model="type">
    <option ><-------------- Choisir un document --------------></option>
    <option value="numero">Extrait avec numéro</option>
    <option value="photo">Extrait avec photo</option>
    <option value="certificat">Certificat</option>
    <option value="casier">Casier judiciaire</option>
  </select>

  {{-- On injecte les formulaire ici et on les gere grace a Alpine.js --}}
  <template x-if="type === 'numero'">
    <x-form-extrait-numero />
  </template>

  <template x-if="type === 'photo'">
    <x-form-extrait-photo />
  </template>

  <template x-if="type === 'certificat'">
    <x-form-certificat />
  </template>

  <template x-if="type === 'casier'">
    <x-form-casier />
  </template>
</form>

</div>
