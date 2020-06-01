SELECT make,sum(pic) FROM log WHERE (yyyy = $year) OR (mm > $month AND yyyy = $year-1) OR (dd > $day AND mm = $month AND yyyy = $year) group by make;
