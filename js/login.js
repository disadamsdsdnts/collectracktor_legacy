function validarRegistro(form){
	
		var enviarFormulario = true;

		console.log(form);

		/* Comprobación del login */
	    if(!(/^[a-z]*$/.test(form.login.value))){
	        alert("El login no es correcto. No debe de estar vacio y en minúscula.");
	        enviarFormulario = false;
	        form.login.focus();
	    }

	    /* Comprobación del password*/
	    if (form.password.length < 8){
	    	alert("La contraseña tiene que tener al menos 8 caracteres. Es por tu seguridad.");
	    	enviarFormulario = false;
	        form.password.focus();
	    }

	    /* Comprobación del nombre */
	    if(!(/^[A-Z]{1}[a-z]+(\s[A-Z]{1}[a-z]+)*$/.test(formulario.nombre.value)) || formulario.nombre.value == ""){
	        alert("El nombre no es correcto. No debe de estar vacio y cada nombre tiene que empezar por mayúscula.");
	        enviarFormulario = false;
	        form.nombre.focus();
	    }


	    /* Comprobación de los apellidos */
	    if(!(/^[A-Z]{1}[a-z]+(\s[A-Z]{1}[a-z]+)*$/.test(formulario.apellidos.value)) || formulario.apellidos.value == ""){
	        alert("El apellido no es correcto. No debe de estar vacio y cada apellido tiene que empezar por mayúscula.");
	        enviarFormulario = false;
	        form.apellidos.focus();
	    }

	    /* Comprobación del mail */
		if(!(/^[a-z]\w*\@[a-z]\w*\.[a-z]\w*$/.test(formulario.email.value)) || formulario.email.value == ""){
	        alert("El email no es correcto. Debe de escribirse todo en minúsculas y sin caracteres raros.");
	        enviarFormulario = false;
	        form.email.focus();
	    }

	    return enviarFormulario; /*enviarFormulario;*/
	}