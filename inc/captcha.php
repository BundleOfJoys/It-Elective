<?php
session_start();

// Function to generate a random CAPTCHA code
function getCode($valid_chars, $length) {
    $random_string = "";
    $num_valid_chars = strlen($valid_chars);

    for ($i = 0; $i < $length; $i++) {
        $random_pick = mt_rand(0, $num_valid_chars - 1);
        $random_char = $valid_chars[$random_pick];
        $random_string .= $random_char;
    }

    return $random_string;
}

// Check if the CAPTCHA is being requested
if (isset($_GET['captcha'])) {
    // Define valid characters and generate a code
    $comb_string = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $code = getCode($comb_string, 5);
    $_SESSION["code"] = $code;

    // Create the CAPTCHA image
    $im = imagecreatetruecolor(100, 40);
    $bg = imagecolorallocate($im, 255, 255, 255); // White background
    $fg = imagecolorallocate($im, 19, 78, 4); // Text color
    $noiseColor = imagecolorallocate($im, 200, 200, 200); // Noise color

    // Fill the background
    imagefill($im, 0, 0, $bg);

    // Add some noise (lines)
    for ($i = 0; $i < 10; $i++) {
        imageline($im, mt_rand(0, 100), mt_rand(0, 40), mt_rand(0, 100), mt_rand(0, 40), $noiseColor);
    }

    // Add the code to the image
    imagestring($im, 5, 10, 10, $code, $fg);

    // Set headers and output the image
    header("Cache-Control: no-cache, must-revalidate");
    header('Content-type: image/png');
    imagepng($im);
    imagedestroy($im);
    exit; // Stop further processing
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $captcha_input = $_POST['captcha'];

    if ($captcha_input === $_SESSION["code"]) {
        echo "CAPTCHA validated successfully!";
        // Continue processing login...
    } else {
        echo "CAPTCHA validation failed. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form with CAPTCHA</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        
        <img src="?captcha=true" alt="CAPTCHA" />
        <input type="text" name="captcha" placeholder="Enter CAPTCHA" required>
        
        <button type="submit">Login</button>
    </form>
</body>
</html>
