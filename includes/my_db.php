<?php

/**
 * Class for execute a Mysql query
 * Inspired by Zend Framework
 * 
 * @author tuannh
 * @since 2011/08
 * Last modified: 10/19/2012
 */
class My_Db {

	/**
	 *
	 * @var mysqli
	 */
	private $_mysqli_con;

	/**
	 * @var mysqli
	 */
	private static $_current = NULL;

	private $_host;

	private $_username;

	private $_password;

	private $_db_name;

	const SELECT_ALL = 1;
	const SELECT_ROW = 2;
	const SELECT_COL = 3;
	const SELECT_PAIRS = 4;
	const SELECT_ASSOC = 5;

	public function __construct($host, $username, $password, $db_name, $charset = 'utf8') {
		$this->_host = $host;
		$this->_username = $username;
		$this->_password = $password;
		$this->_db_name = $db_name;
		$this->_mysqli_con = @mysqli_connect($this->_host, $this->_username, $this->_password);

		if (!$this->_mysqli_con) {
			throw new Exception('Error while connect to MySql: ' . mysqli_connect_error());
		}

		if (!$this->_mysqli_con->select_db($this->_db_name)) {
			throw new Exception('Error while selecting DB ' . $db_name . ': ' . mysqli_connect_error());
		}

		$this->_mysqli_con->set_charset($charset);

		self::$_current = $this;
	}

	/**
	 * @return My_Db
	 */
	public static function current() {
		return self::$_current;
	}
	
	/**
	 * mysqli
	 *
	 * @return type 
	 */
	public function get_mysqli_con() {
		return $this->_mysqli_con;
	}

	/**
	 * Execute normal query
	 *
	 * @param string $sql
	 */
	public function query($sql) {
		$this->_mysqli_con->query($sql);
	}

	/**
	 * Build format string, like: 'iisssddbb'
	 * i: integer; d: double; s: string; b: BLOB content
	 *
	 * @param array $bind_array
	 * @return string 
	 */
	private static function format_string_builder($bind_array) {
		$ret_string = '';
		foreach ($bind_array as $item) {
			$this_type = 'b';

			if (is_integer($item)) {
				$this_type = 'i';
			} else if (is_string($item)) {
				$this_type = 's';
			} else if (is_double($item)) {
				$this_type = 'd';
			}

			$ret_string .= $this_type;
		}

		return $ret_string;
	}

	/**
	 * Rebuild bind_array, purpose: pass reference to bind_* function
	 *
	 * @param array $bind_array 
	 */
	private static function rebuild_bind_array(&$bind_array) {
		foreach ($bind_array as $key => $item) {
			$bind_array[$key] = & $bind_array[$key];
		}
	}

