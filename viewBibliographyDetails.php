<?php

require_once "login.php";



 try{
    $pdo=new PDO($attribute, $user, $password);
    // echo "Lidhja u krye me sukses <br>";
}

catch(PDOException $e)
{
  echo "Lidhja nuk u krye, ndodhi nje gabim $e->getMessage() dhe ka nr $e->getCode()";
}

 ?>

<!DOCTYPE html>
 <html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Bibliography Details</title>
    <link rel="stylesheet" href="mainStyling.css">
  </head>
  <body>
    <div id="general">

    <header>
      <h1>Bibliography</h1>
      <nav>
        <ul>
          <li><a href="index.php"class='actualPosition'>Home</a></li>
          <li><a href="searchBibliography.html" >Search Items</a></li>
          <li><a href="#">Log In</a></li>
          <li><a href="#">Add New Items</a></li>
        </ul>
      </nav>
    </header>


    <section class="">
      <?php
      $id=$_POST['id'];

       $query= "SELECT ID,imageURL, caption, title, author, yearPublication, publisher,edition,briefContent FROM bibliographies
       WHERE ID=$id";

       if(!$result=$pdo->query($query))
       echo "gabim ne query";
       else {
       $row=$result->fetch(PDO::FETCH_BOTH);

      ?>
      <article class="">
        <figure>
          <img src='images\<?php echo $row["imageURL"]; ?>' alt='<?php echo $row["caption"]; ?>'>
          <figcaption><?php echo $row["caption"];?></figcaption>
        </figure>
        <hgroup>
          <h3>Title:<?php echo $row["title"];?> </h2>
          <h3>Author:<?php echo $row["author"];?></h2>
          <h3>Year of Publication:<?php echo $row["yearPublication"];?></h2>
          <h3>Publisher:<?php echo $row["publisher"];?></h2>
          <h3>Edition:<?php echo $row["edition"];?></h3>
        </hgroup>
        <p><?php echo $row["briefContent"];?>
        </p>

      </article>
    </section>
    <?php
      }

  $pdo=null;
  ?>
    <footer>&copy;2022 Bibliography</footer>

  </div><!-- end of div general -->

  </body>
  </html>
