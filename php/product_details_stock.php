<?php 
 require('connection.php'); 
$id = $_POST['id'];
$querymenu = "SELECT * FROM admin_menu WHERE Menu_id = $id"; //You don't need a ; like you do in SQL
$resultmenu = mysqli_query($con, $querymenu); 
$selectQuery = mysqli_fetch_array($resultmenu);

?>

<form id="add-stock-form" method="POST" action="employee-menu.php">
    <h3><?php echo $selectQuery['Menu_name']; ?></h3>
    <div class="form-group">
        <b>Add Stock <span class="text-danger">*</span></b>
        <input class="form-control" name="qty" required type="number" />
        <b class="text-danger">Current Stock : <?php echo intval($selectQuery['stock_in']); ?></b>
    </div>
    <div class="form-group">
        <b>Remarks <span class="text-danger">*</span></b>
        <textarea class="form-control" rows="3" name="remarks" required></textarea>
    </div>
    <div class="form-group">
        <b>Expiration <span class="text-danger">*</span></b>
        <input class="form-control" required name="expiration" type="date" min="<?php echo date('Y-m-d'); ?>" />
    </div>
    <input class="form-control" name="product-id" type="hidden" value="<?php echo $selectQuery['Menu_id']; ?>"/>
</form>