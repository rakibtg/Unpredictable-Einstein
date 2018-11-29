<?php
  chmod('./db/', 0777);
  // Create new poop.
  if(isset($_GET['status'])) {
    $status = $_GET['status'];
    file_put_contents('./db/'.uniqid(), $status);
    header('Location: /');
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Poops</title>
</head>
<style type="text/css">
  input.status {
    width: 300px;
  }
</style>
<body>

  <h3>Welcome to Poops</h3>
  <p>A carefully currated list of your public poops.</p>

  <p>
    <form method="get" action="/">
      <input type="submit" name="action" value="New Poop">
      <input type="submit" name="action" value="Forget Everything">
    </form>
  </p>

  <?php 
    if(isset($_GET['action'])) {
      $action = $_GET['action'];
      if($action === 'New Poop') { ?>
        <form>
          <input class="status" type="text" name="status" placeholder="Whats on your mind">
          <input type="submit" name="button" value="Submit">
        </form>
      <?php } else if($action === 'Forget Everything') {
        array_map('unlink', glob('./db/*'));
        echo '<p>No poops now!</p>';
      }
    }
    // read all files
    $files = array_diff(scandir('./db'), array('.', '..'));
    $data = [];
    echo '<ul>';
    foreach ($files as $key => $value) {
      echo '<li>'.file_get_contents('./db/'.$value).'</li>';
    }
    echo '</ul>';
  ?>
  
</body>
</html>
