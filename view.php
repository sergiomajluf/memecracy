<?php
if(isset($_GET['c']))
{
	$fn = $_GET['c'];
}
else
{
	$filteredData=substr($_POST['imgdata'], strpos($_POST['imgdata'], ",")+1);

	// Need to decode before saving since the data we received is already base64 encoded
	$decodedData=base64_decode($filteredData);

	$fn = substr(md5(time()), 0, 5);
	$fp = fopen( "c/$fn.png", 'wb' );
	fwrite( $fp, $decodedData);
	fclose( $fp );
}

?>
<!DOCTYPE html>

<html lang="en">
<head>
	<?php include_once("header.php"); ?>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <link href="static/style.css" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Average+Sans' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js">
</script>



<script type="text/javascript">
$(document).ready(function() {
$("#imgAnimate").hover(
    function() {
        $(this).attr("src", "static/i/memecracy-logo-multiple-small.gif");
    }, function(){
        $(this).attr("src", "static/i/memecracy-logo-small.png");
    });
});

</script>

</head>

<body id="viewMeme">
<?php include_once("navbar.php"); ?>

	<?php 
	function isImage($filename)
	{
		if(function_exists('getimagesize'))
		{
			if(getimagesize($filename))
				return 1;
		}
		else if(function_exists('exif_imagetype'))
		{
			if(exif_imagetype($filename))
				return 1;
		} else
			return 0;
	}

	include_once("navbar.php");
	if($securityChecksEnabled)
	{
		if(!function_exists('getimagesize') && !function_exists('exif_imagetype'))
		{
			die("<h1>Some Security features cannot be enabled since your PHP does not support GD</h1><p>These are optional features and you can disable them. Refer documentation.</p>");
		}

		if(!isImage("c/$fn.png"))
		{
			unlink("c/$fn.png");
			die("You uploaded a non image.");
		}
	}

	if(filesize("c/$fn.png") > $maxFileSize * 1024 * 8)
	{
		die("Image you uploaded is too big");
	}
	else if(filesize("c/$fn.png") == 0)
	{
		die("File you uploaded has an error. Please re-try");
	}

	?>

	<div class="container">

		<div class="row">
			<div class="span7">

				<br> <img src="c/<?php echo $fn; ?>.png">
			</div>

			<div class="span5">
				<?php

				if(strstr($_SERVER["REQUEST_URI"], "?c"))
				{
					$k = explode("?", $_SERVER["REQUEST_URI"]);
					$url = $_SERVER["SERVER_NAME"].$k[0]."?c=$fn";
				}
				else
				{
					$url = $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]."?c=$fn";
				}

				?>
				<h4>Copia y difunde tu meme con este Link</h4>
				<br> <input type="text" id="sharelink"
					value="<?php echo "http://".$url; ?>"> <br>
				<h5>Compártelo en FB</h5>
				<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo "http://".$url; ?>" target="_blank">
 Share on Facebook
</a>
				
				<h4>Te gustó este meme</h4>
				<button id="loverate" class="btn btn-mini active"></button>  <button id="lovethis" class="btn btn-success btn-mini"><i class="icon-white icon-heart"></i> Love This!</button>
				

				<h4>Share on Facebook</h4>
				<iframe
					src="//www.facebook.com/plugins/like.php?href=http://<?php echo $url; ?>&amp;send=false&amp;layout=button_count&amp;width=450&amp;show_faces=true&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21"
					scrolling="no" frameborder="0"
					style="border: none; overflow: hidden; width: 450px; height: 21px;"
					allowTransparency="true"></iframe>

			</div>
		</div>

	</div>
	<!-- /container -->

	<div id="heightStage" style="display: none;"></div>
	<!-- Le javascript
    ================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="js/jquery.js"></script>
	<script>

	var currentRating = 0;
	var alreadyRated = 0;
	var currentMeme = '<?php echo $fn; ?>';

	$(function () {

		jQuery.ajax({
			type : "GET",
			 data: { meme: currentMeme, cr: 1},
			url: 'love.php',
			success:function(data1){
				rateData = jQuery.parseJSON(data1); 
				$("#loverate").html(rateData.points);
				if(rateData.rated)
				{
					$("#lovethis").removeClass("active");
					$("#lovethis").addClass("disabled");
					$("#lovethis").html("You Love This!");					 
				}
			}
		});
	

		$("#sharelink").click(function() {
			$(this).select();
		});

		$("#lovethis").click(function () {

			if(!alreadyRated)
			{
				
				currentRating++;

				jQuery.ajax({
					type : "GET",
					 data: { meme: currentMeme},
					url: 'love.php',
					success:function(data1){
						if(data1 == '-1')
						{
							$("#lovethis").removeClass("active");
							$("#lovethis").addClass("disabled");
							$("#lovethis").html("You Love This!");		 
						}
						else if(data1 == '-2')
						{
							alert("Error: Meme not found");
						}
						else
						{
							currentRating = data1;			
							$("#loverate").html(currentRating);
							$("#lovethis").removeClass("active");
							$("#lovethis").addClass("disabled");
							$("#lovethis").html("You Love This!");				 
									
						} 
					}
						
				});					
				
				alreadyRated = 1;
			}
			else
			{			
				alert("You have already loved this, thanks!");
			}				
		}
		);
	
	});
	
	</script>
	<script src="js/bootstrap-transition.js"></script>
	<script src="js/bootstrap-alert.js"></script>
	<script src="js/bootstrap-modal.js"></script>
	<script src="js/bootstrap-dropdown.js"></script>
	<script src="js/bootstrap-scrollspy.js"></script>
	<script src="js/bootstrap-tab.js"></script>
	<script src="js/bootstrap-tooltip.js"></script>
	<script src="js/bootstrap-popover.js"></script>
	<script src="js/bootstrap-button.js"></script>
	<script src="js/bootstrap-collapse.js"></script>
	<script src="js/bootstrap-carousel.js"></script>
	<script src="js/bootstrap-typeahead.js"></script>

</body>
</html>
