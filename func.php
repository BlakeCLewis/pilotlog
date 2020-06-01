<?php
date_default_timezone_set('America/Chicago');
function getColumnClass($db,$table){
	$sth=$db->prepare("PRAGMA table_info('".$table."')");
	$sth->execute();
	foreach($sth->fetchAll() as $entry){
		$classes[$entry['name']]="class='".$entry['type']."'";
		//print_r($entry);
	}
	return $classes;
}
function getsomething($dbh,$q,$index,$linker,$head,$foot,$classes,$column_names){
	// requires: db handle, query string
	//   for no link set index to -1 and linker to NULL
	//   >0 will get a header or footer
	$indents=array(3=>'  ',4=>'    ',6=>'      ',8=>'        ',10=>'          ',12=>'            ',14=>'              ');
	$sth = $dbh->prepare($q);
	$sth->setFetchMode(PDO::FETCH_ASSOC);
	$sth->execute();
	$columnCnt=$sth->columnCount();
	echo $indents[10]."<tbody>\n";
	$everyother=array('every','other');
	$j=0;
	foreach($sth->fetchAll() as $entry){
		echo $indents[12]."<tr class='".$everyother[$j%2]."'>\n";
		for($n=0;$n<$columnCnt;$n++){
			if($index==$n){
				echo $indents[14]."<td><a href='".$linker."?".$column_names[$n]."=".$entry[$column_names[$n]]."'>".$entry[$column_names[$n]]."</a></td>\n";
			}else{
				$fieldName=$column_names[$n];
				echo $indents[14]."<td ".$classes[$fieldName]." >".$entry[$column_names[$n]]."</td>\n";
			}
		}
		echo $indents[12]."</tr>\n";
		$j++;
	}
	echo $indents[10]."</tbody>\n";
	if($head){
		echo $indents[10]."<thead>\n";
		echo $indents[12]."<tr>\n";
		echo $indents[14]."<th colspan='".$columnCnt."'>".$head."</th>\n";
		echo $indents[12]."</tr>\n";
		echo $indents[12]."<tr>\n";
		for($n=0;$n<$columnCnt;$n++)
			echo $indents[14]."<th>".$column_names[$n]."</th>\n";
		echo $indents[12]."</tr>\n";
		echo $indents[10]."</thead>\n";
	}
	if($foot){
		echo $indents[10]."<tfoot>\n";
		echo $indents[12]."<tr>\n      ";
		for ($n=0;$n < $columnCnt;$n++)
			echo $indents[14]."<th>".$column_names[$n]."</th>\n";
		echo $indents[12]."</tr>\n";
		echo $indents[10]."</tfoot>\n";
	}
}
function date_select($description,$mm,$dd,$yyyy){
	$indents=array(2=>'  ',4=>'    ',6=>'      ',8=>'        ',10=>'          ',12=>'            ',14=>'              ');
	$ds = $description . "<br />\n";
	$months=array('01','02','03','04','05','06','07','08','09','10','11','12');
	$ds .=$indents[12]."<select name='mm'>\n";
	foreach($months as $n){
		$ds .= $indents[14]."<option value='".$n."'";
		if($n==$mm)
			$ds .= " selected='selected'";
		$ds .= ">".$n."</option>\n";
	}
	$ds .= $indents[12]."</select>\n";
	$days=array('01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','21','22','23','24','25','26','27','28','29','30','31');
	$ds .= $indents[12]."<select name='dd'>\n";
	foreach($days as $n){
		$ds .= $indents[14]."<option value='".$n."'";
		if($n==$dd)
			$ds .= " selected='selected'";
		$ds .= ">".$n."</option>\n";
	}
	$ds .= $indents[12]."</select>\n";
	$years=array('2020','2019','2018','2017','2016','2015','2014','2013','2012','2011','2010','2009','2008','2007','2006');
	$ds .= $indents[12]."<select name='yyyy'>\n";
	foreach($years as $n){
		$ds .= $indents[14]."<option value='".$n."'";
		if($n==$yyyy)
			$ds .= " selected='selected'";
		$ds .= ">".$n."</option>\n";
	}
	$ds .= $indents[12]."</select>\n";
	return $ds;
}
?>
