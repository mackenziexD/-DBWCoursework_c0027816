<?php include_once("assets/header.php"); 

if(isset($_GET["application_id"])){

?>
<br>
<div class="container">
    <h2 class="text-center">Summary Page</h2>
    <h4>Successfully Registered</h4>
    <p>
        Name: <?php echo $_GET["fname"];?> <br>
        Product: <?php echo $_GET["product"];?> <br>
        Application ID: <?php echo $_GET["application_id"];?> <br><br>

        Thank you for your interest to open a Time Deposit Account with us under this campaign. Your application ID is <strong><?php echo $_GET["application_id"];?></strong>. Only one application is allowed per customer. You will have <strong><?php echo $_GET["chances"];?></strong> entries for the lucky draw (stand a chance to win £10,000) upon successful deposit placement until the end of account tenure. Your record has been successfully submitted. You may update your record as long as your application status is “new” by providing the application ID from this link
    </p>
</div>
<?php } else{ 
    header("Location: register_intrest.php");
    exit();
}

include_once("assets/footer.php"); ?>