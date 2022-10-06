

$(document).ready(function () {
  
  loadInfoInit();

 
  
});
function loadInfoInit(){
client = JSON.parse(window.localStorage.getItem('username'));
$("#nameClient").text(client.name);

}

function logout(){

window.localStorage.clear();
window.location.href = "login.html";

}

