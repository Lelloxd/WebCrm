<?php

require("connection.php");
session_start();
$utente=$_SESSION['login_id'];
$query = sqlsrv_query($conn,"SELECT * FROM CRMAttivita WHERE IdEsecutore='$utente' AND ShowInCalendario=1 ORDER BY DataInizio ");
while ($val=sqlsrv_fetch_array($query)) {
$title=htmlentities($val["Descrizione"],ENT_COMPAT, "ISO-8859-1");
$start=$val["DataInizio"]->format("Y-m-d\TH:i:s");
$end=$val["DataFine"]->format("Y-m-d\TH:i:s");
$today = date("Y-m-d\TH:i:s");

$url="attivita.php?id=".$val["IdAttivita"];
$id=1;
if($val["Conclusione"]==1)
    $output_arrays[]=array("title" => $title, "start" => $start , "end" => $end , "allday" => false , "backgroundColor" => '#B0B0B0' , "borderColor" => '#B0B0B0');
else
    $output_arrays[]=array("title" => $title, "start" => $start , "end" => $end , "allday" => false , "url" => $url);
}
echo json_encode($output_arrays);
?>