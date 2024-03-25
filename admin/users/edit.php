<?php
include "../../path.php";
include "../../app/controllers/users.php";
?>

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
            <div class="button row">
                <a href="<?php echo BASE_URL."admin/users/create.php";?>" class="col-2 btn btn-secondary">Создать</a>
                <span class="col-1"></span>
                <a href="<?php echo BASE_URL."admin/users/index.php";?>" class="col-2 btn btn-secondary">Управлять</a>
            </div>
            <div class="row title-table">
                <h2>Создать пользователя</h2>
            </div>
            <div class="md-12 col-12 col-md-12 err">
                <?php include "../../app/helps/errInfo.php";?>
            </div>
            <div class="row add-post">
                <form action="edit.php" method="post">
                    <input name="id" value="<?=$id;?>" type="hidden" >
                    <div class="col">
                        <label for="formGroupExampleInput" class="form-label">Логин</label>
                        <input name="login" value="<?=$user['username'];?>" type="text" class="form-control" id="formGroupExampleInput" placeholder="Ведите логин...">
                    </div>
                    <div class="col">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input name="email" value ="<?=$user['email'];?>" readonly type="email" class="form-control" id="exampleInputEmail1" placeholder="Ведите email..." aria-describedby="emailHelp">
                    </div>
                    <div class="col">
                        <label for="exampleInputPassword1" class="form-label">Сбросить пароль</label>
                        <input name ="pass-first" type="password" class="form-control" id="exampleInputPassword1" placeholder="Ведите пароль...">
                    </div>
                    <div class="col">
                        <label for="exampleInputPassword2" class="form-label">Повторите пороль</label>
                        <input name="pass-second" type="password" class="form-control" id="exampleInputPassword2" placeholder="Ведите ваш пароль повторно...">
                    </div>
                    <input name="admin"  class="form-check-input" type="checkbox" id="flexCheckChecked" >
                    <label class="form-check-label" for="flexCheckChecked">
                        Администратор сайта
                    </label>
                    <div class="col-12">
                        <button name="update-users" class="btn btn-primary" type="submit">Обновить</button>
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
