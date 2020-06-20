<!--    TABLE DU PANIER -->

<div class="table-responsive">

    <table class="table">
        <thead>
            <tr>
                <th scope="col" class="border-0 ">
                    <div class="p-2 px-3 text-uppercase text-light">Produits</div>
                </th>
                
                <th scope="col" class="border-0 ">
                    <div class="py-2 text-uppercase text-light">Télécharger</div>
                </th>
            </tr>
        </thead>
        <?php if($okconnectey) { ?>
        <tbody id="tbodypanier">
            <?php 
  

    foreach($resuACHAT as $p) {

        $req = $BDD->prepare("SELECT *
                                            FROM beat
                                            WHERE beat_id = ?");
        $req->execute(array($p['vente_beat_id']));
        $resuPAN = $req->fetchAll();

        foreach($resuPAN as $b) {




            ?> 

            <tr class="rounded border-bottom border-light">



                <th scope='row' class='border-0'>
                    <div class='p-2'>
                        <img src='<?=$b['beat_cover'] ?>' alt='' width='70' class='img-fluid rounded shadow-sm'>
                        <div class='ml-3 d-inline-block align-middle'> 
                            <h5 class='mb-0'> <a href="view-beat.php?id=<?= $b['beat_id']?>" class='text-dark d-inline-block align-middle'><?=$b['beat_title'] ?></a>
                            </h5>
                            <a href="profil.php?profil_id=<?= $b['beat_author_id']?>" class="text-dark d-inline-block align-middle"> <span class='text-muted font-weight-normal font-italic d-block'><?=$b['beat_author'] ?></span></a> 
                        </div>
                    </div>
                </th>
              
                <td class='border-0 align-middle'>
                    <a href="audio/<?= $b['beat_source']?>" download>
                        <span class="text-black"><i class="fas fa-download"></i></span>
                    </a>
                </td>


            </tr>


            <?php

        }
    }


            ?>
            
          
            
            <?php    } ?>

        </tbody>
    </table>
      <?php if(count($resuACHAT) == 0) { ?>
                Vous n'avez encore rien acheté.. <a href="search.php?Type=beats&sort=nouveaute"> Faire mon shopping</a>
                
           <?php } ?>

</div>

