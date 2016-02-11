<?php

namespace Lamework\Model;

use \PDO;

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * Repository model
 */
class Repository {

	protected static $db;
	protected static $fields;
	protected static $id_field = "id";
	protected static $table_name;
	public $list = array();

	function __construct($row = array()) {
		self::$db = self::connectToDb();

		$id_field = static::$id_field;
		$this->$id_field = (int)(isset($row[static::$id_field]) ? $row[static::$id_field] : 0);

		foreach (static::$fields as $field => $type) {
			if (!isset($this->$field))
				$this->$field = null;
			if ($type == "int")
				$this->$field = (int)(isset($row[$field]) ? $row[$field] : 0);
			else if ($type == "string")
				$this->$field = (isset($row[$field]) ? $row[$field] : "");
			else if ($type == "date")
				$this->$field = (isset($row[$field]) ? new \DateTime($row[$field]) : new \DateTime("now"));
			else if ($type == "bool")
				$this->$field = (isset($row[$field]) ? $row[$field] : 0);
		}
	}

	/**
	 * Connect to a database
	 * @return PDO connection
	 */
	private static function connectToDb() {
		// Database connection
		$db_user = "root";
		$db_pass = "";
		$hostname = "localhost";
		$db_name = "attorney";

		$db = new PDO('mysql:host=' . $hostname . ';dbname=' . $db_name . ';charset=utf8', $db_user, $db_pass);
		// set the PDO error mode to exception
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		return $db;
	}

