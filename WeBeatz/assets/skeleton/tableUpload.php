<!--    TABLE DE MES UPLOAD -->
<?php $decal =0 ; ?>
<div class="table-responsive">

    <table class="table">
        <thead>
            <tr>
                <th scope="col" class="border-0  ">
                    <div class="p-2 px-3 text-uppercase text-light">Produits</div>
                </th>

                <th scope="col" class="border-0  ">
                    <div class="py-2 text-uppercase text-light">Action</div>
                </th>
            </tr>
        </thead>
        <?php if($okconnectey) { ?>
        <tbody id="tbodypanier">
            <?php 

   

    foreach($resuUP as  $key => $b) {




            ?> 

            <tr class="rounded ">



                <th scope="row" class="border-0  ">
                    <div class="p-0 rounded ml-4 ">
                        <div class="hover hover-5 text-white rounded d-inline-block align-middle">
                            <img src="<?=$b['beat_cover']?>" alt="" width="70" class="img-fluid rounded shadow-sm">
                            <div class="hover-overlay d-inline-block"></div>

                            <div id="btnplay-<?= $b['beat_id']?>" class="link_icon  " onclick="playPause(<?=($key + $decal) ?>,<?= $b['beat_id']?>)">
                                <span class="play-audio-icon playplay-btn"></span>
                            </div>

                        </div>
                        <!--                                                    -->

                        <div class="ml-3 d-inline-block align-middle rounded" >
                            <h5 class="mb-0"> <a href="view-beat.php?id=<?= $b['beat_id']?>" class="font-weight-bol text-light d-inline-block align-middle"><?=$b['beat_title']?></a>
                            </h5>


                            <span class="text-muted font-weight-normal font-italic d-block ">by <a href="profil.php?profil_id=<?= $b['beat_author_id']?>" class="text-dark d-inline-block "><span class="text-muted font-weight-normal font-italic d-block">

                                <?=$b['beat_author']?>
                                </span>
                                </a></span>
                        </div>
                    </div>

                </th>


                <td class='border-0 align-middle'>
                    <a href="edit-beat.php?id=<?= $b['beat_id'] ?>"><button class="btn text-light">Modifier</button></a>                                                                           
                    <button class="btn btn-dark rounded-pill p-2 text-danger" data-toggle="modal" data-target="#supp_modal" onclick="goInputOption(this,'<?= $b['beat_id'] ?>','<?= $b['beat_title']?>')" value="suppr"><i class='fa fa-trash'></i></button>
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
                    <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-dark">
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

