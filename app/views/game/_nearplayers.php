
<?php if (count($data) > 0): ?>
    <?php
    foreach ($data as $value) {
        echo '<b>' . Secure::HTML($value->Username) . '</b>, ';
    }
?> is also here.

<?php else: ?>
    There is nobody around.
<?php endif; ?>
<hr>