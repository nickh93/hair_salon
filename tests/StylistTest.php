<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Stylist.php";

    $server = 'mysql:host=localhost:8889;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StylistTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Stylist::deleteAll();
            Client::deleteAll();
        }
        
        function test_getId()
        {
            //ARRANGE
            $id = 1;
            $name = "Juliana";
            $test_stylist = new Stylist($name, $id);

            //ACT
            $result = $test_stylist->getId();

            //ASSERT
            $this->assertEquals($id, $result);
        }
        function test_getName()
        {
            //ARRANGE
            $name = "Juliana";
            $test_stylist = new Stylist($name);

            //ACT
            $result = $test_stylist->getName();

            //ASSERT
            $this->assertEquals($name, $result);
        }
        function test_setName()
        {
            //ARRANGE
            $name = "Juliana";
            $test_stylist = new Stylist($name);
            $new_name = "Francesca";

            //ACT
            $test_stylist->setName($new_name);
            $result = $test_stylist->getName();

            //ASSERT
            $this->assertEquals($new_name, $result);
        }

    }
?>
