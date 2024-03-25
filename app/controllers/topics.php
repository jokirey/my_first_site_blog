<?php
include SITE_ROOT."/app/database/db.php";
$Msg =[];
$topic = selectAll('topics');
$id ='';
$name='';
$description='';

//код для регистрации
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['topic-create'])){
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);



    if($name ===''||$description ===''){
        array_push($Msg, "Не все поля заполнены!");
    } elseif (mb_strlen($name, 'utf8') <2){
        array_push($Msg, "Категория должена быть более 2 символов!");
    } else {
        $existence = selectOne('topics', ['name' => $name]);
        if ($existence['name'] === $name) {
        array_push($Msg, "Категория уже есть в базе!");
        } else {
            $topic = [
                'name' => $name,
                'description' => $description,
            ];

            $id = insert('topics', $topic);
            $topic = selectOne('topics',['id'=>$id]);
            header('location:'. BASE_URL.'admin/topics/index.php');
        }
    }
}
else{
    $name = '';
    $description = '';}

//Редакттировать категорию
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])){
$id= $_GET['id'];
$topic = selectOne('topics', ['id'=>$id]);
$id = $topic['id'];
$name = $topic['name'];
$description=$topic['description'];
}


if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['topic-edit'])){
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);


    if($name ===''||$description ===''){
        array_push($Msg, "Не все поля заполнены!");
    } elseif (mb_strlen($name, 'utf8') <2){
        array_push($Msg, "Категория должена быть более 2 символов!");
    } else {
        $topic = [
                'name' => $name,
                'description' => $description];
        $id = $_POST['id'];
        $topic_id = update('topics', $id, $topic);
        header('location:'. BASE_URL.'admin/topics/index.php');
    }
}
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_id'])){
    $id= $_GET['del_id'];
    delete('topics',$id);
    header('location:'. BASE_URL.'admin/topics/index.php');
}



