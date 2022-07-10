<?php
$server="localhost";
$username="root";
$password="";
$database="users3";
$conn=mysqli_connect($server,$username,$password,$database);
if(!$conn){
//   echo "success";
//  }
// else{
    die("Error". mysqli_connect_error());
}
// $sql="INSERT INTO `users` (`username`, `password`, `date`) VALUES ('ram', 'ram123', current_timestamp())";
// mysqli_query($conn,$sql);

?>