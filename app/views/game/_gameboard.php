<style>
    td { 
        padding:40px;
        text-align: center;
    }
</style>

<table border="1">
    <tr>
        <?php DisplayMapSection($data[0]); ?>
        <?php DisplayMapSection($data[1]); ?>
        <?php DisplayMapSection($data[2]); ?>
    </tr>
    <tr>
        <?php DisplayMapSection($data[3]); ?>
        <?php DisplayMapSection($data[4], true); ?> 
        <?php DisplayMapSection($data[5]); ?>
    </tr>
    <tr>
        <?php DisplayMapSection($data[6]); ?>
        <?php DisplayMapSection($data[7]); ?>
        <?php DisplayMapSection($data[8]); ?>
    </tr>
</table>

<?php 
    function DisplayMapSection($data, $mid = false){
        if ($data->Grid_X == 100 || $data->Grid_X == 0 || $data->Grid_Y == 100 || $data->Grid_Y == 0){
            echo '<td style="background-color: rgb(0,0,0)"></td>';
        } else {
            echo '<td style="background-color: rgb(0,' . (200 - $data->Vegitation) . ',0)">';
            if ($mid == false){
                echo '<form action="'.URLROOT.'game/movement" method="post" autocomplete="off">';
                echo '<input type="hidden" name="_token" value="'.Session::get('_token').'">';
                echo '<input type="hidden" name="location" value="'.$data->ID.'">';
                echo '<div class="row">';
                echo '<div class="col">';
                echo '<input type="submit" value="Move" class="btn btn-success btn-block">';
                echo '<input type="hidden" name="_token" value="'.Session::get('_token').'"></div>';
                echo '</div>';
                echo '</form>';   
            }
            echo '<br>';
            echo $data->Vegitation;
            echo '<br>';
            echo $data->Grid_X.' : '.$data->Grid_Y;
            echo '</td>';            
        }
    }
?>