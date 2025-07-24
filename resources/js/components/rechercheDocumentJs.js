export default function extraitSearch() {
    return {
        numeroDemande: '',
        extrait: null,
        loading: false,
        error: null,

        async searchExtrait() {
            this.loading = true;
            this.error = null;
            this.extrait = null;

            try {
                const response = await fetch(`/api/extrait/${this.numeroDemande}`);
                if (!response.ok) throw new Error("Extrait introuvable");

                this.extrait = await response.json();
            } catch (err) {
                this.error = err.message;
            } finally {
                this.loading = false;
            }
        },
        // telecharger le fichier
        telechargerPDF() {
            window.print();
        },

        // Exporter en pdj
        exporterPDF() {
            const element = document.getElementById('extrait-pdf');
            const opt = {
                margin:       [0.5, 0.5],
                filename:     `${this.numeroDemande}.pdf`,
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale: 2 },
                jsPDF:        { unit: 'in', format: 'a4', orientation: 'portrait' }
            };
            html2pdf().set(opt).from(element).save();
        }


    };
}