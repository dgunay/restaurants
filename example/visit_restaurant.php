<?php

require '../vendor/autoload.php';

// connect to DB
$db = new \PDO('sqlite:' . __DIR__ . '/restaurants.db');

// pass to RestaurantDatabase
$restaurants = new RestaurantDatabase($db);