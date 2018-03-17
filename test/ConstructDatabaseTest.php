<?php
declare(strict_types = 1);

namespace Restaurants\Tests;

use PHPUnit\Framework\TestCase;
use Restaurants\Tests\TestRestaurantDatabase;

// TODO: make this an abstract class to reuse db code across tests
// TODO: properly use the restaurantdb class and then unit test functions
// TODO: create sets of data that can be tested against with different cases
final class ConstructDatabaseTest extends TestCase
{
	protected $db;

	protected function setUp() {
		$this->db = new TestRestaurantDatabase(new \PDO('sqlite::memory:'));
		$this->db->load_csv(__DIR__ . '/datasets/simple.csv');
	}

	protected function tearDown() {
		$this->db = null;
	}

	// Test that the db loaded and we have data in the table
	public function test_db_loaded_correctly() {
		$data = $this->db->get_all_rows();
		$expected = array(
			array(
				"Chipotle",
				"5",
				"mexican",
			),
			array(
				"Santa Monica Seafood",
				"10",
				"seafood",
			),
		);

		$this->assertEquals($expected, $data);
	}
}