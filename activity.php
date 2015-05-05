<!DOCTYPE html>
<html>
<link href='http://fonts.googleapis.com/css?family=Roboto:700italic,700,400' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/bootstrap-theme.css">
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/style.css">
<script src="js/jquery-2.1.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/funzioni.js"></script>
<head lang="en">
    <META name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>NEiT CRM - Attività</title>
</head>
<body bgcolor="#f2f2f2">
<nav class="navbar navbar-default cre">
			<div class="container-fluid">
				
				
				<a class="navbar-brand" href="#">
					<img alt="Brand" class="logo" src="images/NEiT.png" />
				</a>
				
				 <div class="collapse navbar-collapse">	
					 <ul class="nav navbar-nav">
                                             <li class="active"><a href="#">Attivit&agrave; <span class="glyphicon glyphicon-list-alt"></span> <span class="sr-only">(current)</span></a></li>
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
                            <div id="contenuti">
                                <?php 
                                if((isset($_GET["stato"])) && $_GET["stato"]=="completato" )
                                 echo "<div class='alert alert-success'>
                                        <a href='#' class='close' data-dismiss='alert'>&times;</a>
                                        <strong>Completato !</strong> Attivit&agrave; salvata.
                                    </div>";
                                require("php/loadatt.php");
                                echo "</div><div id='contenutisospesi'>";
                                require("php/loadattold.php"); 
                                ?>          
                            </div><img style="display:none; position:absolute; left:40%; right:0; top:120px; bottom:auto;" src="images/loading.gif" id="loading" />
</body>
</html>