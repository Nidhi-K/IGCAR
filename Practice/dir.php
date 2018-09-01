<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>

<?php
// open the current directory
$dhandle = opendir('.');
// define an array to hold the files
$files = array();

if ($dhandle) {
   // loop through all of the files
   while (false !== ($fname = readdir($dhandle))) {
      // if the file is not this file, and does not start with a '.' or '..',
      // then store it for later display
      if (($fname != '.') && ($fname != '..') &&
          ($fname != basename($_SERVER['PHP_SELF']))) {
          // store the filename
          $files[] = (is_dir( "./$fname" )) ? "(Dir) {$fname}" : $fname;
      }
   }
   // close the directory
   closedir($dhandle);
}

echo "<select name=\"file\">\n";
// Now loop through the files, echoing out a new select option for each one
foreach( $files as $fname )
{
   echo "<option>{$fname}</option>\n";
}
echo "</select>\n";
?>


</body>
</html>
