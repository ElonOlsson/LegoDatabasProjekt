<html>
<head><title>Create database table "blog"</title></head>
<body>
<?php
 $link = mysql_connect('mysql.itn.liu.se',
 'blog_edit', 'bloggotyp');
 if (! $link) {
 die('Could not connect: ' . mysql_error());
 }
 echo 'Connected successfully.';
 mysql_select_db('blog');
 $result = mysql_query( "create table blog (
 entry_date timestamp,
 entry_author varchar(100),
 entry_heading varchar(100),
 entry_text text)" );
 if(! $result) {
 die('Could not create table: ' . mysql_error());
 }
 echo 'Table created.';
 mysql_close($link);
?>
</body>
</html> 