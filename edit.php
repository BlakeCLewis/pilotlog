<?php
require 'func.php';
$pk=$_GET['pk'];

$q1="SELECT pk,
		mm,    dd,    yyyy,
		make,  n,	  fromto,
		NoInstrApp ,holds, track,
		nlnds, dlnds, sel,
		xcoun, day,   night,
		s_ins, dual,  pic,
		total, cfi,   comments
	FROM log
	WHERE pk=".$pk;
if($db=new PDO("sqlite:flightlog")){
	$result=$db->query($q1)->fetch(PDO::FETCH_ASSOC);
	print_r($db->errorInfo());
	$make=$result['make'];
	$n=$result['n'];
	$mm=$result['mm'];
	$dd=$result['dd'];
	$yyyy=$result['yyyy'];
	$fromto=$result['fromto'];
	$NoInstrApp=$result['NoInstrApp'];
	$holds=$result['holds'];
	$track=$result['track'];
	$nlnds=$result['nlnds'];
	$dlnds=$result['dlnds'];
	$sel=$result['sel'];
	$xcoun=$result['xcoun'];
	$day=$result['day'];
	$night=$result['night'];
	$s_ins=$result['s_ins'];
	$dual=$result['dual'];
	$pic=$result['pic'];
	$total=$result['total'];
	$cfi=$result['cfi'];
	$comments=$result['comments'];

echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>\n";
echo "<html>\n";
echo "  <head>\n";
echo "    <link href='log.css' media='screen' rel='Stylesheet' type='text/css' />\n";
echo "  </head>\n";
echo "  <body>\n";
echo "  <div class='main'>\n";
echo "    <div class='item'>";
echo "      <form action='update.php' method='post'>\n";
echo "        <input type='hidden' name='pk' value='".$pk."' />\n";
echo "        <table>\n";
echo "          <thead>\n";
echo "            <tr><th colspan='2'>Edit Entry #".$pk."</th></tr>\n";
echo "          </thead>\n";
echo "          <tfoot>\n";
echo "            <tr><th colspan='2'><input type='submit' name='update' value='update' /></th></tr>\n";
echo "          </tfoot>\n";
echo "          <tbody class='every'>\n";
echo "            <tr>\n";
echo "              <td>n<br /><input type='text' name='n' value='".$n."' /></td>\n";
echo "              <td>make<br /><input type='text' name='make' value='".$make."' /></td>\n";
echo "            </tr>\n";
echo "            <tr>\n";
echo "              <td>". date_select('mm-dd-yyyy',$mm,$dd,$yyyy) ."          </td>\n";
echo "              <td>to-from<br /><input type='text' name='fromto' value='".$fromto."'/></td>\n";
echo "            </tr>\n";
echo "              <tr>\n";
echo "                <td colspan=2>\n";
echo "                  NoInstrApp <input type='text' name='NoInstrApp' value='".$NoInstrApp."' size='2' />\n";
echo "                  Holds      <input type='text' name='holds'      value='".$holds."'      size='2' />\n";
echo "                  Track      <input type='text' name='track'      value='".$track."'      size='2' />\n";
echo "                </td>\n";
echo "              </tr>\n";
echo "            <tr>\n";
echo "              <td>dlnds<br /><input type='text' name='dlnds' value='".$dlnds."' /></td>\n";
echo "              <td>nlnds<br /><input type='text' name='nlnds' value='".$nlnds."' /></td>\n";
echo "            </tr>\n";
echo "            <tr>\n";
echo "              <td>sel<br />  <input type='text' name='sel'   value='".$sel."' /></td>\n";
echo "              <td>xcoun<br /><input type='text' name='xcoun' value='".$xcoun."'' /></td>\n";
echo "            </tr>\n";
echo "            <tr>\n";
echo "              <td>day<br />  <input type='text' name='day'   value='".$day."' /></td>\n";
echo "              <td>night<br /><input type='text' name='night' value='".$night."' /></td>\n";
echo "            </tr>\n";
echo "            <tr>\n";
echo "              <td>pic<br /> <input type='text' name='pic'  value='".$pic."' /></td>\n";
echo "              <td>dual<br /><input type='text' name='dual' value='".$dual."' /></td>\n";
echo "            </tr>\n";
echo "            <tr>\n";
echo "              <td>total<br /><input type='text' name='total' value='".$total."' /></td>\n";
echo "              <td>s_ins<br /><input type='text' name='s_ins' value='".$s_ins."' /></td>\n";
echo "            </tr>\n";
echo "            <tr>\n";
echo "              <td>comments<br /><input type='text' name='comments' value='".$comments."' /></td>\n";
echo "              <td>cfi<br /><input type='text' name='cfi' value='".$cfi."' /></td>\n";
echo "            </tr>\n";
echo "          </thead\n";
echo "        </table>\n";
echo "      </form>\n";
echo "    </div>\n";
echo "    <div class='item'>\n";
echo "      <div class='left'><a href='list.php'>Back to List</a></div>\n";
echo "      <div class='right'><a href='delete.php?pk=".$pk."'>Delete Entry #".$pk."</a></div>\n";
echo "    </div>\n";
echo "  </div>\n";
echo "  </body>\n";
echo "</html>\n";
}
?>
