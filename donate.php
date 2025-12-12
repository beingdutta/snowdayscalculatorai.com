<?php include __DIR__ . '/includes/user_tracker.php'; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="Support SnowDay Calculator AI. Help us keep the servers running and predictions accurate.">
        <title>Donate - SnowDay Calculator AI</title>
        <link rel="icon" href="/assets/site-icon-apt.png" type="image/x-icon" />
        <link rel="stylesheet" href="/styles/index.css" />
        
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-PXCGN0JB4F"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-PXCGN0JB4F');
        </script>

        <!-- PayPal -->
        <script 
          src="https://www.paypal.com/sdk/js?client-id=BAAvfy_YmvRt7Gf6kYjuQYACVCI8P-hPXIWtqxqmI8K3EfERJl_X1EXGs-xI1LKylkKVWHHXZL4B948PiE&components=hosted-buttons&disable-funding=venmo&currency=USD">
        </script>

        <style>
            body {
                background-color: #f4f7f6;
                display: flex;
                flex-direction: column;
                min-height: 100vh;
            }
            .container {
                flex: 1;
                display: flex;
                justify-content: center;
                align-items: flex-start;
                padding-top: 3rem;
                padding-bottom: 3rem;
                width: 90%;
                max-width: 600px;
                margin: 0 auto;
            }
            .donate-card {
                background: #ffffff;
                border-radius: 12px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
                width: 100%;
                padding: 3rem 2rem;
                text-align: center;
                border-top: 5px solid rgb(32, 87, 129);
            }
            .donate-card h1 {
                color: rgb(32, 87, 129);
                margin-top: 0.5rem;
                margin-bottom: 1.5rem;
                font-size: 2rem;
            }
            .donate-card p {
                color: #555;
                line-height: 1.6;
                margin-bottom: 1.5rem;
                font-size: 1.05rem;
            }
            .heart-icon {
                color: rgb(32, 87, 129);
                margin-bottom: 1rem;
            }
            .paypal-container {
                margin-top: 2rem;
                padding: 2rem;
                background-color: #f8fbfe;
                border-radius: 8px;
                border: 1px dashed rgb(54, 162, 235);
            }
            .footer-note {
                margin-top: 2rem;
                font-size: 0.9rem;
                color: #888;
            }
        </style>
    </head>

    <body>
        <?php include __DIR__ . '/navigations/header.php'; ?>

        <div class="container">
            <div class="donate-card">
                <h4>You can use Paypal or any Debit/Credit Card to support us.</h4>

                <div class="paypal-container">
                    <div id="paypal-container-NRYBDPYQPEBHA"></div>
                    <script>
                      paypal.HostedButtons({
                        hostedButtonId: "NRYBDPYQPEBHA",
                      }).render("#paypal-container-NRYBDPYQPEBHA")
                    </script>
                </div>

                <p class="footer-note">
                    Thank you for your generosity!<br>
                    - The SnowDay Calculator Team
                </p>
            </div>
        </div>

        <?php include __DIR__ . '/navigations/footer.php'; ?>
    </body>
</html>