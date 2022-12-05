<?php 
 require('connection.php'); 
$id = $_POST['id'];
$querymenu = "SELECT * FROM admin_menu WHERE Menu_id = $id"; //You don't need a ; like you do in SQL
$resultmenu = mysqli_query($con, $querymenu); 
$selectQuery = mysqli_fetch_array($resultmenu);

?>

<form id="deduct-stock-form" method="POST" action="employee-menu.php">
    <h3><?php echo $selectQuery['Menu_name']; ?></h3>
    <div class="form-group">
        <b>Deduct Stock <span class="text-danger">*</span></b>
        <input class="form-control" name="deduct-qty" required type="number" />
        <b class="text-danger">Current Stock : <?php echo intval($selectQuery['stock_in']); ?></b>
    </div>
    <div class="form-group">
        <b>Remarks <span class="text-danger">*</span></b>
        <textarea class="form-control" rows="3" name="remarks" required></textarea>
    </div>
    <div class="form-group">
        <b>Expiration <span class="text-danger">*</span></b>
        <input class="form-control" name="expiration" type="date" />
    </div>
    <input class="form-control" name="product-id" type="hidden" value="<?php echo $selectQuery['Menu_id']; ?>"/>
</form>