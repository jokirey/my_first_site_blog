<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <?php if($total_pages>2):?>
        <li class="page-item"><a class="page-link" href="?page=1">1</a></li>
        <?php if($total_pages>=5):?>
        <?php for($page = 3 ;$page<$total_pages;$page++):?>
                <li class="page-item"><a class="page-link" href="?page=<?php echo ($page-1)?>"><?php echo ($page - 1)?></a></li>
                <li class="page-item"><a class="page-link" href="?page=<?php echo ($page)?>"><?php echo ($page)?></a></li>
                <li class="page-item"><a class="page-link" href="?page=<?php echo ($total_pages - 1)?>"><?php echo ($page + 1)?></a></li>
        <?php endfor;?>
        <?php else:?>
        <li class="page-item"><a class="page-link" href="?page=<?php echo ($total_pages - 1)?>"><?php echo ($total_pages - 1)?></a></li>
        <?php endif;?>
        <li class="page-item"><a class="page-link" href="?page=<?php echo $total_pages?>"><?php echo $total_pages?></a></li>
        <?php else:?>
        <?php if($total_pages==2):?>
            <li class="page-item"><a class="page-link" href="?page=1">1</a></li>
            <li class="page-item"><a class="page-link" href="?page=<?php echo $total_pages?>"><?php echo $total_pages?></a></li>
        <?php endif?>
        <?php endif?>
    </ul>
</nav>