
/* AJAX */

document.querySelectorAll("#form_profil .auto-save").forEach(elt=>{
    elt.addEventListener("change", envoyerLesInfo)
})

function envoyerLesInfo(e){
    var datas = {};
    datas[e.target.name] = e.target.value;
    datas["table"] = e.target.getAttribute("data-table");
    $.ajax("https://www.prof-direct.com/api/ajax_modif/"+id, {
    method: "post",
    data: datas,
    dataType: "JSON",
    success: (rep)=>{
        var p = document.querySelector("p[data-id="+e.target.name+"]")
        if(rep.errors) {
            //p.style.display = "block";
            p.innerText = rep.errors[e.target.name]
        } else {
            //p.style.display = "none";
            p.innerText = "";
        }
    },
    error: (err)=> {
        console.log(err)
    } 
})
}



/* MOTS CLES */

// variable global
var liste=[]



var input = document.getElementById("saisie-mots")
var plus = document.getElementById("ajouter-mot")
var zone = document.querySelector(".mots-cles")
var perror = document.querySelector("p[data-id=motcles]")

var id = document.querySelector("#hidden").value

// au chargelment de la page
document.addEventListener("DOMContentLoaded", ()=> {
    recupMots()
})

plus.addEventListener("click", ()=> {
    if(input.value != "") {
        //envoyer la liste avec le nouveau mot a php
        liste.push(input.value) // on risque d'envoyer de la merde a php
        
        envoyerLaListe()
        // si pas d'erreur: On ajouter le mot a l'ecran
    }
})

function recupMots() {

    $.ajax("https://www.prof-direct.com/api/liste_motcles/"+id, {
        method: "GET",
        dataType: "JSON",
        success: (rep) => {
            if(rep!=null){
                liste = rep.split(";")
                // affiche la liste des mots dans la zone
                afficheMots()
            }
            
        },
        error: (err) => {
            if(err) {
                console.log("erreur de requete"+err)
            }
        }
    })
}

function afficheMots() {
    zone.innerHTML = ""
    liste.forEach(elt => {
        //zone.innerHTML += `<div class="mots">${elt}<span>X</span></div>`
        var div = document.createElement("div");
        div.classList.add("mots");
        div.innerHTML = elt

        var span = document.createElement("span")
        span.innerText ="X"
        span.addEventListener("click", ()=>{
            supprimeLeMot(div)
        })
        div.appendChild(span)
        zone.appendChild(div)
    })
}

function supprimeLeMot(ligne) {
    console.log(ligne.innerText.slice(0,ligne.innerText.length-1))
    var mot = ligne.innerText.slice(0,ligne.innerText.length-1)
    liste = liste.filter(e=>{
        return e !== mot
    })

    envoyerLaListe()
}

function envoyerLaListe() {
    $.ajax("https://www.prof-direct.com/api/ajax_motcles/"+id, {
        method: "POST",
        dataType: "JSON",
        data: {
            motcles: liste.join(";")
        },
        success: (rep) => {
            if(rep.success) {
             
                perror.innerHTML ="";
                // on rajoute le mot a l'ecran : 
                afficheMots()
                input.value=""
            } else if (rep.errors) {
                console.error(rep.errors)
                afficheLesErreurs(perror, rep.errors.motcles)
                //perror.innerText = rep.errors.motcles
                liste.splice(liste.lenght-1,1)
            }
        },
        error: (err) => {
            console.error(err)
        }
    })
}

function afficheLesErreurs(elt, erreur) {
    elt.innerText = erreur
    setTimeout(()=> {
        elt.innerText = ""
    }, 3000)
}