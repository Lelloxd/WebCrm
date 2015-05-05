<!DOCTYPE html>
<link href='http://fonts.googleapis.com/css?family=Roboto:700italic,700,400' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/bootstrap-theme.css">
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/clockpicker.css">
<link rel="stylesheet" href="css/bootstrap-datepicker3.standalone.min.css">
<script src="js/jquery-2.1.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/funzioni.js"></script>
<script src="js/clockpicker.js"></script>
<script src="js/bootstrap-datepicker.min.js"></script>
<script src="locales/bootstrap-datepicker.it.min.js"></script>


<head lang="en">
    <META name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>NEiT CRM - Attività</title>
</head>

<nav class="navbar navbar-default cre">
			<div class="container-fluid">
				
				
				<a class="navbar-brand" href="#">
					<img alt="Brand" class="logo" src="images/NEiT.png" />
				</a>
				
				 <div class="collapse navbar-collapse">	
					 <ul class="nav navbar-nav">
                                             <li class="active"><a href="activity.php">Attivit&agrave; <span class="glyphicon glyphicon-list-alt"></span> <span class="sr-only">(current)</span></a></li>
                                             <li><a class="nactive" href="calendar.php">Calendario <span class="glyphicon glyphicon-calendar"></span></a></li>					
					 </ul>
                                     <div id="refresh">
                                         <a href="javascript:impostazioni();"><span class="glyphicon glyphicon-cog"></span></a>
                                         <div class="bubble" id='bubble'>
                                             <div class='bcontent'>Grandezza testo : 
                                                 <a href='javascript:smallfont();'><span  class="glyphicon glyphicon-font small"></span></a>
                                                 <a href='javascript:normalfont();'><span  class="glyphicon glyphicon-font normal"></span></a>
                                                 <a href='javascript:bigfont();'><span  class="glyphicon glyphicon-font big"></span></a>
                                                 <br>
                                                 Tema : <span class="neit"> NEiT </span> <div class='creskin'></div><br>
                                                        <span class="sun"> Sun </span> <div class='sunskin'></div>
                                                        <br>
                                                <a class='logout' href='index.php?logout=true'>Logout <span class='glyphicon glyphicon-log-out'></span></a>
                                             </div>
                                         </div>
                                     </div>
				</div></div>
