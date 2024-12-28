<?php
// Initialize Khalti Payment
$postFields = array(
    "return_url" => SITEURL . "admin/khalti-payment-response.php",
    "website_url" => SITEURL,
    "amount" => $total_price * 100, // Amount in paisa
    "purchase_order_id" => $order_id,
    "purchase_order_name" => "Order #$order_id",
    "customer_info" => array(
        "name" => $full_name,
        "email" => $email,
        "phone" => $phone,
    )
);

$jsonData = json_encode($postFields);

$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://a.khalti.com/api/v2/epayment/initiate/',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => $jsonData,
    CURLOPT_HTTPHEADER => array(
        'Authorization: key 10ad6905d52748f2b27f92d784b04085',
        'Content-Type: application/json',
    ),
));

$response = curl_exec($curl);

// Check for errors in the CURL request
if (curl_errno($curl)) {
    $error_msg = curl_error($curl); // Get the error message
    curl_close($curl);

    // Handle no internet or connectivity issues
    $_SESSION['transaction_msg'] = '<script>
                Swal.fire({
                    icon: "error",
                    title: "Please check your internet connection and try again.",
                    showConfirmButton: false,
                    timer: 3500
                });
            </script>';
    header("Location:" . SITEURL . "main/checkout.php");
    exit();
}

curl_close($curl);

if ($response) {
    $responseArray = json_decode($response, true);

    if (isset($responseArray['payment_url'])) {
        // Redirect to Khalti payment page
        header('Location: ' . $responseArray['payment_url']);
        exit();
    } else {
        // Handle API response failure
        $_SESSION['transaction_msg'] = '<script>
            Swal.fire({
                icon: "error",
                title: "Failed to initiate Khalti payment. Please try again.",
                showConfirmButton: false,
                timer: 3500
            });
        </script>';
        header("Location:" . SITEURL . "main/checkout.php");
        exit();
    }
} else {
    // Handle payment initiation failure when no response is received
    $_SESSION['transaction_msg'] = '<script>
                Swal.fire({
                    icon: "error",
                    title: "Failed to initiate Khalti payment!. Please try again.",
                    showConfirmButton: false,
                    timer: 3500
                });
            </script>';
    header("Location:" . SITEURL . "main/checkout.php");
    exit();
}
