
 <?php 
  include("include/db.php");

    $id=$_GET['id'] ? intval($_GET['id']) : 0;

  try{
    $sql="SELECT * FROM products WHERE id=:id LIMIT 1";
    $stmt=$conn->prepare($sql);
    $stmt->bindParam(":id",$id,PDO::PARAM_INT);
    $stmt->execute(); 
  }catch(Exception $e){
    echo "Error ".$e->getMessage();
    exit();
  }
  if(!$stmt->rowCount()){
      header("Location: index.php");
      exit();
  }
  $product=$stmt->fetch();
//   var_dump($product);
//   exit();
 
 ?>
 <?php include("include/header.php") ?>
    <!-- End Hero Image -->
    <div class="container">
    <a href="index.php" class="btn btn-light mb-3"><< Go back</a>
 <?php if(isset($_GET['status']) && $_GET['status'] == "updated") :?>
         <div class="alert alert-success" role="alert">
             <strong>Updated</strong>
        </div>
     <?php  endif ?>


  <?php if(isset($_GET['status']) && $_GET['status'] == "fail_update") :?>
         <div class="alert alert-danger" role="alert">
             <strong>Fail Updated</strong>
        </div>
        <?php  endif ?>
      <div class="card border-danger">
            <div class="card-header bg-danger text-white">
                <strong><i class="fa fa-plus"></i> Edit Product</strong>
            </div>
            <div class="card-body">
                <form action="update.php" method="post">
                <input type="hidden" name="id" value="<?= $product['id']?>">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="barcode" class="col-form-label">Barcode</label>
                            <input type="text" value="<?= $product['barcode']  ?>" class="form-control" id="barcode" name="barcode" placeholder="Barcode" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="name" class="col-form-label">Name</label>
                            <input type="text" class="form-control" value="<?= $product['name']  ?>" id="name" name="name" placeholder="Name" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="price" class="col-form-label">Price</label>
                            <input type="number" class="form-control" id="price" value="<?= $product['price']  ?>" name="price" placeholder="Price" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="qty" class="col-form-label">Qty</label>
                            <input type="number" class="form-control" name="qty" value="<?= $product['qty']  ?>" id="qty" placeholder="Qty" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="img" class="col-form-label">Image</label>
                            <input type="text" class="form-control" value="<?= $product['image']  ?>" name="img" id="img" placeholder="Image URL">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="note" class="col-form-label">Description</label>
                        <textarea name="description" id="" rows="5"  class="form-control" placeholder="Description"><?= $product['description']  ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> Update</button>
                </form>
            </div>
        </div>
    </div><!-- /.container -->
    <?php include("include/footer.php") ?>