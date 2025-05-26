<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and retrieve form data
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $message = htmlspecialchars(trim($_POST["message"]));

    // Basic validation (can be expanded)
    if (empty($name) || empty($email) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Consider a more specific error message if validation fails
        echo "Oops! Looks like some fields are missing or your email address has a typo. Please dash back and double-check.";
        exit; // Stop script execution
    }

    $to = "skotch.ntilane@gmail.com"; // Your email address
    
    // Thematic Subject Line for the email you receive
    $subject = "Signal Received: New Transmission from $name via I TYPE, WHAT I LIKE";
    
    $headers = "From: " . escapeshellarg($name) . " <" . escapeshellarg($email) . ">" . "\r\n" . // More secure way to set From
               "Reply-To: " . escapeshellarg($email) . "\r\n" .
               "X-Mailer: PHP/" . phpversion() . "\r\n" .
               "Content-Type: text/plain; charset=UTF-8";

    // Thematic Email Body for the email you receive
    $body = "Incoming Transmission Details:\n\n" .
            "Alias/Name: $name\n" .
            "Carrier Pigeon's Email (Reply-To): $email\n\n" .
            "Their Communiqué reads:\n--------------------------------------------------\n" .
            $message .
            "\n--------------------------------------------------\n";

    if (mail($to, $subject, $body, $headers)) {
        // User-facing success message
        echo "Success! Your signal has pierced the digital static and landed squarely in my inbox. If you hear a faint cheer, that's just my system celebrating a new arrival. I'll be in touch when the carrier pigeon returns!";
    } else {
        // User-facing error message
        // You might want to log the actual error on the server for debugging
        // error_log("Mail sending failed for: $email"); 
        echo "Blast it! The digital carrier pigeon seems to have gotten lost in a cosmic storm (or eaten by a particularly aggressive spam filter). My sincere apologies. Could you brave the 'send' button again, or perhaps try a different pigeon after a short while?";
    }
} else {
    // User-facing invalid request message
    echo "Hold your digital horses! This particular cog in the machine isn't meant for casual window shopping. Please use the contact form on the site to send your thoughts through the proper interwebs channels.";
}
?>
