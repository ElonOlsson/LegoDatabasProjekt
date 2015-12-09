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
		
		<h1>Gör Blogginlägg</h1>
		
		<!--gör inlägg formulär-->
		<form id="form" action="ny.php" method="post">
			<p id="namn" class="inmatning">
				<label>Namn:
				</label>
			</p>
			<p><input type="text" name="name"></p>
			
			<p class="inmatning">
				<label>Rubrik:
				</label>
			</p>
			<p><input type="text" name="subject"></p>
			
			<p class="inmatning">
				<label>Blogginlägg:</label></p><p><textarea name="entry" rows="10" cols="80"></textarea>
				
			</p>
			
			<p class="inmatning">
				<label>Lösenord:
				</label>
			</p>
			<p><input type="password" name="password"></p>
			
			<p><input type="submit"></p>
		</form>	
		
		
	</body>
</html>



