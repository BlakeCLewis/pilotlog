php index.php >blah.html
------------------------------------------
SELECT pk,
  yyyy,  mm,    dd,
  make,  n,     fromto,
  nlnds, dlnds, sel,
  xcoun, day,   night,
  s_ins, dual,  pic,
  total, cfi,   comments
FROM log
WHERE  pk > 419
ORDER BY yyyy, mm, dd, pk;
SELECT
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
  NULL AS 'cfi', NULL AS 'comments'
FROM log WHERE  pk > 419

SELECT 
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
  NULL AS 'cfi', NULL AS 'comments'
FROM log;
insert into log (
        yyyy,mm,dd,
        make,n,fromto,
        nlnds,dlnds,
        sel,xcoun,
        day,night,
        s_ins,dual,
        pic,total,
        cfi,comments
)VALUES(
       2016,9,3,
      'N3163B','C170B','FTT-LCL',
       1,0,
       1.0,0,
       1.0,0,
       0,0,
       1.0,1.0,
       '','tour river'
);
update log set page=2
where pk>7
and pk<14;

update log 
set page=39
where pk>244
and pk<252
;

SELECT
  page,
  sum(nlnds) AS 'nlnds',
  sum(dlnds) AS 'dlnds',
  round(sum(sel),1)   AS 'sel',
  round(sum(xcoun),1) AS 'xcoun',
  round(sum(day),1)   AS 'day',
  round(sum(night),1) AS 'night',
  round(sum(s_ins),1) AS 's_ins',
  round(sum(dual),1)  AS 'dual',
  round(sum(pic),1)   AS 'pic',
  round(sum(total),1) AS 'total'
FROM log  group by page;
FROM log where page<16;
FROM log where page=16;
select * from log where pk>204 order by YYYY,MM,DD,pk;

update log set page=39 where page=38;
update log set page=38 where page=37;
update log set page=37 where page=36;
update log set page=36 where page=35;
update log set page=35 where page=34;
update log set page=34 where page=33;
----- page entry -----------------
.mode html
echo '<html><table>
          <thead>
             <tr>
               <th>pk</th><th>yyyy</th><th>mm</th><th>dd</th>
               <th>make</th><th>n</th><th>fromto</th>
               <th>nlnds</th><th>dlnds</th><th>sel</th>
               <th>xcoun</th><th>day</th><th>nite</th>
               <th>s_ins</th><th>dual</th><th>pic</th>
               <th>total</th><th>cfi</th><th>comments</th>
            </tr>';
SELECT pk,
       yyyy,  mm,    dd,
       make,  n,     fromto,
       nlnds, dlnds, sel,
       xcoun, day,   night,
       s_ins, dual,  pic,
       total, cfi,   comments
  FROM log
  WHERE page=16
  ORDER BY yyyy DESC, mm DESC, dd DESC, pk DESC;
select '</thead><tbody>';
SELECT
  null as pk,
  null as yyyy, null as mm, null as dd,
  null as make, null as n, null as fromto,
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
FROM log where page<16;
select '</tbody><tfoot>';
SELECT
  null as pk,
  null as yyyy, null as mm, null as dd,
  null as make, null as n, null as fromto,
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
FROM log where page<1+16;
select '</tfoot></table></html>';
