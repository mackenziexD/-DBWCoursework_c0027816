<?php include_once("assets/header.php"); 

$info = "";

if(isset($_SESSION["Adminloggedin"]) && $_SESSION["Adminloggedin"] === true){
  header("location: dashboard.php");
  exit;
}

if(isset($_POST['submit'])) {
    $username = clean_data($_POST['username']);
    $password_unclean = clean_data($_POST['password']);

    $password = md5($password_unclean);

    $conn = new mysqli($ini['db_host'], $ini['db_username'], $ini['db_password'], $ini['db_name']);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM staff WHERE username='".$username."' AND password='".$password."' ";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $_SESSION["Adminloggedin"] = true;
            $_SESSION["AdminName"] = $row['username'];
            
            header("location: dashboard.php");
            exit();
        }
    } else {
        $info = '<div class="alert alert-danger" role="alert"><strong>Whoops!</strong> Some of the details your entered are incorrect!</div>';
    }

}




?>
<style>
.form-signin {
  width: 100%;
  max-width: 40%;
  padding: 15px;
  margin: 0 auto;
}
.form-signin .checkbox {
  font-weight: 400;
}
.form-signin .form-control {
  position: relative;
  box-sizing: border-box;
  height: auto;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
</style>
<div class="container">
    <form class="form-signin" method="POST">
        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>

        <?php echo $info;?>

        <label for="appid">Username</label>
        <input type="text" id="username" name="username" class="form-control" required autofocus />
        <br>

        <label for="postcode">Password</label>
        <input type="password" id="password" name="password" class="form-control" required />
        <br>

        <input class="btn btn-primary btn-block" type="submit" name="submit" id="submit" value="Sign In">
    </form>
</div>
<?php include_once("assets/footer.php"); ?>