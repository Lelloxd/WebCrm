<?php
$entrato=0;
$oldLocale = setlocale(LC_TIME, 'it_IT');
setlocale(LC_TIME, $oldLocale);
$tempo= utf8_encode( strftime("%A %d %B %Y") );
echo "</a><div id='oggi-header'><b>In Sospeso</b><a id='todayrefresh' href='javascript:aggiornaold()'><span class='glyphicon glyphicon-refresh'></span></a></div>";
$time = new DateTime;
$time = $time->format('Y-m-d');

require("connection.php");
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$utente=$_SESSION['login_id'];
$last=0;
if(!isset($_GET["quanti"]))
    /*  */
    $query = sqlsrv_query($conn,"SELECT TOP 5 * FROM CRMAttivita WHERE IdEsecutore='$utente' AND DataInizio<=CONVERT(date, DATEADD(d, -1, GETDATE())) AND Conclusione<>1 ORDER BY DataInizio DESC");
else
    $query = sqlsrv_query($conn,"SELECT * FROM CRMAttivita WHERE IdEsecutore='$utente' AND DataInizio<=CONVERT(date, DATEADD(d, -1, GETDATE())) AND Conclusione<>1 ORDER BY DataInizio DESC");
$quanti=0;
while ($val=sqlsrv_fetch_array($query)) {
    $newformat = $val["DataInizio"]->format('Y-m-d');
    
    //echo "nformat= $newformat<br>oggi=$time <br>";
    if($newformat<$time)
    {
        $ora=$val["DataInizio"]->format('H:m');
        $stampaformat=utf8_encode(strftime("%A %d %B %Y",$val["DataInizio"]->getTimestamp()));
        if($last==0 || $last!=$newformat)
            echo "</a><div class='data-header'> $stampaformat </div>";
        $last=$newformat;
        $entrato=1;
        $quanti++;
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
            if($val["Descrizione"]!="")
            //echo "<br><button class='mndescbtn' onclick=mostranascondi('desc$idatt');>Mostra/Nascondi descrizione</button>";
            echo "<label class='ora-giorno-att'><span title='Ora' class='glyphicon glyphicon-time'></span> $ora</label>";
            //echo "<div class='descatt' id='desc$idatt'>$descrattivita</div>";
            echo "";
            echo "</div>";
        //sleep ( 1 );
        
    }  
}
if($quanti==5)
    echo "<div align='center'><a class='btnlogin' href='javascript:tutti()'>Mostra tutti</a></div>";
if($entrato==0)
	echo "<div class='noplanned'>Nessun Attivit&agrave; in sospeso</div>";

?>