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