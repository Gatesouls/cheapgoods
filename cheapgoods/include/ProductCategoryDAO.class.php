<?php
class ProductCategoryDAO
{
    private $db;
    private $table = 'categories';
    private $column_name ='catname';
    private $column_value = 'Jackets';

    public function __construct($db = null)
    {
        if ($db === null) {
            $this->db = DBdriver::getDefaultInstance();
            echo 'Singleton worked for the first time';
        } else {
            $this->db = $db;
           // echo 'Singleton worked NOT for the first time';
        }
    }
    //methods:

    public function getDataFromDB() {

    $result = $this->db->getRowsBy($this->table, $this->column_name, $this->column_value);
    return $result;
    }

    public function displayData ($array) {
        if (!is_array($array)) {
            return false;
        }
        foreach ($array as $key => $value) {
            echo $key. '=>' . $value;
        }
    }


}
?>