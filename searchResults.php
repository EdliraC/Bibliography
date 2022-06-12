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
    <title>Bibliography Results</title>
    <link rel="stylesheet" href="mainStyling.css">

  </head>
  <body>
    <div id="general">
      <!-- here the main header -->
    <header>
      <h1>Bibliography</h1>
      <nav>
        <ul>
          <li><a href="index.php" >Home</a></li>
          <li><a href="searchBibliography.html" class='actualPosition'>Search Items</a></li>
          <li><a href="userLogIn.html">Log In</a></li>
          <li><a href="#">Add New Items</a></li>
        </ul>
      </nav>
    </header>
<!--here show the number of results from search -->
<?php
  $author=$_POST["author"];
  $title=$_POST["title"];
  $publisher=$_POST["publisher"];

  if(!$stm=find_item($pdo, $author, $title, $publisher))
  echo "No successful search!";
  else
  echo $stm->rowCount()." search results";
?>
    <!-- here the place of each item of bibliography -->
    <section class="">
      <?php
          if(!$stm=find_item($pdo, $author, $title, $publisher))

      echo "Kerkimi rezultoi i pasuksesshem. Provo perseri!";
      else {

      while($rowSet=$stm->fetch(PDO::FETCH_BOTH))
       {
      ?>

      <article class="">
         <figure>
           <img src='images\<?php echo $rowSet["imageURL"]; ?>' alt='<?php echo$rowSet["caption"]; ?>'>
           <figcaption><?php echo $rowSet["caption"];?></figcaption>
         </figure>
         <hgroup>
           <h3>Title:<?php echo $rowSet["title"];?> </h2>
           <h3>Author:<?php echo $rowSet["author"];?></h2>
           <h3>Year of Publication:<?php echo $rowSet["yearPublication"];?></h2>
           <h3>Publisher:<?php echo $rowSet["publisher"];?></h2>
           <h3>Edition:<?php echo $rowSet["edition"];?></h3>
         </hgroup>
         <p><?php echo $rowSet["briefContent"];?>
         </p>
         <p>
           <?php echo <<<_OUT
           <form method='post' action='viewBibliographyDetails.php'>
              <input type='text' name='id' value='$rowSet[0]' hidden="hidden">
              <label>View Details
             <input type='submit' hidden="hidden">
               </label>
           </form>

           _OUT;
           ?>

         </p>
      </article>
    </section>

    <?php
  }//end of while EvLoop
}//end of else condition
     ?>

    <footer>&copy;2022 Bibliography</footer>




<?php
function find_item($connect, $a, $t, $p)
{
  $a1="%".$a."%";
  $t1="%".$t."%";
  $p1="%".$p."%";

  $statement=$connect->prepare("SELECT * FROM bibliographies where author LIKE :author AND title LIKE :title AND publisher LIKE :publisher");


  if($statement->bindParam(":author", $a1, PDO::PARAM_STR, 200)&&
      $statement->bindParam(":title", $t1, PDO::PARAM_STR, 100)&&
      $statement->bindParam(":publisher", $p1, PDO::PARAM_STR, 150))
  {
    if($statement->execute())
      return $statement;

    else
        return false;
      }
  else
    return false;

  }//end of function

 ?>

 </body>
</html>
<?php
$pdo=null; ?>
