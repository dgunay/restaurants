<?php

/**
 * Trivial example script that lets you log visits to a restaurant, assuming
 * you have your SQLite db set up. 
 */

// have Composer autoload our classes
require '../vendor/autoload.php';

// connect to DB
$db = new \PDO('sqlite:' . __DIR__ . '/restaurants.db');

// pass to RestaurantDatabase
$restaurants = new RestaurantDatabase($db);

// which restaurant are we visiting?
$restaurant = $_GET['restaurant'];
$type       = $_GET['type'] ?? '';

// visit the restaurant
try {
  $restaurants->visit($restaurant, $type);
}
catch (Exception $t) {
  respond(500, $t->getMessage());
}

respond(200, 'Success.');

// End

// Sets HTTP code and optionally echoes with a json-encoded message.
function respond(int $code, string $message = null) : void {
  http_response_code($code);
  if ($message) {
    echo json_encode([
      'msg' => $message
    ]);        
  }
}