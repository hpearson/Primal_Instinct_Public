<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/inform.php'; ?>


<div class="jumbotron">
    <h1 class="display-4"><b>Error Detected</b></h1>
    <hr class="my-4">
    <p>There was an error or a security violation detected that was not recoverable.</p>

    <p>
        <a class="btn btn-danger btn-lg float-left" href="<?php echo URLROOT ?>Errors/Report">Report Error</a>
        <a class="btn btn-primary btn-lg float-right" href="<?php echo URLROOT ?>" role="button">Home Page</a>
    </p>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
