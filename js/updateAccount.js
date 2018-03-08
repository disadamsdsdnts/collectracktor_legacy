$(document).ready(function() {
	$('#cambiarAvatar').on('click', function(event) {
		$('#formCambiarAvatar').toggle("slow");
		$('#formCambiarNombreMostrar').css('display', 'none');
		$('#formCambiarPassword').css('display', 'none');
	});

	$('#cambiarNombreMostrar').on('click', function(event) {
		$('#formCambiarAvatar').css('display', 'none');
		$('#formCambiarNombreMostrar').toggle("slow");
		$('#formCambiarPassword').css('display', 'none');
	});

	$('#cambiarPassword').on('click', function(event) {
		$('#formCambiarAvatar').css('display', 'none');
		$('#formCambiarNombreMostrar').css('display', 'none');
		$('#formCambiarPassword').toggle("slow");
	});

	$("input[name='updatingAvatar-submit']").on('click',function(event) {
		$("input[name='updatingAvatar-submit']").val("Subiendo...");
	});
});