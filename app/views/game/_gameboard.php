<style>
    tr.map_grid {
        text-align: center;
        width: 150px;
        height: 150px;
    }
    th {
        background: #666;
        text-align: center;
        border: #444 solid;
        border-width: 0px 0px 2px 0px;
    }
    td {
        width: 150px;
    }
</style>

<table>
    <tr>
        <th colspan = "3">Location Name <?php echo $data[4]->Vegitation; ?></th>
    </tr>
    <tr class="map_grid">
        <?php DisplayMapSection($data[0]); ?>
        <?php DisplayMapSection($data[1]); ?>
        <?php DisplayMapSection($data[2]); ?>
    </tr>
    <tr class="map_grid">
        <?php DisplayMapSection($data[3]); ?>
        <?php DisplayMapSection($data[4], true); ?> 
        <?php DisplayMapSection($data[5]); ?>
    </tr>
    <tr class="map_grid">
        <?php DisplayMapSection($data[6]); ?>
        <?php DisplayMapSection($data[7]); ?>
        <?php DisplayMapSection($data[8]); ?>
    </tr>
</table>

<?php 
    function DisplayMapSection($data, $mid = false){
        if ($data->Grid_X == 100 || $data->Grid_X == 0 || $data->Grid_Y == 100 || $data->Grid_Y == 0){
            echo '<td style="background: #666;"></td>';
        } else {
            $Name = 'Thick Jungle';
            if ($data->Vegitation < 80){$Name = 'Dense Jungle';}
            if ($data->Vegitation < 60){$Name = 'Jungle';}
            if ($data->Vegitation < 40){$Name = 'Forrest';}
            if ($data->Vegitation < 20){$Name = 'Clearing';}
            if ($data->Vegitation < 10){$Name = 'Open Clearing';}
            echo '<td style="background-color: rgb(0,' . (150 - $data->Vegitation) . ',0)">';
            if ($mid == false) {
                echo '<form action="'.URLROOT.'game/movement" method="post" autocomplete="off">';
                echo '<input type="hidden" name="_token" value="'.Session::get('_token').'">';
                echo '<input type="hidden" name="location" value="'.$data->ID.'">';
                echo '<div class="row">';
                echo '<div class="col">';
                if ($data->Players > 0){
                    echo '<span class="badge badge-pill badge-primary">'.$data->Players.'</span>';
                }
                echo '<input type="submit" value=" '.$Name.' " class="btn btn-success btn-block">';
                echo '<input type="hidden" name="_token" value="'.Session::get('_token').'"></div>';
                echo '</div>';
                echo '</form>';
            } else {
                if ($data->Players-1 > 0){
                    echo '<span class="badge badge-pill badge-primary">'.($data->Players - 1).'</span>';
                }
            }
            echo '</td>';            
        }
    }
?>