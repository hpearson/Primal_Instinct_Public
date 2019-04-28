<?php require APPROOT . '/views/inc/header.php'; ?>

<?php
$refrence = 0;
echo '<table border="1" style="width: 90%;">';
for ($y = 0; $y <= 100; $y++) {
    echo '<tr style="text-align: center;">';
    for ($x = 0; $x <= 100; $x++) {

        if ($data[$refrence]->Grid_X == 100 || $data[$refrence]->Grid_X == 0 || $data[$refrence]->Grid_Y == 100 || $data[$refrence]->Grid_Y == 0) {
            echo '<td style="width: 4em; height: 4em; background: #666;">';
            echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
            echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        } else {
            echo '<td style="width: 4em; height: 4em; background-color: rgb(0,' . (150 - $data[$refrence]->Vegitation) . ',0)">';
            $Name = 'Thick Jungle';
            if ($data[$refrence]->Vegitation < 80) {$Name = 'Dense Jungle';}
            if ($data[$refrence]->Vegitation < 60) {$Name = 'Jungle';}
            if ($data[$refrence]->Vegitation < 40) {$Name = 'Forrest';}
            if ($data[$refrence]->Vegitation < 20) {$Name = 'Clearing';}
            if ($data[$refrence]->Vegitation < 10) {$Name = 'Open Clearing';}
            if ($data[$refrence]->LocationName != '') {
                $Name = '<b class="text-warning">';
                $Name .= Secure::HTML($data[$refrence]->LocationName);
                $Name .= '</b>';
            }
            echo $Name;
        }
        echo '</td>';
        $refrence++;
    }
    echo '</tr>';
}

echo '</table>';
?>
<?php require APPROOT . '/views/inc/footer.php'; ?>
