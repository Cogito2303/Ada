import residenceNeighborhoodMap from '../maps/residenceNeighborhoodMap';
import cityMunicipalOfficeMap from '../maps/cityMunicipalOfficeMap';
import axios from 'axios';

// injection dynamique des lieu d'habitation, quartiers, villes et mairies
//  le quartier dependant du lieu d'habitation et la mairie de la ville
// injecter dans le frmulaire de chaque document
// ici le données à manipuler dans le formulaire formulaireExtraitAvecNumero

const birthCertificateWithNumForm = () => ({
    // variable des champs select dans le formulaire
  residenceNeighborhood: residenceNeighborhoodMap, // injection des quartiers par ville depuis le fichier maps/villeQuartierMap.js
  cityMunicipalOffice: cityMunicipalOfficeMap, // injection des villes et mairies depuis le fichier maps/villeMairieMap.js

  monthList: ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'],
  dayList:['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12',
    '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25',
    '26', '27', '28', '29', '30', '31'],

    // champs du formulaire a recuperer
    childLastName :'',
    childFirstName: '',
    childBirthday: '',

    fatherLastName: '',
    fatherFirstName: '',
    motherLastName: '',
    motherFirstName: '',

    certificateFirstNum: '',
    certificateDay: '',
    certificateMonth: '',
    certificateYear: '',

    phoneNum1: '',
    phoneNum2: '',
    email: '',
    residence: '',
    neighborhood: '',
    cityForAsk: '',
    municipalOffice: '',
    numberOfCopies: '',

    // champs d'affichage d'erreur
    errorMessage: '',
    // soumission du formulaire
    async submitBirthCertificateWithNumForm(){
        // Verification des champs
        if(this.childLastName ===''){
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
            child_name : this.childLastName + " " + this.childFirstName,
            child_birthday :this.childBirthday,
            father_name :this.fatherLastName + " " + this.fatherFirstName,
            mother_name :this.motherLastName + " " + this.motherFirstName,
            birth_certificate_num : this.certificateFirstNum + " du " + this.certificateDay + "/" + this.certificateMonth + "/" + this.certificateYear,
            phone_num_1 : this.phoneNum1,
            phone_num_2 : this.phoneNum2,
            email : this.email,
            residence : this.residence,
            neighborhood : this.neighborhood,
            city : this.cityForAsk,
            municipal_office : this.municipalOffice,
            number_of_copies : this.numberOfCopies
          }
        
          // Envoi des données à l'api en utilisant axios
          // DEBUT TRY CATCH
          try {
  const response = await axios.post('/api/birth-certificate-with-number', data, {
    headers: {
      'Content-Type': 'application/json',
      'Accept': 'application/json'
    }
  });

  if (response.status === 201) {
    // localStorage.setItem('extraitData', JSON.stringify(data));
    // alert('Données reçues : ' + response.status);
    console.log(response);
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

export default birthCertificateWithNumForm
