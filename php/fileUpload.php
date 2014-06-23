<?php

	$dir="../images/";
	foreach($_FILES as $file){
		if ($file["error"] > 0) {
			echo 0;
		} else {
			echo "Upload: " . $file["name"] . "<br>";
			echo "Type: " . $file["type"] . "<br>";
			echo "Size: " . ($file["size"] / 1024) . " kB<br>";
			echo "Stored in: " . $file["tmp_name"];
		}
	}

	if(file_exists($dir)){
		foreach($_FILES as $file){
			move_uploaded_file($file["tmp_name"], $dir. $file["name"]);
			echo $dir.$file["name"];
		}

	}
	else{
		echo 0;
	}

	$names=$_POST['names'];

	unset($_POST['names']);
	print_r($names);
	$i=0;
	foreach($_POST as $data){

		//$data = $_POST['image'];

		// remove the prefix
		$uri =  substr($data,strpos($data,",")+1);

		// create a filename for the new image
		//$file = md5(uniqid()) . '.png';
		$name=explode(".", $names[$i]);
		$file ="../images/thumbnails/".$name[0]. '.png';

		// decode the image data and save it to file
		file_put_contents($file, base64_decode($uri));

		// return the filename
		echo $file;
		$i++;
	}
?>
