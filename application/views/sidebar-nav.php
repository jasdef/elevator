	<div class="sidebar-nav">
        <?php
            foreach($this->aUsermenulist as $v){
                echo '<a href="#'.$v['controller'].'-menu" class="nav-header" data-toggle="collapse"><i class="'.$v['icon'].'"></i>'.$v['title'].'</i></a>';
                if(!empty($v['subtype'])){
                    echo '<ul id="'.$v['controller'].'-menu" class="nav nav-list collapse in">';
                    foreach($v['subtype'] as $vSub){
                        echo '<li ><a href="'.base_url("/{$vSub['controller']}/{$vSub['actioner']}").'"><i class="'.$vSub['icon'].'"></i>'.$vSub['title'].'</a></li>';
                    }
                    echo '</ul>';
                }
            }
        ?>
    </div>