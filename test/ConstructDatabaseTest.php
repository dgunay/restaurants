<?php
declare(strict_types = 1);

namespace Restaurants\Tests;

use PHPUnit\Framework\TestCase;
use PHPUnit\DbUnit\TestCaseTrait;
use PHPUnit\DbUnit\DataSet\CsvDataSet;

final class ConstructDatabaseTest extends TestCase
{
	use TestCaseTrait;

	protected $pdo;

	private const TEST_DB_PATH = __DIR__ . '/test.db';

	public function __construct() 
	{
		// $this->pdo = new \PDO('sqlite:' . self::TEST_DB_PATH);
		$this->pdo = new \PDO('sqlite::memory:');
			$this->pdo->query(
				"CREATE TABLE restaurants(name TEXT, times_visited INTEGER, type TEXT)"
			);
	}

	/**
	 * @return PHPUnit\DbUnit\Database\Connection
	 */
	public function getConnection()
	{
		// if ($this->pdo === null) {
		// 	$this->pdo = new \PDO('sqlite::memory:');
		// 	$this->pdo->query(
		// 		"CREATE TABLE restaurants(name TEXT, times_visited INTEGER, type TEXT)"
		// 	);
		// }

		return $this->createDefaultDBConnection($this->pdo, ':memory:');
	}

	/**
	 * @return PHPUnit\DbUnit\DataSet\IDataSet
	 */
	public function getDataSet()
	{
		// TODO: maybe verify that the first line of test.csv has required fields
		$csv_data_set = new CsvDataSet();
		$csv_data_set->addTable('restaurants', __DIR__ . '/test.csv');
		return $csv_data_set;
	}

	public function test_that_just_passes() {
		$this->assertSame(1, 1);
	}
}