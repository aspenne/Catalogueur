<?php 

include("../../php/id.php");

// get the json file
$data = file_get_contents('../samples/mono.json');

// decode the json
$json_tab = json_decode($data, true);

// get the id of the seller
foreach ($json_tab as $key => $value) {
    $json_tab_seller_id[$key] = $value['vendeur'];
}

for ($i = 0; $i < sizeof($json_tab_seller_id); $i++) {
    $json_tab_seller_id[$i] == ($json_tab_seller_id[$i+1]);
    array_splice($json_tab_seller_id, $i, 1);
}

// connect to database
$dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass);

$i = 0;

$json_tab_seller_info = array();

foreach ($json_tab_seller_id as $id_seller) {

    $stmt = $dbh->prepare("SELECT nom_vendeur, raison_sociale, mail_vendeur, adresse_postale, TVA_intracommunautaire, siret, presentation, note_vendeur, url_logo FROM Alizon._Vendeur WHERE id_vendeur = ". $id_seller);
    $stmt->execute();
    $seller_info = $stmt->fetch(PDO::FETCH_ASSOC); // return associative array

    $json_tab_seller_info[$id_seller] = $seller_info;
    $i++;

}

print_r($json_tab_seller_info);


?>