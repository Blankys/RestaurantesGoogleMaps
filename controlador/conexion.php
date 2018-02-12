<?php
function parseToXML($htmlStr)
{
$xmlStr=str_replace('<','&lt;',$htmlStr);
$xmlStr=str_replace('>','&gt;',$xmlStr);
$xmlStr=str_replace('"','&quot;',$xmlStr);
$xmlStr=str_replace("'",'&#39;',$xmlStr);
$xmlStr=str_replace("&",'&amp;',$xmlStr);
return $xmlStr;
}
$mysqli = new mysqli("localhost", "root", "", "restaurantes");
$mysqli->set_charset("utf8");

// Opens a connection to a MySQL server
if ($mysqli->connect_errno) {
	echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
	exit;
}
echo "Éxito: Se realizó una conexión apropiada a MySQL! La base de datos RESTAURANTES es genial." . PHP_EOL;

$consulta= "SELECT * FROM restaurante WHERE 1";

// Select all the rows in the restaurante table
if($resultado = $mysqli->query($consulta)){
	echo "Consulta realizada con exito.";
	while ($fila = $resultado->fetch_assoc()) {
        printf ("%s-(%s)\n", $fila["NOMRESTAURANTE"], $fila["DESCRESTAURANTE"]);
    }
}
else{
	echo "Fallo la consulta!!".$mysqli->error;
}

header("Content-type: text/xml; charset=utf-8");
// Start XML file, echo parent node
echo '<?xml version="1.0" encoding="utf-8" ?>';

// Iterate through the rows, printing XML nodes for each
while ($row = $resultado->fetch_object()){	
  // Add to XML document node
  echo '<restaurantes ';
  echo 'NOMRESTAURANTE="' . parseToXML($row->NOMRESTAURANTE) . '" ';
  echo 'DESCRESTAURANTE="' . parseToXML($row->DESCRESTAURANTE) . '" ';
  echo 'DIRECCIONRESTAURANTE="' . parseToXML($row->DIRECCIONRESTAURANTE) . '" ';
  echo 'HORARIORESTAURANTE="' . parseToXML($row->HORARIORESTAURANTE) . '" ';
  echo 'NUMRESTAURANTE="' . parseToXML($row->NUMRESTAURANTE) . '" ';
  echo 'LONGITUD="' . $row->LONGITUD . '" ';
  echo 'LATITUD="' . $row->LATITUD . '" ';
  echo '/>';
}

// End XML file
echo '</restaurantes>';

?>
