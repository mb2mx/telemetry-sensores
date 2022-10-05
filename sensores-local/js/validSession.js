 
 function logout(){

  window.localStorage.clear();
  window.location.href = "login.html";

}

function test(){
  client = JSON.parse(window.localStorage.getItem('username'));
  //setCookie(client);

  $("#error_message").text(client.name);

}

 
 