<?php

  include_once"../../dbconn.php";

  function parseToXML($htmlStr)
  {
  $xmlStr=str_replace('<','&lt;',$htmlStr);
  $xmlStr=str_replace('>','&gt;',$xmlStr);
  $xmlStr=str_replace('"','&quot;',$xmlStr);
  $xmlStr=str_replace("'",'&#39;',$xmlStr);
  $xmlStr=str_replace("&",'&amp;',$xmlStr);
  return $xmlStr;
  }

  $lat = $_GET["lat"];
  $lng = $_GET["lng"];


  $query = "SELECT * , ( 6371 * acos( cos( radians($lat) ) * cos( radians( lat ) ) 
  * cos( radians( lng ) - radians($lng) ) + sin( radians($lat) ) * sin(radians(lat)) ) ) AS distance FROM location HAVING distance < 25";


  $result = mysqli_query($connection, $query);
  if (!$result) {
    die('Invalid query: ');
  }
  
  header("Content-type: text/xml");
  
  // Start XML file, echo parent node
  echo "<?xml version='1.0' ?>";
  echo '<markers>';
  $ind=0;
  // Iterate through the rows, printing XML nodes for each
  while ($row = @mysqli_fetch_assoc($result)){
    // Add to XML document node
    echo '<marker ';
    echo 'id="' . $row['locationId'] . '" ';
    echo 'name="' . parseToXML($row['address']) . '" ';
    echo 'address="' . parseToXML($row['address']) . '" ';
    echo 'lat="' . $row['lat'] . '" ';
    echo 'lng="' . $row['lng'] . '" ';
    echo 'stayType="' . $row['stayType'] . '" ';
    echo '/>';
    $ind = $ind + 1;
  }
  
  // End XML file
  echo '</markers>';
  
  mysqli_close($connection);

?>
