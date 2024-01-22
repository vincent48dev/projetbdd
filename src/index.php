<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./output.css" rel="stylesheet">
  
  <script src="https://kit.fontawesome.com/862e2d197c.js" crossorigin="anonymous"></script>
</head>
<body class = "bg-gray-400">
  <h1 class="text-3xl font-bold underline mt-5 text-center mb-5 decoration-blue-800 text-blue-800">
    PROJET BDD
  </h1>
  <?php include("pdo.php");?>
<?php
$result = $pdo->query("SELECT * FROM favori");
$favoris = $result->fetchAll(PDO::FETCH_ASSOC); 
?>

  <section class="w-full flex justify-center mt-28">
    <table class="w-5/6">
        <tr class = "border-2 bg-blue-400">
            <th class ="border-2">id_fav</th>
            <th class ="border-2">libelle</th>
            <th class ="border-2">date de creation</th>
            <th class ="border-2">url</th>
            <th class ="border-2">Edition/Supression</th>
        </tr>
         <?php
          foreach($favoris as $favori){ 
        ?>
        <tr class = "border-2 odd:bg-slate-200 even:bg-slate-400 hover:bg-slate-600">
            <td class ="border-2 py-2"><?php echo $favori['id_fav'];?></td>
            <td class ="border-2"><?php echo $favori['libelle'];?></td>
            <td class ="border-2"><?php echo $favori['date_creation'];?></td>
            <td class ="border-2"><?=$favori['url'];?></td>
            <td class = "text-center border-2"><button class = "mx-4 w-1/5 bg-blue-600 rounded-lg hover:bg-slate-200"><i class="fa-solid fa-pen-to-square"></i></button><button class = "mx-4 w-1/5 bg-red-400 rounded-lg hover:bg-slate-200"><i class="fa-solid fa-trash"></i></button></td>
        </tr>
        <?php
         }
         ?>
    </table>
  </section>
  <footer>
    <h2 class ="text-center mt-16" >designbyLacanaille@FricandeauForever</h2>
  </footer>
</body>
</html>