import residenceNeighborhoodMap  from '../maps/residenceNeighborhoodMap'

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

        init() {
            this.$watch('residence', () => this.loadNeighborhoods());
        }
    };
}
export default registerForm;