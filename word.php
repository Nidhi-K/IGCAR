
<?php
$target_dir = "D:/xampp/htdocs/BITS/Word to Text/";
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

$document=basename( $_FILES["fileToUpload"]["name"]);

?>


<?php
 
/*Name of the document file*/
echo extracttext($document);
unlink($document);
 
/**Function to extract text*/
function extracttext($filename) {
    //Check for extension
    $ext = end(explode('.', $filename));
 
    //if its docx file
    if($ext == 'docx')
    $dataFile = "word/document.xml";
    //else it must be odt file
    else
    $dataFile = "content.xml";     
       
    //Create a new ZIP archive object
    $zip = new ZipArchive;
 
    // Open the archive file
    if (true === $zip->open($filename))
	 {
        
		// If successful, search for the data file in the archive
        if (($index = $zip->locateName($dataFile)) !== false)
		 {
            // Index found! Now read it to a string
            $text = $zip->getFromIndex($index);
            // Load XML from a string
            // Ignore errors and warnings
			
			$xml = simplexml_load_string($text, 'SimpleXMLElement', LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING);
        	
			/*
			This statement only works in PHP 5.5.2 and above. Our verison of PHP is 5.2.6
			$xml = DOMDocument::loadXML($text, LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING); 			
			*/
		
            // Remove XML formatting tags and return the text
            return strip_tags($xml->saveXML());
        }
        //Close the archive file
        $zip->close();
    }
 
    // In case of failure return a message
    return "File not found";
}
 
?>