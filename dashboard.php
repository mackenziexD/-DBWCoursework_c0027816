<?php include_once("assets/header.php"); 
$info = "";
$status = "";

if(!isset($_SESSION["Adminloggedin"]) || $_SESSION["Adminloggedin"] !== true){
    header("location: login.php");
    exit;
}


if (isset($_GET['page_no']) && $_GET['page_no']!="") {
	$page_no = $_GET['page_no'];
	} else {
		$page_no = 1;
        }

	$total_records_per_page = 10;
    $offset = ($page_no-1) * $total_records_per_page;
	$previous_page = $page_no - 1;
	$next_page = $page_no + 1;
	$adjacents = "2"; 
    $conn689 = new mysqli($ini['db_host'], $ini['db_username'], $ini['db_password'], $ini['db_name']);

	$result_count = mysqli_query($conn689,"SELECT COUNT(*) As total_records FROM `customer`");
	$total_records = mysqli_fetch_array($result_count);
	$total_records = $total_records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
	$second_last = $total_no_of_pages - 1; // total page minus 1

?>
<style>
.pagination {
   justify-content: center;
}
</style>
<br>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    List Of Applications
                </div>
                <div class="card-body">
                    <table class="table" id="myTable">
                        <thead style="font-size: 13px;">
                            <tr>
                            <th scope="col">App ID</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Date Of Birth</th>
                            <th scope="col">Month Of Birth</th>
                            <th scope="col">Postcode</th>
                            <th scope="col">Contact</th>
                            <th scope="col">Product</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>  
                        <?php

                        $conn = new mysqli($ini['db_host'], $ini['db_username'], $ini['db_password'], $ini['db_name']);
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        $sql = "SELECT * FROM customer LIMIT ".$offset.", ".$total_records_per_page." ";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {


                                switch ($row['application_status']) {
                                    case "New":
                                        $status = "dark";
                                        break;
                                    case "In-process":
                                        $status = "warning";
                                        break;
                                    case "Withdrawn":
                                        $status = "warning";
                                        break;
                                    case "Complete":
                                        $status = "success";
                                        break;
                                    case "On-hold":
                                        $status = "info";
                                        break;
                                    case "Rejected":
                                        $status = "danger";
                                        break;
                                }

                                echo "<tr><th scope='row'>".$row["application_id"]."</th><td>".$row["first_name"]."</td><td>".$row["last_name"]."</td><td>".$row["date_of_birth"]."</td><td>".$row["month_of_birth"]."</td><td>".$row["postcode"]."</td><td>+44".$row["contact_number"]."</td><td>".$row["product"]."</td>
                                <td><span class='badge badge-".$status."'>".$row["application_status"]."</span></td>
                                <td><a href='update.php?id=".$row["application_id"]."'>Update</a></td>
                                </tr>";
                            }
                        }

                        ?>
                        </tbody>
                    </table>
                    
                    <ul class="pagination">
                        <?php // if($page_no > 1){ echo "<li><a class="page-link href='?page_no=1'>First Page</a></li>"; } ?>
                        
                        <li class="page-item" <?php if($page_no <= 1){ echo "class='disabled page-item'"; } ?>>
                        <a class="page-link" <?php if($page_no > 1){ echo "href='?page_no=$previous_page'"; } ?>><span aria-hidden="true">&laquo;</span></a>
                        </li>
                        
                        <?php 
                        if ($total_no_of_pages <= 10){  	 
                            for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
                                if ($counter == $page_no) {
                            echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";	
                                    }else{
                            echo "<li clas='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                                    }
                            }
                        }
                        elseif($total_no_of_pages > 10){
                            
                        if($page_no <= 4) {			
                        for ($counter = 1; $counter < 8; $counter++){		 
                                if ($counter == $page_no) {
                            echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";	
                                    }else{
                            echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                                    }
                            }
                            echo "<li> class='page-item'<a class='page-link'>...</a></li>";
                            echo "<li class='page-item'><a class='page-link' href='?page_no=$second_last'>$second_last</a></li>";
                            echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
                            }

                        elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {		 
                            echo "<li class='page-item'><a class='page-link' href='?page_no=1'>1</a></li>";
                            echo "<li class='page-item'><a class='page-link' href='?page_no=2'>2</a></li>";
                            echo "<li class='page-item'><a class='page-link'>...</a></li>";
                            for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {			
                            if ($counter == $page_no) {
                            echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";	
                                    }else{
                            echo "<li> class='page-item'<a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                                    }                  
                        }
                        echo "<li class='page-item'><a class='page-link'>...</a></li>";
                        echo "<li class='page-item'><a class='page-link' href='?page_no=$second_last'>$second_last</a></li>";
                        echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";      
                                }
                            
                            else {
                            echo "<li class='page-item'><a class='page-link' href='?page_no=1'>1</a></li>";
                            echo "<li class='page-item'><a class='page-link' href='?page_no=2'>2</a></li>";
                            echo "<li class='page-item'><a class='page-link'>...</a></li>";

                            for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
                            if ($counter == $page_no) {
                            echo "<li class='active page-item'><a class='page-link'>$counter</a></li>";	
                                    }else{
                            echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                                    }                   
                                    }
                                }
                        }
                    ?>
                        
                        <li class="page-item" <?php if($page_no >= $total_no_of_pages){ echo "class='disabled page-item'"; } ?>>
                        <a class="page-link" <?php if($page_no < $total_no_of_pages) { echo "href='?page_no=$next_page'"; } ?>><span aria-hidden="true">&raquo;</span></a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>Tools</h5>
                </div>
                <div class="card-body">
                    <h6>Filter</h6>
                    <select class="selectpicker form-control" id="statusDropdown" oninput="filterTable()">
                        <option>All</option>
                        <option>new</option>
                        <option>in-process</option>
                        <option>withdrawn</option>
                        <option>complete</option>
                        <option>on-hold</option>
                        <option>rejected</option>
                    </select>
                    <hr>
                    <a target="_blank" href="pdf_admin.php"><button type="button" class="btn btn-dark btn-block">Export As PDF</button></a>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function filterTable() {
  // Variables
  let dropdown, table, rows, cells, country, filter;
  dropdown = document.getElementById("statusDropdown");
  table = document.getElementById("myTable");
  rows = table.getElementsByTagName("tr");
  filter = dropdown.value;

  // Loops through rows and hides those with countries that don't match the filter
  for (let row of rows) { // `for...of` loops through the NodeList
    cells = row.getElementsByTagName("td");
    country = cells[7] || null; // gets the 2nd `td` or nothing
    // if the filter is set to 'All', or this is the header row, or 2nd `td` text matches filter
    if (filter === "All" || !country || (filter === country.textContent)) {
      row.style.display = ""; // shows this row
    }
    else {
      row.style.display = "none"; // hides this row
    }
  }
}
</script>

<?php include_once("assets/footer.php"); ?>