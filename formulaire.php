<script src="">

</script>

<link rel="stylesheet" href="style.css">

<body>
    <form action='' method='post' class='form-example'>
        <div> Prenom : <input type="text" name="prenom"></div>
        <div> nom : <input type="text" name="nom"></div>
        <div> mail : <input type="email" name="mail"></div>
        <div> adresse : <input type="text" name="adresse"></div>
        <div><input type="submit" name=submit value="S'enregistrer"></div>
    </form>
</body>


<?php

try{
    $db = new PDO('mysql:host=localhost;dbname=projet_ssi;charset=utf8','root','');
}catch(PDOException $exec) {
    echo $exec->getMessage();
    exit();
}
if (isset($_POST['submit'])){
    $prenom = filter_var($_POST['prenom'], FILTER_DEFAULT);
    $nom = filter_var($_POST['nom'], FILTER_DEFAULT);
    $mail = filter_var($_POST['mail'],FILTER_SANITIZE_EMAIL);
    $adresse = filter_var($_POST['adresse'], FILTER_DEFAULT);
    $sql = <<<EOSQL
    INSERT INTO `users`(`prenom`, `nom`, `email`, `city`) VALUES (:prenom,:nom,:mail,:adresse)
    EOSQL;
    $res = $db->prepare($sql);
    $exec = $res->execute(array(":prenom"=>$prenom,":nom"=>$nom,":mail"=>$mail,":adresse"=>$adresse));
    if($exec){
        echo "tout s'est bien passé";
    } else {
        echo "pas ouf";
    }
}
?>