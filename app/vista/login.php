<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo 'css/'.Config::$mvc_login_css ?>">
    <title>Document</title>
</head>
<body>
<?php ob_start() ?>
    <main class="container">

    <div class="login">
        <h1>LOG IN</h1>
        <form action="index.php?ctl=login" method="POST" name="login">
                <input type="email" name="email" placeholder="email">
                <input type="password" name="pass" placeholder="password">
                <input type="submit" name="login" value="login">
        </form>
    </div>


    <div class="signup">
        <h1>SIGN UP</h1>
    </div>

    <div class="signupform">
        <form action="index.php?ctl=login" method="POST" name="registerform" enctype="multipart/form-data">
            <p>
                <input type="email" name="email" placeholder="email">
            </p>
            <p>
                <input type="password" name="pass" placeholder="pass">
            </p>
            <p>
                <input type="text" name="nombre" placeholder="name">
                <input type="text" name="apellido" placeholder="surname">
            </p>
            <p>
                <input type="file" name="profilepic">
            </p>
            <p>
                <input type="submit" name="signup" value="signup">
            </p>
        </form>
    </div>

</main>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8=" crossorigin="anonymous">
    </script>
<script src="js/logscript.js"></script>

</body>
</html>