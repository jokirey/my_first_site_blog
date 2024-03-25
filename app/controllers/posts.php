<?php
include("../../app/database/db.php");
if(!$_SESSION){header('location'.BASE_URL.'log.php');};
$Msg = [];
$topic='';
$title = '';
$content= '';
$img='';
$id='';

$topics = selectAll('topics');
$posts = selectAll('posts');
$postsAdm = selectAllFromPostsWithUsers('posts', 'users');


//код для регистрации
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_post']))
{
//tt($_FILES);
    if(!empty($_FILES['img']['name'])) {
        $imgName = time()."_".$_FILES['img']['name'];
        $fileTmgName = $_FILES['img']['tmp_name'];//временная
        $fileType = $_FILES['img']['type'];
        $fileSize = $_FILES['img']['size'];
        $destination = "/Applications/AMPPS/www/my-site/assets/image/posts/" . $imgName;//сохранение
        $MaxSize =2097152;

        if(strpos($fileType,'image')===false) {
            array_push($Msg, "Можно загружать только изображения.");
        }elseif($fileSize>$MaxSize){
            array_push($Msg, "Размер файла слишком большой.");

        }else{
            $result = move_uploaded_file($fileTmgName, $destination);
            if ($result) {$_POST['img'] = $imgName;
            } else {
                array_push($Msg, "Ошибка загрузки изображения на сервер");}
        }
    }else{
        array_push($Msg,"Ошибка получения картинки");}

    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $topic = trim($_POST['topic']);
    $img = trim($_POST['img']);

    $publish=isset($_POST['publish']) ? 1 : 0;

    if ($title === '' || $content === ''|| $topic==='') {
        array_push($Msg, "Не все поля заполнены!");
    }
    elseif (mb_strlen($title, 'utf8') < 7) {
        array_push($Msg,"Название статьи должено быть более 7 символов!");
    }
    else {
            $post = [
                'id_user'=> $_SESSION['id'],
                'title' => $title,
                'img' => $img,
                'content' => $content,
                'status'=>$publish,
                'id_topic'=> $topic
            ];
            $id = insert('posts', $post);
            $post = selectOne('posts', ['id' => $id]);
        header('location: ' . BASE_URL . "admin/posts/index.php");
    }
}else{
    $id='';
    $title='';
    $content='';
    $publish='';
    $topic='';
}
//
//Редакттировать записи
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $post = selectOne('posts', ['id' => $_GET['id']]);

    $id = $post['id'];
    $title = $post['title'];
    $content = $post['content'];
    $topic = $post['id_topic'];
    $publish = $post['status'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_post'])) {

    $id = $_POST['id'];
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $id_topic = trim($_POST['topic']);
    $publish=isset($_POST['publish']) ? 1 : 0;

    if(!empty($_FILES['img']['name'])) {
        $imgName = time()."_".$_FILES['img']['name'];
        $fileTmgName = $_FILES['img']['tmp_name'];//временная
        $fileType = $_FILES['img']['type'];
        $fileSize = $_FILES['img']['size'];
        $destination = "/Applications/AMPPS/www/my-site/assets/image/posts\\".$imgName;//сохранение

        if(strpos($fileType,'image')===false) {
            array_push($Msg, "Можно загружать только изображения.");
        }elseif($fileSize>$MaxSize){
            array_push($Msg, "Размер файла слишком большой.");

        }else{
            $result = move_uploaded_file($fileTmgName, $destination);
            if ($result) {
                $_POST['img'] = $imgName;
            } else {
                array_push($Msg, "Ошибка загрузки изображения на сервер");}
        }
    }else{
        array_push($Msg,"Ошибка получения картинки");}


    if ($title === '' || $content === ''|| $id_topic==='') {
        array_push($Msg, "Не все поля заполнены!");
    }
    elseif (mb_strlen($title, 'utf8') < 7) {
        array_push($Msg,"Название статьи должено быть более 7 символов!");
    }
    else {
        $post = [
            'id_user'=> $_SESSION['id'],
            'title' => $title,
            'content' => $content,
            'img'=>$_POST['img'],
            'status'=>$publish,
            'id_topic'=> $id_topic
        ];
        $id = update('posts', $id, $post);
        header('location:' . BASE_URL . 'admin/posts/index.php');
    }
}else{
    $title='';
    $content='';
    $publish=isset($_POST['publish'])? 1 : 0 ;
    $id_topic = '';
}
//опубликоватить пост
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['pub_id'])) {
    $id = $_GET['pub_id'];
    $publish=$_GET['publish'];
    $post_id = update('posts', $id, ['status' => $publish]);
    header('location:' . BASE_URL . 'admin/posts/index.php');
    die();
}


if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_id'])) {
    $id = $_GET['del_id'];
    delete('posts', $id);
    header('location:' . BASE_URL . 'admin/posts/index.php');
}



