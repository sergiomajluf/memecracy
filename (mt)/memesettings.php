<?php
/*

Meme Maker, Copyright Devadutta Ghat, 2012

*/
// Name that appears in logo and title
$sitename = "Memecracy";
// Name that appears in the watermark
$watermark = "terrorista.co";

//Number of memes to be shown on "recent" page
$memesPerPage = 100;

//Size in Kb
$maxFileSize = 400;

// Set to false if you do not want users to upload their own images
$enableCustomUpload = false;

// Checks some corner case security issues
$securityChecksEnabled = true;

// No need to edit
$dbtable = 'meme_maker_ratings';

/*********************************
 * Edit Database Settings Below  *
 *********************************/

// Database Settings

// Your MySQL Database username
$dbuname = "db60114";

// Your MySQL DB Password
$dbpass  = 'IdQUZaDh';

// Your MySQL DB Name
$dbname  = 'db60114_memecracy';

// Your MySQL DB Host
$dbhost  = $_ENV{DATABASE_SERVER};

?>