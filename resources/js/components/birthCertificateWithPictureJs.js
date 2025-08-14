import residenceNeighborhoodMap from '../maps/residenceNeighborhoodMap';
import cityMunicipalOfficeMap from '../maps/cityMunicipalOfficeMap';
import axios from 'axios';

const birthCertificateWithPictureForm = () => {
    return {
        residenceNeighborhood: residenceNeighborhoodMap, // injection des quartiers par ville depuis le fichier maps/villeQuartierMap.js
        cityMunicipalOffice: cityMunicipalOfficeMap, // injection des villes et mairies depuis le fichier maps/villeMairieMap.js

        monthList: ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'],
        dayList: ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12',
            '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25',
            '26', '27', '28', '29', '30', '31'],
        childLastName: '',
        childFirstName: '',
        childBirthday: '',

        phoneNum1: '',
        phoneNum2: '',
        email: '',
        residence: '',
        neighborhood: '',
        cityForAsk: '',
        municipalOffice: '',
        numberOfCopies: '',
        errorMessage: '',
        picture: null,
        handleFileChange(event) {
            const file = event.target.files[0];
            if (file) {
                this.picture = file;
            }
        },

        async submitForm() {
            const validations = [
                {
                    condition: this.residence === '' || this.residence === 'Choisir un lieu',
                    message: "Choisir un lieu d'habitation"
                },
                {
                    condition: this.neighborhood === '' || this.neighborhood === 'Choisir un quartier',
                    message: "Choisir un quartier"
                },
                {
                    condition: this.cityForAsk === '' || this.cityForAsk === 'Choisir une ville',
                    message: "Choisir une ville"
                },
                {
                    condition: this.municipalOffice === '' || this.municipalOffice === 'Choisir une mairie',
                    message: "Choisir une mairie"
                },
                {
                    condition: this.picture.size > 2 * 1024 * 1024,
                    message: "L’image dépasse la taille maximale autorisée (2 Mo)."
                },
                {
                    condition: !this.picture.type.startsWith('image/'),
                    message: "Le fichier sélectionné n’est pas une image."
                }
            ];
            // Validation dynamique
            for (let check of validations) {
                if (check.condition) {
                    this.errorMessage = check.message;
                    return; // Arrêt si une erreur est trouvée
                }
            }
            // // On forme les données du formulaire
            const formData = new FormData();
            formData.append('child_name', this.childLastName + " " + this.childFirstName);
            formData.append('child_birthday', this.childBirthday);
            formData.append('phone_num_1', this.phoneNum1);
            formData.append('phone_num_2', this.phoneNum2);
            formData.append('email', this.email);
            formData.append('residence', this.residence);
            formData.append('neighborhood', this.neighborhood);
            formData.append('city', this.cityForAsk);
            formData.append('municipal_office', this.municipalOffice);
            formData.append('number_of_copies', this.numberOfCopies);
            formData.append('picture', this.picture);

            console.log('FormData:', formData.get('picture'));

            // Envoi des données en Asynchrone avec Axios
            try {
                const response = await axios.post('/api/birth-certificate/create?with=picture', formData, {
                    headers: {
                        'Accept': 'application/json'
                        // ❌ Ne pas définir 'Content-Type' ici — Axios le gère automatiquement avec FormData
                    }
                });
                if (response.status === 201) {
                    Swal.fire({
                    title: 'Bravo 🎉',
                    text: 'Demande soumise avec succès !',
                    icon: 'success',
                    timer: 3000,
                    showConfirmButton: false
                });
                // Renitialisation du formulaire et actualisation de la page
                document.getElementById('birthCertificateWithPictureForm').reset();
                window.location.reload();
                }
                else{
                    Swal.fire({
                    title: 'Attention ⚠️',
                    text: 'Erreur lors de la soumission !',
                    icon: 'warning',
                    timer: 3000,
                    showConfirmButton: false
                });
                }

            } catch (error) {
                if (error.response) {
                    const status = error.response.status;
                    const data = error.response.data;

                    if (status === 422) {
                        console.error('❌ Erreurs de validation :', data.errors);
                    } else if (status === 400) {
                        console.error('❌ Requête invalide :', data.error);
                    } else if (status === 500) {
                        console.error('❌ Erreur serveur :', data.error || 'Erreur interne');
                    } else {
                        console.error('❌ Erreur HTTP :', status, data);
                    }
                } else {
                    console.error('❌ Erreur inconnue :', error.message);
                }
            }
            // Fin try catch
        }
    }
};


export default birthCertificateWithPictureForm;