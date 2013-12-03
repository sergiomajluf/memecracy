<!DOCTYPE html>
<html lang="en">
  <head>
<?php include_once("header.php"); ?>


<link href="static/style.css" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Average+Sans' rel='stylesheet' type='text/css'>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
	$("#imgAnimate").hover(
	    function() {
	    	$(this).attr("src", "static/i/memecracy-logo-multiple.gif");
	    }, function(){
	        $(this).attr("src", "static/i/memecracy-logo-02.png");
	    });
});

$(function() {
	var bar = $('#headerContainer');
	var top = bar.css('top');
	
	$(window).scroll(function() {
	if(($(this).scrollTop() > 120) && ($(this).scrollTop() < 230)) {
		bar.stop().animate({'top' : '180px'}, 250, "swing");
		$("#candidatas").animate({ opacity : 0.1 }, 0.8);
	}
	else if($(this).scrollTop() > 240) {
		bar.stop().animate({'top' : '30px'}, 250, "swing");
		$("#candidatas").animate({ opacity : 0.1 }, 0.2);
	}
	else {
		bar.stop().animate({'top' : top}, 250, "swing");
		$("#candidatas").animate({ opacity : 1 }, 0.2);
	}
	});
});
</script>
</head>

<body>
<?php include_once("analyticstracking.php") ?>
<?php
if(file_exists("install.php"))
{
	die('<p style="padding: 5px; background-color: #EEFF57; border: 2px solid black;"><strong>Important:</strong> Delete install.php to complete installation.</p>');
}
 
include_once("memesettings.php"); 
?>
<div id="headerContainer">
	<div id="header">
		<img id="imgAnimate" src="static/i/memecracy-logo-02.png" alt="Memecracy">
	</div>
</div>

<div id="candidatas">
	<div class="colIzq">
		<a href="create.php?t=michelle.png" title="Toma el poder: MEME ahora!">Bachelet</a>
	</div>

	<div class="colDer">
		<a href="create.php?t=evelyn.png" title="Toma el poder: MEME ahora!">Matthei</a>
	</div>

</div>

<div id="acerca">
    <div class="story">
    <div class="colIzq">
        <p>La propaganda politica está llena de mensajes prefabricados que pretenden representarnos. Frases, ideologías y declaraciones envasadas que intentan reflejar nuestros pensamientos y necesidades manifestándose en afiches, lienzos y pantallas que invaden nuestro entorno intentando convencernos de que estamos siendo representados. Historicamente ha sido así… pero hoy nos podemos permitir declarar nuestra propia propaganda.</p>
    </div>

    <div class="colDer">
        <ul>
            <li>MEMECRACY invierte el modelo, dejándolo en manos de la opinion pública.</li>
            <li>MEMECRACY es la voz del pueblo hacia sus candidatos a la presidencia.</li>
            <li>MEMECRACY te recuerda que ellos gobiernan para nosotros y gracias a nosotros.</li>
            <li>Que no pongan palabras en ti, pon tus propias palabras… y difúndela. Power to the people!</li>
        </ul>
    </div>
    </div>
<a href="http://www.terrorista.co" title="Un proyecto TERRORISTA" class="terroristaLink">Un proyecto TERRORISTA</a>

</div>
</body>
</html>