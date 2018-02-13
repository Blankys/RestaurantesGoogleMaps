<!DOCTYPE html >
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>RESTAURANTES</title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>

  <body>
    <div id="map"></div>

    <script>
		function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(-33.863276, 151.207977),
          zoom: 12
        });
        var infoWindow = new google.maps.InfoWindow;

            downloadUrl('../controlador/conexion.php', function(data) {
            var xml = data.responseXML;
            var marcadores = xml.documentElement.getElementsByTagName('restaurante');
            Array.prototype.forEach.call(marcadores, function(markerElem) {
              var nombre = markerElem.getAttribute('NOMBRE');
              var direccion = markerElem.getAttribute('DIRECCION');
              var coordenada = new google.maps.LatLng(
                  parseFloat(markerElem.getAttribute('LATITUD')),
                  parseFloat(markerElem.getAttribute('LONGITUD')));

              var infowincontent = document.createElement('div');
              var strong = document.createElement('strong');
              strong.textContent = nombre
              infowincontent.appendChild(strong);
              infowincontent.appendChild(document.createElement('br'));

              var text = document.createElement('text');
              text.textContent = direccion
              infowincontent.appendChild(text);
              var restaurante = new google.maps.Marker({
                map: map,
                position: coordenada,
              });
              restaurante.addListener('click', function() {
                infoWindow.setContent(infowincontent);
                infoWindow.open(map, restaurante);
              });
            });
          });
        }

      function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
          }
        };

        request.open('GET', url, true);
        request.send(null);
      }

      function doNothing() {}
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5ZvyGA9ZRrMv1FQGqFqIMn5PZVySQTuA&callback=initMap">
    </script>
  </body>
</html>