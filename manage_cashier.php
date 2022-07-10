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
  $sql = "DELETE FROM `cashier` WHERE `cashier`.`Srno` =$sno";
  $result = mysqli_query($conn, $sql);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
if (isset( $_POST['snoEdit'])){
  // Update the record
    $sno = $_POST["snoEdit"];
    $ch_name = $_POST["ch_nameEdit"];
    $ch_experience = $_POST["ch_experienceEdit"];
    $phone= $_POST["phoneEdit"];
    $email = $_POST["emailEdit"];
    $address = $_POST["addressEdit"];
  // Sql query to be executed
  // $sql = "UPDATE `pharmacist` SET `ph_name` =  $ph_name , `ph_experience ` = '$ph_experience ' WHERE `pharmacist`.`Srno` = $sno";
  $sql="UPDATE `cashier` SET `ch_name` = '$ch_name', `ch_experience` = '$ch_experience', `phone` = '$phone', `email` = '$email', `address` = '$address' 
  WHERE `cashier`.`Srno` = $sno"; 
  $result = mysqli_query($conn, $sql);
  if($result){
    $update = true;
}
else{
    echo "We could not update the record successfully";
}
}
else{
    $ch_name = $_POST["ch_name"];
    $ch_experience = $_POST["ch_experience"];
    $phone= $_POST["phone"];
    $email = $_POST["email"];
    $address = $_POST["address"];

  // Sql query to be executed
  //$sql = "INSERT INTO `pharmacist` (`ph_name`, `ph_experience`) VALUES ('$ph_name', '$ph_experience')";
  $sql="INSERT INTO `cashier` ( `ch_name`, `ch_experience`, `phone`, `email`, `address`, `date_join`) VALUES
   ( '$ch_name', ' $ch_experience', '$phone', '$email', '$address', current_timestamp())";
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
          <h5 class="modal-title" id="editModalLabel"style="background-color:white;">Edit this Cashier</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="/pharmacy_management/manage_cashier.php" method="POST"style="background-color:yellowgreen;">
          <div class="modal-body">
            <input type="hidden" name="snoEdit" id="snoEdit">
            <div class="form-group">
              <label for="ph_name">cashier name</label>
              <input type="text" class="form-control" id="ch_nameEdit" name="ch_nameEdit" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
              <label for="ch_experience">cashier experience</label>
              <input type="text" class="form-control" id="ch_experienceEdit" name="ch_experienceEdit" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
              <label for="phone">cashier phone</label>
              <input type="text" class="form-control" id="phoneEdit" name="phoneEdit" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
              <label for="email">chashier email</label>
              <input type="text" class="form-control" id="emailEdit" name="emailEdit" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
              <label for="address">chashier address</label>
              <input type="text" class="form-control" id="addressEdit" name="addressEdit" aria-describedby="emailHelp">
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
       <button type="button"style='margin-right:16px' class="btn btn-outline-success "><a href="/pharmacy_management/manage_madicines.php">Manage Medicine</a></button>
       <button type="button" style='margin-right:16px'class="btn btn-outline-success "><a href="/pharmacy_management/manage_pharmacist.php">Manage Pharmacist</a></button>

      <?php
      echo '<button type="button" class="btn btn-outline-success ml-2"><a href="/pharmacy_management/logout.php">Logout</a></button>';
      ?>
    </div>
  </nav>

  <?php
  if($insert){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong>cashier has been inserted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <?php
  if($delete){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> cashier has been deleted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <?php
  if($update){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> chashier has been updated successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <div class="container my-4" style="background-color:yellowgreen;">
    <h2>Add a Cashier to ipharma</h2>
    <form action="/pharmacy_management/manage_cashier.php" method="POST">
      <div class="form-group">
        <label for="ch_name">cashier name</label>
        <input type="text" class="form-control" id="ch_name" name="ch_name" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="ch_experience">cashier experience</label>
        <input type="text" class="form-control" id="ch_experience" name="ch_experience" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="phone">cashier phone</label>
        <input type="text" class="form-control" id="phone" name="phone" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="email">cashier email</label>
        <input type="text" class="form-control" id="email" name="email" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="address">cashier address</label>
        <input type="text" class="form-control" id="address" name="address" aria-describedby="emailHelp">
      </div>

      
      <button type="submit" class="btn btn-primary">Add cashier</button>
    </form>
  </div>

  <div class="container my-4" style="background-color:yellowgreen;">


    <table class="table" id="myTable" style="background-color:wheat;">
      <thead>
        <tr>
          <th scope="col">S.No</th>
          <th scope="col">cashier Name</th>
          <th scope="col">cashier experience</th>
          <th scope="col">cashier phone</th>
          <th scope="col">cashier email</th>
          <th scope="col">cashier address</th>
          <th scope="col">date of Join</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          $sql = "SELECT * FROM `cashier`";
          $result = mysqli_query($conn, $sql);
          $sno = 0;
          while($row = mysqli_fetch_assoc($result)){
            $sno = $sno + 1;
            echo "<tr>
            <th scope='row'>". $sno . "</th>
            <td>". $row['ch_name'] . "</td>
            <td>". $row['ch_experience'] . "</td>
            <td>". $row['phone'] . "</td>
            <td>". $row['email'] . "</td>
            <td>". $row['address'] . "</td>
            <td>". $row['date_join'] . "</td>
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
        ch_name = tr.getElementsByTagName("td")[0].innerText;
        ch_experience = tr.getElementsByTagName("td")[1].innerText;
        phone = tr.getElementsByTagName("td")[2].innerText;
        email = tr.getElementsByTagName("td")[3].innerText;
        address = tr.getElementsByTagName("td")[4].innerText;
        console.log(ch_name, ch_experience,phone,email,address);
        ch_nameEdit.value = ch_name;
        ch_experienceEdit.value = ch_experience;
        phoneEdit.value = phone;
        emailEdit.value = email;
        addressEdit.value = address;
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

        if (confirm("Are you sure you want to delete this cashier!")) {
          console.log("yes");
          window.location = `/pharmacy_management/manage_cashier.php?delete=${sno}`;
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
