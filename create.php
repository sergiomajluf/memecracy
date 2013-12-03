<!DOCTYPE html>

<html lang="en">
<head>
    <?php include_once("header.php"); ?>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
    <link rel='stylesheet' href="css/spectrum.css" type="text/css">
<!--     <link rel='stylesheet' href="css/ajaxupload.css" type="text/css"> -->
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

    <title></title>
</head>

<body id="createMeme">
    <?php include_once("navbar.php"); ?>

    <div id="headerContainer">
        <div id="header"><a href="/"><img id="imgAnimate" src="static/i/memecracy-logo-small.png" alt="Memecracy"></a></div>
    </div>

<div class="container">
    <div class="row">

        <div class="span5" id="memeArea">
            <div id="memestage"></div>
        </div>

        <div class="span6" id="memeControls">

<!--             <form> -->
                <textarea id="tc1"></textarea><br/>
                <button type="button" class="btn btn-success" id="cap1">actualiza</button> <button type="button" class="btn btn-danger" id="rcap1">borrar</button>
                
                <br/><br/>
                <textarea id="tc2"></textarea><br/>
                <button type="button" class="btn btn-success" id="cap2">actualiza</button> <button type="button" class="btn btn-danger" id="rcap2">borrar</button>
                
				<br/><br/>
                <select id="fontsizesel">
                    <option value="24">24pt</option>
                    <option value="32" selected>32pt</option>
                    <option value="48">48pt</option>
                    <option value="72">72pt</option>
                </select>

                
<!--
                <input type='text' id="custom" value="#ffffff">
                <input type='text' id="strokesel" value="#000000">
-->
                
                <!--             </form> -->
<br/><br/>
            <form id="createimg" action="view.php" method="post">
                <p><button id="cands" class="btn-large btn-primary" type="button">Crear MEME</button> <input type="hidden" id="imgdata" name="imgdata"></p>
            </form>
        </div>
    </div>
</div><!-- /container -->

<div id="heightStage" style="display: none;"></div>
    
<script type="text/javascript">
<?php

        include_once("memesettings.php");
        
        if(isset($_GET['p']))
        {
            $templateName = isset($_GET['p']) ? $_GET['p'] : 'null.jpg'; 

            if(file_exists("custom/$templatName"))
                $imgname = "custom/$templateName";
            else
                $imgname = 'templates/int.jpg';
                
            print "var gblImgName = \"$imgname\";";
            
        }
        else
        {       
            $templateName = isset($_GET['t']) ? $_GET['t'] : 'null.jpg'; 

            if(file_exists("templates/$templatName"))
                $imgname = "templates/$templateName";
            else
                $imgname = 'templates/int.jpg';
                
            //$imgname = 'templates/int.jpg';
            print "var gblImgName = \"$imgname\";";
        }
        
        print "var watermark =\"$watermark\";";

    ?>

<?php
	include_once("footer.php");
	//include_once("bootstrap_includes.php");
?>
</script>
</body>
</html>
