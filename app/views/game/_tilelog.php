<?php if (count($data) > 0): ?>
    <br>
    <?php
    foreach ($data as $value) {
        echo get_timeago(strtotime($value->EventTime));
        echo ' | ';
        echo Secure::HTML($value->EventDesc);
        echo '<br>';
    }
    ?>
<?php endif; ?>