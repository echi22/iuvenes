<?php
function dateToBD($date){
    $day = substr($date, 0,2);
    $month = substr($date, 3, 2);
    $year = substr($date, 6, 4);
    return $year."/".$month."/".$day;
}
function dateFromBD($date){
    $day = substr($date, 9,2);
    $month = substr($date, 6, 2);
    $year = substr($date, 0, 4);
    return $day."/".$month."/".$year;
}
?>
