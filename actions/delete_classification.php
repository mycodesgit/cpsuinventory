<?php
	include '../init.php';

	$id = $_GET['id'];

	$sql = "UPDATE classification SET classdel='0' WHERE id=?";
	$stmt = $DB->prepare($sql);
	$stmt->bind_param("s", $id);
	if ($stmt->execute()) {
	    //echo "deleted";
	} else {
	    //echo "error";
	}
?>
