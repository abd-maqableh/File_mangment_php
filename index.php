<!DOCTYPE html>
<html lang="uk">

<head>
    <title>Landing page </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style_index.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">

</head>

<body>
    <div class="grid">
        <div class="first_side item">
            <div class="container-first">
                <div class="SginUp">
                    <h1>Sign Up </h1>
                    <p>Sginup with your simple detilas It will be cross chekced by the adminstration </p>
                </div>
                <div class="SginIn">
                    <h1>Sign In</h1>
                    <p>Sign in in your username and password</p>
                </div>
            </div>
        </div>
        <div class="second-side item">
            <form method="post" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>>
                <h5>username</h5>
                <div class="group">
                    <input type="text" name="username" class="input" required><span class="highlight"></span><span class="bar"></span>
                </div>
                <!-- E-mai -->
                <h5>email</h5>
                <div class="group">
                    <input type="email" name=" email" class="input" required><span class="highlight"></span><span class="bar"></span>
                </div>
                <!-- password -->
                <h5>password</h5>
                <div class="group">
                    <input type="password" name="password" class="input" required><span class="highlight"></span><span class="bar"></span>
                </div>
                <h5>confirm password</h5>
                <!-- confirm-password -->
                <div class="group">
                    <input type="password" name="confirm-password" class="input" required><span class="highlight"></span><span class="bar"></span>
                </div>
                <div style="margin:25px auto;">
                    <input type="checkbox" required>
                    <p style="display:inline;margin-left:13px;">I agree with the terms and conditon</p>
                </div>
                <!-- Sign in button -->
                <button type="submit" class="btn btn-success" name="submit">Sign up</button>
                <p style="display: inline;margin-left:10px;">or <a href="login.php" style="margin-left: 8px">Log in</a></p>
            </form>
        </div>
    </div>


    <?php
    $jsonfile = file_get_contents("user.json");
    $json_to_php = json_decode($jsonfile, true);

    if (isset($_POST['submit'])) {
        if ($_POST['password'] === $_POST['confirm-password']) {
            foreach ($json_to_php as  $value) {
                if ($value["username"] !== $_POST["username"] || $value["email"] !== $_POST["email"]) {
                    $array_data = json_decode($jsonfile, JSON_PRETTY_PRINT);
                    $store_data_user = array(
                        "username" => $_POST["username"],
                        "email"    => $_POST["email"],
                        "password" => $_POST["password"]
                    );
                    $array_data[] = $store_data_user;
                    $final_data = json_encode($array_data);
                    file_put_contents('user.json', $final_data);
                    $dir_of_user = __DIR__ . "/folder_of_user";
                    if (!is_dir($dir_of_user . "/" . $_POST["username"])) {
                        mkdir($dir_of_user . "/" . $_POST["username"], 777, true);
                    }
                    session_start();
                    $_SESSION['user'] = $_POST["username"];
                    header("Location: login.php");
                }
                echo "The user name is already exist !!!";
            }
        }
        echo "the password does not match!!!";
    }


    ?>
</body>

</html>