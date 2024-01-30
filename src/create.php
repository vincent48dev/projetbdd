<?php
    include 'head.php';
?>
<?php
    $index = 0;
    if(
        isset($_POST['libelle'])
        && isset($_POST['domaine'])
        && isset($_POST['link']) 
        && (isset($_POST['cats']) && count($_POST['cats'])!== 0)
        && strlen($_POST['libelle']) < 300
        && strlen($_POST['link']) < 1000 
        ){
             $result = $pdo->query("INSERT INTO `favori` (`id_fav`, `libelle`, `date_creation`, `url`, `id_dom`) VALUES 
             ('[value-1]','".htmlspecialchars($_POST['libelle'])."', NOW() ,'".htmlspecialchars($_POST['link'])."',".htmlspecialchars($_POST['domaine']).");");
             $favori = $result->fetch(PDO::FETCH_ASSOC);

            $dernier_id = $pdo -> lastInsertId();
            foreach($_POST['cats'] as $_POST['cat']){
                 $result2 = $pdo->query("INSERT INTO `cat_fav`(`id_fav`, `id_cat`) VALUES (".$dernier_id.",".htmlspecialchars($_POST['cat']).");");
                 $catfav = $result2->fetch(PDO::FETCH_ASSOC);
            };
             header('Location: index.php');
             exit();
    }else{
        if( isset($_POST['libelle'])
        && isset($_POST['domaine'])
        && isset($_POST['link']) 
        && (isset($_POST['cats']) && count($_POST['cats'])!== 0)
        && strlen($_POST['libelle']) < 300
        && strlen($_POST['link']) < 1000 ){

            $result = $pdo->query("INSERT INTO `favori` (`id_fav`, `libelle`, `date_creation`, `url`, `id_dom`,) VALUES 
            ('[value-1]','".htmlspecialchars($_POST['libelle'])."', NOW() ,'".htmlspecialchars($_POST['link'])."',".htmlspecialchars($_POST['domaine']).");");
            $favori = $result->fetch(PDO::FETCH_ASSOC);
            $dernier_id = $pdo -> lastInsertId();

            foreach($_POST['cats'] as $_POST['cat']){
             $result2 = $pdo->query("INSERT INTO `cat_fav`(`id_fav`, `id_cat`) VALUES (".$dernier_id.",".htmlspecialchars($_POST['cat']).");");
             $catfav = $result2->fetch(PDO::FETCH_ASSOC);
            };
            header('Location: index.php');
            exit();
        }else{

        }

    };    
?>
<header class = 'flex justify-center'>
    <h1 class = 'dark:text-white text-2xl'>Créer un nouveau favoris</h1>
</header>
    <section class = "w-full flex justify-center my-10">
        <form class=" w-full md:w-2/6" action="" method="POST">

            <div class ="my-12 px-4 flex justify-center">
                
                <input type="text" name="libelle" id="lib" required size="50" class = " block w-full p-2 ps-10 text-sm
                text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500
                dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500
                dark:focus:border-blue-500 " placeholder = "your bookmark name here">
            
            </div>
            <div class = " my-12 px-4 w-full flex justify-center flex-wrap">
                <span class = " flex flex-col">
                    <label class = "dark:text-white" for="domaine">nom de domaine</label>
                    <select class="rounded-lg p-2" name="domaine" id="domaine">
                        <?php
                            $data1 = $pdo->query("SELECT * FROM `domaine` ORDER BY `id_dom` ASC;");
                            $domaines = $data1->fetchAll(PDO::FETCH_ASSOC);
                            ?>

                            <!-- création auto des options par domaines -->
                            <?php
                            foreach($domaines as $domaine){?>
                            <option class="" value="<?php echo $domaine['id_dom'] ?>"><?php echo $domaine['nom_dom'] ?></option>
                            <?php
                            };
                        ?>
                        <!-- création auto des options par domaines -->
                        
                    </select>
                </span>
                <span class = " flex flex-col w-full mx-6">
                    <label class = "dark:text-white" for="link">lien</label>
                    <input type="url" name="link" id="link" required size="50" class = "  block w-full p-2 ps-10 text-sm
                    text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500
                    dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500
                    dark:focus:border-blue-500 " placeholder = "place URL here">
                </span>
            </div>
            <div class = " my-12 px-4  dark:text-white">
                <?php
                    $data = $pdo->query("SELECT * FROM `categorie` ORDER BY `id_cat` ASC;");
                    $categories = $data->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <h3 class = "text-center py-2">catégorie</h3>
                <span class = " flex justify-center flex-wrap">
                    <?php
                    foreach($categories as $categorie){?>

                        <span>

                            <input class = "m-2" type="checkbox" name="cats[cat<?php echo $categorie['id_cat'] ?>]" 
                            id="<?php echo $categorie['nom_cat'] ?>" value = "<?php echo $categorie['id_cat'] ?>">
                            <label class = "m-2" for="<?php echo $categorie['nom_cat'] ?>"><?php echo $categorie['nom_cat'] ?></label>
                        </span>
                    <?php
                    };
                    ?> 
                </span>

            </div>
            
            <div class = " my-12 px-4 flex justify-center flex-wrap dark:text-white">
                <textarea name="description" id="description" cols="30" rows="10" block class = "w-full p-2 ps-10 text-sm
                    text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500
                    dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500
                    dark:focus:border-blue-500 " placeholder = "bookmarks description here" maxlength = "16000000"></textarea>
            </div>
            <span class ="flex justify-center">
            <button class = "dark:text-white  bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none
            focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700
            dark:focus:ring-blue-800">create</button>
            </span>
            
        </form>
    </section>



    
<?php
    include 'footer.php'
?>