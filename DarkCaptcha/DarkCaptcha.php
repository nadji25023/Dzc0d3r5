<?php
//|------------------------------------------------|
//| DZ.c0d3rs[@]gmail[dot]com                 v1.0 |
//| 13/03/2013   DarkCaptcha                       |
//|      -Extract text from CAPTCHAS               |
//|                                                |
//|  [Public release]      DZ-c0d3rs Security Team |
//|------------------------------------------------|

# Share the c0de!

# DZ-c0d3rs Crew 
# DZ.c0d3rs[@]gmail[dot]com

# Greetz to 
# The Crazy 3d Team
# and the DZ-c0d3rs crew

# NOTES:
 
# You must have tesseract-ocr installed in your machine before execute this script. 
# You could get it from https://code.google.com/p/tesseract-ocr. 

# This was written for educational purpose only. Use it at your own risk.
# Author will be not responsible for any damage caused! User assumes all responsibility 
# Intended for authorized Web Application Pen Testing Only!

# BE WARNED, THIS TOOL IS VERY LOUD..

	$start = timer();
	$url = 'https://worldoftanks.eu/registration/en/'; // Put your url here
	$img = ''; // the file name of the image
	
	$ch = curl_init($url.$img);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "");
    curl_setopt($ch, CURLOPT_COOKIEJAR, __DIR__ . '\cookie.txt');
    curl_setopt($ch, CURLOPT_COOKIEFILE, __DIR__ . '\cookie.txt');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$data = curl_exec($ch); // retrieve image
	
	$image = imagecreatefromstring($data);
	if(!$image){echo 'Error, no image ?';exit;} // Just checking ...

	// Let's flip it !
	$width = imagesx($image);
	$height = imagesy($image);
	$flipped = imagecreatetruecolor($width, $height);
	imagecopyresampled($flipped, $image, 0, 0, $width-1, 0, $width, $height, -$width, $height);
	imagedestroy($image);
	
	imagepng($flipped, 'image.png'); // Saving it to a file
	
	exec('tesseract.exe image.png code'); // Let's OCR !!!
	
	$code = trim(file_get_contents('code.txt')); // Getting the code
	
	$ch2 = curl_init($url);
    curl_setopt($ch2, CURLOPT_POST, 1);
    curl_setopt($ch2, CURLOPT_POSTFIELDS, "code=$code&submit=****"); // adjust the sending URL
    curl_setopt($ch2, CURLOPT_COOKIEJAR, __DIR__ . '\cookie.txt');
    curl_setopt($ch2, CURLOPT_COOKIEFILE, __DIR__ . '\cookie.txt');
    curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);

	$output = curl_exec($ch2); // Submitting the code
	
	echo $output; // output data
	echo '<br> Code sent: '. $code;
	
	// Some statistics
	$end = timer();
	$diff = $end - $start;
	echo '<br>Seconds: '. $diff;
	
	function timer(){
		list($usec, $sec) = explode(" ",microtime());
		return((float)$usec + (float)$sec);
	}

?>