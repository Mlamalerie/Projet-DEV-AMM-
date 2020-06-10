<div class="table-responsive mx-2  rounded">
    <table class="table  rounded border-success">
        <thead>
            <!--
<tr>
<th scope="col" class="border-0 bg-light">
<div class="py-0  text-uppercase">n</div>
</th>
<th scope="col" class="border-0 bg-light">
<div class="p-2 px-3 text-uppercase"> image</div>
</th>
<th scope="col" class="border-0 bg-light">
<div class="py-2 text-uppercase">like</div>
</th>
<th scope="col" class="border-0 bg-light">
<div class="py-2 text-uppercase">carte</div>
</th>
</tr>
-->
        </thead>
        <tbody class=" rounded">
            <?php
            if ($yadesresultatsBEATS) {$i = 1;foreach($resuBEATS as $r){
            ?>
            <tr class="border-0 rounded px-md-5">
                <td class="pr-0 border-0 align-middle rounded "><strong class="ml-1"><?= $i ?></strong></td>
                <th scope="row" class="border-0 rounded">
                    <div class="p-0 rounded ">
                        <div class="hover hover-5 text-white rounded d-inline-block align-middle">
                            <img src="<?=$r['beat_cover']?>" alt="" width="70" class="img-fluid rounded shadow-sm">
                            <div class="hover-overlay d-inline-block"></div>

                            <div class="link_icon  " onclick="playPause(<?=$i-1 ?>)">
                                <span class="video-icon playplay-btn"></span>
                            </div>

                        </div>
                        <!--                                                    -->

                        <div class="ml-3 d-inline-block align-middle rounded" >
                            <h5 class="mb-0"> <a href="view-beat.php?id=<?= $r['beat_id']?>" class="text-dark d-inline-block align-middle"><?=$r['beat_title']?></a>
                            </h5>

                            <a href="profils.php?profil_id=<?= $r['beat_author_id']?>" class="text-dark d-inline-block align-middle"><span class="text-muted font-weight-normal font-italic d-block">
                                <?=$r['beat_author']?>
                                </span>
                            </a>
                        </div>
                    </div>

                </th>
                <!-- **LIKE -->
                <?php if($okconnectey) {  ?>
                <td class="border-0 align-middle rounded">

                    <span id="span_nbLike-<?=$r['beat_id']?>"><?=$r['beat_like']?></span>

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
                    <span onclick="goLikeuh(this,'<?=$r['beat_id']?>')" class=" iconLike text-dark coeur_active"><i class="fas fa-heart"></i></span>
                    <?php    } else { ?> 
                    <span onclick="goLikeuh(this,'<?=$r['beat_id']?>')" class=" iconLike text-dark"><i class="far fa-heart"></i></span>
                    <?php } ?>
                </td>
                <?php } ?>

                <!-- **AJOUTER PANIER -->
                <td class="border-0 align-middle rounded">

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
                if(!$okdejaacheter) {

                    if(($okconnectey && $r['beat_author_id'] != $_SESSION['user_id']) || !$okconnectey) { ?>
                    <button id='btnbeat-<?=$r['beat_id']?>' 

                            <?php if($okconnectey) { ?>
                            onclick="go2Panier(this,'<?=$r['beat_title']?>','<?=$r['beat_author']?>', '<?=$r['beat_price']?>', '<?=$r['beat_cover']?>','<?=$r['beat_id']?>');" <?php }else { ?> onclick="goConnexionStp();"  <?php } ?>

                            class="btn btn-danger"


                            >



                        <?php if(!$okdejadanspanier) { ?>
                        <i class="fas fa-shopping-cart iconPanierbtn"></i><sup>+</sup>
                        <?php if($r['beat_price'] != 0.00) { echo $r['beat_price'].'€'; } else {echo "FREE";} ?>
                        <?php } ?>

                    </button>
                    <?php } } else {?>
                    <a class="btn btn-danger" href="audio/<?= $r['beat_source']?>" download>
                        <span class="text-white"><i class="fas fa-download"></i></span>
                    </a>
                    <?php } ?>
                    <?php  if($okdejadanspanier) {?>
                    <script>document.getElementById('btnbeat-<?=$r['beat_id']?>').innerHTML = 'Dans le panier';</script>
                    <?php } ?>


                </td>



            </tr>
            <?php
                $i++;}}
            else { ?>
                
                Aucun résultat;
            <?php } ?>

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

