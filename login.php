<?php
session_start();
 if (isset($_SESSION['user']) )
{
    echo $_SESSION['user'];
}
 ?>
<!DOCTYPE html>
<html>
<head>
    <title>Landing page </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
  <h1>Login page</h1>

    <form method="post" class="container" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>>
                <div class="form-group">
                  <label for="exampleInputEmail1">UserName</label>
                  <input type="text" class="form-control"  aria-describedby="emailHelp"  name="username" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" class="form-control" name="password" required>
                </div>

                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>
  <div style="padding-top: 40px">
      <a href="index.php" style="text-decoration: darkviolet; font-size: 15px; margin: 195px;">  Register </a>
  </div>
  <div style="padding-top: 40px">
      <a href="logout.php" style="text-decoration: darkviolet; font-size: 15px; margin: 195px;">  logout </a>
  </div>
<?php
            $jsonfile = file_get_contents("user.json");
            // echo $jsonf/ile . "<br>";
            $json_to_php = json_decode($jsonfile,true);
            // print_r($json_to_php);
            if (isset($_POST['submit'])) {
              foreach ($json_to_php as $key => $value) {
                  // echo $value["username"] . ", " . $value["password"] . "<br>";
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