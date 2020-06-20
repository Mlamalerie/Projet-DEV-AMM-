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
