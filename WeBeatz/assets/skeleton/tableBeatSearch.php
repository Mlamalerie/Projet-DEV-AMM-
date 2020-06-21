<div class="table-responsive mx-2  rounded">
    <table class="table  rounded border-success">
        <thead>

        </thead>
        <tbody id="tbodyTableBeatSearch" class=" rounded">
            <?php


            if ($yadesresultatsBEATS) {foreach($resuBEATS as $key => $r){


            ?>
            <tr class=" rounded">
                <td class="pr-0 border-0 align-middle   "><strong class="ml-1"><?= ($key+1) ?></strong></td>
                <!--  ** Image Titre-->
                <th scope="row" class="border-0  ">
                    <div class="p-0 rounded ">
                        <div class="hover hover-5 text-white rounded d-inline-block align-middle">
                            <img src="<?=$r['beat_cover']?>" alt="" width="70" class="img-fluid rounded shadow-sm">
                            <div class="hover-overlay d-inline-block"></div>

                            <div id="btnplay-<?= $r['beat_id']?>" class="link_icon  " onclick="playPause(<?=($key + $decal) ?>,<?= $r['beat_id']?>)">
                                <span class="play-audio-icon playplay-btn"></span>
                            </div>

                        </div>
                        <!--                                                    -->

                        <div class="ml-3 d-inline-block align-middle rounded" >
                            <h5 class="mb-0"> <a href="view-beat.php?id=<?= $r['beat_id']?>" class="font-weight-bol text-light d-inline-block align-middle"><?=$r['beat_title']?></a>
                            </h5>


                            <span class="text-muted font-weight-normal font-italic d-block ">by <a href="profil.php?profil_id=<?= $r['beat_author_id']?>" class="text-dark d-inline-block "><span class="text-muted font-weight-normal font-italic d-block">

                                <?=$r['beat_author']?>
                                </span>
                                </a></span>
                        </div>
                    </div>

                </th>

                <!--  **Tags -->
                <td scope="row" class=" border-0 align-middle  ">
                    <?php  $tags = explode(',',$r['beat_tags']); ?>
                    <div class="p-0 rounded ">
                        <?php foreach($tags as $t) {
                if(strlen($t)>1){
                    $t = trim($t);

                        ?>
                        <a class="spanTag  badge badge-light text-dark px-2 rounded-pill ml-2" href="search.php?Type=beats&q=<?= $t ?>">#<?= $t ?> </a>
                        <?php }} ?>
                    </div>

                </td>
                <!-- **LIKE -->
                <?php if($okconnectey) {  ?>
                <td class="border-0 align-middle  ">



                    <span id="span_nbLike-<?=$r['beat_id']?>" class="text-light"><?=$r['beat_like']?></span>

                    <?php
                $oktaliker = false;
                                        $req = $BDD->prepare("SELECT id FROM likelike WHERE like_user_id = ? AND like_beat_id = ?");
                                        $req->execute(array($_SESSION['user_id'],$r['beat_id']));
                                        $lll = $req->fetch();

                                        if(isset($lll['id'])){
                                            $oktaliker = true;
                                        }
                    ?>
                    <?php if ($oktaliker) { ?>
                    <span onclick="goLikeuh(this,'<?=$r['beat_id']?>')" class=" iconLike coeur_active"><i class="fas fa-heart  "></i></span>
                    <?php    } else { ?> 
                    <span onclick="goLikeuh(this,'<?=$r['beat_id']?>')" class=" iconLike "><i class="far fa-heart"></i></span>
                    <?php } ?>
                </td>
                <?php } ?>

                <!-- **AJOUTER PANIER -->
                <td class="border-0 align-middle px-2 ">

                    <?php 
                $okdejadanspanier = false;
                $okdejaacheter = false;
                if($okconnectey) {
                    $req = $BDD->prepare("SELECT *
                                                                                        FROM vente
                                                                                        WHERE vente_user_id = ? AND vente_beat_id = ?");
                    $req->execute(array($_SESSION['user_id'],$r['beat_id']));


                    $ach = $req->fetch();


                    if(isset($ach['id'])){
                        $okdejaacheter = true;
                    }else {
                        $req = $BDD->prepare("SELECT *
                                                                                        FROM panier
                                                                                        WHERE panier_user_id = ? AND panier_beat_id = ?");
                        $req->execute(array($_SESSION['user_id'],$r['beat_id']));


                        $aff = $req->fetch();



                        if(isset($aff['id'])){
                            $okdejadanspanier = true;
                        }
                    }
                }
                    ?>
                    <?php 
                $okcestpastaprod = ($okconnectey && $r['beat_author_id'] != $_SESSION['user_id']);
                if(!$okdejaacheter) {

                    if($okcestpastaprod || !$okconnectey) { ?>
                    <button id='btnbeat-<?=$r['beat_id']?>' 

                            <?php if($okconnectey) { ?>
                            onclick="go2Panier(this,'<?=$r['beat_title']?>','<?=$r['beat_author']?>', '<?=$r['beat_price']?>', '<?=$r['beat_cover']?>','<?=$r['beat_id']?>');" <?php }else { ?> onclick="goConnexionStp();"  <?php } ?>

                            class="btn btn-buy"


                            >



                        <?php if(!$okdejadanspanier) { ?>
                        <i class="fas fa-shopping-cart iconPanierbtn"></i><sup>+</sup>
                        <?php if($r['beat_price'] != 0.00) { echo $r['beat_price'].'€'; } else {echo "FREE";} ?>
                        <?php } ?>

                    </button>
                    <?php } } else {?>
                    <a class="btn btn-danger" href="<?= $r['beat_source']?>" download>
                        <span class="text-white"><i class="fas fa-download"></i></span>
                    </a>
                    <?php } ?>
                    <?php  if($okdejadanspanier) {?>
                    <script>document.getElementById('btnbeat-<?=$r['beat_id']?>').innerHTML = 'Dans le panier';</script>
                    <?php } ?>



                </td>

                <!--  ** 3 point -->
                <td class="px-2 border-0 align-middle   ">
                    <div id='3point' class="nav-item dropdown no-arrow ">
                        <button class="nav-link dropdown-toggle  dropdown-toggle-pointpoint btn text-light" href="#" id="3pointDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                            <i class="fa fa-ellipsis-v"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in " aria-labelledby="navbarDropdownMenuLink">

                            <?php if(!$okcestpastaprod && $okconnectey ) { ?>
                            <a class="dropdown-item" href="edit-beat.php?id=<?=$r['beat_id']?>">Editer la piste </a>

                            <div class="dropdown-divider"></div>
                            <?php } ?>
                            <a class="dropdown-item" href="view-beat.php?id=<?=$r['beat_id']?>">Aller à la pistes</a>
                            <a class="dropdown-item" href="profil.php?profil_id=<?= $r['beat_author_id']?>">Aller à l'artiste</a>
                        </div>

                    </div>
                </td>


            </tr>
            <?php
            }}
            ?>

            <script >
                function goConnexionStp() {
                    window.location.replace("connexion.php");
                } 



            </script>

            <?php require_once("assets/functions/js-refreshBDD.php"); ?>
            <?php require_once("assets/functions/js-liker.php"); ?>



        </tbody>
    </table>
</div>

