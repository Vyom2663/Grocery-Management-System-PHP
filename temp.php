<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="main-container">
        <form action="temp.php">
            Enter OTP here <input type="text" placeholder="OTP">

            <input type="submit" value="Submit" name="submit">

        </form>

        <?php


        function sendSMS($senderID, $recipient_no, $message)
        {
            // Request parameters array
            $requestParams = array(
                'user' => 'codexworld',
                'apiKey' => 'dssf645fddfgh565',
                'senderID' => $senderID,
                'recipient_no' => $recipient_no,
                'message' => $message
            );

            // Merge API url and parameters
            $apiUrl = "http://api.example.com/http/sendsms?";
            foreach ($requestParams as $key => $val) {
                $apiUrl .= $key . '=' . urlencode($val) . '&';
            }
            $apiUrl = rtrim($apiUrl, "&");

            // API call
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $apiUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            $response = curl_exec($ch);
            curl_close($ch);

            // Return curl response
            return $response;
        }




        $statusMsg = $receipient_no = '';
        $otpDisplay = $verified = 0;

        // If mobile number submitted by the user        
        if (true) {
            // Send otp to user via SMS
            $message = 'Dear User, OTP for mobile number verification is ' . "696969" . '. Thanks CodexWorld';
            $send = sendSMS('CODEXW', "+919106659320", $message);

            if ($send) {
                $otpDisplay = 1;
            } else {
                $statusMsg = array(
                    'status' => 'error',
                    'msg' => "We're facing some issue on sending SMS, please try again."
                );
            }
        } else {
            $statusMsg = array(
                'status' => 'error',
                'msg' => 'Some problem occurred, please try again.'
            );
        }
        ?>
    </div>
</body>

</html>