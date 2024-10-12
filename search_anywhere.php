<?php
    include("include/connection.php");
    // include("include/menu.php");
    if(isset( $_GET['key']))
    {
        $search = $_GET['key'];
        $sql_search = "SELECT * FROM `news`
                WHERE
                lower(title) LIKE lower('%$search%')
                OR
                lower(text) LIKE lower('%$search%')
                OR
                lower(author) LIKE lower('%$search%')
                OR
                lower(category_name) LIKE lower('%$search%')
                LIMIT 0,5";
        $result_search = mysqli_query($conn, $sql_search);
        
        $search_result ="";
        $dir_image = "images/";
        $image = "";
        if($result_search)
        {
            while($search_data = mysqli_fetch_assoc($result_search))
            {
                if($dir_image . $search_data['image'])
                {
                    $image = "<img src='images/$search_data[image]' alt=''/>";
                }
            $search_result .= "<div class='card'>
                <div class='title'><a href='news.php?news_id=$search_data[id]'>$search_data[title]</a></div>
                <div class='img'>$image</div>
            </div>
        ";
            }
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
     <!-- Basic -->
     <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Site Metas -->
    <title>INTERNATIONAL The News-</title>
    <link rel="stylesheet" href="css/category-card.css">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <!-- Site Icons -->
    <link rel="shortcut icon" href="images/logo-.png" type="image/x-icon" />
    <link rel="apple-touch-icon" href="images/logo_.png">
    
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

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .search-container{
            width: 85%;
            padding-top: 2%;
            margin-left: 7%;
            /* background: red; */
        }
        .search-container .card{
            padding: 10px;
            background: #f2f2f2;
            /* border: 1px solid #ccc; */
            margin-bottom: 10px;
            overflow: hidden;
            height: 120px;padding: 10px;
            background: #f2f2f2;
            border: 1px solid #ccc;
            margin-bottom: 10px;
            overflow: hidden;
            height: 160px;
            display: flex;
            justify-content: space-around;
                    
        }
        .search-container .card .title{
            font-size: 18px;
            margin-bottom: 10px;
            color:black;
        }
        .search-container .card  .url{
            font-size: 14px;
            margin-bottom: 10px;
            color: blue;
        }
        .search-container .card .img {
            width: 300px;
            height: 300px;
            margin-bottom: 10px;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .search-container .card  .img img{
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .search-container .card  .search_result{
            font-size: 24px;
            position: absolute;
            top: 25%;
            left: 45px;
            /* font-weight: bold; */
        }
        .search-container .card  .sr_line{
            width: 85%;
            border: 2px solid lightslategray;
            position: absolute;
            top: 29%;
            left: 45px;
        }
    </style>

</head>
<body>
    

    
    <!-- END LOADER -->

    <div id="wrapper">
        <div class="collapse top-search" id="collapseExample">
            <div class="card card-block">
                <div class="newsletter-widget text-center">
                    <form action='search_anywhere.php' method='GET' class="form-inline">
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
        
        
    <div class="search_result" style="margin-left: 7%;
  font-size: 25px;  ">Search Result = <?php echo $search ?></div>
    <div class="sr_line"></div>
    <div class="search-container">
        <?php echo $search_result ?>
    </div>
    <div class="dmtop">Scroll to Top</div>
    <div class="sr-con" style="display: flex;justify-content: flex-end;align-items: center;position: absolute;right: 8%;top: 234px;">
                                <form class="form-inline search-form" action="search_anywhere.php" method="GET">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="key" placeholder="Search on the site">
                                    </div>
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                </form>
                            </div>
                            
        <?php include("include/footer.php"); ?>
        
        </div><!-- end wrapper -->
    
        <!-- Core JavaScript
    </div>
        ================================================== -->
        <script src="js/jquery.min.js"></script>
        <script src="js/tether.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/masonry.js"></script>
        <script src="js/custom.js"></script>
    
</body>
</html>