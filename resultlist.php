<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<link href="style.css" media="screen" rel="stylesheet" type="text/css"/>
		<title>Databas för LEGO-satser</title>
	</head>
	<body>
	<div id="meny">
		
		
			<a href="index.html">
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
				Search:<br>
							<input type="text" name="text">
							<br>
				</div>
				<div id="years" class="search">
				Year:<br>
							<input type="number" name="firstYear">
							<input type="number" name="secondYear">
							<br>
							
				</div>
				<div id="categories" class="search">	<!-- kolla printScrn-bilden php/mysql loopa categorier-->
				Categories:<br>
							<input type="text" name="categories"> <!-- type=" någon slags dropdown" -->
							<br>
				</div>
				<div id="go" class="search">
					<input  type="submit" value="post"> <!-- submit bör på nåogot vis skicka frågan till databasen-->
				</div>
				
			</form>
		</div>
		<div id="containerRight">
<!-- loopen som hämtar ett sökresultat i taget skall ligga här-->

<!--Searchfunction-->
		<?php
			// Koppla upp mot databasen
			mysql_connect("mysql.itn.liu.se", "blog_edit", "bloggotyp");
			mysql_select_db("blog");
			// Ställ frågan
			$searchtext			=$_POST['text'];
			$searchfirstyear	=$_POST['firstYear'];
			$searchsecondyear	=$_POST['secondYear'];
			$searchcategories	=$_POST['categories'];
			//ställer frågan
			$searchresult = mysql_query("SELECT * FROM sets, categories
			WHERE sets.CategoryID=categories.CategoryID 
			AND Year >='$searchfirstyear' AND Year=<'$searchsecondyear' 
			AND Categoryname='$searchcategories'
			AND (SetID ='%searchtext%' OR Setname='%searchtext%' OR Categoryname='%searchtext%')");
			
			
			$searchresult = mysql_query("SELECT * FROM malej288 WHERE entry_heading LIKE '$searchkey' OR 
			entry_text LIKE '%{$searchkey}%' OR entry_author LIKE '%{$searchkey}%'");
			// Skriv ut alla poster i svaret
			while ($row = mysql_fetch_array($searchresult)) {
				$heading = $row['entry_heading'];
				print("<h2>$heading</h2>\n");
				$author = $row['entry_author'];
				$date = $row['entry_date'];
				$text = $row['entry_text'];
				print("<p>$text</p>\n");
				print("<p><em>- $author, $date</em></p>\n");
				print("<hr/>");
			} // end while
		?> 
		</div>
	</div>
	
	</body>
</html>