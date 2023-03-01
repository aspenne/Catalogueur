<?php

include("../../php/id.php");

class Article {

    private $vendeur;
    private $libelle;
    private $description;
    private $categorie;
    private $prix_ht;
    private $prix_ttc;
    //private $url_image;
    private $note_produit;

    // Constructor 
    public function __construct($vendeur, $libelle, $description, $categorie, $prix_ht, $prix_ttc, $note_produit) {
        $this->vendeur = $vendeur;
        $this->libelle = $libelle;
        $this->description = $description;
        $this->categorie = $categorie;
        $this->prix_ht = $prix_ht;
        $this->prix_ttc = $prix_ttc;
        //$this->url_image = $url_image;
        $this->note_produit = $note_produit;
    }

    public function toArray() {
        return array(
            'vendeur' => $this->vendeur,
            'libelle' => $this->libelle,
            'description' => $this->description,
            'categorie' => $this->categorie,
            'prix_ht' => $this->prix_ht,
            'prix_ttc' => $this->prix_ttc,
            //'url_image' => $this->url_image,
            'note_produit' => $this->note_produit   
        );
    }
}


$length = ($_GET['length']); // get the length of the array pass in the url

for ($i=0; $i < $length; $i++) { 
    $tab[$i] = ($_GET['id_produit'.$i]); // get the id of each article
}

$i = 0;

$dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass);

foreach ($tab as $id){

    // return array of id, libelle, descr, id_categorie, prix_ht ,prix_ttc 
    $stmt = $dbh->prepare("SELECT id_vendeur, libelle, descr, id_categorie, prix_ht ,prix_ttc  FROM alizon.produit WHERE id_produit = ". $id);
    $stmt->execute();
    $article_info = $stmt->fetch(PDO::FETCH_NUM); // simple array instead of associative array

    // return the libelle of the categorie
    $stmt2 = $dbh->prepare("SELECT C.libelle from Alizon._produit P inner join Alizon._categorie C ON  P.id_categorie = C.id_categorie where id_produit = ". $id);
    $stmt2->execute();
    $categorie_info = $stmt2->fetchColumn();  // return the first column of the first row ( just 1 value returned)

    // return the libelle of the categorie
    $stmt3 = $dbh->prepare("SELECT note_produit FROM alizon._produit WHERE id_produit = ". $id);
    $stmt3->execute();
    $note_produit = $stmt3->fetchColumn();  // return the first column of the first row ( just 1 value returned)

    $tab_to_json[$i] = array(
        $article_info[0], // id_vendeur
        $article_info[1], // libelle
        $article_info[2], // descr
        $article_info[3], // id_categorie
        $article_info[4], // prix_ht
        $article_info[5], // prix_ttc
        $categorie_info,  // categorie
        $note_produit     // note
    );

    $i++;

}   

sort($tab_to_json);

$j = 0;

foreach ($tab_to_json as $data) {
    $vendeur = $data[0];
    $libelle = $data[1];
    $descr = $data[2];
    $id_categorie = $data[3];
    $prix_ht = $data[4];
    $prix_ttc = $data[5];
    $categorie = $data[6];
    $note_produit = $data[7];
    $article = new Article($vendeur, $libelle, $descr, $categorie, $prix_ht, $prix_ttc, $note_produit);
    $articles[$j] = $article->toArray();
    $j++;
}



// Encode the array to JSON
$json = json_encode($articles, JSON_PRETTY_PRINT);

// Write the JSON to a file
file_put_contents('../samples/mono.json', $json);

/*

// Create Artcile Objects
$article1 = new Article('vendeur1', 'libelle1', 'description1', 'categorie1', 'prix_ht1', 'prix_ttc1', 'url_image1', 'note_produit1');
$article2 = new Article('vendeur2', 'libelle2', 'description2', 'categorie2', 'prix_ht2', 'prix_ttc2', 'url_image2', 'note_produit2');
$article3 = new Article('vendeur3', 'libelle3', 'description3', 'categorie3', 'prix_ht3', 'prix_ttc3', 'url_image3', 'note_produit3');


// Put all articles in an array
$data = array(
    'article1' => $article1->toArray(),
    'article2' => $article2->toArray(),
    'article3' => $article3->toArray()
);


// Encode the array to JSON
$json = json_encode($data, JSON_PRETTY_PRINT);

// Write the JSON to a file
file_put_contents('../samples/mono.json', $json);

*/

header("location:/php/Liste_produit_vendeur.php");

?>
