<?php
	$pk=$_GET['pk'];
	$q="DELETE FROM log ".
		"WHERE pk=".$pk;
	$db=sqlite_open('flightlog');
		$result = sqlite_exec($db,$q);
	sqlite_close($db);
header( 'location: list.php' );
?>

