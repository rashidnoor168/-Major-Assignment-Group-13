<?php
session_start();
include('connection.php');

$user_id = $_SESSION['id'];
if(empty($user_id)) {
    header("Location: index.php"); 
    exit();
}

if(isset($_POST['sbt-cat'])) {
    $catname = $_POST['vehcat'];
    $desc = $_POST['desc'];
    $status = $_POST['status'];
    
    // Use Prepared Statement for INSERT to prevent SQL Injection
    $stmt = $conn->prepare("INSERT INTO tbl_vehicle_category (category, description, status) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $catname, $desc, $status);

    if($stmt->execute()) {
        ?>
        <script type="text/javascript">
            alert("Category added successfully.");
            window.location.href='view-category.php'; // Redirect to view page
        </script>
        <?php
    } else {
        echo "<script>alert('Something went wrong. Please try again.');</script>";
    }
    $stmt->close();
}
?>

<?php include('include/header.php'); ?>
<div id="wrapper">
    <?php include('include/side-bar.php'); ?>

    <div id="content-wrapper">
        <div class="container-fluid">

            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Add Vehicle Category</a>
                </li>
            </ol>

            <div class="card mb-3">
                <div class="card-header">
                    <i class="fa fa-info-circle"></i> Submit Details
                </div>      
                
                <form method="post" class="form-valide">
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="category">Vehicle Category <span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <input type="text" name="vehcat" id="vehcat" class="form-control" placeholder="Enter Category Name" required>
                            </div>
                        </div> 
                        
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="description">Description <span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <textarea class="form-control" name="desc" id="desc" placeholder="Enter Description" required></textarea>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="status">Status <span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <select class="form-control" id="status" name="status" required>
                                    <option value="">Select Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>    
                        </div>                                       
                        
                        <div class="form-group row">
                            <div class="col-lg-8 ml-auto">
                                <button type="submit" name="sbt-cat" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>                  
        </div>
    </div>  
</div>
  
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<?php include('include/footer.php'); ?>
