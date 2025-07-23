<div x-data="formComponent()" class="container mt-5">
  <div class="card shadow-sm">
    <div class="card-body">
      <h5 class="card-title mb-4">Inscription</h5>

      <!-- Sélection du rôle -->
      <div class="mb-3">
        <label class="form-label">Rôle</label>
        <select x-model="role" class="form-select">
          <option value="">-- Choisir --</option>
          <option value="student">Étudiant</option>
          <option value="teacher">Enseignant</option>
        </select>
      </div>

      <!-- Champ Étudiant -->
      <div x-show="role === 'student'" class="mb-3">
        <label class="form-label">Numéro étudiant</label>
        <input type="text" x-model="studentId" @input="validateStudentId"
               class="form-control" :class="{'is-invalid': errors.studentId}" />
        <div class="invalid-feedback" x-show="errors.studentId" x-text="errors.studentId"></div>
      </div>

      <!-- Champ Enseignant -->
      <div x-show="role === 'teacher'" class="mb-3">
        <label class="form-label">Département</label>
        <input type="text" x-model="department" @input="validateDepartment"
               class="form-control" :class="{'is-invalid': errors.department}" />
        <div class="invalid-feedback" x-show="errors.department" x-text="errors.department"></div>
      </div>

      <!-- Bouton -->
      <button @click="submitForm" class="btn btn-primary mt-3">
        Soumettre
      </button>
    </div>
  </div>
</div>


