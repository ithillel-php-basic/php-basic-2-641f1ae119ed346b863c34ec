<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1>Назва проекту</h1>
            </div>
            <div class="col-sm-6 d-none d-sm-block">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Назва проекту</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <div class="row">
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <a type="button" href="#" class="btn btn-secondary active">Усі завдання</a>
                        <a type="button" href="#" class="btn btn-default">Порядок денний</a>
                        <a type="button" href="#" class="btn btn-default">Завтра</a>
                        <a type="button" href="#" class="btn btn-default">Прострочені</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="content pb-3">
    <div class="container-fluid h-100">
        <div class="card card-row card-secondary">
            <div class="card-header">
                <h3 class="card-title">
                    Беклог
                </h3>
            </div>
            <div class="card-body connectedSortable" data-status="backlog">
                <?php foreach($arr_tasks as $item){
                    if($item["status"] == "backlog"){
                        ?>
                        <div class="card card-info card-outline" data-task-id="1">
                            <div class="card-header">
                                <h5 class="card-title"> <?php echo htmlspecialchars($item["title"])?> </h5>
                                <div class="card-tools">
                                    <a href="#" class="btn btn-tool btn-link">#3</a>
                                    <a href="#" class="btn btn-tool">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <p>
                                    Зробити головну сторінку списку задач з можливістю перегляду,
                                    створення, редагування, видалення задач.
                                </p>
                                <a href="#" class="btn btn-tool">
                                    <i class="fas fa-file"></i>
                                </a>
                                <?php if($item["deadline"] !== null){
                                    $date_difference = task_time($item["deadline"]);
                                    if($date_difference > 24){
                                    ?>
                               <small class="badge badge-success"><i class="far fa-clock"></i> <?php echo htmlspecialchars(task_time_output($date_difference))?> </small>
                                <?php
                                    }
                                else{ ?>
                               <small class="badge badge-danger"><i class="far fa-clock"></i> <?php echo htmlspecialchars(task_time_output($date_difference))?> </small>
                              <?php }
                                } ?>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
        <div class="card card-row card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    Зробити
                </h3>
            </div>
            <div class="card-body connectedSortable" data-status="to-do">
                <?php foreach($arr_tasks as $item){
                    if($item["status"] == "to-do"){
                        ?>
                        <div class="card card-info card-outline" data-task-id="1">
                            <div class="card-header">
                                <h5 class="card-title"> <?php echo htmlspecialchars($item["title"])?> </h5>
                                <div class="card-tools">
                                    <a href="#" class="btn btn-tool btn-link">#3</a>
                                    <a href="#" class="btn btn-tool">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <p>
                                    Зробити головну сторінку списку задач з можливістю перегляду,
                                    створення, редагування, видалення задач.
                                </p>
                                <a href="#" class="btn btn-tool">
                                    <i class="fas fa-file"></i>
                                </a>
                                <?php if($item["deadline"] !== null){
                                    $date_difference = task_time($item["deadline"]);
                                    if($date_difference > 24){
                                        ?>
                                        <small class="badge badge-success"><i class="far fa-clock"></i> <?php echo htmlspecialchars(task_time_output($date_difference))?> </small>
                                        <?php
                                    }
                                else{ ?>
                                    <small class="badge badge-danger"><i class="far fa-clock"></i> <?php echo htmlspecialchars(task_time_output($date_difference))?> </small>
                                <?php }
                                } ?>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
        <div class="card card-row card-default">
            <div class="card-header bg-info">
                <h3 class="card-title">
                    В процесі
                </h3>
            </div>
            <div class="card-body connectedSortable" data-status="in-progress">
                <?php foreach($arr_tasks as $item){
                    if($item["status"] == "in-progress"){
                        ?>
                        <div class="card card-info card-outline" data-task-id="1">
                            <div class="card-header">
                                <h5 class="card-title"> <?php echo htmlspecialchars($item["title"])?> </h5>
                                <div class="card-tools">
                                    <a href="#" class="btn btn-tool btn-link">#3</a>
                                    <a href="#" class="btn btn-tool">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <p>
                                    Зробити головну сторінку списку задач з можливістю перегляду,
                                    створення, редагування, видалення задач.
                                </p>
                                <a href="#" class="btn btn-tool">
                                    <i class="fas fa-file"></i>
                                </a>
                                <?php if($item["deadline"] !== null){
                                    $date_difference = task_time($item["deadline"]);
                                    if($date_difference > 24){
                                        ?>
                                        <small class="badge badge-success"><i class="far fa-clock"></i> <?php echo htmlspecialchars(task_time_output($date_difference))?> </small>
                                        <?php
                                    }
                                    else{ ?>
                                        <small class="badge badge-danger"><i class="far fa-clock"></i> <?php echo htmlspecialchars(task_time_output($date_difference))?> </small>
                                    <?php }
                                } ?>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
        <div class="card card-row card-success">
            <div class="card-header">
                <h3 class="card-title">
                    Готово
                </h3>
            </div>
            <div class="card-body connectedSortable" data-status="done">
                <?php foreach($arr_tasks as $item){
                    if($item["status"] == "done"){
                        ?>
                        <div class="card card-info card-outline" data-task-id="1">
                            <div class="card-header">
                                <h5 class="card-title"> <?php echo htmlspecialchars($item["title"])?> </h5>
                                <div class="card-tools">
                                    <a href="#" class="btn btn-tool btn-link">#3</a>
                                    <a href="#" class="btn btn-tool">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <p>
                                    Зробити головну сторінку списку задач з можливістю перегляду,
                                    створення, редагування, видалення задач.
                                </p>
                                <a href="#" class="btn btn-tool">
                                    <i class="fas fa-file"></i>
                                </a>
                                <?php if($item["deadline"] !== null){
                                    $date_difference = task_time($item["deadline"]);
                                    if($date_difference > 24){
                                        ?>
                                        <small class="badge badge-success"><i class="far fa-clock"></i> <?php echo htmlspecialchars(task_time_output($date_difference))?> </small>
                                        <?php
                                    }
                                    else{ ?>
                                        <small class="badge badge-danger"><i class="far fa-clock"></i> <?php echo htmlspecialchars(task_time_output($date_difference))?> </small>
                                    <?php }
                                } ?>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</section>