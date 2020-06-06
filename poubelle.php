let input = document.getElementById("sendbeatspanier");
                                                    input.value += '-' + id1beat.toString();


  let input = document.getElementById("sendbeatspanier");

                                                let ancienbay = input.value.split('-');
                                                let nouveaubay;
                                                let pos = ancienbay.indexOf(idsuppr);
                                                console.log("pos",pos,"'" + idsuppr + "'");
                                                if (pos == -1) {
                                                    //alert('kel ay');
                                                }else {
                                                    ancienbay.splice(pos,pos);
                                                    nouveaubay = ancienbay.join('-');
                                                    input.value = nouveaubay;
                                                }

                                                console.log(ancienbay,nouveaubay,pos);
                                                
                                               
                                              
                                             
                                      <div id="div1" class="form-group mb-2 d-none" >
                                <!--TITLE-->
                                <div class="row">

                                    <label for="b_title"> title </label>
                                </div>

                                <input onkeyup="gogoUpload()" type="text" class="mb-2 text-center form-control rounded-pill shadow-sm px-4" id="b_title" name="b_title" placeholder="Mettez un title pour votre profil"  value="<?php if(isset($b_title)){echo $b_title;}?>" autofocus>

                                <?php
                                if(isset($err_b_title)){
                                    echo "<span class='spanAlertchamp'> ";
                                    echo $icon . $err_b_title ;
                                    echo "</span> ";
                                }
                                ?>

                                <!--GENRE-->
                                <div class="row">

                                    <label for="b_genre"> genre </label>
                                </div>
                                <select name="b_genre" id="b_genre" class="mb-2 text-center form-control rounded-pill  shadow-sm px-4">
                                    <?php 

                                    foreach($listeGenres as $gr){
                                    ?>
                                    <option class=" " value="<?=$gr?>"><?= $gr?></option>
                                    <?php
                                    }
                                    ?>

                                </select>

                                <?php
                                if(isset($err_b_genre)){
                                    echo "<span class='spanAlertchamp'> ";
                                    echo $icon . $err_b_genre ;
                                    echo "</span> ";
                                }
                                ?>
                                <!--ANNEE-->
                                <input onchange="gogoUpload()" onkeyup="gogoUpload()" type="number" min="1900" max="<?= date("Y")+5?>" class="mb-2 text-center form-control rounded-pill  shadow-sm px-4" id="b_year" name="b_year" placeholder="Mettez un year pour votre profil"  value="<?php if(isset($b_year)){echo $b_year;} else { echo date("Y");} ?>" autofocus>


                            </div>
                            <div id="div2" class="form-group mb-2 d-none" >


                                <!--DESCRITION-->
                                <textarea onkeyup="gogoUpload()" id="b_description" name="b_description" class="mb-2 form-control shadow-sm" placeholder="description ici la" value="this.value.trim()"><?php if (isset($b_description)) {echo $b_description;} ?></textarea>

                                <?php
                                if(isset($err_b_description)){
                                    echo "<span class='spanAlertchamp'> ";
                                    echo $icon . $err_b_description ;
                                    echo "</span> ";
                                }
                                ?>
                                <!--TAGS-->
                                <input onkeyup="gogoUpload()" type="text" class="mb-2 text-center form-control rounded-pill  shadow-sm px-4" id="b_tags" name="b_tags" placeholder="Mettez un tags pour votre profil"  value="<?php if (isset($b_tags)) {echo $b_tags;} ?>" autofocus>

                                <?php
                                if(isset($err_b_tags)){
                                    echo "<span class='spanAlertchamp'> ";
                                    echo $icon . $err_b_tags ;
                                    echo "</span> ";
                                }
                                ?>
                            </div>
                            <div id="div3" class="form-group mb-2 d-none" >

                                <!--PRICE-->
                                <p class="custom-control custom-switch m-0">
                                    <input onchange="gogoUpload()" name="freebay" class="custom-control-input" id="freebay" type="checkbox" <?php if(isset($_POST['freebay'])){ ?> checked <?php } ?> >
                                    <label class="custom-control-label " for="freebay"> FREE BEAT</label>

                                </p>
                                <input  onchange="gogoUpload()" onkeyup="gogoUpload()" type="number" step="0.01" min="1" max="10000" class="mb-2 text-center form-control rounded-pill  shadow-sm px-4" id="b_price" name="b_price" placeholder="Mettez un price pour votre profil"  value="<?php if(isset($b_price)){echo $b_price;}?>" autofocus>
                                <?php
                                if(isset($err_b_price)){
                                    echo "<span class='spanAlertchamp'> ";
                                    echo $icon . $err_b_price ;
                                    echo "</span> ";
                                }
                                ?>
                            </div>

  <span id="spanErreurTitle" class="text-danger d-none"> </span>
                            <span id="spanErreurGenre" class="text-danger d-none"> </span>
                            <span id="spanErreurYear" class="text-danger d-none"> </span>
                            <span id="spanErreurDescription" class="text-danger d-none"> </span>
                            <span id="spanErreurTags" class="text-danger d-none"> </span>




