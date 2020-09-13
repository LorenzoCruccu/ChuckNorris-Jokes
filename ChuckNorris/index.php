<!--
Credits to the Chuck Norris Database: http://www.icndb.com/
-->
<!DOCTYPE html>
<html>
<head>
	<title>Chuck Norris stolen the title of the page..</title>
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

<div class="container">
 <h1 class="display-3">Chuck Norris Jokes</h1>
 <h4> Filter your joke by category:</h4>
</div>

<form action="" METHOD="GET">
	<div class="container">
		<div class="form-check-inline">
			<input class="form-check-input" type="checkbox" id="nerdy" name="nerdy" value="nerdy">
			<label class="form-check-label" for="nerdy"> Nerdy </label><br>
		</div>

		<div class="form-check-inline">
			<input class="form-check-input" type="checkbox" id="explicit" name="explicit" value="explicit">
			<label class="form-check-label" for="explicit"> Explicit</label><br>
		</div>

		<input type="submit" class="btn btn-light" name="submit" value="Search">
		<input type="submit" class="btn btn-danger" name="random" value="Random joke!">
	</div>
</form>


<?php
include("Utilities.php"); // Boostrap 4

if (isset($_GET["submit"])) {
	tableJokes();
}

//When random joke button is clicked, it will retrieve a random joke and will send the user to the result page.
if (isset($_GET["random"])) {
 $json=file_get_contents("http://api.icndb.com/jokes/random");
 $joke=json_decode($json);
 $randomId=$joke->value->id;
	header("Refresh:0; result.php?id=".$randomId);
}

//filteredString() will output a string useful for limiting the query by category.
//See http://www.icndb.com/api "Limiting Categories" for more info
function filteredString(){

//if none of the filters are select, it will exit instantly
if (isset($_GET["nerdy"])==0 && isset($_GET["explicit"])==0) { 
	return 0;
}

$filter = "?limitTo=[";
if (isset($_GET["nerdy"]) && isset($_GET["explicit"])) {
	$filter= $filter.$_GET["nerdy"].",".$_GET["explicit"];
}
elseif (isset($_GET["nerdy"])) {
	$filter= $filter.$_GET["nerdy"];
}
elseif(isset($_GET["explicit"])) {
	$filter= $filter.$_GET["explicit"];
}
$filter=$filter."]";
return $filter;
}


// tableJokes() will display a table based on the filteredString() result.
function tableJokes(){

 $json=file_get_contents("http://api.icndb.com/jokes".filteredString()); //get the list of jokes
 $joke=json_decode($json);
 echo "<br>";

 echo "<div class=\"container\">";

  echo "<table class=\"table table-active table-sm table-hover\">";
  echo "<thead class=\"thead-dark\">";
  echo "<th> Joke N° </th>";
  echo "<th> Categories </th>";
  echo "</thead>";
 foreach ($joke->value as $key => $val) {
 	echo "<tr>";
 	echo "<td name=".$val->id.">";
 	echo "<a href=\"result.php?id=".$val->id."\">"; //every row of the table have its own id. When a row is clicked, it will send the user to the result page, sending also the id of the joke.
	echo "<div>";
 	echo $val->id;
 	echo "</div>";
 	echo "</a>";
 	echo "</td>";

  	echo "<td>";
		foreach ($val->categories as $key => $value) { //displays the categories of every joke
			echo $value;
		}
 	echo "</td>";
	echo "</tr>";
 }
 echo "</table>";
 echo "</div>";
}
 ?>

</body>
</html>
