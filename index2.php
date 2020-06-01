<?php
echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>\n";
echo "<html>\n";
echo "  <head>\n";
echo "    <link href='log.css' media='screen' rel='Stylesheet' type='text/css' />\n";
echo "  </head>\n";
echo "  <body>\n";
echo "    <div class='main'>\n";
include 'func.php';
$d         =getdate(strtotime("91 days ago"));
$then90    =date("Ymd",$d[0]);
$d         =getdate(strtotime("61 days ago"));
$then60    =date("Ymd",$d[0]);
$today     =getdate();
$year      =date("Y",$today[0]);
$last_year =$year-1;
$month     =date("m",$today[0]);
$day       =date("d",$today[0]);
if(isset($_POST['first']) AND isset($_POST['last'])){
	$first=$_POST['first'];
	$last =$_POST['last'];
}else{
	$first=0;
	$last=0;
}
//------ list of entries for page and whole log -------------
$q1a=$q2a= array('pk','yyyy','mm','dd','make','n','fromto','nlnds','dlnds','sel','xcoun','day','night','s_ins','dual','pic','total','cfi','comments');
$q1="SELECT pk,
			yyyy,  mm,    dd,
			make,  n,     fromto,
			nlnds, dlnds, sel,
			xcoun, day,   night,
			s_ins, dual,  pic,
			total, cfi,   comments
		FROM log";
		if($first<$last){
			$q1.=" WHERE pk < ".($last + 1)." AND pk > ".($first - 1);
			$q1.=" ORDER BY yyyy, mm, dd, pk";
		}else if(0)//'false'!= $_GET['limit'])
			$q1 .=" WHERE yyyy * 10000 + mm * 100 + dd > ".$then90;
		if(!($first<$last))
			$q1.=" ORDER BY yyyy DESC, mm DESC, dd DESC, pk DESC";
$a=" SELECT '<a href=''add.php''>new</a>' AS 'pk',
			NULL AS 'yyyy',
			NULL AS 'mm',
			NULL AS 'dd',
			NULL AS 'make',
			NULL AS 'n','";
$b=" Totals' AS fromto, sum(nlnds) AS 'nlnds',
			sum(dlnds) AS 'dlnds',
			round(sum(sel),1)   AS 'sel',
			round(sum(xcoun),1) AS 'xcoun',
			round(sum(day),1)   AS 'day',
			round(sum(night),1) AS 'night',
			round(sum(s_ins),1) AS 's_ins',
			round(sum(dual),1)  AS 'dual',
			round(sum(pic),1)   AS 'pic',
			round(sum(total),1) AS 'total',
			NULL AS 'cfi', NULL AS 'comments'
		FROM log";
$q2=$a.$b;
if($first<$last){
	$page_q=$a."(".$first."-".$last.")".$b." WHERE pk < ".($last + 1)." AND pk > ".($first - 1);
	$page_t=$a."(001-".$last.")".$b." WHERE pk < ".($last + 1);
}
$qpt= array('pk','yyyy','mm','dd','make','n','fromto','nlnds','dlnds','sel','xcoun','day','night','s_ins','dual','pic','total','cfi','comments');
//------- landings last 90 days by type ---------------------
$class3=array('make'=>"class='TEXT'",'nite'=>"class='INTEGER'",'day'=>"class='INTEGER'");
$q3a=array('make','nite','day');
$q3="SELECT make,
			sum(nlnds) AS 'nite',
			sum(dlnds) AS 'day'
		FROM log
		WHERE yyyy * 10000 + mm * 100 + dd > ".$then90." ".
		"GROUP BY make";
//------- Instrument currency -------------------------------
$class5=array('NoInstrApp'=>"class='INTEGER'",'holds'=>"class='INTEGER'",'track'=>"class='INTEGER'");
$q5a=array('NoInstrApp','holds','track');
$q5="SELECT 
			sum(NoInstrApp) AS 'NoInstrApp',
			sum(holds) AS 'holds',
			sum(track) AS 'track'
		FROM log
		WHERE yyyy * 10000 + mm * 100 + dd > ".$then60.";";
