<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
// Debug Porpuses

require __DIR__ . '/vendor/autoload.php'; // Load MongoDb lib

header('Content-Type: application/octet-stream'); // Set mime type

$client = new MongoDB\Client('mongodb://gcm:Goncermor%40moly2007@192.168.1.1:27017/?directConnection=true');
$db = $client->Goncermor;
$collection = $db->Updater;
// Get Database collection

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
   if (isset($_GET['id']) &&  $_GET['id'] != '') {
      $id = $_GET['id'];
      try {
         if ( $id == 0) $document = $collection->findOne(['_id'=> 0]);
         else $document = $collection->findOne(['_id'=> new MongoDB\BSON\ObjectId( $id)]);
      } catch (Exception $e) {
         http_response_code(404);
         die;
      }
      
      if ( $id != 0 && (!isset($_GET['channel']) || !in_array($_GET['channel'],(array)$document->channels))) {
         http_response_code(400);
      } else {
      $channel = $_GET['channel'];
     
      echo file_get_contents('package/' .  $id .  '/'. $channel.'.bin');
      }
   } else http_response_code(400);
} else http_response_code(405);
?>