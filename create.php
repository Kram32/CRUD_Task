<?php 

include_once "database/db.php";


$title = "";
$description = "";
$price = "";


function randomString($n)
{
    $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $str = "";
    
    for ($i = 0; $i < $n; $i++){
        $index = rand(0, strlen($characters) - 1);
        $str .= $characters[$index];
    }

    return $str;
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    
    $title = $_POST["title"];   
    $description = $_POST["description"];
    $price = $_POST["price"];
    $date = date("Y-m-d  H:i:s");

    $errors = [];  

    if (!$title) {
        $errors[] = "Please provide title";
    }

    if (!$price) {
        $errors[] = "Please provide price";
    }


    if(empty($errors)) {
    

    // Image uploaded from browser input
    $image = $_FILES["image"] ?? null;
   
    $imagePATH = "";
    if ($image && $image["tmp_name"]) {

        $imagePATH = "images/".randomString(8)."/".$image["name"];
        mkdir(dirname($imagePATH));

        // var_dump($imagePATH);

        // To upload the files or images
        move_uploaded_file($image["tmp_name"], $imagePATH);
    }       
    
    $statement = $pdo->prepare("INSERT INTO courses (title, description, image, price, create_date)
    VALUES (:title, :description, :image, :price, :date)");

    $statement->bindValue(":title", $title);
    $statement->bindValue(":description", $description);
    $statement->bindValue(":image", $imagePATH);
    $statement->bindValue(":price", $price);
    $statement->bindValue(":date", $date);

    $statement->execute();
    
    header("Location: index.php");

    // $title = "";
    // $description = "";
    // $price = "";

    }



}


?>






<?php include_once "partials/header.php" ?>
    
  <div class="text-center mt-5">
    <h1>Buy new course</h1>
  </div>



    <?php if (!empty($errors)): ?>
       <div class="alert alert-danger">
            <?php foreach($errors as $error): ?>

                <ul>
                    <li><?php echo $error ?></li>
                </ul>

            <?php endforeach; ?>
        </div>

    <?php endif ?>   


    <?php include_once "partials/form.php" ?>
 


<?php include_once "partials/footer.php" ?>
 


