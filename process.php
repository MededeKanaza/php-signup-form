<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Retrieve and sanitize data
    $fullname = isset($_POST['fullname']) ? htmlspecialchars(trim($_POST['fullname'])) : '';
    $email = isset($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    
    // Additional server-side validation
    $errors = [];
    
    if (empty($fullname) || strlen($fullname) < 2) {
        $errors[] = "Full name must contain at least 2 characters.";
    }
    
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please provide a valid email address.";
    }
    
    if (empty($password) || strlen($password) < 6) {
        $errors[] = "Password must contain at least 6 characters.";
    }
    
    // Display the result
    echo "<!DOCTYPE html>";
    echo "<html lang='en'>";
    echo "<head>";
    echo "<meta charset='UTF-8'>";
    echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
    echo "<title>Signup Result</title>";
    echo "<style>";
    echo "body { font-family: Arial, sans-serif; max-width: 500px; margin: 50px auto; padding: 20px; background-color: #f5f5f5; }";
    echo ".container { background-color: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }";
    echo ".success { color: #4CAF50; }";
    echo ".error { color: #f44336; }";
    echo "h2 { color: #333; text-align: center; margin-bottom: 30px; }";
    echo ".info { margin: 15px 0; padding: 10px; background-color: #f9f9f9; border-left: 4px solid #4CAF50; }";
    echo "</style>";
    echo "</head>";
    echo "<body>";
    echo "<div class='container'>";
    
    if (empty($errors)) {
        // Registration successful
        echo "<h2 class='success'>✓ Signup Successful!</h2>";
        echo "<div class='info'>";
        echo "<strong>Full Name:</strong> " . $fullname . "<br>";
        echo "<strong>Email:</strong> " . $email . "<br>";
        // Never display the password for security reasons
        echo "<strong>Status:</strong> Registration validated";
        echo "</div>";
        echo "<p>Thank you for signing up! A confirmation email will be sent to your address.</p>";
    } else {
        // Validation errors
        echo "<h2 class='error'>✗ Signup Error</h2>";
        echo "<div class='error'>";
        echo "<strong>The following errors were detected:</strong><br>";
        foreach ($errors as $error) {
            echo "- " . $error . "<br>";
        }
        echo "</div>";
        echo "<p><a href='index.html'>Back to Form</a></p>";
    }
    
    echo "</div>";
    echo "</body>";
    echo "</html>";
    
} else {
    // If someone accesses process.php directly without submitting the form
    header("Location: index.html");
    exit();
}
?>