//******** AFFICHER DIV1
                            let div1 = document.getElementById("div1");
                            okaffichediv1 = true;
                            if(okaffichediv1) {
                                div1.classList.remove("d-none"); // afficher div 1

                                okaffichediv2 = true;
                                //--titre
                                let erreurTitle = document.getElementById('spanErreurTitle');
                                let title = document.getElementById('b_title').value.trim();

                                if(title.split(' ').length-1 > 2){ // plus de 1 espace
                                    erreurTitle.classList.remove("d-none"); //afficher erreur
                                    erreurTitle.innerHTML = "Votre titre doit comporter au plus 1 espace";
                                    okaffichediv2 = false;
                                }else if (!isAlphanumeric(title)){
                                    erreurTitle.classList.remove("d-none");  //afficher erreur
                                    erreurTitle.innerHTML = "Votre titre doit etes soit lettre soit nombre";
                                    okaffichediv2 = false;
                                    okaffichesubmit = false;
                                } 
                                else if (title.length > 20){
                                    erreurTitle.classList.remove("d-none");  //afficher erreur
                                    erreurTitle.innerHTML = "Titre trop grand";
                                    okaffichediv2 = false;
                                } 
                                else {
                                    erreurTitle.classList.add("d-none");
                                }
                                //--genre

                                //--b_year
                                let maxyea = <?= date("Y")+5?> ;
                                let erreurYear = document.getElementById('spanErreurYear');
                                let year = ( document.getElementById('b_year').value);

                                if(isNumeric(year)){
                                    year2 = parseInt(year);
                                    if (year2 < 1900 || year2 > maxyea) {
                                        erreurYear.classList.remove("d-none");okaffichesubmit = false;
                                        erreurYear.innerHTML = "saisir entre 1900 et 2025 svp";
                                        okaffichediv2 = false;
                                    } else {
                                        erreurYear.classList.add("d-none");

                                    }
                                } else {
                                    erreurYear.classList.remove("d-none");okaffichesubmit = false;
                                    erreurYear.innerHTML = "saisir un chiffre svp";
                                    okaffichediv2 = false;
                                }




                                okaffichediv2 = okaffichediv1 && okaffichediv2 && (title.length > 0 && year.length > 0);
                                //******** AFFICHER DIV2
                                let div2 = document.getElementById("div2");
                                okaffichediv2 =  true;
                                if(okaffichediv2) {
                                    div2.classList.remove("d-none"); //afficher div 2

                                    okaffichediv3 =true;
                                    //-- b_description
                                    let erreurDescription = document.getElementById('spanErreurDescription');
                                    let description = document.getElementById('b_description').value.trim();
                                    let tags = document.getElementById('b_tags');

                                    if(description.length < 1){
                                        tags.classList.add("d-none");
                                        okaffichediv3 = false;

                                    }else if (description.length > 140){
                                        erreurDescription.classList.remove("d-none");
                                        erreurDescription.innerHTML = "Description trop grande";

                                        //                                            tags.classList.add("d-none");
                                        okaffichediv3 = false;
                                    }
                                    else {
                                        erreurDescription.classList.add("d-none");
                                        tags.classList.remove("d-none");
                                    }

                                    //--b_tags
                                    let erreurTags = document.getElementById('spanErreurTags');
                                    let tagsval = tags.value.trim();
                                    let tttag =  tagsval.split(',');
                                    console.log(tttag);
                                    if (tttag.length-1 > 4)  {

                                        erreurTags.classList.remove("d-none");
                                        erreurTags.innerHTML = "Vous ne pouvez mettre que 5 tags max";
                                        okaffichediv3 = false;


                                    }else if(tttag.length > 1) {
                                        okvirgulebzr = false;
                                        for (let i = 0; i < tttag.length; i++ ) {
                                            if(tttag[i] == '') {
                                                okvirgulebzr = true;
                                            }
                                        }
                                        if(okvirgulebzr){
                                            erreurTags.classList.remove("d-none");
                                            erreurTags.innerHTML = "Erreur virgule";
                                            okaffichediv3 = false;
                                        } else {
                                            erreurTags.classList.add("d-none");
                                        }

                                    }

                                    else {
                                        erreurTags.classList.add("d-none");

                                    }

                                    okaffichediv3 =  okaffichediv2 && okaffichediv3 && (description.length > 0 && tagsval.length > 0);
                                    //                                        console.log("okaffichediv3" , okaffichediv3 , (description.length > 0 && tags.length > 0))
                                    //** AFFICHER DIV3
                                    let div3 = document.getElementById("div3");
                                    okaffichediv3 =true;
                                    if(okaffichediv3) {
                                        div3.classList.remove("d-none");


                                        //--freebay
                                        let freebay = document.getElementById('freebay');
                                        let erreurPrice = document.getElementById('spanErreurPrice');
                                        let price = document.getElementById('b_price').value;
                                        if(freebay.checked) {
                                            document.getElementById('b_price').classList.add('d-none');
                                        } else {
                                            document.getElementById('b_price').classList.remove('d-none');
                                            //--price


                                            let price2 = parseFloat(price)
                                            console.log(price);

                                            if (price2 < 1 || price2 > 10000) {

                                                erreurTags.classList.remove("d-none");okaffichesubmit = false;
                                                erreurTags.innerHTML = "Saisir un prix entre 1 et 10000";
                                                okaffichesubmit = false;


                                            }

                                        }

                                        okaffichesubmit = okaffichesubmit && okaffichediv1 && okaffichediv2 && okaffichediv3  ;
                                        console.log("submit :",okaffichesubmit ,"1 :" , okaffichediv1 , "2 :",okaffichediv2 ,"3 :", okaffichediv3  )


                                        if (okaffichesubmit) {
                                            submit.classList.remove("d-none");
                                        }else {
                                            submit.classList.add("d-none");
                                        }


                                    }else { // cacher div 3

                                        div3.classList.add("d-none");
                                        submit.classList.add("d-none");
                                    }

                                }else { // cacher div 2
                                    div2.classList.add("d-none");
                                    submit.classList.add("d-none");
                                }





                            } else { // cacher div 1
                                div1.classList.add("d-none");
                                submit.classList.add("d-none");

                            }
