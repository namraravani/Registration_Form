<!DOCTYPE html>
<html>
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <style>
    .center-form {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .form-control {
      width: 200px;
    }
    .form-label {
      padding-top: 10px;
    }
    
    h1 {
      text-align: center;
      margin-bottom: 10%;
    }
    .form-container {
      border: 1px solid #ccc;
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
      padding: 20px;
      max-width: 400px;
      margin: 0 auto;
      border-radius: 10%;
    }

    #submit-btn {
      background-color: green;
      margin-left: 35%;
      margin-right:5%;
    }
  </style>
</head>
<body>
  <div class="center-form">
    <div class="form-container">
      <h1>Edit Category</h1>
      <form action="display_table.php" method="POST">
        <?php
        require_once "dbconfig.php";

        if(isset($_POST['edit_id'])){
            $editId = $_POST['edit_id'];
            
            // Retrieve the category data from the database based on the edit ID
            $sql = "SELECT * FROM category WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id', $editId);
            $stmt->execute();
            
            if($stmt->rowCount() > 0){
                $category = $stmt->fetch(PDO::FETCH_ASSOC);
                $name = $category['name'];
                $status = $category['status'];
                
                // Display the edit form
                ?>
                <div class="mb-3">
                  <label for="inputname" class="form-label">Name</label>
                  <select class="form-select" name="name" id="inputname">
                    <option selected disabled>Select Name</option>
                    <option value="option1" <?php if($name == 'option1') echo 'selected'; ?>>Option 1</option>
                    <option value="option2" <?php if($name == 'option2') echo 'selected'; ?>>Option 2</option>
                    <option value="option3" <?php if($name == 'option3') echo 'selected'; ?>>Option 3</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="inputstatus" class="form-label">Status</label>
                  <select class="form-select" name="status" id="inputstatus">
                    <option selected disabled>Select Status</option>
                    <option value="Available" <?php if($status == 'Available') echo 'selected'; ?>>Available</option>
                    <option value="not_Available" <?php if($status == 'not_Available') echo 'selected'; ?>>Not_Available</option>
                  </select>
                </div>
                <input type="hidden" name="edit_id" value="<?php echo $editId; ?>">
                <div class="d-grid gap-2">
                  <button type="submit" class="btn btn-primary" id="submit-btn">Update</button>
                </div>
                <div class="d-grid gap-2 mt-2">
                  <a href="display_table.php" class="btn btn-outline-danger">Cancel</a>
                </div>
                <?php
            }
            else{
                // If the category with the specified edit ID doesn't exist, display an error message
                echo "Category not found.";
            }
        }
        ?>
      </form>
    </div>
  </div>
</body>
</html>