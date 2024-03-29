<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Framework</title>
</head>

<body>
    <!-- header -->
    <header class="header">
        <h1>PHP Framework</h1>

        <!-- navbar -->
        <nav>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/contact">Contact</a></li>
                <li><a href="/login">Login</a></li>
                <li><a href="/register">Register</a></li>
            </ul>
        </nav>
    </header>

    <!-- page content -->
    <main class="main">

        <?php if (src\core\Application::$app->session->getFlash("success")): ?>
            <span><?= src\core\Application::$app->session->getFlash("success"); ?></span>
        <?php endif; ?>

        {{content}}
    </main>
</body>

</html>
