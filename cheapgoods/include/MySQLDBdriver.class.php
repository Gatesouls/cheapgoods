<?php
class DBdriver extends Singleton
{
    //vars
    protected $link;
    protected $isConnected = false;
    public $dbDriver;


    protected function __construct()
    {
       //Only for testing:    echo 'Another object has been constructed!!';
    }

    public static function me() {
        return self::getInstance(__CLASS__);
    }
    public static function getDefaultInstance() {
        $dbDriver = static::me();
        $dbDriver->db_connect();
        return $dbDriver;
    }

    //methods:
    //connect to DB
   public function db_connect() {

        $this->link = new mysqli('localhost', 'marcus', 'U2y8E4n0', 'marcus');

        if(mysqli_connect_errno()) {
            throw new Exception('Couldn\'t connect to DB. '.mysqli_connect_errno(). ': '.mysqli_connect_error());
        }
        return $this->isConnected = true;
    }
    //send query function
    public function query($query) {
        return mysqli_query($this->link, $query);
    }

    //send query and get Array
    public function queryArray ($query) {

    $query_result = $this->query($query);

    if (is_bool($query_result)) {
        return array();
    }

    $result = array();

    while ($row = $query_result->fetch_assoc()) {
        $result[] = $row;
    }
    return $result;
    }

    //get rows by table_name, column_name, column_value
    public function getRowsBy ($table, $column_name, $column_value) {
    $result_array = $this->queryArray("SELECT * FROM {$table} WHERE {$column_name} = {$column_value}");
    if (count($result_array) == 0) {
        return null;
    }
    return $result_array;
    }

    //check if connected to DB
    public function isConnected() {
        return $this->isConnected;
    }


}

?>