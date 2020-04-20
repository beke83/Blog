<?php require_once("Include/db.php"); ?>
<?php require_once("Include/session.php"); ?>
<?php require_once("Include/Functions.php"); ?>

<?php
if (isset($_POST["Submit"])) {
    $Name = mysqli_real_escape_string($Connection, $_POST["Name"]);
    $Email = mysqli_real_escape_string($Connection, $_POST["Email"]);
    $Comment = mysqli_real_escape_string($Connection, $_POST["Comment"]);
    date_default_timezone_set("Africa/Lagos");
    $CurrentTime = time();
    $DateTime = strftime("%B-%d-%Y %H:%M:%S", $CurrentTime);
    $DateTime;
    $PostId = $_GET["id"];
    if (empty($Name) || empty($Email) || empty($Comment)) {
        $_SESSION["ErrorMessage"] = "All Field must be filled";
    } elseif (strlen($Comment) > 500) {
        $_SESSION["ErrorMessage"] = "Only 500 characters are allowed in comments";
    } else {

        global $Connection;
        $PostIdFromURL = $_GET["id"];
        $Query = "INSERT INTO comments(datetime,name,email,comment,approvedby,status,admin_panel_id) 
       VALUES ('$DateTime','$Name', '$Email','$Comment','Pending','OFF', '$PostIdFromURL')";
        $Execute = mysqli_query($Connection, $Query);
        if ($Execute) {
            $_SESSION["SuccessMessage"] = "Comment Submitted Successfully";
            Redirect_to("fullBlogPost.php?id={$PostId}");
        } else {
            $_SESSION["ErrorMessage"] = "Something went wrong try Again!!!";
            Redirect_to("fullBlogPost.php?id={$PostId}");
        }
    }
}


?>


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
    <title>Full Blog Post</title>

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
    <link href="assets/css/tech.css" rel="stylesheet">


</head>

