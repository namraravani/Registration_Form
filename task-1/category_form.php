  
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
      <h1>Category</h1>
      <form action="add_data.php" method="POST">
        <div class="mb-3">
          <label for="inputname" class="form-label">Name</label>
          <select class="form-select" name="name" id="inputname">
            <option selected disabled>Select Name</option>
            <option value="option1">Option 1</option>
            <option value="option2">Option 2</option>
            <option value="option3">Option 3</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="inputstatus" class="form-label">Status</label>
          <select class="form-select" name="status" id="inputstatus">
            <option selected disabled>Select Status</option>
            <option value="Available">Available</option>
            <option value="not_Available">not_Available</option>
          </select>
        </div>
        <div class="d-grid gap-2">
          <button type="submit" class="btn btn-primary" id="submit-btn">Submit</button>
        </div>
        <div class="d-grid gap-2 mt-2">
          <a href="display_table.php" class="btn btn-info">View</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>