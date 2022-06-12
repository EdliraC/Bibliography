<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Add new items</title>
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
          <li><a href="addItems.html" class='actualPosition'>Add New Items</a></li>
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
              // print_r($_FILES["imageURL"]);
              //
              // if(isset($_FILES["imageURL"]["name"]))
              // {
              //   $imageURL=$_FILES["imageURL"]["name"];
              //   if(!move_uploaded_file($_FILES["imageURL"]["tmp_name"],$imageURL))
              //     die("No upload successfull");
              //   else
              //     echo $imageURL;
              // }
              // else {
              //   echo "mungese";
              // }
            //
            if(isset($_POST["Title"]) && isset($_POST["Author"])&& isset($_POST["Caption"])&& isset($_POST["yearPublication"])
            && isset($_POST["Publisher"])&& isset($_POST["Edition"]) && isset($_POST["briefContent"]) && isset($_FILES["imageURL"]["name"])
            )
            {
                $title=$_POST["Title"];
                $author=$_POST["Author"];
                $caption=$_POST["Caption"];
                $year=$_POST["yearPublication"];
                $publisher=$_POST["Publisher"];
                $edition=$_POST["Edition"];
                $brief=$_POST["briefContent"];
                //image upload
                $imageURL=$_FILES["imageURL"]["name"];
                if(!move_uploaded_file($_FILES["imageURL"]["tmp_name"],$imageURL))
                  die("No upload successfull");


            }
              else
                echo "All fields are required to be filled.<br>";

                //shto te dhenat ne tabele
                add_newItem($pdo,$title, $author, $caption, $year, $publisher, $edition, $brief, $imageURL );

//function that add the new bibliography item
                function add_newItem($connect, $t, $a, $c, $y, $p, $e, $b, $iURL)
                {
                  $statement=$connect->prepare("INSERT INTO bibliographies(ID, imageURL, caption, title, author, yearPublication, publisher, edition, briefContent) VALUES('',:imgURL, :caption, :title, :auth, :yearPub,
                    :publisher, :edition, :briefContent)");

                    if($statement->bindParam(':imgURL', $iURL, PDO::PARAM_STR, 200 )&&
                        $statement->bindParam(':caption', $c, PDO::PARAM_STR, 150 )&&
                        $statement->bindParam(':title', $t, PDO::PARAM_STR, 100 )&&
                        $statement->bindParam(':auth', $a, PDO::PARAM_STR, 200 )&&
                        $statement->bindParam(':yearPub', $y, PDO::PARAM_INT )&&
                        $statement->bindParam(':publisher', $p, PDO::PARAM_STR, 150 )&&
                        $statement->bindParam(':edition', $e, PDO::PARAM_INT )&&
                        $statement->bindParam(':briefContent', $b, PDO::PARAM_STR, 600 ))
                        {
                        if($statement->execute())

                              echo "<br>Insert successfully <br>". $statement->rowCount()." new item registered <br>";

                            else
                            echo "<br>Error during insertion";
                          }

                }


            ?>
              <a href="index.php">Click here to view new item</a>
            </article>
        </section>


      <footer>&copy;2022 Bibliography</footer>

      </div><!-- end of div general -->

      </body>
      </html>
