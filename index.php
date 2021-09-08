<?php 


include_once "database/db.php";



$search = $_GET["search"] ?? null;

if ($search) {
  
  // To query the data
  $statement = $pdo->prepare("SELECT * FROM courses WHERE title LIKE :title ORDER BY create_date DESC");
  $statement->bindValue(":title", "%$search%");



} else {
  
  // To query the data
  $statement = $pdo->prepare("SELECT * FROM courses ORDER BY create_date DESC");

}   


$statement->execute();

$products = $statement->fetchAll(PDO::FETCH_ASSOC);





?>


<?php include "partials/header.php" ?>


    <div class="text-center">
      <h1 class="products_text mt-5">My Courses</h1> 

      <a href="create.php">[ Create new course ] </a>
    </div>

    <!-- if there is no attribute in form, it means that, the default value of action is
    current file and the method is GET -->
    <form>
      <div class="input-group my-3">
        <input type="text" class="form-control" placeholder="Search Course" aria-label="Recipient's username"
        aria-describedby="basic-addon2" name="search" value="<?php echo $search?>">
        <div class="input-group-append">
          <button class="btn btn-outline-secondary" type="submit">Search</button>
        </div>
      </div>  
    </form>





    <table class="table mt-4">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Image</th>
            <th scope="col">Bought_Course</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        
        <tbody>
        
        
          <?php foreach($products as $key => $product): ?>

            
              <tr>
                  <th scope="row"><?php echo $key + 1?></th>
                  
                  <td><?php echo $product["title"] ?></td>
                  
                  <td><?php echo "PHP". " " .$product["price"] ?></td>
                  
                  <td><img class="product-img" src="<?php echo $product["image"]; ?>" alt="">
                    <?php if ($product["image"] == false || empty($product["image"])) echo "No file uploaded"; ?>
                  </td>
                  
                  <td><?php echo $product["create_date"] ?></td>
                  
                  <td>
                  
                    <a href="show.php?id=<?php echo $product["id"]; ?>" type="button" class="btn btn-success">Show</a>
                    <a href="update.php?id=<?php echo $product["id"]; ?>" type="button" class="btn btn-primary">Edit</a>
          
              

                                      <!-- Button trigger modal -->
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal">
                      Launch demo modal
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          
                          <form style="display: inline-block" action="delete.php" method="POST">
                              <div class="modal-body">
                              

                                
                                  <h3>Are you sure you want to delete course?</h3>
                
                
                                  <input type="hidden" name="id" value="<?php echo $product["id"]; ?>">
                                  <button type="submit" class="btn mt-5 btn-lg btn-danger delete-btn ">Yes</button>
                                  <button type="button" class="btn mt-5 btn-lg btn-secondary" data-dismiss="modal">No</button>
                              </div>
                          </form>
                          
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                          </div>
                        </div>
                      </div>
                    </div>



                  </td>
              </tr>



            
                
              
          <?php endforeach; ?> 
      
        
        </tbody>
    </table>










<?php include "partials/footer.php" ?>