export default function birthCertificateSearch() {
    return {
        askingNumber: '',
        birthCertificate: null,
        loading: false,
        error: null,

        async searchbirthCertificate() {
            this.loading = true;
            this.error = null;
            this.birthCertificate = null;

            try {
                const response = await fetch(`/api/birth-certificate/${this.askingNumber}`);
                if (!response.ok) throw new Error("birthCertificate introuvable");

                this.birthCertificate = await response.json();
            } catch (err) {
                this.error = err.message;
            } finally {
                this.loading = false;
            }
        },
        // telecharger le fichier
        printBirthCertificate() {
            window.print();
        },


    };
}