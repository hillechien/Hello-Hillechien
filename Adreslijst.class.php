<?php
/**
 * @package adreslijst
 */
/**
 * Adreslijst Class
 *
 * @author
 */

require_once('MyDB.class.php');
class Adreslijst
{
	/**
	 * Adreslijst Class

	 *
	 */
	var $aanhef = "";
	var $voorletters = "";
	var $tussenvoegsel = "";
	var $achternaam = "";
	var $straat = "";
	var $plaats = "";
	var $land = "";
	var $telefoon = "";
	var $db;


	function Adreslijst($cArray = null)
	{
		/**
		 * constructor for Adreslijst
		 *
		 * The constructor can take an optional Array parameter, where the
		 * index to the Array is the column name.
		 */
		//		echo "<br/>constructor called with parameter $cArray ";
		if ($cArray) {
			if ($cArray['aanhef'])
			$this->aanhef = $cArray['aanhef'];
			if ($cArray['voorletters'])
			$this->voorletters = $cArray['voorletters'];
			if ($cArray['tussenvoegsel'])
			$this->tussenvoegsel = $cArray['tussenvoegsel'];
			if ($cArray['achternaam'])
			$this->achternaam = $cArray['achternaam'];
			if ($cArray['straat'])
			$this->straat = $cArray['straat'];
			if ($cArray['postcode'])
			$this->postcode = $cArray['postcode'];
			if ($cArray['plaats'])
			$this->plaats = $cArray['plaats'];
			if ($cArray['land'])
			$this->land = $cArray['land'];
			if ($cArray['telefoon'])
			$this->telefoon = $cArray['telefoon'];
		}
		//$this->db = new MyDB();
		$mysqli = new mysqli('localhost', 'root', 'krach', 'familie');

		/*
		 * Use this instead of $connect_error if you need to ensure
		 * compatibility with PHP versions prior to 5.2.9 and 5.3.0.
		 */
		if (mysqli_connect_error()) {
			die('Connect Error (' . mysqli_connect_errno() . ') '
			. mysqli_connect_error());
		}
		$this->db = $mysqli;
	}


	// table insert function for Adreslijst
	function insert()
	{
		/**
		 * Insert a row into the database.
		 * Make sure all variables have their slashes added where needed before calling
		 * the insert function.
		 * It is assumed that the variable values are already put in the instance variables of this class.
		 */
		$qstring = "\"{$this->aanhef}\", \"{$this->voorletters}\",
	 \"{$this->tussenvoegsel}\",
	 \"{$this->achternaam}\",
	 \"{$this->straat}\",
	 \"{$this->postcode}\",
	 \"{$this->plaats}\", 
	 \"{$this->land}\",
	 \"{$this->telefoon}\" )"; 
		$mysqli = $this->db;
		$mysqli->query('INSERT INTO Adreslijst (aanhef, voorletters, tussenvoegsel, achternaam, straat, postcode, plaats, land, telefoon) VALUES ( '.$qstring);
	}

	// select rows from Adreslijst
	function select($collist = "", $where = "", $order = null)
	{
		if ($collist == '') $collist = '*';
		$selectQuery = 'SELECT ' . $collist. ' FROM ' . "Adreslijst";
		if ($where != "") $selectQuery = $selectQuery . ' where ' . $where;
		if ($order) $selectQuery = $selectQuery . ' order by ' . $order;
		/* Select queries return a resultset */
		$mysqli = $this->db;
		if ($result = $mysqli->query($selectQuery)) {
			printf("Select returned %d rows.\n", $result->num_rows);

			/* free result set */
			$result->close();
		}
		//$result = $this->db->doQuery($selectQuery);
		//return $result;
	}

	function delete($where)
	{
		$query = "DELETE FROM Adreslijst WHERE ";
		$query .= $where;
		$result = $this->db->doQuery($query);
		return $result;
	}




}
?>
