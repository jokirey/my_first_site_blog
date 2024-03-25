<?php
include("path.php");
include ("app/controllers/topics.php");

//$post=selectOne('posts',['id'=>$_GET['post']]);
$post=selectPostFromPostsWithUsersOnSingle('posts','users', $_GET['post']);

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
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Pro IT</title>

</head>
<body>
<!--footer-->
<?php include("app/include/header.php"); ?>
<!--main-->
<div class="container">
    <div class="container row">
        <!--основные статьи-->
        <div class="main-containtent col-md-9 col-12">
            <h2><?php echo $post['title']?></h2>
            <div class="single_post row">
                <div class="img col-12">
                    <img src="<?=BASE_URL.'/assets/image/posts/'.$post['img']?>" alt="<?=$post['title']?>"class="img-thumbnail">
                </div>
                <div class="info">
                    <i class="far fa-user"><?php echo $post['username'];?></i>
                    <i class="far fa-calendar"><?php echo $post['created_date']; ?></i>
                </div>
                <div class="single_post_text col-12">
                    <?php echo $post['content']; ?>
                </div>
                <?php include ("app/include/commens.php")?>
            </div>
        </div>
            <!--боковая панель-->
        <div class="sidebar col-md-3 col-12">

            <div class="section search">
                <h3> Поиск </h3>
                <form action="search.php" method="post">
                    <input type="text" name="search-term" class ="text-input" placeholder="ищу статью...">
                </form>
            </div>
            <div class="section topics">
                <h3> Категории </h3>
                <ul>
                    <?php foreach ($topic as $key =>$topics): ?>
                        <li>
                            <a href="<?=BASE_URL.'category.php?id='.$topics['id'];?>"><?=$topics['name'];?></a>
                        </li>
                    <?php endforeach;?>
                </ul>
            </div>
        </div>

    </div>
</div>
<!--боковая панель-->
<?php include("app/include/footer.php"); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>