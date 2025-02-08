document.addEventListener("DOMContentLoaded", async () => {
    try {
        // Récupérer les statistiques depuis l'API Symfony
        let response = await fetch('/admin/stats');
        let stats = await response.json(); // Convertir la réponse en JSON

        // Insérer les données dans la page
        document.getElementById('total-credits').textContent = stats.totalCredits;
        document.getElementById('covoiturages-par-jour').textContent = stats.covoituragesParJour;
    } catch (error) {
        console.error("Erreur lors du chargement des statistiques :", error);
    }
});
