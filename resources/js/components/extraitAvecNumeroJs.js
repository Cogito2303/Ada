import villeQuartierMap from '../maps/villeQuartierMap';
import villeMairieMap from '../maps/villeMairieMap';
import axios from 'axios';

// injection dynamique des lieu d'habitation, quartiers, villes et mairies
//  le quartier dependant du lieu d'habitation et la mairie de la ville
// injecter dans le frmulaire de chaque document
// ici le données à manipuler dans le formulaire formulaireExtraitAvecNumero

const formulaireExtraitAvecNumero = () => ({
    // variable des champs select dans le formulaire
  lieu: '',
  quartier: '',
  ville: '',
  mairie: '',
  villeQuartier: villeQuartierMap, // injection des quartiers par ville depuis le fichier maps/villeQuartierMap.js
  villeMairie: villeMairieMap, // injection des villes et mairies depuis le fichier maps/villeMairieMap.js

  moisList: ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'],
  jourList:['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12',
    '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25',
    '26', '27', '28', '29', '30', '31'],

    // champs du formulaire a recuperer
    nomEnfant :'',
    prenomEnfant: '',
    dateNaissance: '',

    nomPere: '',
    prenomPere: '',
    nomMere: '',
    prenomMere: '',

    numeroActe: '',
    jourActe: '',
    moisActe: '',
    anneeActe: '',

    contact1: '',
    contact2: '',
    email: '',
    lieuHabitationChoisie: '',
    quartierChoisie: '',
    villeChoisie: '',
    mairieChoisie: '',

    // champs d'affichage d'erreur
    errorMessage: '',
    // soumission du formulaire
    async submitFormulaireExtraitAvecNumero(){
        // Verification des champs
        if(this.nomEnfant ===''){
            this.errorMessage = 'Veuillez renseigner tous les champs obligatoires (*)'
        }
        // Verification du numero de acte
        // else if(this.numeroActe ===''||
        //     this.numeroActe ==='Jour...' ||
        //     this.moisActe ==='Mois....'||
        //     this.anneeActe ==='')
        //     {
        //     this.errorMessage = 'Saisissez un numéro d\'acte correcte '
        // }
        // on envoi le formulaire
        else{
            // On formate les données en Json et on les envoie en Asynchrone en utilisant Axios
          const data = {
            nom_enfant : this.nomEnfant + " " + this.prenomEnfant,
            date_naissance :this.dateNaissance,
            nom_pere :this.nomPere + " " + this.prenomPere,
            nom_mere :this.nomMere + " " + this.prenomMere,
            numero_extrait : this.numeroActe + " du " + this.jourActe + "/" + this.moisActe + "/" + this.anneeActe,
            contact_1 : this.contact1,
            contact_2 : this.contact2,
            email : this.email,
            lieu_habitation : this.lieu,
            quartier : this.quartier,
            ville : this.ville,
            mairie : this.mairie
          }
          // Envoi des données à l'api en utilisant axios
          // DEBUT TRY CATCH
          try {
  const response = await axios.post('/api/extrait-avec-numero', data, {
    headers: {
      'Content-Type': 'application/json',
      'Accept': 'application/json'
    }
  });

  if (response.status === 201) {
    // localStorage.setItem('extraitData', JSON.stringify(data));
    alert('Données reçues : ' + response.status);
  } else {
    console.log('Statut inattendu :', response.status);
  }

} catch (error) {
  if (error.response) {
    console.log("Erreur de validation ou de requête :", error.response.data);

    // Optionnel : extraire les erreurs de validation Laravel
    if (error.response.data.errors) {
      for (const [field, messages] of Object.entries(error.response.data.errors)) {
        console.log(`Champ "${field}" : ${messages.join(', ')}`);
      }
    }
  } else if (error.request) {
    console.log("Pas de réponse reçue du serveur :", error.request);
  } else {
    console.log("Erreur lors de la configuration de la requête :", error.message);
  }
}

// FIN TRY CATCH

        }
    }

});

export default formulaireExtraitAvecNumero
