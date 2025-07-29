<div class="container">
  <h3 class="mb-2 text-center">Demande de document</h3>
  <form x-data="{ type: '' }">
  <select class="form-select mb-3" x-model="type">
    <option ><-------------- Choisir un document --------------></option>
    <option value="withNumber">Extrait avec numéro</option>
    <option value="withPicture">Extrait avec photo</option>
  
  </select>

  {{-- On injecte les formulaire ici et on les gere grace a Alpine.js --}}
  <template x-if="type === 'withNumber' ">
    <x-birth-certifate-with-num-form />
  </template>

  <template x-if="type === 'withPicture'">
    <x-birth-certifate-with-picture-form />
  </template>
</form>

</div>
