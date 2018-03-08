function checkForm(form){
	form.adminAccountLogin.style.boxShadow = "none";
	form.adminAccountPass.style.boxShadow = "none";

	var enviarFormulario = true;
	
    if(!(/^[a-z]*$/.test(form.adminAccountLogin.value))){
        enviarFormulario = false;
        form.adminAccountLogin.focus();
        form.adminAccountLogin.style.boxShadow = "1px 2px 3px red";
        alert("El login no es correcto. No debe de estar vacio y en minúscula.");
    }

    /* Comprobación del password*/
    if (form.adminAccountPass.value.length < 8 || form.adminAccountPass.value == ""){
    	enviarFormulario = false;
        form.adminAccountPass.focus();
        form.adminAccountPass.style.boxShadow = "1px 2px 3px red";
    	alert("La contraseña tiene que tener al menos 8 caracteres. Es por tu seguridad.");
    }

    return enviarFormulario;
}