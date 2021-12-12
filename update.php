<?php include_once("assets/header.php");



$info = "";

if(!isset($_SESSION["Adminloggedin"]) || $_SESSION["Adminloggedin"] !== true){
    header("location: login.php");
    exit;
} 


$id = clean_data($_GET['id']);

if(isset($_POST['delete'])) {
    $conn6 = new mysqli($ini['db_host'], $ini['db_username'], $ini['db_password'], $ini['db_name']);
    if ($conn6->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql6 = "DELETE FROM customer WHERE application_id='".$id."'";
    if ($conn6->query($sql6) === TRUE) {    
            $conn7 = new mysqli($ini['db_host'], $ini['db_username'], $ini['db_password'], $ini['db_name']);
    
            $sql7 = "INSERT INTO log (application_id, name, action) VALUES ('".$id."', '[ADMIN] ".$_SESSION['AdminName']."', 'Deleted This User')";
    
            if ($conn7->query($sql7) === TRUE) {
                // redirect to dashboard.php
                header("location: dashboard.php");
            } else {
                echo "Error: " . $sql7 . "<br>" . $conn4->error;
            }
    } else {
        $info = '<div class="alert alert-danger" role="alert"><strong>Error '. $sql6 .'</strong><br>' . $conn6->error.'</div>';
    }
}

if(isset($_POST['submit'])) {
    $product = clean_data($_POST['product']);
    $first_name = clean_data($_POST['fname']);
    $last_name = clean_data($_POST['lname']);
    $contact = clean_data($_POST['contact']);
    $postcode = clean_data($_POST['postcode']);
    $status = clean_data($_POST['appstatus']);

    $conn3 = new mysqli($ini['db_host'], $ini['db_username'], $ini['db_password'], $ini['db_name']);
    if ($conn3->connect_error) {
        die("Connection failed: " . $conn3->connect_error);
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

    $sql3 = 'UPDATE customer SET product="'.$product.'", lucky_draw_entries="'.$chances.'", first_name="'.$first_name.'", last_name="'.$last_name.'", contact_number="'.$contact.'", postcode="'.$postcode.'", application_status="'.$status.'" WHERE application_id="'.$id.'" ';
    $result3 = $conn3->query($sql3);

    if ($conn3->query($sql3) === TRUE) {    
        $conn4 = new mysqli($ini['db_host'], $ini['db_username'], $ini['db_password'], $ini['db_name']);
        if ($conn4->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql4 = "INSERT INTO log (application_id, name, action) VALUES ('".$id."', '[ADMIN] ".$_SESSION['AdminName']."', 'Changed to product ".$product.", First Name To ".$first_name.", Last Name To".$last_name.", Contact Number To ".$contact.", Postcode To ".$postcode.", Application Status To ".$status."')";

        if ($conn4->query($sql4) === TRUE) {
            $info = '<div class="alert alert-info" role="alert"><strong>Done!</strong> You changed '.$id.' product!</div>';
        } else {
            echo "Error: " . $sql4 . "<br>" . $conn4->error;
        }
    }else{
        $info = '<div class="alert alert-danger" role="alert"><strong>Error '. $sql .'</strong><br>' . $conn3->error.'</div>';
    }
    $conn3->close();
}

    $conn = new mysqli($ini['db_host'], $ini['db_username'], $ini['db_password'], $ini['db_name']);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM customer WHERE application_id='".$id."' ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $options = $row['product'];
            $status = $row['application_status'];

?>

<style>
.card-header {
    background-color: rgb(28 37 65);
    color: white;
    border-bottom: 1px solid rgb(28 37 65);
}
hr {
    margin-top: 1rem;
    margin-bottom: 1rem;
    border: 0;
    border-top: 3px solid rgb(28 37 65 / 61%);
}
</style>

<br>
<div class="container">

    <div class="card">
        <div class="card-header">
            <?php echo $row["application_id"]; ?> - <?php echo $row["first_name"].' '.$row["last_name"]; ?>
        </div>
        <div class="card-body">
            <div class="alert alert-danger text-center">
                <strong>ALL</strong> actions are logged when editing accounts, dont edit it unless you have permission
                to do so.
            </div>

            <form action="" method="post">
                <div class="form-group">
                    <label for="appid">Application ID</label>
                    <input type="text" class="form-control" id="appid" name="appid" value="<?php echo $row["application_id"]; ?>" disabled>
                </div>

                <div class="form-group">
                    <label for="created">Application Created</label>
                    <input type="text" class="form-control" id="created" name="created" value="<?php echo $row["application_date"]; ?>" disabled>
                </div>

                <div class="form-group">
                    <label for="dob">Date Of Birth</label>
                    <input type="text" class="form-control" id="dob" name="dob" value="<?php echo $row["date_of_birth"].'/'.$row['month_of_birth']; ?>" disabled />
                </div>

                <?php if($status == 'withdrawn') { ?>

                <?php }else{ ?> 
                <hr>

                <div class="form-group">
                    <label for="fname">First Name</label>
                    <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $row["first_name"]; ?>" />
                </div>

                <div class="form-group">
                    <label for="lname">Last Name</label>
                    <input type="text" class="form-control" id="lname" name="lname" value="<?php echo $row["last_name"]; ?>" />
                </div>

                <div class="form-group">
                    <label for="contact">Contact Number</label>
                    <input type="text" class="form-control" id="contact" name="contact" value="<?php echo $row["contact_number"]; ?>" />
                </div>

                <div class="form-group">
                    <label for="postcode">Postcode</label>
                    <input type="text" class="form-control" id="postcode" name="postcode" value="<?php echo $row["postcode"]; ?>" />
                </div>

                <div class="form-group">
                    <label for="exampleFormControlSelect1">Product Selected</label>
                    <select class="form-control" id="product" name="product">
                        <option value="100" <?php echo $options == '100' ? 'selected' : ''; ?>>£100 6 Months</option>
                        <option value="300" <?php echo $options == '300' ? 'selected' : ''; ?>>£300 5 Months</option>
                        <option value="500" <?php echo $options == '500' ? 'selected' : ''; ?>>£500 3 Months</option>
                        <option value="800" <?php echo $options == '800' ? 'selected' : ''; ?>>£800 3 Months</option>
                        <option value="1000" <?php echo $options == '1000' ? 'selected' : ''; ?>>£1000 3 Months</option>
                        <option value="5000" <?php echo $options == '5000' ? 'selected' : ''; ?>>£5000 3 Months</option>
                        <option value="10000" <?php echo $options == '10000' ? 'selected' : ''; ?>>£10,000 5 Months</option>
                        <option value="15000" <?php echo $options == '15000' ? 'selected' : ''; ?>>£15,000 5 Months</option>
                    </select>
                </div>

                <hr>

                <div class="form-group">
                    <label for="appstatus">Application Status</label>
                    <select class="form-control" id="appstatus" name="appstatus">
                        <option value="new" <?php echo $status == 'New' ? 'selected' : ''; ?>>New</option>
                        <option value="in-process" <?php echo $status == 'in-process' ? 'selected' : ''; ?>>In-Progress</option>
                        <option value="withdrawn" <?php echo $status == 'withdrawn' ? 'selected' : ''; ?>>Withdrawn</option>
                        <option value="complete" <?php echo $status == 'complete' ? 'selected' : ''; ?>>Complete</option>
                        <option value="on-hold" <?php echo $status == 'on-hold' ? 'selected' : ''; ?>>On-hold</option>
                        <option value="Rejected" <?php echo $status == 'rejected' ? 'selected' : ''; ?>>Rejected</option>
                    </select>
                </div>
                <?php } ?>
                <?php if($status !== 'withdrawn') { ?>
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <input class="btn btn-primary btn-block" type="submit" name="submit" id="submit" value="Submit">
                    </div>
                </div>
                <?php }else{
                    echo '<div class="alert alert-danger text-center">
                    <strong>This application has been withdrawn</strong>
                    </div>';?>
                        <?php } ?>
            </form>
            <?php if($status == 'withdrawn') { ?>
                    <form id="delete" action="" method="post">

                    </form>
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <input class="btn btn-primary btn-block" form="delete" type="submit" name="delete" id="delete" value="delete">
                        </div>
                    </div>
            <?php } ?>
            <br><br>
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                    <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#exampleModal">Customer Audit Log</button>
                    </div>
                </div>

        </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Customer Audit Log</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


        <?php

            $conn2 = new mysqli($ini['db_host'], $ini['db_username'], $ini['db_password'], $ini['db_name']);
            // Check connection
            if ($conn2->connect_error) {
                die("Connection failed: " . $conn2->connect_error);
            }
            
            $sql2 = "SELECT * FROM log WHERE application_id='".$id ."' ORDER BY id DESC";
            $result = $conn2->query($sql2);
            
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {

        ?>


        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Update By - <?php echo $row["name"]; ?></h5>
                <p class="card-text">
                    <?php echo $row["action"]."."; ?>
                </p>
            </div>
        </div>
        <br>
        <?php } }else{ ?>
            <p class="text-center text-muted">No Logs Found</p>
        <?php } ?>
      </div>
    </div>
  </div>
</div>

    <?php
                }

            } else {
                header("location: index.php");
            }

        ?>
</div>
<br>
<?php include_once("assets/footer.php"); ?>