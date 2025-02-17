document.addEventListener("DOMContentLoaded", function () {
    const passagerCheckbox = document.getElementById("passager");
    const chauffeurCheckbox = document.getElementById("chauffeur");

    const sectionVehicule = document.getElementById("section-vehicule");
    const sectionPreferences = document.getElementById("section-preferences");
    const sectionVoyage = document.getElementById("section-voyage");

    function updateVisibility() {
        if (chauffeurCheckbox.checked) {
            sectionVehicule.classList.remove("hidden");
            sectionPreferences.classList.remove("hidden");
            sectionVoyage.classList.remove("hidden");
        } else {
            sectionVehicule.classList.add("hidden");
            sectionPreferences.classList.add("hidden");
            sectionVoyage.classList.add("hidden");
        }
    }

    // Écouteurs d'événements pour détecter les changements
    passagerCheckbox.addEventListener("change", function () {
        if (passagerCheckbox.checked) {
            chauffeurCheckbox.checked = false; // Désactive chauffeur
        }
        updateVisibility();
    });

    chauffeurCheckbox.addEventListener("change", function () {
        if (chauffeurCheckbox.checked) {
            passagerCheckbox.checked = false; // Désactive passager
        }
        updateVisibility();
    });

    // Initialiser la visibilité au chargement de la page
    updateVisibility();
});
