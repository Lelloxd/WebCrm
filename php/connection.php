<?php
$myServer = "VM10\SQL2012";
$myDB = array( "Database"=>"A.NEiT_Sviluppo", "UID"=>"sa", "PWD"=>"upac05");
// connection to the database
$conn = sqlsrv_connect($myServer, $myDB);
if(!$conn)
die ( print_r( sqlsrv_errors(), true));
/*else
{
$res=sqlsrv_query($conn,"SELECT * FROM CRMCampagne");
while($ris=sqlsrv_fetch_array($res))
echo $ris["Nome"];
}*/
?>