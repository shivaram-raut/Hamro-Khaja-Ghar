<?php
echo "hello  ";
include("../config/constants.php");
include("insert-order-details.php");
$order_id = $_GET['purchase_order_id'] ?? null;
$pidx = $_GET['pidx'] ?? null;
$user_id = $_SESSION['user-id'];
echo "hey there1";
if ($pidx && $order_id) {
    echo "hey there";
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://a.khalti.com/api/v2/epayment/lookup/',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode(['pidx' => $pidx]),
        CURLOPT_HTTPHEADER => array(
            'Authorization: key 10ad6905d52748f2b27f92d784b04085',
            'Content-Type: application/json',
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);

    if ($response) {
        $responseArray = json_decode($response, true);

        if (isset($responseArray['status']) && $responseArray['status'] === 'Completed') {
            
            // Process for other payment methods
            $order_id = $_SESSION['order-id'];
            $full_name = $_SESSION['customer-name'];
            $total_price = $_SESSION['total-price'];
            $delivery_adrs = $_SESSION['delivery-adrs'];
            $payment_method = "khalti";
            $order_status = "Ordered";

            $sql = "INSERT INTO tbl_order (order_id, user_id, customer_name, total_price, delivery_adrs, payment_method, order_status) 
        VALUES ('$order_id', $user_id, '$full_name', $total_price, '$delivery_adrs', '$payment_method', '$order_status')";

            $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

            if ($res == true) {
                // Insert order details into order table:
                insertOrderDetails($order_id, $user_id);

                // clear cart:
                $sql_delete = "DELETE FROM tbl_cart WHERE user_id = $user_id ";

                $res_delete = mysqli_query($conn, $sql_delete);

                if ($res_delete == true) {

                    unset($_SESSION['order-id']);
                    unset($_SESSION['customer-name']);
                    unset($_SESSION['total-price']);
                    unset($_SESSION['delivery-adrs']);

                       $_SESSION['transaction_msg'] = '<script>
                    Swal.fire({
                        icon: "success",
                        title: "Transaction successful! Your order has been placed.",
                        showConfirmButton: false,
                        timer: 3500
                    });
                </script>';
                    header("Location:" . SITEURL . "main/index.php");
                    exit();
                }
            }

        } else {
            // Handle failed payment
            $_SESSION['transaction_msg'] = '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Payment failed. Please try again.",
                        showConfirmButton: false,
                        timer: 3500
                    });
                </script>';
            header("Location:" . SITEURL . "/main/checkout.php");
            exit();
        }
    }
}
