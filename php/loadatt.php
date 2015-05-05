<?php
$entrato=0;
$oldLocale = setlocale(LC_TIME, 'it_IT');
setlocale(LC_TIME, $oldLocale);
$tempo= utf8_encode( strftime("%A %d %B %Y") );
echo "<div id='oggi-header'><b>Oggi</b><i>, $tempo </i><a id='todayrefresh' href='javascript:aggiorna()'><span class='glyphicon glyphicon-refresh'></span></a></div>";
$time = new DateTime;
$time = $time->format('Y-m-d');
require("connection.php");
session_start();
$utente=$_SESSION['login_id'];
$query = sqlsrv_query($conn,"SELECT * FROM CRMAttivita WHERE IdEsecutore='$utente' AND Conclusione<>1 ORDER BY DataInizio ");
while ($val=sqlsrv_fetch_array($query)) {
    $newformat = $val["DataInizio"]->format('Y-m-d');
    
    //echo "nformat= $newformat<br>oggi=$time <br>";
    if($newformat==$time)
    {
	$entrato=1;
        $ora=$val["DataInizio"]->format('H:m');
        $descrattivita=$val["Descrizione"];
        $descrattivita= htmlentities($descrattivita,ENT_COMPAT, "ISO-8859-1");
        $idtipoatt=$val["IdTipoAttivita"];
        $idcontatto=$val["IdContatto"];
        $tipoatt=sqlsrv_fetch_array(sqlsrv_query($conn,"SELECT Descrizione FROM CRMTipiAttivita WHERE IdTipoAttivita='$idtipoatt'"));
        $idatt=$val["IdAttivita"];
         $contatto=sqlsrv_fetch_array(sqlsrv_query($conn,"SELECT RagioneSociale FROM Anagrafica WHERE IdAnagrafica='$idcontatto'"));
        if($contatto=="")
            $contatto=sqlsrv_fetch_array(sqlsrv_query($conn,"SELECT RagioneSociale FROM CRMLead WHERE IdLead='$idcontatto'"));
        $funzione='javascript:collapse("'.$idatt.'","a'.$idatt.'")';
            echo "<a href=$funzione class='nounderline' ><div class='attivita' id=a$idatt><span class='glyphicon glyphicon-transfer'></span> <b>".$tipoatt["Descrizione"]."</b>";
            echo "<br><span title='Nominativo' class='glyphicon glyphicon-user'></span> ".$contatto["RagioneSociale"];
            //echo "<br><button class='mndescbtn' onclick=mostranascondi('desc$idatt');>Mostra/Nascondi descrizione</button>";
            echo "<label class='ora-giorno-att'><span title='Ora' class='glyphicon glyphicon-time'></span> $ora</label>";
            //echo "<div class='descatt' id='desc$idatt'>$descrattivita</div>";
            echo "</div>";
        //sleep ( 1 );
        
    }  
}
if($entrato==0)
	echo "<div class='noplanned'>Nessun Attivit&agrave; pianificata per oggi</div>";

?>