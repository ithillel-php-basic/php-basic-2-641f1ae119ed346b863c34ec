<?php
require_once "helpers.php";
require_once "database/database_connect.php";
require_once "function/function_task.php";
require_once "function/function_project.php";
require_once "models/Task.php";

use project\models\Task;

$author_id = 1;
$conn = databaseConnect();
$connPDO = databaseConnectPDO();
$error_task_arr = [];
$arr_project = getProjects($conn, $author_id);
$arr_tasks_primary = getTasks($conn, $author_id);

/////////////////////////////////////////////// потом нужно сделать по нормальному все в ООП, что бы не дублировать код
$status_project_button = 0;

if (isset($_GET["project_id"])) {
    $project_id = $_GET["project_id"];
    $arr_tasks_primary = getTasks($conn, $author_id, $project_id);
    rowsEmpty($arr_tasks_primary);
    $status_project_button =  $project_id;
}

foreach ($arr_tasks_primary as $task) {
    $projectId = $task['project_id'];
    $projectName = '';
    foreach ($arr_project  as $project) {
        if ($project['id'] == $projectId) {
            $projectName = $project['name'];
            break;
        }
    }
    $arr_tasks[] = [
        'title' => $task['title'],
        'deadline' => $task['deadline'],
        'project_name' => $projectName,
        'status' => $task['status'],
        'file' => $task['file'],
    ];
}
////////////////////////////////////////////////
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['title']) && !empty($_POST['project_id'])){
        $title = $_POST['title'];
        $description = $_POST['description'];
        $project_id = $_POST['project_id'];
        $deadline = $_POST['deadline'];

        $tmpFilePath = $_FILES['file']['tmp_name'];
        $file = 'uploads/' . $_FILES['file']['name'];
        move_uploaded_file($tmpFilePath, $file);

        $date_create = task_date_create();
        $status = "backlog";

        $task = new Task($date_create, $status, $title, $description, $file, $deadline, $author_id, $project_id);

        $error_task_arr = $task->validateTasks($arr_project);
        if(empty($error_task_arr)) {
            $task->saveTask($connPDO);
            header("Location: index.php");
            exit;
        }
    } else {
        $error_task_arr['required_fields_error'] = "Пожалуйста, заполните все обязательные поля.";
    }
}

$title = "Завдання та проекти | Дошка";
$mainName = "Дмитрий";
$mainImagePath = "static/img/user2-160x160.jpg";

$content = renderTemplate("task-add.php",['arr_project' => $arr_project, 'error_task_arr' => $error_task_arr]);
$content_main = renderTemplate("main.php",['content' => $content, 'mainName' => $mainName, 'mainImagePath' => $mainImagePath, 'arr_project' => $arr_project, 'arr_tasks' => $arr_tasks, 'status_project_button' => $status_project_button]);
$content_layout = renderTemplate("layout.php",['content_main' => $content_main, 'title' => $title]);

print($content_layout);
