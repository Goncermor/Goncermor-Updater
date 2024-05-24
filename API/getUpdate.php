<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
// Debug Porpuses

require __DIR__ . '/vendor/autoload.php'; // Load MongoDb lib

header('Content-Type: application/json'); // Set mime type

$client = new MongoDB\Client('mongodb://gcm:Goncermor%40moly2007@192.168.1.1:27017/?directConnection=true');
$db = $client->Goncermor;
$collection = $db->Updater;
// Get Database collection

$responseObj = new stdClass();


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
     

      if ( $id == 0) {
         $responseObj->version = $document->version;
         $responseObj->hash = hash_file('sha256','package/' . $id . '.bin');  
      } else {
         $responseObj->application_id = $id;
         $responseObj->channel = $channel;
         $responseObj->name = $document->name;
         $responseObj->project_url = $document->project_url;
         $responseObj->channelname = $document->channel->$channel->channelname;
         $responseObj->version = $document->channel->$channel->version;
         $responseObj->notes = $document->channel->$channel->notes;
         $responseObj->changelog = $document->channel->$channel->changelog;
         $responseObj->hash = hash_file('sha256','package/' .  $id .  '/'. $channel.'.bin');  
         $responseObj->lastupdate = $document->channel->$channel->lastupdate;
      }
      echo json_encode($responseObj);
      }
   } else http_response_code(400);
} else http_response_code(405);
?>