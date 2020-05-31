<?php
$filepath = realpath(dirname(__FILE__));
include_once $filepath.'/lib/Database.php';
$db = new Database();
$msg = '';
//Insert Data to database
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = mysqli_real_escape_string($db->link, $_POST['name']);
  $message = mysqli_real_escape_string($db->link, $_POST['message']);
  if (empty($name) or empty($message)) {
    $msg = '<div class="alert alert-danger">Field Must Not be empty</div>';
  }else{
    date_default_timezone_set('Asia/Dhaka');
    $time = date('h:i:s a', time());
    $query = "INSERT INTO tbl_chat(name, message, time) VALUES('$name', '$message', '$time')";
    $insert = $db->insert($query);
    echo $insert;
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Chat System Using PHP oop and Mysql</title>
  </head>
  <body>
    <div class="container">
      <!-- header start -->
      <div class="card">
        <div class="card-header">
          <h3 class="text-center font-weight-bold">Basic Chat Box With PHP OOP & Mysql</h3>
        </div>
        <div class="card-body">
          <?php
          if (isset($msg)) {
          echo $msg;
          }
          ?>
          <div class="message m-auto">
            <ul>
              <?php
              $query = "SELECT * FROM tbl_chat ORDER BY id DESC";
              $selected_row = $db->select($query);
              while ($data = $selected_row->fetch_assoc()) {
              
              ?>
              <li><?php echo $data['time']; ?> - <strong><?php echo $data['name']; ?></strong> <?php echo $data['message']; ?></li>
              <?php
              }
              ?>
            </ul>
          </div>
          <div class="whitespace mt-2">
            
          </div>
          <div class="input m-auto">
            <div class="input-wrapper pl-3 pr-3 pt-1 pb-1">
              <form action="" method="post">
                <div class="form-group row">
                  <label for="name" class="col-2 font-weight-bold">Name</label>
                  <input type="text" class="form-control col-10" name="name" id="name" placeholder="Enter Your Name Here">
                </div>
                <div class="form-group row">
                  <label for="message" class="col-2 font-weight-bold">Message</label>
                  <textarea name="message" id="message" class="form-control col-10" cols="30" rows="5"></textarea>
                </div>
                <input type="submit" class="btn btn-success" value="Submit">
              </form>
            </div>
            
          </div>
        </div>
        <div class="card-footer">
          <h4 class="text-center font-weight-bold">Developed By <a href="http://facebook.com/developer.alam">Md Alam</a></h4>
        </div>
      </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>