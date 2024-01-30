<?php
include 'head.php';
?>
    <?php
        $result = $pdo->query("SELECT * FROM `favori` INNER JOIN `domaine` ON favori.id_dom=domaine.id_dom WHERE favori.id_fav= ".$_GET['favori'].";");
        $favoris = $result->fetch(PDO::FETCH_ASSOC); 
        
    ?>
    
    <section class = "dark:text-white flex flex-col justify-center items-center text-xl py-80">
        <h1>VOULEZ VOUS SUPPRIMER LE FAVORI <?php echo $favoris['libelle'] ?></h1>
        <div class = 'flex-row m-10'>
            <button class = 'm-6 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800'> 
                <a href="delete.php?favori=<?php echo $favoris['id_fav']?>">OUI </a>
            </button>

            <button class = 'm-6 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800'>
                <a href="index.php">
                NON
                </a>
            </button>
        </div>
    </section>

    </body>
</html>