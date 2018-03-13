<?php
declare(strict_types = 1);

namespace Restaurants\Tests;

// TODO: wrapper for in-memory SQLite db loaded from CSV, with a check for
// proper format of the file
class TestDatabase
{
  protected $pdo;

  // Fields that the CSV must have
  private const MANDATORY_FIELDS = array(
    'name'          => 'TEXT',
    'times_visited' => 'INTEGER',
    'type'          => 'TEXT',
  );

  public function __construct() {
    $this->pdo = new \PDO('sqlite::memory:');
  }

  public function load_csv(string $path){
    // TODO: fclose this  
    $fp_in = @fopen($path, 'r');
    if ($fp_in === false) {
      throw new \Exception('Failed to open ' . $path);
    }

    // verify first row of CSV has mandatory fields
    $fields = fgetcsv($fp_in);
    if ($fields !== array_keys(self::MANDATORY_FIELDS)) {
      throw new \Exception(
        $path . ' must contain ONLY fields ' . implode(', ', array_keys(self::MANDATORY_FIELDS))
      );
    }

    // Set up the table fields
    $sql_fields = array();
    foreach (self::MANDATORY_FIELDS as $field => $type) {
      $sql_fields[] = $field . ' ' . $type;;
    }

    $query = "CREATE TABLE restaurants(" . implode(', ', $sql_fields). ");";
    $this->pdo->exec($query);

    // load row-by-row into SQLite table with prepared PDO
    $placeholders = implode(
      ',', 
      array_fill(0, count(self::MANDATORY_FIELDS), '?')
    );
    // TODO: throw exception for problems w pdo
    $statement = $this->pdo->prepare(
      "INSERT INTO restaurants VALUES({$placeholders});"
    );
    while (($line = fgetcsv($fp_in)) !== false) {
      $statement->execute($line);
    }

    return $this->pdo;
  }

  public function get_pdo() {
    return $this->pdo;
  }
}