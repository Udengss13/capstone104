<?php 
    require('connection.php'); 
    $id = $_POST['id'];
    $querymenu = "SELECT * FROM stock_management WHERE product_id = '$id' ORDER BY id DESC"; 
    $resultmenu = mysqli_query($con, $querymenu);   
    $option ='';
    while($rowmenu =  mysqli_fetch_array($resultmenu)){
        $option .= '<tr>
                        <td>'.$rowmenu['remarks'].'</td>
                        <td align="center">'.$rowmenu['stock_in'].'</td>
                        <td align="center">'.$rowmenu['stock_out'].'</td>
                        <td align="center">'.$rowmenu['current_stock'].'</td><td>';
            if(isset($rowmenu['expiration'])){
                $option .= ' '.date('F d,Y',strtotime($rowmenu['expiration'])).'';
            }
                $option .= '</td></tr>';
    }

?>

<div class="table-responsive">
    <table class="table table-hover table-bordered">
        <thead>
            <tr>
                <th>Remarks</th>
                <th>Stock In</th>
                <th>Stock Out</th>
                <th>Current Stock</th>
                <th>Expiration</th>
            </tr>
        </thead>
        <tbody>
            <?php echo $option; ?>
        </tbody>
    </table>
</div>