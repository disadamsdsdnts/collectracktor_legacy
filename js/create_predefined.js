$(document).ready(function() {
	var counterFields = 0;
	$(document).on('click', '#addAnID', function(event) {
		$('#formCreator').append('<input type=\"hidden\" name=\"field[0][name]\" value=\"ID\">');
		$('#formCreator').append('<input type=\"hidden\" name=\"field[0][type]\" value=\"auto\">');
		$('#tableBody').append('<tr id="0"> <td>ID</td> <td>🆔 Identificador único</td> <td> <button onclick=\"changeName(this.parentNode.parentNode)\">Editar nombre</button> </td> <td> </td> </tr>');
		$(this).html('Desactivar campo de identificador único');
		$(this).attr('id', 'disableID');
	});

	$(document).on('click', '#disableID', function(event) {
		$(this).html('➕ 🆔 Identificador Único');
		$(this).attr('id', 'addAnID');
		$("input[name^='field[0]']").remove();
		$('#0').remove();
	});

	$(document).on('click', '#addText', function(event){
		counterFields += 1;
		var newName = prompt("¿Nombre del nuevo campo?", "Texto");

		if(newName !== null){
			var appendName = '<input type=\"hidden\" name=\"field[' + counterFields + '][name]\" value=\"' + newName + '\">';
			var appendType = '<input type=\"hidden\" name=\"field[' + counterFields + '][type]\" value=\"text\">';
			$('#formCreator').append(appendName);
			$('#formCreator').append(appendType);

			$('#tableBody').append('<tr id="' + counterFields + '"> <td>' + newName + '</td> <td>📝 Texto</td> <td> <button onclick=\"changeName(this.parentNode.parentNode)\">Editar nombre</button> </td> <td> <button onclick=\"deleteField(this.parentNode.parentNode)\">Borrar campo</button> </td> </tr>');
		}
	});

	$(document).on('click', '#addDate', function(event){
		counterFields += 1;
		var newName = prompt("¿Nombre del nuevo campo?", "Fecha");

		if(newName !== null){
			var appendName = '<input type=\"hidden\" name=\"field[' + counterFields + '][name]\" value=\"' + newName + '\">';
			var appendType = '<input type=\"hidden\" name=\"field[' + counterFields + '][type]\" value=\"date\">';
			$('#formCreator').append(appendName);
			$('#formCreator').append(appendType);

			$('#tableBody').append('<tr id="' + counterFields + '"> <td>' + newName + '</td> <td>📅 Fecha</td> <td> <button onclick=\"changeName(this.parentNode.parentNode)\">Editar nombre</button> </td> <td> <button onclick=\"deleteField(this.parentNode.parentNode)\">Borrar campo</button> </td> </tr>')
		}
	});

	$(document).on('click', '#addInt', function(event){
		counterFields += 1;
		var newName = prompt("¿Nombre del nuevo campo?", "Entero");

		if(newName !== null){
			var appendName = '<input type=\"hidden\" name=\"field[' + counterFields + '][name]\" value=\"' + newName + '\">';
			var appendType = '<input type=\"hidden\" name=\"field[' + counterFields + '][type]\" value=\"int\">';
			$('#formCreator').append(appendName);
			$('#formCreator').append(appendType);

			$('#tableBody').append('<tr id="' + counterFields + '"> <td>' + newName + '</td> <td>🔢 Numeros enteros</td> <td> <button onclick=\"changeName(this.parentNode.parentNode)\">Editar nombre</button> </td> <td> <button onclick=\"deleteField(this.parentNode.parentNode)\">Borrar campo</button> </td> </tr>');
		}
	});

	$(document).on('click', '#addImage', function(event){
		counterFields += 1;
		var newName = prompt("¿Nombre del nuevo campo?", "Imagen");

		if(newName !== null){
			var appendName = '<input type=\"hidden\" name=\"field[' + counterFields + '][name]\" value=\"' + newName + '\">';
			var appendType = '<input type=\"hidden\" name=\"field[' + counterFields + '][type]\" value=\"image\">';
			$('#formCreator').append(appendName);
			$('#formCreator').append(appendType);

			$('#tableBody').append('<tr id="' + counterFields + '"> <td>' + newName + '</td> <td>📷 Imagen</td> <td> <button onclick=\"changeName(this.parentNode.parentNode)\">Editar nombre</button> </td> <td> <button onclick=\"deleteField(this.parentNode.parentNode)\">Borrar campo</button> </td> </tr>');
		}
	});

	$("#formCreator :input").change(function(event) {
		console.log("He llegado");
		var heyVar = $('#formCreator').children().length;
		console.log("Estos son los hijos: " + heyVar);
	});
});

function changeName(node){
	var nameNode = node.children[0];
	var buttonNode = node.children[2];
	var oldName = nameNode.innerHTML;

	nameNode.innerHTML = "<input type='text' name='" + oldName + "' value='" + oldName + "'>";

	buttonNode.innerHTML = "<button onclick=\"saveName('" + oldName + "', this.parentNode.parentNode)\">Guardar</button>";
}

function saveName(oldName, node){
	var newName = node.children[0].children[0].value;

	document.getElementById("formCreator").elements[oldName].value = newName;
	
	node.children[0].innerHTML = newName;
	node.children[2].innerHTML = "<button onclick=\"changeName(this.parentNode.parentNode)\">Editar nombre</button>";
}

function deleteField(node){
	var idToDelete = "field[" + node.id + "]";

	$("input[name^='" + idToDelete + "']").remove();

	node.remove();
}