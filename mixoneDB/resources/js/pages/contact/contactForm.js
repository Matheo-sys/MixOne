document.addEventListener('DOMContentLoaded', function() {
    // Animation pour le message de succès
    const successMessage = document.getElementById('success-message');
    if (successMessage) {
        successMessage.style.opacity = '0';
        successMessage.style.transform = 'translateY(20px)';
        successMessage.style.transition = 'all 0.5s ease';

        setTimeout(() => {
            successMessage.style.opacity = '1';
            successMessage.style.transform = 'translateY(0)';
        }, 100);

        setTimeout(() => {
            successMessage.style.opacity = '0';
            successMessage.style.transform = 'translateY(-20px)';
            setTimeout(() => {
                successMessage.style.display = 'none';
            }, 500);
        }, 5000);
    }
});
