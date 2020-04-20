<?php require_once("Include/session.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php require_once("Include/db.php"); ?>
<?php confirm_login(); ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Happy Blog - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/blog.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">



</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Happy Blog</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="dashboard.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="addNewPost.php">
                    <i class="fas fa-fw fa-list-alt"></i>
                    <span>Add New Post</span></a>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="categories.php">
                    <i class="fas fa-fw fa-tags"></i>
                    <span>Categories</span></a>
            </li>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="categories.php">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Manage Admin</span></a>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="comments.php">
                    <i class="fas fa-fw fa-comment"></i>
                    <span>Comments
                    <?php
                $Connection;
                $QueryTotal = "SELECT COUNT(*) FROM comments WHERE status = 'OFF'  ";
                $ExecuteTotal =  mysqli_query($Connection, $QueryTotal);
                $RowsTotal = mysqli_fetch_array($ExecuteTotal);

                $Total = array_shift($RowsTotal);
                if ($Total > 0) {
                ?>
                    <span class="btn btn-warning btn-sm" style="margin-left: 50px">
                        <?php echo $Total;   ?>
                    </span>

                <?php } ?>
                    </span></a>
                
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="blog.php" target="_blank">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Live Blog</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-fw fa-sign-out-alt"></i>
                    <span>Logout</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand topbar mb-4 static-top shadow" style="background-color: #222222">
                    <div class="container main-menu">
                        <div class="row align-items-center d-flex">
                            <nav id="nav-menu-container" class="ml-auto">
                                <ul class="nav-menu white">
                                    <li><a href="#">Home</a></li>
                                    <li><a href="#">About</a></li>
                                    <li><a href="#">Portfolio</a></li>
                                    <li class="menu-has-children"><a href="#">Pages</a>
                                        <ul class="dark">
                                            <li><a href="#">Elements</a></li>
                                            <li><a href="#">Contact</a></li>
                                            <li><a href="#">Service</a></li>
                                            <li><a href="#">Portfolio Details</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="blog.php" target="_blank">Blog</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="row">
                        <div><?php echo Message();
                                echo SuccessMessage();
                                ?> </div>
                    </div>

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-stripped" id="dataTable" width="100%" cellspacing="0">
                                <tr>
                                    <th>Id</th>
                                    <th>Post Title</th>
                                    <th>Date Time</th>
                                    <th>Author</th>
                                    <th>Category</th>
                                    <th>Banner</th>
                                    <th>Comments</th>
                                    <th>Action</th>
                                    <th>Details</th>
                                </tr>
                                <?php
                                global $Connection;
                                $ViewQuery = "SELECT * FROM admin_panel ORDER BY id desc";
                                $Execute = mysqli_query($Connection, $ViewQuery);
                                $SrNo = 0;
                                while ($DataRows = mysqli_fetch_array($Execute)) {

                                    $Id = $DataRows["id"];
                                    $DateTime = $DataRows["datetime"];
                                    $Title = $DataRows["title"];
                                    $Category = $DataRows["category"];
                                    $Admin = $DataRows["author"];
                                    $Image = $DataRows["image"];
                                    $Post = $DataRows["post"];
                                    $SrNo++;

                                ?>

                                    <tr>
                                        <td><?php echo $SrNo; ?></td>
                                        <td style="color: blue"><?php
                                                                if (strlen($Title) > 20) {
                                                                    $Title = substr($Post, 0, 20) . '...';
                                                                }
                                                                echo $Title; ?></td>
                                        <td><?php

                                            if (strlen($DateTime) > 11) {
                                                $DateTime = substr($DateTime, 0, 11) . '...';
                                            }

                                            echo $DateTime; ?></td>
                                        <td><?php

                                            if (strlen($Admin) > 6) {
                                                $Admin = substr($Admin, 0, 6) . '...';
                                            }

                                            echo $Admin; ?></td>
                                        <td><?php

                                            if (strlen($Category) > 8) {
                                                $Category = substr($Category, 0, 8) . '...';
                                            }
                                            echo $Category; ?></td>
                                        <td><img src="upload/<?php echo $Image; ?>" width="150px" height="50px"></td>

                                        <td>

                                        
                                        <?php
                                            $Connection;
                                            $QueryApproved = "SELECT COUNT(*) FROM comments WHERE admin_panel_id = '$Id' AND status = 'ON'  ";
                                            $ExecuteApproved =  mysqli_query($Connection, $QueryApproved);
                                            $RowsApproved = mysqli_fetch_array($ExecuteApproved);

                                            $TotalApproved = array_shift($RowsApproved);
                                            if ($TotalApproved > 0) {
                                            ?>
                                                <span class="btn btn-success btn-sm" style="margin-left:0px">
                                                    <?php echo $TotalApproved;   ?>
                                                </span>
                                            <?php } ?>


                                           

 
                                        <?php
                                            $Connection;
                                            $QueryUnApproved = "SELECT COUNT(*) FROM comments WHERE admin_panel_id = '$Id' AND status = 'OFF'  ";
                                            $ExecuteUnApproved =  mysqli_query($Connection, $QueryUnApproved);
                                            $RowsUnApproved = mysqli_fetch_array($ExecuteUnApproved);

                                            $TotalUnApproved = array_shift($RowsUnApproved);
                                            if ($TotalUnApproved > 0) {
                                            ?>
                                                <span class="btn btn-danger btn-sm" style="margin-left:50px">
                                                    <?php echo $TotalUnApproved;   ?>
                                                </span>

                                            <?php } ?>

                                        </td>

                                        <td><a href="editPost.php?Edit=<?php echo $Id; ?>">
                                                <span class="btn btn-warning">Edit </span></a>

                                            <a href="deletePost.php?Delete=<?php echo $Id; ?>">
                                                <span class="btn btn-danger">Delete</span></a>
                                        </td>
                                        <td>
                                            <a href="fullBlogPost.php?id=<?php echo $Id; ?>" target="_blank">
                                                <span class="btn btn-primary">Live Preview</span></a></td>
                                    </tr>

                                <?php } ?>
                            </table>
                        </div>
                    </div>


                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Your Website 2019</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="login.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="assets/vendor/jquery/jquery.min.js"></script>
        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="assets/js/sb-admin-2.min.js"></script>
        <script src="assets/js/main.js"></script>

</body>

</html>