<!-- Bandeau avec la recherche et les filtres (a faire si motivée) -->
<div>

</div>

<!-- Liste des Produits -->
<?php if (!empty($products)) : ?>
    <div>
        <?php foreach ($products as $product) : ?>
            <h3><?=htmlspecialchars($product['label'])?></h3>
            <span><?=htmlspecialchars($product['prix'])?>€</span>

            <!-- Association de la categorie avec le produit -->
            <?php foreach ($categories as $cat) : 
                if ($cat['id_cat']==$cat['id_cat']) :?>
                    <span><?=htmlspecialchars($cat['nom_cat'])?></span>
                <?php endif; ?>
            <?php endforeach; ?>

            <p><?=htmlspecialchars($product['description'])?></p>
            <a href="/">Plus d'information</a>
            <button type="button">Ajouter au panier</button>
        <?php endforeach; ?>
    </div>
<?php else : ?>
    <p>Aucun produit trouvé.</p>
<?php endif; ?>