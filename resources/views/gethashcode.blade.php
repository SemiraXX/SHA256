

<!-- this is to get file hashcode -->

<?php 

//$checkfile = $_REQUEST['mainfile'];
//$filePath = $_FILES['file']['tmp_name'];

//$dir_to_search = $_FILES['mainfile']['name'];
//echo 'file: '.$dir_to_search.'<br />';
//print_r($_GET['mainfile']);

//echo "hie";

//$SHA256 = hash_file('sha256', public_path('/files/640d6678a5977Mar-12-2023.pdf'));

//echo $SHA256;

$filename = $_FILES['fileupload']['tmp_name'];

echo $filename;
?>

