<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/inform.php'; ?>
    <h1><?php echo $data['title']; ?></h1>
    <p>This was a game created for Ludum Dare 44</p>
    <br>
    <h3>Technology Used</h3>
    <p><b>Game Version:</b> v<?php echo $data['version']; ?></p>
    <p><b>Nginx Version:</b> 1.16.0</p>
    <p><b>PHP Version:</b> 7.3.4, x64, Thread Safety disabled</p>
    <p><b>ODBC Driver Version:</b> 17.3.1.1, x64</p>
    <p><b>MSSQL Version:</b> 2017</p>
<?php require APPROOT . '/views/inc/footer.php'; ?>