
<?php if (count($data['nearplayers']) > 0): ?>
    <hr>
    <form action="<?php echo URLROOT; ?>PlayerActions/attack" method="post" autocomplete="off">
        <input type="hidden" name="_token" value="<?php echo Session::get('_token'); ?>">
        <div class="container">
            <div class="row">
                <div class="col-sm">      
                    <input type="submit" value="Attack ⚔️" class="btn btn-block btn-primary">
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
<hr>
<form action="<?php echo URLROOT; ?>PlayerActions/cut" method="post" autocomplete="off">
    <input type="hidden" name="_token" value="<?php echo Session::get('_token'); ?>">
    <input type="submit" value="Cut 🔪 Vegetation 🌴" class="btn btn-block btn-secondary">
</form>
<hr>
<form action="<?php echo URLROOT; ?>PlayerActions/graffiti" method="post" autocomplete="off">
    <input type="hidden" name="_token" value="<?php echo Session::get('_token'); ?>">
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <input type="submit" value="Graffiti 🎨" class="btn btn-block btn-primary">
            </div>
            <div class="col-sm">
                <input type="text" name="graffiti" class="form-control">
            </div>
        </div>
    </div>
</form>
<?php if ($data['player']->Kills > 0): ?>
    <hr>
    <form action="<?php echo URLROOT; ?>PlayerActions/rename" method="post" autocomplete="off">
        <input type="hidden" name="_token" value="<?php echo Session::get('_token'); ?>">
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <input type="submit" value="Rename Location 🎟️" class="btn btn-block btn-secondary">
                </div>
                <div class="col-sm">
                    <input type="text" name="rename" class="form-control">
                </div>
            </div>
            <div class="small">*Spends a kill 🏆</div>
        </div>
    </form>
<?php endif; ?>