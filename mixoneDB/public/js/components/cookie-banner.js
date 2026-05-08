/******/ (() => { // webpackBootstrap
/*!**************************************************!*\
  !*** ./resources/js/components/cookie-banner.js ***!
  \**************************************************/
/**
 * Logique de la bannière de cookies
 */

(function () {
  'use strict';

  /**
   * Initialise la bannière de cookies
   */
  function initCookieBanner() {
    var banner = document.getElementById('cookie-banner');
    if (!banner) return;

    // Si l'utilisateur n'a pas encore fait de choix, on affiche la bannière
    if (!localStorage.getItem('cookies_accepted')) {
      banner.style.display = 'block';
    }
    var acceptBtn = banner.querySelector('button.js-accept-cookies');
    var refuseBtn = banner.querySelector('button.js-refuse-cookies');

    // Gestion du bouton "Accepter"
    if (acceptBtn) {
      acceptBtn.addEventListener('click', function () {
        localStorage.setItem('cookies_accepted', 'true');
        banner.style.display = 'none';
      });
    }

    // Gestion du bouton "Refuser"
    if (refuseBtn) {
      refuseBtn.addEventListener('click', function () {
        localStorage.setItem('cookies_accepted', 'refused');
        banner.style.display = 'none';
      });
    }
  }
  document.addEventListener('DOMContentLoaded', initCookieBanner);
})();
/******/ })()
;