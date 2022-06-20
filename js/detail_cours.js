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

/* NOTE ETOILES */ 

// determiner le nombre d'etoile fill
var biStars = document.querySelectorAll(".bi-star");

// donner la valeur à l'input cacher
biStars.forEach(star => {
    star.addEventListener("click", ()=> {
    document.querySelector("#hiddenNote").value = document.querySelectorAll(".bi-star-fill").length
})

})

/* POPUP */
var btnDemande = document.getElementById("demande");
var popup = document.querySelector(".popup")
var mask = document.querySelector(".mask")

btnDemande.addEventListener("click", ()=> {
    popup.style.display="block"
    mask.style.display="block"
})
