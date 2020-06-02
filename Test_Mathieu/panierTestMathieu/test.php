<?php 
session_start();
$connect = mysqli_connect("localhost", "root", "", "test");

if(isset($_POST["add_to_cart"]))
{
   if(isset($_SESSION["shopping_cart"]))
   {
      $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
      if(!in_array($_GET["id"], $item_array_id))
      {
         $count = count($_SESSION["shopping_cart"]);
         $item_array = array(
            'item_id'         => $_GET["id"],
            'item_name'       => $_POST["hidden_name"],
            'item_price'      => $_POST["hidden_price"],
            
         );
         $_SESSION["shopping_cart"][$count] = $item_array;
      }
      else
      {
         echo '<script>alert("Article déja ajouté au panier")</script>';
      }
   }
   else
   {
      $item_array = array(
         'item_id'         => $_GET["id"],
         'item_name'       => $_POST["hidden_name"],
         'item_price'      => $_POST["hidden_price"],
         
      );
      $_SESSION["shopping_cart"][0] = $item_array;
   }
}

if(isset($_GET["action"]))
{
   if($_GET["action"] == "delete")
   {
      foreach($_SESSION["shopping_cart"] as $keys => $values)
      {
         if($values["item_id"] == $_GET["id"])
         {
            unset($_SESSION["shopping_cart"][$keys]);
            //echo '<script>alert("Item Removed")</script>';
            echo '<script>window.location="test.php"</script>';
         }
      }
   }
}
?>







<!DOCTYPE html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!-- 
   <link rel="stylesheet" type="text/css" href="test.css">
        -->

    <title>Test Window</title>
  </head>
  <body>




    <style>
      
      .text-col {
          color: #9C27B0!important;
      }

      .btn-wb {
          color: #fff;
          background-color: #9C27B0;
          border-color: #9C27B0;
      }

      .btn-wb:hover {
          color: #fff;
          background-color: #6c1a7a;
          border-color: #6c1a7a;
      }


    </style>







   <?php
               $query = "SELECT * FROM tbl_product ORDER BY id ASC";
               $result = mysqli_query($connect, $query);
               if(mysqli_num_rows($result) > 0)
               {
                  while($row = mysqli_fetch_array($result))
                  {
               ?>
            <div class="col-md-4">
               <form method="post" action="test.php?action=add&id=<?php echo $row["id"]; ?>">
                  <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center">

                     <h4 class="text-info text-col"><?php echo $row["name"]; ?></h4>

                     <h4 class="text-danger"><?php echo $row["price"]; ?>&euro;</h4>

                     

                     <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />

                     <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />

                     <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success btn-wb" value="Acheter" />

                  </div>
               </form>
            </div>
            <?php
                  }
               }
            ?>




    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
      Panier
    </button>

    <br/>
    <br/>
    <br/>
    <i class="fas fa-shopping-bag"></i>












    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Panier WeBeats</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            
            <div class="table-responsive">
               <table class="table table-bordered">
                  <tr>
                     <th width="40%">Nom de l'article</th>
                     
                     <th width="20%">Prix</th>
                     
                     <th width="5%">Action</th>
                  </tr>
                  <?php
                  if(!empty($_SESSION["shopping_cart"]))
                  {
                     $total = 0;
                     foreach($_SESSION["shopping_cart"] as $keys => $values)
                     {
                  ?>
                  <tr>
                     <td><?php echo $values["item_name"]; ?></td>
                     
                     
                     <td><?php echo number_format($values["item_price"], 2);?> &euro;</td>
                     <td><a href="test.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Retirer</span></a></td>
                  </tr>
                  <?php
                        $total = $total + ($values["item_price"]);
                     }
                  ?>
                  <tr>
                     <td colspan="3" align="right">Total</td>
                     <td align="right"><?php echo number_format($total, 2); ?> &euro;</td>
                     <td></td>
                  </tr>
                  <?php
                  }
                  ?>
                     
               </table>
            </div>














          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            <a href="affichagepanier.php?action=add&id=<?php echo $row["id"]; ?>"><button type="button" class="btn btn-primary">Valider</button></a>
          </div>
        </div>
      </div>
    </div>

















    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>



  </body>
</html>
