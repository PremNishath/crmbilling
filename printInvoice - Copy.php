<!DOCTYPE html>
<html>
<head>
    <title>Billing Print</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        /* Custom styles for the billing print */
        .bill-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        @media print {
            .print-button {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
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

                    <h3 class="text-center">Billing Print</h3>
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
</body>
</html>
