<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/inform.php'; ?>
<div class="page">
    <h1><?php echo $data['title']; ?></h1>
    <?php foreach ($data['SQL'] as $record) : ?>
        <?php echo $record->asd; ?>
        <br>
    <?php endforeach; ?>
    <br><br>
    <a href="<?php echo URLROOT . 'Debug/' ?>">Return to debug page</a>    
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
