export function initNotificationListener() {
    window.Echo.channel('super-admin')
        .listen('NewBirthCertificateCreated', (e) => {
            // window.dispatchEvent(new CustomEvent('new-birth-certificate', {
            //     detail: e
            // }));
            console.log('Event reçu', e);

        });


}