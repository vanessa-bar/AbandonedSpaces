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
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="img/favicon.png" />
     <style type="text/css">
      #map { height: 400px; }
      
    </style>
  </head>

  <body>
    <?php
      include("include/carteHeader.php");
    ?>

    <nav>
      <button class="mobile-nav">Menu</button>
      <div class="clearfix"></div>
      <div class="hidden">
        <ul class="navbar">
          <li class="search-hide"><a href="index.html"><img class="nav-menuIcon" src="img/menuIcon.png" alt="Accueil"/></a></li>
          <li class="search-hide"><a href="ruines.php">Passé Suspendu</br>
              <span class="nav-subtitle">- vestiges -</span></a>
          </li>
          <li class="search-hide"><a href="urbain.php">Quotidien Figé</br>
            <span class="nav-subtitle">- urbains -</span></a>
          </li>
          <li class="search-hide"><a href="nature.php">Nature Immuable</br>
            <span class="nav-subtitle">- lieux reculés -</span></a>
          </li>
          <li class="search-hide"><a href="carte.php">Carte</a></li>
          <li class="search-hide"><a href="a_propos.php">A Propos</a></li>
          <li class="search-link">
            <form method="POST" action="resultats.php">
              <input type="text" name="keyword" value="">
              <input type="submit" class="submit-search-btn" value="">
            </form>
          </li>
        </ul>
      </div>
      <img src="img/menuLine.png" style="position:absolute;bottom:0;">
    </nav>

    <div class="container">
      <h1>Les différents lieux</h1>


        <div class="search-form">
          <div class="search-form-div">
            <input type="button" id="geo" value="Me géolocaliser">
          </div>

          <div class="search-form-div">
            <h2>Type :</h2>
            <input type="checkbox" class="tcheck" id="type1" value="1" onclick="filter()"> <label for="type1">Vestiges</label><br/>
            <input type="checkbox" class="tcheck" id="type2" value="2" onclick="filter()"> <label for="type2">Lieux Reculés</label><br/>
            <input type="checkbox" class="tcheck" id="type3" value="3" onclick="filter()"> <label for="type3">Urbains</label><br/>
          </div>

          <div class="search-form-div">
            <h2>Continent :</h2>
            <input type="checkbox" class="ccheck" id="continent1" value="AmeriqueSud" onclick="filter()"> <label for="continent1">Amérique du Sud</label><br/>
            <input type="checkbox" class="ccheck" id="continent2" value="AmeriqueNord" onclick="filter()"> <label for="continent2">Amérique du Nord</label><br/>
            <input type="checkbox" class="ccheck" id="continent3" value="Asie" onclick="filter()"> <label for="continent3">Asie</label><br/>
            <input type="checkbox" class="ccheck" id="continent4" value="Europe" onclick="filter()"> <label for="continent4">Europe</label><br/>
            <input type="checkbox" class="ccheck" id="continent5" value="Afrique" onclick="filter()"> <label for="continent5">Afrique</label><br/>
            <input type="checkbox" class="ccheck" id="continent6" value="Oceanie" onclick="filter()"> <label for="continent6">Océanie</label><br/>
          </div>
        </div>
      <div id="map"></div>
    </div>

    <div class="clearfix"></div>
    <div class="footer">
      <p>Plan du Site - Mentions Légales
      <br/>
      IMAC2 - 2016</p>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>
    /* Bouton Menu sur mobile */
    $( ".mobile-nav" ).click(function() {
      $(".hidden").toggle(); 
    });
    </script>
    <script>
      $("#geo").click(function() {
        if (navigator.geolocation)
          var watchId = navigator.geolocation.getCurrentPosition(successCallback,
                                    null,
                                    {enableHighAccuracy:true});
        else
          alert("Votre navigateur ne prend pas en compte la géolocalisation HTML5");
      });

      function successCallback(position) {
          map.panTo(new google.maps.LatLng(position.coords.latitude, position.coords.longitude));

          var image = 'img/mapPosIcon.png';

          var content = "Vous êtes ici !";
          var infowindow = new google.maps.InfoWindow({
            content: content
          });      
          var marker = new google.maps.Marker({
            position: new google.maps.LatLng(position.coords.latitude, position.coords.longitude),
            map: map,
            icon: image
          });
          prev_infowindow = infowindow;
          infowindow.open(map, marker);

          marker.addListener('click', function() {
            if(prev_infowindow) {
               prev_infowindow.close();
            }

            prev_infowindow = infowindow;
            infowindow.open(map, marker);
          });
      }

      function filter() {
        var oneChecked = false;

        var type1 = $('#type1').is(':checked');
        var type2 = $('#type2').is(':checked');
        var type3 = $('#type3').is(':checked');

        var continent1 = $('#continent1').is(':checked');
        var continent2 = $('#continent2').is(':checked');
        var continent3 = $('#continent3').is(':checked');
        var continent4 = $('#continent4').is(':checked');
        var continent5 = $('#continent5').is(':checked');
        var continent6 = $('#continent6').is(':checked');

        var notype = false;
        if ((!type1) && (!type2) && (!type3)) {
          notype = true;
        }

        var nocontinent = false;
        if ((!continent1) && (!continent2) && (!continent3) && (!continent4) && (!continent5) && (!continent6)) {
          nocontinent = true;
        }

        // 4. Mettre le marqueur à null
        m1.setMap(null);
        m2.setMap(null);
        m3.setMap(null);
        m4.setMap(null);
        m5.setMap(null);
        m6.setMap(null);
        m7.setMap(null);
        m8.setMap(null);
        m9.setMap(null);
        m10.setMap(null);
        m11.setMap(null);

        if (nocontinent) {
          if (notype) {
            m1.setMap(map);
            m2.setMap(map);
            m3.setMap(map);
            m4.setMap(map);
            m5.setMap(map);
            m6.setMap(map);
            m7.setMap(map);
            m8.setMap(map);
            m9.setMap(map);
            m10.setMap(map);
            m11.setMap(map);
            // 5. Ajouter marqueur à carte
          } else {
            // 6. Ajouter le marqueur en fonction du theme
            if (type1) {
              m1.setMap(map);
              m5.setMap(map);
              m6.setMap(map);
              m9.setMap(map);
            }
            if (type2) {
              m3.setMap(map);
              m7.setMap(map);
              m11.setMap(map);
            }
            if (type3) {
              m2.setMap(map);
              m4.setMap(map);
              m8.setMap(map);
              m10.setMap(map);
            }
          }
        } else {

          if (continent1) { // Amérique Sud
            if (notype) {
              m5.setMap(map);
              m7.setMap(map);
              m11.setMap(map);
            } else {
              if (type1) {
                m5.setMap(map);
              }
              if (type2) {
                m7.setMap(map);
                m11.setMap(map);
              }
              if (type3) {

              }
            }
          }

          if (continent2) { // Amérique Nord
            if (notype) {
              
            } else {
              if (type1) {

              }
              if (type2) {

              }
              if (type3) {

              }
            }
          }

          if (continent3) { // Asie
            if (notype) {
              m4.setMap(map);
              m8.setMap(map);
            } else {
              if (type1) { 
                
              }
              if (type2) {

              }
              if (type3) {
                m4.setMap(map);
                m8.setMap(map);
              }
            }
          }

          if (continent4) { // Europe
            if (notype) {
              m2.setMap(map);
              m10.setMap(map);
            } else {
              if (type1) {
                
              }
              if (type2) {

              }
              if (type3) {
                m2.setMap(map);
                m10.setMap(map);
              }
            }
          }

          if (continent5) { // Afrique
            if (notype) {
              m1.setMap(map);
              m3.setMap(map);
              m9.setMap(map);
            } else {
              if (type1) {
                m1.setMap(map);
                m9.setMap(map);
              }
              if (type2) {
                m3.setMap(map);
              }
              if (type3) {

              }
            }
          }

          if (continent6) { // Océanie
            if (notype) {
              
            } else {
              if (type1) {
                
              }
              if (type2) {

              }
              if (type3) {

              }
            }
          }
        }
      }

     var map;
     // 1- Déclarer le marqueur
     var m1, m2, m3, m4, m5, m6, m7, m8, m9, m10, m11;
     var prev_infowindow = false; 
     
     function initialize() {
      // Creation de la map
      var center = new google.maps.LatLng(51.5074, 0.1278);

      map = new google.maps.Map(document.getElementById('map'), {
        zoom: 3,
        center: center,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      });

      // Style de la map
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

      // Creation des marqueurs
      var image = 'img/mapIcon.png';

      ////////////////////////////
      var contentString = "<a href='article.php?article-id=1&theme=1'>Là où les passés s’entremêlent et le présent s’en mèle, Babylone</a>";
      var infowindow1 = new google.maps.InfoWindow({
        content: contentString
      });      

      m1 = new google.maps.Marker({
        position: new google.maps.LatLng(3.8796, 49.8945),
        icon: image
      });

      m1.addListener('click', function() {
        if( prev_infowindow ) {
           prev_infowindow.close();
        }

        prev_infowindow = infowindow1;
        infowindow1.open(map, m1);
      });


      ////////////////////////////
      contentString = "<a href='article.php?article-id=2&theme=3'>Pyramiden, au delà du cercle polaire, ville russe en Norvège</a>";
      var infowindow2 = new google.maps.InfoWindow({
        content: contentString
      });      

      m2 = new google.maps.Marker({
        position: new google.maps.LatLng(78.6546, 16.3448),
        icon: image
      });

      m2.addListener('click', function() {
        if( prev_infowindow ) {
           prev_infowindow.close();
        }

        prev_infowindow = infowindow2;
        infowindow2.open(map, m2);
      });


      ////////////////////////////
      contentString = "<a href='article.php?article-id=3&theme=2'>Mère de l’eau au Sahara, l’histoire simple d’un lac en Libye</a>";
      var infowindow3 = new google.maps.InfoWindow({
        content: contentString
      });      

      m3 = new google.maps.Marker({
        position: new google.maps.LatLng(26.7112, 13.3365),
        icon: image
      });

      m3.addListener('click', function() {
        if( prev_infowindow ) {
           prev_infowindow.close();
        }

        prev_infowindow = infowindow3;
        infowindow3.open(map, m3);
      });


      ////////////////////////////
      contentString = "<a href='article.php?article-id=4&theme=3'>Nara Dreamland, exploration des rêves abandonnés</a>";
      var infowindow4 = new google.maps.InfoWindow({
        content: contentString
      });      

      m4 = new google.maps.Marker({
        position: new google.maps.LatLng(34.6996, 135.8205),
        icon: image
      });

      m4.addListener('click', function() {
        if( prev_infowindow ) {
           prev_infowindow.close();
        }

        prev_infowindow = infowindow4;
        infowindow4.open(map, m4);
      });


      ////////////////////////////
      contentString = "<a href='article.php?article-id=5&theme=1'>Du Cruzco au Machu Picchu : une traversée Inca</a>";
      var infowindow5 = new google.maps.InfoWindow({
        content: contentString
      });      

      m5 = new google.maps.Marker({
        position: new google.maps.LatLng(-13.1631, -72.5450),
        icon: image
      });

      m5.addListener('click', function() {
        if( prev_infowindow ) {
           prev_infowindow.close();
        }

        prev_infowindow = infowindow5;
        infowindow5.open(map, m5);
      });



      //////////////////////////
      contentString = "<a href='article.php?article-id=6&theme=1'>L’Écosse et ses châteaux, forteresses de l’Histoire</a>";
      var infowindow6 = new google.maps.InfoWindow({
        content: contentString
      });      

      m6 = new google.maps.Marker({
        position: new google.maps.LatLng(56.4037154,-5.0274038),
        icon: image
      });

      m6.addListener('click', function() {
        if( prev_infowindow ) {
           prev_infowindow.close();
        }

        prev_infowindow = infowindow6;
        infowindow6.open(map, m6);
      });



      //////////////////////////
      contentString = "<a href='article.php?article-id=7&theme=2'>Terre de Feu et bout du monde : la Patagonie intacte</a>";
      var infowindow7 = new google.maps.InfoWindow({
        content: contentString
      });      

      m7 = new google.maps.Marker({
        position: new google.maps.LatLng(-54.8019121, -68.3029511),
        icon: image
      });

      m7.addListener('click', function() {
        if( prev_infowindow ) {
           prev_infowindow.close();
        }

        prev_infowindow = infowindow7;
        infowindow7.open(map, m7);
      });


      //////////////////////////
      contentString = "<a href='article.php?article-id=8&theme=3'>Ambiance apocalyptique à Hashima</a>";
      var infowindow8 = new google.maps.InfoWindow({
        content: contentString
      });      

      m8 = new google.maps.Marker({
        position: new google.maps.LatLng(32.6278, 129.7386),
        icon: image
      });

      m8.addListener('click', function() {
        if( prev_infowindow ) {
           prev_infowindow.close();
        }

        prev_infowindow = infowindow8;
        infowindow8.open(map, m8);
      });


      //////////////////////////
      contentString = "<a href='article.php?article-id=9&theme=1'>Le Grand Zimbabwe et ses pierres, reflet d’un empire déchu</a>";
      var infowindow9 = new google.maps.InfoWindow({
        content: contentString
      });      

      m9 = new google.maps.Marker({
        position: new google.maps.LatLng(-20.2675, 30.9316),
        icon: image
      });

      m9.addListener('click', function() {
        if( prev_infowindow ) {
           prev_infowindow.close();
        }

        prev_infowindow = infowindow9;
        infowindow9.open(map, m9);
      });


      //////////////////////////
      contentString = "<a href='article.php?article-id=10&theme=3'>Tchernobyl, explosion et nucléaire : le lendemain à Pripyat</a>";
      var infowindow10 = new google.maps.InfoWindow({
        content: contentString
      });      

      m10 = new google.maps.Marker({
        position: new google.maps.LatLng(51.4045, 30.0542),
        icon: image
      });

      m10.addListener('click', function() {
        if( prev_infowindow ) {
           prev_infowindow.close();
        }

        prev_infowindow = infowindow10;
        infowindow10.open(map, m10);
      });

      //////////////////////////
      contentString = "<a href='article.php?article-id=11&theme=2'>Entre lamas et couleurs, à la découverte des Rainbow Mountains</a>";
      var infowindow11 = new google.maps.InfoWindow({
        content: contentString
      });      

      m11 = new google.maps.Marker({
        position: new google.maps.LatLng(-13.7985, -71.2924),
        icon: image
      });

      m11.addListener('click', function() {
        if( prev_infowindow ) {
           prev_infowindow.close();
        }

        prev_infowindow = infowindow11;
        infowindow11.open(map, m11);
      });

      /// 2. Remplir le template
      /*contentString = "<a href='article.php?article-id=5&theme=1'>Du Cruzco au Machu Picchu : une traversée Inca</a>";
      var infowindow5 = new google.maps.InfoWindow({
        content: contentString
      });      

      m5 = new google.maps.Marker({
        position: new google.maps.LatLng(-13.1631, -72.5450),
        icon: image
      });

      m5.addListener('click', function() {
        if( prev_infowindow ) {
           prev_infowindow.close();
        }

        prev_infowindow = infowindow5;
        infowindow5.open(map, m5);
      });*/

      m1.setMap(map);
      m2.setMap(map);
      m3.setMap(map);
      m4.setMap(map);
      m5.setMap(map);
      m6.setMap(map);
      m7.setMap(map);
      m8.setMap(map);
      m9.setMap(map);
      m10.setMap(map);
      m11.setMap(map);
      // 3. Ajouter le marqueur à la map
    }
    </script>
    <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDKCtDPvAUSer_1leo6WTMHSncwyk9GOxk&callback=initialize">
    </script>
  </body>
</html>