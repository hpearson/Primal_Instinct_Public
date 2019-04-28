<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="page">
    <h1><?php echo $data['title']; ?></h1>
    <ul>
        <li><a href="<?php echo URLROOT . 'Debug/DatabaseTester/' ?>">DatabaseTester</a></li>
    </ul>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>