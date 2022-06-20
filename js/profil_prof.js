
    document.querySelectorAll("#form_profil .auto-save").forEach(elt=>{
        elt.addEventListener("change", envoyerLesInfo)
    })

    function envoyerLesInfo(e){
        var datas = {};
        datas[e.target.name] = e.target.value;
        datas["table"] = e.target.getAttribute("data-table");
        $.ajax("https://www.prof-direct.com/api/ajax_modif/", {
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

    var pro = document.querySelector("#pro");
    
    pro.addEventListener("change", afficheSiret);
    
    function afficheSiret() {
        // Rôle affiche le siret si pro est oui
            if(pro.value == 1) {
                document.querySelector(".siret").style.display = "block";
            } else {
                document.querySelector(".siret").style.display = "none";
            }
            
    }

    /* DISPONIBILTE */

    var dispos = {
        lundi: {
            am : 0,
            pm : 0,
            ev : 0  
        },
        mardi: {
            am : 0,
            pm : 0,
            ev : 0  
        },
        mercredi: {
            am : 0,
            pm : 0,
            ev : 0  
        },
        jeudi: {
            am: 0,
            pm: 0,
            ev: 0
        },
        vendredi: {
            am: 0,
            pm: 0,
            ev: 0
        },
        samedi: {
            am: 0,
            pm: 0,
            ev: 0
        },
        dimanche: {
            am: 0,
            pm: 0,
            ev: 0
        }
    }
    var button = document.getElementById("mesdispos")
    button.addEventListener("click",()=>{
        remplir()
        // Envoyer en ajax
        $.ajax("https://www.prof-direct.com/api/traitement_dispo/", {
            method: "POST",
            dataType: "text",
            data: {
                dispo: dispos
            },
            success: ()=> {
                button.disabled = true;
            },
            error: ()=> {
                button.disabled = false;
            }
        })
        // success
        

    })
    var tds = document.querySelectorAll("td")
    tds.forEach(td=>{
        td.addEventListener("click",()=>{
                button.disabled = false;
                td.classList.toggle("dispo")
        })
    })

    

    function remplir(){
       dispos= {
        lundi: {
            am : isDispo(tds[0]),
            pm : isDispo(tds[7]),
            ev : isDispo(tds[14])
        },
        mardi: {
            am : isDispo(tds[1]),
            pm : isDispo(tds[8]),
            ev : isDispo(tds[15]) 
        },
        mercredi: {
            am : isDispo(tds[2]),
            pm : isDispo(tds[9]),
            ev : isDispo(tds[16])  
        },
        jeudi: {
            am: isDispo(tds[3]),
            pm: isDispo(tds[10]),
            ev: isDispo(tds[17])
        },
        vendredi: {
            am: isDispo(tds[4]),
            pm: isDispo(tds[11]),
            ev: isDispo(tds[18])
        },
        samedi: {
            am: isDispo(tds[5]),
            pm: isDispo(tds[12]),
            ev: isDispo(tds[19])
        },
        dimanche: {
            am: isDispo(tds[6]),
            pm: isDispo(tds[13]),
            ev: isDispo(tds[20])
        }
    }
}

function isDispo(elt){
    if(elt.classList.contains("dispo")){
        return 1;
    }else{
        return 0;
    }
}

