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

        function test_save()
        {
            //Arrange
            $name = "Pandora";
            $test_stylist = new Stylist($name);
            $test_stylist->save();
            //Act
            $result = Stylist::getAll();

            //Assert
            $this->assertEquals($test_stylist, $result[0]);
        }

        function test_getAll()
        {
            //Arrange

            $name = "Juliana";
            $name2 = "Elizabeth";
            $test_stylist = new Stylist($name);
            $test_stylist->save();
            $test_stylist2 = new Stylist($name2);
            $test_stylist2->save();

            //Act
            $result = Stylist::getAll();

            //Assert
            $this->assertEquals([$test_stylist, $test_stylist2], $result);
        }

        function test_deleteAll()
        {
            //Arrange

            $name = "Linda";
            $name2 = "Sophia";
            $test_stylist = new Stylist($name);
            $test_stylist->save();
            $test_stylist2 = new Stylist($name2);
            $test_stylist2->save();

            //Act
            Stylist::deleteAll();
            $result = Stylist::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $name = "Aura";
            $name2 = "Michelle";
            $test_Stylist = new Stylist($name);
            $test_Stylist->save();
            $test_Stylist2 = new Stylist($name2);
            $test_Stylist2->save();

            //Act
            $result = Stylist::find($test_Stylist->getId());

            //Assert
            $this->assertEquals($test_Stylist, $result);
        }
        function test_getClients()
        {
            //ARRANGE
            $name = "Aura";
            $name2 = "Michelle";
            $test_Stylist = new Stylist($name);
            $test_Stylist->save();
            $test_Stylist_id = $test_Stylist->getId();
            $test_Stylist2 = new Stylist($name2);
            $test_Stylist2->save();
            $test_Stylist_id2 = $test_Stylist2->getId();

            $client_name = "Nicole";
            $test_client = new Client($client_name, $test_Stylist_id);
            $test_client->save();

            $client_name2 = "Cindy";
            $test_client2 = new Client($client_name2, $test_Stylist_id);
            $test_client2->save();

            $client_name3 = "Sansa";
            $test_client3 = new Client($client_name3, $test_Stylist_id2);
            $test_client3->save();

            //ACT
            $result = $test_Stylist->getClients();

            //ASSERT
            $this->assertEquals([$test_client, $test_client2], $result);
        }

        function test_Update()
        {
            //ARRANGE
            $name = "Shannon";
            $id = null;
            $test_stylist = new Stylist($name, $id);
            $test_stylist->save();

            $new_name = "Jorge";

            //ACT
            $test_stylist->update($new_name);
            //ASSERT
            $this->assertEquals("Jorge", $test_stylist->getName());
        }

        function testDelete()
        {
            //Arrange
            $name = "Shannon";
            $id = null;
            $test_stylist = new Stylist($name, $id);
            $test_stylist->save();

            $name2 = "Hannah";
            $test_stylist2 = new Stylist($name2, $id);
            $test_stylist2->save();


            //Act
            $test_stylist->delete();

            //Assert
            $this->assertEquals([$test_stylist2], Stylist::getAll());
        }

        function testDeleteStylistClients()
        {
            //Arrange
            $name = "Hannah";
            $id = null;
            $test_stylist = new Stylist($name, $id);
            $test_stylist->save();

            $client = "Tanya";
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($client, $id, $stylist_id);
            $test_client->save();


            //Act
            $test_stylist->delete();

            //Assert
            $this->assertEquals([], Client::getAll());
        }
    }
?>
