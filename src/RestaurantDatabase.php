<?php
declare(strict_types = 1);

namespace Restaurants;

// TODO: make a class that manages a DB of restaurants
// TODO: use PDO to let any database backend work!
class RestaurantDatabase
{
	/** @var PDO The database */
	protected $db;

	public function __construct(\PDO $db) {
		$this->db = $db;
	}

	// TODO: function to say you visited a restaurant (no dupes!)
	public function visit(string $restaurant, string $type = null) : void {

	}

	// TODO: function to choose the least visited restaurant
	public function least_visited_restaurant() : string {
		return '';
	}

	// TODO: function to remove a given restaurant from the list
	public function remove(string $restaurant) : bool {
		return false;
	}

	// TODO: function to purely randomly select a restaurant
	public function random_restaurant() : string {
		return null;
	}

	// TODO: function to semirandomly select a restaurant, weighted by visits
	// (less visited restaurants more likely to come up)
	public function semirandom_restaurant() : string {
		return null;
	}
}