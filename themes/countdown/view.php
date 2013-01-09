<?php    
defined('C5_EXECUTE') or die(_("Access Denied."));
$this->inc('elements/header.php'); // get header file
?>

    <div class="main">
        <?php   print $innerContent; ?>
    </div>
    
<?php   $this->inc('elements/footer.php'); // get footer.php ?>