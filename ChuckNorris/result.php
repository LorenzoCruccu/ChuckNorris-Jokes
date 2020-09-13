<!DOCTYPE html>
<html>
<head>
	<title>Result</title>
	<link rel="shortcut icon" href="http:\\localhost\ChuckNorris\images\favicon.svg" />

</head>
<body>
<!--NavBar-->
<nav class="navbar navbar-expand-sm bg-light navbar-light sticky-top">
  <a class="navbar-brand" href="#">
   <img src="http:\\localhost\ChuckNorris\images\logoCN.jpg" 
	alt="Chuck stolen the logo.. We're sorry" style="width:60px;">
 </a>
 
  <ul class="navbar-nav">

    <li class="nav-item">
      <a class="nav-link" href="http:\\localhost\ChuckNorris\index.php">Main Menu</a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="https://github.com/LorenzoCruccu">My GitHub</a>
    </li>

  </ul>
</nav>
<!--NavBar-->

<?php  
	include("Utilities.php"); // Boostrap 4
	//This page shows the output of the previous query
	$jokeNumber = $_GET["id"];
    $json=file_get_contents("http://api.icndb.com/jokes/".$jokeNumber);
	$joke=json_decode($json);
	$sentence= $joke->value->joke;

	echo "<div class=\"container\">";
	
    echo " <blockquote class=\"blockquote\">";
	echo " <h1 class=\"display-4\"> $sentence.</h1>";
  	echo " <footer class=\"blockquote-footer\">Chuck Norris</footer>";
	echo " </blockquote>";

	echo "</div>";
?>

</body>
</html>