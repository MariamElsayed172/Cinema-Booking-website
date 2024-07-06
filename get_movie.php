<?php
    session_start();

    # db credentials
    $servername ="localhost";
    $username = "root";
    $password = "";
    $dbname = "movie";

    # get user selection of movie: movie_id
    $movie_id = (int)$_GET['movie'];
    $_SESSION['movie_id'] = $movie_id;

    # connect to db and fetch movie detail of "movied_id"
    $db = mysqli_connect($servername, $username, $password, $dbname); // connect to db server
    if(!$db) {
        die("Connection error:" . mysqli_connect_error());
    }
    $query = "SELECT * FROM MOVIE WHERE movie_id=$movie_id"; // formulate query
    $result = $db->query($query); // point db to query
    $row = $result->fetch_assoc();

    # format of MOVIE table: `movie_id`, `movie_name`, `duration`, `language`, `genre`, `distributor`, `release_date`, `image_dir`, `synopsis`, `rating`, `cast`, `director`
    # store all attr of the movie into variables to populate html codes below
    $movie_name = $row['movie_name'];
    $duration = $row['duration'];
    $language = $row['language'];
    $genre = $row['genre'];
    $distributor = $row['distributor'];
    $release_date = $row['release_date'];
    $image_dir = $row['image_dir'];
    $synopsis = $row['synopsis'];
    $rating = $row['rating'];
    $cast = $row['cast'];
    $director = $row['director'];

    $result->free();
    $db->close();
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>H&H Theatres - Movies</title>
    <link rel="stylesheet" href="stylesheet.css">
    <link rel="shortcut icon" type="image/jpg" href="./logo.PNG"/>
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
                    <li class="nav"><a href="home.php">Home</a></li>
                    <li class="nav"><a class="active" href="movies.html">Movies</a></li>
                    <li class="nav"><a href="cinema.html">Cinema</a></li>
                </ul>
            </nav>
        </div>

        <ul class="breadcrumb">
            <li><a href="home.php">Home</a></li>
            <li><a href="movies.html">Movie</a></li>
            <li><?php echo $movie_name ?></li>
        </ul>

        <div class="content">
            <!---------------------------------------------------------------content here---------------------------------------------------->
            
            <div class="mini_wrapper">
                <h2 class="movie_title"><?php echo $movie_name ?></h2>
                <p class="rating">(<?php echo $rating?>)</p>
                <hr class="movie_title">
                <br>
                <div class="individual_mov">
                    <div id="img">
                        <img src="<?php echo $image_dir ?>" alt="movie poster">
                    </div>
                    <div id="info">
                        <div id="details">
                            <h3>Details</h3>
                            <table class="individual_mov">
                                <tr>
                                    <td rowspan="2" class="label">Cast: </td>
                                    <td rowspan="2" class="detail"><?php echo $cast ?></td>
                                    <td class="label">Release:</td>
                                    <td class="detail"><?php echo $release_date ?></td>
                                </tr>
                                <tr>
                                    <td class="label">Running Time: </td>
                                    <td class="detail"><?php echo $duration ?> mins</td>
                                </tr>
                                <tr>
                                    <td class="label">Director: </td>
                                    <td class="detail"><?php echo $director ?></td>
                                    <td class="label">Distributor: </td>
                                    <td class="detail"><?php echo $distributor ?></td>
                                </tr>
                                <tr>
                                    <td class="label">Genre: </td>
                                    <td class="detail"><?php echo $genre ?></td>
                                    <td class="label">Language: </td>
                                    <td class="detail"><?php echo $language ?></td>
                                </tr>
                            </table>
                        </div>
                        <div id="synopsis">
                            <h3>Synopsis</h3>
                            <p><?php echo $synopsis ?></p>
                        </div>
                    </div>
                </div>
                <div class="booking">
                    <!-------------------------BOOKNG CODES HERER-------------------------->
                    <form class="booking" action="book_form.php" method="get">
                        <table class="booking">
                        <tr>
                            <td>
                                Please Choose Date and Timing for Movie: <br><br>Date: 
                                <Select name = "date"> // drop down table for dates
                                    <option value = "2-Nov-2023">2/11/23</option>
                                    <option value = "3-Nov-2023">3/11/23</option>
                                    <option value = "4-Nov-2023">4/11/23</option>
                                </select>
                                <br><br>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <br>
                                <input class="ticket_timing_button" name = "timingButton" type="submit" value="2:00 pm" >
                                <input class="ticket_timing_button" name = "timingButton" type="submit" value="6:00 pm">
                                <input class="ticket_timing_button" name = "timingButton" type="submit" value="10:00 pm">
                                <input class="ticket_timing_button" name = "timingButton" type="submit" value="12:00 am">
                                <input class="ticket_timing_button" name = "timingButton" type="submit" value="9:00 am">
                                <input class="ticket_timing_button" name = "timingButton" type="submit" value="900:00 am">
                            </td>
                        </tr>
                        </table>
                    </form>
                </div>

            </div>

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

</body>
</html>