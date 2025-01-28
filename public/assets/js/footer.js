// footer.js
function loadfooter() {
    fetch('../footer.html') // Chemin relatif vers header.html
        .then(response => response.text())
        .then(data => {
            document.getElementById('footer').innerHTML = data;
        });
}

// Appeler la fonction au chargement de la page
window.addEventListener('DOMContentLoaded', loadfooter);