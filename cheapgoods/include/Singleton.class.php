<?php
/**
 * User: Mark Skachkov
 * Date: 9/24/2018
 */

abstract class Singleton {
    protected static $instances;

    private function __construct() {/* No direct instantiation */}

    public static function getInstance($class = null)
    {
        if(!$class)
            $class = __CLASS__;
        if(!isset(self::$instances[$class])) {
            self::$instances[$class] = new $class;
        }

            return self::$instances[$class];

    }
}
/** How to use Singleton
 * class DBdriver extends Singleton {

public function __construct()
{
echo 'A new object!!!';
}


public static function me()
{
return self::getInstance(__CLASS__);
}
}

$object =  DBDriver::me();
$object2 = DBdriver::me();
$object3 = DBdriver::me();
 */
?>