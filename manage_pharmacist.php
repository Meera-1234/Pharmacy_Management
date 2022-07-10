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
  $sql = "DELETE FROM `pharmacist` WHERE `Srno` = $sno";
  $result = mysqli_query($conn, $sql);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
if (isset( $_POST['snoEdit'])){
  // Update the record
    $sno = $_POST["snoEdit"];
    $ph_name = $_POST["ph_nameEdit"];
    $ph_experience = $_POST["ph_experienceEdit"];

  // Sql query to be executed
  // $sql = "UPDATE `pharmacist` SET `ph_name` =  $ph_name , `ph_experience ` = '$ph_experience ' WHERE `pharmacist`.`Srno` = $sno";
  $sql="UPDATE `pharmacist` SET `ph_name` = '$ph_name', `ph_experience` = '$ph_experience' WHERE `pharmacist`.`Srno` = $sno";
  $result = mysqli_query($conn, $sql);
  if($result){
    $update = true;
}
else{
    echo "We could not update the record successfully";
}
}
else{
    $ph_name = $_POST["ph_name"];
    $ph_experience = $_POST["ph_experience"];

  // Sql query to be executed
  $sql = "INSERT INTO `pharmacist` (`ph_name`, `ph_experience`) VALUES ('$ph_name', '$ph_experience')";
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

<body style="background-color:black;">
 

  <!-- Edit Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header"style="background-color:black;">
          <h5 class="modal-title" id="editModalLabel"style="background-color:white;">Edit this pharmacist</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="/pharmacy_management/manage_pharmacist.php" method="POST"style="background-color:yellowgreen;">
          <div class="modal-body">
            <input type="hidden" name="snoEdit" id="snoEdit">
            <div class="form-group">
              <label for="ph_name">pharmacist name</label>
              <input type="text" class="form-control" id="ph_nameEdit" name="ph_nameEdit" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
              <label for="ph_experience">pharmacist experience</label>
              <input type="text" class="form-control" id="ph_experienceEdit" name="ph_experienceEdit" aria-describedby="emailHelp">
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

  <nav class="navbar navbar-expand-lg navbar bg">
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
       <button type="button"style='margin-right:16px' class="btn btn-outline-success "><a href="/pharmacy_management/manage_medicines.php">Manage Medicine</a></button>
      <button type="button" style='margin-right:16px'class="btn btn-outline-success "><a href="/pharmacy_management/manage_cashier.php">Manage cashier</a></button>

      <?php
      echo '<button type="button" class="btn btn-outline-success ml-2"><a href="/pharmacy_management/logout.php">Logout</a></button>';
      ?>
    </div>
  </nav>

  <?php
  if($insert){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong>pharmacist has been inserted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <?php
  if($delete){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> pharmacist has been deleted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <?php
  if($update){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> pharmacist has been updated successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <div class="container my-4" style="background-color:yellowgreen;">
    <h2>Add a pharmacist to ipharma</h2>
    <form action="/pharmacy_management/manage_pharmacist.php" method="POST">
      <div class="form-group">
        <label for="ph_name">pharmacist name</label>
        <input type="text" class="form-control" id="ph_name" name="ph_name" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="ph_experience">pharmacist experience</label>
        <input type="text" class="form-control" id="ph_experience" name="ph_experience" aria-describedby="emailHelp">
      </div>

      
      <button type="submit" class="btn btn-primary">Add pharmacis</button>
    </form>
  </div>

  <div class="container my-4" style="background-color:yellowgreen;">


    <table class="table" id="myTable" style="background-color:wheat;">
      <thead>
        <tr>
          <th scope="col">S.No</th>
          <th scope="col">pharmacist Name</th>
          <th scope="col">pharmacist experience</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          $sql = "SELECT * FROM `pharmacist`";
          $result = mysqli_query($conn, $sql);
          $sno = 0;
          while($row = mysqli_fetch_assoc($result)){
            $sno = $sno + 1;
            echo "<tr>
            <th scope='row'>". $sno . "</th>
            <td>". $row['ph_name'] . "</td>
            <td>". $row['ph_experience'] . "</td>
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
        ph_name = tr.getElementsByTagName("td")[0].innerText;
        ph_experience = tr.getElementsByTagName("td")[1].innerText;
        console.log(ph_name, ph_experience);
        ph_nameEdit.value = ph_name;
        ph_experienceEdit.value = ph_experience;
        snoEdit.value = e.target.id;
        console.log(e.target.id);
        $('#editModal').modal('toggle');
      })
    })

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        sno = e.target.id.substr(1);

        if (confirm("Are you sure you want to delete this pharmacist!")) {
          console.log("yes");
          window.location = `/pharmacy_management/manage_pharmacist.php?delete=${sno}`;
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
