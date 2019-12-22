/* 
 * 
 *     Author: Daniel Rodrigues
 * 
 */



function openNav(id) {
    document.getElementById(id).style.width = "250px";
    document.getElementById("form-area").style.width = "76%";
    //document.getElementById("body-layout").style.marginLeft = "250px";
}

function closeNav() {
    document.getElementById("nav-search").style.width = "0";
    document.getElementById("nav-calendar").style.width = "0";
    document.getElementById("nav-folder").style.width = "0";
    document.getElementById("nav-share").style.width = "0";
    document.getElementById("form-area").style.width = "100%";
    document.getElementById("body-layout").style.marginLeft= "0";
}

var modal = document.getElementById('box_cadastrar');

window.onclick = function(event) {
  if (event.target === modal) {
    modal.style.display = "none";
  }
}