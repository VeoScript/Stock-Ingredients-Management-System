<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
  <title>Mac Burger Stock Ingredients Management System | Add Stock</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
    <script src="vendor/jquery-3.2.1.min.js" charset="utf-8"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js" charset="utf-8"></script>
  </head>
    <script>
        function Generate(){
          var quantity = document.getElementById('item_quantity').value;
          var set = document.getElementById('how_much').value;
          var sum = 0;

          sum = (quantity - set);

          document.getElementById('item_quantity').value = sum;

        }
    </script>
  <body>
    <?php include_once 'header.php'; ?>

    <!-- Code ni para sa pag select ug Item -->
    <?php  
      if(isset($_POST['select'])){
          $txtSelect = $_POST['txtSelect'];

          $getItemName = DB::query('SELECT ItemName FROM stock_ingredients WHERE ItemName=:ItemName', array(':ItemName'=>$txtSelect))[0]['ItemName'];
          $getItemCategory = DB::query('SELECT Category FROM stock_ingredients WHERE ItemName=:ItemName', array(':ItemName'=>$txtSelect))[0]['Category'];
          $getItemQuantity = DB::query('SELECT Quantity FROM stock_ingredients WHERE ItemName=:ItemName', array(':ItemName'=>$txtSelect))[0]['Quantity'];
      }
    ?>

    <!-- Code ni para sa pag update ng Quantity kung pila na lang nahabilin -->
    <?php 
      if(isset($_POST['setStock'])){

        $item_name = $_POST['item_name'];
        $item_quantity = $_POST['item_quantity'];
        $how_much = $_POST['how_much'];

        if($item_quantity < 0){
          $warning = "Sorry 0 Quantity | Out of Stock for this Item...";
        }
        else{

        DB::query('UPDATE stock_ingredients SET Quantity=:Quantity WHERE ItemName=:ItemName', array(':ItemName'=>$item_name, ':Quantity'=>$item_quantity));
        $success = "Stock Manager Update the Quantity of this Item...";
        }
        
      }
    ?>

    <div class="container">
      <div class="container-fluid">
        <h3>Stock Ingredients Manager</h3>
      </div>
    </div>

    <div class="container">
      <?php
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
      <?php
      if(isset($warning)){
          echo '
              <div class="row">
                  <div class="col-sm-12">
                      <div class="alert alert-warning">
                          <strong>Warning!</strong> &nbsp;'. $warning .'
                      </div>
                  </div>
              </div>
          ';
        }
      ?>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-sm-4">
          <div class="panel panel-default">
            <div class="panel-heading"><span class="fa fa-area-chart"></span>&nbsp;&nbsp;Stock Ingredients Manager</div>
            <div class="panel-body">
              <div class="col-sm-15">
                <form class="form-inline" action="stock_manager.php" method="POST">
                    <div class="form-group">
                      <label for="txt_search_category">Search Stock Category</label>
                      <select class="form-control" id="txt_search_category" name="txt_search_category" required>
                        <option value=""></option>
                        <option value="Bread">Bread</option>
                        <option value="Patty">Patty</option>
                        <option value="Vegetables">Vegetables</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <button class="btn btn-danger" type="submit" name="btn_search_category">Search</button>
                    </div>  
                </form>
              </div>
            </div>  
          </div>
        </div>

      <div class="col-sm-8">
        <div class="panel panel-danger">
          <div class="panel-heading"><span class="fa fa-globe"></span>&nbsp;&nbsp;Manage Section</div>
          <div class="panel-body">
            <form class="form" action="stock_manager.php" method="POST">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="item_name">Item Name</label>
                    <input class="form-control text-center" type="text" name="item_name" id="item_name" value="<?php  if(isset($getItemName)){echo $getItemName;} ?>" readonly>
                  </div>
                </div> 
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="item_quantity">Quantity</label>
                    <input class="form-control text-center" min="1" type="number" name="item_quantity" id="item_quantity" value="<?php  if(isset($getItemQuantity)){echo $getItemQuantity;} ?>" readonly>
                  </div>
                </div>  
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="how_much">How Much?</label>
                    <input class="form-control text-center" min="1" type="number" name="how_much" id="how_much" required>
                  </div>
                </div>  
                <div class="col-sm-12 text-center">
                  <div class="form-group">
                    <button class="btn btn-success" type="button" name="" onclick="Generate()">Generate</button>
                    <button class="btn btn-danger" type="submit" name="setStock">Set Stock</button>
                  </div>  
                </div>  
              </form>
          </div>
        </div>
      </div>  
      </div>

      <div class="col-sm-15">
        <div class="panel panel-danger" id="panel_table">
          <div class="panel-heading"><span class="fa fa-desktop"></span>&nbsp;&nbsp;Items List</div>
          <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Item Name</th>
                      <th>Item Category</th>
                      <th>Quantity</th>
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      if(isset($_POST['btn_search_category'])){

                          $txt_search_category = $_POST['txt_search_category'];

                          $posts_display = $mysqli->query("SELECT ItemName, Category, Quantity, Date FROM stock_ingredients WHERE Category='$txt_search_category' ORDER BY Id DESC");

                          while($posting = $posts_display->fetch_assoc()){
                            echo '
                                  <form action="" method="POST">
                                    <tr>
                                      <td><input id="readonly" type="text" name="txtSelect" value='. $posting['ItemName'] .' readonly></td>
                                      <td>'. $posting['Category'] .'</td>
                                      <td>'. $posting['Quantity'] .'</td>
                                      <td>'. $posting['Date'] .'</td>
                                      <td><button class="btn btn-info" type="submit" name="select">Select</button></td>
                                    </tr>
                                  </form>
                            ';
                          }
                      }
                    ?>
                  </tbody>
                </table>
              </div>   
          </div>  
        </div>
      </div>  
    </div>
  </body>
</html>
