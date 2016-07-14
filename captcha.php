<?php session_start();
if(isset($_POST["key"])) { //check if the user generated key is set or not
$img = imagecreatetruecolor(200,70); //create an image with the given dimensions
$back= mt_rand(16, 0xFFFFFF); //set a random background color
imagefilledrectangle($img,0,0,200,70,$back); //fill the generated image with the set background
$textcol= 0; //set the color of the text
$font_file = 'fonts/sixty.ttf'; //path to the font file 
$stringer = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrsuvwxyz1234567890'; //accepted symbols stored in as a string. NOTE: 't' has been omitted due                                                                                to font limitations purposely

$size = strlen($stringer); //know the size of the accepted symbol string
$code=''; //initialise-opional

$pixelcol= 0; //select a color
for($i=0;$i<300;$i++) { //color the particular pixels governed by the loop
    imagesetpixel($img,rand()%200,rand()%70,$pixelcol);
} 

for($i=0;$i<rand(1,8);$i++) { //draw lines governed by the loop
    imageline($img,0,rand()%70,200,rand()%70,$pixelcol);
}

for ($i = 0; $i< 5;$i++) { //loop to randomly select 5 charcaters from the accepted character list
$letter = $stringer[rand(0, $size-1)];
imagefttext($img, 24, 0, 10+($i*40), rand(45,55), $textcol, $font_file, $letter); //display the charcaters
    $code.=$letter; //store the charcaters randomly generated as a string
}
$key=$_POST["key"];
$_SESSION['captcha'] = $code;//store the generated characters in session storage
$filename='image'.$key.'.png'; //create the filename corresponding to the obtained key
$_SESSION['filen']= $filename;
imagepng($img,$filename); //save the image as png 
}

else if(isset($_POST["target"])) { //if the user key is not set then check for the user's input to be present and validate
    $target = $_POST["target"];
    $filename = $_SESSION['filen'];
    if($_SESSION['captcha']==$target) //if not validated/validated, then echo accordingly
    {unlink($filename);echo 0;}
    else {unlink($filename);echo 1;}
}
?>