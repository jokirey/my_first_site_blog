<?php
include("path.php");
include ("app/controllers/topics.php");
//$posts=selectAll('posts',['status'=>1]);

$page = isset($_GET['page']) ? $_GET['page']:1;//пагинация

$limit = 5;
$offset = $limit * ($page-1);
$total_pages = round(countRow('posts')/$limit, 0);

$posts=selectAllFromPostsWithUsersOnIndex_limit('posts','users',$limit, $offset);
$toptopic=selectTopTopicsFromPost('posts');
//tt($total_pages);
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
<!--шапка сайта-->
<?php include("app/include/header.php"); ?>
<!--карусель-->
<div class = "container">
    <h2 class = "slider-title">Топ статей</h2>
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <?php foreach ($toptopic as $post):?>
        <div class="carousel-item active">
            <img src="<?=BASE_URL.'/assets/image/posts/'.$post['img']?>" alt="<?=$post['title']?>" class="d-block w-100">
            <div class="carousel-caption-hack carousel-caption d-none d-md-block">
                <h5><a href="<?=BASE_URL.'single.php?post='.$post['id'];?>"><?=mb_substr($post['title'], 0, 50,'UTF-8') .'...'  ?></a></h5>
                <p><?=mb_substr($post['content'], 0, 61, 'UTF-8') .'...' ?></p>
            </div>
        </div>
        <?php endforeach;?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
</div>
<!--main-->
<div class="container">
    <!--основные статьи-->
<div class="container row">
    <!--основные статьи-->
    <div class="main-containtent col-md-8 col-12">
        <h2>Последние публикации</h2>
        <?php foreach ($posts as $post):?>
        <div class="post row">
            <div class="img col-10 col-md-3">
                <img src="<?=BASE_URL.'/assets/image/posts/'.$post['img']?>" alt="<?=$post['title']?>" class="img-thumbnail">
            </div>
            <div class="post_text col-12 col-md-9">
                <h3>
                    <a href="<?=BASE_URL.'single.php?post='.$post['id'];?>"><?=mb_substr($post['title'], 0, 50,'UTF-8') .'...'  ?></a>
                </h3>
                <i class="far fa-user"> <?=$post['username']?></i>
                <i class="far fa-calendar"> <?=$post['created_date']?></i>
                <p class="preview-text"><?=mb_substr($post['content'], 0, 65, 'UTF-8') .'...' ?></p>

            </div>
        </div>
        <?php endforeach;?>
<!--        подключение комментариев-->
        <?php include("app/include/pagination.php"); ?>
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
<!--нижняя панель-->
    <?php include("app/include/footer.php"); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>