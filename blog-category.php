<?php
include("include/connection.php");
if (isset($_GET['categ_title'])) {
    $category_title = $_GET['categ_title'];

    $sql_gat_news = "SELECT * FROM categories a 
        LEFT JOIN
        news b 
        ON
        a.title = b.category_name
        WHERE a.title = '$category_title'";
    $news = "";
    $image = "";
    $dir_image = "images/";
    $sql_gat_news_query = mysqli_query($conn, $sql_gat_news);
    if ($sql_gat_news_query) {
        while ($get_news = mysqli_fetch_assoc($sql_gat_news_query)) {
            if ($dir_image . $get_news['image']) {
                $image = "<img src='$dir_image$get_news[image]' />";
            }

            $news .= "<div class='card-1'>
                <div class='card-image-1'>
                    $image
                </div>
                <div class='card-category-1'>
                    $category_title
                </div>
                <div class='card-header-1'>
                </div>
                <div class='card-body-1'>
                    <a href='news.php?news_id=$get_news[id]'>$get_news[title]</a>
                </div>
                <div class='card-footer-1'>
                    <small class='small-1 category'><a href=''>$category_title</a></small>
                    <small class='small-1 date'><a href=''>$get_news[created_at]</a></small>
                    <small class='small-1'><a href=''>$get_news[author]</a></small>


        </div>
        </div>";
        }
    }
} else {
    header('location:index.php');
    exit;
}

$sql_category = "SELECT * FROM `categories`";
$result_category = mysqli_query($conn, $sql_category);
$categorys = "";

if ($result_category) {
    while ($category = mysqli_fetch_assoc($result_category)) {
        $categorys .= "<li> <a href='blog-category.php?categ_title=$category[title]'>$category[title]<span>" . mysqli_num_rows($result_category) . "</span></a> <li>";
    }
} else {
    echo "Error: " . mysqli_error($conn);
}


$recent_news_sql = "SELECT * FROM news ORDER BY id limit 0,4";
$recent_news = "";
$recent_news_image = "";
$recent_news_query = mysqli_query($conn, $recent_news_sql);
if ($recent_news_query) {
    while ($recent_news_data = mysqli_fetch_assoc($recent_news_query)) {
        if ($recent_news_data['image']) {
            $recent_news_image = "<img src='images/$recent_news_data[image]' alt='' class='img-fluid' />";
        }
        $recent_news .= "<a href='news.php?news_id=$recent_news_data[id]' class='list-group-item list-group-item-action flex-column align-items-start'>
            <div class='w-300 justify-content-between' style='display:flex; margin-bottom:20px;' >
                    $recent_news_image
                <h5 class='mb-1 b-1' style='overflow: hidden; width:200px;
                display: -webkit-box;
                -webkit-line-clamp: 2; /* number of lines to show */
                        line-clamp: 3; 
                -webkit-box-orient: vertical;'>$recent_news_data[title]</h5>
                <small style='position: absolute;
                left: 120px;
                bottom: -0.3px;
              '>24-Sem-2024</small>
            </div>
        </a>
        ";
    }
}
$select_add_sql = "SELECT * FROM adds LIMIT 0,1";
$select_add_query = mysqli_query($conn, $select_add_sql);
$add_image = "";
if ($select_add_query) {
    $add_data = mysqli_fetch_assoc($select_add_query);
    $add_image = "<img src='images/$add_data[add_image]' alt='' class='img-fluid' />";
}

?>
<!DOCTYPE html>
<html lang="en">

<!-- Basic -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Site Metas -->
<title>INTERNATIONAL The News- </title>
<link rel="stylesheet" href="css/category-card.css">
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="author" content="">

<!-- Site Icons -->
<link rel="shortcut icon" href="images/logo-.png" />
<link rel="apple-touch-icon" href="images/apple-touch-icon.png">

<!-- Design fonts -->
<link href="https://fonts.googleapis.com/css?family=Ubuntu:300,400,400i,500,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,700,900" rel="stylesheet">

<!-- Bootstrap core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">

<!-- FontAwesome Icons core CSS -->
<link href="css/font-awesome.min.css" rel="stylesheet">

<!-- Custom styles -->
<link href="style.css" rel="stylesheet">

<link href="css/responsive.css" rel="stylesheet">

<link href="css/colors.css" rel="stylesheet">



</head>

