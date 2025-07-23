import './bootstrap';
import 'bootstrap';
import formulaireExtraitAvecNumero from './components/extraitAvecNumeroJs'



// Import Alpine.js pour gerer les interactions front-end et l'injection dynamique des formulaires de chaque document
import Alpine from 'alpinejs';
window.Alpine = Alpine;

// on charge les scripts du fichier components/extraitAvecNumeroJs.js
window.formulaireExtraitAvecNumero = formulaireExtraitAvecNumero



window.formComponent = () => ({
     role: '',
      studentId: '',
      department: '',
      errors: {},

      validateStudentId() {
        this.errors.studentId = this.studentId.length < 5
          ? 'Le numéro doit contenir au moins 5 caractères.'
          : '';
      },

      validateDepartment() {
        this.errors.department = this.department.trim() === ''
          ? 'Le département est requis.'
          : '';
      },

      submitForm() {
        this.validateStudentId();
        this.validateDepartment();

        if (this.role === '') {
          alert('Veuillez choisir un rôle.');
          return;
        }

        if ((this.role === 'student' && this.errors.studentId) ||
            (this.role === 'teacher' && this.errors.department)) {
          return;
        }

        alert('Formulaire soumis avec succès !');
        // Tu peux ici envoyer les données via AJAX ou laisser Laravel gérer
      }
});
Alpine.start()

