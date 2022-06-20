var liste = [];
var input = document.getElementById("saisie-mots");

// Au chargement de la page On charge la liste des mots clés qui existe déjà
document.addEventListener("DOMContentLoaded", () => {
  chargerLesMotsCles()
});
// deja =["mot1", "mot2" ...]
function chargerLesMotsCles() {
  // on vide la div mot_cles
  document.querySelector(".mot_cles").innerHTML =""
  let id = document.querySelector("#hidden").value;
  $.ajax("https://www.prof-direct.com/api/liste_motcles/" + id, {
    method: "GET",
    dataType: "JSON",
    success: (rep) => {
      if (rep) {
        liste = rep.split(";");
        liste.forEach((elt) => {
          afficherMots(elt);
        });
      }
    },
    error: (err) => {
      console.log(err);
    },
  });
}

document.getElementById("ajouter-mot").addEventListener("click", () => {
  liste.push(input.value);
  ajaxMotcles();
  input.value = "";
});

document.querySelectorAll("#form_profil .auto-save").forEach((elt) => {
  elt.addEventListener("change", envoyerLesInfo);
});

function envoyerLesInfo(e) {
  let id = document.querySelector("#hidden").value;
  var datas = {};
  datas[e.target.name] = e.target.value;
  datas["table"] = e.target.getAttribute("data-table");
  $.ajax("https://www.prof-direct.com/api/ajax_modif/" + id, {
    method: "post",
    data: datas,
    dataType: "JSON",
    success: (rep) => {
      var p = document.querySelector("p[data-id=" + e.target.name + "]");
      if (rep.errors) {
        //p.style.display = "block";
        p.innerText = rep.errors[e.target.name];
      } else {
        //p.style.display = "none";
        p.innerText = "";
      }
    },
    error: (err) => {
      console.log(err);
    },
  });
}

function afficherMots(val) {
   document.querySelector(".mots-cles").innerHTML += `<div class="mots">${input.value}<span>x</span></div>`
              liste.push(input.value);
              input.value="";

  //  <div class="mots">${input.value}<span>x</span></div>/*
  var div = document.createElement("div");
  div.classList.add("mots");
  div.innerText = val;
  var span = document.createElement("span");
  span.innerText = "X";
  span.addEventListener("click", () => {
    span.parentElement.parentElement.removeChild(div);
    var mot = span.parentElement.innerText;
    mot = mot.substring(0, mot.length - 1);
    console.log(mot, mot.length);
    var index = liste.indexOf(mot);
    liste.splice(index, 1);

    ajaxMotcles();
  });

  div.appendChild(span);
  document.querySelector(".mots-cles").appendChild(div);
}

function ajaxMotcles() {
  let id = document.querySelector("#hidden").value;
  $.ajax("https://www.prof-direct.com/api/ajax_motcles/" + id, {
    method: "POST",
    data: {
      motcles: liste.join(";")
    },
    dataType: "JSON",
    success: (rep) => {
      var p = document.querySelector("p[data-id=motcles]");
      if (rep.errors) {
        p.innerText = rep.errors["motcles"];
        chargerLesMotsCles()
      } else {
        afficherMots(input.value);
        p.innerText = "";
      }
    },
    error: (err) => {
      console.log(err);
    },
  });
}