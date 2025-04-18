<?php

	require_once('core/PictureCut.php');

	try {

		$pictureCut = PictureCut::createSingleton();  //creating an singleton instance of the class PictureCut

		if($pictureCut->crop()){  //calling the method that will cut
			print $pictureCut->toJson();  //print the data to the plugin (client side).
		} else {
			print $pictureCut->exceptionsToJson(); //print exceptions if the upload fails
		}

	} catch (Exception $e) {
		print $e->getMessage();  //print exceptions instance.
	}

