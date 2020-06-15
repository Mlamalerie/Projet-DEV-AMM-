<!--    TABLE DU PANIER -->

<div class="table-responsive">

    <table class="table">
        <thead>
            <tr>
                <th scope="col" class="border-0 bg-light">
                    <div class="p-2 px-3 text-uppercase">Produits</div>
                </th>

                <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase">Action</div>
                </th>
            </tr>
        </thead>
        <?php if($okconnectey) { ?>
        <tbody id="tbodypanier">
            <?php 

    $req = $BDD->prepare("SELECT *
                                            FROM beat
                                            WHERE beat_author_id = ?");
    $req->execute(array($_SESSION['user_id']));
    $resuUP = $req->fetchAll();

    foreach($resuUP as $b) {




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
                    <a href="edit-tracks.php?id=<?= $b['beat_id'] ?>"><button class="btn">Modifier</button></a>                                                                           
                    <button class="btn" data-toggle="modal" data-target="#supp_modal" onclick="goInputOption(this,'<?= $b['beat_id'] ?>','<?= $b['beat_title']?>')" value="suppr"><i class='fa fa-trash'></i></button>
                </td>


            </tr>


            <?php

    }
}


            ?>
        </tbody>
    </table>
    <script type="text/javascript">
        function goInputOption(bay,idd,blaz){
            let mode = bay.value;
            console.log(mode,idd,blaz);

            var p = document.getElementById('phraseConfirm');
            var iO = document.getElementById('inputOption');
            var iO_id = document.getElementById('inputOption_beat_id');

            iO.value = mode;
            iO_id.value = idd;

            if (mode == 'suppr'){
                p.innerHTML = "supprimer le beat " + blaz + " ?";   
            }
            console.log(iO,iO_id);
        } 
    </script>


    <!-- Modal -->
    <div class="modal fade" id="supp_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Êtes vous sûr de vouloir <span id="phraseConfirm"></span>
                    <form method="post" id="formOptionConfirm" action="">
                        <input type="hidden" name="inputOption" id="inputOption">
                        <input type="hidden" name="inputOption_beat_id" id="inputOption_beat_id">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
                    <button onclick="document.getElementById('formOptionConfirm').submit()" type="button" class="btn btn-primary">Oui</button>
                </div>
            </div>
        </div>
    </div>

    <!-- END Modal -->
</div>

