<?php
$db = new PDO('mysql:host=localhost', 'root', null);
?>
<!doctype html>
<html lang=en>
<head>
    <meta charset=utf-8>
    <title> Docker-LAMP</title>

    <style>
        @import 'https://fonts.googleapis.com/css?family=Montserrat|Raleway|Source+Code+Pro';

        body { font-family: 'Raleway', sans-serif; }
        h2 { font-family: 'Montserrat', sans-serif; }
        pre {
            font-family: 'Source Code Pro', monospace;

            padding: 16px;
            overflow: auto;
            font-size: 85%;
            line-height: 1.45;
            background-color: #f7f7f7;
            border-radius: 3px;

            word-wrap: normal;
        }

        .container {
            max-width: 1024px;
            width: 100%;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <img src="pictures/lamp-server.png" alt="Docker LAMP logo" />
            <h2>Bienvenu à <a href="https://github.com/COULIBALY-Adama/IFI-lamp-Server.git" target="_blank">Docker-Lamp</a> LAMP-Server</h2>
        </header>
        <article>
            <p>
                Pour la documentation, <a href="https://github.com/COULIBALY-Adama/IFI-lamp-Server.git" target="_blank">cliquez ici</a>.
            </p>
        </article>
        <section>
            <pre>
OS: <?php echo php_uname('s'); ?><br/>
Apache: <?php echo apache_get_version(); ?><br/>
MySQL Version: <?php echo $db->getAttribute( PDO::ATTR_SERVER_VERSION ); ?><br/>
PHP Version: <?php echo phpversion(); ?><br/>
phpMyAdmin Version: <?php echo getenv('PHPMYADMIN_VERSION'); ?><span>&nbsp;</span>
            </pre>
        </section>
    </div>
</body>
</html>
