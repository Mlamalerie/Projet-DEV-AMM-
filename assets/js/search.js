
function goSearcheuh() {
    console.log("*goSearch*");

    var ok = false;
    var champs = document.getElementById('searchbar');
    var baysearch = champs.value.trim();




    ok = (baysearch != "");
    console.log(champs,baysearch,ok);
    ok = false;
    if (ok) {

        document.getElementById("searchform").submit();
    }

}


function goGenre(bay){


    // si il ya l'icon croix alors 
    if ("fa-times-circle" == bay.children[0].classList[1] ) {
        console.log("croix");

    }
    // si il ya l'icon rond alors 
    else {
        console.log("rond");

        // recuperer le genre
        gr = bay.children[1].innerHTML;
        console.log("gr : ",gr);
        if (gr == "All Genres") {gr = "All";}

        // cration d'un input

        let ici = document.getElementById('icigenre');
        let avant = document.getElementById('wewegenre');

        if (ici.children.length < 2) {
            let input = document.createElement('input');
            input.id = 'valGenreMenu';
            input.type = 'hidden';
            input.name = 'Genre';

            // poser le genre sur le input d'envoie
            input.value = gr;

            ici.insertBefore(input,avant);
        }

    }

    ok = true;
    if (ok) {
        document.getElementById('formGenre').submit();

    }
}


function goPrice(bay) {
    // si il ya l'icon croix alors 
    if ("fa-times-circle" == bay.children[0].classList[1] ) {
        console.log("croix");

    }
    // si il ya l'icon rond alors 
    else {
        console.log("rond");

        // recuperer le genre
        fr = bay.children[1].innerHTML;
        console.log("fr : ",fr);
        if (fr == "Free Beats") {fr = "free";}

        // cration d'un input

        let ici = document.getElementById('iciprice');
        let avant = document.getElementById('weweprice');

        if (ici.children.length < 2) {
            let input = document.createElement('input');
            input.id = 'valPriceMenu3';
            input.type = 'hidden';
            input.name = 'Price';

            // poser le genre sur le input d'envoie
            input.value = fr;
            ici.insertBefore(input,avant);
        }

    }



    ok = true;
    if (ok) {
        document.getElementById('formPrice').submit();

    }



}


function goPrice2range(){

    console.log("**");

}
function goTrier(bay){
    ok = true;
    if (ok) {
        document.getElementById('formTrie').submit();

    }

}