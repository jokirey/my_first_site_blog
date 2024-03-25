<?php session_start();
include "../../path.php";
include "../../app/controllers/topics.php";?>
<!doctype html>
<html lang="en">
<head>
    <!--основные параментры вывод символов-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--отображение-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!--дизай: иконки/ шрифт + сss-->
    <script src="https://kit.fontawesome.com/20ef3e1dd3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../assets/css/admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Pro IT Admin</title>

</head>
<body>
<!--шапка сайта-->
<?php include("../../app/include/header-admin.php"); ?>
<!--back-->
<div class="container">
    <div class="row">
        <?php include "../../app/include/sidebar-admin.php"?>
        <div class="posts col-9">
            <div class="row title-table">
                <h2>Создать категорию</h2>
            </div>
            <div class="mb-3 col-12 err">
                <?php include "../../app/helps/errInfo.php";?>
            </div>
                <div class="row add-post">
                    <form action="create.php" method="post">
                        <div class="col">
                            <input name="name" value="<?=$name?>" type="text" class="form-control" placeholder="Название категории" aria-label="Название категории">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Описание категории</label>
                            <textarea name="description" class="form-control" id="content" rows="3"><?=$description?></textarea>
                        </div>
                        <div class="col-12">
                            <button name="topic-create" class="btn btn-primary" type="submit">Создать категорию</button>
                        </div>
                    </form>
                </div>
        </div>
    </div>

</div>
<!--нижняя панель-->
<?php include("../../app/include/footer-admin.php"); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
<script src="../../assets/js/scripts.js"></script>
</body>
</html>
