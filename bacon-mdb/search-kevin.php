<!--Project 5 - Degrees of Bacon
    Author: Venus Yu
    Version: 11/12/2015
    Searches for all the movies the specified actor and Kevin Bacon are in together-->

<!DOCTYPE html>
<html>
    <head>
        <title>MyMDb - Results</title>
        <meta charset="utf-8" />
        <link href="images/favicon.png" type="image/png" rel="shortcut icon" />

        <!-- Link to your CSS file that you should edit -->
        <link href="bacon.css" type="text/css" rel="stylesheet" />
    </head>

    <body>
        
        <?php
            $first = ucwords($_GET["firstname"]);
            $last = ucwords($_GET["lastname"]);
        
            $dbname = "minimdb";
            $host = "localhost";
            $username = "minimro";
            $password = "1sodb4u";
            
            try {
                $db = new PDO("mysql:dbname=$dbname;host=$host",$username, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch (PDOException $error) {
        ?>
                <p>Sorry, a database error occurred.</p>
                <p>Error details: <?= $error->getMessage()?></p>
        <?php
            }
  
        ?>
        
        <div id="frame">
            
            <?php
                include("common-top.php");
            ?>
                    

            <main>
                
                <?php
                    $id_query = "SELECT id, film_count FROM actors WHERE first_name LIKE '$first%' && last_name = '$last' ORDER BY film_count DESC";
                    $id_result = $db->query($id_query);
                    $id_fetch = $id_result->fetch();
                    $id = $id_fetch['id'];
                    
                    //Kevin Bacon's ID number is 22591, hence its appearance in the query below.
                    $query = "SELECT name, year FROM movies as m, roles as r1, roles as r2 WHERE m.id = r1.movie_id && m.id = r2.movie_id && r1.actor_id = '$id' && r2.actor_id = '22591' ORDER BY year, name";
                    $result = $db->query($query);
                    $result_array = $result->fetchAll();    
                    $length = count($result_array);
                
                    if ($id == null) {
                        print "<h1>$first $last not found D:</h1>";
                    }
                
                    elseif ($result_array == null) {
                        print "<h1>$first $last shares no movies with Kevin Bacon D:</h1>";
                    }
                
                    else {
                        print "<h1>Results for $first $last with Kevin Bacon</h1>";
                        print "<p>Films with $first $last and Kevin Bacon</p>";
                    
                        print "<table>";
                        print "<tr><th>#</th><th>Title</th><th>Year</th></tr>";
                        for ($i = 1; $i <= $length; $i++) {
                            $movie_title = $result_array[$i-1]['name'];
                            $movie_year = $result_array[$i-1]['year'];
                            print "<tr>";
                            print "<td>$i</td>";
                            print "<td>$movie_title</td>";
                            print "<td>$movie_year</td>";
                            print "</tr>";
                        }
                        print "</table>";  
                    } 
                
                $db = null;
                      
                ?>
                
                <!-- form to search for every movie by a given actor -->
                <form action="search-all.php" method="get">
                    <fieldset>
                        <legend>All movies</legend>
                        <div>
                            <input name="firstname" type="text" size="12" placeholder="first name" autofocus="autofocus" /> 
                            <input name="lastname" type="text" size="12" placeholder="last name" /> 
                            <input type="submit" value="go" />
                        </div>
                    </fieldset>
                </form>

                <!-- form to search for movies where a given actor was with Kevin Bacon -->
                <form action="search-kevin.php" method="get">
                    <fieldset>
                        <legend>Movies with Kevin Bacon</legend>
                        <div>
                            <input name="firstname" type="text" size="12" placeholder="first name" /> 
                            <input name="lastname" type="text" size="12" placeholder="last name" /> 
                            <input type="submit" value="go" />
                        </div>
                    </fieldset>
                </form>
            </main>
            
            <?php
                include("common-bottom.php");
            ?>

        </div> <!-- end of #frame div -->
    </body>
</html>



