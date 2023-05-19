<!DOCTYPE html> 
<html>
 <head>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script>
        function confirmDelete(categoryId) {
            if (confirm("Are you sure you want to delete this category?")) {
                window.location.href = "display_table.php?delete_id=" + categoryId;
            }
        }
    </script> 

  
 </head>
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

  <body>
    <?php
    require_once "dbconfig.php";

    // Check if delete request is received
    if (isset($_GET['delete_id'])) {
        $deleteId = $_GET['delete_id'];
        $sql = "DELETE FROM category WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $deleteId);
        $stmt->execute();

        // Redirect to the same page with a success message
        
        header("Location: display_table.php?msg=Category deleted successfully");
        exit();
    }

    if (isset($_REQUEST['msg'])) {
        ?>
        <h4><?php echo $_REQUEST['msg']; ?></h4>
        <?php
    }

    // Handle form submission for editing a category
    if (isset($_POST['edit_id'])) {
        $editId = $_POST['edit_id'];
        $name = $_POST['name'];
        $status = $_POST['status'];

        $sql = "UPDATE category SET name = :name, status = :status WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':status', $status);
        $stmt->bindValue(':id', $editId);
        $stmt->execute();

        // Redirect to the same page with a success message
        header("Location: display_table.php?msg=Category updated successfully");
        exit();
    }
    ?>

    <table class="table table-bordered border-primary">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Status</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM category";
            $res = $conn->query($sql);
            if ($res->rowCount() > 0) {
                while ($row = $res->fetch()) {
                    ?>
                    <tr class="active-row">
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row["name"]; ?></td>
                        <td><?php echo $row["status"]; ?></td>
                        <td>
                            <form method="POST" action="edit_category.php">
                                <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                                <input type="submit" class="btn btn-primary" value="Edit">
                            </form>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger" onclick="confirmDelete(<?php echo $row['id']; ?>)">Delete</button>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
        </tbody>
    </table>
  </body>
</html>