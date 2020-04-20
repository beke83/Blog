<?php require_once("Include/db.php"); ?>
<?php require_once("Include/session.php"); ?>
<?php require_once("Include/Functions.php"); ?>

<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/fav.png">
    <!-- Author Meta -->
    <meta name="author" content="colorlib">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title>Blog Home</title>

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,600,700,900" rel="stylesheet">
    <!--
			CSS
			============================================= -->
    <link rel="stylesheet" href="assets/css/linearicons.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">

    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.css">
    <link rel="stylesheet" href="assets/css/blog.css">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/Ben's.css" rel="stylesheet">


</head>

<body>

    <!-- Start Header Area -->
    <header id="header" class="dark">
        <div class="container main-menu">
            <div class="row align-items-center d-flex">
                <div id="logo">
                    <a href="blog.php?Page"><img src="img/logo2.png" alt="" title="" /></a>
                </div>
                <nav id="nav-menu-container" class="ml-auto">
                    <ul class="nav-menu white">
                        <li><a href="blog.php?Page">Home</a></li>
                        <li><a href="blog.php?Page">About</a></li>
                        <li><a href="blog.php?Page">Portfolio</a></li>
                        <li class="menu-has-children"><a href="blog.php?Page">Pages</a>
                        </li>
                        <li>
                            <a href="login.php">
                                Login
                            </a>
                        </li>
                        
                        <li class="active"><a href="blog.php?Page">Blog</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <!-- End Header Area -->

    <!-- start banner Area 
    <section class="banner-area re lative">
        <div class="container">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="about-content col-lg-12">
                    <h1 class="text-white">
                        Blog Home
                    </h1>
                    <p class="link-nav">
                        <span class="box">
                            <a href="blog.php">Home </a>
                            <a href="blog-home.html">Blog</a>
                        </span>
                </div>
            </div>
        </div>
    </section>-->
    <!-- End banner Area -->

    <!-- Start top-category-widget Area -->
    <!-- Start post-content Area -->


    <section class="section" style="margin-top:150px">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 ">
                    <div class="page-wrapper">
                        <div class="blog-custom-build">
                            <?php
                            global $Connection;
                            //Query when search button is active
                            if (isset($_GET["searchButton"])) {
                                $Search = $_GET["search"];
                                $ViewQuery = "SELECT * FROM admin_panel 
                                WHERE datetime LIKE '%$Search%' OR title LIKE '%$Search%' 
                                OR category LIKE '%$Search%' 
                                OR post LIKE '%$Search%' ORDER BY id desc ";

                                //Query when Category is active
                            } else if (isset($_GET["Category"])) {
                                $Category = $_GET["Category"];
                                $ViewQuery = "SELECT * FROM admin_panel WHERE category = '$Category' ORDER BY id desc";
                            } elseif (isset($_GET["Page"])) {
                                //Query when pagination is active i.e Blog.php?Page1
                                $Page = $_GET["Page"];
                                if ($Page == 0 || $Page < 1) {
                                    $showPostFrom = 0;
                                } else {
                                    $showPostFrom = ($Page * 6) - 6;
                                }
                                $ViewQuery = "SELECT * FROM admin_panel ORDER BY id desc
                                LIMIT $showPostFrom,6";
                            }
                            //default query for the blog.php page
                            else {
                                $ViewQuery = "SELECT * FROM admin_panel ORDER BY id desc
                                LIMIT 0,6";
                            }
                            $Execute = mysqli_query($Connection, $ViewQuery);
                            while ($DataRows = mysqli_fetch_array($Execute)) {
                                $PostId = $DataRows["id"];
                                $DateTime = $DataRows["datetime"];
                                $Title = $DataRows["title"];
                                $Category = $DataRows["category"];
                                $Image = $DataRows["image"];
                                $Post = $DataRows["post"];
                                $Author = $DataRows["author"];

                            ?>
                                <div class="blog-box">
                                    <div class="post-media">
                                        <a href="FullBlogPost.php?id=<?php echo $PostId; ?>" title="">
                                            <img src="upload/<?php echo $Image ?>" alt="" class="img-fluid">
                                            <div class="hovereffect">
                                                <span class="hover"></span>
                                            </div>
                                            <!-- end hover -->
                                        </a>
                                    </div>
                                    <!-- end media -->
                                    <div class="blog-meta big-meta text-center">
                                        <div class="post-sharing">
                                            <ul class="list-inline">
                                                <li><a href="blog.php" class="fb-button btn btn-primary"><i class="fa fa-facebook"></i> <span class="down-mobile">Share on Facebook</span></a></li>
                                                <li><a href="blog.php" class="tw-button btn btn-primary"><i class="fa fa-twitter"></i> <span class="down-mobile">Tweet on Twitter</span></a></li>
                                                <li><a href="blog.php" class="gp-button btn btn-primary"><i class="fa fa-google-plus"></i></a></li>
                                            </ul>
                                        </div>
                                        <!-- end post-sharing -->
                                        <h4><a href="FullBlogPost.php?id=<?php echo $PostId; ?>" title=""><?php echo htmlentities($Title); ?></a></h4>
                                        <!-- To mimimize the length of post to 0 and max to 150-->
                                        <p><?php
                                            if (strlen($Post) > 150) {
                                                $Post = substr($Post, 0, 150) . '...';
                                            }
                                            echo $Post; ?></p>

                                        <small><a href="" title=""><?php echo htmlentities($Category); ?></a></small>
                                        <small><a href="" title=""><?php echo htmlentities($DateTime); ?></a></small>
                                        <small><a href="" title="">by <?php echo htmlentities($Author); ?></a></small>
                                        <!--small><a href="blog.php" title=""><i class="fa fa-eye"></i> 1114</a></small -->
                                        <br> <br>
                                        <a style="float:right" href="FullBlogPost.php?id=<?php echo $PostId; ?>" class="primary-btn" data-text="View More">
                                            <span>V</span>
                                            <span>i</span>
                                            <span>e</span>
                                            <span>w</span>
                                            <span> </span>
                                            <span>M</span>
                                            <span>o</span>
                                            <span>r</span>
                                            <span>e</span>
                                        </a>
                                        
                                        <br><br>
                                    </div>

                                    <!-- end meta -->

                                </div>
                                <!-- end blog-box -->
                            <?php } ?>
                        </div>
                        <!-- end blog-custom-build -->
                    </div>
                    <nav class="Page navigation">
                        <ul class="pagination justify-content-center">
                            <!-- Creating backward button -->
                            <?php
                            if (isset($Page)) {
                                if ($Page > 1) {
                            ?>
                                    <li class="page-item">
                                        <a href="blog.php?Page=<?php echo $Page - 1; ?>" class="page-link" aria-label="Next">
                                            <span aria-hidden="true">
                                                <span class="lnr lnr-chevron-left"></span>
                                            </span>
                                        </a>
                                    </li>
                            <?php }
                            } ?>

                            <?php
                            global $Connection;
                            $QueryPagination = "SELECT COUNT(*) FROM admin_panel";
                            $ExecutePagination = mysqli_query($Connection, $QueryPagination);
                            $RowPagination = mysqli_fetch_array($ExecutePagination);
                            $TotalPosts = array_shift($RowPagination);
                            //echo $TotalPosts;
                            $PostPagination = $TotalPosts / 5;
                            $PostPagination = ceil($PostPagination);
                            //echo $PostPerPage;

                            for ($i = 1; $i <= $PostPagination; $i++) {
                                if (isset($Page)) {
                                    if ($i == $Page) {
                            ?>
                                        <hr class="invis">
                                        <li class="page-item active"> <a href="blog.php?Page=<?php echo $i; ?>" class="page-link"> <?php echo $i; ?> </a>
                                        <?php
                                    } else { ?>
                                        <li class="page-item"> <a href="blog.php?Page=<?php echo $i; ?>" class="page-link"> <?php echo $i; ?> </a>
                                <?php }
                                }
                            } ?>
                                        </li>
                                        <!-- Creating forward button -->
                                        <?php
                                        if (isset($Page)) {
                                            if ($Page + 1 <= $PostPagination) {
                                        ?>
                                                <li class="page-item">
                                                    <a href="blog.php?Page=<?php echo $Page + 1; ?>" class="page-link" aria-label="Next">
                                                        <span aria-hidden="true">
                                                            <span class="lnr lnr-chevron-right"></span>
                                                        </span>
                                                    </a>
                                                </li>
                                        <?php }
                                        } ?>
                        </ul>
                    </nav>
                </div>

                <div class="col-lg-4">
                    <div class="widget col-lg-12">
                        <a href="blog.php"><img src="upload/banner_07.jpg" alt="" class="img-fluid"></a>
                    </div>
                    <br />
                    <div class="widget-wrap">
                        <div class="single-sidebar-widget search-widget">
                            <form class="search-form" action="blog.php">
                                <input placeholder="Search Posts" name="search" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search Posts'">
                                <button type="submit" name="searchButton"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        <div class="single-sidebar-widget user-info-widget">
                            <img class="img-responsive" src="img/blog/user-info.png" alt="">
                            <a href="blog.php">
                                <h4>Beke Ben</h4>
                            </a>
                            <p>
                                Software Developer
                            </p>
                            <ul class="social-links">
                                <li><a href="blog.php"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="blog.php"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="blog.php"><i class="fa fa-github"></i></a></li>
                                <li><a href="blog.php"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                            <p>
                                Boot camps have its supporters andit sdetractors. Some people do not understand why you should have to spend money on boot
                                camp when you can get. Boot camps have itssuppor ters andits detractors.
                            </p>
                        </div>
                        <div class="single-sidebar-widget popular-post-widget">
                            <h4 class="popular-title">Recent Posts</h4>
                            <div class="blog-list-widget">
                                <div class="list-group">

                                    <?php

                                    global $Connection;
                                    $ViewQuery  = "SELECT * FROM admin_panel ORDER BY id desc LIMIT 0,5";
                                    $Execute =  mysqli_query($Connection, $ViewQuery);
                                    while ($DataRows = mysqli_fetch_array($Execute)) {
                                        $Id =  $DataRows["id"];
                                        $Title = $DataRows["title"];
                                        $DateTime = $DataRows["datetime"];
                                        $Image = $DataRows["image"];
                                        if (strlen($DateTime) > 15) {
                                            $DateTime = substr($DateTime, 0, 15);
                                        }
                                    ?>
                                        <a href="fullBlogPost.php?id=<?php echo $Id; ?>" class="list-group-item list-group-item-action flex-column align-items-start">
                                            <div class="w-100 justify-content-between">
                                                <img src="upload/<?php echo htmlentities($Image); ?>" alt="" class="img-fluid float-left">
                                                <h5 class="mb-1"><?php echo htmlentities($Title); ?></h5>
                                                <small><?php echo htmlentities($DateTime); ?></small>
                                            </div>
                                        </a>
                                    <?php } ?>
                                </div>

                            </div>

                            <!-- end blog-list -->
                        </div>
                        <div class="single-sidebar-widget ads-widget">
                            <a href="blog.php"><img class="img-fluid" src="img/adds/glo.gif" alt="Glo Advert"></a>
                        </div>
                        <div class="single-sidebar-widget ads-widget">
                            <a href="blog.php"><img class="img-fluid" src="img/adds/lovata.gif" alt="Glo Advert"></a>
                        </div>
                        <div class="single-sidebar-widget post-category-widget">
                            <h4 class="category-title">Post Catgories</h4>
                            <?php

                            global $Connection;
                            $ViewQuery = "SELECT * FROM category_tbl ORDER BY id desc";
                            $Execute =  mysqli_query($Connection, $ViewQuery);
                            while ($DataRows = mysqli_fetch_array($Execute)) {
                                $Id = $DataRows['id'];
                                $Category =  $DataRows['name'];
                            ?>
                                <ul class="cat-list">
                                    <li>
                                        <a href="blog.php?Category=<?php echo $Category; ?>" class="d-flex justify-content-between">
                                            <p><?php echo $Category; ?></p>
                                            <p><?php ?> </p>
                                        </a>
                                    </li>
                                <?php } ?>
                                </ul>
                        </div>
                        <div class="single-sidebar-widget newsletter-widget">
                            <h4 class="newsletter-title">Newsletter</h4>
                            <p>
                                Here, I focus on a range of items and features that we use in life without giving them a second thought.
                            </p>
                            <div class="form-group d-flex flex-row">
                                <div class="col-autos">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Enter email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email'">
                                    </div>
                                </div>
                                <a href="blog.php" class="bbtns">Subcribe</a>
                            </div>
                            <p class="text-bottom">
                                You can unsubscribe at any time
                            </p>
                        </div>
                        <div class="single-sidebar-widget tag-cloud-widget">
                            <h2 class="widget-title">Follow Us</h2>

                            <div class="row text-center">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                    <a href="blog.php" class="social-button facebook-button">
                                        <i class="fa fa-facebook"></i>
                                        <p>27k</p>
                                    </a>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                    <a href="blog.php" class="social-button twitter-button">
                                        <i class="fa fa-twitter"></i>
                                        <p>98k</p>
                                    </a>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                    <a href="blog.php" class="social-button google-button">
                                        <i class="fa fa-google-plus"></i>
                                        <p>17k</p>
                                    </a>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                    <a href="blog.php" class="social-button youtube-button">
                                        <i class="fa fa-youtube"></i>
                                        <p>22k</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br />
                    <div class="widget col-lg-12">
                        <a href="blog.php"><img class="img-fluid" src="img/adds/gtb.jpg" alt=""></a>
                    </div>
                    <br />
                    <!-- end widget -->
                    <div class="widget col-lg-12">
                        <a href="blog.php"><img src="upload/banner_07.jpg" alt="" class="img-fluid"></a>
                    </div>
                </div>
            </div>


        </div>
        <!-- end container -->
    </section>
    <!-- End post-content Area -->

    <!-- Horizontal bar 
    <div class="container">
        <hr>
    </div> -->

    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="single-sidebar-widget newsletter-widget">
                        <h4 class="newsletter-title">Newsletter</h4>
                        <p>
                            Here, I focus on a range of items and features that we use in life without giving them a second thought.
                        </p>
                        <div class="form-group d-flex flex-row">
                            <div class="col-autos">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Enter email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email'">
                                </div>
                            </div>
                            <a href="blog.php" class="bbtns">Subcribe</a>
                        </div>
                        <p class="text-bottom">
                            You can unsubscribe at any time
                        </p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>


    <!-- start footer Area -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="widget">
                        <div class="footer-text text-left">
                            <a href="blog.php"><img src="images/version/Ben's-footer-logo.png" alt="" class="img-fluid"></a>
                            <p>Ben's Blog is a Ben'snology blog, we sharing marketing, news and gadget articles.</p>
                            <div class="social">
                                <a href="blog.php" data-toggle="tooltip" data-placement="bottom" title="Facebook"><i class="fa fa-facebook"></i></a>
                                <a href="blog.php" data-toggle="tooltip" data-placement="bottom" title="Twitter"><i class="fa fa-twitter"></i></a>
                                <a href="blog.php" data-toggle="tooltip" data-placement="bottom" title="Instagram"><i class="fa fa-instagram"></i></a>
                                <a href="blog.php" data-toggle="tooltip" data-placement="bottom" title="Google Plus"><i class="fa fa-google-plus"></i></a>
                                <a href="blog.php" data-toggle="tooltip" data-placement="bottom" title="Pinterest"><i class="fa fa-pinterest"></i></a>
                            </div>

                            <hr class="invis">

                            <div class="newsletter-widget text-left">
                                <form class="form-inline">
                                    <input type="text" class="form-control" placeholder="Enter your email address">
                                    <button type="submit" class="btn btn-primary">SUBMIT</button>
                                </form>
                            </div><!-- end newsletter -->
                        </div><!-- end footer-text -->
                    </div><!-- end widget -->
                </div><!-- end col -->

                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                    <div class="widget">
                        <h2 class="widget-title">Popular Categories</h2>
                        <div class="link-widget">
                            <ul>
                                <li><a href="blog.php">Marketing <span>(21)</span></a></li>
                                <li><a href="blog.php">SEO Service <span>(15)</span></a></li>
                                <li><a href="blog.php">Digital Agency <span>(31)</span></a></li>
                                <li><a href="blog.php">Make Money <span>(22)</span></a></li>
                                <li><a href="blog.php">Blogging <span>(66)</span></a></li>
                            </ul>
                        </div><!-- end link-widget -->
                    </div><!-- end widget -->
                </div><!-- end col -->

                <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12">
                    <div class="widget">
                        <h2 class="widget-title">Copyrights</h2>
                        <div class="link-widget">
                            <ul>
                                <li><a href="blog.php">About us</a></li>
                                <li><a href="blog.php">Advertising</a></li>
                                <li><a href="blog.php">Write for us</a></li>
                                <li><a href="blog.php">Trademark</a></li>
                                <li><a href="blog.php">License & Help</a></li>
                            </ul>
                        </div><!-- end link-widget -->
                    </div><!-- end widget -->
                </div><!-- end col -->
            </div>

            <div class="row">
                <div class="col-md-12 text-center">
                    <br>
                    <div class="copyright">&copy; Ben's Blog. Design: <a href="http://html.design">HTML Design</a>.</div>
                </div>
            </div>
        </div><!-- end container -->
    </footer><!-- end footer -->
    <!-- End footer Area -->

    <!-- Horizontal bar -->

    <!-- blog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.php Start Scroll to Top Area blog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.php -->
    <div id="back-top">
        <a title="Go to Top" href="blog.php">
            <i class="lnr lnr-arrow-up"></i>
        </a>
    </div>
    <!-- blog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.php End Scroll to Top Area blog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.phpblog.php -->

    <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="assets/js/vendor/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
    <script src="assets/js/easing.min.js"></script>
    <script src="assets/js/hoverIntent.js"></script>
    <script src="assets/js/superfish.min.js"></script>
    <script src="assets/js/mn-accordion.js"></script>
    <script src="assets/js/jquery.ajaxchimp.min.js"></script>
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/jquery.nice-select.min.js"></script>
    <script src="assets/js/isotope.pkgd.min.js"></script>
    <script src="assets/js/jquery.circlechart.js"></script>
    <script src="assets/js/mail-script.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>