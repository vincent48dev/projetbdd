<?php include("head.php");?>
<?php
        $result = $pdo->query("SELECT * FROM `favori` INNER JOIN `domaine` ON favori.id_dom=domaine.id_dom
        INNER JOIN `cat_fav` ON favori.id_fav=cat_fav.id_fav INNER JOIN `categorie` ON categorie.id_cat=cat_fav.id_cat
        WHERE favori.id_fav=".$_GET['favori']." LIMIT 1;");
        $favoris = $result->fetchAll(PDO::FETCH_ASSOC); 
    ?>
     <?php
        foreach($favoris as $favori){
        ?>
    <div class="border-y-2 py-2 bg-slate-400">
        <h2 class = " text-center p-2 py-8">
            <?php echo $favori['libelle'] ?>
        </h2>
        <p class = "py-4 text-center">
            id du favoris : <?php echo $favori['id_fav'] ?>
        </p>
        <p class = "py-4 text-center">
            date de création : <?php echo $favori['date_creation'] ?>
        </p>
        <p class = "py-4 text-center">
            liens : <a href="<?php echo $favori['url'] ?>"><?php echo $favori['url'] ?></a>
        </p>
        <p class = "py-4 text-center">
            domaine : <?php echo $favori['nom_dom'] ?>
        </p>
        <ul class = "py-4 text-center">
            catégories : 
            <?php
            foreach($favoris as $favori){
              ?>  
                <li><?php echo $favori['nom_cat'] ?></li>
            <?php
            }
            ?>
            
        </ul>

        <p class="text-center">
            <button class = "px-2  hover:text-sky-600"><i class="fa-solid fa-pen-to-square "></i></button><button class = "px-2 text-red-600 hover:text-red-800"><a href="confirm.php?favori=<?php echo $favori['id_fav'] ?>">
            <i class="fa-solid fa-trash"></i></a></button>
        </p>
    </div>
    <?php
    }
    ?>