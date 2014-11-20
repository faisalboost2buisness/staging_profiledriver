<?php
$uploaddir = '/home/gspedia/public_html/exclusiveprivatesale/profilepic/';
$category_image="$uploaddir".$_FILES['uploadfile']['name'];
$type=$_FILES['uploadfile']['type'];
	if(move_uploaded_file($_FILES['uploadfile']['tmp_name'],$category_image)) {
		$imagefilename=$_FILES['uploadfile']['name'];
		$pic = "$uploaddir/$imagefilename";
		$loc            = "$uploaddir/thumb/";
		$new_name       = "$imagefilename";
		$new_w          =150;
		$new_h=         150;
		$this->main_model->resize_image($pic,$loc,$new_name,$new_w,$new_h,$type);

		echo "$imagefilename";
	} else {
		echo "error";
	}
?>