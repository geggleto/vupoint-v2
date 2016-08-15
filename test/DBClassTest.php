<?php
/**
 * Created by PhpStorm.
 * User: Glenn
 * Date: 2016-08-15
 * Time: 9:02 AM
 */

namespace VuPoint\Tests;


/**
 * Class DBClassTest
 * @package VuPoint\Tests
 */
class DBClassTest extends \PHPUnit_Framework_TestCase
{
    /** @var \DataBase */
    protected static $db1;

    /** @var  \VuPoint\Core\Database */
    protected static $db2;


    public static function setUpBeforeClass()
    {
        include __DIR__."/../vendor/autoload.php";
        include __DIR__."/../../lib/db_class_unsecure.php";

        self::$db2 = new \VuPoint\Core\Database();

        self::$db1 = new \DataBase("reporting");
    }

    public function testAssoc() {

        $a1 = self::$db1->fetch_all_assoc('select * from employees LIMIT 1');
        $a2 = self::$db2->fetch_all_assoc('select * from employees LIMIT 1');

        $result = array_diff($a1[0], $a2[0]);

        $this->assertEmpty($result);
    }
}