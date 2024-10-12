<?php
    session_start();
    include("include/connection.php");
    if(isset($_GET['news_id']))
    {
        $news_id = $_GET['news_id'];
        $_SESSION['news_id'] = $news_id;
        $sql_get_news = "SELECT * FROM news WHERE id = $news_id";
        $news = "";
        $dir_image = "images/";
        $image = "";
        $get_news_query = mysqli_query($conn, $sql_get_news);
        if($get_news_query)
        {
            $news = mysqli_fetch_assoc($get_news_query);
        }
    }
    $comment_sql = "SELECT * FROM user_comments WHERE news_id = '$news_id' LIMIT 0,5";
    $comment_result = mysqli_query($conn, $comment_sql);
    $comment ="";
    $comment_data = "";
    if($comment_result)
    {
        while($comment_data = mysqli_fetch_assoc($comment_result))
        {


            $comment .= "<div class='media'>
            <a class='media-left' href='#'>
                <img src='images/$comment_data[user_image]' alt='' class='rounded-circle'>
            </a>
            <div class='media-body'>
                <h4 class='media-heading user_name'>$comment_data[fullname]</small></h4>
                <p>$comment_data[comment]</p>
                <a href='#' class='btn btn-primary btn-sm'>Reply</a>
            </div>
        </div>
    ";
        }
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

    $popular_news = "";
$popular_news_query = mysqli_query($conn, "SELECT * FROM news ORDER BY image LIMIT 0,4");
if ($popular_news_query) {
    while ($popular_news_row = mysqli_fetch_assoc($popular_news_query)) {
        $popular_news .= " <a href='news.php?news_id=$popular_news_row[id]' class='list-group-item list-group-item-action flex-column align-items-start'>
            <div class='w-100 justify-content-between '>
                <img src='images/$popular_news_row[image]' alt='' class='img-fluid float-left'>
                <h5 class='mb-1'>$popular_news_row[title]</h5>
                <span class='rating'>
                    <i class='fa fa-star'></i>
                    <i class='fa fa-star'></i>
                    <i class='fa fa-star'></i>
                    <i class='fa fa-star'></i>
                    <i class='fa fa-star'></i>
                </span>
            </div>
        </a>
        ";
    }
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


$related_post = "";
$related_post_query = mysqli_query($conn, "SELECT * FROM news ORDER BY title LIMIT 0,4");

if ($related_post_query) {
    $counter = 0;
    while ($related_post_row = mysqli_fetch_assoc($related_post_query)) {
        if ($counter % 2 == 0 && $counter != 0) {
            // Close the previous row and start a new one after every 2 posts
            $related_post .= "</div><div class='row'>";
        }
        $related_post .= "<div class='col-lg-6'>
                            <div class='blog-box'>
                                <div class='post-media'>
                                    <a href='news.php?news_id=" . $related_post_row['id'] . "' title=''>
                                        <img src='images/" . $related_post_row['image'] . "' class='img-fluid'/>
                                        <h5 class='mb-1'>" . $related_post_row['title'] . "</h5>
                                    </a>
                                </div>
                            </div>
                          </div>";
        $counter++;
    }
} else {
    echo "Error: " . mysqli_error($conn);
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
    <title>INTERNATIONAL The News-</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <!-- Site Icons -->
    <link rel="shortcut icon" href="images/logo-.png"/>
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    
    <!-- Design fonts -->
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,400,400i,500,700" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,700,900" rel="stylesheet"> 

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome Icons core CSS -->
    <link href="css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="style.css" rel="stylesheet">

    <!-- Responsive styles for this template -->
    <link href="css/responsive.css" rel="stylesheet">

    <!-- Colors for this template -->
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
                    <form class="form-inline" action='search_anywhere.php' method='get' >
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
                </div><!-- end row -->
            </div><!-- end header-logo -->
        </div><!-- end header -->
        <?php include("include/menu.php"); ?>
    
    
    
        <section class="section wb">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                        <div class="page-wrapper">
                            <div class="blog-title-area">
                                <ol class="breadcrumb hidden-xs-down">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item"><a href="#">News</a></li>
                                    <li class="breadcrumb-item active"><?php echo $news['category_name'] ?></li>
                                </ol>

                                <span class="color-aqua"><a title=""><?php echo $news['category_name'] ?></a></span>

                                <h3><?php echo $news['title'] ?></h3>

                                <div class="blog-meta big-meta">
                                    <small><a title=""><?php echo $news['created_at'] ?></a></small>
                                    <small><a title=""><?php echo $news['author'] ?></a></small>
                                    <small><a href="#" title=""><i class="fa fa-eye"></i> 2344</a></small>
                                </div><!-- end meta -->

                                <div class="post-sharing">
                                    <ul class="list-inline">
                                        <li><a href="#" class="fb-button btn btn-primary"><i class="fa fa-facebook"></i> <span class="down-mobile">Share on Facebook</span></a></li>
                                        <li><a href="#" class="tw-button btn btn-primary"><i class="fa fa-twitter"></i> <span class="down-mobile">Tweet on Twitter</span></a></li>
                                        <li><a href="#" class="gp-button btn btn-primary"><i class="fa fa-google-plus"></i></a></li>
                                    </ul>
                                </div><!-- end post-sharing -->
                            </div><!-- end title -->

                            <div class="single-post-media">
                                <img src="images/<?php echo $news['image'] ?>" alt="" class="img-fluid">
                            </div><!-- end media -->

                            <div class="blog-content">  
                                <div class="pp">
                             
                                    <p><?php echo $news['text'] ?> </p>

                                </div><!-- end pp -->
                          </div><!-- end content -->

                            <div class="blog-title-area">
                                <div class="tag-cloud-single">
                                    <span>Tags</span>
                                    <small><a href="#" title=""><?php echo $news['category_name'] ?></a></small>
                                    <small><a href="#" title="">colorful</a></small>
                                    <small><a href="#" title="">trending</a></small>
                                    <small><a href="#" title="">another tag</a></small>
                                </div><!-- end meta -->

                                <div class="post-sharing">
                                    <ul class="list-inline">
                                        <li><a href="#" class="fb-button btn btn-primary"><i class="fa fa-facebook"></i> <span class="down-mobile">Share on Facebook</span></a></li>
                                        <li><a href="#" class="tw-button btn btn-primary"><i class="fa fa-twitter"></i> <span class="down-mobile">Tweet on Twitter</span></a></li>
                                        <li><a href="#" class="gp-button btn btn-primary"><i class="fa fa-google-plus"></i></a></li>
                                    </ul>
                                </div><!-- end post-sharing -->
                            </div><!-- end title -->

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="banner-spot clearfix">
                                        <div class="banner-img">
                                        <?php echo $add_image ?>
                                        </div><!-- end banner-img -->
                                    </div><!-- end banner -->
                                </div><!-- end col -->
                            </div><!-- end row -->

                            <hr class="invis1">

                            <div class="custombox prevnextpost clearfix">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="blog-list-widget">
                                            <div class="list-group">
                                                <a  class="list-group-item list-group-item-action flex-column align-items-start">
                                                    <div class="w-200 justify-content-between text-right">
                                                    <?php echo $popular_news ?>
                                                       
                                                        <small>Prev Post</small>
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
                                        <h4><a href="#">Zeenat</a></h4>
                                        <p>Quisque sed tristique felis. Lorem <a href="#">visit my website</a> amet, consectetur adipiscing elit. Phasellus quis mi auctor, tincidunt nisl eget, finibus odio. Duis tempus elit quis risus congue feugiat. Thanks for stop Cloapedia!</p>

                                        <div class="topsocial">
                                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Facebook"><i class="fa fa-facebook"></i></a>
                                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Youtube"><i class="fa fa-youtube"></i></a>
                                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Pinterest"><i class="fa fa-pinterest"></i></a>
                                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Twitter"><i class="fa fa-twitter"></i></a>
                                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Instagram"><i class="fa fa-instagram"></i></a>
                                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Website"><i class="fa fa-link"></i></a>
                                        </div><!-- end social -->

                                    </div><!-- end col -->
                                </div><!-- end row -->
                            </div><!-- end author-box -->

                            <hr class="invis1">

                            <div class="custombox clearfix">
                                <h4 class="small-title">You may also like</h4>
                                <div class="row">
                                    <?php echo $related_post; ?>
                                </div><!-- end row -->
                            </div><!-- end custombox -->


                                    

                            <hr class="invis1">

                            <div class="custombox clearfix">
                                <h4 class="small-title"><?php  $totle_cmt ?> Comments</h4>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="comments-list">
                                                <?php echo $comment ?>

                                                </div>
                                    </div><!-- end col -->
                                </div><!-- end row -->
                            </div><!-- end custom-box -->

                            <hr class="invis1">

                            <div class="custombox clearfix">
                                <h4 class="small-title">Leave a Reply</h4>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form class="form-wrapper">
                                            <input type="text" class="form-control" id="fullname" placeholder="Your name">
                                            <input type="text" class="form-control" id="email" placeholder="Email address">
                                            <input type="text" class="form-control" id="website" placeholder="Website">
                                            <textarea class="form-control" id='comment' placeholder="Your comment"></textarea>
                                            <button type="button" onclick="comment1()" class="btn btn-primary">Submit Comment</button>
                                            <div class="alert" role="alert" id="alert-cc">
                                              </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end page-wrapper -->
                    </div><!-- end col -->

                    <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                        <div class="sidebar">
                            <div class="widget">
                                <h2 class="widget-title">Search</h2>
                                <form class="form-inline search-form" action="search_anywhere.php">
                                    <div class="form-group" >
                                        <input type="text" class="form-control" name="key" placeholder="Search on the site">
                                    </div>
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                </form>
                            </div><!-- end widget -->

                            <div class="widget">
                                <h2 class="widget-title">Recent Posts</h2>
                                <div class="blog-list-widget">
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
                </div><!-- end row -->
            </div><!-- end container -->
        </section>

      <!--footer-->

      <?php include("include/footer.php"); ?>

    <!-- Core JavaScript
    ================================================== -->
    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
    <!-- // ajax -->
    <script>
        function comment1(){
            var name = $('#fullname').val();
            var email = $('#email').val();
            var website = $('#website').val();
            var news_id = $("id").val();
            var comment = $('#comment').val();

            $.ajax({
                type: "POST",
                url: "include/comment.php",
                data: {name: name, email: email, website: website, news_id: news_id, comment: comment},
                success: function(response){
                    if(response == "done")
                    {
                        $(".alert").addClass("alert-success").addClass("mt-2").addClass("text-center").text("Your message was sent successfully").removeClass("mt-4").addClass("text-center").addClass("p-1");


                    }else{
                        $(".alert").addClass("alert-danger").addClass("mt-2").addClass("text-center").text("An error occurred. Please try again.").removeClass("mt-4").addClass("text-center").addClass("p-1");
                    }
                }
            });
        }
    </script>
    <div class="comment-section"></div>
    
</body>
</html>