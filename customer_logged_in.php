<?php include_once("assets/header.php");
$info = "";

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

if(isset($_POST['submit'])) {
    $product = clean_data($_POST['product']);
    $conn = new mysqli($ini['db_host'], $ini['db_username'], $ini['db_password'], $ini['db_name']);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    switch ($product) {
        case 100:
            $chances = "10";
            break;
        case 300:
            $chances = "15";
            break;
        case 500:
            $chances = "15";
            break;
        case 800:
            $chances = "25";
            break;
        case 1000:
            $chances = "35";
            break;
        case 5000:
            $chances = "45";
            break;
        case 10000:
            $chances = "55";
            break;
        case 15000:
            $chances = "60";
            break;
    } 

    $sql = 'UPDATE customer SET product="'.$product.'", lucky_draw_entries="'.$chances.'" WHERE application_id="'.$_SESSION['id'].'" ';
    $result = $conn->query($sql);

    if ($conn->query($sql) === TRUE) {    
        $conn = new mysqli($ini['db_host'], $ini['db_username'], $ini['db_password'], $ini['db_name']);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO log (application_id, name, action) VALUES ('".$_SESSION['id']."', '".$_SESSION['lname']."', 'Changed to product ".$product."')";

        if ($conn->query($sql) === TRUE) {
            $info = '<div class="alert alert-info" role="alert"><strong>Done!</strong> You changed your product!</div>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }else{
        $info = '<div class="alert alert-danger" role="alert"><strong>Error '. $sql .'</strong><br>' . $conn->error.'</div>';
    }
}

if(isset($_POST['withdraw'])) {
    if($_POST['Withdraw'] === "Yes"){

        $conn = new mysqli($ini['db_host'], $ini['db_username'], $ini['db_password'], $ini['db_name']);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = 'UPDATE customer SET application_status="withdrawn" WHERE application_id="'.$_SESSION['id'].'" ';
        $result = $conn->query($sql);

        if ($conn->query($sql) === TRUE) {           

            $conn = new mysqli($ini['db_host'], $ini['db_username'], $ini['db_password'], $ini['db_name']);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "INSERT INTO log (application_id, name, action) VALUES ('".$_SESSION['id']."', '".$_SESSION['lname']."', 'Withdrew Application')";

            if ($conn->query($sql) === TRUE) {
                $info = '<div class="alert alert-info" role="alert"><strong>Done!</strong> Your Application has been withdrawn!</div>';
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

          } else {
            echo "Error updating record: " . $conn->error;
          }

    }else{
        $info = '<div class="alert alert-danger" role="alert"><strong>Whoops!</strong> To withdraw your application you must select Yes!</div>';
    }
}
?>
<style>
.card-header {
    background-color: rgb(28 37 65);
    color: white;
    border-bottom: 1px solid rgb(28 37 65);
}
</style>
<br>
<div class="container">
    <h2 class="text-center">Welcome Back, <?php echo $_SESSION["lname"];?>!</h2>
    <br>
    <?php echo $info;

    $conn = new mysqli($ini['db_host'], $ini['db_username'], $ini['db_password'], $ini['db_name']);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM customer WHERE application_id='".$_SESSION["id"] ."' ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) { 
        while($row = $result->fetch_assoc()) {
            $options = $row['product'];
            ?>
            <div class="card">
                <div class="card-header">Application Details</div>
                <div class="card-body">
                    <form action="" method="post">

                        <div class="form-group">
                            <label for="application">Application ID</label>
                            <input type="text" class="form-control" id="application" value="<?php echo $row["application_id"] ?>" disabled>
                        </div>

                        <div class="form-group">
                            <label for="application">Application Status</label>
                            <input type="text" class="form-control" id="application" value="<?php echo $row["application_status"] ?>" disabled>
                        </div>

                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" class="form-control" id="name" value="<?php echo $row["first_name"].' '.$row["last_name"]; ?>" disabled>
                        </div>

                        <div class="form-group">
                            <label for="name">Entries To Win</label>
                            <input type="text" class="form-control" id="name" value="<?php echo $row["lucky_draw_entries"]; ?>" disabled>
                        </div>

                        <?php if($row['application_status'] !== "withdrawn"){?>
                        
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Product Selected</label>
                            <select class="form-control" id="product" name="product">
                                <option value="100"<?php echo $options == '100' ? 'selected' : ''; ?> >£100 6 Months</option>
                                <option value="300"<?php echo $options == '300' ? 'selected' : ''; ?> >£300 5 Months</option>
                                <option value="500"<?php echo $options == '500' ? 'selected' : ''; ?> >£500 3 Months</option>
                                <option value="800"<?php echo $options == '800' ? 'selected' : ''; ?> >£800 3 Months</option>
                                <option value="1000"<?php echo $options == '1000' ? 'selected' : ''; ?> >£1000 3 Months</option>
                                <option value="5000"<?php echo $options == '5000' ? 'selected' : ''; ?> >£5000 3 Months</option>
                                <option value="10000"<?php echo $options == '10000' ? 'selected' : ''; ?> >£10,000 5 Months</option>
                                <option value="15000"<?php echo $options == '15000' ? 'selected' : ''; ?> >£15,000 5 Months</option>
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </select>
                            <small id="emailHelp" class="form-text text-info">You are able to change your desired product but this will change your application status and may take longer to review.</small>
                        </div>
                        <input class="btn btn-block btn-dark" type="submit" name="submit" value="Update Details">
                        <?php } ?>
                    </form>
                </div>
            </div>
            <br><br>
            <?php if($row['application_status'] !== "withdrawn"){?>
            <div class="card">
                <div class="card-header">Withdraw Application</div>
                <div class="card-body">
                    <form action="" method="post">
                        <small id="emailHelp" class="form-text text-danger form-check-inline">Once you withdraw your application we are unable to undo this, you understand that this will be irreversible and you will have to fill out a new form.</small>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="Withdraw" id="Yes" value="Yes">
                            <label class="form-check-label" for="Yes">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="Withdraw" id="No" value="No">
                            <label class="form-check-label" for="No">No</label>
                        </div>

                        <input type="hidden" name="appid" value="<?php echo $_SESSION["id"];?>">
                        <br><br>
                        <input class="btn btn-block btn-danger" type="submit" name="withdraw" value="I Understand">
                    </form>
                </div>
            </div>


    <?php } } } ?>

</div>
<?php include_once("assets/footer.php"); ?>
