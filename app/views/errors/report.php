<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light mt-5">
            <h2>Report Error</h2>
            <p>Please enter your actions to cause the error</p>
            <form action="<?php echo URLROOT; ?>errors/report" method="post" autocomplete="off">
                <input type="hidden" name="_token" value="<?php echo Session::get('_token'); ?>">
                <div class="form-group">
                    <label for="error"><sup>*</sup>Error: </label>
                    <textarea name="error" class="form-control form-control-lg <?php echo (!empty($data['error_err'])) ? 'is-invalid' : ''; ?>" rows="2"><?php echo $data['error']; ?></textarea>
                    <span class="invalid-feedback"><?php echo $data['error_err']; ?></span>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="submit" value="Submit" class="btn btn-success btn-block">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>