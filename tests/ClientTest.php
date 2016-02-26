<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once __DIR__ . '/../src/Client.php';

    $server = 'mysql:host=localhost:8889;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class ClientTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Client::deleteAll();
            Stylist::deleteAll();

        }

        function test_save()
        {
            // Arrange
            $name = 'Betty Boop';
            $stylist_id = 1;
            $test_Client = new Client($name, $stylist_id);

            // Act
            $test_Client->save();

            // Assert
            $result = Client::getAll();
            $this->assertEquals($test_Client, $result[0]);
        }

        function test_getId()
        {
            // Arrange
            $name = 'Betty Boop';
            $stylist_id = 10;
            $id = 1;
            $test_Client = new Client($name, $stylist_id, $id);

            // Act
            $result = $test_Client->getId();

            // Assert
            $this->assertEquals(1, $result);
        }

        function test_getAll()
        {
            // Arrange
            $name = 'Betty Boop';
            $stylist_id = 10;
            $test_Client = new Client($name, $stylist_id);
            $test_Client->save();
            $name2 = 'Martha Stewart';
            $test_Client2 = new Client($name2, $stylist_id);
            $test_Client2->save();

            // Act
            $result = Client::getAll();

            // Assert
            $this->assertEquals([$test_Client, $test_Client2], $result);

        }

        function test_deleteAll()
        {
            // Arrange
            $name = 'Betty Boop';
            $stylist_id = 10;
            $test_Client = new Client($name, $stylist_id);
            $test_Client->save();
            $name2 = 'Martha Stewart';
            $test_Client2 = new Client($name2, $stylist_id);
            $test_Client2->save();

            // Act
            Client::deleteAll();
            $result = Client::getAll();

            // Assert
            $this->assertEquals([], $result);

        }

        function test_find()
        {
            // Arrange
            $name = 'Betty Boop';
            $stylist_id = 10;
            $test_Client = new Client($name, $stylist_id);
            $test_Client->save();
            $name2 = 'Martha Stewart';
            $test_Client2 = new Client($name2, $stylist_id);
            $test_Client2->save();

            // Act
            $id = $test_Client->getId();
            $result = Client::find($id);

            // Assert
            $this->assertEquals($test_Client, $result);
        }
    }
 ?>
