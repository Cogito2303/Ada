import './bootstrap';
import 'bootstrap';
import birthCertificateWithNumForm from './components/birthCertificateWithNumJs'
import birthCertificateSearch from './components/searchDocumentJs';
import registerForm from './components/registerFormJs';


// Import Alpine.js pour gerer les interactions front-end et l'injection dynamique des formulaires de chaque document
// Livewire ≥ v2.8 charge Alpine.js dans livewire.js donc pas besoin de l'importer manuellement
// import Alpine from 'alpinejs';
// window.Alpine = Alpine;

// on charge les scripts du fichier components/extraitAvecNumeroJs.js
window.birthCertificateWithNumForm = birthCertificateWithNumForm
// On charge le script de Rechercher un document depuis le fichier components/rechercheDocumentJs.js
Alpine.data('birthCertificateSearch', birthCertificateSearch);
Alpine.data('registerForm', registerForm);                                          

// On lance Alpine Js
// Alpine.start()

