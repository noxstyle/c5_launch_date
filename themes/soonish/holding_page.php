<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<?php $this->inc('elements/header.php'); ?>

<div id="main">

    <div class="container_12">

        <div id="cd_logo" class="main logo">
            <?php    
                $a = new Area('CD Logo');
                $a->display($c); 
            ?>
        </div>

        <div id="cd_header" class="main">
            <?php    
                $a = new Area('CD Header');
                $a->display($c); 
            ?>
        </div>

        <hr>

        <div id="cd_timer" class="main">
            <div id="cd_timer_inner">
                <?php $a = new Area('CD Timer'); $a->display($c); ?>
            </div>

            <?php $a = new Area('CD Timer Description'); $a->display($c); ?>
        </div>

        <hr>

        <div id="cd_mainplus" class="main">
            <?php    
                $a = new Area('CD MainPlus');
                $a->display($c); 
            ?>
        </div>

    </div><!-- /container_12 -->


    <div id="cd_social" class="main">
        <?php    
            $a = new Area('CD Social');
            $a->display($c); 
        ?>
    </div>

</div> <!-- /main -->

<?php $this->inc('elements/footer.php'); ?>