<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>EdT-IFI</title>
        <link rel="stylesheet" href="/assets/css/bulma.min.css">
    </head>
    <body>
        <section class="hero is-medium is-info is-bold">
            <div class="hero-body">
                <div class="container has-text-centered">
                    <h1 class="title">
                        Emploi du Temps de l'IFI <br>
                    <img src="logo-ifi.png" alt="Le logo du site">
                    </h1>
                    <h2 class="subtitle">
                        INSTITUT DE LA FRANCOPHONIE POUR L'INNOVATION
                    </h2>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="container">
                <div class="columns">
                    <div class="column">
                        <h3 class="title is-3 has-text-centered">Environement</h3>
                        <hr>
                        <div class="content">
                            <ul>
                                <li><?php echo "Emploi du Temps" ?></li>
                                <li><?php echo apache_get_version(); ?></li>
                                <li>PHP <?php echo phpversion(); ?></li>
                                <li>
                                    <?php
                                    $link = mysqli_connect("mysql", "root", "admin", null);

/* check connection */
                                    if (mysqli_connect_errno()) {
                                        printf("MySQL connecttion failed: %s", mysqli_connect_error());
                                    } else {
                                        /* print server version */
                                        printf("MySQL Server %s", mysqli_get_server_info($link));
                                    }
                                    /* close connection */
                                    mysqli_close($link);
                                    ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="column">
                        <h3 class="title is-3 has-text-centered"> Liens</h3>
                        <hr>
                        <div class="content">
                            <ul>
                                <li><a href="http://localhost/EdT-IFI">EdT-IFI</a></li>
                                <li><a href="http://localhost/phpinfo.php">phpinfo()</a></li>
                                <li><a href="http://localhost/phpmyadmin">phpMyAdmin</a></li>
                                <li><a href="http://localhost/test_db.php">Test DB Connection</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>
