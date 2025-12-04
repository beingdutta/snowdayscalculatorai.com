<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Page Not Found (404) | SnowDay Calculator AI</title>
    <meta name="description" content="The page you were looking for could not be found. Let's get you back on track." />
    <link rel="icon" href="/assets/site-icon-apt.png" type="image/x-icon" />
    <link rel="stylesheet" href="/styles/index.css" />
    <link rel="stylesheet" href="/styles/static.css" />
</head>
<body>
    <?php include __DIR__ . '/navigations/header.php'; ?>

    <main class="static-page-wrapper not-found-wrapper">
        <h1>404</h1>
        <h2>Oops! Page Not Found.</h2>
        <p>It seems the page you're looking for might have been moved, deleted, or never existed. Let's get you back to predicting snow days!</p>
        <br>
        <a href="/" class="home-button">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.505A.5.5 0 0 0 10 15h2a.5.5 0 0 0 .5-.5V8.207l.646.647a.5.5 0 0 0 .708-.708L8 2.207 1.146 7.146a.5.5 0 0 0 .708.708L2.5 7.207V14.5a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5z"/>
            </svg>
            <span>Back to Homepage</span>
        </a>
    </main>

    <?php include __DIR__ . '/navigations/footer.php'; ?>
</body>
</html>