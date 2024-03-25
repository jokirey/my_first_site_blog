<?php
include SITE_ROOT."/app/database/db.php";


//$isSabmit = false;
$Msg =[];
function UserAuth($user_ses = []){
    $_SESSION['id'] = $user_ses['id'];
    $_SESSION['login'] = $user_ses['username'];
    $_SESSION['admin'] = $user_ses['admin'];
    if ($_SESSION['admin']) {
        header('location: ' . BASE_URL . "admin/posts/index.php");
    } else {
        header('location: ' . BASE_URL);
    }
}
$users = selectAll('users');

//код для регистрации
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-reg'])){
    $admin = 0;
    $login = trim($_POST['login']);
    $email = trim($_POST['email']);
    $passF = trim($_POST['pass-first']);
    $passS = trim($_POST['pass-second']);



    if($login ===''||$email ===''||$passF ===''){
        $Msg = "Не все поля заполнены!";
    } elseif (mb_strlen($login, 'utf8')<2){
        $Msg = "Логин должен быть более 2 символов!";
    } elseif ($passF !== $passS){
        $Msg = "Пароли в обоих полях должны соответствовать!";
    } else {
        $existence = selectOne('users', ['email' => $email]);
        if ($existence['email'] === $email) {
            $Msg = "Пользователь с такой почтой уже зарегистрирован!";
        } else {
            $pass = password_hash($passF, PASSWORD_DEFAULT);
            $post = [
                'admin' => $admin,
                'username' => $login,
                'email' => $email,
                'password' => $pass
            ];

            $id = insert('users', $post);
//            $Msg = "Пользователь "."<strong>". $login ."</strong>"." успешно регистрован!";
              $user = selectOne('users',['id'=>$id]);
              UserAuth($user);
        }
        //    $last_row = selectOne('users', ['id'=>$id]);
//        $isSabmit = true;
//        tt($post);
    }
}
else{
    $login = '';
    $email = '';}

//код для авторезации
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-log'])) {
    $email = trim($_POST['email']);
    $pass = trim($_POST['password']);
    if ($email === '' || $pass === '') {
        array_push($Msg,"Не все поля заполнены!");
    } else {
        $existence = selectOne("users", ['email' => $email]);
        if ($existence && password_verify($pass, $existence['password'])) {
            UserAuth($existence);}
        else {
            $err = 0;
            do{
                array_push($Msg, "Почта или пароль указан неверно");
            $err++;}while($err<3);
            if($err>3){
                array_push($Msg,"Ваша учетная запись заблокированна попробуйте через несколько минут");}
        }
    }
}else{
        $email='';
    }

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create-users'])){

    $admin = 0;
    $login = trim($_POST['login']);
    $email = trim($_POST['email']);
    $passF = trim($_POST['pass-first']);
    $passS = trim($_POST['pass-second']);



    if($login ===''||$email ===''||$passF ===''){
        array_push($Msg, "Не все поля заполнены!");
    } elseif (mb_strlen($login, 'utf8')<2){
        array_push($Msg,"Логин должен быть более 2 символов!");
    } elseif ($passF !== $passS){
        array_push($Msg,"Пароли в обоих полях должны соответствовать!");
    } else {
        $existence = selectOne('users', ['email' => $email]);
        if ($existence['email'] === $email) {
            array_push($Msg,"Пользователь с такой почтой уже зарегистрирован!");
        } else {
            $pass = password_hash($passF, PASSWORD_DEFAULT);
            if(isset($_POST['admin'])){$admin=1;}
            $user = [
                'admin' => $admin,
                'username' => $login,
                'email' => $email,
                'password' => $pass
            ];

            $id = insert('users', $user);
//            $Msg = "Пользователь "."<strong>". $login ."</strong>"." успешно регистрован!";
            $user = selectOne('users',['id'=>$id]);
            UserAuth($user);
        }

    }
}
else{
    $login = '';
    $email = '';}

//код удаления через адм
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_id'])) {
    $id = $_GET['del_id'];
    delete('users', $id);
    header('location:' . BASE_URL . 'admin/users/index.php');
}
//код редакциии через адм
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['edit_id'])) {
    $user = selectOne('users', ['id' => $_GET['edit_id']]);

    $id = $user['id'];
    $admin= $user['admin'];
    $username = $user['username'];
    $email = $user['email'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update-users'])) {
    $id = trim($_POST['id']);
    $username = trim($_POST['login']);
    $email = trim($_POST['email']);
    $passF = trim($_POST['pass-first']);
    $passS = trim($_POST['pass-second']);
    $admin = trim($_POST['admin']) ? 1 : 0;

    if ($username === '') {
        array_push($Msg, "Не все поля заполнены!");
    }
    elseif (mb_strlen($username, 'utf8') < 2) {
        array_push($Msg,"Логин должен быть более 2 символов!");
    }elseif ($passF!==$passS){
        array_push($Msg, "Пароли в обоих полях должны совпадать!");
    }
    else {
        $pass = password_hash($passF, PASSWORD_DEFAULT);
        if(isset($_POST['admin'])) $admin=1;
        $user = [
            'admin'=> $admin,
            'username' => $username,
//            'email'=>$email,
            'password' => $pass];
        $user = update('users', $id, $user);
        header('location:' . BASE_URL . 'admin/users/index.php');
    }
}else{
    $username = '';
    $email='';
}


