<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Client.php";
    require_once "src/Stylist.php";

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
            $stylist_name = "Juliana";
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();
            $stylist_id = $test_stylist->getId();

            $id = 1;
            $name = "Alida";
            $test_client = new Client($name, $stylist_id, $id);

            //ACT
            $result = $test_client->getId();

            //ASSERT
            $this->assertEquals($id, $result);
        }
        function test_getName()
        {
            //ARRANGE
            $stylist_name = "Juliana";
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();
            $stylist_id = $test_stylist->getId();

            $name = "Alida";
            $test_client = new Client($name, $stylist_id);

            //ACT
            $result = $test_client->getName();

            //ASSERT
            $this->assertEquals($name, $result);
        }
        function test_setName()
        {
            //ARRANGE
            $stylist_name = "Juliana";
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();
            $stylist_id = $test_stylist->getId();

            $name = "Alida";
            $test_client = new Client($name, $stylist_id);
            $new_name = "Luisa";

            //ACT
            $test_client->setName($new_name);
            $result = $test_client->getName();

            //ASSERT
            $this->assertEquals($new_name, $result);
        }

        function test_getStylistId()
        {
            //ARRANGE
            $stylist_name = "Juliana";
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();
            $stylist_id = $test_stylist->getId();

            $name = "Alida";
            $test_client = new Client($name, $stylist_id);

            //ACT
            $result = $test_client->getStylistId();

            //ASSERT
            $this->assertEquals($stylist_id, $result);
        }

        function test_setStylistId()
        {
            //ARRANGE
            $stylist_name = "Juliana";
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();
            $stylist_id = $test_stylist->getId();

            $stylist_name = "Daniela";
            $test_stylist2 = new Stylist($stylist_name);
            $test_stylist2->save();
            $stylist_id2 = $test_stylist2->getId();

            $name = "Alida";
            $test_client = new Client($name, $stylist_id);

            //ACT
            $test_client->setStylistId($stylist_id2);
            $result = $test_client->getStylistId();
            //ASSERT
            $this->assertEquals($stylist_id2, $result);

        }
        function test_save()
        {
            //Arrange
            $stylist_name = "Juliana";
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();
            $stylist_id = $test_stylist->getId();

            $name = "Ema";
            $test_client = new Client($name, $stylist_id);
            $test_client->save();
            //Act
            $result = Client::getAll();

            //Assert
            $this->assertEquals($test_client, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $stylist_name = "Juliana";
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();
            $stylist_id = $test_stylist->getId();

            $name = "Daisy";
            $name2 = "Martha";
            $test_client = new Client($name, $stylist_id);
            $test_client->save();
            $test_client2 = new Client($name2, $stylist_id);
            $test_client2->save();

            //Act
            $result = Client::getAll();

            //Assert
            $this->assertEquals([$test_client, $test_client2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $stylist_name = "Juliana";
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();
            $stylist_id = $test_stylist->getId();

            $name = "Clara";
            $name2 = "Marge";
            $test_client = new Client($name, $stylist_id);
            $test_client->save();
            $test_client2 = new Client($name2, $stylist_id);
            $test_client2->save();

            //Act
            Client::deleteAll();
            $result = Client::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $stylist_name = "Juliana";
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();
            $stylist_id = $test_stylist->getId();

            $name = "Denise";
            $name2 = "Ema";
            $test_Client = new Client($name, $stylist_id);
            $test_Client->save();
            $test_Client2 = new Client($name2, $stylist_id);
            $test_Client2->save();

            //Act
            $result = Client::find($test_Client->getId());

            //Assert
            $this->assertEquals($test_Client, $result);
        }

    }
?>
