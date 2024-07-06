<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "movie";

// Create connectionn
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connectionn
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $opinion = $_POST['opinion'];

    $stmt = $conn->prepare("INSERT INTO feedback(fname, email, opinion)
                VALUES(?, ?, ?);");

    $stmt->bind_param("sss", $name, $email, $opinion);
    $stmt->execute();
}

$conn->close();

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>H&H Theatres - Home</title>
    <link rel="stylesheet" href="stylesheet.css">
    <link rel="shortcut icon" type="image/jpg" href="./logo.PNG"/>
    <style>
        
        .feedback-form {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 100%;
        }

        .feedback-form label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .feedback-form input,
        .feedback-form textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .feedback-form textarea {
            resize: vertical;
        }

        .feedback-form button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .feedback-form button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div id="wrapper">
        <header>
            <img id='company_logo' src="header_img/header.png" alt="Logo" width="300px">
            <table class="social">
                <tr>
                    <td>
                        <p>Follow us&nbsp;</p>
                    </td>
                    <td>
                        <a href="https://www.facebook.com" target="_blank"><img class="social" src="./social_img/facebook-logo.PNG" alt="fb-logo" width="23px"></a>
                    </td>
                    <td>
                        <a href="https://www.twitter.com" target="_blank"><img class="social" src="./social_img/twitter-logo.png" alt="tt-logo" width="30px"></a>
                    </td>
                    <td>
                        <a href="https://www.instagram.com" target="_blank"><img class="social" src="./social_img/Instagram-logo.png" alt="ig-logo" width="30px"></a>
                    </td>
                </tr>
            </table>
        </header>
        <div id="nav">
            <nav>
                <ul class="nav">
                    <li class="nav"><a class="active" href="home.php">Home</a></li>
                    <li class="nav"><a href="movies.html">Movies</a></li>
                    <li class="nav"><a href="cinema.html">Cinema</a></li>
                    <li class="nav"><a onclick="location.href='logout.php';" >Log Out</a></li>
                </ul>
            </nav>
        </div>
        

        <div class="slideshow-container">
            <div class="mySlides fade">
                <div class="numbertext">1 / 3</div>
                <img src="slider_img/banner1.jpg" style="width:100%">
            </div>
            
            <div class="mySlides fade">
                <div class="numbertext">2 / 3</div>
                <img src="slider_img/banner2.jpg" style="width:100%">
            </div>
            
            <div class="mySlides fade">
                <div class="numbertext">3 / 3</div>
                <img src="slider_img/banner3.jpg" style="width:100%">
            </div>
            
            <div style="text-align:center">
            <span class="dot"></span> 
            <span class="dot"></span> 
            <span class="dot"></span> 
            </div>
        </div>
        <script>
        var slideIndex = 0;
        showSlides();
        
        function showSlides() {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("dot");
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";  
        }
        slideIndex++;
        if (slideIndex > slides.length) {slideIndex = 1}    
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex-1].style.display = "block";  
        dots[slideIndex-1].className += " active";
        setTimeout(showSlides, 10000); // Change image every 2 seconds
        }
        </script>
        <div class="content">
            <div class="tab">
                <button class="tablinks" onclick="openTab(event, 'Now_Showing')" id="defaultOpen">Now Showing</button>
                <button class="tablinks" onclick="openTab(event, 'Coming_Soon')">Coming Soon</button>
                <button class="tablinks" onclick="openTab(event, 'feed')"> FeedBack</button>
            </div>
              <!-- Tab content  -->

            <div class="feedback-form tabcontent" id="feed">
                <h2>Feedback Form</h2>
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
        
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
        
                    <label for="opinion">Your Opinion:</label>
                    <textarea id="opinion" name="opinion" rows="4" required></textarea>
        
                    <button type="submit">Submit Feedback</button>
                </form>
            </div>
            <div id="Now_Showing" class="tabcontent">
                <h3>Featured</h3>
                <p>Top block busters only</p>
                
                <div class="featureTab flex-row space-betw">
                    <div class="movieCard flex-col valign-center">
                        <div class="bounding-box">
                            <img src="./posters_small/7avatar2021.png" alt="movie1">
                        </div>
                        
                        <p>Avatar: The Way Of Water</p>
                    </div>
                    <div class="movieCard flex-col valign-center">
                        <div class="bounding-box">
                            <img src="./posters_small//Black-Adam-Poster.webp" alt="movie2">
                        </div>
                        
                        <p>Black Adam</p>
                    </div>
                    <div class="movieCard flex-col valign-center">
                        <div class="bounding-box">
                            <img src="./posters_small//Elvis-poster.png" alt="movie3">
                        </div>
                        
                        <p>Elvis</p>
                    </div>
                    <div class="movieCard flex-col valign-center">
                        <div class="bounding-box">
                            <img src="./posters_small/Everything-Everywhere-All-At-Once.png" alt="movie4">
                        </div>
                        
                        <p>Everything Everywhere All At Once</p>
                    </div>
                    <div class="movieCard flex-col valign-center">
                        <div class="bounding-box">
                            <img src="./posters_small/the-menu.jpg" alt="movie5">
                        </div>
                        
                        <p>The Menu</p>
                    </div>
                </div>
              </div>
              
              <div id="Coming_Soon" class="tabcontent">
                <h3>Featured</h3>
                <p>Upcoming block busters</p>
                <div class="featureTab flex-row space-betw">
                    <div class="movieCard flex-col valign-center">
                        <div class="bounding-box">
                            <img src="./posters_small//magic-mike.jpg" alt="movie1">
                        </div>
                        
                        <p>Magic Mike's Last Dance (2023)</p>
                    </div>
                    <div class="movieCard flex-col valign-center">
                        <div class="bounding-box">
                            <img src="./posters_small/ant-man-and-the-wasp.jpg" alt="movie3">
                        </div>
                        
                        <p>Ant-Man and the Wasp: Quantumania</p>
                    </div>
                    <div class="movieCard flex-col valign-center">
                        <div class="bounding-box">
                            <img src="./posters_small//creed3.jpg" alt="movie2">
                        </div>
                        
                        <p>Creed III</p>
                    </div>
                    <div class="movieCard flex-col valign-center">
                        <div class="bounding-box">
                            <img src="./posters_small/shazam.jpg" alt="movie4">
                        </div>
                        
                        <p>Shazam! Fury of the Gods</p>
                    </div>
                    <div class="movieCard flex-col valign-center">
                        <div class="bounding-box">
                            <img src="./posters_small/johnwick4.jpg" alt="movie5">
                        </div>
                        
                        <p>John Wick: Chapter 4</p>
                    </div>
                </div>
                
              </div>
              
              <script>
                  function openTab(evt, tabName) {
                    // Declare all variables
                    var i, tabcontent, tablinks;

                    // Get all elements with class="tabcontent" and hide them
                    tabcontent = document.getElementsByClassName("tabcontent");
                    for (i = 0; i < tabcontent.length; i++) {
                        tabcontent[i].style.display = "none";
                    }

                    // Get all elements with class="tablinks" and remove the class "active"
                    tablinks = document.getElementsByClassName("tablinks");
                    for (i = 0; i < tablinks.length; i++) {
                        tablinks[i].className = tablinks[i].className.replace(" active", "");
                    }

                    // Show the current tab, and add an "active" class to the button that opened the tab
                    document.getElementById(tabName).style.display = "block";
                    evt.currentTarget.className += " active";
                }
              </script>
              <script>
                // Get the element with id="defaultOpen" and click on it
                document.getElementById("defaultOpen").click();
              </script>
        </div>
        <div class="push"></div>
        <footer class="footer flex-col">
            <div class="flex-row space-betw" >
                <a href="index.html"><small><b>About us</b></small></a>
                <a href="index.html"><small><b>Careers</b></small></a>
                <a href="index.html"><small><b>FAQs</b></small></a>
                <a href="index.html"><small><b>Contact us</b></small></a>
                <a href="index.html"><small><b>Terms of use</b></small></a>
            </div>
            <td><small><i>H&H Groups Company</i></small>
                
             </td>
        </footer>
    </div>
<script>
            let count=0;
            if(count==0){
            alert("you are my customer ! 5% bonus on your first ticket");
            count++;}
            
</script>
</body>
</html>