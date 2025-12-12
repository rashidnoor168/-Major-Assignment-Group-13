<?php
session_start();
include('connection.php');

if(isset($_POST['login_btn'])) {
    $email = $_POST['email'];
    $pwd = md5($_POST['pwd']); // Keeping MD5 to match your existing database passwords
    
    // Use Prepared Statements to prevent SQL Injection
    $stmt = $conn->prepare("SELECT id, user_name FROM tbl_users WHERE emailid=? AND password=?");
    $stmt->bind_param("ss", $email, $pwd);
    $stmt->execute();
    $stmt->store_result();
    
    if($stmt->num_rows > 0) {
        $stmt->bind_result($userid, $username);
        $stmt->fetch();
        
        $_SESSION['id'] = $userid;
        $_SESSION['name'] = $username;
        
        header("Location: dashboard.php");
        exit();
    } else {
        echo "<script>alert('You have entered wrong email or password.');</script>";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Parking Management System</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="css/sb-admin.css" rel="stylesheet">
  <link href="css/custom_style.css?ver=1.1" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css' rel='stylesheet' />
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">
        <h2><center>Parking Management System (PMS)</center></h2>
      </div>
      <div class="card-body">
        <form name="login" method="post" action="">
          <div class="form-group">
            <div class="form-label-group">
              <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Email address" required="required" autofocus="autofocus">
              <label for="inputEmail">Email address</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="pwd" required="required">
              <label for="inputPassword">Password</label>
            </div>
          </div>
          <input type="submit" class="btn btn-success btn-block" name="login_btn" value="Login">
        </form>
      </div>
    </div>
  </div>
</body>
</html>
