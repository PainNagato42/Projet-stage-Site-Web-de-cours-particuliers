document.querySelector("#thematique").addEventListener("input", ()=> {
    
    if(document.querySelector("#thematique").value.length >= 3) {
        // faire la requete ajax
        $.ajax("https://www.prof-direct.com/api/ajax_thematique/", {
            method: "post",
            data: { theme: document.querySelector("#thematique").value},
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
        document.querySelector("#thematique").value = p
        document.querySelector("#theme").textContent = ""
})

document.querySelector("body").addEventListener("click", ()=> {
    document.querySelector("#theme").textContent = ""
})


