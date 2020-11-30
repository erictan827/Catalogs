<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Search Results</title>
</head>
<body>
    <h1>Book Search Results</h1>
    <?php
    // TODO 1: Create short variable names.
    $searchtype=$_POST['searchtype'];
    $searchterm=$_POST['searchterm'];

    // TODO 2: Check and filter data coming from the user.
    if (!$searchtype || !$searchterm) {
    echo 'You have not entered anything. 
          Please try again.';
    exit;
  }

    // TODO 3: Setup a connection to the appropriate database.
    $conn=new mysqli('localhost','root','','publications');
    if($conn->connect_error) die("Fatal Error");

    // TODO 4: Query the database.
    $query = "select * from catalogs where ".$searchtype." like '%".$searchterm."%'";
    $result = $conn->query($query);

    // TODO 5: Retrieve the results.
    $num_results=$result->num_rows;
    echo "<p>Number of books found: ".$num_results."</p>";

    // TODO 6: Display the results back to user.
    for ($i=0; $i <$num_results; $i++){
     $row = $result->fetch_assoc();
     echo "<p>".($i+1).". Title: ";
     echo htmlspecialchars(stripslashes($row['title']));
     echo "</strong><br />Author: ";
     echo stripslashes($row['author']);
     echo "<br />ISBN: ";
     echo stripslashes($row['isbn']);
     echo "<br />Price: ";
     echo stripslashes($row['price']);
     echo "</p>";
    }



    // TODO 7: Disconnecting from the database.
    $conn->close();

    ?>
</body>
</html>