<?php
include_once("./helper.php");

//redirect(get_url('demo.php'));
//insert
db_connect();
if (is_submit("Add")) {
    $task = input_value("txtTask");
    if (!empty($task)) {
        $sql = "insert into todos(task) values(:task)";
        $params = [
            'task' => $task
        ];
        if (db_execute($sql, $params)) {
            echo "<script>alert('Insert successfully !')</script>";
        }
    }
}

//select
$sql = "select * from Todos";
$todos = db_get_list($sql);
db_disconnect();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body>
    <section class="vh-100" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-lg-9 col-xl-7">
                    <div class="card rounded-3">
                        <div class="card-body p-4">

                            <h4 class="text-center my-3 pb-3">To Do App</h4>

                            <form class="row row-cols-lg-auto g-3 justify-content-center align-items-center mb-3 pb-2">
                                <div class="col-12">
                                    <div class="form-outline">
                                        <label class="form-label" for="form1">Search a task here</label>
                                        <input type="text" id="form1" class="form-control" />
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>

                                <div class="col-12">
                                    <a type="submit" href="/create.php" class="btn btn-warning">Create new </a>
                                </div>
                            </form>

                            <table class="table mb-4">
                                <thead>
                                    <tr>
                                        <th scope="col">Todo item</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($todos)) :
                                        foreach ($todos as $todo) :
                                    ?>
                                            <tr>
                                                <td><?php echo $todo['todoid']; ?></td>
                                                <td><?php echo $todo['task']; ?></td>
                                                <td>
                                                    <a class="btn btn-danger" href='/delete.php?todoid=<?php echo $todo['todoid']; ?>'>Delete</a>
                                                    <button type="submit" class="btn btn-success ms-1">Edit</button>
                                                </td>
                                            </tr>
                                    <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>