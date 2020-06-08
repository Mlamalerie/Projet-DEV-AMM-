<!--    TABLE DU PANIER -->

<div class="table-responsive">

    <table class="table">
        <thead>
            <tr>
                <th scope="col" class="border-0 bg-light">
                    <div class="p-2 px-3 text-uppercase">Produits</div>
                </th>
                <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase">Prix</div>
                </th>
                <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase">Télécharger</div>
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
                    <a href="audio/<?= $b['beat_source']?>" download>
                        <svg class="bi bi-download" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M.5 8a.5.5 0 0 1 .5.5V12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V8.5a.5.5 0 0 1 1 0V12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V8.5A.5.5 0 0 1 .5 8z"/>
                            <path fill-rule="evenodd" d="M5 7.5a.5.5 0 0 1 .707 0L8 9.793 10.293 7.5a.5.5 0 1 1 .707.707l-2.646 2.647a.5.5 0 0 1-.708 0L5 8.207A.5.5 0 0 1 5 7.5z"/>
                            <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-1 0v-8A.5.5 0 0 1 8 1z"/>
                        </svg>
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

</div>

