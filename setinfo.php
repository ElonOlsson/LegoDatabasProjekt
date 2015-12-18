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
				ORDER BY sets.Setname") or die ("Error in database table:" .mysql_error());
				
				//Antingen eller ( ifsatsen / "or die" ovan)
				
				if($searchresult == FALSE) 
				{ 
					die(mysql_error());
				}
				
				$thissetsid = $_GET["SetID"];
				
				$searchSetname = mysql_query ("SELECT sets.Setname, parts.Partname 
				FROM sets, parts, inventory
				WHERE sets.SetID = inventory.SetID
				AND inventory.ItemID = parts.PartID
				AND sets.SetID = '$thissetsid'");
							
				$storeimageinfo = mysql_query ("SELECT images.itemTypeID, images.colorID, images.itemID, images.has_gif,
				images.has_jpg, images.has_largegif, images.has_largejpg 
				FROM images, itemtypes, inventory
				WHERE inventory.ItemtypeID = itemtypes.ItemtypeID 
				AND itemtypes.ItemtypeID = images.itemTypeID
				AND inventory.SetID = '$thissetsid'");	


							//Den här delen är lite difus. fick hjälp. Hämtar första raden (sets.Setname). Visar första partname ([0]). annars tar setname upp den platsen.
							$onerow = mysql_fetch_row($searchSetname);
							$showsetname = $onerow[0];		
							print ("<h1>$showsetname</h1>\n");
							print("<h6>$onerow[1]\n</h6>");		
				//$row ;
				while($row = mysql_fetch_array($searchSetname)) //gå vidare till nästa slot här.
				{ 

					$showpartname = $row['Partname'];
					print ("<h6>$showpartname\n</h6>");
					$imagepick = mysql_fetch_array($storeimageinfo);
					
						
					$itemtypeID		=$imagepick['itemTypeID'];
					$colorID		=$imagepick['colorID'];
					$itemID			=$imagepick['itemID'];
					// $has_gif		=$imagepick['has_gif'];
					// $has_jpg		=$imagepick['has_jpg'];
					// $has_largegif	=$imagepick['has_largegif'];
					// $has_largejpg	=$imagepick['has_largejpg'];
					$imagelink		='http://www.itn.liu.se/~stegu/img.bricklink.com' ."/" .$itemtypeID ."/" .$colorID ."/" .$itemID ;
					// echo $imagelink;
//					src="/images/image.jpg" alt="Image" width="100" height="100"
				//echo "<img src=\"http://myimglink.com/img.png" border=0>";
					// if($has_gif == false && $has_jpg == false && $has_largegif)
					// {
						// print('<img src="http://www.itn.liu.se/~stegu/img.bricklink.com/$itemtypeID/$itemID.gif">');
						// länk med stora .gif		
					// }
					
					// else if($has_gif == false && $has_jpg == false && $has_largejpg)
					// {
						// echo '<img src="http://www.itn.liu.se/~stegu/img.bricklink.com/'.$itemtypeID.'"/"'.$itemID.'".jpg""  />';
						// länk med stora .jpg
					// }
					
					// else if($has_jpg == false && $has_largejpg == false && $has_largegif == false)
					// {
						// print('<img src="http://www.itn.liu.se/~stegu/img.bricklink.com/$itemtypeID/$colorID/$itemID.gif">');
						// länk med lilla .gif
					// }
					
				
					// else if($has_gif == false && $has_largejpg == false && $has_largegif == false)
					// {
						echo '<img src="'.$imagelink.'" alt="Här skulle det varit något" style="width:100px;height:100px"/>';
						// länk med lilla .jpg
					// }
						
				}
					
					// $counter=1;
					// while($showpartname) // samma problem här? samma bild på alla bitar?
					// {
						// $imagepick = mysql_fetch_array($storeimageinfo);
						// $showpartname = $row['Partname'];
						// print ("<h6>$showpartname\n</h6>");
						
						// $itemtypeID		=$imagepick['itemTypeID'];
						// $colorID		=$imagepick['colorID'];
						// $itemID			=$imagepick['itemID'];
						// $has_gif		=$imagepick['has_gif'];
						// $has_jpg		=$imagepick['has_jpg'];
						// $has_largegif	=$imagepick['has_largegif'];
						// $has_largejpg	=$imagepick['has_largejpg'];
						
						// if($has_gif == false && $has_jpg == false && $has_largegif)
						// {
							// print("<img src=\"http://wwww.itn.liu.se/~stegu/img.bricklink.com/$itemtypeID/$itemID.gif\">");
							//länk med stora .gif		
						// }
						
						// else if($has_gif == false && $has_jpg == false && $has_largejpg)
						// {
							// print("<img src=\"http://wwww.itn.liu.se/~stegu/img.bricklink.com/$itemtypeID/$itemID.jpg\">");
							//länk med stora .jpg
						// }
						
						// else if($has_jpg == false && $has_largejpg == false && $has_largegif == false)
						// {
							// print("<img src=\"http://wwww.itn.liu.se/~stegu/img.bricklink.com/$itemtypeID/$colorID/$itemID.gif\">");
							//länk med lilla .gif
						// }
						
					
						// else if($has_gif == false && $has_largejpg == false && $has_largegif == false)
						// {
							// print("<img src=\"http://wwww.itn.liu.se/~stegu/img.bricklink.com/$itemtypeID/$colorID/$itemID.jpg\">");
							//länk med lilla .jpg
						// }
						// $counter=$counter+1;
						// print($counter);
						
					// }
				//$row = mysql_fetch_array($searchSetname);
			
				
					
				// for($i=0; $i <= $showpartname; $i++)
				// {
					// print ("<h6>$showpartname\n</h6>")
				// }
					
					
					
				// 
				
			?> 
		</div>
	</div>
	
	</body>
</html>