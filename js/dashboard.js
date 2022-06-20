/*****************************************************/
/*                  GRAPHIQUE                        */
/*****************************************************/

var mesdonnes = []

document.addEventListener("DOMContentLoaded", () => {
    //reccuperer les valeurs de accepter, refuser et en attente
    var accepte = parseInt(document.getElementById("accepte").innerText)
    var refuser = parseInt(document.getElementById("refuser").innerText)
    var enAttente = parseInt(document.getElementById("attente").innerText)
    //on appel la fonction setData
    setDatas(accepte, refuser, enAttente)
})

var graphique = document.getElementById("graphique")

// son conteste 2d ou 3d
var ctx = graphique.getContext("2d");

var monGraph = new Chart(ctx, {
    type: "pie",
    data: {
        datasets: [
            {
                data: mesdonnes,
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'

                ],
                label: "Mon super Graphique"
            }
        ],
        labels: ["accepté", "refusé", "attente"],

    }
})

function setDatas(a, b, c) {
    mesdonnes[0] = a;
    mesdonnes[1] = b;
    mesdonnes[2] = c;
    monGraph.update()
}

/*****************************************************/
/*                  BTN                              */
/*****************************************************/

var acceptebtns = document.querySelectorAll(".accepte")
var refusebtns = document.querySelectorAll(".refuse")
var popup = document.querySelector(".popup")
var mask = document.querySelector(".mask")

acceptebtns.forEach(abtn=> {
    abtn.addEventListener("click", ()=> {
        popup.style.display="block"
        mask.style.display="block"
        popup.querySelector("#choix_validation").textContent = "l'acceptation"
        popup.querySelector("#id").value = abtn.getAttribute("data-id")
        popup.querySelector("#statut").value = "1"
        
    })
})

refusebtns.forEach(rbtn=> {
    rbtn.addEventListener("click", ()=> {
        popup.style.display="block"
        mask.style.display="block"
        popup.querySelector("#choix_validation").textContent = "le refus"
        popup.querySelector("#id").value = rbtn.getAttribute("data-id")
        popup.querySelector("#statut").value = "0"
        
    })
})


// function retourForm(data) {
//     formRefuses.forEach(formRefuse => {
//         formRefuse.innerHTML = data
//     })
// }