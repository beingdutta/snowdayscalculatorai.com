<?php
$message_sent = false;
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $from_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $message_body = htmlspecialchars($_POST['message']);

    // Server-side validation for email and sending the mail
    if (filter_var($from_email, FILTER_VALIDATE_EMAIL)) {
        $to = "aduttablog2021@gmail.com";
        $subject = "New Contact Form Message from " . $from_email;
        $headers = "From: " . $from_email . "\r\n";
        $headers .= "Reply-To: " . $from_email . "\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

        if (mail($to, $subject, $message_body, $headers)) {
            $message_sent = true;
        } else {
            $error_message = 'Sorry, there was an error sending your message. Please try again later.';
        }
    } else {
        $error_message = 'Please enter a valid email address.';
    }
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Us | SnowDay Calculator AI</title>
    <meta name="description" content="Get in touch with the SnowDay Calculator AI team for support, feedback, or inquiries." />
    <link rel="icon" href="/assets/site-icon-apt.png" type="image/x-icon" />
    <link rel="stylesheet" href="/styles/index.css" />
    <link rel="stylesheet" href="/styles/static.css" />
</head>
<body>
    <?php include __DIR__ . '/navigations/header.php'; ?>

    <main class="static-page-wrapper">
        <h1>Contact Us</h1>
        <p>We'd love to hear from you! Whether you have a question, feedback on our calculator, or a media inquiry, our team is ready to help.</p>

        <h2>General Support & Feedback</h2>
        <p>For the fastest response regarding calculator results or technical issues, please reach out to our support team. We value your feedback as it helps us improve our accuracy and user experience.</p>
        <p><strong>Email:</strong> <a href="mailto:admins@snowdayscalculatorai.com">admins@snowdayscalculatorai.com</a></p>

        <h2>Media & Partnership Inquiries</h2>
        <p>For all media requests, interviews, or partnership opportunities, please contact our communications team.</p>
        <p><strong>Email:</strong> <a href="mailto:admins@snowdayscalculatorai.com">admins@snowdayscalculatorai.com</a></p>

        <h2>Send Us a Message Directly</h2>
        <?php if ($message_sent): ?>
            <p class="form-success">Thank you! Your message has been sent successfully.</p>
        <?php else: ?>
            <?php if ($error_message): ?>
                <p class="form-error"><?php echo $error_message; ?></p>
            <?php endif; ?>
            <form action="/contact" method="post" class="contact-form" onsubmit="return validateContactForm()">
                <div class="form-group">
                    <label for="email">Your Email Address</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <p id="js-form-error" class="form-error" style="display: none;"></p>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" rows="6" required></textarea>
                </div>
                <button type="submit" class="form-submit-btn">Send Message</button>
            </form>
        <?php endif; ?>
    </main>

    <?php include __DIR__ . '/navigations/footer.php'; ?>
    <script>
        function validateContactForm() {
            const messageInput = document.getElementById('message');
            const message = messageInput.value;
            const errorElement = document.getElementById('js-form-error');

            // Regex to detect URLs or domain-like patterns
            const linkPattern = /(http|https|ftp|www\.)|([a-zA-Z0-9-]+\.[a-zA-Z]{2,})/i;

            if (linkPattern.test(message)) {
                errorElement.textContent = 'Sorry, sending links in the message is not permitted.';
                errorElement.style.display = 'block';
                return false; // Prevent form submission
            }

            // If validation passes, hide the error and allow submission
            errorElement.style.display = 'none';
            return true;
        }
    </script>
</body>
</html>