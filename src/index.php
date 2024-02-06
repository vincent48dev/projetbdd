
  <?php include("head.php");?>
<!-- zone de filtrage -->
<?php
          // fonction de filtrage (requete sql) :
        if(!empty($_GET['search'])){
          $result = $pdo->query("SELECT domaine.nom_dom, favori.libelle, favori.url, favori.date_creation, favori.id_fav FROM favori INNER JOIN domaine ON favori.id_dom = domaine.id_dom WHERE libelle LIKE '%".$_GET['search']."%' OR nom_dom LIKE '%".htmlspecialchars($_GET['search'])."%' OR url LIKE '%".htmlspecialchars($_GET['search'])."%'");
        } else{
            if(isset($_GET['categorie'],$_GET['categorie']) && $_GET['categorie'] !== "none" && $_GET['domaine'] !== "none"){
                $result = $pdo->query("SELECT * FROM favori INNER JOIN cat_fav ON favori.id_fav=cat_fav.id_fav INNER JOIN domaine ON favori.id_dom=domaine.id_dom INNER JOIN categorie ON cat_fav.id_cat=categorie.id_cat WHERE categorie.id_cat=".htmlspecialchars($_GET['categorie'])." AND domaine.id_dom=".htmlspecialchars($_GET['domaine']).";");
             }else{
                if(isset($_GET['domaine']) && $_GET['domaine'] !== "none" && $_GET['categorie'] == "none"){
                    $result = $pdo->query("SELECT * FROM favori INNER JOIN domaine ON favori.id_dom=domaine.id_dom WHERE domaine.id_dom=".htmlspecialchars($_GET['domaine'])." ORDER BY id_fav ASC;");
            }else{
                if(isset($_GET['categorie']) && $_GET['categorie'] !== "none" && $_GET['domaine'] == "none"){
                    $result = $pdo->query("SELECT * FROM favori INNER JOIN cat_fav ON favori.id_fav=cat_fav.id_fav INNER JOIN domaine ON favori.id_dom=domaine.id_dom INNER JOIN categorie ON cat_fav.id_cat=categorie.id_cat WHERE categorie.id_cat=".htmlspecialchars($_GET['categorie']).";");  
            }else{
                $requestsql= "SELECT * FROM favori INNER JOIN domaine ON favori.id_dom=domaine.id_dom ORDER BY id_fav ASC";
                $result = $pdo->query($requestsql);
      
            }
    
          }
    
          }}
    



      
      $favoris = $result->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <!-- zone de filtrage -->
﻿

 <section class = "w-full flex justify-center text-black">
    <form class = "py-8" action=""method="GET">
      <select class="rounded-md  ml-4" name="categorie" id="formulaire">
        <?php
          $data = $pdo->query("SELECT * FROM `categorie` ORDER BY `id_cat` ASC;");
          $categories = $data->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <option value="none">categorie</option>
        <?php
        foreach($categories as $categorie){?>
        <option class="" value="<?php echo $categorie['id_cat'] ?>"><?php echo $categorie['nom_cat'] ?></option>
        <?php
        };
        ?>
      </select>
      <select class=" rounded-md ml-4" name="domaine" id="formulaire">
        <?php
          $data = $pdo->query("SELECT * FROM `domaine` ORDER BY `id_dom` ASC;");
          $domaines = $data->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <option value="none">domaine</option>
        <?php
        foreach($domaines as $domaine){?>
        <option class="" value="<?php echo $domaine['id_dom'] ?>"><?php echo $domaine['nom_dom'] ?></option>
        <?php
        };
        ?>
      </select>
        <button type="submit" class="border border-blue-400"></button>
      <button class="bg-blue-400 ml-5 border-2 px-4 rounded-md ">filtrer</button>
      <label class="ml-4" for="site-search">Search the site:</label>
        <input class ="rounded-md" type="search" id="" name="search" />
    </form>
  </section>
  <section class= 'flex justify-center'>
    <button class='my-16  bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800'><a href="create.php"><h2 class = ' dark:text-white'>add a bookmark</h2></a></button>
  </section>
  <section class="w-full flex justify-center mt-28">
    <table class="w-5/6">
        <tr class = "border-2 bg-blue-400">
            <th class ="border-2">id_fav</th>
            <th class ="border-2">libelle</th>
            <th class ="border-2">date de creation</th>
            <th class ="border-2 ">url</th>
            <th class ="border-2">Edition/Supression</th>
            <th class ="border-2">A propos</th>
        </tr>
         <?php
          foreach($favoris as $favori){ 
        ?>
        <tr class = "border-2 odd:bg-slate-200 even:bg-slate-400 hover:bg-slate-600">
            <td class ="border-2 py-2"><?php echo $favori['id_fav'];?></td>
            <td class ="border-2"><?php echo $favori['libelle'];?></td>
            <td class ="border-2"><?php echo $favori['date_creation'];?></td>
            <td class ="border-2 "><a href="<?=$favori['url'];?>"><button class= "md:hidden"><i class="fa-solid fa-link"></i></button><p class = "max-md:hidden"><?=$favori['url'];?></p></a></td>
            <td class = "text-center border-2"><button class = "mx-4 w-1/5 bg-blue-600 rounded-lg hover:bg-slate-200"><a href="update.php?favori=<?php echo $favori['id_fav'] ?>"><i class="fa-solid fa-pen-to-square"></i></a></button><button class = "text-red-600 mx-4 w-1/5 bg-blue-400 rounded-lg hover:bg-slate-200"><a href="confirm.php?favori=<?php echo $favori['id_fav'] ?>">
            <i class="fa-solid fa-trash"></i></a></button></td>
            <td class="text-center">
            <button class = "r px-2"><a href="detail.php?favori=<?php echo $favori['id_fav']?>"><p class ="max-md:hidden">plus d'information</p><button class = "md:hidden"><i class="fa-solid fa-eye"></i></button></a></button>
          </td>
        </tr>
        <?php
         }
         ?>
    </table>
  </section>
<?php
  include 'footer.php';
?>