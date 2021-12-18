<?php
include 'partials/_dbconnect.php';
session_start();
echo 
'
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand active" href="/iDisQus"><h3>iDisQus</h3></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="about.php">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact.php">Contact Us</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Categories
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          ';

$sql = "SELECT category_id, category_name FROM `categories` LIMIT 3";
$result = mysqli_query($connect, $sql);
while ($row = mysqli_fetch_assoc($result)) {
  echo
  '
  <li><a class="dropdown-item" href="threadlist.php?catid='. $row['category_id'] .'">'. $row['category_name'] .'</a></li>
  ';
}
          echo 
          '
          </ul>
          </ul>
          <div class="d-flex mx-auto">
              <form class="d-flex mx-auto" action="search.php" method="GET">
                <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
              </form>
          </div>
          ';

      if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
        echo 
        '
          <p class="text-light my-0 mx-2">Welcome '. $_SESSION['username']. ' </p>
          <a class="btn btn-primary  mx-0" href="partials/_logout.php">Log Out</a>
        ';
      }
      else{ 
        echo 
        '
        <div class="d-flex mx-0">
            <button class="btn btn-primary me-2" data-bs-toggle="modal"
            data-bs-target="#loginModal">Log In</button>
            <button class="btn btn-primary mx-0" data-bs-toggle="modal"
            data-bs-target="#signupModal">Sign Up</button>
        </div>
        ';
      }

echo 
'
    </div>
  </div>
</nav>
';

include 'partials/_loginModal.php';
include 'partials/_signupModal.php';
if (isset($_GET['loginsuccess']) && $_GET['loginsuccess']=="true") {
  echo 
  '
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> You are Logged In now.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  ';
}
if (isset($_GET['loginsuccess']) && $_GET['loginsuccess']=="false") {
  echo 
  '
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Warning!</strong> Incorrect Credentials!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  ';
}
if (isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="true") {
  echo 
  '
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> You can Log In now.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  ';
}
if (isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="false") {
  echo 
  '
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Warning!</strong> User Name / Email already exists!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  ';
}
?>