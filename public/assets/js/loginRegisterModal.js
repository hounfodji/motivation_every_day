// Obtenez la modale, le bouton pour l'ouvrir et le bouton pour la fermer
var modal = document.getElementById("myModal");
var btn = document.getElementById("loginRegisterBtn");
var closeBtn = document.getElementsByClassName("close")[0];

// Lorsque l'utilisateur clique sur le bouton, ouvrez la modale
btn.onclick = function() {
    modal.style.display = "block";
}

// Lorsque l'utilisateur clique sur le bouton de fermeture, fermez la modale
closeBtn.onclick = function() {
    modal.style.display = "none";
}

// Lorsque l'utilisateur clique en dehors de la modale, fermez-la
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// Fonction pour basculer entre les formulaires de connexion et d'inscription
function toggleForms() {
    var loginForm = document.getElementById("loginForm");
    var registerForm = document.getElementById("registerForm");

    if (loginForm.style.display === "none") {
        loginForm.style.display = "block";
        registerForm.style.display = "none";
    } else {
        loginForm.style.display = "none";
        registerForm.style.display = "block";
    }
}
