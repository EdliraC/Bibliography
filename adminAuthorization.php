<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>User Login</title>
    <link rel="stylesheet" href="mainStyling.css">

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
          <li><a href="userLogIn.html">Log In</a></li>
          <li><a href="addItems.html">Add New Items</a></li>
        </ul>
      </nav>
    </header>
    <section class="">
      <article class="">
        <?php
        require_once("login.php");

        try{
          $pdo=new PDO($attribute, $user, $password);
          echo "Lidhja u krye me sukses";
        }
        catch(PDOException $e)
        {
          echo "Lidhja pa sukses";
        }
      //kontrollojme nese perdoruesi ka futur vlera ne NumberFormatter
      if(isset($_POST["email"]) && isset($_POST["password"]) )
      {

        $rezultat=gjej_perdorues($pdo, $_POST["email"]);

        if(!$rezultat)
        echo "No user found with these credentials. Try again!";

        else {

          $psw=$_POST["password"];

          if(password_verify($psw, $rezultat["psw"]))
          {
            echo "Login successfully <br>";
            echo "Name:" .$rezultat["name"]."<br>";
            echo "Surname: ". $rezultat["surname"]."<br>";
            echo "Email: ".$rezultat["email"]."<br>";
          }
          else
            die("Incorrect Password");

        }

      }
      else {
        echo "Enter email and password";
      }


      function gjej_perdorues($pdo, $e)
      {
        $statement=$pdo->prepare(" SELECT * FROM mainadministrator where email=:email ");
        if($statement->bindParam(':email', $e, PDO::PARAM_STR, 32))
        {
          if($statement->execute())
              return $statement->fetch(PDO::FETCH_BOTH);
          else
            return false;
          }
        else
          return false;

      }

        ?>
      </article>
      </section>

  <footer>&copy;2022 Bibliography</footer>
</div><!-- end of div general -->
</body>
</html>
