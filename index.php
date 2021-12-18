<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Gestion des etudiants</title>
</head>
<body >
    <?php require_once("process.php"); ?>
    <?php
     if(isset($_SESSION['message'])): ?>
     <div class="alert alert-<?=$_SESSION['msg_type']?>">
    <?php 
    echo $_SESSION['message'];
    unset( $_SESSION['message']);
    ?>
    </div>
    <?php endif ?>
    <?php
    $mysqli = new mysqli('localhost:8012', 'root', 'password','crud') or die(mysqli_error($mysqli));
    $resault = $mysqli->query("SELECT * FROM info ") or die($mysqli->error);
    
    ?>

    <div class="container">
      <div class="row">
        <table class="table table-hover table-dark">
          <thead>
            <tr>
              <th >Name</th>
              <th>CIN</th>
              <th colspan="2">Action</th>
            </tr>
          </thead>
          <?php 
      while($row = $resault->fetch_assoc()):?>
            <tr>
              <td><<?php echo $row['name'];?>/td>
              <td><<?php echo $row['cin'];?>/td>
              <td>
                <a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">Edit</a>
                <a href="process.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
              </td>
            </tr>
        <?php endwhile;?>
        </table>
      </div>
    </div>
    <?php
      function pre_r($array){
        echo '<pre>';
        print_r($array);
        echo '</pre>';
      }
    ?>
    
    <div class="container content-justify-center text-light">
    <form action="/process.php" method="POST" class="row g-3" >
      <input type="hidden" name="id" value="<?php echo $id; ?>" >
  <div class="col-md-6">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control" id="name" value="<?php echo $name; ?>">
  </div>
  <div class="col-md-6">
    <label for="cin" class="form-label">CIN</label>
    <input type="text" class="form-control" id="cin" value="<?php echo $cin; ?>">
  </div>
 
  
  <div class="col-12">
    <?php
    if ($update == true): ?>
    <button type="submit" class="btn btn-info" name="update">Update</button>
    <?php else: ?>
    <button type="submit" class="btn btn-primary" name="save">Save</button>
    <?php endif; ?>
  </div> 
</form>
</div>

    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>