<nav aria-label="Page navigation example">
    <ul class="pagination float-end">
        <?php
                              if(!$paginator->isFirst()): 
                            ?>
        <li class="page-item"><a class="page-link"
                href="<?=BASE_URL.$path.'?page='.$paginator->getPage()-1?>">Precedent</a>
        </li>
        <?php
                               endif
                              ?>
        <?php 
                                for ($i=1; $i <=$paginator->getPageCount() ; $i++): 
                             ?>
        <li class="page-item  <?=$paginator->getPage()==$i?'active':'' ?>"><a class="page-link"
                href="<?=BASE_URL.$path.'?page='.$i?>">
                <?=$i?></a>
        </li>
        <?php endfor ?>
        <?php
                              if(!$paginator->isLast()): 
                            ?>
        <li class=" page-item"><a class="page-link"
                href="<?=BASE_URL.$path.'?page='.$paginator->getPage()+1?>">Suivant</a>
        </li>
        <?php
                               endif
                              ?>
    </ul>
</nav>