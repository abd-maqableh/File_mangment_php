<?php
//        session_start();
//    if (!$_SESSION['user']){
//        header("Refresh:0");
//    }else{
//        header("location:login.php");
//    }
// ?>

<!DOCTYPE html>
<html lang="uk">
<head>
  <title>Landing page </title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>

<h1>Landing page </h1>
<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

  <li class="nav-item">
    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" role="tab" aria-controls="pills-profile" aria-selected="false"  href="login.php" style="text-decoration: darkviolet; font-size: 15px; ">Login</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-profile-tab" data-toggle="pill"  role="tab" aria-controls="pills-profile" aria-selected="false" href="index.php" style="text-decoration: darkviolet; font-size: 15px; ">register</a>
  </li>

</ul>

<h1 style="margin: 10px; color: coral;"> Sign Up </h1>
<form method="post" class="container" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>>
    <div class="form-group">
        <label for="exampleInputEmail1">UserName</label>
        <input type="text" class="form-control"  aria-describedby="emailHelp"  name="username" required>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Email</label>
        <input type="email" class="form-control"  aria-describedby="emailHelp"  name="email" required>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" name="password" required>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">confirm Password</label>
        <input type="password" class="form-control" name="confirm-password" required>
    </div>
    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
</form>
<div style="padding-top: 40px">
    <a href="login.php" style="text-decoration: darkviolet; font-size: 15px; margin: 195px;"> I am already Register in the website</a>
</div>
<?php
if (isset($_POST['submit'])) {
    echo $_POST['submit'];
    $password = $_POST['password'] ;
    $confirmPassword=  $_POST['confirm-password'];
    if ($password !== $confirmPassword) {
        echo "the password does not match!!!";
    }
}
if (isset($_POST['submit']))
{
    $user_data = file_get_contents('user.json');
    $array_data = json_decode($user_data, JSON_PRETTY_PRINT);
    $store_data_user= array(
        "username" => $_POST["username"] ,
        "email"    => $_POST["email"],
        "password" => $_POST["password"]
    );
    $array_data[]=$store_data_user;
    $final_data = json_encode($array_data);
    file_put_contents('user.json', $final_data);
    $dir_of_user = __DIR__ . "/folder_of_user";
    if (!is_dir($dir_of_user."/".$_POST["username"]))
    {
        mkdir($dir_of_user."/".$_POST["username"],777,true);
    }
    echo $_POST["username"];
    session_start();
    $_SESSION['user'] = $_POST["username"];
    header("Location: login.php");
}


?>
</body>
</html>
