
    <?php
    echo("<h2>Liste des services</h2>");
    
    for ($i=0; $i < count($listeServices); $i++){ 
        $service = $listeServices[$i]-> getNom();
        $id = $listeServices[$i]-> getId();
        $prix = $listeServices[$i]-> getPrix();
        
        echo("<section class='service'>");
        
        echo ("<a  href=\"index.php?action=detailservices&id=$id\"> $service </a>");
        echo ("<p> Prix : $prix € </p> <br/> ");
        echo ("</section>");
       
    } 
  


