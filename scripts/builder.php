<?php 

// get the json file
if (file_exists('../samples/mono.json')) {
    $data = file_get_contents('../samples/mono.json');
} else {
    $data = file_get_contents('../samples/multi.json');
}

// decode the json
$json_tab = json_decode($data, true);

// get the seller info
$json_tab_seller_info = $json_tab['sellers'];

// get the article info
$json_tab_article = $json_tab['article'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
	<script src="https://kit.fontawesome.com/5a505a91f9.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="builder.css">
</head>
<body>
    <?php
    $page = 1;
    foreach ($json_tab_seller_info as $key_seller => $value_seller) {
        $note = $value_seller['note_vendeur'];
        $stars_full = floor($note);
        $stars_half = round($note - $stars_full);
    ?>
    <section class="seller-page">
		<div class="name-rate">
			<h1> <?php echo $value_seller['nom_vendeur'] ?> </h1>
			<div class="name-rate">
            <?php for ($i = 1; $i <= 5; $i++) {
                if ($i <= $stars_full) {
                    ?><i class="fa-solid fa-star"></i><?php
                } else if ($i == $stars_full + 1 && $stars_half > 0) {
                    ?><i class="fa-solid fa-star-half-stroke"></i><?php
                } else {
                    ?><i class="far fa-star"></i><?php
                }
            } ?>
            </div>
		</div>
		<div class="logo">
			<img src="<?php echo $value_seller['url_logo']?>" alt="Logo du vendeur">
		</div>
		<article class="bottom-page">
			<article class="presentation-text">
				<h2> Présentation du Vendeur </h2>
				<p> <?php $value_seller['presentation']?></p>
			</article>
			<div class="about-seller">
				<article class="about1">
					<p class="siret"> <b>SIRET</b> <?php echo $value_seller['siret']?> </p>
					<p class="tva"> <b>TVA</b> <?php echo $value_seller['tva_intracommunautaire']?></p>
				</article>
				<article class="about2">
					<p class="contact"> <b>Contact	</b> <?php echo $value_seller['mail_vendeur'] ?></p>
					<p class="adresse"> <b>Adresse</b> <?php echo $value_seller['adresse_postale'] ?> </p>
				</article>
			</div>
			
		</article>
		<div class="bottom"> 
			<p> Page <?php echo $page ?> / 4</p>
		</div>
	</section>
    <?php $page++; ?>
    <?php 
    $nb_article = 0;
    foreach ($json_tab_article as $key_article => $value_article) {
        if ($value_article['vendeur'] == $key_seller) { // if the article is from the seller
            if ($nb_article % 4 == 0){ ?>
                <section class="product-list">
            <?php } ?>
            <?php $nb_article++; ?>
            <article class="product">
			<div class="product-image">
				<h3> <?php $value_article['libelle'] ?> </h2>
				<img src="<?php echo $value_article['url_image1']?>" alt="Image du produit <?php echo $nb_article ?>">
			</div>
			<div class="product-info">
				<p> <?php echo $value_article['description'] ?> </p>
			</div>
			<div class="product-price">
				<p class="price-ttc">Prix TTC: <?php echo $value_article['prix_ttc'] ?> €</p>
				<p class="price-ht">Prix HT: <?php echo $value_article['prix_ht'] ?> €</p>
			</div>
		</article>
        <?php if ($nb_article % 4 == 0){ ?>
                <div class="bottom">
                    <p> Page <?php echo $page ?> / 4</p>
                    <?php $page++; ?>
                </div>
            </section> 
            <?php } 
        }  
    }
    print($nb_article);
    if ($nb_article % 4 != 0){ ?>
        <div class="bottom">
            <p> Page <?php echo $page ?> / 4</p>
            <?php $page++; ?>
        </div>
    </section> <?php } ?>
    <?php } ?>
</body>
</html>
