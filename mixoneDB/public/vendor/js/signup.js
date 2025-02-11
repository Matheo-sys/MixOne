function openTab(tabName) {
    // Cache tous les contenus des onglets
    var tabContents = document.getElementsByClassName("tab-content");
    for (var i = 0; i < tabContents.length; i++) {
        tabContents[i].style.display = "none";
    }

    // Désactive tous les boutons d'onglets
    var tabButtons = document.getElementsByClassName("tab-button");
    for (var i = 0; i < tabButtons.length; i++) {
        tabButtons[i].classList.remove("active");
    }

    // Affiche le contenu de l'onglet sélectionné et active le bouton correspondant
    document.getElementById(tabName).style.display = "block";
    event.currentTarget.classList.add("active");
}

// Gestion de la soumission des formulaires
document.getElementById('artist-form').addEventListener('submit', function(event) {
    event.preventDefault();
    alert('Inscription Artiste réussie !');
    // Ici, vous pouvez ajouter la logique pour envoyer les données au serveur
});

document.getElementById('studio-form').addEventListener('submit', function(event) {
    event.preventDefault();
    alert('Inscription Studio réussie !');
    // Ici, vous pouvez ajouter la logique pour envoyer les données au serveur
});