<?php  
// INSERT INTO `notes` (`sno`, `title`, `description`, `tstamp`) VALUES (NULL, 'But Books', 'Please buy books from Store', current_timestamp());
$insert = false;
$update = false;
$delete = false;
// Connect to the Database 
$servername = "localhost";
$username = "root";
$password = "";
$database = "medicines";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Die if connection was not successful
if (!$conn){
    die("Sorry we failed to connect: ". mysqli_connect_error());
}

if(isset($_GET['delete'])){
  $sno = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `medicines` WHERE `Srno` = $sno";
  $result = mysqli_query($conn, $sql);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
if (isset( $_POST['snoEdit'])){
  // Update the record
    $sno = $_POST["snoEdit"];
    $medi_id = $_POST["medi_idEdit"];
    $medi_type = $_POST["medi_typeEdit"];
    $medi_name = $_POST["medi_nameEdit"];
    $medi_company_name = $_POST["medi_company_nameEdit"];
    $medi_cost = $_POST["medi_costEdit"];

  // Sql query to be executed
  //$sql = "UPDATE `notes` SET `title` = '$title' , `description` = '$description' WHERE `notes`.`Srno` = $sno";
  $sql="UPDATE `medicines` SET `medi_id` = '$medi_id', `medi_type` = '$medi_type', `medi_name` = '$medi_name', `medi_company_name` = '$medi_company_name', `medi_cost` = '$medi_cost'
   WHERE `medicines`.`Srno` = $sno";
  $result = mysqli_query($conn, $sql);
  if($result){
    $update = true;
}
else{
    echo "We could not update the record successfully";
}
 }
else{
    $medi_id = $_POST["medi_id"];
    $medi_type = $_POST["medi_type"];
    $medi_name = $_POST["medi_name"];
    $medi_company_name = $_POST["medi_company_name"];
    $medi_cost = $_POST["medi_cost"];

  // Sql query to be executed
    $sql="INSERT INTO `medicines` (`medi_id`, `medi_type`, `medi_name`, `medi_company_name`, `medi_cost`) VALUES 
    ( '$medi_id', '$medi_type', '$medi_name', '$medi_company_name', '$medi_cost')";
    $result = mysqli_query($conn, $sql);

   
  if($result){ 
      $insert = true;
  }
  else{
      echo "The record was not inserted successfully because of this error ---> ". mysqli_error($conn);
  } 
}
}
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">


  <title>ipharma - Manage your pharmacy</title>

</head>

