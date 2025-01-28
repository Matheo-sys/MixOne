// header.js
function loadHeader() {
    fetch('../header.html') // Chemin relatif vers header.html
        .then(response => response.text())
        .then(data => {
            document.getElementById('header').innerHTML = data;
        });
}

// Appeler la fonction au chargement de la page
window.addEventListener('DOMContentLoaded', loadHeader);

  