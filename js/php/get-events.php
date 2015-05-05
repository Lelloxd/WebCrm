<?php
$id=1;
$title="Prova";
$start="2015-04-22T14:30:00";
$output_arrays=array("title" => $title, "start" => $start , "allday" => false );
// Send JSON to the client.
echo json_encode($output_arrays);