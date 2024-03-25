<?php
include ("../../app/database/db.php");
// контролер
$commentsForAdm  = selectAll('comments');
$page= $_GET['post'];
$email = '';
$comment = '';
$Msg = [];
$status = 0;
$comments = [];

//код для формы создания комментариев
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['getComment']))
{
    $email = trim($_POST['email']);
    $comment = trim($_POST['comment']);
    if ($email === '' || $comment === '') {
        array_push($Msg, "Не все поля заполнены!");
    }
    elseif (mb_strlen($comment, 'utf8') < 5) {
        array_push($Msg,"комментарий должен быть длиннее 5 символов!");
    }
    else {
        $user = selectOne('users', ['email'=> $email]);
        if($user['email']==$email && $user['admin']==1){
            $status = 1;
        }
        $comment = [
            'status'=> $status,
            'page' => $page,
            'email' => $email,
            'comment' => $comment
        ];

        $comment = insert('comments', $comment);
        $comments  = selectAll('comments', ['page' => $page, 'status'=>1]);
    }
}else{
    $email = '';
    $comment = '';
    $comments  = selectAll('comments', ['page' => $page, 'status'=>1]);

}
//удаление комментария
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_id'])) {
    $id = $_GET['del_id'];
    delete('comments', $id);
    header('location:' . BASE_URL . 'admin/comments/index.php');
}
//опубликовать
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['pub_id'])) {
    $id = $_GET['pub_id'];
    $publish=$_GET['publish'];
    $post_id = update('comments', $id, ['status' => $publish]);
    header('location:' . BASE_URL . 'admin/comments/index.php');
    die();
}
//редактировать
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $comment = selectOne('comments', ['id' => $_GET['id']]);
    $id = $comment['id'];
    $email = $comment['email'];
    $text1 = $comment['comment'];
    $pub = $comment['status'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_comment'])) {
    $id = $_POST['id'];
    $text = trim($_POST['comment']);
    $publish=isset($_POST['publish']) ? 1 : 0;
    if ($text === '') {
        array_push($Msg, "Комементарий пустой!");
    }
    elseif (mb_strlen($text, 'utf8') < 7) {
        array_push($Msg,"Комментарий должено быть более 7 символов!");
    }
    else {
        $com = [
            'comment' => $text,
            'status'=>$publish
        ];
        $comment = update('comments', $id, $com);
        header('location:' . BASE_URL . 'admin/comments/index.php');
    }
}else{
    $text=trim($_POST['comment']);
    $publish=isset($_POST['publish'])? 1 : 0 ;
}