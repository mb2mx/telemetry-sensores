  
(function ($) {

	"use strict";


})(jQuery);


$(document).ready(function () {

	$("#btnSubmit").click(function () {
		var username = $("#username").val();

		$.ajax({
			url: "php/index.php/login",
			contentType: "application/x-www-form-urlencoded",
			type: "POST",
			dataType: 'json',
			data: { "username": username, "password": username },

			success: function (responseText) {
				if (responseText.code != null) {
					window.location.href = "index.php";
					localStorage.setItem('username', JSON.stringify(responseText));
					document.cookie = "client= " + JSON.stringify(responseText);

				}
				if ( responseText.hasOwnProperty('status') ) {
					$("#error_message").text("Clave incorrecta");
				}
				



			},
			error: function (jqXHR, textStatus, errorThrown) {
				console.log(errorThrown + ': ' + textStatus);
				$("#username").val("");

			}
		});
	});



});