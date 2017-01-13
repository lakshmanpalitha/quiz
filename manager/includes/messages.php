<?php
if(!empty($alert))
{
?>
<div class="alert bg-primary" role="alert">
    <svg class="glyph stroked empty-message"><use xlink:href="#stroked-empty-message"></use></svg> <?php echo $alert; ?> <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
</div>
 <?php } ?>

<?php
if(!empty($msg))
{
    ?>
<div class="alert bg-success" role="alert">
    <svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg><?php echo $msg; ?> <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
</div>
<?php } ?>

<?php
if(!empty($worning))
{
    ?>
<div class="alert bg-warning" role="alert">
    <svg class="glyph stroked flag"><use xlink:href="#stroked-flag"></use></svg><?php echo $worning; ?> <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
</div>
<?php } ?>

<?php
if(!empty($error))
{
    ?>
<div class="alert bg-danger" role="alert">
    <svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> <?php echo $error; ?> <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
</div>
<?php } ?>