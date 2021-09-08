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



$title = $product["title"];
$description = $product["description"];
$price = $product["price"];
$image = $product["image"];



?>




<?php include_once "partials/header.php" ?>

    <div class="text-center">

        
    
        <div class="mt-5">
            <?php if ($image): ?>

                <img class="product-img mb-5" src="<?php echo $image ?>" alt="">

            <?php else: ?>

                <p class="show-no-img-text">No Image</p>


            <?php endif; ?> 
        </div>


        
        <h1 class="show-title"><?php echo $title ?></h1>

        <p class="show-content-description">

        <?php if ($description == null): ?>

            <p class="show-no-desc-text">No Description</p>

        <?php else: ?>

            <p class="show-description"><?php echo nl2br($description); ?></p>

        <?php endif; ?>
        
        </p>


        <a href="index.php">[ Back to your courses ]</a>
    </div>


<?php include_once "partials/footer.php" ?>