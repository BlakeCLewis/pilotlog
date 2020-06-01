<?php
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

if($db=new PDO("sqlite:flightlog")){
	$q2="INSERT INTO log(
			pk,mm,dd,yyyy,
			make,n,fromto,nlnds,
			NoInstrApp,holds,track,
			dlnds,sel,xcoun,day,
			night,s_ins,dual,pic,
			total,cfi,comments)
		VALUES(NULL,".$mm.",".$dd.",".$yyyy.",
			'".$make."','".$n."','".$fromto."',".$nlnds.",
			".$NoInstrApp.",".$holds.",".$track.",
			".$dlnds.",".$sel.",".$xcoun.",".$day.",
			".$night.",".$s_ins.",".$dual.",".$pic.",
			".$total.",'".$cfi."','".$comments."')";
	$sth=$db->exec($q2);
};
header( 'location: list.php' );	
?>
