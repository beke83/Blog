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

    <title>Happy Blog - Comments</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="assets/stylesheet" href="css/blog.css">
    <link rel="assets/stylesheet" href="css/bootstrap.css">



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
                <a class="nav-link active" href="categories.php">
                    <i class="fas fa-fw fa-comment"></i>
                    <span>Comments</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Live Blog</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="logout.php">
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
                                    <li><a href="blog.php">Home</a></li>
                                    <li><a href="blog.php">About</a></li>
                                    <li><a href="blog.php">Portfolio</a></li>
                                    <li class="menu-has-children"><a href="blog.php">Pages</a>
                                        <ul class="dark">
                                            <li><a href="blog.php">Elements</a></li>
                                            <li><a href="blog.php">Contact</a></li>
                                            <li><a href="blog.php">Service</a></li>
                                            <li><a href="blog.php">Portfolio Details</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="login.php" data-toggle="modal" data-target="blog.phplogoutModal">
                                            Login
                                        </a>
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
                        <h1 class="h3 mb-0 text-gray-800">Un-Approved Comments</h1>
                    </div>
                    <!-- /.container-fluid -->

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-stripped" id="dataTable" width="100%" cellspacing="0">
                                <tr>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Comment</th>
                                    <th>Approve</th>
                                    <th>Delete Comment</th>
                                    <th>Details</th>
                                </tr>
                                <?php
                                global $Connection;
                                $Query = "SELECT * FROM comments WHERE status='OFF' ORDER BY id desc";
                                $Execute = mysqli_query($Connection, $Query);
                                $SrNo = 0;
                                while ($DataRows = mysqli_fetch_array($Execute)) {

                                    $CommentId = $DataRows["id"];
                                    $DateTimeOfComment = $DataRows["datetime"];
                                    $PersonName = $DataRows["name"];
                                    $PersonComment = $DataRows["comment"];
                                    $CommentedPostId = $DataRows["admin_panel_id"];
                                    $SrNo++;
                                    if (strlen($PersonComment) > 18) {
                                        $PersonComment = substr($PersonComment, 0, 18) . '...';
                                    }
                                    if (strlen($PersonName) > 10) {
                                        $PersonName = substr($PersonName, 0, 10) . '...';
                                    }
                                ?>

                                    <tr>
                                        <td><?php echo htmlentities($SrNo); ?></td>
                                        <td style="color: blue"><?php echo htmlentities($PersonName); ?></td>
                                        <td><?php echo htmlentities($DateTimeOfComment); ?></td>
                                        <td><?php echo htmlentities($PersonComment); ?></td>
                                        <td><a href="approveComments.php?id=<?php echo $CommentId; ?>">
                                                <span class="btn btn-success btn-sm btn-block">Approve</span></a>
                                        </td>
                                        <td><a href="deleteComments.php?id=<?php echo $CommentId; ?>">
                                                <span class="btn btn-danger btn-sm btn-block">Delete</span></a>
                                        </td>
                                        <td>
                                            <a href="fullBlogPost.php?id=<?php echo $CommentedPostId; ?>" target="_blank">
                                                <span class="btn btn-primary btn-sm btn-block">Live Preview</span></a></td>
                                    </tr>

                                <?php } ?>
                            </table>
                        </div>
                    </div>

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Approved Comments</h1>
                    </div>
                    <!-- /.container-fluid -->

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-stripped" id="dataTable" width="100%" cellspacing="0">
                                <tr>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Comment</th>
                                    <th>Approved by</th>
                                    <th>Revert Approve</th>
                                    <th>Delete Comment</th>
                                    <th>Details</th>
                                </tr>
                                <?php
                                global $Connection;
                                $Admin = "Beke Ben";
                                $Query = "SELECT * FROM comments WHERE status='ON' ORDER BY id desc";
                                $Execute = mysqli_query($Connection, $Query);
                                $SrNo = 0;
                                while ($DataRows = mysqli_fetch_array($Execute)) {

                                    $CommentId = $DataRows["id"];
                                    $DateTimeOfComment = $DataRows["datetime"];
                                    $PersonName = $DataRows["name"];
                                    $PersonComment = $DataRows["comment"];
                                    $ApprovedBy = $DataRows["approvedby"];
                                    $CommentedPostId = $DataRows["admin_panel_id"];
                                    $SrNo++;

                                    if (strlen($PersonComment) > 18) {
                                        $PersonComment = substr($PersonComment, 0, 18) . '...';
                                    }
                                    if (strlen($PersonName) > 10) {
                                        $PersonName = substr($PersonName, 0, 10) . '...';
                                    }


                                ?>

                                    <tr>
                                        <td><?php echo htmlentities($SrNo); ?></td>
                                        <td style="color: blue"><?php echo htmlentities($PersonName); ?></td>
                                        <td><?php echo htmlentities($DateTimeOfComment); ?></td>
                                        <td><?php echo htmlentities($PersonComment); ?></td>
                                        <td><?php echo htmlentities($ApprovedBy); ?></td>
                                        <td><a href="disapproveComments.php?id=<?php echo $CommentId; ?>">
                                                <span class="btn btn-warning btn-sm btn-block">Dis-Approve</span></a>
                                        </td>
                                        <td><a href="deleteComments.php?id=<?php echo $CommentId; ?>">
                                                <span class="btn btn-danger btn-sm btn-block">Delete</span></a>
                                        </td>
                                        <td>
                                            <a href="fullBlogPost.php?id=<?php echo $CommentedPostId; ?>" target="_blank">
                                                <span class="btn btn-primary btn-sm btn-block">Live Preview</span></a></td>
                                    </tr>

                                <?php } ?>
                            </table>
                        </div>
                    </div>


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
        <a class="scroll-to-top rounded" href="blog.phppage-top">
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
                        <a class="btn btn-primary" href="login.html">Logout</a>
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