<!DOCTYPE html>
<html>
<head>
<script>
function initialize()
{
  var mapProp = {
    center: new google.maps.LatLng(51.508742,-0.120850),
    zoom:7,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
  <?php 
$x=0;
$fila = 1;
if (($gestor = fopen("https://docs.google.com/spreadsheets/d/1OsZsQFBiXdXjYkDg3E77Cxa37Du5w1wkc23wv3xw7q8/export?format=csv&id=1OsZsQFBiXdXjYkDg3E77Cxa37Du5w1wkc23wv3xw7q8&gid=0", "r")) !== FALSE) {
    while (($datos[$x] = fgetcsv($gestor, 1000, ",")) !== FALSE) {
	
		$numero = count($datos[$x]);
		if (($x==1) || ($x==2)){
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
		
?>
var location = new google.maps.LatLng(<?php echo $lat ?>, <?php echo $lon ?>);
 //var location = new google.maps.LatLng(-34.600548, -58.369282);
 
var marker<?php echo $x; ?> = new google.maps.Marker({
            position: location,
            map: map
        });
}

<?php
		}
	}
     	$x++;
    }
    fclose($gestor);
}
?>

  
      
        

function loadScript()
{
  var script = document.createElement("script");
  script.type = "text/javascript";
  script.src = "http://maps.googleapis.com/maps/api/js?key=&sensor=false&callback=initialize";
  document.body.appendChild(script);
}

window.onload = loadScript;
</script>
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

<div id="googleMap" style="width:500px;height:500px;"></div>

</body>
</html>