</nav>
                <div class="middle">
                    <form method='POST' onsubmit='attivita.php'>
    <?php
        if(isset($_GET["id"]))
        {
            require("php/connection.php");
            if(isset($_POST["ora"]))
            {
                
                $descrizione="";
                if(isset($_POST["comment"]))
                    $descrizione=$_POST["comment"];
                $ora=$_POST["ora"];
                $hour=intval(substr($ora,0,2));
                $minute=intval(substr($ora,-2,2));
                //echo "ora : $hour , minuti : $minute <br>";
                $ora= new DateTime($_POST["data"]);
                $ora=$ora->setTime($hour, $minute);
                $ora=$ora->format('Y-d-m\TH:i:s');
                //echo "$ora<br>";
                $finisci=sqlsrv_query($conn,"DECLARE @Test DATETIME
                SET @Test = '$ora'
                UPDATE CRMAttivita SET Descrizione='$descrizione',DataFine=@Test,Conclusione=1 WHERE IdAttivita='".$_GET["id"]."'");
                if($finisci)
                    echo "Completato... Attendi";
                echo $ora;
                header('Location: activity.php?stato=completato');
                
            }
            else
            {
            $id=$_GET["id"];
            $query=sqlsrv_query($conn,"SELECT * FROM CRMAttivita WHERE IdAttivita='$id'");
            while($val=sqlsrv_fetch_array($query))
            {
                $datafine=date("d/m/Y");
                $orafine=date("H:i");
                $descrattivita=$val["Descrizione"];
                $descrattivita= htmlentities($descrattivita,ENT_COMPAT, "ISO-8859-1");
                $idtipoatt=$val["IdTipoAttivita"];
                $idcontatto=$val["IdContatto"];
                $datastart=$val["DataInizio"];
                $orastart=$val["DataInizio"];
                $datastart=$datastart->format("d/m/Y");
                $orastart=$orastart->format("H:i");
                $tipoatt=sqlsrv_fetch_array(sqlsrv_query($conn,"SELECT Descrizione FROM CRMTipiAttivita WHERE IdTipoAttivita='$idtipoatt'"));
                $idatt=$val["IdAttivita"];
                $contatto=sqlsrv_fetch_array(sqlsrv_query($conn,"SELECT RagioneSociale FROM Anagrafica WHERE IdAnagrafica='$idcontatto'"));
                if($contatto=="")
                    $contatto=sqlsrv_fetch_array(sqlsrv_query($conn,"SELECT RagioneSociale FROM CRMLead WHERE IdLead='$idcontatto'"));
                $campagna=sqlsrv_fetch_array(sqlsrv_query($conn,"SELECT Nome FROM CRMCampagne WHERE IdCampagna='".$val["IdCampagna"]."'"));
                $funzione='javascript:collapse("'.$idatt.'","a'.$idatt.'")';
                echo "<div class='row'><div class='col-md-6 col-lg-6' ><label class='base'><span title='Tipo di attivit&agrave;' class='glyphicon glyphicon-transfer'></span>".$tipoatt["Descrizione"]."</label></div>";
                echo "<div class='col-md-6 col-lg-6' ><label class='basedue'><span title='Nominativo' class='glyphicon glyphicon-user'></span> ".$contatto["RagioneSociale"]."</label></div></div>";
                echo "<div class='row'><div class='col-md-6 col-lg-6' ><label class='base'><span title='Valore' class='glyphicon glyphicon-euro'></span> ".$val["Prezzo"]."</label></div>";
                if($campagna!=0)
                echo "<div class='col-md-6 col-lg-6' ><label class='basedue'><span title='Campagna' class='glyphicon glyphicon-briefcase'></span>".$campagna["Nome"]."</label></div>";
                echo "</div><br>Descrizione<br><textarea class='form-control' rows='5' name='comment' placeholder='Descrizione'>".$val["Descrizione"]."</textarea>";
                echo "<div class='secondpart'><div class='col-md-6 col-lg-6' id='sandbox-container'><br><div class='lblora' >Data Inizio : </div> <div  class='input-group date'>
                        <input type='text' class='form-control' name='data' value='$datastart'><span class='input-group-addon'><i class='glyphicon glyphicon-th'></i></span>
                    </div></div>";
                echo "<div class='col-md-6 col-lg-6'><br><div class='lblora' >Ora Inizio : </div><div class='input-group clockpicker clock'>
                <input type='time' class='form-control' name='ora' value='$orastart' required>
                <span class='input-group-addon'>
                    <span class='glyphicon glyphicon-time'></span>
                </span>
                </div></div>";
                echo "<div class='col-md-6 col-lg-6' id='sandbox-container'><br><div class='lblora' >Data Fine : &nbsp;</div> <div  class='input-group date'>
                        <input type='text' class='form-control' name='data' value='$datafine'><span class='input-group-addon'><i class='glyphicon glyphicon-th'></i></span>
                    </div></div>";
                echo "<div class='col-md-6 col-lg-6'><br><div class='lblora' >Ora Fine : &nbsp;</div><div class='input-group clockpicker clock'>
                <input type='time' class='form-control' name='ora' value='$orafine' required>
                <span class='input-group-addon'>
                    <span class='glyphicon glyphicon-time'></span>
                </span>
                </div></div>";
            }
              echo "<div align='center'><input type='submit' value='Salva' class='btnlogin'></div></form>  ";
            }
        }
    ?>
                        
                  
                      
             
<script type="text/javascript">
    $('#sandbox-container .input-group.date').datepicker({
    format: "dd/mm/yyyy",
    language: "it",
    todayHighlight: true
});
$('.clockpicker').clockpicker({
    placement: 'top',
    align: 'left',
    donetext: 'Conferma',
    'default': 'now'
});

</script>

                </div>

