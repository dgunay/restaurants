<?php
declare(strict_types = 1);

namespace Restaurants;

/**
 * Manages a database of restaurants.
 */
class RestaurantDatabase
{
	/** @var PDO The database */
	protected $db;

	public function __construct(\PDO $db) {
		$this->db = $db;

		// Throw Exceptions when something goes wrong
		$this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
	}

	/**
	 * Visits the restaurant in question. If it has not been visited, creates a
	 * new row for that restaurant, sets times_visited to 1, and sets the type to
	 * the provided type.
	 *
	 * @throws PDOException if any SQL operations fail.
	 * @param string $restaurant The name of the restaurant to visit
	 * @param string $type Defaults to empty string for new restaurants.
	 * @return void
	 */
	public function visit(string $restaurant, string $type = '') : void {
		// Is it already there?
		$query = "SELECT COUNT(*) FROM restaurants WHERE name = ?;";
		$statement = $this->db->prepare($query);
		$statement->execute([$restaurant]);
		if ((int) $statement->fetchColumn() > 0) {
			// increment times_visited for that restaurant
			// TODO: maybe update with a "last visit" ?
			$query = "UPDATE restaurants 
				SET times_visited = times_visited + 1
				WHERE name = ?;
			";
			$statement = $this->db->prepare($query);
			$statement->execute([$restaurant]);
		}
		else {
			// create a new row
			$query = "INSERT INTO restaurants VALUES(?, 1, ?);";
			$statement = $this->db->prepare($query);
			$statement->execute([$restaurant, $type]);
		}
	}

	
	/**
	 * Chooses the least visited restaurant.
	 *
	 * @throws PDOException
	 * @return string
	 */
	public function least_visited_restaurant() : string {
		$query = "SELECT * FROM restaurants ORDER BY times_visited ASC";
		$statement = $this->db->prepare($query);
		$statement->execute();
		return $statement->fetchColumn();
	}

	/**
	 * Removes a restaurant from the database.
	 *
	 * @throws PDOException
	 * @param string $restaurant
	 * @return boolean Success
	 */
	public function remove(string $restaurant) : bool {
		$query = "DELETE FROM restaurants WHERE name = ?;";
		$statement = $this->db->prepare($query);
		return $statement->execute([$restaurant]);
	}

	// TODO: function to purely randomly select a restaurant
	public function random_restaurant() : string {
		throw new \BadMethodCallException(__FUNCTION__ . ' not implemented.');
		return null;
	}

	// TODO: function to semirandomly select a restaurant, weighted by visits
	// (less visited restaurants more likely to come up)
	public function semirandom_restaurant() : string {
		throw new \BadMethodCallException(__FUNCTION__ . ' not implemented.');
		return null;
	}
}