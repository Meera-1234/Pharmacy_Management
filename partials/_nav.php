<?php 
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  $loggedin= true;
}
else{
  $loggedin = false;
}
echo '<nav class="navbar navbar-expand-lg navbar bg">
  <a class="navbar-brand" href="/pharmacy_management">ipharma</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/pharmacy_management/welcome.php">Home <span class="sr-only">(current)</span></a>
      </li>';

      if(!$loggedin){
      // echo '<li class="nav-item">
      //   <a class="nav-link" href="/pharmacy_management/login.php">Login</a>
      // </li>
      echo '<button type="button" class="btn btn-outline-success ml-2"><a href="/pharmacy_management/login.php">Login</a></button>';
      // <li class="nav-item">
      //   <a class="nav-link" href="/pharmacy_management/signup.php">Signup</a>
      // </li>';
      //echo '<button type="button" class="btn btn-outline-success ml-2"><a href="/pharmacy_management/signup.php">Signup</a></button>';
      }
      if($loggedin){
     
      //echo '<li class="nav-item">
        echo '<a class="nav-link" href="/pharmacy_management/manage_pharmacist.php">Manage Pharmacist</a>';
     // </li>';
      //echo '<li class="nav-item">
        echo '<a class="nav-link" href="/pharmacy_management/manage_medicines.php">Manage Medicine</a>';
        echo '<a class="nav-link" href="/pharmacy_management/manage_cashier.php">Manage cashier</a>';
      //</li>';
      // echo '<li class="nav-item">
      // <a class="nav-link" href="/pharmacy_management/logout.php">Logout</a>
      // </li>';
//echo '<button type="button" class="btn btn-outline-success "><a href="/pharmacy_management/logout.php">Logout</a></button>';
      
    //<button class="btn btn-outline-success mx-2"data-bs-toggle="modal" data-bs-target="#exampleModal" >signup</button>
    }
       
      
    echo '</ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>';
?>
