<?php
include  ("app/controllers/commentaries.php");
?>
<div class="col md-12 col-12 comments">
    <h2>Оставить комментарий</h2>
    <div class="md-12 col-12 col-md-12 err">
        <?php include "../../app/helps/errInfo.php";?>
    </div>
    <form action="<?php echo BASE_URL . "single.php?post=$page"?>" method="post">
        <input type="hidden" name="page" value="<?=$page?>">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email</label>
            <input name="email" type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Добавить комментарий</label>
            <textarea name="comment" class="form-control" id="exampleFormControlTextarea1" rows="4"></textarea>
        </div>
        <div class="col-12">
            <button type="submit" name="getComment" class="btn btn-primary">Отправить</button>
        </div>
    </form>
    <?php if(count($comments)>0):?>
        <div class="row all-comments">
            <h3 class="col-12">Комментарии к записи: </h3>
            <?php foreach ($comments as $comment):?>
            <div class="one-comment col-12">
                <span><i class="fas fa-envelope"></i><?=$comment['email']?></span>
                <span><i class="far fa-calendar"></i><?=$comment['created_date']?></span>
                <div class="col-12 text"><?=$comment['comment']?></div>
            </div>
            <?php endforeach;?>
    </div>
    <?php endif;?>
</div>
