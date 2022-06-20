/*  THEMATIQUE */
document.querySelector("#filtre").addEventListener("input", ()=> {
    
    if(document.querySelector("#filtre").value.length >= 3) {
        // faire la requete ajax
        $.ajax("https://www.prof-direct.com/api/ajax_thematique/", {
            method: "post",
            data: { theme: document.querySelector("#filtre").value},
            success: retourThematique
        });
    } else {
        document.querySelector("#theme").textContent = "";
    }
})

function retourThematique(data) {
    // Rôle : mettre à jour le DOM à partir de ce qui est envoyé par le serveur
    // Retour : néant
    // Paramètres :  data (données envoyée par PHP)

    document.querySelector("#theme").innerHTML = data;
}

document.querySelector("#theme").addEventListener("click", (e)=> {
        var p = e.target.textContent
        document.querySelector("#filtre").value = p
        document.querySelector("#theme").textContent = ""
})

document.querySelector("body").addEventListener("click", ()=> {
    document.querySelector("#theme").textContent = ""
})

/* POPUP FILTRE */

document.querySelector("#btn_filtre").addEventListener("click", ()=> {
    document.querySelector(".popup_filtre").classList.toggle("block")
})


// on cherche a remplir les etoiles au clic jusqu'a  l"etoile selectionnee

// Recuperer les etoiles dans le document
var etoiles = document.querySelectorAll(".noter i")
// ecouter le click : mettre un ecouteur d'evenement "click" sur chacune des etoiles
etoiles.forEach((etoile, position) => {
    etoile.addEventListener("click", function () {
        resetEtoile()
        //Je rempli toutes les etoiles de la premiere jusqu'a celle sur laquelle j'ai cliqué

        for (var i = 0; i <= position; i++) {
            etoiles[i].classList.remove('bi-star')
            etoiles[i].classList.add("bi-star-fill")
        }

    })
})

function resetEtoile(){
    etoiles.forEach(etoile=>{
        etoile.classList.remove('bi-star-fill')
        etoile.classList.add("bi-star")
    })
}