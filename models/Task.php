<?php

namespace project\models;

class Task
{
    private $id;
    private $date_create;
    private $status;
    private $title;
    private $description;
    private $file;
    private $deadline;
    private $author_id;
    private $project_id;

    public function __construct($date_create, $status, $title, $description, $file, $deadline, $author_id, $project_id, $id = null)
    {
        $this->date_create = $date_create;
        $this->status = $status;
        $this->title = $title;
        $this->description = $description;
        $this->file = $file;
        $this->deadline = $deadline;
        $this->author_id = $author_id;
        $this->project_id = $project_id;
        $this->id = $id;
    }

    public function validateTasks($arr_project)
    {
        $deadline = $this->getDeadline();
        $project_id = $this->getProjectId();
        $title = $this->getTitle();
        $error_task_arr = [];

        if (!strtotime($deadline) || date('Y-m-d', strtotime($deadline)) !== $deadline) {
            $error_task_arr['deadline_error'] = "Дата завершения должна быть в формате ГГГГ-ММ-ДД.";
        }
        if ($deadline <= $this->getDateCreate()) {
            $error_task_arr['deadline_error'] = "Дата завершения не должна быть меньше даты создания.";
        }

        if (!in_array($project_id, array_column($arr_project, 'id'))) {
            $error_task_arr['$project_id_error'] = "Неверный идентификатор проекта.";
        }

        $title_empty_string = trim($title);
        if ($title_empty_string == '') {
            $error_task_arr['title_error'] =  "Неверное название проекта.";
        }else{
            $this->setTitle($title);
        }
        return $error_task_arr;
    }

    public function saveTask($connPDO)
    {
        try {
            $dateCreate = $this->getDateCreate();
            $status = $this->getStatus();
            $title = $this->getTitle();
            $description = $this->getDescription();
            $file = $this->getFile();
            $deadline = $this->getDeadline();
            $author_id = $this->getAuthorId();
            $project_id = $this->getProjectId();

            $sql = "INSERT INTO task (date_create, status, title, description, file, deadline, author_id, project_id) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $connPDO->prepare($sql);
            $stmt->execute([$dateCreate, $status, $title, $description, $file, $deadline, $author_id, $project_id]);

        } catch (PDOException $e) {
            echo "Ошибка при добавлении задачи: " . $e->getMessage();
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getDateCreate()
    {
        return $this->date_create;
    }

    public function setDateCreate($date_create)
    {
        $this->date_create = $date_create;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function setFile($file)
    {
        $this->file = $file;
    }

    public function getDeadline()
    {
        return $this->deadline;
    }

    public function setDeadline($deadline)
    {
        $this->deadline = $deadline;
    }

    public function getAuthorId()
    {
        return $this->author_id;
    }

    public function setAuthorId($author_id)
    {
        $this->author_id = $author_id;
    }

    public function getProjectId()
    {
        return $this->project_id;
    }

    public function setProjectId($project_id)
    {
        $this->project_id = $project_id;
    }
}
