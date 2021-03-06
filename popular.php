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
    <style>
      .container {
        padding-top: 140px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>

</head>

<body id="popular">
<?php include_once("navbar.php"); ?>
    <div class="container">
	<h1>Memes populares</h1>
	
  

<?php

include_once 'db.php';
$memedb = new wpdb($dbuname,$dbpass,$dbname,$dbhost);

$_GET['page'] = isset($_GET['page']) ? $_GET['page'] : 1;
$pageCount = $memesPerPage * ($_GET['page'] - 1);
$count = 0;
$pageStart = 1;
$fileCount = 0;
$pageEnd = 0;
$files = array();

$res = $memedb->get_results("select meme_id, count(*) as points from $dbtable where 1 group by meme_id order by points DESC");

if(!$res)
	print "<h2>No hay memes populares todavía.</h2>";
	print "Elige uno y <a href='/recent.php' title='Vota por tus favoritos'>vota por tus favoritos</a>";

foreach($res as $befEntry)
{
	$entry = $befEntry->meme_id.".png";
	$pngl = pathinfo($entry);

	if($pngl['extension'] == 'png' || $pngl['extension'] == 'jpg' || $pngl['extension'] == 'gif')
	{
		$fileCount++;
		if($fileCount < $pageCount || ($fileCount > ($pageCount + $memesPerPage)))
		{
			$fileCount++;					
			continue;
		}

		$imbasename = $pngl['basename'];
		$imext = $pngl['extension'];
		if(($pageStart == 1) || ($count == 0)||($count + 1) % 4 == 0)
		{
			print '<div class="row"><ul class="thumbnails">';
			$pageStart = 0;
			$pageEnd = 0;
		}
		if($befEntry->points > 1)
			$cap = "People Love This!";			
		else
			$cap = "Person Loves This!";
			
?>
				<li class="span3">
					<div class="thumbnail">
						<?php $k = explode(".",str_replace("_"," ",$entry)); ?>
					  <a href="view.php?c=<?php echo $k[0]; ?>"><img src="c/<?php echo $entry; ?>" alt="" ></a>
					  <div class="caption">
					  <button id="loverate" class="btn btn-mini active disabled"><?php echo $befEntry->points;?></button>  <button id="lovethis" class="btn btn-success btn-mini disabled"><i class="icon-white icon-heart"></i> <?php echo $cap; ?></button>
						<a class="btn btn-mini btn-info" href="view.php?c=<?php echo $k[0]; ?>" class="btn">View</a>
					  </div>
					</div>
				  </li>
<?php

		if(($count + 1) % 4 == 0)
		{
			$pageEnd = 1;
			print '</ul></div> <!-- Row end -->';
		}

		$count++;			
	}
}

$maxPages = ceil($fileCount / $memesPerPage);



if($pageEnd == 0)
{
	print '</ul></div> <!-- page end -->';
}

$prevPage = $_GET['page'] > 1 ? ($_GET['page'] - 1) : 1;
$nextPage = $_GET['page'] >= $maxPages ? $maxPages : ($_GET['page'] + 1);
		
?>
<div class = "row">
<div class="span12">
<div class="pagination">
  <ul>
  <li><a href="popular.php?page=<?php echo $prevPage; ?>">Prev</a></li>
<?php
for($i = 1; $i <= $maxPages; $i++) {
	if($i == $_GET['page'])
		$cln = "class=\"disabled\"";
	else
		$cln = '';
	print   "<li $cln><a href=\"popular.php?page=$i\">$i</a></li>";
}
?>

  <li><a href="popular.php?page=<?php echo $nextPage; ?>">Next</a></li>
  </ul>
</div>
</div>
</div>
	
    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
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
