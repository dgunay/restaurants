<?php
declare(strict_types = 1);

namespace Restaurants\Tests;

use PHPUnit\Framework\TestCase;
use Restaurants\Tests\TestDatabase;

// TODO: make this an abstract class to reuse db code across tests
final class ConstructDatabaseTest extends TestCase
{
	protected $pdo;

	public function setUp() {
		$test_db = new TestDatabase();
		$test_db->load_csv(__DIR__ . '/test.csv');
		$this->pdo = $test_db->get_pdo();
	}

	// Test that the db loaded and we have data in the table
	public function test_that_just_passes() {
		$stmt = $this->pdo->query("SELECT * FROM restaurants;");
		$this->assertSame($this->pdo->errorInfo()[0], '00000');
	}
}