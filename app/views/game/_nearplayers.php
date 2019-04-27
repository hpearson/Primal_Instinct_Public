
<div class="row">
    <?php if ( count($data) > 0): ?>
    <?php     
        foreach ($data as $value) {
        echo '<u>'.Secure::HTML($value->Username).'</u>&nbsp;';
    }
    ?> is also here.
    
    <?php else: ?>
    There is nobody around.
    <?php endif; ?>
</div>
<br>