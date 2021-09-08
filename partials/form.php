  <!-- We use enctype for the image upload -->


<form action="" method="POST" enctype="multipart/form-data" class="form">

<?php $image = $image ?? null ?>


    <?php if ($image): ?>

        <div class="text-center">
            <img class="product-img" src="<?php echo $product["image"] ?>" alt="">
        </div>

    <?php endif ?>

    
      
        <div class="form-group">
            <label for="exampleInputEmail">Title</label>
            <input name="title" type="text" class="form-control" id="exampleInputEmail"
            aria-describedby="emailHelp" placeholder="Name" value="<?php echo $title ?>">
        </div>
  

    
        <div class="form-group">
            <label for="exampleInputPrice">Price</label>
            <input name="price" type="number" step=".01" value="<?php echo $price ?>"
            class="form-control" id="exampleInputPrice" placeholder="Price">
        </div>
    
  

    
        <div class="form-group">
            <label for="exampleInputPassword">Description</label>
            <textarea name="description" type="text" class="form-control"
            id="exampleInputPassword" placeholder="Description"><?php echo $description ?></textarea>
        </div>
   

    
        <div class="form-group">
            <label for="exampleInputImage">Image</label>
            <input name="image" type="file">
        </div>
  
    
    

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="index.php" type="button" class="btn btn-primary">Go Back</a>
        </div>

    </div>
        
   
</form> 



   