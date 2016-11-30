<?php
  include('include/init.php');
  include('include/functions.php'); 
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Carte</title>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="css/style.css"/>
     <style type="text/css">
      #map { height: 400px; }
      
    </style>
  </head>

  <body>
    <?php
      include("include/carteHeader.php");
      include("include/menu.php");
    ?>

    <div class="container">
      <div id="map"></div>
    </div>

    <div class="carte-footer">
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.js"></script>
    <script>
    /* Bouton Menu sur mobile */
    $( ".mobile-nav" ).click(function() {
      $(".hidden").toggle(); 
    });

    /* Animation du bouton "Lire plus" des articles */
    $(".article-item-link")
    .mouseenter(function() {
      btn = $(this).find($("img"));
      btn.fadeOut(300, function() {
        btn.attr("src","img/article-btn-hover.png");
        btn.fadeIn(300);
      });
    })
    .mouseleave(function() {
      btn = $(this).find($("img"));
      btn.attr('src', "img/article-btn.png");
    });
    </script>
    <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDKCtDPvAUSer_1leo6WTMHSncwyk9GOxk&callback=initMap">
    </script>
    <script>
    var map;
    function initMap() {
      map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: -34.397, lng: 150.644},
        zoom: 8
      });

      var icon = 'img/mapIcon.png';
      var marker = new google.maps.Marker({
        position: {lat: -34.397, lng: 150.644},
        map: map,
        title: 'Hello World!',
        icon: icon
      });

      marker.setMap(map);

      var styles = [
        {
          stylers: [
            
            { saturation: -100 }
          ]
        },{
          featureType: "road",
          elementType: "geometry",
          stylers: [
            { lightness: 100 },
            { visibility: "simplified" }
          ]
        },{
          featureType: "road",
          elementType: "labels",
          stylers: [
            { visibility: "off" }
          ]
        }
      ];

      map.setOptions({styles: styles});
    }

    $( document ).ready(function() {
      $.ajax({
                // chargement du fichier externe monfichier-ajax.php 
                url      : "include/getLocations.php",
                // Passage des données au fichier externe (ici le nom cliqué)  
                //data     : {NomEleve: $(this).html()},
                cache    : false,
                dataType : "json",
                error    : function(request, error) { // Info Debuggage si erreur         
                             alert("Erreur : responseText: "+ error);
                           },
                success  : function(data) {  
                             // Informe l'utilisateur que l'opération est terminé et renvoie le résultat
                             alert(data.coucou);  
                             // J'écris le résultat prénom de l'élève dans le h1
                             //$(#prenom_eleve).html(data.PrenomEleve);
                           }       
           });     
      });
    </script>
    
  </body>
</html>