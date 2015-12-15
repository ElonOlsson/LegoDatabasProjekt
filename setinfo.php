<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link href="style.css" media="screen" rel="stylesheet" type="text/css"/>
		<title>Databas för LEGO-satser</title>
	</head>
	<body>
	<div id="meny">
		
		
			<a href="intedex.html">
				<span id="home">
				<img id="bok" src="bok.jpg">
				</span>
			</a>
		
		
		<div id="menyinfo">
			<h1>Browse</h1>
		</div>
	</div>
	<div id="container">
		<div id="containerLeft">
		
		<form action="resultlist.php" method="post">
				<div id="search" class="search">
					<p class="searchText">Search:</p>
					<br>
					<input class="searchBox" type="text" name="text">
					<br>
				</div>
				<div id="years" class="search">
					<p class="searchText">Year:</p>
					<br>
					<input class="numberBox" type="number" name="firstYear" min="1930" max="2016" step="1" value="1930">
					<input class="numberBox" type="number" name="secondYear" min="1930" max="2016" step="1" value="2016">
					<br>			
				</div>
				<div id="categories" class="search">		<!-- kolla printScrn-bilden php/mysql loopa categorier-->
					<p class="searchText">Categories:</p>
					<br>
					<input class="searchBox" type="text" name="categories"> <!-- type=" någon slags dropdown" -->
					<br>
				</div>
				<div id="go" class="search">
					<input id="postButton" type="submit" value="post">
				</div>
			</form>
			
		</div>
		<div id="containerRight">
<!-- loopen som hämtar ett sökresultat i taget skall ligga här-->

<!--Searchfunction-->
		<?php
			// Koppla upp mot databasen
			mysql_connect("mysql.itn.liu.se", "lego", "");
			mysql_select_db("lego");
			// Ställ frågan
			$searchtext			=isset($_POST['text']) ? $_POST['text'] : ' ';
			$searchfirstyear	=isset($_POST['firstYear']) ? $_POST['firstYear'] : ' ';
			$searchsecondyear	=isset($_POST['secondYear']) ? $_POST['secondYear'] : ' ';
			$searchcategories	=isset($_POST['categories']) ? $_POST['categories'] : ' ';
			$searchresult = mysql_query("SELECT sets.Setname FROM sets, categories
			WHERE sets.CatID=categories.CatID
			AND sets.Year >='$searchfirstyear'		
			AND sets.Year <='$searchsecondyear'
			AND categories.Categoryname LIKE '%{$searchcategories}%' 
			AND (sets.SetID LIKE '%{$searchtext}%' OR sets.Setname LIKE '%{$searchtext}%' OR categories.Categoryname LIKE '%{$searchtext}%')
			ORDER BY sets.Setname");
			
			// if($searchresult == FALSE) { 
				// die(mysql_error());
			// }
			
			while($row = mysql_fetch_array($searchresult))
			{
			$test = $row['Setname'];
			}

		?> 
		</div>
	</div>
	
	</body>
</html>