<?php
session_start();
include ('connection.php');
$name = $_SESSION['name'];
$id = $_SESSION['id'];
if(empty($id))
{
    header("Location: index.php"); 
}
if(isset($_REQUEST['sbt-vehicle']))
{
  $category = $_POST['category'];
  $brand_name = $_POST['brand'];
  $reg_no = $_POST['regno'];
  $owner_name = $_POST['name'];
  $owner_mobile = $_POST['mobile'];
  
  $insert_vehicle = mysqli_query($conn,"insert into tbl_vehicle set category='$category', brand_name='$brand_name', reg_no='$reg_no', owner_name='$owner_name', owner_mobile='$owner_mobile', in_time=now()");

if($insert_vehicle > 0)
{
  ?>
<script type="text/javascript">
    alert("Vehicle added successfully.")
</script>
<?php
}
}
?>
<?php include('include/header.php'); ?>
<div id="wrapper">
<?php include('include/side-bar.php'); ?>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Add New Vehicle</a>
          </li>
        </ol>

  <div class="card mb-3">
          <div class="card-header">
            <i class="fa fa-info-circle"></i>
            Submit Details</div>
             
      <form method="post" class="form-valide">
      <div class="card-body">
      <div class="form-group row">
      <label class="col-lg-4 col-form-label" for="category">Vehicle Category <span class="text-danger">*</span></label>
      <div class="col-lg-6">
      <select name="category" id="category" class="form-control" required>
       <option value="">Select Category</option>
       <?php
       $select_category = mysqli_query($conn,"select * from tbl_vehicle_category where status=1");
       while($cat = mysqli_fetch_array($select_category)){
       ?>
       <option><?php echo $cat['category']; ?></option>
       <?php } ?>
      </select>
      </div>
      </div>
      <div class="form-group row">
      <label class="col-lg-4 col-form-label" for="brand">Vehicle Brand Name <span class="text-danger">*</span></label>
       <div class="col-lg-6">
      <input type="text" name="brand" id="brand" class="form-control" placeholder="Enter Brand Name" required>
       </div>
      </div>
      <div class="form-group row">
      <label class="col-lg-4 col-form-label" for="registration">Registration Number <span class="text-danger">*</span></label>
       <div class="col-lg-6">
      <input type="text" name="regno" id="regno" class="form-control" placeholder="Enter Registration Number" required>
       </div>
      </div>
      <div class="form-group row">
      <label class="col-lg-4 col-form-label" for="name">Vehicle Owner's Name <span class="text-danger">*</span></label>
       <div class="col-lg-6">
      <input type="text" name="name" id="name" class="form-control" placeholder="Enter Owner's Name" required>
       </div>
      </div>
      <div class="form-group row">
      <label class="col-lg-4 col-form-label" for="mobile">Owner's Mobile No. <span class="text-danger">*</span></label>
       <div class="col-lg-6">
      <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Enter Mobile No." required>
       </div>
      </div>                                                         
      <div class="form-group row">
      <div class="col-lg-8 ml-auto">
      <button type="submit" name="sbt-vehicle" class="btn btn-primary">Submit</button>
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