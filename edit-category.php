<?php
session_start();
include('connection.php');

$user_id = $_SESSION['id']; // Renamed to avoid conflict
if(empty($user_id)) {
    header("Location: index.php"); 
    exit();
}

// 1. Safe GET request handling
$cat_id = 0;
if(isset($_GET['id'])) {
    $cat_id = intval($_GET['id']); // Ensure it is an integer
}

// 2. Fetch Data using Prepared Statement
$stmt = $conn->prepare("SELECT * FROM tbl_vehicle_category WHERE id=?");
$stmt->bind_param("i", $cat_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_array();

// 3. Handle Form Submission
if(isset($_POST['sv-cat'])) {
    $category_name = $_POST['catname'];
    $description = $_POST['desc'];
    $status = $_POST['status'];

    // Update using Prepared Statement
    $update_stmt = $conn->prepare("UPDATE tbl_vehicle_category SET category=?, description=?, status=? WHERE id=?");
    $update_stmt->bind_param("sssi", $category_name, $description, $status, $cat_id);
    
    if($update_stmt->execute()) {
        ?>
        <script type="text/javascript">
            alert("Category Updated successfully.");
            window.location.href='view-category.php';
        </script>
        <?php
    } else {
        echo "<script>alert('Error updating category');</script>";
    }
}
?>

<?php include('include/header.php'); ?>
<div id="wrapper">
<?php include('include/side-bar.php'); ?>

    <div id="content-wrapper">
      <div class="container-fluid">

        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Edit Vehicle Category</a>
          </li>
        </ol>

        <div class="card mb-3">
          <div class="card-header">
            <i class="fa fa-info-circle"></i> Edit Details
          </div>
          
          <form method="post" class="form-valide">
            <div class="card-body">
              <div class="form-group row">
                <label class="col-lg-4 col-form-label" for="category">Vehicle Category <span class="text-danger">*</span></label>
                <div class="col-lg-6">
                  <input type="text" name="catname" id="catname" class="form-control" placeholder="Enter Category Name" required value="<?php echo htmlspecialchars($row['category']); ?>">
                </div>
              </div> 

              <div class="form-group row">
                <label class="col-lg-4 col-form-label" for="description">Description <span class="text-danger">*</span></label>
                <div class="col-lg-6">
                  <textarea class="form-control" name="desc" id="desc" placeholder="Enter Description" required><?php echo htmlspecialchars($row['description']); ?></textarea>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-lg-4 col-form-label" for="status">Status <span class="text-danger">*</span></label>
                <div class="col-lg-6">
                  <select class="form-control" id="status" name="status" required>
                    <option value="">Select Status</option>
                    <option value="1" <?php if($row['status'] == 1) { echo 'selected="selected"'; } ?>>Active</option>
                    <option value="0" <?php if($row['status'] == 0) { echo 'selected="selected"'; } ?>>Inactive</option>
                  </select>
                </div>    
              </div>                                       
              
              <div class="form-group row">
                <div class="col-lg-8 ml-auto">
                  <button type="submit" name="sv-cat" class="btn btn-primary">Save</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

<?php include('include/footer.php'); ?>
