<script id="fonctionsPanier">
    function redir(str){
        self.location.href=str;
    }
    function afficherConfirmerDansCommande(){
        let tbody = document.getElementById("tbodypanier");
        let btn = document.getElementById('formConfirmer');
        let nb = tbody.children.length;
        console.log(nb);
        if (nb != 0) {
            btn.style = "display : ;"
        } else {
            setTimeout(redir("search.php"),5000);
            btn.style = "display : none ;"
           
            document.getElementById('waitRedirigey').innerHTML = "Votre panier est vide, Vous allez être redirigé dans 5sec.. vers une autre page pour le remplir";

        }

    }
    function actualiserTOTALTOTAL(){
        let to = document.getElementById('TotalPanierCommande').innerHTML.split('€');
        to = to[0];

        <?php if(isset($reduction)) { ?>

        let redu = <?=$reduction?>;
        document.getElementById('Reduction').innerHTML = '-' + (parseFloat(redu)*100).toString() + "%";
        <?php } else { ?> 
        let redu = 0.00;
        document.getElementById('Reduction').innerHTML = "Aucune";
        <?php } ?>

        let t = document.getElementById('TOTALTOTAL');



        let res = parseFloat(to) *(1-parseFloat(redu));

        t.innerHTML = roundDecimal(res) +"€";
        console.log(to,redu,t);

        let input = document.getElementById('khalassCa');
        input.value = roundDecimal(res);
        console.log(input);

        afficherConfirmerDansCommande();
    }

    function roundDecimal(nb){

        let arrondi = nb*100;          
        arrondi = Math.round(arrondi);
        arrondi = arrondi/100;
        return arrondi;
    }
    function actualiseTotalDansCommande(prix){



        let to = document.getElementById('TotalPanierCommande');
        let s = parseFloat(to.innerHTML);

        s -= parseFloat(prix);
        s = roundDecimal(s);
        console.log("s",s,"prix",prix);
        to.innerHTML = s.toString() + '€';


        actualiserTOTALTOTAL()
    }

    function refreshNbPanier() {
        let tbody = document.getElementById("tbodypanier");
        let ici = document.getElementById("span_nb_panier");

        if (ici != null) {
            let nb = tbody.children.length;
            console.log(nb,ici);

            console.log(nb,ici);
            if (nb != 0) {
                ici.innerHTML = nb;
                affichePasserCommande(true);
            } else {
                ici.innerHTML = "";

                affichePasserCommande(false);
            }
            console.log(nb,ici);
        }
    }
    
   

    function ajoutBDDPanier(idbeat) {
        console.log("ajoutBDD");
        var xmlhttp = new XMLHttpRequest();

        let idboug = <?php if($okconnectey) { echo $_SESSION['user_id'];}else{echo 0;} ?>; 
        let ou = "sendPanierBDD.php?qq="
        ou += idboug.toString();
        ou += "-" + idbeat.toString();
        console.log(ou);
        xmlhttp.open("GET",ou,true);
        xmlhttp.send();
    }

    function supprBDDPanier(idbeat) {
        console.log("supprBDD");
        var xmlhttp = new XMLHttpRequest();

        let idboug = <?php if($okconnectey) { echo $_SESSION['user_id'];}else{echo 0;} ?>; 
        let ou = "deletePanierBDD.php?qq=";
        ou += idboug.toString();
        ou += "-" + idbeat.toString();
        console.log(ou);
        xmlhttp.open("GET",ou,true);
        xmlhttp.send();
    }
    function creer1TR(b_title,b_author,b_price,b_cover,idbeat) {
        let tbody = document.getElementById('tbodypanier');
        let strID =  b_title + b_author + b_price + b_cover;
        strID = strID.trim();
        console.log(strID);
        let tr = document.createElement('tr');

        let prix = b_price.toString();
        if (b_price == 0){
            prix = "FREE";
        } 
        let str = "<th scope='row' class='border-0'> <div class='p-2'> <img src='" + b_cover + "' alt='' width='70' class='img-fluid rounded shadow-sm'> <div class='ml-3 d-inline-block align-middle'> <h5 class='mb-0'> <a href='#' class='text-dark d-inline-block align-middle'>" + b_title + "</a></h5> <span class='text-muted font-weight-normal font-italic d-block'>" + b_author + "</span> </div></div></th><td class='border-0 align-middle'><strong>" + prix + "</strong></td>";
        str += "<td class='border-0 align-middle'><span class='text-dark'><i class='fa fa-trash'></i></span></td>";
        // note : faire du css sur le span pour faire faux lien style
        tr.innerHTML = str ;

        tr.children[2].children[0].setAttribute('onclick','suppr2Panier(this,"' + b_price + '","' + idbeat + '");');
        console.log('ùù');
        tbody.appendChild(tr);
        return strID;

    }

    function go2Panier(btn,b_title,b_author,b_price,b_cover,idbeat) {

        let textIn = "Dans le panier";
        console.log(btn.innerHTML , textIn, (btn.value != textIn))
        // titre, prix

        if (btn.innerHTML != textIn) {

            let strID = creer1TR(b_title,b_author,b_price,b_cover,idbeat)
            btn.innerHTML = textIn;
            //btn.id = strID;

            ajoutBDDPanier(idbeat);


            //                    btn.classList.add(strID);
        } 

        refreshNbPanier();


    }
    function suppr2Panier(icon,euro,idsuppr) {
        console.log("**suppr");
        let tr = icon.parentNode.parentNode;
        let ici = icon.parentNode.parentNode.parentNode;
        console.log(tr,ici);
        ici.removeChild(tr);


        let btn = document.getElementById('btnbeat-'+idsuppr.toString());
        console.log("*",'btnbeat-'+idsuppr,euro,btn); 

        if(btn != null) {
            if(parseFloat(euro) == 0.00) {roro = "FREE";} else {roro = euro + "€"}
            btn.innerHTML = "<i class='fas fa-shopping-cart iconPanierbtn'></i><sup>+</sup>" + roro ;

        }
        supprBDDPanier(idsuppr);
        refreshNbPanier();

        let to = document.getElementById('TotalPanierCommande');
        if (to != null) {
            actualiseTotalDansCommande(euro);
            console.log('actualiseTotalDansCommande()')
        }




    }
</script>