	/**
	 * @param string $sql
	 * @param array|null $bind_param
	 * @param int $select_mode
	 * @return array
	 * @throws Exception
	 */
	public function select($sql, $bind_param = null, $select_mode = My_Db::SELECT_ALL) {
		if ($select_mode == My_Db::SELECT_ROW) {
			$sql = preg_replace('/LIMIT\s+\d+/i', 'LIMIT 1', $sql);
		}

		// Prepare
		$stmt = $this->_mysqli_con->prepare($sql);

		if (!$stmt) {
			throw new Exception('Error while preparing sql query: ' . $this->_mysqli_con->error);
		}

		// Bind param
		if (!is_null($bind_param)) {
			// Re-build bind_param
			$format_string = My_Db::format_string_builder($bind_param);
			array_unshift($bind_param, $format_string);
			My_Db::rebuild_bind_array($bind_param);

			// Call bind_param
			call_user_func_array(array($stmt, 'bind_param'), $bind_param);
		}

		// Execute
		$stmt->execute();

		// Get resultset for metadata, to get field_names
		$result = $stmt->result_metadata();

		// Retrieve field information from metadata result set
		$fields = array();
		while ($field = $result->fetch_field()) {
			$fields[] = $field->name;
		}

		// Close resultset
		$result->close();

		// Build bind_result
		$bind_result = array();
		foreach ($fields as $field) {
			$bind_result[] = & $return_row[$field];
		}

		// Bind result
		call_user_func_array(array($stmt, 'bind_result'), $bind_result);

		// Store result, to get num_rows
		$stmt->store_result();

		// FETCH
		$return_rows = array();
		switch (intval($stmt->num_rows)) {
			case 0:
				// 0 result
				$return_rows = array();
				break;
			default:
				// Multiple results
				while ($stmt->fetch()) {
					$row_tmp = array();

					foreach ($return_row as $key => $item) {
						$row_tmp[$key] = $item;
					}

					switch ($select_mode) {
						case My_Db::SELECT_COL:
							$return_rows[] = $row_tmp[$fields[0]];
							break;
						case My_Db::SELECT_ROW:
							$return_rows = $row_tmp;
							break;
						case My_Db::SELECT_PAIRS:
							$return_rows[$row_tmp[$fields[0]]] = $row_tmp[$fields[1]];
							break;
						case My_Db::SELECT_ASSOC:
							$return_rows[$row_tmp[$fields[0]]] = $row_tmp;
							break;
						default: // My_Db::SELECT_ALL
							$return_rows[] = $row_tmp;
							break;
					}
				}
				break;
		}

		// Free result
		$stmt->free_result();

		// Close
		$stmt->close();

		return $return_rows;
	}

	/**
	 * Alias of select method with SELECT_MODE = SELECT_ROW
	 *
	 * @param string $sql
	 * @param array|null $bind_param
	 * @return array
	 */
	public function select_row($sql, $bind_param = null) {
		return $this->select($sql, $bind_param, My_Db::SELECT_ROW);
	}

	/**
	 * Alias of select method with SELECT_MODE = SELECT_COL
	 *
	 * @param string $sql
	 * @param array|null $bind_param
	 * @return array
	 */
	public function select_col($sql, $bind_param = null) {
		return $this->select($sql, $bind_param, My_Db::SELECT_COL);
	}

	/**
	 * Alias of select method with SELECT_MODE = SELECT_PAIRS
	 *
	 * @param string $sql
	 * @param array|null $bind_param
	 * @return array
	 */
	public function select_pairs($sql, $bind_param = null) {
		return $this->select($sql, $bind_param, My_Db::SELECT_PAIRS);
	}
	
	/**
	 * Alias of select method with SELECT_MODE = SELECT_ASSOC
	 *
	 * @param string $sql
	 * @param array|null $bind_param
	 * @return array
	 */
	public function select_assoc($sql, $bind_param = null) {
		return $this->select($sql, $bind_param, My_Db::SELECT_ASSOC);
	}

	/**
	 * Execute INSERT query
	 *
	 * @param string $sql
	 * @param array|null $bind_param
	 * @return integer|string last inserted primary key
	 * @throws Exception
	 */
	public function insert($sql, $bind_param = null) {
		// Prepare
		$stmt = $this->_mysqli_con->prepare($sql);

		if (!$stmt) {
			throw new Exception('Error while preparing sql query: ' . $this->_mysqli_con->error);
		}

		// Bind param
		if (!is_null($bind_param)) {
			// Re-build bind_param
			$format_string = My_Db::format_string_builder($bind_param);
			array_unshift($bind_param, $format_string);
			My_Db::rebuild_bind_array($bind_param);

			// Call bind_param
			call_user_func_array(array($stmt, 'bind_param'), $bind_param);
		}

		// Execute
		$stmt->execute();

		// Affected records
		$last_inserted_id = $stmt->insert_id;

		// Close
		$stmt->close();

		return $last_inserted_id;
	}

