<?php
require("../config/constants.php");
require('../libs/fpdf/fpdf.php');


if ($_POST['form-id'] == "generate-invoice-form") {
    $full_name = $_POST['full-name'];
    $mobile_number = $_POST['mobile-number'];
    $delivery_adrs = $_POST['delivery-adrs'];
    $order_id = $_POST['order-id'];
    $date = $_POST['order-date'];
}

$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetMargins(20, 20, 20);

// Add Header
$pdf->SetFont('Arial', 'B', 16);
$logoPath = "../images/logo.png";  
$logoWidth = 60;  
$pageWidth = $pdf->GetPageWidth(); // Get the page width
$xLogo = ($pageWidth - $logoWidth) / 2; // Calculate X to center the logo

$pdf->Image($logoPath, $xLogo, 10, $logoWidth); // Place the logo (x, y, width)
$pdf->Ln(20);

// Add Customer Details
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(50, 10, 'Customer Name:', 0, 0);
$pdf->Cell(50, 10, $full_name, 0, 1);
$pdf->Cell(50, 10, 'Mobile Number:', 0, 0);
$pdf->Cell(50, 10, $mobile_number, 0, 1);
$pdf->Cell(50, 10, 'Delivery Address:', 0, 0);
$pdf->MultiCell(100, 10, $delivery_adrs);
$pdf->Cell(50, 10, 'Order ID:', 0, 0);
$pdf->MultiCell(100, 10, $order_id);
$pdf->Cell(50, 10, 'Order Date:', 0, 0);
$pdf->MultiCell(100, 10, date('Y-m-d h:i:s A', strtotime($date)));


$pdf->Ln(10);
$pdf->Cell(40, 10, 'Order Details:', 0, 0, 'C');

// Add Table Header
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(10, 10, 'S.N.', 1, 0, 'C');
$pdf->Cell(55, 10, 'Items', 1, 0, 'C');
$pdf->Cell(30, 10, 'Price', 1, 0, 'C');
$pdf->Cell(30, 10, 'Quantity', 1, 0, 'C');
$pdf->Cell(40, 10, 'Total Price', 1, 1, 'C');

$grand_total_price = 0.0;
$sql = "SELECT * FROM tbl_order_details WHERE order_id = '$order_id' ";
$res = mysqli_query($conn, $sql);

if ($res == TRUE) {
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        $row = mysqli_fetch_assoc($res);
        $item_id_list_json = $row['item_id_list'];
        $quantity_list_json = $row['quantity_list'];
        $unit_price_list_json = $row['unit_price_list'];

        $item_id_list = json_decode($item_id_list_json);
        $quantity_list = json_decode($quantity_list_json);
        $unit_price_list = json_decode($unit_price_list_json);

        $length = count($item_id_list);
        $sn = 1;


        while ($length > 0) {
            $length -= 1;

            $unit_price = array_pop($unit_price_list);
            $quantity = array_pop($quantity_list);

            $total_price = $quantity * $unit_price;

            $grand_total_price += (float)$total_price;

            $food_item_id = array_pop($item_id_list);

            $inner_sql = "SELECT title FROM tbl_menu WHERE id = $food_item_id ";
            $inner_res = mysqli_query($conn, $inner_sql);

            if (mysqli_num_rows($inner_res) == 1) {
                $inner_row = mysqli_fetch_assoc($inner_res);
                $food_item = $inner_row['title'];
                // $unit_price = $inner_row['price'];

            }



            // Add Order Details     
            $pdf->SetFont('Arial', '', 12);

            $pdf->Cell(10, 10, $sn++, 1, 0, 'C');
            $pdf->Cell(55, 10, " " . $food_item, 1, 0, 'L');
            $pdf->Cell(30, 10, "Rs. " . number_format($unit_price, 2), 1, 0, 'C');
            $pdf->Cell(30, 10, $quantity, 1, 0, 'C');
            $pdf->Cell(40, 10, "Rs. " . number_format($total_price, 2), 1, 1, 'C');
        }
    }

    // Add Grand Total
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(125, 10, 'Grand Total', 1, 0, 'R');
    $pdf->Cell(40, 10, "Rs. " . number_format($grand_total_price, 2), 1, 1, 'C');

    $pdf->SetFont('Arial', '', 9);
    $pdf->Ln(10);
    $pdf->Cell(0, 5, 'Thank you for choosing us! We look forward to serving you again. ', 0, 1, 'C');
    $pdf->Cell(0, 5, 'For more contact us at: hamro-khaja-ghar@gmail.com ', 0, 1, 'C');



    // Output PDF
    if(isset($_SESSION['user-admin']) || isset($_SESSION['user-employee'])){
        $pdf->Output('I', 'invoice.pdf');

    }
    elseif(isset($_SESSION['user-id'])){
        $pdf->Output('D', 'invoice.pdf');

    }
}
