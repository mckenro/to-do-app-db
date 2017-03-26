<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Task.php";

    $server = 'mysql:host=localhost:8889;dbname=to_do_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class TaskTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Task::deleteAll();
        }

        function test_save()
        {
            //Arrange
            $description = "Wash the dog";
            $test_task = new Task($description);

            //Act
            $executed = $test_task->save();

            // Assert
            $this->assertTrue($executed, "Task not successfully saved to database");
        }

        function test_getAll()
        {
          //Arrange
          $description = "Wash the dog";
          $description2 = "Water the lawn";
          $test_task = new Task($description);
          $test_task->save();
          $test_task2 = new Task($description2);
          $test_task2->save();

          //Act
          $result = Task::getAll();

          //Assert
          $this->assertEquals([$test_task, $test_task2], $result);
        }

        function test_deleteAll()
        {
          //Arrange
          $description = "Wash the dog";
          $description2 = "Water the lawn";
          $test_task = new Task($description);
          $test_task->save();
          $test_task2 = new Task($description2);
          $test_task2->save();

          //Act
          Task::deleteAll();

          //Assert
          $result = Task::getAll();
          $this->assertEquals([], $result);
        }
    }
?>
