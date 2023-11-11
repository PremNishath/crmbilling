<!DOCTYPE html>
<html lang="en">
<head>
    <title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script> 
    
    <style>
        .navbar-custom {
            background-color: #0072e7;
        }
    </style>
    <style>
        .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: #0072e7;
            color: white;
            text-align: right;
        }
        .bill-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        @media print {
            .print-button {
                display: none;
            }
        }
    </style>
    <style>
        #customerprocess {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 850px;
            height: 50px;
            font-size: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
            overflow: auto;
            padding-left: 200px;
        }
        #customerprocess td, #customerprocess th {
            border: 1px solid #ddd;
            padding: 4px;
            text-align: center;
            font-size: 10px;
            
        }
        #customerprocess th {
            padding-top: 5px;
            padding-bottom: 5px;
            text-align: center;
            background-color: #f2f2f2;
            color: black;
            font-size: 10px;
            
        }
    </style>
</head>
<body>
    <div class="table-responsive">
        <nav class="navbar navbar-default card navbar-custom">
            <div class="container-fluid">
                <div class="navbar-header">
                    <div class="col-xl-4 col-lg-9 col-md-6 col-sm-9 col-9"> 
                        <a href="#"><img src="img/logo1.png" class="img-fluid mainlogo" style="width:80px;height:60px;color: white;"> 
                        <span style="color: white;">Medical</span>
                        <span style="color: red;">Shop</span></a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <br>
    <div class="container offset-xl-1">
        <div>
            <div>
                <div class="offset-xl-1">
                <?php
// Sample data for billing
include "db.php";
$queryz = "SELECT  * from inv_order";
$resultz = mysqli_query($con, $queryz);
$rowsAffected1 = mysqli_affected_rows($con);
$query = "SELECT a.*, b.* FROM inv_order a, inv_order_item b WHERE a.order_id = b.order_id AND a.order_id = '$rowsAffected1'";
$result = mysqli_query($con, $query);
if ($row = mysqli_fetch_array($result)) {
    $customerName = $row['order_receiver_name'];
    $invoiceNumber = $row['order_id'];
    $billDate = $row['order_date'];
    $taxRate = $row['order_total_tax'];
}

?>

<h3 class="text-center offset-xl-1">Medical Shop</h3>
<p>Customer Name: <?php echo $customerName; ?></p>
<p>Bill Number: <?php echo $invoiceNumber; ?></p>
<p>Bill Date: <?php echo $billDate; ?></p>
<hr>

<?php 
$query = "SELECT a.*, b.* FROM inv_order a, inv_order_item b WHERE a.order_id = b.order_id AND a.order_id = '$rowsAffected1'";
$result = mysqli_query($con, $query);
$rowcount = mysqli_num_rows($result);
$totalAmount = 0; // Initialize total amount variable
if ($rowcount > 0) {
    echo '<div style="text-align: center; padding-right: 200px;">';
    echo '<table id="customerprocess">';
    echo '<tr>';
    echo '<th><h5>Sno</h5></th>';
    echo '<th><h5>Product</h5></th>';
    echo '<th><h5>Quantity</h5></th>';
    echo '<th><h5>Amount</h5></th>';
    echo '</tr>';
    $j = 1;
    while ($row = mysqli_fetch_array($result)) {
        $amount = $row['order_item_actual_amount'] + $row['order_item_tax1_amount']; // Calculate the amount for each row
        echo '<tr>';
        echo '<td>'.$j.'</td>';
        echo '<td><h5>'.$row['item_name'].'</h5></td>';
        echo '<td><h5>'.$row['order_item_quantity'].'</h5></td>';
        echo '<td><h5>'.$amount.'.00</h5></td>';
        echo '</tr>';
        $totalAmount += $amount; // Accumulate the amount
        $j++;
    }
    echo '<tr>';
    echo '<td></td>';
    echo '<td></td>';
    echo '<td><h5>Total</h5></td>';
    echo '<td><h5>'.$totalAmount.'.00</h5></td>';
    echo '</tr>';
    echo '</table>';
    echo '</div>';
}
?>


                    </br>
                    <div class="text-center print-button">
                        <button class="btn btn-primary" onclick="window.print();">Print</button>
                        <a href="invoice.php" class="btn btn-danger">Close</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <p>@ Developed by techpark</p>
    </div>
</body>
</html>
