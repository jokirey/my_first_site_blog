<?php
include "../../path.php";
include "../../app/controllers/posts.php"

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
                <h2>Редакция записи</h2>
            </div>
            <div class="row add-post">
                <div class="md-12 col-12 col-md-12 err">
                    <?php include "../../app/helps/errInfo.php";?>
                </div>
                <form idaction="create.php" method="post">
                    <input type="hidden" name="id" value="<?=$id;?>">
                    <div class="col mb-4">
                        <input name="title" value="<?=$post['title']?>" type="text" class="form-control" placeholder="Название статьи" aria-label="Название статьи">
                    </div>
                    <div class="col">
                        <label for="exampleFormControlTextarea1" class="form-label">Содержание статьи</label>
                        <textarea name="content" id="editor" class="form-control" rows="6"><?=$post['content']?></textarea>
                    </div>
                    <div class="input-group col mb-4 mt-4">
                        <input name="img" value="<?=$post['img']?>" type="file" class="form-control" id="inputGroupFile02">
                        <label class="input-group-text" for="inputGroupFile02">Upload</label>
                    </div>
                    <select name="topic" class="form-select mb-2" aria-label="Выберите категорию" >
                        <?php foreach ($topics as $key => $topic): ?>
                            <option value="<?= $topic['id'] ?>"><?= $topic['name'] ?></option>
                        <?php endforeach;?>
                    </select>
                    <div class="form-check">
                        <?php if(empty($publish) && $publish == 0): ?>
                        <input name="publish"  class="form-check-input" type="checkbox"  id="flexCheckChecked">
                        <label class="form-check-label" for="flexCheckChecked">
                            Опубликовать
                        </label>
                        <?php else: ?>
                        <input name="publish"  class="form-check-input" type="checkbox"  id="flexCheckChecked" checked>
                        <label class="form-check-label" for="flexCheckChecked">
                            Опубликовать
                        </label>
                        <?php endif;?>
                    </div>
                    <div class="col col-6">
                        <button name="edit_post" class="btn btn-primary" type="submit">Сохранить запись</button>
                    </div>
                </form>
            </div>

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