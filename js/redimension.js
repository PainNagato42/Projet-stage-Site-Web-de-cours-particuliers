var zoom = document.querySelector("#zoom")
var posx = document.querySelector("#posx")
var posy = document.querySelector("#posy")
var ox = 0;
var oy;
var photo = document.querySelector(".photo-profil");

zoom.addEventListener("input", () => {
    photo.style.backgroundSize = zoom.value + "%"
})

function move(evt) {
    console.log(evt)
    var positionx = parseInt(photo.style.backgroundPositionX)
    var positiony = parseInt(photo.style.backgroundPositionY)
    positionx += evt.x - ox;
    positiony += evt.y - oy;
    ox = evt.x;
    oy = evt.y

    photo.style.backgroundPosition = positionx + "px " + positiony+ "px"
    posx.value=positionx;
    posy.value=positiony;
}

// 3 events listener mousedown mousemove mouseup
photo.addEventListener("mousedown", (e) => {
    // e.offsetX et e.offsetY => coordonnée du point de départ de la translation;
    ox = e.x;
    oy = e.y;
    photo.addEventListener("mousemove", move)
})
photo.addEventListener("mouseup", (event) => {
    console.warn(event)
    photo.removeEventListener("mousemove", move)
})

photo.addEventListener("mouseout", () => {
    photo.removeEventListener("mousemove", move)
})