<body>

    <!-- Start Header Area -->
    <header id="header" class="dark">
        <div class="container main-menu">
            <div class="row align-items-center d-flex">
                <div id="logo">
                    <a href="index.html"><img src="img/logo2.png" alt="" title="" /></a>
                </div>
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
                        <li>
                            <a href="login.php">
                                Login
                            </a>
                        </li>
                        </li>
                        <li><a href="blog.php">Blog</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <!-- End Header Area -->
    <!-- End banner Area -->

    <!-- Start top-category-widget Area -->
    <!-- Start post-content Area -->


    <section class="section single-wrapper">
        <div class="container">
            <div class="row">

                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="page-wrapper">
                        <?php
                        global $Connection;
                        if (isset($_GET["searchButton"])) {

                            $Search = $_GET["search"];
                            $ViewQuery = "SELECT * FROM admin_panel 
                                WHERE datetime LIKE '%$Search%' OR title LIKE '%$Search%' 
                                OR category LIKE '%$Search%' 
                                OR post LIKE '%$Search%' ";
                        } else {
                            $PostIdFromURL = $_GET["id"];
                            $ViewQuery = "SELECT * FROM admin_panel WHERE id = ' $PostIdFromURL' ORDER BY datetime desc";
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
                            <div class="blog-title-area text-center">

                                <?php echo Message();
                                echo SuccessMessage();
                                ?>
                                <ol class="breadcrumb hidden-xs-down">
                                    <li class="breadcrumb-item"><a href="blog.php">Home</a></li>
                                    <li class="breadcrumb-item"><a href="blog.php">Blog</a></li>
                                    <li class="breadcrumb-item active"><?php echo htmlentities($Title); ?></li>
                                </ol>

                                <span class="color-orange"><a href="" title=""><?php echo htmlentities($Category); ?></a></span>

                                <h3><?php echo htmlentities($Title); ?></h3>

                                <div class="blog-meta big-meta">
                                    <small><a href="blog.php" title=""><?php echo htmlentities($DateTime); ?></a></small>
                                    <small><a href="blog.php" title=""><?php echo htmlentities($Author); ?></a></small>
                                    <small><a href="blog.php" title=""><i class="fa fa-eye"></i> 2344</a></small>
                                </div><!-- end meta -->

                                <div class="post-sharing">
                                    <ul class="list-inline">
                                        <li><a href="blog.php" class="fb-button btn btn-primary"><i class="fa fa-facebook"></i> <span class="down-mobile">Share on Facebook</span></a></li>
                                        <li><a href="blog.php" class="tw-button btn btn-primary"><i class="fa fa-twitter"></i> <span class="down-mobile">Tweet on Twitter</span></a></li>
                                        <li><a href="blog.php" class="gp-button btn btn-primary"><i class="fa fa-google-plus"></i></a></li>
                                    </ul>
                                </div><!-- end post-sharing -->
                            </div><!-- end title -->

                            <div class="single-post-media">
                                <img src="upload/<?php echo $Image ?>" alt="" class="img-fluid">
                            </div><!-- end media -->

                            <div class="blog-content">
                                <div class="pp">
                                    <!-- nl2br used to format the text the way you added it like paragrapy, heading, list etc -->
                                    <?php echo nl2br($Post); ?>
                                </div><!-- end pp -->
                            </div><!-- end content -->

                        <?php } ?>

                        <hr class="invis1">

                        <div class="custombox prevnextpost clearfix">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="blog-list-widget">
                                        <div class="list-group">
                                            <a href="tech-single.html" class="list-group-item list-group-item-action flex-column align-items-start">
                                                <div class="w-100 justify-content-between text-right">
                                                    <img src="upload/tech_menu_19.jpg" alt="" class="img-fluid float-right">
                                                    <h5 class="mb-1">5 Beautiful buildings you need to before dying</h5>
                                                    <small>Prev Post</small>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div><!-- end col -->

                                <div class="col-lg-6">
                                    <div class="blog-list-widget">
                                        <div class="list-group">
                                            <a href="tech-single.html" class="list-group-item list-group-item-action flex-column align-items-start">
                                                <div class="w-100 justify-content-between">
                                                    <img src="upload/tech_menu_20.jpg" alt="" class="img-fluid float-left">
                                                    <h5 class="mb-1">Let's make an introduction to the glorious world of history</h5>
                                                    <small>Next Post</small>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div><!-- end col -->
                            </div><!-- end row -->
                        </div><!-- end author-box -->

                        <hr class="invis1">


                        <div class="custombox authorbox clearfix">
                            <h4 class="small-title">About author</h4>
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <img src="upload/author.jpg" alt="" class="img-fluid rounded-circle">
                                </div><!-- end col -->

                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                    <h4><a href="blog.php"><?php echo htmlentities($Author); ?></a></h4>
                                    <p>Quisque sed tristique felis. Lorem <a href="blog.php">visit my website</a> amet, consectetur adipiscing elit. Phasellus quis mi auctor, tincidunt nisl eget, finibus odio. Duis tempus elit quis risus congue feugiat. Thanks for stop Ben's Blog!</p>

                                    <div class="topsocial">
                                        <a href="blog.php" data-toggle="tooltip" data-placement="bottom" title="Facebook"><i class="fa fa-facebook"></i></a>
                                        <a href="blog.php" data-toggle="tooltip" data-placement="bottom" title="Youtube"><i class="fa fa-youtube"></i></a>
                                        <a href="blog.php" data-toggle="tooltip" data-placement="bottom" title="Pinterest"><i class="fa fa-pinterest"></i></a>
                                        <a href="blog.php" data-toggle="tooltip" data-placement="bottom" title="Twitter"><i class="fa fa-twitter"></i></a>
                                        <a href="blog.php" data-toggle="tooltip" data-placement="bottom" title="Instagram"><i class="fa fa-instagram"></i></a>
                                        <a href="blog.php" data-toggle="tooltip" data-placement="bottom" title="Website"><i class="fa fa-link"></i></a>
                                    </div><!-- end social -->

                                </div><!-- end col -->
                            </div><!-- end row -->
                        </div><!-- end author-box -->
                        <hr class="invis1">

                        <div class="custombox clearfix">
                            <h4 class="small-title">You may also like</h4>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="blog-box">
                                        <div class="post-media">
                                            <a href="tech-single.html" title="">
                                                <img src="upload/tech_menu_04.jpg" alt="" class="img-fluid">
                                                <div class="hovereffect">
                                                    <span class=""></span>
                                                </div><!-- end hover -->
                                            </a>
                                        </div><!-- end media -->
                                        <div class="blog-meta">
                                            <h4><a href="tech-single.html" title="">We are guests of ABC Design Studio</a></h4>
                                            <small><a href="blog-category-01.html" title="">Trends</a></small>
                                            <small><a href="blog-category-01.html" title="">21 July, 2017</a></small>
                                        </div><!-- end meta -->
                                    </div><!-- end blog-box -->
                                </div><!-- end col -->

                                <div class="col-lg-6">
                                    <div class="blog-box">
                                        <div class="post-media">
                                            <a href="tech-single.html" title="">
                                                <img src="upload/tech_menu_06.jpg" alt="" class="img-fluid">
                                                <div class="hovereffect">
                                                    <span class=""></span>
                                                </div><!-- end hover -->
                                            </a>
                                        </div><!-- end media -->
                                        <div class="blog-meta">
                                            <h4><a href="tech-single.html" title="">Nostalgia at work with family</a></h4>
                                            <small><a href="blog-category-01.html" title="">News</a></small>
                                            <small><a href="blog-category-01.html" title="">20 July, 2017</a></small>
                                        </div><!-- end meta -->
                                    </div><!-- end blog-box -->
                                </div><!-- end col -->
                            </div><!-- end row -->
                        </div><!-- end custom-box -->

                        <hr class="invis1">

                        <div class="custombox clearfix">
                            <?php
                            $Connection;
                            $QueryTotal = "SELECT COUNT(*) FROM comments WHERE admin_panel_id='$PostId' AND status = 'ON'  ";
                            $ExecuteTotal =  mysqli_query($Connection, $QueryTotal);
                            $RowsTotal = mysqli_fetch_array($ExecuteTotal);

                            $Total = array_shift($RowsTotal);
                            if ($Total > 0) {
                            ?>
                            <h4 class="small-title"><?php echo $Total;?> Comments</h4>
                            <?php }else{
                                echo " <h4 class='small-title'><?php echo $Total;?> Comments</h4>";
                            } ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="comments-list">
                                        <?php

                                        $Connection;
                                        $PostIdFromComments = $_GET["id"];
                                        $ExtractingCommentsQuery = "SELECT * FROM comments
                                         WHERE admin_panel_id = '$PostIdFromComments' AND status='ON' ";
                                        $Execute = mysqli_query($Connection, $ExtractingCommentsQuery);
                                        while ($DataRows = mysqli_fetch_array($Execute)) {
                                            $CommentDate = $DataRows{
                                            "datetime"};
                                            $CommenterName = $DataRows{
                                            "name"};
                                            $CommentbyUsers = $DataRows{
                                            "comment"};


                                        ?>
                                            <div class="media">
                                                <a class="media-left" href="blog.php">
                                                    <img src="upload/author.jpg" alt="" class="rounded-circle">
                                                </a>
                                                <div class="media-body">
                                                    <h4 class="media-heading user_name"> <?php echo htmlentities($CommenterName); ?> <small><?php echo htmlentities($CommentDate); ?></small></h4>
                                                    <p><?php echo htmlentities($CommentbyUsers); ?></p>
                                                    <a href="blog.php" class="btn btn-primary btn-sm">Reply</a>
                                                </div>
                                            </div>

                                        <?php } ?>
                                    </div>



                                </div><!-- end col -->
                            </div><!-- end row -->
                        </div><!-- end custom-box -->

                        <hr class="invis1">


                        <hr class="invis1">
                        <div class="custombox clearfix">
                            <h4 class="small-title">Leave a Reply</h4>
                            <div class="row">
                                <div class="col-lg-12">
                                    <form class="form-wrapper" action="fullBlogPost.php?id=<?php echo $PostId; ?>" method="post">
                                        <input type="text" class="form-control" placeholder="Your name" name="Name" id="Name">
                                        <input type="email" class="form-control" placeholder="Email address" name="Email" id="Email">
                                        <textarea class="form-control" placeholder="Your comment" name="Comment" id="commentarea"></textarea>
                                        <button type="submit" name="Submit" class="btn btn-primary">Submit Comment</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div><!-- end page-wrapper -->

                </div><!-- end col -->

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
                    <!-- end widget -->
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
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
                            <a href="index.html"><img src="images/version/tech-footer-logo.png" alt="" class="img-fluid"></a>
                            <p>Ben's Blog is a technology blog, we sharing marketing, news and gadget articles.</p>
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