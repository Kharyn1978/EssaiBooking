<?php 

    session_start(); 

    /* here we include our logging in to the database */
    include("database.php");

    $db= $conn;
    $tableName="hotels";
    $columns= ['hotelId', 'name','address','facilities','price', 'rating','type','thumbnail'];
    $fetchData = fetch_data($db, $tableName, $columns);

    /* we check if we are logged in, if not, go back to index.php*/
    //if (isset($_POST['username']) && isset($_POST['password'])) {
?>
<!DOCTYPE html>
<html lang="en">
    
<?php


/*this is where we fetch our hotels*/

function fetch_data($db, $tableName, $columns){
    if(empty($db)){
        $msg= "Database connection error";
    }elseif(empty($tableName)){
        $msg= "Table Name is empty";
    }else{

        $columnName = implode(", ", $columns);
        $query = "SELECT ".$columnName." FROM $tableName"." ORDER BY hotelId DESC";
        $result = $db->query($query);

        if($result== true){ 
            if ($result->num_rows > 0) {
                $row= mysqli_fetch_all($result, MYSQLI_ASSOC);
                $msg= $row;
            } else {
                $msg= "No Data Found"; 
            }
        }else{
            $msg= mysqli_error($db);
        }
    }
    return $msg;
}
?>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        

        <title>Medie Bookings - Hotels</title>

        <!-- Google font -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,900" rel="stylesheet">

        <!-- Bootstrap -->
        <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

        <!-- Custom stlylesheet -->
        <link type="text/css" rel="stylesheet" href="css/style.css" />

    </head>

    <body>
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    Medie Bookings
                </a>
                <div class="collapse navbar-collapse" id="menu">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">HOME</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">PROFILE</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">BOOKINGS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">COMPARE HOTELS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">LOGOUT</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <div class="section welcomeMessage">
            <h3>Welcome, <?php echo $_SESSION['fullName']?>!</h3>
        </div>

        <div class="section title">
            <h2>Our Hotels</h2>
        </div>

        <div id="hotels" class="container">
            
            <?php
            //We need to store the data found in our database to a variable '$result',
            // and based on that we show the information in our container

            $query = "SELECT hotelId, name, facilities, price, rating, type, address, thumbnail FROM hotels";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                $i=1;
                // Looping through the data from our table
                while($data = $result->fetch_assoc()) {
            ?>

            <a href="viewHotel.php?hotelId=h1" id="hotel-0" class="singleHotel">
                <div class="hotelImage">
                    <img src=<?php echo $data['thumbnail']; ?> alt="Hotel"/>
                    <p class="hotelRating"><?php echo $data['rating']; ?> rating</p>
                </div>

                <div class="hotelInfo">
                    <p class="hotelName"><strong><?php echo $data['name']; ?></strong></p>
                    <p class="hotelType">Type: <strong><?php echo $data['type']; ?></strong></p>
                    <p class="hotelAddress">Address: <strong><?php echo $data['address']; ?></strong></p>
                    <p class="hotelFacilities">Facilities: <strong><?php echo $data['facilities']; ?></strong></p>
                    <p class="hotelPrice">Price: <strong>R<?php echo $data['price']; ?></strong></p>
                    
                </div>
            </a> 

            <?php
                $i++;}} else { 
            ?>
                <h2>No hotels found!</h2>
            <?php } ?>

        </div>
    </body>
</html>
<?php
    /*}else{

    header("Location: index.php");

    exit();

    }*/
?>