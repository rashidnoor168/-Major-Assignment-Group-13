<?php
session_start();
include('connection.php');

$user_id = $_SESSION['id'];
if (empty($user_id)) {
    header("Location: index.php");
    exit();
}

// 1. Safe Delete Logic (Moved to top & using Prepared Statements)
if (isset($_GET['ids'])) {
    $delete_id = intval($_GET['ids']); // Ensure ID is an integer
    
    $stmt = $conn->prepare("DELETE FROM tbl_vehicle_category WHERE id = ?");
    $stmt->bind_param("i", $delete_id);
    
    if ($stmt->execute()) {
        echo "<script>alert('Category deleted successfully'); window.location.href='view-category.php';</script>";
    } else {
        echo "<script>alert('Error deleting category');</script>";
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
                    <a href="#">View Vehicle Category</a>
                </li>
            </ol>

            <div class="card mb-3">
                <div class="card-header">
                    <i class="fa fa-info-circle"></i> View Details
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $select_query = mysqli_query($conn, "select * from tbl_vehicle_category");
                                $sn = 1;
                                while ($row = mysqli_fetch_array($select_query)) {
                                ?>
                                    <tr>
                                        <td><?php echo $sn; ?></td>
                                        <td><?php echo htmlspecialchars($row['category']); ?></td>
                                        <td><?php echo htmlspecialchars($row['description']); ?></td>
                                        <td>
                                            <?php if ($row['status'] == 1) { ?>
                                                <span class="badge badge-success">Active</span>
                                            <?php } else { ?>
                                                <span class="badge badge-danger">Inactive</span>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <a href="edit-category.php?id=<?php echo $row['id']; ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a href="view-category.php?ids=<?php echo $row['id']; ?>" onclick="return confirmDelete()"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                        </td>
                                    </tr>
                                <?php $sn++; } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<?php include('include/footer.php'); ?>

<script language="JavaScript" type="text/javascript">
    function confirmDelete() {
        return confirm('Are you sure want to delete this Category?');
    }
</script>
