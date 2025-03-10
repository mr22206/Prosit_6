<?php 
namespace App\Controllers;

use App\Models\TaskModel;

class TaskController extends Controller {

    public function __construct($templateEngine) {
        $this->model = new TaskModel();
        $this->templateEngine = $templateEngine;
    }

    public function welcomePage() {
        $tasks = $this->model->getToDoTasks();
        echo $this->templateEngine->render('todo.twig.html', ['tasks' => $tasks]);
    }

    public function addTask() {
        if (!isset($_POST['task'])) {
            header('Location: /');
            return;
        }

        $task = $_POST['task'];
        $this->model->addTask($task);
        header('Location: /');
    }

    public function checkTask() {
        if (!isset($_POST['id'])) {
            header('Location: /');
            return;
        }

        $id = $_POST['id'];
        $this->model->checkTask($id);
        header('Location: /');
    }

    public function historyPage() {
        // TODO: Retrieve the list of tasks from the model
        // TDOO: Render the history.twig.html template with the list of tasks
    }

    public function uncheckTask() {
        // It's the same as the checkTask method, but we call the uncheckTask method of the model...
    }

    public function aboutPage() {
        // TODO: Render the about.twig.html template
    }


}