	/**
	 * Fetch all the records from the database
	 * and save them in the list array
	 * @throws \Exception
	 * @return bool
	 */
	public function fetchAll($orderBy = "order") {
		try {
			// Prepare sql and bind parameters
			$stmt = self::$db->prepare("SELECT * FROM " . static::$table_name . " ORDER BY `" . $orderBy . "` ASC");
			if ($stmt->execute()) {
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					$this->list[] = new static($row);
				}
				return true;
			} else {
				return false;
			}
		} catch (\PDOException $e) {
			throw new \Exception("Error: " . $e->getMessage());
		}
	}

	/**
	 * Fetch all records where field equals value
	 * and save them in list array
	 * @param string $field_name
	 * @param string $value
	 * @param string $orderBy
	 * @return bool
	 * @throws \Exception
	 */
	public function fetchAllByFieldValue($field_name = "", $value, $orderBy = "order") {
		try {
			$stmt = self::$db->prepare("SELECT * FROM " . static::$table_name . " WHERE `" . $field_name . "`=:value ORDER BY `" . $orderBy . "` ASC");
			$stmt->bindParam(':value', $value, static::getPdoTypeByFieldName($field_name));
			if ($stmt->execute()) {
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					$this->list[] = new static($row);
				}
				return true;
			} else {
				return false;
			}
		} catch (\PDOException $e) {
			throw new \Exception("Error: " . $e->getMessage());
		}
	}


	/**
	 * Fetch all records where fields are equal to values
	 * and save them in list array
	 * @param array $fields
	 * @param array $values
	 * @return bool
	 * @throws \Exception
	 */
	public function fetchAllByFieldsValues($fields = array(), $values = array()) {
		try {
			$i = 0;
			$condition = "";
			$bindParams = array();
			foreach ($fields as $field) {
				if ($i != 0)
					$condition .= " AND ";
				$condition .= "`" . $field . "`=:" . $field;
				$bindParams[':' . $field] = $values[$i];
				$i++;
			}
			$sql = "SELECT * FROM " . static::$table_name . " WHERE " . $condition;
			$stmt = self::$db->prepare($sql);
			if ($stmt->execute($bindParams)) {
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					$this->list[] = new static($row);
				}
				return true;
			} else {
				return false;
			}
		} catch (\PDOException $e) {
			throw new \Exception("Error: " . $e->getMessage());
		}
	}

	/**
	 * Get the record where field equals value
	 * @param string $field_name
	 * @param string $value
	 * @return bool
	 * @throws \Exception
	 */
	public function getByFieldValue($field_name = "", $value) {
		try {
			$stmt = self::$db->prepare("SELECT * FROM " . static::$table_name . " WHERE `" . $field_name . "`=:value");
			$stmt->bindParam(':value', $value, static::getPdoTypeByFieldName($field_name));
			if ($stmt->execute()) {
				return new static($stmt->fetch(PDO::FETCH_ASSOC));
			} else {
				return false;
			}
		} catch (\PDOException $e) {
			throw new \Exception("Error: " . $e->getMessage());
		}
	}

	/**
	 * Get the record from the database
	 * based on the provided id
	 * @param int $id
	 * @throws \Exception
	 * @return bool|Object
	 */
	public function getById($id = 0) {
		try {
			$stmt = self::$db->prepare("SELECT * FROM " . static::$table_name . " WHERE `" . static::$id_field . "`=:id");
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			if ($stmt->execute())
				return new static($stmt->fetch(PDO::FETCH_ASSOC));
			else
				return false;
		} catch (\PDOException $e) {
			throw new \Exception("Error: " . $e->getMessage());
		}
	}

	/**
	 * Save the object to a database table
	 * @return bool|string
	 * @throws \Exception
	 */
	public function saveToDb() {
		$fields = "(";
		$values = "(";
		$bindParams = array();
		foreach (static::$fields as $field => $type) {
			$fields .= "`" . $field . "`,";
			$values .= ":" . $field . ",";
			if ($type == "date")
				$bindParams[':' . $field] = $this->$field->format("Y-m-d H:i:s");
			else
				$bindParams[':' . $field] = $this->$field;
		}
		// Remove the trailing commas
		$fields = rtrim($fields, ",");
		$values = rtrim($values, ",");
		$fields .= ")";
		$values .= ")";

		try {
			$stmt = self::$db->prepare("INSERT INTO " . static::$table_name . " " . $fields . " VALUES " . $values);
			if ($stmt->execute($bindParams))
				return self::$db->lastInsertId();
			else
				return false;
		} catch (\PDOException $e) {
			throw new \Exception("Error: " . $e->getMessage());
		}
	}

	/**
	 * Update a row in the database table
	 * @return bool|string
	 * @throws \Exception
	 */
	public function updateInDb() {
		$set = "";
		$bindParams = array();
		foreach (static::$fields as $field => $type) {
			$set .= "`" . $field . "`=:" . $field . ",";
			if ($type == "date")
				$bindParams[':' . $field] = $this->$field->format("Y-m-d H:i:s");
			else
				$bindParams[':' . $field] = $this->$field;
		}
		$set = rtrim($set, ",");
		try {
			$id_field = static::$id_field;
			$stmt = self::$db->prepare("UPDATE " . static::$table_name . " SET " . $set . " WHERE `" . self::$id_field . "`=" . $this->$id_field);
			if ($stmt->execute($bindParams))
				return $this->$id_field;
			else
				return false;
		} catch (\PDOException $e) {
			throw new \Exception("Error: " . $e->getMessage());
		}
	}

	/**
	 * Delete a row in the database table
	 * @return bool
	 * @throws \Exception
	 */
	public function deleteFromDb() {
		try {
			$stmt = self::$db->prepare("DELETE FROM " . static::$table_name . " WHERE `" . self::$id_field . "`=:id");
			$id_field = static::$id_field;
			$stmt->bindParam(':id', $this->$id_field, PDO::PARAM_INT);
			if ($stmt->execute())
				return true;
			else
				return false;
		} catch (\PDOException $e) {
			throw new \Exception("Error: " . $e->getMessage());
		}
	}

	/**
	 * Return the PDO Constant based on field type
	 * @param string $field
	 * @return int
	 */
	protected static function getPdoTypeByFieldName($field = "") {
		$field_type = static::$fields[$field];
		switch ($field_type) {
			case "int":
				return PDO::PARAM_INT;
				break;
			default:
				return PDO::PARAM_STR;
		}
	}
}
