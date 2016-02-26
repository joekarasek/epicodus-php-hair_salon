<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once __DIR__ . '/../src/Stylist.php';
    require_once __DIR__ . '/../src/Client.php';

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

        function test_save()
        {
            // Arrange
            $name = 'Betty Boop';
            $test_Stylist = new Stylist($name);

            // Act
            $test_Stylist->save();

            // Assert
            $result = Stylist::getAll();
            $this->assertEquals($test_Stylist, $result[0]);
        }

        function test_getId()
        {
            // Arrange
            $name = 'Betty Boop';
            $id = 1;
            $test_Stylist = new Stylist($name, $id);

            // Act
            $result = $test_Stylist->getId();

            // Assert
            $this->assertEquals(1, $result);
        }

        function test_getAll()
        {
            // Arrange
            $name = 'Betty Boop';
            $test_Stylist = new Stylist($name);
            $test_Stylist->save();
            $name2 = 'Marth Stewart';
            $test_Stylist2 = new Stylist($name2);
            $test_Stylist2->save();

            // Act
            $result = Stylist::getAll();

            // Assert
            $this->assertEquals([$test_Stylist, $test_Stylist2], $result);

        }

        function test_deleteAll()
        {
            // Arrange
            $name = 'Betty Boop';
            $test_Stylist = new Stylist($name);
            $test_Stylist->save();
            $name2 = 'Martha Stewart';
            $test_Stylist2 = new Stylist($name2);
            $test_Stylist2->save();

            // Act
            Stylist::deleteAll();
            $result = Stylist::getAll();

            // Assert
            $this->assertEquals([], $result);

        }

        function test_find()
        {
            // Arrange
            $name = 'Betty Boop';
            $test_Stylist = new Stylist($name);
            $test_Stylist->save();
            $name2 = 'Martha Stewart';
            $test_Stylist2 = new Stylist($name2);
            $test_Stylist2->save();

            // Act
            $id = $test_Stylist->getId();
            $result = Stylist::find($id);

            // Assert
            $this->assertEquals($test_Stylist, $result);
        }

        function test_update()
        {
            // Arrange
            $name = 'Betty Boop';
            $test_Stylist = new Stylist($name);
            $test_Stylist->save();
            $new_name = 'Bruce Boop';

            // Act
            $test_Stylist->update($new_name);
            $result = $test_Stylist->getName();

            // Assert
            $this->assertEquals($new_name, $result);
        }

        function test_delete()
        {
            // Arrange
            $name = 'Betty Boop';
            $test_Stylist = new Stylist($name);
            $test_Stylist->save();
            $name2 = 'Martha Stewart';
            $test_Stylist2 = new Stylist($name2);
            $test_Stylist2->save();

            // Act
            $test_Stylist->delete();

            // Assert
            $this->assertEquals([$test_Stylist2], Stylist::getAll());
        }

        function test_returnClients()
        {
            // Arrange
            $name = 'Betty Boop';
            $test_Stylist = new Stylist($name);
            $test_Stylist->save();
            $stylist_id = $test_Stylist->getId();
            $name2 = 'Jon Boop';
            $test_Client = new Client($name2, $stylist_id);
            $test_Client->save();
            $name3 = 'Mike Boop';
            $test_Client2 = new Client($name3, $stylist_id);
            $test_Client2->save();

            // Act
            $result = $test_Stylist->getClients();

            // Assert
            $this->assertEquals([$test_Client, $test_Client2], $result);
        }
    }
 ?>
