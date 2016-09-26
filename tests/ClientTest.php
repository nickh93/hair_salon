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
        protected function tearDown()
        {
            Stylist::deleteAll();
            Client::deleteAll();
        }

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

        function test_save()
        {
            //Arrange
            $name = "Ema";
            $test_client = new Client($name);
            $test_client->save();
            //Act
            $result = Client::getAll();

            //Assert
            $this->assertEquals($test_client, $result[0]);
        }

        function test_getAll()
        {
            //Arrange

            $name = "Daisy";
            $name2 = "Martha";
            $test_client = new Client($name);
            $test_client->save();
            $test_client2 = new Client($name2);
            $test_client2->save();

            //Act
            $result = Client::getAll();

            //Assert
            $this->assertEquals([$test_client, $test_client2], $result);
        }

        function test_deleteAll()
        {
            //Arrange

            $name = "Clara";
            $name2 = "Marge";
            $test_client = new Client($name);
            $test_client->save();
            $test_client2 = new Client($name2);
            $test_client2->save();

            //Act
            Client::deleteAll();
            $result = Client::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

    }
?>
