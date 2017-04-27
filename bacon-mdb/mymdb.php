<!--Project 5 - Degrees of Bacon
    Author: Venus Yu
    Version: 11/12/2015
    Type in the fields!-->

<!DOCTYPE html>
<html>
  <head>
        <title>My Movie Database (MyMDb)</title>
        <meta charset="utf-8" />
        <link href="images/favicon.png" type="image/png" rel="shortcut icon" />

        <!-- Link to your CSS file that you should edit -->
        <link href="bacon.css" type="text/css" rel="stylesheet" />
    </head>

    <body>
        <div id="frame">
        
            <?php
                include("common-top.php");
            ?>

            <main>

                <h1>The One Degree of Kevin Bacon</h1>
                <p>
                    Type in an actor's name to see if he/she was ever in a movie with Kevin Bacon!
                </p>    
                <p>
                    <img src="images/kevin_bacon.jpg" alt="Kevin Bacon" />
                </p>    


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



