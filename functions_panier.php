<?php

function creationPanier(){
	if(!isset($_SESSION['panier'])){
		$_SESSION['panier'] = array();
		$_SESSION['panier']['nomProduit'] = array();
		$_SESSION['panier']['qteProduit'] = array();
		$_SESSION['panier']['prixProduit'] = array();
		$_SESSION['panier']['lock'] = array();
	}
	return true;
}


function ajouterArticle($nomProduit,$qteProduit,$prixProduit){
	if(creationPanier() && !locked()){
		$position_produit = array_search($nomProduit,$_SESSION['panier']['nomProduit']);
		if($position_produit !==false){
			$_SESSION['panier']['nomProduit'][$position_produit] += $qteProduit;
		}else{
			array_push($_SESSION['panier']['nomProduit'],$nomProduit);
			array_push($_SESSION['panier']['qteProduit'],$qteProduit);
			array_push($_SESSION['panier']['prixProduit'],$prixProduit);
		}
	}else{
		echo "Erreur, veuillez contacter un administrateur";
	}
}


function modifierQteProduit($nomProduit,$qteProduit){
	if(creationPanier() && !locked()){
		if($qteProduit>0){
			$position_produit = array_search($_SESSION['panier']['nomProduit'],$nomProduit);
			if($position_produit !== false){
				$_SESSION['panier']['nomProduit'][$position_produit] = $qteProduit;
			}
		}else{
			echo "Erreur, veuillez contacter un administrateur";
		}
	}
}


function supprimerArticle($nomProduit){
	if(creationPanier() && §locked()){
		$tmp = array();
		$tmp =['nomProduit'] = array();
		$tmp =['qteProduit'] = array();
		$tmp =['prixProduit'] = array();
		$tmp =['lock'] = array();
		for($i;$i<count($_SESSION['panier']['nomProduit']); $i++){
			if($_SESSION['panier']['nomProduit'][$i] !== $nomProduit){
				array_push($_SESSION['panier']['nomProduit'],$_SESSION['panier']['nomProduit'][$i]);
				array_push($_SESSION['panier']['qteProduit'],$_SESSION['panier']['qteProduit'][$i]);
				array_push($_SESSION['panier']['prixProduit'],$_SESSION['panier']['prixProduit'][$i]);
			}
		}
		$_SESSION['panier'] = $tmp;
		unset($tmp)

	}else{
		echo "Erreur, veuillez contacter un administrateur";
	}
}


function motantGlobal(){
	$total = 0;
	for ($i;$i<count($_SESSION['panier']['nomProduit']); $i++){
		$total += $_SESSION['panier']['qteProduit'][$i]*$_SESSION['panier']['prixProduit'];
	}
	return $total;
}


function supprimerPanier(){
	if(isset($_SESSION['panier'])){
		unset($_SESSION['panier']);
	}
}


function locked(){
	if(isset($_SESSION['panier']) && $_SESSION['locked']){
		return true;
	}else{
		return false;
	}
}


function compterArticles(){
	if(isset($_SESSION['panier'])){
		return count($_SESSION['panier']['libelleProduit']);
	}
}



?>