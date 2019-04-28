
<?php if (count($data['nearplayers']) > 0): ?>
    <br>
    <form action="<?php echo URLROOT; ?>PlayerActions/attack" method="post" autocomplete="off">
        <input type="hidden" name="_token" value="<?php echo Session::get('_token'); ?>">
        <div class="container">
            <div class="row">
                <div class="col-sm">      
                    <input type="submit" value="Attack" class="btn btn-block">
                </div>
                <div class="col-sm">
                    <select class="browser-default custom-select" name="target"> 
                        <?php
                        foreach ($data['nearplayers'] as $value) {
                            echo '<option value="' . $value->ID . '">';
                            echo Secure::HTML($value->Username);
                            echo '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>    
    </form>
<?php endif; ?>
<br>
<form action="<?php echo URLROOT; ?>PlayerActions/cut" method="post" autocomplete="off">
    <input type="hidden" name="_token" value="<?php echo Session::get('_token'); ?>">
    <input type="submit" value="Cut Vegitation" class="btn btn-block">
</form>
<br>
<form action="<?php echo URLROOT; ?>PlayerActions/graffiti" method="post" autocomplete="off">
    <input type="hidden" name="_token" value="<?php echo Session::get('_token'); ?>">
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <input type="submit" value="Spray Graffiti" class="btn btn-block">
            </div>
            <div class="col-sm">
                <input type="text" name="graffiti" class="form-control">
            </div>
        </div>
    </div>
</form>