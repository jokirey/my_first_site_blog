<?php
    include("path.php");
//    include("app/database/db.php");
    include("app/controllers/users.php");
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
<!--header-->
<?php include("app/include/header.php"); ?>
<!--end header-->
<!--form-->
<div class="container reg_form">
<form class="row justify-content-center" method="post" action="reg.php">
  <h2>Форма регистрации</h2>
    <div class="mb-3 col-12 col-md-4 err">
        <p><?= $Msg ?></p>
    </div>
    <div class="w-100"></div>
  <div class="mb-3 col-12 col-md-4">
    <label for="formGroupExampleInput" class="form-label">Ваш логин</label>
    <input name="login" value="<?=$login?>" type="text" class="form-control" id="formGroupExampleInput" placeholder="Ведите логин...">
  </div>
  <div class="w-100"></div>
  <div class="mb-3 col-12 col-md-4">
    <label for="exampleInputEmail1" class="form-label">Email</label>
    <input name="email" value="<?=$email?>" type="email" class="form-control" id="exampleInputEmail1" placeholder="Ведите email..." aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">Ваш адрес не будет использован для спама!</div>
  </div>
  <div class="w-100"></div>
  <div class="mb-3 col-12 col-md-4">
    <label for="exampleInputPassword1" class="form-label">Пароль</label>
    <input name ="pass-first" type="password" class="form-control" id="exampleInputPassword1" placeholder="Ведите пароль...">
  </div>
  <div class="w-100"></div>
  <div class="mb-3 col-12 col-md-4">
    <label for="exampleInputPassword2" class="form-label">Повторите пороль</label>
    <input name="pass-second" type="password" class="form-control" id="exampleInputPassword2" placeholder="Ведите ваш пароль повторно...">
  </div>
  <div class="w-100"></div>
  <div class="mb-3 col-12 col-md-4">
    <button type="submit" class="btn btn-secondary" name="button-reg">Отправить</button>
    <a href="log.php">Авторизовараться</a>
  </div>
</form>
</div>
<!--end form-->
<!--fooder-->
<?php include("app/include/footer.php"); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>