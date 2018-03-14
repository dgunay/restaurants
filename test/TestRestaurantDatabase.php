<?php
declare(strict_types = 1);

namespace Restaurants\Tests;

use Restaurants\RestaurantDatabase;

// TODO: wrapper for in-memory SQLite db loaded from CSV, with a check for
// proper format of the file
class TestRestaurantDatabase extends RestaurantDatabase
{
  // Fields that the CSV must have
  private const MANDATORY_FIELDS = array(
    'name'          => 'TEXT',
    'times_visited' => 'INTEGER',
    'type'          => 'TEXT',
  );

  public function load_csv(string $path){
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
    $this->db->exec($query);

    // load row-by-row into SQLite table with prepared PDO
    $placeholders = implode(
      ',', 
      array_fill(0, count(self::MANDATORY_FIELDS), '?')
    );
    // TODO: throw exception for problems w pdo
    $statement = $this->db->prepare(
      "INSERT INTO restaurants VALUES({$placeholders});"
    );
    while (($line = fgetcsv($fp_in)) !== false) {
      $statement->execute($line);
    }

    fclose($fp_in);
    return $this->db;
  }

  // TODO: maybe deprecated
  public function get_pdo() {
    return $this->db;
  }

  public function get_all_rows() : array {
    $stmt = $this->db->query("SELECT * FROM restaurants;");
    return $stmt->fetchAll(\PDO::FETCH_NUM);
  }
}