//------- Simulated Instrument time -------------------------
$class6=array('Instrument_Traning'=>"class='TEXT'");
$q6a=array('Instrument_Traning');
$q6="select 'Dual: '||sum(a.s_ins) as Instrument_Traning from log a where a.cfi like 'Travis St.John%' or a.cfi like 'Michael Derendinger%'".
	" union ".
	"select 'Total: '||sum(b.s_ins) as Instrument_Traning from log b where b.yyyy>2011 ".
	";";
//-------- time, total and ytd by type ----------------------
$class4=array('make'=>"class='TEXT'",'pic_total'=>"class='REAL'",'pic_ytd'=>"class='REAL'",'total'=>"class='REAL'",'dual'=>"class='REAL'");
$q4a= array('make','pic_ytd','pic_total','dual','total');
$q4="SELECT b.make AS make,
			c.pic_ytd AS pic_ytd,
			b.pic AS pic_total,
			b.dual AS dual,
			b.total AS total
		FROM (SELECT d.make AS make, sum(d.dual) AS dual,sum(d.pic) AS pic,sum(d.total) as total FROM log d GROUP BY make)AS b
		LEFT OUTER JOIN 
			(SELECT a.make AS make, sum(a.pic) AS pic_ytd FROM log a
				WHERE (a.yyyy = ".$year.")
				   OR (a.mm > ".$month." AND a.yyyy =".$last_year.")
				   OR (a.dd > ".$day." AND a.mm = ".$month." AND a.yyyy = ".$last_year.")
				GROUP BY make 
			)AS c
			ON b.make = c.make
			ORDER BY b.make;";
//------- main -----------------------------
if($db=new PDO("sqlite:flightlog")){
	echo "      <center><h3>Blake C. Lewis</h3></center>\n";
	echo "      <div class='item'>\n";
	echo "        <div class='left'>\n";
	echo "          <table width='98%'>\n";
	                  getsomething($db,$q4,-1,'','Hours in Type',0,$class4,$q4a);
	echo "          </table>\n";
	echo "        </div>\n";
	echo "        <div class='left'>\n";
#	echo "          <form action='".$phpself."' method='post'><center>\n";
#	echo "            Calculate Totals for a Page<br />\n";
#	echo "            first - last<br />\n";
#	echo "            <input type='text' name='first' size='4' />-<input type='text' name='last'  size='4' /><br />\n";
#	echo "            <input type='submit' value='submit' /><br />\n";
#	echo "          </center></form >\n";
	echo "        </div>\n";
	echo "        <div class='left'>\n";
	echo "          <table width='98%'>\n";
	                  getsomething($db,$q3,-1,'','Landings Last 90 Days',   0,$class3,$q3a);
	echo "          </table>\n";
	echo "          <table width='98%'>\n";
	                  getsomething($db,$q5,-1,'','Instruments Last 60 Days',0,$class5,$q5a);
	echo "          </table>\n";
	echo "          <table width='98%'>\n";
	                  getsomething($db,$q6,-1,'',' ',0,$class6,$q6a);
	echo "          </table>\n";
	echo "        </div>\n";
	echo "      </div>\n";
	echo "      <div style='clear:both'></div>\n";
	echo "      <div class='item'>\n";
	echo "        <table width='98%'>\n";
					$classes=getColumnClass($db,'log');
					if(!($first<$last))
						getsomething($db,$q2,-1,'',0,0,$classes,$q2a);
						getsomething($db,$q1,0,'edit.php','Flight Log',1,$classes,$q1a);
					if($first<$last){
						getsomething($db,$page_q,-1,'',0,0,$classes,$q2a);
						getsomething($db,$page_t,-1,'',0,0,$classes,$q2a);
					}
	echo "        </table>\n";
	echo "      </div>\n";
}
	if(isset($_GET['limit']) AND 'false' != $_GET['limit']){
	echo "      <div class='item'><a href='list.php?limit=false'>show all</a></div>\n";
}
echo "    </div>\n";
echo "  </body>\n";
echo "</html>\n";
?>
