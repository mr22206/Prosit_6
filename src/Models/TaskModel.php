<?php
namespace App\Models;

class TaskModel extends Model {
    const TODO_STATUS = "todo";
    const DONE_STATUS = "done";

    /**
     * TaskModel constructor.
     * 
     * @param mixed $connection The database connection. If null, a new FileDatabase connection will be created.
     */
    public function __construct($connection = null) {
        if(is_null($connection)) {
            $this->connection = new FileDatabase('tasks', ['task', 'status']);
        } else {
            $this->connection = $connection;
        }
    }

    /**
     * Get all tasks from the model.
     * 
     * @return array An array of all tasks.
     */
    public function getAllTasks() {
        return $this->connection->getAllRecords();
    }

    /**
     * Get a specific task by its ID.
     * 
     * @param int $id The ID of the task.
     * @return mixed The task with the specified ID.
     */
    public function getTask($id) {
        return $this->connection->getRecord($id);
    }
    
    /**
     * Get all tasks with the status 'done'.
     * 
     * @return array An array of tasks with the status 'done'.
     */
    public function getDoneTasks() {
        $data = [];
        $tasks = $this->getAllTasks();
        foreach ($tasks as $task) {
            if ($task['status'] === self::DONE_STATUS) {
                $data[] = $task;
            }
        }
        return $data;
    }

    /**
     * Get all tasks with the status 'todo'.
     * 
     * @return array An array of tasks with the status 'todo'.
     */
    public function getToDoTasks() {
        $data = [];
        $tasks = $this->getAllTasks();
        foreach ($tasks as $task) {
            if ($task['status'] === self::TODO_STATUS) {
                $data[] = $task;
            }
        }
        return $data;
    }

    /**
     * Add a new task to the model.
     * 
     * @param string $task The task to add.
     * @return mixed The result of the insert operation.
     */
    public function addTask($task) {
        return $this->connection->insertRecord(['task' => $task, 'status' => self::TODO_STATUS]);
    }

    /**
     * Check a task as 'done' by its ID.
     * 
     * @param int $id The ID of the task to check.
     * @return mixed The result of the update operation.
     */
    public function checkTask($id) {
        $task = $this->getTask($id);
        if (!$task) return false;
        return $this->updateTask($id, $task["task"], self::DONE_STATUS);
    }

    /**
     * Uncheck a task and set its status back to 'todo'.
     * 
     * @param int $id The ID of the task to uncheck.
     * @return mixed The result of the update operation.
     */
    public function uncheckTask($id) {
        $task = $this->getTask($id);
        if (!$task) return false;
        return $this->updateTask($id, $task["task"], self::TODO_STATUS);
    }

    /**
     * Helper method to update a task with a new status.
     * Update a task with a new task and status.
     * 
     * @param int $id The ID of the task to update.
     * @param string $task The new task.
     * @param string $status The new status.
     * @return mixed The result of the update operation.
     */
    private function updateTask($id, $task, $status) {
        $record = ['task' => $task, 'status' => $status];
        return $this->connection->updateRecord($id, $record);
    }

}