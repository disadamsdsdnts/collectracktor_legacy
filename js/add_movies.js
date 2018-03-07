function unicodeToChar(text) {
   return text.replace(/\\u[\dA-F]{4}/gi, 
          function (match) {
               return String.fromCharCode(parseInt(match.replace(/\\u/g, ''), 16));
          });
}

function recargaFunciones(){
	$(document).on("click", "a.searchEntry", function(event) {
    	event.preventDefault();
    	console.log("He entrado");
    	console.log($(this).attr('href'));
    	var query = 'link=' + $(this).attr('href');

    	console.log('Esto es resultado de ' + query);

    	$.ajax({
		    type: 'GET',
		    url: './search_movies.php',
		    data: query,
		    beforeSend: function () {
                $("#fieldSearch").html('<img src="../img/loading.gif" style="width: 100%; max-width: 200px"></img>');
           	}
		}).done(function (response){
			if(response){
				var queryResult = $.parseJSON('[' + response + ']');

				$("#itemName").attr('value', queryResult[0][1]['name']);
				$("#itemYear").attr('value', queryResult[0][1]['year']);
				$("#itemCast").attr('value', queryResult[0][1]['cast']);
				$("#itemDirector").attr('value', queryResult[0][1]['director']);
				$("#itemImage").attr('value', queryResult[0][1]['image']);
        	}

        	$("#fieldSearch").html('<img src="../img/success.gif" style="width: 100%; max-width: 200px"></img>');
        });
    });
}

$(document).ready(function() {
	recargaFunciones();

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

				var queryResult = $.parseJSON('[' + response + ']');

				var showResults = '';

				console.log(queryResult);
				console.log(queryResult[0][0]);

				if(queryResult[0][0] == "search"){
					queryResult[0].splice(0, 1);
					for (var actual in queryResult[0]){
						showResults = showResults + '<h5><a href="' + queryResult[0][actual]['url'] + '" class="searchEntry"> ' + queryResult[0][actual]['name'] + ' </a></h5> <br>';
						// showResults = showResults + '<li class="searchEntry" value="' + queryResult[0][actual]['url'] + '">' + queryResult[0][actual]['name'] + '</li> ';
					}

					recargaFunciones();
				} else if (queryResult[0][0] == "movie"){
					/*showResults = '<a href="#"><div class="card card-header alert-info"> <strong>'+ queryResult[0]['name'] + '</strong> (' + queryResult[0]['year'] + ')</div> <div class="card card-body"> <img src=\"' + queryResult[0]['image'] + '\" style=\"width: 100%;\"> </div> <br> </div> </a>';*/
						$("#itemName").val(queryResult[0][1]['name']);
						$("#itemYear").val(queryResult[0][1]['year']);
						$("#itemCast").val(queryResult[0][1]['cast']);
						$("#itemDirector").val(queryResult[0][1]['director']);
						var addImage = '<input type=\"hidden\" value=\"' + queryResult[0][1]['image'] + '\" name="itemImageFromWeb\">';
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