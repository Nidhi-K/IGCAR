<?php
using (PDFDoc doc = new PDFDoc(inputPath + "newsletter.pdf"))
{
    doc.InitSecurityHandler();
    // remove all even pages
    if(doc.GetPageCount() > 1)
    {
        PageIterator itr = doc.GetPageIterator();
        itr.Next(); // skip first page
        while (itr.HasNext())
        {
            doc.PageRemove(itr); // remove even pages
            itr.Next();
        }
    }
    pdftron.PDF.Convert.HTMLOutputOptions options = new pdftron.PDF.Convert.HTMLOutputOptions();
    options.SetInternalLinks(true);
    options.SetExternalLinks(false);
    options.SetPreferJPG(false);
    options.SetDPI(300);
    options.SetMaximumImagePixels(3000000);
    options.SetSimplifyText(true);
    options.SetScale(2.0);
    pdftron.PDF.Convert.ToHtml(doc, outputPath + "newsletter_odd_pages", options);
?>

<?php
/*
$target_dir = "D:/xampp/htdocs/BITS/Word to Text/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

$a = explode('.', $target_file);
	$fullpath=$a[0];
//	echo $fullpath;
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
*/
?>

<?php
/*
$tags = get_meta_tags("D:/xampp/htdocs/BITS/Word to Text/REPORT/word/document.xml");
var_dump($tags);
*/
?>
// loop through docx xml dom
    while ($reader->read()){ 
        // look for new paragraphs
        if ($reader->nodeType == XMLREADER::ELEMENT && $reader->name === 'w:p'){ 
            // set up new instance of XMLReader for parsing paragraph independantly
            $paragraph = new XMLReader;
            $p = $reader->readOuterXML();
            $paragraph->xml($p);
			
			echo hi;
		?>
            

 /*       // search for heading
            preg_match('/<w:pStyle w:val="(Heading.*?[1-6])"/',$p,$matches);
            switch($matches[1]){
                case 'Heading1': $formatting['header'] = 1; break;
                case 'Heading2': $formatting['header'] = 2; break;
                case 'Heading3': $formatting['header'] = 3; break;
                case 'Heading4': $formatting['header'] = 4; break;
                case 'Heading5': $formatting['header'] = 5; break;
                case 'Heading6': $formatting['header'] = 6; break;
                default:  $formatting['header'] = 0; break;
            }
            
			
	
            // open h-tag or paragraph
            $text .= ($formatting['header'] > 0) ? '<h'.$formatting['header'].'>' : '<p>';
            
            // loop through paragraph dom
            while ($paragraph->read()){
                // look for elements
                if ($paragraph->nodeType == XMLREADER::ELEMENT && $paragraph->name === 'w:r'){
                    $node = trim($paragraph->readInnerXML());

                    // add <br> tags
                    if (strstr($node,'<w:br ')) $text .= '<br>';

                    // look for formatting tags                    
                    $formatting['bold'] = (strstr($node,'<w:b/>')) ? (($formatting['bold'] == 'closed') ? 'open' : $formatting['bold']) : (($formatting['bold'] == 'opened') ? 'close' : $formatting['bold']);
                    $formatting['italic'] = (strstr($node,'<w:i/>')) ? (($formatting['italic'] == 'closed') ? 'open' : $formatting['italic']) : (($formatting['italic'] == 'opened') ? 'close' : $formatting['italic']);
                    $formatting['underline'] = (strstr($node,'<w:u ')) ? (($formatting['underline'] == 'closed') ? 'open' : $formatting['underline']) : (($formatting['underline'] == 'opened') ? 'close' : $formatting['underline']);
                    
                    // build text string of doc
                    $text .=     (($formatting['bold'] == 'open') ? '<strong>' : '').
                                (($formatting['italic'] == 'open') ? '<em>' : '').
                                (($formatting['underline'] == 'open') ? '<u>' : '').
                                htmlentities(iconv('UTF-8', 'ASCII//TRANSLIT',$paragraph->expand()->textContent)).
                                (($formatting['underline'] == 'close') ? '</u>' : '').
                                (($formatting['italic'] == 'close') ? '</em>' : '').
                                (($formatting['bold'] == 'close') ? '</strong>' : '');
                    
                    // reset formatting variables
                    foreach ($formatting as $key=>$format){
                        if ($format == 'open') $formatting[$key] = 'opened';
                        if ($format == 'close') $formatting[$key] = 'closed';
                    }
                }    
            }        
            $text .= ($formatting['header'] > 0) ? '</h'.$formatting['header'].'>' : '</p>';
        }
    
    }
    $reader->close();
    
    // suppress warnings. loadHTML does not require valid HTML but still warns against it...
    // fix invalid html
    $doc = new DOMDocument();
    $doc->encoding = 'UTF-8';
    @$doc->loadHTML($text);
$goodHTML = simplexml_import_dom($doc)->asXML();

*/

?>