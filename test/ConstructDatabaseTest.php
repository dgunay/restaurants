<?php
declare(strict_types = 1);

namespace Restaurants\Tests;

use PHPUnit\Framework\TestCase;
use PHPUnit\DbUnit\TestCaseTrait;

final class ConstructDatabaseTest extends TestCase
{
	use TestCaseTrait;

	/**
	 * @return PHPUnit\DbUnit\Database\Connection
	 */
	public function getConnection()
	{
		$pdo = new \PDO('sqlite::memory:');
		return $this->createDefaultDBConnection($pdo, ':memory:');
	}

	/**
	 * @return PHPUnit\DbUnit\DataSet\IDataSet
	 */
	public function getDataSet()
	{
		return new My
	}

	public function test_that_just_passes() {
		$this->assertSame(1, 1);
	}
}