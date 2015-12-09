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
			<div id="divBlogg" class="menyVal"><a class="menyStil" href="blog.php">Gör inlägg</a></div>
			<div class="menyVal" id="txt"></div>
		</div>
		
		<h1>Blogg</h1>
		
		<form id="formula" action="visasearch.php" method="post">
			<p id="searchfield" class="inmatning">
				<label>Sök:
				</label>
			</p>
			<p><input type="text" name="searchfield">  <input type="submit"></p>
		</form>	
		
		<select name="sortera">
			<option selected="selected">Nyast</option>
            <option>10 Nyaste</option>
			<option>Äldst</option>
		</select>
        
		<!--ladda in alla blogginlägg-->
		<?php
			 // Koppla upp mot databasen
			 mysql_connect("mysql.itn.liu.se", "blog");
			 mysql_select_db("blog");
			 // Ställ frågan
			 $result = mysql_query("SELECT * FROM malej288 ORDER BY entry_date DESC");
			 // Skriv ut alla poster i svaret
			 while ($row = mysql_fetch_array($result)) {
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
	</body>
</html>