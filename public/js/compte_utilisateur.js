
// Permet d'afficher un aperçu de l'image uploadée
document.getElementById("avatar-upload").addEventListener("change", function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById("avatar-preview").src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});


// Toggle affichage formulaire véhicule
function toggleVehiculeForm() {
    document.getElementById('vehicule-form').classList.toggle('hidden');
}

// Valider et ajouter un véhicule à la liste
function validerVehicule() {
    let plaque = document.getElementById('plaque').value;
    let date = document.getElementById('date').value;
    let modele = document.getElementById('modele').value;
    let marque = document.getElementById('marque').value;
    let couleur = document.getElementById('couleur').value;
    let places = document.getElementById('places').value;

    if (modele && marque) {
        let vehiculeList = document.getElementById('vehicule-list');
        let newVehicule = document.createElement('div');
        newVehicule.innerHTML = `
            <p><strong>${marque} ${modele}</strong> (${plaque}, ${couleur}, ${places} places)</p>
        `;
        vehiculeList.appendChild(newVehicule);

        // Reset form & hide
        document.getElementById('vehicule-form').classList.add('hidden');
        document.getElementById('vehicule-form').reset();
    }
}

// Ajouter un champ de préférence personnalisé
function addPreferenceInput() {
    let preferencesList = document.getElementById('preferences-list');
    let newInput = document.createElement('input');
    newInput.type = "text";
    newInput.placeholder = "Nouvelle préférence";
    preferencesList.appendChild(newInput);
}

// Valider et afficher les préférences
function validerPreferences() {
    let fumeur = document.getElementById('fumeur').checked ? "Fumeurs acceptés" : "Non fumeur";
    let animaux = document.getElementById('animaux').checked ? "Animaux acceptés" : "Pas d'animaux";

    let preferencesList = document.getElementById('preferences-list');
    let prefText = document.createElement('p');
    prefText.innerHTML = `<strong>${fumeur}, ${animaux}</strong>`;
    preferencesList.appendChild(prefText);
}
