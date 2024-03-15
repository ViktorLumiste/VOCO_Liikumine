<?php

// Database credentials
require '../Database.php';
require('./PHPMailer/src/PHPMailer.php');
require('./PHPMailer/src/SMTP.php');

global $conn;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$email = $_POST['email'];

$idQuery = "SELECT * FROM KASUTAJAD WHERE Email = '$email'";
$result = $conn->query($idQuery);

if ($result !== false && $result->num_rows > 0) {
    $results = mysqli_fetch_assoc($result);
    $userID = $results['Kasutaja_ID'] ;
    $username = $results['Nimi'] ;
    $code = uniqid('', true);
    
    
    
    $mail = new PHPMailer();
    $mail->setFrom('lumisteviktor@ikt.khk.ee', 'VOCO Liikumine');
    $mail->addAddress($email, $username);
    $mail->Subject = 'Verification Code';
    $mail->Body = 'Hi ' . $username . ',

An action performed on your account requires verification.
    
Your verification code is: ' . $code . '
    
Please complete the account verification process in 5 minutes.
    
If you did not request this, please REPORT THIS IMMEDIATELY as your account may be in danger.';
    
    if ($mail->send()) {
        http_response_code(200);
        $sql = "INSERT INTO TAASTAMIS_KOODID (Kood, Kasutaja_ID) values ('$code', $userID)";
        $result = $conn->query($sql);
        echo $result;
    } else {
        http_response_code(500);
        echo 'Error sending email: ' . $mail->ErrorInfo;
    }
} else {
    echo 'Error ';
}
$conn->close();
?>