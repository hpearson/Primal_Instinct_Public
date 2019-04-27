

<div class="row">
    <form action="<?php echo URLROOT; ?>PlayerActions/cut" method="post" autocomplete="off">
        <input type="hidden" name="_token" value="<?php echo Session::get('_token'); ?>">
        <input type="submit" value="Cut Vegitation" class="btn btn-block">
    </form>
</div>

<?php if(count($data['nearplayers']) > 0 ): ?>
<br>
    <div class="row">
        <form action="<?php echo URLROOT; ?>PlayerActions/attack" method="post" autocomplete="off">
            <input type="hidden" name="_token" value="<?php echo Session::get('_token'); ?>">
            <select name="target">
                <?php 
                foreach ($data['nearplayers'] as $value) {
                    echo '<option value="'.$value->ID.'">';
                    echo Secure::HTML($value->Username);
                    echo '</option>';
                }
                ?>
            </select>
            <input type="submit" value="Attack" class="btn btn-block">
        </form>
    </div>
<?php endif; ?>