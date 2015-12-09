<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8"/>
		<title>Min Blogg</title>
		<link href="style.css" rel="stylesheet"/>
		<script src="function.js"></script>
		
	</head>
	<body onload="clock()" id="kropp">
		<!--Meny-->
		<div id="meny">
			<div class="menyVal"><a class="menyStil" href="lab_1.html">Startsida</a></div>
			<div class="menyVal"><a class="menyStil" href="lab_2.html">Mina Intressen</a></div>
			<div class="menyVal" id="changeMode" onclick="dagNatt()">Dag/Natt</div>
			<div id="divBlogg" class="menyVal"><a class="menyStil" href="visa.php">Blogg</a></div>
			<div class="menyVal" id="txt"></div>
		</div>
		
		<h1>Blogg</h1>
	                  
        <select name="sortera">
			<option selected="selected">Nyast</option>
            <option>10 Nyaste</option>
			<option>Äldst</option>
		</select>
			
		<!--Searchfunction-->
		<?php
			//ladda in alla blogginlägg som matchar sökningen
			// Koppla upp mot databasen
			mysql_connect("mysql.itn.liu.se", "blog_edit", "bloggotyp");
			mysql_select_db("blog");
			// Ställ frågan
			$searchkey = $_POST['searchfield'];
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
		<a id="nyPost" href="visa.php">Tillbaka</a>
		
	</body>
</html>


