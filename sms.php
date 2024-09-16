<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $API_KEY = 'df87ad9eb5eeda419f0a179d5ca12ae8-93e15fd6-6ba7-42d1-b3d0-e84f795f2570'; // Replace with your Infobip API Key
    $BASE_URL = '1g9wg1.api.infobip.com'; // Infobip API base URL
    $SENDER = 'InfoSMS'; // Replace with your sender name or number
    $RECIPIENT = $_POST['phone']; // Phone number input from the form
    $MESSAGE = $_POST['message']; // Message input from the form

    // Prepare request body
    $data = array(
        "messages" => array(
            array(
                "from" => $SENDER,
                "destinations" => array(
                    array("to" => $RECIPIENT)
                ),
                "text" => $MESSAGE
            )
        )
    );

    // Setup cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "$BASE_URL/sms/2/text/advanced");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Authorization: App $API_KEY",
        "Content-Type: application/json",
    ));

    // Execute request and get response
    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Error: ' . curl_error($ch);
    } else {
        echo 'SMS sent successfully!';
    }

    // Close cURL
    curl_close($ch);
}
?>