<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Administrator Registration</title>
    <link rel="stylesheet" href="mainStyling.css">
    <link rel="stylesheet" href="formMainStyling.css">
  </head>
  <body>
    <div id="general">
      <!-- here the main header -->
    <header>
      <h1>Bibliography</h1>
      <nav>
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="searchBibliography.html">Search Items</a></li>
          <li><a href="userLogIn.html"  class='actualPosition'>Log In</a></li>
          <li><a href="#">Add New Items</a></li>
        </ul>
      </nav>
    </header>


        <section class="">
          <article class="">
            <?php
            require_once "login.php";



             try{
                $pdo=new PDO($attribute, $user, $password);
                echo "Lidhja u krye me sukses <br>";
            }

            catch(PDOException $e)
            {
              echo "Lidhja nuk u krye, ndodhi nje gabim $e->getMessage() dhe ka nr $e->getCode()";
            }

            if(isset($_POST["name"]) && isset($_POST["surname"]) && isset($_POST["email"]) && isset($_POST["password"]))
            {
                $emer=$_POST["name"];
                $mbiemer=$_POST["surname"];
                $email=$_POST["email"];
                $password=$_POST["password"];
            }
            $hashPassword=password_hash($password, PASSWORD_DEFAULT);

            //echo $hashPassword;
            add_user($pdo, $emer, $mbiemer, $email, $hashPassword);


            function add_user($pdo, $e, $m, $email, $p)
            {
              $statement=$pdo->prepare("INSERT INTO mainadministrator(ID, name, surname,email,psw) VALUES('',:emer, :mbiemer, :email, :password)");

              if($statement->bindParam(':emer', $e, PDO::PARAM_STR, 32 )&&
                  $statement->bindParam(':mbiemer', $m, PDO::PARAM_STR, 32 )&&
                  $statement->bindParam(':email', $email, PDO::PARAM_STR, 32 )&&
                  $statement->bindParam(':password', $p, PDO::PARAM_STR, 255 ))
            {
                  if($statement->execute())

                        echo "<br>Insert me sukses <br>". $statement->rowCount()." perdorues i ri i rregjistruar <br>";

                      else
                      echo "<br>Gabim ne ekzekutim";
                    }
            }


            ?>
              <a href="userLogIn.html">Click here to LogIn</a>
            </article>
        </section>


      <footer>&copy;2022 Bibliography</footer>

      </div><!-- end of div general -->

      </body>
      </html>
