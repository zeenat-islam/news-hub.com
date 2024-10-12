<?php
    include("include/connection.php");
    $sql_letest_news = "SELECT * FROM news ORDER BY id  DESC LIMIT 0,1";
    $letest_news = "";
    $dir_image = "images/";
    $letest_news_query = mysqli_query($conn, $sql_letest_news);
    if($letest_news_query)
    {
        while($letest_news_row = mysqli_fetch_assoc($letest_news_query))
        {
            $letest_news.= "<div class='left-side'>
            <div class='masonry-box post-media'>
                 <img src='$dir_image$letest_news_row[image]' alt='' class='img-fluid'>
                 <div class='shadoweffect'>
                    <div class='shadow-desc'>
                        <div class='blog-meta'>
                            <span class='bg-aqua'><a href='blog-category.php' title=''>$letest_news_row[category_name]</a></span>
                            <h4><a href='index.php' title=''>$letest_news_row[title]</a></h4>
                            <small><a title=''>$letest_news_row[created_at]</a></small>
                            <small><a  title=''>$letest_news_row[author]</a></small>
                        </div><!-- end meta -->
                    </div><!-- end shadow-desc -->
                </div><!-- end shadow -->
            </div><!-- end post-media -->
        </div><!-- end left-side -->
";
        }
    }
    // }
    // $sql_letest_news_fashion = "SELECT * FROM news WHERE category_id = 2 ORDER BY id  DESC ";
    // $letest_news_fashion = "";
    // $letest_news_fashion_query = mysqli_query($conn, $sql_letest_news_fashion);
    // if($letest_news_fashion_query)
    // {

    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        /* Responsive layout - makes the two columns stack on top of each other instead of next to each other on smaller screens */
        @media screen and (max-width: 600px) {
           .col {
                width: 100%;
            }
        }
        .col{
            float: left;
            width: 50%;
            padding: 15px;
            margin-bottom: 16px;
        }
        .col img{
            width: 100%;
            height: auto;
        }
        .col p{
            text-align: justify;
            line-height: 1.5;
        }
        .col button{
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            display: inline-block;
            margin-top: 8px;
            border: none;
            cursor: pointer;
            width: 100%;
        }
    </style>
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <?php echo $letest_news ?>
        </div>
    </div>
</body>
</html>