<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8"/>
		<title>Blogginlägg</title>
		<link href="style.css" rel="stylesheet"/>
		<script src="function.js"></script>
		
	</head>
	<body onload="clock()" id="kropp">
		<!--Meny-->
		<div id="meny">
			<div class="menyVal"><a class="menyStil" href="lab_1.html">Startsida</a></div>
			<div class="menyVal"><a class="menyStil" href="lab_2.html">Mina Intressen</a></div>
			<div class="menyVal" id="changeMode" onclick="dagNatt()">Dag/Natt</div>
			<div id="divBlogg" class="menyVal"><a class="menyStil" href="visa.php">Min Blogg</a></div>
			<div class="menyVal" id="txt"></div>
		</div>
		
		<!--Kolla lösen, lägg till ny post på skärm, skriv i fil-->
		<?php
		 if ($_POST["password"] != "piodde") {
			print("<p>Fel Lösenord! Try Again</p>");
		 }
		 else {
			// Lägg till ny post här
			// Koppla upp mot databasen
			mysql_connect("mysql.itn.liu.se", "blog_edit", "bloggotyp");
			mysql_select_db("blog");	
			$author = mysql_real_escape_string($_POST['name']);
			$heading = mysql_real_escape_string($_POST['subject']);
			$text = mysql_real_escape_string($_POST['entry']);
			$query = "INSERT INTO malej288 VALUES(NULL, '$author', '$heading', '$text')";
			// Nu har vi en fråga i $query som vi kan skicka till MySQL!
			mysql_query($query);
			
			$entry = $_POST['entry'];
			$timestamp = date("(Y-m-d H:i)");
			print("<h2>$heading</h2>\n");
			print("<p>$entry</p>\n");
			print("<p><em>- $author $timestamp</em></p>\n");
		}
		?> 
		
		<a id="nyPost" href="blog.php">Nytt Inlägg</a>
	</body>
</html>