function go2Panier(btn,b_title,b_author,b_price,b_cover) {

    let textIn = "Dans Panier";
    console.log(btn.innerHTML , textIn, (btn.value != textIn))
    // titre, prix
    let tbody = document.getElementById('tbodypanier');
    if (btn.innerHTML != textIn) {
        let strID =  b_title + b_author + b_price + b_cover;
        strID = strID.trim();
        console.log(strID);
        let tr = document.createElement('tr');
        let str = "<th scope='row' class='border-0'> <div class='p-2'> <img src='" + b_cover + "' alt='' width='70' class='img-fluid rounded shadow-sm'> <div class='ml-3 d-inline-block align-middle'> <h5 class='mb-0'> <a href='#' class='text-dark d-inline-block align-middle'>" + b_title + "</a></h5> <span class='text-muted font-weight-normal font-italic d-block'>" + b_author + "</span> </div></div></th><td class='border-0 align-middle'><strong>" + b_price + "</strong></td>";
        str += "<td class='border-0 align-middle'><span class='text-dark'><i class='fa fa-trash'></i></span></td>";
        // note : faire du css sur le span pour faire faux lien style
        tr.innerHTML = str ;

        tr.children[2].children[0].setAttribute('onclick','suppr2Panier(this, "'+ strID+'","' + b_price + '");');
        console.log('ùù');
        tbody.appendChild(tr);

        btn.innerHTML = textIn;
       // btn.id = strID;
        btn.classList.add(strID);
    } else {
        console.log('ee');

    }


}
function suppr2Panier(icon,dubay,euro) {

    let tr = icon.parentNode.parentNode;
    let ici = icon.parentNode.parentNode.parentNode;
    console.log(tr,ici);
    ici.removeChild(tr);

    let btn = document.getElementsByClassName(dubay);
    
    console.log(btn[0]);
    console.log(btn[1]);
    btn.innerHTML = "<i class='fas fa-shopping-cart  iconPanierbtn'></i><sup>+</sup>" + euro + ' €';



}