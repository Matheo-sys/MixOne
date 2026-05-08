/******/ (() => { // webpackBootstrap
/*!***************************************************!*\
  !*** ./resources/js/pages/contact/contactForm.js ***!
  \***************************************************/
document.addEventListener('DOMContentLoaded', function () {
  // Animation pour le message de succès
  var successMessage = document.getElementById('success-message');
  if (successMessage) {
    successMessage.style.opacity = '0';
    successMessage.style.transform = 'translateY(20px)';
    successMessage.style.transition = 'all 0.5s ease';
    setTimeout(function () {
      successMessage.style.opacity = '1';
      successMessage.style.transform = 'translateY(0)';
    }, 100);
    setTimeout(function () {
      successMessage.style.opacity = '0';
      successMessage.style.transform = 'translateY(-20px)';
      setTimeout(function () {
        successMessage.style.display = 'none';
      }, 500);
    }, 5000);
  }
});
/******/ })()
;