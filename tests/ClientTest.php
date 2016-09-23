<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Client.php";

    $server = 'mysql:host=localhost:8889;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class ClientTest extends PHPUnit_Framework_TestCase
    {

        function test_getId()
        {
            //ARRANGE
            $id = 1;
            $name = "Alida";
            $test_client = new Client($name, $id);

            //ACT
            $result = $test_client->getId();

            //ASSERT
            $this->assertEquals($id, $result);
        }
        function test_getName()
        {
            //ARRANGE
            $name = "Alida";
            $test_client = new Client($name);

            //ACT
            $result = $test_client->getName();

            //ASSERT
            $this->assertEquals($name, $result);
        }
        function test_setName()
        {
            //ARRANGE
            $name = "Alida";
            $test_client = new Client($name);
            $new_name = "Luisa";

            //ACT
            $test_client->setName($new_name);
            $result = $test_client->getName();

            //ASSERT
            $this->assertEquals($new_name, $result);
        }

    }
?>
