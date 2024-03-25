<?php
session_start();


require 'connect.php';
//вывод запроса
function tt($value){
    echo '<pre>';
    print_r($value);
    echo '</pre>';
    exit();
}
//проверка на ошибку
function dbCheckError($query)
{   $errInfo = $query->errorInfo();
    if($errInfo[0] !== PDO::ERR_NONE){
        echo $errInfo[2];
        exit();}
    return true;}

//которая задает запрос на выдачу таблицы из данных из базы!
function selectAll($table, $params = []){
    global $pdo;
    $sql ="SELECT * FROM $table ";
    if(!empty($params)){

        $i=0;
        foreach ($params as $key => $value){
            if (!is_numeric($value)){$value = "'" .$value ."'";}
            if ($i===0){
                $sql = $sql . " WHERE $key = $value";
            } else{
                $sql = $sql . " AND $key = $value";
            }
            $i++;
        }
     }
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}

////фукция выдачи 1 записи с таблицы из бд
function selectOne($table, $params = []){
    global $pdo;
    $sql ="SELECT * FROM $table";
    if(!empty($params)){
        $i=0;
        foreach ($params as $key => $value){
            if (!is_numeric($value)){$value = "'" .$value ."'";}
            if ($i===0){
                $sql = $sql . " WHERE $key = $value";
            } else{
                $sql = $sql . " AND $key = $value";
            }
            $i++;
        }
    }
    $sql = $sql . " LIMIT 1";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetch();
}
//$params = [
//    'admin'=> 1,
//    'email' => 'ad@mail.ru'
//];

//запись в таблицу БД
function insert($table, $param)
{global $pdo;
    //INSERT INTO `users` (`id`, `admin`, `username`, `email`, `password`, `created`) VALUES (NULL, '0', 'horni', 'jj@hotmail.ru', '4545', NOW());
  $i=0;
  $col='';
  $mask = '';
  foreach ($param as $key=>$value){
      if($i===0){
          $col=$col."$key";
          $mask=$mask."'"."$value"."'";
      }
      else{$col=$col.", $key";;
      $mask=$mask . ", '" . "$value" . "'";}
      $i++;
  }
    $sql = "INSERT INTO $table($col) VALUES ($mask)";
    $query = $pdo->prepare($sql);
    $query->execute($param);
    dbCheckError($query);
    return $pdo->lastInsertId();
}

//$arrData=[
//    'admin'=>'0',
//    'username'=>'robert',
//    'email'=>'roo9d@rt.ru',
//    'password'=>'erer00e',
//    'created' =>'2024-02-05 10:39:44'
//];


//обновление в таблицу БД
function update($table, $id, $param)
{global $pdo;
    //INSERT INTO `users` (`id`, `admin`, `username`, `email`, `password`, `created`) VALUES (NULL, '0', 'horni', 'jj@hotmail.ru', '4545', NOW());
    $i=0;
    $str='';
    foreach ($param as $key=>$value){
        if($i===0){
            $str=$str. $key." = '"."$value"."'";
        }
        else{
            $str=$str.", ".$key. " = '" . "$value" . "'";}
        $i++;
    }
//UPDATE `users` SET `admin` = '1', `created` = NOW() WHERE `users`.`id` = 2;
    $sql = "UPDATE $table SET $str WHERE id = $id";
    $query = $pdo->prepare($sql);
    $query->execute($param);
    dbCheckError($query);
}

//удаление строки из таблицы БД
function delete($table, $id)
{global $pdo;
//DELETE FROM `users` WHERE id = 7;
    $sql = "DELETE FROM $table WHERE id = $id";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
}

//выборка записей пользователя для поста
function selectAllFromPostsWithUsers($table1, $table2)
{   global $pdo;
    $sql = "SELECT 
    t1.id,
    t1.title,
    t1.img,
    t1.content,
    t1.status,
    t1.id_topic,
    t1.created_date,
    t2.username 
    FROM $table1 AS t1 JOIN $table2 AS t2 ON t1.id_user = t2.id";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}


//выборка записей пользователя index
function selectAllFromPostsWithUsersOnIndex($table1, $table2)
{   global $pdo;
    $sql = "SELECT p.* , u.username FROM $table1 AS p JOIN $table2 AS u ON p.id_user = u.id WHERE p.status= 1 ORDER BY p.created_date DESC";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();}

//выборка записей пользователя index
function selectTopTopicsFromPost($table1)
{   global $pdo;
    $sql = "SELECT * FROM $table1 WHERE id_topic=12 ";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();}

//поиск по заголовкам и содержимому(простой)
function searchInTitleAndContent($term, $table1, $table2)
{   $term=trim(strip_tags(stripcslashes(htmlspecialchars($term))));
    global $pdo;
    $sql = "SELECT p.* , u.username 
    FROM $table1 AS p 
    JOIN $table2 AS u 
    ON p.id_user = u.id 
    WHERE p.status= 1
    AND p.title LIKE '%$term%' OR p.content LIKE '%$term%' 
    ORDER BY p.created_date DESC";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();}

//выборка записи пользователя для Single
function selectPostFromPostsWithUsersOnSingle($table1, $table2, $id)
{   global $pdo;
    $sql = "SELECT p.* , u.username FROM $table1 AS p JOIN $table2 AS u ON p.id_user = u.id WHERE p.id=$id ORDER BY p.created_date DESC";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetch();}


function countRow($table)
{   global $pdo;
    $sql = "SELECT COUNT(*) FROM $table WHERE status=1";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchColumn();}

function selectAllFromPostsWithUsersOnIndex_limit($table1, $table2, $limit, $offset)
{   global $pdo;
    $sql = "SELECT p.* , u.username FROM $table1 AS p JOIN $table2 AS u ON p.id_user = u.id WHERE p.status= 1 ORDER BY p.created_date DESC
    LIMIT $limit OFFSET $offset";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();}
function selectAll_page($table, $params = [], $limit, $offset){
    global $pdo;
    $sql ="SELECT * FROM $table";
    if(!empty($params)){

        $i=0;
        foreach ($params as $key => $value){
            if (!is_numeric($value)){$value = "'" .$value ."'";}
            if ($i===0){
                $sql = $sql . " WHERE $key = $value";
            } else{
                $sql = $sql . " AND $key = $value";
            }
            $i++;
        }
        $sql = $sql. " LIMIT $limit OFFSET $offset ";
    }
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}
