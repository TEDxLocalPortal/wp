<!DOCTYPE html>
<html>
<head>

   <script src="http://maps.google.com/maps/api/js?sensor=false"></script>   
</head>
<body>
<?php 



$x=0;
$fila = 1;
if (($gestor = fopen("https://docs.google.com/spreadsheets/d/1OsZsQFBiXdXjYkDg3E77Cxa37Du5w1wkc23wv3xw7q8/export?format=csv&id=1OsZsQFBiXdXjYkDg3E77Cxa37Du5w1wkc23wv3xw7q8&gid=0", "r")) !== FALSE) {
    while (($datos[$x] = fgetcsv($gestor, 1000, ",")) !== FALSE) {
        $numero = count($datos[$x]);
        for ($c=0; $c < $numero; $c++) {
			if ($x!=0){
            echo $datos[$x][$c] . "<br />\n";
			}
		}
		$x++;
    }
    fclose($gestor);
}
?>

    <div id="map" style="width: 500px; height: 400px;"></div>


<script>
     var locations = [
     <?php 
$x=0;
$fila = 1;
if (($gestor = fopen("https://docs.google.com/spreadsheets/d/1OsZsQFBiXdXjYkDg3E77Cxa37Du5w1wkc23wv3xw7q8/export?format=csv&id=1OsZsQFBiXdXjYkDg3E77Cxa37Du5w1wkc23wv3xw7q8&gid=0", "r")) !== FALSE) {
    while (($datos[$x] = fgetcsv($gestor, 1000, ",")) !== FALSE) {

		$numero = count($datos[$x]);
			if ($x!=0){
		if (($datos[$x][3]!=0) && ($datos[$x][4]!=0)){
				if ($datos[$x][3]<0){
				$lat=substr($datos[$x][3],0,3);
				$lat.=".";
				$lat.=substr($datos[$x][3],3);
				}else{
				$lat=substr($datos[$x][3],0,2);
				$lat.=".";
				$lat.=substr($datos[$x][3],2);
				}
				if ($datos[$x][4]<0){
				$lon=substr($datos[$x][4],0,3);
				$lon.=".";
				$lon.=substr($datos[$x][4],3);
				}else{
				$lon=substr($datos[$x][4],0,2);
				$lon.=".";
				$lon.=substr($datos[$x][4],2);
				}
		if ($datos[$x+1][0]!=""){
?>
  ["<h4><?php echo $datos[$x][0]; ?></h4><br /><img src='<?php echo $datos[$x][1]; ?>' width='150px' height='100px' /><br />Lugar: <?php echo $datos[$x][5]; ?><br />Fecha de inicio: <?php echo $datos[$x][6]; ?>",<?php echo $lat; ?>, <?php echo $lon; ?>],
 
<?php
		}else{
		?>
		 ["<h4><?php echo $datos[$x][0]; ?></h4><br /><img src='<?php echo $datos[$x][1]; ?>' /><br />Lugar: <?php echo $datos[$x][5]; ?><br />Fecha de inicio: <?php echo $datos[$x][6]; ?>",<?php echo $lat; ?>, <?php echo $lon; ?>]
		 <?php
		}
		}
	}
     	$x++;
    }
    fclose($gestor);
}
?>
    ];
 
   var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 10,
      center: new google.maps.LatLng(-37.92, 151.25),
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      mapTypeControl: false,
      streetViewControl: false,
      panControl: false,
      zoomControlOptions: {
         position: google.maps.ControlPosition.LEFT_BOTTOM
      }
    });

    var infowindow = new google.maps.InfoWindow({
      maxWidth: 160
    });

    var markers = new Array();
	
	 for (var i = 0; i < locations.length; i++) {  
      var marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map,
      });

      markers.push(marker);

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
      
      // We only have a limited number of possible icon colors, so we may have to restart the counter
    }

    function autoCenter() {
      //  Create a new viewpoint bound
      var bounds = new google.maps.LatLngBounds();
      //  Go through each...
      for (var i = 0; i < markers.length; i++) {  
				bounds.extend(markers[i].position);
      }
      //  Fit these bounds to the map
      map.fitBounds(bounds);
    }
    autoCenter();
  </script> 

</body>
</html>

