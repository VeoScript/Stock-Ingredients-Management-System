<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
  <title>Mac Burger Stock Ingredients Management System | Account Registration</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
    <script src="vendor/jquery-3.2.1.min.js" charset="utf-8"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js" charset="utf-8"></script>
  </head>
  <body>
    <?php include 'header.php'; ?>
    
    <!-- Code ni para sa pag Register ug Account -->
    <?php

      if(isset($_POST['account_register'])){

        $fullname = $_POST['fullname'];
        $age = $_POST['age'];
        $address = $_POST['address'];
        $position = $_POST['position'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $repassword = $_POST['repassword'];

        if(!DB::query('SELECT Fullname FROM account_registration WHERE Fullname=:Fullname', array(':Fullname'=>$fullname))){

          if($password === $repassword){
            DB::query('INSERT INTO account_registration VALUES(:Fullname, :Age, :Address, :Position, :Username, :Password)',
                              array(':Fullname'=>$fullname, ':Age'=>$age, ':Address'=>$address, ':Position'=>$position, ':Username'=>$username, ':Password'=>$repassword));
            $success = "Registered Successfully!";
          }
          else{
            $alert = "Password did not match! Try again...";
          }
        }
        else{
          $alert = "This account is already registered!";
        }
      }
     ?>
    <div class="container">
      <div class="container-fluid">
        <h3>Account Registration</h3>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-sm-8">
            <div class="panel panel-default">
              <div class="panel-heading"><span class="fa fa-user"></span>&nbsp;&nbsp;Account Registration</div>
              <div class="panel-body">
                <?php
                      if(isset($alert)){
                          echo '
                              <div class="row">
                                  <div class="col-sm-12">
                                      <div class="alert alert-warning">
                                          <strong>Warning!</strong> &nbsp;'. $alert .'
                                      </div>
                                  </div>
                              </div>
                          ';
                      }

                      if(isset($success)){
                          echo '
                              <div class="row">
                                  <div class="col-sm-12">
                                      <div class="alert alert-success">
                                          <strong>Success!</strong> &nbsp;'. $success .'
                                      </div>
                                  </div>
                              </div>
                          ';
                      }
                  ?>
                <form class="form" action="account_registration.php" method="post">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="fullname">Fullname</label>
                      <input class="form-control" type="text" name="fullname" id="fullname" required>
                    </div>
                    <div class="form-group">
                      <label for="age">Age</label>
                      <input class="form-control" min="1" type="number" name="age" id="age" required>
                    </div>
                    <div class="form-group">
                      <label for="address">Address</label>
                      <input class="form-control" type="text"  name="address" id="address" required>
                    </div>
                    <div class="form-group">
                      <label for="position">Position</label>
                      <select class="form-control" id="position" name="position" required>
                        <option value=""></option>
                        <option value="ADMIN">ADMIN</option>
                        <option value="USER">USER</option>
                      </select>
                    </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="username">Username</label>
                        <input class="form-control" type="text" name="username" id="username" required>
                      </div>
                      <div class="form-group">
                        <label for="password">Password</label>
                        <input class="form-control" type="password" name="password" id="password" required>
                      </div>
                      <div class="form-group">
                        <label for="repassword">Re-enter Password</label>
                        <input class="form-control" type="password" name="repassword" id="repassword" required>
                      </div>
                      <div class="form-group">
                        <input class="form-control btn btn-danger" type="submit" name="account_register" id="account_register" value="Register">
                      </div>
                  </div>
                </form>
              </div>
          </div>
          </div>
        </div>
    </div>
  </body>
</html>
