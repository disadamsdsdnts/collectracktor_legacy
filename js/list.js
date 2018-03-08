function editar(nodo){
	var actual = nodo.children[4].innerHTML;
	var login = nodo.children[2].innerHTML;

	nodo.children[4].innerHTML = "<input name='updateFormCode' type='text' value=\"" + actual + "\" oninput='actualizarBoton(this.parentNode.parentNode);'>";

	nodo.children[5].innerHTML = "<a href='./update_code.php?login=\"" + login + "\"&code=\"" + code + "'><input type='submit' class='btn btn-info' value='Guardar' name='updateFormSubmit'></a>";
}

function actualizarBoton(nodo){
	var code = nodo.children[4].children[0].value;
	var login = nodo.children[2].innerHTML;

	nodo.children[5].innerHTML = "<a href='./update_code.php?login=" + login + "&code=" + code + "'><input type='submit' class='btn btn-info' value='Guardar' name='updateFormSubmit'></a>";
}