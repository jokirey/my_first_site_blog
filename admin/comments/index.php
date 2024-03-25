<?php
include "../../path.php";
include "../../app/controllers/commentaries.php"
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
                 <div class="row title-table">
                     <h2>Управление комментариями</h2>
                     <p><?=$_SESSION['error'];?></p>
                     <div class="col-1">ID</div>
                     <div class="col-3">Текст</div>
                     <div class="col-2">Автор</div>
                     <div class="red col-6">Управление</div>
                 </div>
            <?php foreach ($commentsForAdm as $key => $comment):?>
                 <div class="row post">
                     <div class="id col-1"><?=$comment['id']?></div>
                     <div class="title col-3"><?=mb_substr($comment['comment'], 0, 80, 'UTF-8') .'...' ?></div>
                     <?php
                     $user = $comment['email'];
                     $user = explode('@', $user);
                     $user= $user[0];
                     ?>
                     <div class="author col-2"><?=$user . '@'?></div>
                     <div class="red col-2"><a href="edit.php?id=<?=$comment['id']?>">Изменить</a></div>
                     <div class="def col-2"><a href="edit.php?del_id=<?=$comment['id']?>">Удалить</a></div>
                        <?php if ($comment['status']):?>
                            <div class="status col-2"><a href="edit.php?publish=0&pub_id=<?=$comment['id']?>">в черновик</a></div>
                     <?php else:?>
                            <div class="status col-2"><a href="edit.php?publish=1&pub_id=<?=$comment['id']?>">опубликовать</a></div>
                     <?php endif;?>
                 </div>
            <?php endforeach; ?>
    </div>
    </div>

</div>
<!--нижняя панель-->
    <?php include("../../app/include/footer-admin.php"); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>

