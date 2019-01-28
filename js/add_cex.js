function successData(){
	$('#fieldSearch').attr('id', 'fieldSearchSuccess');

	$("#fieldSearchSuccess").html('<svg id="successAnimation" class="animated" xmlns="//www.w3.org/2000/svg" width="70" height="70" viewBox="0 0 70 70"> <path id="successAnimationResult" fill="#D8D8D8" d="M35,60 C21.1928813,60 10,48.8071187 10,35 C10,21.1928813 21.1928813,10 35,10 C48.8071187,10 60,21.1928813 60,35 C60,48.8071187 48.8071187,60 35,60 Z M23.6332378,33.2260427 L22.3667622,34.7739573 L34.1433655,44.40936 L47.776114,27.6305926 L46.223886,26.3694074 L33.8566345,41.59064 L23.6332378,33.2260427 Z"/> <circle id="successAnimationCircle" cx="35" cy="35" r="24" stroke="#979797" stroke-width="2" stroke-linecap="round" fill="transparent"/> <polyline id="successAnimationCheck" stroke="#979797" stroke-width="2" points="23 34 34 43 47 27" fill="transparent"/> </svg>');
}

function unicodeToChar(text) {
   return text.replace(/\\u[\dA-F]{4}/gi, 
          function (match) {
               return String.fromCharCode(parseInt(match.replace(/\\u/g, ''), 16));
          });
}

function checkUndefined(text){
	if(typeof text === "undefined"){
		return ' no info ';
	} else {
		return text;
	}
}

function recargaFunciones(){
	$(document).on("click", "a.searchEntry", function(event) {
    	event.preventDefault();
    	var query = 'link=' + $(this).attr('href');

    	$.ajax({
		    type: 'GET',
		    url: './search_music.php',
		    data: query,
		    beforeSend: function () {
                $("#fieldSearch").html('<img src="../img/loading.gif" style="width: 100%; max-width: 200px"></img>');
           	}
		}).done(function (response){
			if(response){
				var queryResult = $.parseJSON('[' + response + ']');

				$("#itemArtist").attr('value', queryResult[0][1]['artist']);
				$("#itemTitle").attr('value', queryResult[0][1]['title']);
				$("#itemPublishDate").attr('value', queryResult[0][1]['publishDate']);
				$("#itemRecordCompany").attr('value', queryResult[0][1]['recordcompany']);
				$("#itemType").attr('value', queryResult[0][1]['type']);
				$("#itemBarcode").attr('value', queryResult[0][1]['barcode']);

				console.log(queryResult[0][1]['image']);

				if(queryResult[0][1]['image'] != ""){
					var addImage = '<div class="font-italic"><label for="itemImageFromWeb">(se ha añadido la portada de MusicBrainz. Si subes una imagen, tendrá preferencia sobre la obtenida de MusicBrainz)</label><input type=\"hidden\" value=\"' + queryResult[0][1]['image'] + '\" name="itemImageFromWeb\" id="itemImageFromWeb"></div>';
					
					$("#formAdding").append(addImage);
				}
        	}

        	successData();
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

		var query = 'query=' + $("#nameSearch").val();

		$.ajax({
		    type: 'GET',
		    url: './search_cex.php',
		    data: query,
		    beforeSend: function () {
				$("#buttonSearch").remove();
				$("#fieldSearch").html('<img src="../img/loading.gif" style="width: 100%; max-width: 200px"></img>');
           	}
		}).done(function (response){
			if(response){
				//var result = eval(response);

				var queryResult = $.parseJSON('[' + response + ']');

				var showResults = '';

				if(queryResult[0][0] == "search"){
					queryResult[0].splice(0, 2);
					var counter = 0;
					for (var actual in queryResult[0]){
						var url = checkUndefined(queryResult[0][actual]['url']),
							name = checkUndefined(queryResult[0][actual]['name']),
							available = checkUndefined(queryResult[0][actual]['available']),
							price = checkUndefined(queryResult[0][actual]['price']);

						url = url + '&record=' + record;

						showResults = showResults + '<a href="' + url + '" class="searchEntry"> ' + '<div class="alert alert-info"> <span class="font-italic">' +  name + '</span> <br> <span class="font-weight-bold"> ' + artist + ' </span> <br> <span> ' + available + ' </span> <br> <span> ' + price + '</span> </div>' + ' </a>';

						counter++;

						if(counter == 10){
							break;
						}
					}

					recargaFunciones();
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