<body style="background-color:orange;">
 

  <!-- Edit Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header"style="background-color:orange;">
          <h5 class="modal-title" id="editModalLabel">Edit this Medicine</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="/pharmacy_management/manage_medicines.php" method="POST"style="background-color:yellowgreen;">
          <div class="modal-body">
            <input type="hidden" name="snoEdit" id="snoEdit">
            <div class="form-group">
              <label for="medi_id">Medicine id</label>
              <input type="text" class="form-control" id="medi_idEdit" name="medi_idEdit" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
              <label for="medi_type">Medicine Type</label>
              <input type="text" class="form-control" id="medi_typeEdit" name="medi_typeEdit" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
              <label for="medi_name">Medicine Name</label>
              <input type="text" class="form-control" id="medi_nameEdit" name="medi_nameEdit" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
              <label for="medi_company_name">Medicine Company Name</label>
              <input type="text" class="form-control" id="medi_company_nameEdit" name="medi_company_nameEdit" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
              <label for="medi_cost">Medicine Cost</label>
              <input type="text" class="form-control" id="medi_costEdit" name="medi_costEdit" aria-describedby="emailHelp">
            </div>

          </div>
          <div class="modal-footer d-block mr-auto">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#"><img src="/crud/logo.svg" height="28px" alt=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact Us</a>
        </li>

      </ul>
       <button type="button" style='margin-right:16px' class="btn btn-outline-success "><a href="/pharmacy_management/manage_pharmacist.php">Manage Pharmacist</a></button>       
      <button type="button" style='margin-right:16px' class="btn btn-outline-success "><a href="/pharmacy_management/manage_cashier.php">Manage cashier</a></button>       

      <?php
      echo '<button type="button" class="btn btn-outline-success ml-2"><a href="/pharmacy_management/logout.php">Logout</a></button>';
      ?>
    </div>
  </nav>

  <?php
  if($insert){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> medicine has been inserted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <?php
  if($delete){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Medicine has been deleted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <?php
  if($update){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Medicine has been updated successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <div class="container my-4"style="background-color:yellowgreen;">
    <h2>Add a Medicine to ipharma</h2>
    <form action="/pharmacy_management/manage_medicines.php" method="POST">
      <div class="form-group">
        <label for="medi_id">Medicine Id</label>
        <input type="text" class="form-control" id="medi_id" name="medi_id" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="medi_type">Medicine type</label>
        <input type="text" class="form-control" id="medi_type" name="medi_type" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="medi_name">Medicine name</label>
        <input type="text" class="form-control" id="medi_name" name="medi_name" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="medi_company_name">Medicine company name</label>
        <input type="text" class="form-control" id="medi_company_name" name="medi_company_name" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="medi_cost">Medicine cost</label>
        <input type="text" class="form-control" id="medi_cost" name="medi_cost" aria-describedby="emailHelp">
      </div>

      <button type="submit" class="btn btn-primary">Add Medicine</button>
    </form>
  </div>

  <div class="container my-4"style="background-color:yellowgreen;">


    <table class="table" id="myTable"style="background-color:wheat;">
      <thead>
        <tr>
          <th scope="col">S.No</th>
          <th scope="col">medicine Id</th>
          <th scope="col">medicine type</th>
          <th scope="col">medicine Name</th>
          <th scope="col">medicine company Name</th>
          <th scope="col">medicine Cost</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          $sql = "SELECT * FROM `medicines`";
          $result = mysqli_query($conn, $sql);
          $sno = 0;
          while($row = mysqli_fetch_assoc($result)){
            $sno = $sno + 1;
            echo "<tr>
            <th scope='row'>". $sno . "</th>
            <td>". $row['medi_id'] . "</td>
            <td>". $row['medi_type'] . "</td>
            <td>". $row['medi_name'] . "</td>
            <td>". $row['medi_company_name'] . "</td>
            <td>". $row['medi_cost'] . "</td>
            <td> <button class='edit btn btn-sm btn-primary' id=".$row['Srno'].">Edit</button> <button class='delete btn btn-sm btn-primary' id=d".$row['Srno'].">Delete</button>  </td>
          </tr>";
        } 
          ?>


      </tbody>
    </table>
  </div>
  <hr>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();

    });
  </script>
  <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        tr = e.target.parentNode.parentNode;
        medi_id = tr.getElementsByTagName("td")[0].innerText;
        medi_type = tr.getElementsByTagName("td")[1].innerText;
        medi_name = tr.getElementsByTagName("td")[2].innerText;
        medi_company_name = tr.getElementsByTagName("td")[3].innerText;
        medi_cost = tr.getElementsByTagName("td")[4].innerText;
        console.log(medi_id, medi_type,medi_name,medi_company_name,medi_cost);
        medi_idEdit.value = medi_id;
        medi_typeEdit.value = medi_type;
        medi_nameEdit.value = medi_name;
        medi_company_nameEdit.value = medi_company_name;
        medi_costEdit.value = medi_cost;
        snoEdit.value = e.target.id;
        console.log(e.target.id)
        $('#editModal').modal('toggle');
      })
    })

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        sno = e.target.id.substr(1);

        if (confirm("Are you sure you want to delete this medicine!")) {
          console.log("yes");
          window.location = `/pharmacy_management/manage_medicines.php?delete=${sno}`;
          // TODO: Create a form and use post request to submit a form
        }
        else {
          console.log("no");
        }
      })
    })
  </script>
  <?php include 'partials/_footer.php';?> 
</body>

</html>
