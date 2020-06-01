#!/bin/sh
echo '<html>';
for i in {0..67} ;do 
echo ' <table><tr>
          <th width=26>pk</th><th>yyyy</th><th>mm</th><th>dd</th>
          <th width=80>make</th><th width=60>n</th><th width=200>fromto</th>
          <th>nlnds</th><th>dlnds</th><th>sel</th>
          <th>xcoun</th><th>day</th><th>nite</th>
          <th>s_ins</th><th>dual</th><th>pic</th>
          <th>total</th><th>cfi</th><th>comments</th>
       </tr>';
sqlite3 flightlog <<EOF
.mode html
SELECT pk,
       yyyy,  mm,    dd,
       make,  n,     fromto,
       nlnds, dlnds, sel,
       xcoun, day,   night,
       s_ins, dual,  pic,
       total, cfi,   comments
  FROM log
  WHERE page=$i
  ORDER BY yyyy, mm, dd, pk;
SELECT
  null as pk,
  null as yyyy, null as mm, null as dd,
  null as make, null as n, 'page total:' as fromto,
  sum(nlnds) AS 'nlnds',
  sum(dlnds) AS 'dlnds',
  round(sum(sel),1)   AS 'sel',
  round(sum(xcoun),1) AS 'xcoun',
  round(sum(day),1)   AS 'day',
  round(sum(night),1) AS 'night',
  round(sum(s_ins),1) AS 's_ins',
  round(sum(dual),1)  AS 'dual',
  round(sum(pic),1)   AS 'pic',
  round(sum(total),1) AS 'total',
  null as cfi,
  null as comment
FROM log where page=$i ;
SELECT
  null as pk,
  null as yyyy, null as mm, null as dd,
  null as make, null as n, 'amt_fwd:' as fromto,
  sum(nlnds) AS 'nlnds',
  sum(dlnds) AS 'dlnds',
  round(sum(sel),1)   AS 'sel',
  round(sum(xcoun),1) AS 'xcoun',
  round(sum(day),1)   AS 'day',
  round(sum(night),1) AS 'night',
  round(sum(s_ins),1) AS 's_ins',
  round(sum(dual),1)  AS 'dual',
  round(sum(pic),1)   AS 'pic',
  round(sum(total),1) AS 'total',
  null as cfi,
  null as comment
FROM log where page<$i ;
SELECT
  null as pk,
  null as yyyy, null as mm, null as dd,
  null as make, null as n, 'total:' as fromto,
  sum(nlnds) AS 'nlnds',
  sum(dlnds) AS 'dlnds',
  round(sum(sel),1)   AS 'sel',
  round(sum(xcoun),1) AS 'xcoun',
  round(sum(day),1)   AS 'day',
  round(sum(night),1) AS 'night',
  round(sum(s_ins),1) AS 's_ins',
  round(sum(dual),1)  AS 'dual',
  round(sum(pic),1)   AS 'pic',
  round(sum(total),1) AS 'total',
  null as cfi,
  null as comment
FROM log where page<1 + $i ;
EOF
done
echo '</table></html>';
