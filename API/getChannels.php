<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
// Debug Porpuses

require __DIR__ . '/vendor/autoload.php'; // Load MongoDb lib

header('Content-Type: application/json'); // Set mime type

$client = new MongoDB\Client('HAHA YOU WISH');
$db = $client->Goncermor;
$collection = $db->Updater;
// Get Database collection

$responseObj = array();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
   if (isset($_GET['id']) &&  $_GET['id'] != '' && $_GET['id'] != '0') {
      $id = $_GET['id'];
      try {
         $document = $collection->findOne(['_id'=> new MongoDB\BSON\ObjectId($id)]);
      } catch (Exception $e) {
         http_response_code(404);
         die;
      }

      foreach ($document->channels as $channel) {
         $object = new stdClass();
         $object->name = $channel;
         $object->fancyname = $document->channel->$channel->channelname;
         array_push($responseObj,$object);
      }
      echo json_encode($responseObj);    
   } else http_response_code(400);
} else http_response_code(405);
?>
