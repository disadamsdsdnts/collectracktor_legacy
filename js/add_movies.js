$(document).ready(function() {
	function unicodeToChar(text) {
	   return text.replace(/\\u[\dA-F]{4}/gi, 
	          function (match) {
	               return String.fromCharCode(parseInt(match.replace(/\\u/g, ''), 16));
	          });
	}

    $(".searchEntry").on('click', function(event) {
    	console.log("He entrado");
    	console.log($(this).attr('value'));
    	var query = 'link=' + $(this).attr('value');

    	$.ajax({
		    type: 'GET',
		    url: './search_movies.php',
		    data: query,
		    beforeSend: function () {
                $("#fieldSearch").html('<img src="../img/loading.gif" style="width: 100%; max-width: 200px"></img>');
           	}
		}).done(function (response){
			if(response){
				var finalData = response;
				$("#itemName").val(response[0][1]['name']);
				$("#itemYear").val(response[0][1]['year']);
				$("#itemCast").val(response[0][1]['cast']);
				$("#itemDirector").val(response[0][1]['director']);
				$("#itemImage").val(response[0][1]['image']);
        	}

        	 $("#fieldSearch").html('<img src="../img/success.gif" style="width: 100%; max-width: 200px"></img>');
        });
    }); 

	$("#tryAgain").click(function(event) {
		event.preventDefault();

		$("#searcherBody").append('<form method=\"POST\" if=\"formSearch\"> <div id=\"fieldSearch\"> <input type=\"text\" name=\"nameQuery\" id=\"nameSearch\" placeholder=\" Ej: El Rey León\"> </div> <input type=\"submit\" name=\"submitQuery\" id=\"buttonSearch\" value=\"Buscar\"> </form>');
		$("#tryAgain").remove();
	});

	$("#buttonSearch").click(function(e) {
		e.preventDefault();

		var form = document.getElementById("formSearch");
		var query = 'query=' + $("#nameSearch").val();

		console.log(query);

		$.ajax({
		    type: 'GET',
		    url: './search_movies.php',
		    data: query,
		    beforeSend: function () {
                $("#fieldSearch").html('<img src="../img/loading.gif" style="width: 100%; max-width: 200px"></img>');
                $("#buttonSearch").remove();
           	}
		}).done(function (response){
			if(response){
				//var result = eval(response);

				var parapapapa = $.parseJSON('[' + response + ']');

				var showResults = '';

				var size = parapapapa[0].length;

				console.log(size);
				console.log(parapapapa);
				console.log(parapapapa[0][0]);


				if(parapapapa[0][0] == "search"){
					parapapapa[0].splice(0, 1);
					showResults = showResults + '<ul>';
					for (var actual in parapapapa[0]){
						showResults = showResults + '<li class="searchEntry" value="' + parapapapa[0][actual]['url'] + '">' + parapapapa[0][actual]['name'] + '</li> ';
					}

					showResults = showResults + '</ul>';
				} else if (parapapapa[0][0] == "movie"){
					/*showResults = '<a href="#"><div class="card card-header alert-info"> <strong>'+ parapapapa[0]['name'] + '</strong> (' + parapapapa[0]['year'] + ')</div> <div class="card card-body"> <img src=\"' + parapapapa[0]['image'] + '\" style=\"width: 100%;\"> </div> <br> </div> </a>';*/
						$("#itemName").val(parapapapa[0][1]['name']);
						$("#itemYear").val(parapapapa[0][1]['year']);
						$("#itemCast").val(parapapapa[0][1]['cast']);
						$("#itemDirector").val(parapapapa[0][1]['director']);
						var addImage = '<input type=\"hidden\" value=\"' + parapapapa[0][1]['image'] + '\" name="itemImageFromWeb\">';
						$("#formAdding").append(addImage);
				} else {
					showResults = 'No se han encontrado resultados.';
				}

				showResults = showResults + '<button id="tryAgain">Volver a buscar</button>';

				$("#fieldSearch").html(showResults);
			} else {
				alert ("Ha ocurrido un error. Inténtelo de nuevo más tarde.");
			}
        });				
    });

});