    <div class="top_bar">
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-sm-5 col-xs-5 leftMenu">
                <ul>
                     <?php $rows=$getCredit->get_by_string('menus','type','top_left_menu'); 
                               foreach($rows as $row)
                               {
                                echo ' <li><a href="'.$row['link'].'">'.$row['title'].'</a></li>';
                               }
                            ?> 
                </ul>
            </div>
            <div class="col-md-7 col-sm-7 col-xs-7 rightMenu">
                <ul>
<?php $rows=$getCredit->get_by_string('menus','type','top_right_menu'); 
                               foreach($rows as $row)
                               {
                                echo ' <li class="hideMob"><a href="'.$row['link'].'">'.$row['title'].'</a></li>';
                               }
                            ?> 
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>