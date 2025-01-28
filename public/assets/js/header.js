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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
// Gestion du slider
const distanceSlider = document.getElementById('distance-slider');
const distanceValue = document.getElementById('distance-value');

distanceSlider.addEventListener('input', function () {
    distanceValue.textContent = this.value; // Met à jour la valeur affichée
});

// Gestion du formulaire
document.getElementById('search-form').addEventListener('submit', function (e) {
    e.preventDefault();
    const query = document.getElementById('search-input').value;
    const distance = document.getElementById('distance-slider').value;
    alert(`Recherche : ${query} dans un rayon de ${distance} km`);
    // Ici, tu peux ajouter une requête AJAX pour filtrer les studios
});
  