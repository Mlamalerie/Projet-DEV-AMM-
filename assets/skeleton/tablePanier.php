
<!--    TABLE DU PANIER -->
<div class="table-responsive">

    <table class="table">
        <thead>
            <tr>
                <th scope="col" class="border-0 bg-light">
                    <div class="p-2 px-3 text-uppercase">Product</div>
                </th>
                <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase">Price</div>
                </th>
                <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase">Remove</div>
                </th>
            </tr>
        </thead>
        <?php if($okconnectey) { ?>
        <tbody id="tbodypanier">
            <?php 
    $req = $BDD->prepare("SELECT *
                            FROM panier
                            WHERE panier_user_id = ?");
    $req->execute(array($_SESSION['user_id']));
    $resuPANIER = $req->fetchAll();

    foreach($resuPANIER as $p) {

        $req = $BDD->prepare("SELECT *
                                            FROM beat
                                            WHERE beat_id = ?");
        $req->execute(array($p['panier_beat_id']));
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
                            <a href="profils.php?profil_id=<?= $b['beat_author_id']?>" class="text-dark d-inline-block align-middle"> <span class='text-muted font-weight-normal font-italic d-block'><?=$b['beat_author'] ?></span></a> 
                        </div>
                    </div>
                </th>
                <td class='border-0 align-middle'><strong><?php if($b['beat_price'] != 0.00) { echo $b['beat_price']; } else { echo "FREE";} ?></strong>
                </td>
                
                <td class='border-0 align-middle'>
                    <span class='text-dark' onclick="suppr2Panier(this,'<?=$b['beat_price'] ?>','<?=$b['beat_id'] ?>');"><i class='fa fa-trash'></i></span>
                </td>

            </tr>

            <?php

        }
    }


            ?>

            <?php    } ?>

        </tbody>
    </table>

</div>

