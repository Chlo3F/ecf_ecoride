document.addEventListener("DOMContentLoaded", function () {
    const searchBtn = document.getElementById("search-btn");
    const searchInput = document.getElementById("search-input");
    const resultsContainer = document.getElementById("results-container");
    const searchResults = document.getElementById("search-results");

    const filterBtn = document.getElementById("filter-btn");
    const filterOptions = document.getElementById("filter-options");
    const applyFiltersBtn = document.getElementById("apply-filters");

    // Cacher les filtres par défaut
    filterOptions.style.display = "none";

    // Toggle pour afficher/masquer les options de filtre
    filterBtn.addEventListener("click", function () {
        if (filterOptions.style.display === "none") {
            filterOptions.style.display = "block";
        } else {
            filterOptions.style.display = "none";
        }
    });

    // Recherche et affichage des résultats
    searchBtn.addEventListener("click", function () {
        const searchTerm = searchInput.value.trim();

        if (searchTerm !== "") {
            resultsContainer.style.display = "block";
            searchResults.innerHTML = `
                <li class="list-group-item">Covoiturage trouvé: Paris → Lyon</li>
                <li class="list-group-item">Covoiturage trouvé: Marseille → Bordeaux</li>
            `;
        }
    });

    // Application des filtres (simulation)
    applyFiltersBtn.addEventListener("click", function () {
        const ecoFilter = document.querySelector('input[name="eco"]:checked')?.value;
        const maxDuration = document.getElementById("duration").value;
        const maxCredits = document.getElementById("max-credits").value;
        const minRating = document.getElementById("min-rating").value;

        // Logique de filtrage simulée (à adapter avec une requête AJAX)
        resultsContainer.style.display = "block";
        searchResults.innerHTML = `
            <li class="list-group-item">
                Covoiturage (Eco: ${ecoFilter === "yes" ? "Oui" : "Non"})<br>
                Durée max: ${maxDuration || "Aucune"}h - Crédits max: ${maxCredits || "Aucun"}<br>
                Note min: ${minRating} ★
            </li>
        `;
    });
});
