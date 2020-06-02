<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="Test_Mathieu/panierTestMathieu/affichagepanier.css">

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
 
  

  <title>Confirmation de votre commande | WeBeats</title>
</head>
<body>


  <style>
    
    body {
      background: linear-gradient(to right, #13161a, #7327ad)!important;
      background: -webkit-linear-gradient(to right, #eecda3, #ef629f);
      background: linear-gradient(to right, #eecda3, #ef629f);
      min-height: 100vh;
    }
  </style>






  <div class="px-4 px-lg-0">
    <!-- For demo purpose -->
    <div class="container text-white py-5 text-center">
      <h1 class="display-4">Panier WeBeats</h1>
      <p class="lead mb-0">Validez votre commande</p>
    </div>
    <!-- End -->

    <div class="pb-5">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">

            <!-- Shopping cart table -->
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col" class="border-0 bg-light">
                      <div class="p-2 px-3 text-uppercase">Beats</div>
                    </th>
                    <th scope="col" class="border-0 bg-light">
                      <div class="py-2 text-uppercase">Prix</div>
                    </th>
                    <th scope="col" class="border-0 bg-light">
                      <div class="py-2 text-uppercase">Action</div> 
                    </th>
                  </tr>
                </thead>


               






                <tbody>

                  <tr>
                    <th scope="row" class="border-0">
                      <div class="p-2">
                        <img src="https://res.cloudinary.com/mhmd/image/upload/v1556670479/product-1_zrifhn.jpg" alt="" width="70" class="img-fluid rounded shadow-sm">
                        <div class="ml-3 d-inline-block align-middle">
                          <h5 class="mb-0"> <a href="#" class="text-dark d-inline-block align-middle"></a></h5><span class="text-muted font-weight-normal font-italic d-block">Category: Watches</span>
                        </div>
                      </div>
                    </th>
                    <td class="border-0 align-middle"><strong></strong></td>
                    <td class="border-0 align-middle"><strong>3</strong></td>
                    <td class="border-0 align-middle"><a href="#" class="text-dark"><i class="fa fa-trash"></i></a></td>
                  </tr>


                




                </tbody>



              </table>
            </div>
            <!-- End -->
          </div>
        </div>

        <div class="row py-5 p-4 bg-white rounded shadow-sm">
          <div class="col-lg-6">
            <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Code de réduction</div>
            <div class="p-4">
              <p class="font-italic mb-4">Si vous en possédez un, entrez votre code ci-dessous</p>
              <div class="input-group mb-4 border rounded-pill p-2">
                <input type="text" placeholder="Appliquer le code" aria-describedby="button-addon3" class="form-control border-0">
                <div class="input-group-append border-0">
                  <button id="button-addon3" type="button" class="btn btn-dark px-4 rounded-pill"><i class="fa fa-gift mr-2"></i>Appliquer</button>
                </div>
              </div>
            </div>
            
          </div>
          <div class="col-lg-6">
            <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Récapitulatif de votre commande </div>
            <div class="p-4">
              <p class="font-italic mb-4">Attention : aucun remboursement possible après confirmation de votre commande</p>
              <ul class="list-unstyled mb-4">
                <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Prix </strong><strong>$390.00</strong></li>
                <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Réduction appliquée</strong><strong>$10.00</strong></li>
                <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Total</strong>
                  <h5 class="font-weight-bold">$400.00</h5>
                </li>
              </ul><a href="#" class="btn btn-dark rounded-pill py-2 btn-block">Confirmer</a>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>


  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>




</body>
</html>