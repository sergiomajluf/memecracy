<?php include_once("analyticstracking.php") ?>
<?php
if(file_exists("install.php"))
{
	die('<p style="padding: 5px; background-color: #EEFF57; border: 2px solid black;"><strong>Important:</strong> Delete install.php to complete installation.</p>');
}
 
include_once("memesettings.php"); 
?>
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
<div id="headerContainer">
    <div id="headerMenu">
<!--
    	<a href="/"><img id="imgAnimate" src="static/i/memecracy-logo-small.png" alt="Memecracy"></a>
-->
        <ul id="menu">
			<li class="homeLink"><a href="/"><img id="imgAnimate" src="static/i/memecracy-logo-small.png" alt="Memecracy"></a></li>
<!--
			<li id="customMemes" class="recentLink"><a href="/" title="Hecho a mano">a mano</a></li>
-->
			<li id="recentMemes" class="recentLink"><a href="recent.php" title="Meme recientes">recientes</a></li>
			<li id="popularMemes" class="recentLink"><a href="popular.php" title="Meme populares">+ populares</a></li>
			<li id="createMemes" class="recentLink"><a href="/" title="Crea tu MEME">crear
				<ul><li>1</li><li>2</li></ul>
			</a></li>
		</ul>
    </div>
</div>

