<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = trim($_POST["name"]);
  $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
  $subject = trim($_POST["subject"]);
  $message = trim($_POST["message"]);

  // Validate inputs
  if (empty($name) || empty($email) || empty($subject) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo "Please fill out all fields correctly.";
    exit;
  }

  // Set recipient email address
  $to = "aliskhattak664@gmail.com"; // Replace with your client's email address

  // Email content
  $email_subject = "New Contact Form Submission: $subject";
  $email_body = "Name: $name\n";
  $email_body .= "Email: $email\n\n";
  $email_body .= "Message:\n$message";

  // Email headers
  $headers = "From: $name <$email>";

  // Send email
  if (mail($to, $email_subject, $email_body, $headers)) {
    http_response_code(200);
    echo "Thank you! Your message has been sent.";
  } else {
    http_response_code(500);
    echo "Oops! Something went wrong and we couldn't send your message.";
  }
} else {
  http_response_code(403);
  echo "There was a problem with your submission, please try again.";
}
?>
