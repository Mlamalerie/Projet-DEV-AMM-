<?php
session_start();
$_SESSION['ici_index_bool'] = false;

include('assets/db/connexiondb.php');
/*active ça si tu veux pas te voir dans la liste si t'es connecté*/
if(isset($_SESSION['user_id'])){
    $afficher_membres =$BDD->prepare("SELECT * FROM user WHERE user_id <> ?");
    $afficher_membres->execute(array($_SESSION['user_id']));
} 
else{
    $afficher_membres =$BDD->prepare("SELECT * FROM user");
    $afficher_membres->execute();
}


/*$afficher_membres->execute();*/
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php        require_once('assets/skeleton/headLinkCSS.html');
        ?>
        <link rel="stylesheet" type="text/css" href="assets/css/navbar.css">
        <link rel="stylesheet" type="text/css" src="assets/css/utilisateurs.css">
        <title>All Users</title>

        <style>

            .profil_card {
                font-family: Montserrat, sans-serif; 
                background: #fff;
                user-select: none;
                margin: 100px auto;
                color: #B3B8CD;
                border-radius: 5px; 
                width: 350px;
                text-align: center; 
                box-shadow: 0px 10px 20px -10px rgba(0,0,0,0.75);
            }
            .cover-photo{
                background:url(img/cover.jpg);
                height:160px;
                width:100%;
                border-radius:5px 5px 0px 0px;
            }
            .profile{
                height:120px;
                width:120px;
                border-radius:50%;
                margin:93px 0px 0px -175px; 
                border:1px solid #f0f0f0; 
                padding:7px;
                background: #f0f0f0;
            }
            .profile-name{
                font-size:25px;
                font-weight : bold; 
                margin: 27px 0px 0px 120px;
            }
            .msg-btn{
                margin:10px 0px 40px 0px; 
                background:rgba(121, 6, 247,1);
                border: 1px solid rgba(121, 6, 247,0.5); 
                padding:10px 25px; 
                color: #ffffff; 
                border-radius: 3px; 
                cursor:pointer; 
            }
            .follow-btn{
                margin:10px 0px 40px 0px;
                border: 1px solid rgba(121, 6, 247,0.5); 
                padding:10px 25px; 
                border-radius: 3px; cursor:pointer; 
                margin-left:10px; 
                background: transparent;
                color:rgba(121, 6, 247,1);
            }
            .membre-btn{
                margin:0px 0px 40px 0px; 
                background:rgba(121, 6, 247,1);
                border: 1px solid rgba(121, 6, 247,0.5); 
                padding:10px 25px; 
                color: #ffffff; 
                border-radius: 3px; 
                cursor:pointer;
            }
            .membre-btn-voir{
                color:white;
            }
            .membre-btn-voir:hover{
                transition: ease-out .5s all ;/*animation de sortie*/
                color: white;
                text-decoration: none;
                background: rgba(121, 6, 247,0.9);
            }

        </style>

    </head>
    <body>
         <!--   ************************** NAVBAR  **************************  -->

        <?php
        require_once('assets/skeleton/navbar.php');
        ?>
        <br/><br/><br/><br/>

        <div class="container">
            <div class="row">
                <?php
                foreach($afficher_membres as $am){
                ?>
                <div class="container profil_card">
                    <div class="cover-photo">
                        <img src="img/<?= $am['user_image']?>" class="profile">
                    </div>

                    <div class="profile-name">
                          <?=$am['user_pseudo']?>
                    </div>
                    <button class="msg-btn">DM</button>
                    <button class="follow-btn">Follow</button>
                    <br/>
                    <div class="membre-btn">
                        <a href="profils.php?profil_id=<?= $am['user_id']?>" class="membre-btn-voir">Voir Profil</a>
                    </div>
                </div>
                <?php     
                }
                ?>
            </div>
        </div>


    </body>
</html>