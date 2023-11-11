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
  background-color: #0072e7; /* Replace with your desired color */
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
</style>
</head>

<body>
<div class="table-responsive">
        <nav class="navbar navbar-default card navbar-custom">
            <div class="container-fluid">
                <div class="navbar-header" >
                    <div class="col-xl-4 col-lg-9 col-md-6 col-sm-9 col-9"> 
                        <a href="#"><img src="img/logo1.png" class="img-fluid mainlogo" style="width:80px;height:60px;color: white;"> 
                        <span style="color: white;">Medical</span>
                        <span style="color: red;">Shop</span></a>
                    </div>
                </div>
            </div>
        </nav>
    </div></br>
    <div class="container offset-xl-1">
        <div class="row">
            <div class="col-md-6 ">
                <div class="bill-container">
                    <?php
                    // Sample data for billing
                    include "db.php";
                    $querys = "SELECT  * from inv_order";
                    $results = mysqli_query($con, $querys);
                    $rowsAffected = mysqli_affected_rows($con);
                    //print_r($rowsAffected);
                    $customerName = "John Doe";
                    $invoiceNumber = "INV001";
                    $billDate = "2023-07-02";
                    $billAmount = 100.50;
                    $taxRate = 0.15;
                    ?>

                    <h3 class="text-center offset-xl-1">Billing Print</h3>
                    <p>Customer Name: <?php echo $customerName; ?></p>
                    <p>Invoice Number: <?php echo $invoiceNumber; ?></p>
                    <p>Bill Date: <?php echo $billDate; ?></p>
                    <hr>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ProductList</th>
                                <th>Quantity</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Product 1</td>
                                <td><?php echo "$" . number_format($billAmount, 2); ?></td>
                            </tr>
                            <tr>
                                <td>Tax (<?php echo ($taxRate * 100) . "%"; ?>)</td>
                                <td><?php echo "$" . number_format($billAmount * $taxRate, 2); ?></td>
                            </tr>
                            <tr>
                                <th>Total</th>
                                <th><?php echo "$" . number_format($billAmount + ($billAmount * $taxRate), 2); ?></th>
                            </tr>
                        </tbody>
                    </table>
                    <div class="text-center print-button">
                        <button class="btn btn-primary" onclick="window.print();">Print</button>
                        <a href="invoice.php"  class="btn btn-danger" >Close</a>
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
