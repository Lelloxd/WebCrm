/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// TEST CONNESSIONE

function checkJSNetConnection(){
 var xhr = new XMLHttpRequest();
 var file = "dot.png";
 var r = Math.round(Math.random() * 10000); 
 xhr.open('HEAD', file + "?subins=" + r, false); 
 try {
  xhr.send(); 
  if (xhr.status >= 200 && xhr.status < 304) {
   return true;
  } else {
   return false;
  }
 } catch (e) {
  return false;
 }
}

function checkNetConnection(){
 jQuery.ajaxSetup({async:false});
 re="";
 r=Math.round(Math.random() * 10000);
 $.get("dot.png",{subins:r},function(d){
  re=true;
 }).error(function(){
  re=false;
 });
 return re;
}
/*
 * if((checkNetConnection()!=true)||(checkJSNetConnection()!=true))
    {
        alert("Problema di connessione con il server! riprova");
        return;
    }
 */
// FINE TEST CONNESSIONE
function aggiorna()
{
    
(function($)
{ 
        $.ajaxSetup(
        {
            cache: false,
            beforeSend: function() {
                $('#contenuti').hide();
                $('#loading').show();
            },
            complete: function() {
                $('#loading').hide();
                $('#contenuti').show();
            },
            success: function() {
                $('#loading').hide();
                $('#contenuti').show();
            }
        });
        var $container = $("#contenuti");
        $container.load("php/loadatt.php");
})(jQuery);
}
function aggiornaold()
{
    
(function($)
{ 
        $.ajaxSetup(
        {
            cache: false,
            beforeSend: function() {
                $('#contenutisospesi').hide();
                $('#loading').show();
            },
            complete: function() {
                $('#loading').hide();
                $('#contenutisospesi').show();
            },
            success: function() {
                $('#loading').hide();
                $('#contenutisospesi').show();
            }
        });
        var $container = $("#contenutisospesi");
        $container.load("php/loadattold.php");
})(jQuery);
}
var latest="primavolta";
function collapse(id,wow)
{
location.href='attivita.php?id='.concat(id);
}
function impostazioni()
{
var elem=document.getElementById("bubble");
if(elem.style.display!="block")
{
elem.style.display = 'block';
}
else
{
elem.style.display = 'none';
}
}
function mostranascondi(item)
{
var elem=document.getElementById(item);
if(elem.style.display!="block")
{
elem.style.display = 'block';
}
else
{
elem.style.display = 'none';
}
}
$(document).ready(function() {

$('#calendar').fullCalendar({
    header: {
				left: 'prev,next today',
				center: 'title',
				right: 'basicWeek,month'
			},
events: 'php/get-events.php',
weekends:false
    });

});
function tutti()
{
    (function($)
{ 
        $.ajaxSetup(
        {
            cache: false,
            beforeSend: function() {
                $('#contenutisospesi').hide();
                $('#loading').show();
            },
            complete: function() {
                $('#loading').hide();
                $('#contenutisospesi').show();
            },
            success: function() {
                $('#loading').hide();
                $('#contenutisospesi').show();
            }
        });
        var $container = $("#contenutisospesi");
        $container.load("php/loadattold.php?quanti=tutti");
})(jQuery);
}