	/**
	 * Execute DELETE|UPDATE query
	 *
	 * @param string $sql
	 * @param array|null $bind_param
	 * @return integer number of affected records
	 * @throws Exception
	 */
	public function execute($sql, $bind_param = null) {
		// Prepare
		$stmt = $this->_mysqli_con->prepare($sql);

		if (!$stmt) {
			throw new Exception('Error while preparing sql query: ' . $this->_mysqli_con->error);
		}

		// Bind param
		if (!is_null($bind_param)) {
			// Re-build bind_param
			$format_string = My_Db::format_string_builder($bind_param);
			array_unshift($bind_param, $format_string);
			My_Db::rebuild_bind_array($bind_param);

			// Call bind_param
			call_user_func_array(array($stmt, 'bind_param'), $bind_param);
		}

		// Execute
		$stmt->execute();

		// Affected records
		$num_affected_rows = $stmt->affected_rows;

		// Close
		$stmt->close();

		return $num_affected_rows;
	}

	/**
	 * Return '?, ?, ?..' string
	 * @param $count integer
	 * @return string
	 */
	private function _question_mark_builder($count) {
		return implode(',', array_fill(0, $count, '?'));
	}

	/**
	 * BUILD: 'id = ? AND name = ?...'
	 * @param array $fields_array
	 * @return string
	 */
	private function _select_question_mark_builder($fields_array = array()) {
		$result = array();

		foreach ($fields_array as $field) {
			$result[] = "$field = ?";
		}

		return (!empty($result)) ? implode(' AND ', $result) : '';
	}

	/**
	 * Insert a record
	 * @param $table_name string
	 * @param $fields_array array
	 * @return array
	 */
	public function insert_record($table_name, $fields_array) {
		$fields_name = implode(',', (array_keys($fields_array)));
		$fields_value = array_values($fields_array);

		$sql = 'INSERT INTO ' . $table_name . ' (' . $fields_name . ') VALUES('
			. $this->_question_mark_builder(count($fields_array)) . ')';

		return $this->insert($sql, $fields_value);
	}

	/**
	 * SELECT a record
	 * @param $table_name
	 * @param array $fields_array
	 * @param array $where_array
	 * @return array
	 */
	public function select_record($table_name, $fields_array = array(), $where_array = array()) {
		$fields_name = (!empty($fields_array)) ? implode(',', $fields_array) : '*';
		$fields_where = array_keys($where_array);
		$values_where = array_values($where_array);

		$sql = "SELECT $fields_name FROM $table_name WHERE " . $this->_select_question_mark_builder($fields_where);

		return $this->select_assoc($sql, $values_where);
	}

	/**
	 * UPDATE a record
	 * @param $table_name
	 * @param array $fields_array
	 * @param array $where_array
	 * @return array
	 */
	public function update_record($table_name, $fields_array = array(), $where_array = array()) {
		$update_sets = array();
		foreach ($fields_array as $field => $value) {
			$update_sets[] = "$field = $value";
		}
		$fields_where = array_keys($where_array);
		$values_where = array_values($where_array);

		$sql = "UPDATE $table_name SET " . implode(',', $update_sets) . " WHERE " . $this->_select_question_mark_builder($fields_where);

		return $this->execute($sql, $values_where);
	}

	/**
	 * Convert an array, string, or Zend_Db_Expr object
	 * into a string to put in a WHERE clause.
	 *
	 * @param mixed $where
	 * @return string
	 */
	protected function _whereExpr($where)
	{
		if (empty($where)) {
			return $where;
		}
		if (!is_array($where)) {
			$where = array($where);
		}
		foreach ($where as $cond => &$term) {
			// is $cond an int? (i.e. Not a condition)
			if (is_int($cond)) {
				// $term is the full condition
				if ($term instanceof Zend_Db_Expr) {
					$term = $term->__toString();
				}
			} else {
				// $cond is the condition with placeholder,
				// and $term is quoted into the condition
				$term = $this->quoteInto($cond, $term);
			}
			$term = '(' . $term . ')';
		}

		$where = implode(' AND ', $where);
		return $where;
	}

	public function __destruct() {
		if ($this->_mysqli_con) {
			$this->_mysqli_con->close();
		}
	}

	public function __sleep()
	{
		return array('_host', '_username', '_password', '_db_name');
	}

	public function __wakeup()
	{
		$this->__construct($this->_host, $this->_username, $this->_password, $this->_db_name);
	}

}