<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1>Створити задачу</h1>
                </div>
                <div class="col-sm-6 d-none d-sm-block">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Створити задачу</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <form method="POST" action="../add.php" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Основні</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputName">Назва задачі</label>
                                <?php if (empty($error_task_arr['title_error']) && empty($error_task_arr['required_fields_error'])) { ?>
                                    <input type="text" id="inputName" class="form-control" name="title">
                                <?php } else { ?>
                                    <input type="text" id="inputName" class="form-control is-invalid" name="title">
                                    <?php foreach ($error_task_arr as $key => $error_message) {
                                        if ($key == "title_error" || $key == "required_fields_error") { ?>
                                            <span id="inputName-error" class="error invalid-feedback"><?php echo $error_message; ?></span>
                                        <?php }
                                    }
                                } ?>
                                <div class="form-group">
                                    <label for="inputDescription">Опис задачі</label>
                                    <?php if (empty($error_task_arr['required_fields_error'])) { ?>
                                        <textarea id="inputDescription" class="form-control" rows="4" name="description"></textarea>
                                    <?php } else {
                                        foreach ($error_task_arr as $key => $error_message) {
                                            if ($key == "required_fields_error") { ?>
                                                <textarea id="inputDescription" class="form-control is-invalid" rows="4" name="description"></textarea>
                                                <span id="inputDescription-error" class="error invalid-feedback"><?php echo $error_message; ?></span>
                                                <?php
                                            }
                                        }
                                    } ?>
                                </div>
                                <div class="form-group">
                                    <?php if (empty($error_task_arr['required_fields_error']) && empty($error_task_arr['project_id_error'])) { ?>
                                        <select class="form-control" id="selectProject" name="project_id">
                                            <?php foreach ($arr_project as $project) {
                                                foreach ($project as $key => $value) {
                                                    if ($key == "id") {
                                                        $project_id = $value;
                                                    }else if ($key == "name") {
                                                        echo '<option value="' . $project_id . '" >' . $value . '</option>';
                                                    }
                                                }
                                            } ?>
                                        </select>
                                    <?php } else {
                                        foreach ($error_task_arr as $key => $error_message) {
                                            if ($key == "project_id_error" || $key == "required_fields_error") { ?>
                                                <select class="form-control is-invalid" id="selectProject" name="project_id">
                                                    <?php foreach ($arr_project as $project) {
                                                        foreach ($project as $key => $value) {
                                                            if ($key == "id") {
                                                                $project_id = $value;
                                                            }else if ($key == "name") {
                                                                echo '<option value="' . $project_id . '" >' . $value . '</option>';
                                                            }
                                                        }
                                                    } ?>
                                                </select>
                                                <span id="selectProject-error" class="error invalid-feedback"><?php echo $error_message; ?></span>
                                                <?php
                                            }
                                        }
                                    } ?>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-6">
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">Додаткові</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputDate">Дата виконання</label>
                                    <?php if (empty($error_task_arr['required_fields_error']) && empty($error_task_arr['deadline_error'])) { ?>
                                        <input type="date" id="inputDate" class="form-control" name="deadline">
                                    <?php } else {
                                        foreach ($error_task_arr as $key => $error_message) {
                                            if ($key == "deadline_error" || $key == "required_fields_error") { ?>
                                                <input type="date" id="inputDate" class="form-control is-invalid" name="deadline">
                                                <span id="inputDate-error" class="error invalid-feedback"><?php echo $error_message; ?></span>
                                                <?php
                                            }
                                        }
                                    } ?>
                                </div>
                                <div class="form-group">
                                    <label for="inputTaskFile">Прикріпити файл</label>
                                    <?php if (empty($error_task_arr['required_fields_error'])) { ?>
                                        <input type="file" id="inputTaskFile" class="form-control" name="file">
                                    <?php } else {
                                        foreach ($error_task_arr as $key => $error_message) {
                                            if ($key == "required_fields_error") { ?>
                                                <input type="file" id="inputTaskFile" class="form-control is-invalid" name="file">
                                                <span id="inputTaskFile-error" class="error invalid-feedback"><?php echo $error_message; ?></span>
                                                <?php
                                            }
                                        }
                                    } ?>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <a href="#" class="btn btn-secondary">Відмініти</a>
                        <input type="submit" value="Створити нову задачу" class="btn btn-success">
                    </div>
                </div>
        </form>
    </section>
</div>
