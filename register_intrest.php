<?php include_once("assets/header.php"); 
$info = "";
$chances = "";
$application_id = "";

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: customer_logged_in.php");
    exit;
  }

if(isset($_POST['submit'])) {
    $fname = clean_data($_POST['fname']);
    $lname = clean_data($_POST['lname']);
    $dob = clean_data($_POST['dob']);
    $mob = clean_data($_POST['mob']);
    $postcode = clean_data($_POST['postcode']);
    $contact = clean_data($_POST['contact']);
    $product = clean_data($_POST['product']);

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

    $application_id = substr($lname, 0, 2).substr($fname, 0, 2).substr($postcode, -2).date("d").mt_rand(0,999999);

    $conn = new mysqli($ini['db_host'], $ini['db_username'], $ini['db_password'], $ini['db_name']);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM customer WHERE first_name='". $fname ."' AND last_name='".$lname."' ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $info = '<div class="alert alert-danger" role="alert"><strong>Whoops!</strong> Someone has already created an account using these details!</div>';
    } else{
        $sql = 'INSERT INTO customer (application_id, first_name, last_name, date_of_birth, month_of_birth, postcode, contact_number, product, application_status, application_date, lucky_draw_entries)
        VALUES ("'.$application_id.'", "'.$fname.'", "'.$lname.'", "'.$dob.'", "'.$mob.'", "'.$postcode.'", "'.$contact.'", "'.$product.'", "new", "'.date("d/m/y").'", "'.$chances.'")';
        
        if ($conn->query($sql) === TRUE) {
            header("Location: register_intrest_success.php?fname=".$fname."&application_id=".$application_id."&chances=".$chances."&product=".$product."");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

}



?>

<br>
<div class="container">
    <h2 class="text-center">Register For Product Intrest</h2>
    <br>
    <?php echo $info; ?>
    <br>
    <form method="POST">
        <div class="form-group">
            <label for="fname">First Name</label>
            <input type="text" class="form-control" name="fname" id="fname" required>
        </div>
        <div class="form-group">
            <label for="lname">Last Name</label>
            <input type="text" class="form-control" name="lname" id="lname" required>
        </div>
        <div class="form-group">
            <label for="dob">Date Of Birth</label>
            <input type="text" class="form-control" name="dob" id="dob" required>
        </div>
        <div class="form-group">
            <label for="mob">Month Of Birth</label>
            <input type="text" class="form-control" name="mob" id="mob" required>
        </div>
        <div class="form-group">
            <label for="postcode">Postcode</label>
            <input type="text" class="form-control" name="postcode" id="postcode" required>
        </div>
        <div class="form-group">
            <label for="contact">Contact Number</label>
            <input type="text" class="form-control" name="contact" id="contact" required>
        </div>
        <div class="form-group">
            <label for="product">Products</label>
            <select class="form-control" id="product" name="product" required>
                <option value="100">£100 6 Months</option>
                <option value="300">£300 5 Months</option>
                <option value="500">£500 3 Months</option>
                <option value="800">£800 3 Months</option>
                <option value="1000">£1000 3 Months</option>
                <option value="5000">£5000 3 Months</option>
                <option value="10000">£10,000 5 Months</option>
                <option value="15000">£15,000 5 Months</option>
            </select>
        </div>
        <input class="btn btn-primary btn-block" type="submit" name="submit" id="submit" value="submit">
    </form>
</div>

<?php include_once("assets/footer.php"); ?>