<body>

    <!-- LOADER -->
    <div id="preloader">
        <img class="preloader" src="images/loader.gif" alt="">
    </div><!-- end loader -->
    <!-- END LOADER -->

    <div id="wrapper">
        <div class="collapse top-search" id="collapseExample">
            <div class="card card-block">
                <div class="newsletter-widget text-center">
                    <form class="form-inline" action='search_anywhere.php' method='get'>
                        <input type="text" class="form-control" name="key" placeholder="What you are looking for?">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                    </form>
                </div><!-- end newsletter -->
            </div>
        </div><!-- end top-search -->

        <div class="topbar-section">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6 hidden-xs-down">
                        <div class="topsocial">
                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Facebook"><i class="fa fa-facebook"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Youtube"><i class="fa fa-youtube"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Pinterest"><i class="fa fa-pinterest"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Twitter"><i class="fa fa-twitter"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Flickr"><i class="fa fa-flickr"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Instagram"><i class="fa fa-instagram"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Google+"><i class="fa fa-google-plus"></i></a>
                        </div><!-- end social -->
                    </div><!-- end col -->

                    <div class="col-lg-4 hidden-md-down">
                        <div class="topmenu text-center">
                            <ul class="list-inline">
                                <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i> Trends</a></li>
                                <li class="list-inline-item"><a href="#"><i class="fa fa-bolt"></i> Hot Topics</a></li>
                                <li class="list-inline-item"><a href="#"><i class="fa fa-user-circle-o"></i> Write for us</a></li>
                            </ul><!-- end ul -->
                        </div><!-- end topmenu -->
                    </div><!-- end col -->

                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                        <div class="topsearch text-right">
                            <a data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-search"></i> Search</a>
                        </div><!-- end search -->
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end header-logo -->
        </div><!-- end topbar -->

        <div class="header-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="logo">
                            <a href="index.php"><img src="images/Thenews-logo.svg" alt=""></a>
                        </div><!-- end logo -->
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end header-logo -->
        </div>

        <?php include("include/menu.php"); ?>
    </div>

    <div class="page-title wb">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <h2><i class="fa fa-shopping-bag bg-pink"></i> <?php echo $category_title ?> </h2>
                </div><!-- end col -->
                <div class="col-lg-4 col-md-4 col-sm-12 hidden-xs-down hidden-sm-down">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active"><?php echo $category_title ?></li>
                    </ol>
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end page-title -->

    <section class="section wb">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                    <div class="sidebar">
                        <div class="widget">
                            <h2 class="widget-title">Search</h2>
                            <form class="form-inline search-form" action='search_anywhere.php' method='GET'>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="key" placeholder="Search on the site">
                                </div>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                            </form>
                        </div><!-- end widget -->

                        <div class="widget recent">
                            <h2 class="widget-title">Recent Posts</h2>
                            <div class="blog-list-widget  recent-post">
                                <div class="list-group">
                                    <?php echo $recent_news ?>
                                </div>
                            </div><!-- end blog-list -->
                        </div><!-- end widget -->

                        <div class="widget">
                            <h2 class="widget-title">Advertising</h2>
                            <div class="banner-spot clearfix">
                                <div class="banner-img">
                                    <?php echo $add_image ?>
                                </div><!-- end banner-img -->
                            </div><!-- end banner -->
                        </div><!-- end widget -->

                        <div class="widget">
                            <h2 class="widget-title">Instagram Feed</h2>
                            <div class="instagram-wrapper clearfix">
                                <a class="" href="#"><img src="upload/insta_01.jpeg" alt="" class="img-fluid"></a>
                                <a href="#"><img src="upload/insta_02.jpeg" alt="" class="img-fluid"></a>
                                <a href="#"><img src="upload/insta_03.jpeg" alt="" class="img-fluid"></a>
                                <a href="#"><img src="upload/insta_04.jpeg" alt="" class="img-fluid"></a>
                                <a href="#"><img src="upload/insta_05.jpeg" alt="" class="img-fluid"></a>
                                <a href="#"><img src="upload/insta_06.jpeg" alt="" class="img-fluid"></a>
                                <a href="#"><img src="upload/insta_07.jpeg" alt="" class="img-fluid"></a>
                                <a href="#"><img src="upload/insta_08.jpeg" alt="" class="img-fluid"></a>
                                <a href="#"><img src="upload/insta_09.jpeg" alt="" class="img-fluid"></a>
                            </div><!-- end Instagram wrapper -->
                        </div><!-- end widget -->

                        <div class="widget">
                            <h2 class="widget-title">Popular Categories</h2>
                            <div class="link-widget popular-categories">
                              <ul>
                                <li>  <?php echo $categorys ?></li>
                              </ul>
                                   
                               
                                   
                          

                            </div><!-- end link-widget -->
                        </div><!-- end widget -->
                    </div><!-- end sidebar -->
                </div><!-- end col -->

                <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                    <div class="page-wrapper">
                        <div class="row">
                            <div class="add">
                                <div class="img">
                                    <?php echo $add_image ?>
                                </div>
                            </div><!-- end row -->
                            <div class="container">

                                <?php echo $news ?>

                            </div>


                            <hr class="invis">


                            <hr class="invis">

                            <div class="row">
                              
                            </div><!-- end row -->
                        </div><!-- end col -->
                    </div><!-- end row -->
                </div><!-- end container -->
    </section>
    <?php include("include/footer.php"); ?>


    <div class="dmtop">Scroll to Top</div>

    </div><!-- end wrapper -->

    <!-- Core JavaScript
    ================================================== -->
    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/masonry.js"></script>
    <script src="js/custom.js"></script>

</body>

</html>