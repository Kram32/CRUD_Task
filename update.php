<?php 


include_once "database/db.php";



$id = $_GET["id"] ?? null;

if (!$id) {
    header("Location:index");
    exit;
}   


$statement = $pdo->prepare("SELECT * FROM courses WHERE id = :id");
$statement->bindValue(":id", $id);
$statement->execute();
$product = $statement->fetch(PDO::FETCH_ASSOC);

    // var_dump($product);
    // exit;


$id = $product["id"];
$title = $product["title"];
$description = $product["description"];
$price = $product["price"];
$image = $product["image"];


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
    
    $statement = $pdo->prepare("UPDATE courses SET title = :title, description = :description,
    image = :image, price = :price WHERE  id = :id");


    $statement->bindValue(":id", $id);
    $statement->bindValue(":title", $title);
    $statement->bindValue(":description", $description);
    $statement->bindValue(":image", $imagePATH);
    $statement->bindValue(":price", $price);
 

    $statement->execute();
    
    header("Location: index.php");

    // $title = "";
    // $description = "";
    // $price = "";

    }



}


?>





<?php include_once "partials/header.php" ?>

    <h1 class="text-center my-5">Update <?php echo $title ?> Course</h1>



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