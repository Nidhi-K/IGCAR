
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>

<?php
$url = 'https://api.idolondemand.com/1/api/sync/ocrdocument/v1?file=5_contents.jpeg';
 
$output_dir = "D:/xampp/htdocs/BITS/Image Metadata/";
if(isset($_FILES["file"]))
{
 
    $fileName = md5(date('Y-m-d H:i:s:u')).$_FILES["file"]["name"]; //unique filename
 
    //move the file to uploads folder
    move_uploaded_file($_FILES["file"]["tmp_name"],$output_dir.$fileName);
     
     
    //multipart form post using CURL
    $filePath = realpath($output_dir.$fileName);
    $post = array('apikey' => '4f2bba81-1841-4d62-9d42-a140c363bb0c',
                    'mode' => 'document_photo',
                    'file' =>'@'.$filePath); 
	     
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_POST,1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    $result=curl_exec ($ch);
    curl_close ($ch);
    echo $result;
 
    /*
    //If you want to return only text use this.
    $json = json_decode($result,true);
    if($json && isset($json['text_block']))
    {
        $textblock =$json['text_block'][0];
        echo $textblock['text'];
    }
     */
    //remove the file
    unlink($filePath);
	
	echo $result;
 }
?>

<?php
//$output_dir = "D:/xampp/htdocs/BITS/Image Metadata/";
?>
</body>
</html>
