<?php if (count($data) > 0): ?>
    <br>
    <div class="row">
        <?php
        foreach ($data as $value) {
            echo $value->EventTime;
            echo ' | ';
            echo $value->EventDesc;
            echo '<br>';
        }
        ?>
    </div>
<?php endif; ?>