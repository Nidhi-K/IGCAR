<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Learning</title>
</head>

<body>

<?php
	$hostname="localhost";
	$password='';
	$username="root";
	$dbhandle=mysql_connect($hostname,$username,$password)
		or die("Unable to connect to MySQL");
	echo "Connected to MySQL<br>";
?>

<?php
//select a database to work with
$selected = mysql_select_db("assessment_new",$dbhandle)
  or die("Could not select examples");
?>

<?php
//execute the SQL query and return records
$result = mysql_query("SELECT * FROM barc where barc_year !=0  and icno between 4000 and 5000 and length(batch_type)>0 order by icno ");
//fetch tha data from the database

echo  "<pre>ICNO    BARC_YEAR    BATCH_TYPE   BARC_BATCH <br> </pre>";

while ($row = mysql_fetch_array($result)) {
  echo $row{'icno'}.str_repeat("&nbsp", 11).$row{'barc_year'}.str_repeat("&nbsp", 17).$row{'batch_type'}.str_repeat("&nbsp", 15).$row{'barc_batch'}.str_repeat("&nbsp",1)."<br>";
}
?>

</body>
</html>
