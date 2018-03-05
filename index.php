<?php
    //API call goes here
    if(isset($_GET['keyword'])){
        include 'api/pixabayAPI.php';
        $keyword= $_GET['keyword'];
        //echo "You searched for: " . $_GET['keyword'];
        $imageURLs= getImageURLs($_GET['keyword']);
        //print_r($imageURLs);
        $backgroundImage=$imageURLs[array_rand($imageURLs)];
    }
    else{
        $backgroundImage= "./img/sea.jpg";
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Image Carousel</title>
            <link href= "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <style>
        
        @import url("css/styles.css");
        
        body{
            background-image: url('<?= $backgroundImage ?>');
        }
        </style>
    </head>
    <body>
        <br/> <br/>
        <?php
            if(!isset($imageURLs)){
                echo "<h2> Type a keyword to display a slideshow <br /> with random images from Pixabay.com </h2>";
            } else{
             // Display Carousel goes here
             
             for($i=0; $i < 7; $i++){
                 do{
                     $randomIndex=rand(0,count($imageURLs));
                 }
                 while(!isset($imageURLs[$randomIndex]));
                 echo "<img scr='" . $imageURLs[$randomIndex] . "' width='200' >";
                 unset($imageURLs[$randomIndex]);
             }
            
        ?>
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Indicators go here -->
            <ol class="carousel-indicators">
                <?php
                for($i=0; $i<7; $i++){
                    echo "<li data-target=#carousel-example-generic' data-slide-to='$i'";
                    echo ($i==0)?" class='active'":"";
                    echo "></li>";
                }
                ?>
            </ol>
            
            <!-- Wrapper for images -->
            <div class="carousel-inner" role="listbox">
                <?php
                    for($i=0; $i <7; $i++){
                        do{
                            $randomIndex=rand(0,count($imageURLs));
                        }
                        while(!isset($imageURLs[$randomIndex]));
                        
                        echo '<div class="item ';
                        echo ($i==0)?"active": "";
                        echo '">';
                        echo '<img src="' . $imageURLs[$randomIndex] . '">';
                        echo '</div>';
                        unset($imageURLs[$randomIndex]);
                    }
                ?>
            </div>
            <!-- Controls go here -->
              <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
             </a>

        </div>
        
        <?php
            } //end of else stament
        ?>
        
        <!-- HTML form goes here -->
        <form>
            <input type= "text" name="keyword" placeholder="keyword" value="<?=$_GET['keyword']?>"/>
            <input type="radio" id="lhorizontal" name="layout" value="horizontal">
            <label for="Horizontal"></label><label for="lhorizontal">Horizontal</label>
            <input type="radio" id="lvertical" name="layout" vlaue="vertical">
            <label for="Vertical"></label><label for="lvertical">Vertical</label>
            <select name="category">
                <option value="">Select One</option>
                <option value="ocean">Sea</option>
                <option>Forest</option>
                <option>Mountian</option>
                <option>Snow</option>
            </select>
            <input type= "submit" value="Search" />
        </form>
        <br/> <br/>
               
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src= "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
</html>