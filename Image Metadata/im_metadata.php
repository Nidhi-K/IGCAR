<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>

 

<?php
$target_dir = "D:/xampp/htdocs/BITS/Image Metadata/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

if(isset($_POST["submit"])) 
{	
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]); 
}
else
{
	$uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
$fn= basename( $_FILES["fileToUpload"]["name"]);
if ($uploadOk == 0) 
{
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} 
else 
{
    if (!move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
	{
        echo "Sorry, there was an error uploading your file.";
    }
}

$image_file=basename( $_FILES["fileToUpload"]["name"]);

?>



 <?php
 error_reporting(E_ERROR);
//$image_file = 'D:\xampp\htdocs\BITS\Image Metadata\idc.JPEG';

$image_type='';
echo "<h3> Image Details </h3>";
if(file_exists($image_file))
{
	$type = exif_imagetype($image_file);
	
	switch($type)
	{
		case IMAGETYPE_GIF:
		{
			$image_type = 'GIF';
		}break;
		case IMAGETYPE_JPEG:
		{
			$image_type = 'JPEG';
		}break;
		case IMAGETYPE_PNG:
		{
			$image_type = 'PNG';
		}break;
		case IMAGETYPE_BMP:
		{
			$image_type = 'BMP';
		}break;
		default:
		{
			$image_type = 'Not gif,jpeg,png,or bmp';
		};
	}
	//echo '<b>Image type: </b>'. $image_type."<br>";
	
}
else
{
	echo 'File does not exist';
}


//$tab=str_repeat('&nbsp;',12);
if(file_exists($image_file))
{
	$details=@exif_read_data($image_file);
	foreach($details as $key=>$val) //check out line 121
	{
		echo "<b>".$key.":</b> ".$val.'<br/>';
		/*
		if(is_array($val))
		{
			foreach($val as $key2=>$val2)
			{
				echo "<span style=\"margin-left:30px;\">".$key2.' = '.$val2.'</span><br/>';
			}
		}
		*/
	}
	
	echo '<b>Image type: </b>'. $image_type."<br>";
	echo '<b>Size: </b>'.number_format(($details['FileSize']/1024),2).' Kb<br>';
	echo '<b>Mime type: </b>'.$details['MimeType']."<br>";
	echo'<b>Height: </b>'.$details['COMPUTED']['Height'].'px<br>';
	echo'<b>Width: </b>'.$details['COMPUTED']['Width'].'px<br>';
}

else
{
	echo 'File does not exist';
}

if(file_exists($image_file)){
$details = @exif_read_data($image_file);
}else{
die('File does not exists');
}

//(a). How to get file name and file size using exif data?

//echo '<br>File name is '.$details['FileName'].' and size is '.number_format(($details['FileSize']/1024),2).' Kb';

//(b). How to get image create date time using php?

//echo $details['DateTimeOriginal'];

//(c). How to get camera model and make in php?

//echo '<br>Make is '.$details['Make'].' and model is '.$details['Model'];

//(d).How to get mime type using exif image data?

//echo '<br>Mime type is '.$details['MimeType'];

//(e). How to find image width and height using php exif details?

//echo '<br>Height = '.$details['COMPUTED']['Height'].'px and Width = '.$details['COMPUTED']['Width'].'px';

//or you can use following code.

//echo 'Width = '.$details['ExifImageWidth'].'px Height = '.$details['ExifImageLength']; 

/*
///////GPS
if(file_exists($image_file)){
$details = exif_read_data($image_file);
$sections = explode(',',$details['SectionsFound']);

if(in_array('GPS',array_flip($sections))){
echo format_gps_data($details['GPSLatitude'],$details['GPSLatitudeRef']);
echo '<br/>';
echo format_gps_data($details['GPSLongitude'],$details['GPSLongitudeRef']);
}else{
die('GPS data not found');
}
}else{
die('File does not exists');
}

function format_gps_data($gpsdata,$lat_lon_ref){
$gps_info = array();
foreach($gpsdata as $gps){
list($j , $k) = explode('/', $gps);
array_push($gps_info,$j/$k);
}
$coordination = $gps_info[0] + ($gps_info[1]/60.00) + ($gps_info[2]/3600.00);
return (($lat_lon_ref == "S" || $lat_lon_ref == "W" ) ? '-'.$coordination : $coordination).' '.$lat_lon_ref;
}
*/
unlink($image_file);
?>

</body>
</html>
