<style>
    table {
        margin-left:auto; 
        margin-right:auto;
    }
    tr.map_grid {
        text-align: center;
        width: 150px;
        height: 150px;
    }
    th {
        background: #888;
        text-align: center;
        border: #555 solid;
        border-width: 2px 0px 2px 0px;
    }
    td {
        width: 150px;
    }
</style>

<table>
    <tr> 
        <th colspan = "3">
            <?php
            if ($data[4]->LocationName == '') {
                echo 'Unnamed Location';
            } else {
                echo Secure::HTML($data[4]->LocationName);
            } ?>
        </th>
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
    <tr> 
        <th colspan = "3" style="text-align: left;">
            &nbsp;Health:
            <span class="badge badge-pill badge-danger">
                 <?php echo $data['PlayerStatus']->HP; ?>
            </span>
        </th>
    </tr>
    <tr> 
        <th colspan = "3" style="text-align: left;">
            &nbsp;Action Points:
            <span class="badge badge-pill badge-primary">
                <?php echo $data['PlayerStatus']->AP; ?>
            </span>
        </th>
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
            if ($data->LocationName != ''){
                $Name = Secure::HTML($data->LocationName);
            }
            
            echo '<td style="background-color: rgb(0,' . (150 - $data->Vegitation) . ',0)">';
            if ($mid == false) {
                echo '<form action="'.URLROOT.'game/movement" method="post" autocomplete="off">';
                echo '<input type="hidden" name="_token" value="'.Session::get('_token').'">';
                echo '<input type="hidden" name="location" value="'.$data->ID.'">';
                echo '<div class="row">';
                echo '<div class="col">';
                if ($data->Players > 0){
                    echo '<span class="badge badge-pill badge-danger">'.$data->Players.'</span>';
                }
                
                if ($data->LocationName != '') {$class = ''; } else { $class = 'btn-success';}
                echo '<input type="submit" value=" '.$Name.' " class="btn '.$class.' btn-block">';
                echo '</div>';
                echo '</form>';
            } else {
                if ($data->Players-1 > 0){
                    echo '<span class="badge badge-pill badge-danger">'.($data->Players - 1).'</span>';
                }
            }
            echo '</td>';            
        }
    }
    
?>