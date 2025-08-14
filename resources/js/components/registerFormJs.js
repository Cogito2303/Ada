import residenceNeighborhoodMap  from '../maps/residenceNeighborhoodMap'
import cityMunicipalOfficeMap from '../maps/cityMunicipalOfficeMap'

function registerForm() {
    return {
        residence: '',
        residences: Object.keys(residenceNeighborhoodMap),
        neighborhood: '',
        neighborhoods: [],

        loadNeighborhoods() {
            this.neighborhoods = residenceNeighborhoodMap[this.residence] || [];
            this.neighborhood =''
        },

        city: '',
        cities: Object.keys(cityMunicipalOfficeMap),
        municipalOffice: '',
        municipalOffices: [],

        loadMunicipalOffices() {
            this.municipalOffices = cityMunicipalOfficeMap[this.city] || [];
            this.municipalOffice = '';
        },

        init() {
            this.$watch('residence', () => this.loadNeighborhoods());
            this.$watch('city', () => this.loadMunicipalOffices());
        }
    };
}
export default registerForm;