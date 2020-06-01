<?php
	$pk=$_POST['pk'];
	$mm=$_POST['mm'];
	$dd=$_POST['dd'];
	$yyyy=$_POST['yyyy'];
	$make=$_POST['make'];
	$n=$_POST['n'];
	$fromto=$_POST['fromto'];
	$NoInstrApp=$_POST['NoInstrApp'];
	$holds=$_POST['holds'];
	$track=$_POST['track'];
	$nlnds=$_POST['nlnds'];
	$dlnds=$_POST['dlnds'];
	$sel=$_POST['sel'];
	$xcoun=$_POST['xcoun'];
	$day=$_POST['day'];
	$night=$_POST['night'];
	$s_ins=$_POST['s_ins'];
	$dual=$_POST['dual'];
	$pic=$_POST['pic'];
	$total=$_POST['total'];
	$cfi=$_POST['cfi'];
	$comments=$_POST['comments'];
	$q2="UPDATE log ".
			"SET mm=".$mm.", dd=".$dd.", yyyy=".$yyyy.", ".
			"make='".$make."', n='".$n."', fromto='".$fromto."', ".
			"NoInstrApp=".$NoInstrApp.", holds=".$holds.", track=".$track.",".
			"nlnds=".$nlnds.", dlnds=".$dlnds.", ".
			"sel=".$sel.", xcoun=".$xcoun.", ".
			"day=".$day.", night=".$night.", ".
			"s_ins=".$s_ins.", dual=".$dual.", ".
			"pic=".$pic.", total=".$total.", ".
			"cfi='".$cfi."', comments='".$comments."' ".
			"WHERE pk = ".$pk;
if($db=new PDO("sqlite:flightlog")){
		$db->exec($q2);
}
header( 'location: list.php' );
?>

