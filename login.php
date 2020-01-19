<?php
session_start();
 ?>
<!DOCTYPE html>
<html lang="uk">

<head>
    <title>Landing page </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style_login.css">
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

            <form method="post" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> style="margin: 170px 215px;">
                <h5>username</h5>
                <div class="group">
                    <input type="text" name="username" class="input" required><span class="highlight"></span><span class="bar"></span>
                </div>
                <!-- E-mai -->
               
                <!-- password -->
                <h5>password</h5>
                <div class="group">
                    <input type="password" name="password" class="input" required><span class="highlight"></span><span class="bar"></span>
                </div>
               
                <!-- Sign in button -->
                <div style="margin-top: 110px">
                <button type="submit" class="btn btn-success" name="submit">Submit</button>
                <p style="display: inline;margin-left:10px;">or <a href="login.php" style="margin-left: 8px">Log in</a></p>
                </div>
           

            </form>
        </div>
    </div>


<?php
            $jsonfile = file_get_contents("user.json");
            $json_to_php = json_decode($jsonfile,true);
            if (isset($_POST['submit'])) {
              foreach ($json_to_php as $key => $value) {
                  if ($value["username"] === $_POST["username"] && $value["password"] === $_POST["password"] ) {
                      session_start();
                      $_SESSION['user'] = $_POST["username"];
                       header("Location: file_mangment.php");
                  }
               }
               echo "the password and username is not match!!!!!!!";
            }
 ?>
</body>
</html>