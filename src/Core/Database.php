<?php
/**
 * Created by PhpStorm.
 * User: Glenn
 * Date: 2016-08-10
 * Time: 10:04 AM
 */

namespace VuPoint\Core;


/**
 * Class Database
 * @package VuPoint\Core
 */
class Database
{
    /**
     * @var \PDO
     */
    private $connection;

    /**
     * @var int
     */
    private $num_rows;

    /**
     * @var int
     */
    private $affected_rows;

    /**
     * @var int
     */
    private $last_insert_id;


    /**
     * Database constructor.
     * @param string $db_name
     * @param string $host
     * @param string $username
     * @param string $password
     */
    public function __construct($db_name = 'reporting', $host = 'localhost', $username = 'reporting', $password = 'r3p0r71ng'){

        $this->connection = new \PDO("mysql:host=".$host.";dbname=".$db_name, $username, $password);

        $this->num_rows = 0;
        $this->affected_rows = 0;
        $this->last_insert_id = 0;
    }

    /**
     * @return \PDO
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * @return int
     */
    public function getNumRows()
    {
        return $this->num_rows;
    }

    /**
     * @return int
     */
    public function getLastInsertId()
    {
        return $this->last_insert_id;
    }

    /**
     * @return int
     */
    public function getAffectedRows()
    {
        return $this->affected_rows;
    }


    /**
     * @param $query
     * @param array $bind
     */
    public function query($query, $bind = array()) {
        $stmt = $this->connection->prepare($query);
        $stmt->execute($bind);
        $this->last_insert_id = $this->connection->lastInsertId();
        $this->num_rows = $stmt->rowCount();
        $this->affected_rows = $stmt->rowCount();
    }

    /**
     * @param $query
     * @param array $bind
     * @return array
     */
    public function fetch_all_assoc($query, $bind = array()) {
        $stmt = $this->connection->prepare($query);
        $stmt->execute($bind);

        $results = $stmt->fetchAll(\PDO::FETCH_BOTH);

        return $results;
    }
}

/*
 * <?php
class DataBase{
	private $connection;
	private $num_rows;
	private $affected_rows;
	private $last_insert_id;

	public function __construct($database){
		if($_SESSION["VuPoint_status_UserLevel"] == ""){
			header("Location: /logout.php");
		}
        require "db_class_params.php";
		$this->connection = mysql_connect($host, $username, $password, TRUE) or die('Failed to connect to database '.mysql_error());
		mysql_select_db($database, $this->connection) or die('Invalid database selection '. mysql_error());
	}
	public function __destruct(){
		$this->close();
	}
	public function query($string){
            if (is_resource($this->connection)){
                $resource = mysql_query($string, $this->connection);

                $n_rows = @mysql_num_rows($resource);
                if(is_null($n_rows) || $n_rows === false){
                        $this->num_rows = 0;
                }
                else{
                        $this->num_rows = $n_rows;
                }

                $a_rows = @mysql_affected_rows($this->connection);
                if(is_null($a_rows) || $a_rows === false){
                        $this->affected_rows = 0;
                }
                else{
                        $this->affected_rows = $a_rows;
                }

				$insert_id = @mysql_insert_id($this->connection);
                if(is_null($insert_id) || $insert_id === false){
                        $this->last_insert_id = 0;
                }
                else{
                        $this->last_insert_id = $insert_id;
                }

                return $resource;
            }
	}
	public function num_rows(){
            return $this->num_rows;
	}
	public function affected_rows(){
            return $this->affected_rows;
	}
	public function insert_id(){
		return $this->last_insert_id;
	}
	//Returns all results as an associative array
	public function fetch_all_assoc($query){
		if(is_resource($this->connection)){
                    $result = $this->query($query);

                    if($result){
                        $all_results = array();

                        while($temp = mysql_fetch_assoc($result)){
                            $all_results[] = $temp;
                        }

                        mysql_free_result($result);
                        return $all_results;
                    }
                }

                return false;
	}
	//Returns a single row as an associative array
	public function fetch_assoc($resource){
            if(is_resource($this->connection)){
                return  mysql_fetch_assoc($resource);
            }
	}
	//Returns all results as numeric array
	public function fetch_all_array($query){
            if (is_resource($this->connection)){
                $result = $this->query($query);

                if($result){
                    while($temp = mysql_fetch_array($result, MYSQL_NUM)){
                            $all_results[] = $temp;
                    }

                    mysql_free_result($result);
                    return $all_results;
                }
            }

            return false;
	}
	//Returns a single row as a numeric array
	public function fetch_array($resource){
            if(is_resource($this->connection)){
                return mysql_fetch_array($resource, MYSQL_NUM);
            }
	}

        public function fetch_row($query){
            if (is_resource($this->connection)){
                $result = $this->query($query);

                if($result){
                    return mysql_fetch_assoc($result);
                }
            }

            return false;
        }
	public function close(){
            if (is_resource($this->connection) )
                mysql_close($this->connection);
	}

	public function escape($string){
            return trim(mysql_real_escape_string($string, $this->connection));
	}
}


 */