<?php foreach (Session::get('InformError') as $error) : ?>
    <div class="alert alert-dismissible alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <p class="mb-0"><b>Error: </b><?php echo $error; ?></p>
    </div>
<?php endforeach; echo Session::set('InformError', [] ); ?>


<?php foreach (Session::get('InformWarning') as $warning) : ?>
    <div class="alert alert-dismissible alert-warning">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <p class="mb-0"><b>Warning: </b><?php echo $warning; ?></p>
    </div>
<?php endforeach; Session::set('InformWarning', [] ); ?>

    
<?php foreach (Session::get('InformInfo') as $info) : ?>
    <div class="alert alert-dismissible alert-info">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <p class="mb-0"><b>Info: </b><?php echo $info; ?></p>
    </div>
<?php endforeach; Session::set('InformInfo', [] ); ?>    
