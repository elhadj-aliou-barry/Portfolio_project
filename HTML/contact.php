<?php 

try{ 
// essaie de connexion :
  $conn = new PDO("mysql:host=localhost;dbname=portfolio_contact_DB", 'elhadj_aliou','93527sokaki') ;
  $conn->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION) ;
  
//si la connexion reussi (c'est à dire si on arrive à ce niveau)
// echo "connexion PDO ok !" ; je commente le echo, car je ne veux pas qu'il s'affiche, c'est juste pour tester si la connexion marche ;
}
catch(PDOException $e) {
  die("Erreur de connexion".$e->getMessage() ) ; // retourne l'erreur rencontré si la connexion echoue et arrete l'execution du programme ;
}

// j'ai verifié que la connexion à la base de donnée a bien reussi, donc je peux passer à la dynamisation

if(isset($_POST['submit'])) { // si le bouton envoyer a ete cliqué, c-a-d si le formulaire est envoyé 
  $prenom = $_POST['prenom'] ;
  $nom = $_POST['nom'] ;
  $sexe = $_POST['genre'] ;          // tout ceci c'est pour faciliter la manipulation apres
  $email = $_POST['email'] ;           // on recupere les valeurs saisi dans ces variables simples
  $message = $_POST['message'] ;

// etape suivante, preparer une requete (ici on usite les parametres nommés ':nom_parametre')
  $requete = $conn->prepare("INSERT INTO visiteur (prenom, nom, email, sexe, message)
                             VALUES(:prenom, :nom , :email, :sexe, :message )" ); 

  // lier les parametres nommés à des valeurs(ici on va les liers aux valeurs recuperés depuis $_Post['']) ;
  $requete->bindvalue(':nom',$nom) ;
  $requete->bindvalue(':prenom',$prenom) ;
  $requete->bindvalue(':email',$email) ;
  $requete->bindvalue(':sexe',$sexe) ;
  $requete->bindvalue(':message',$message) ;

  // maintenant il faut executer la requete preparé, on mettra le resultat dans une variable
  $res_execut = $requete->execute() ;

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page contact</title>
    <link rel="stylesheet" href ="../CSS /Acceuil_style.css"> 
    <link rel="stylesheet" href="../CSS /contact.css "> 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
         <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&family=Kaushan+Script&family=Pacifico&display=swap" rel="stylesheet">
         <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">         
         <link href="https://fonts.googleapis.com/css2?family=Yatra+One&display=swap" rel="stylesheet">
         <link href="https://fonts.googleapis.com/css2?family=Caprasimo&display=swap" rel="stylesheet">
    <!-- Lien pour les icones des apps au footer-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

</head>
<body>
       <section class="header_band">
          <div class="name_top"><b>Barry<br>Elhadj Aliou</b> </div>
          <ul class="barre_navigation">
            <li><a href="index.html" target="_self" style =" color: white;text-decoration: none ;">Acceuil</a></li>
            <li>Curriculum Vitae( CV )</li>
            <li>Contact</li>
          </ul>
      </section>

      <section id="center_page">
       <?php if($res_execut) : ?>
            <div class="alert success">
              <span class="close_alert" onclick="this.parentElement.style.display='none';">&times;</span>
                <strong>Succès !</strong> vos données ont bien été enregistré.
            </div>
       <?php elseif(!$res_execut): ?>
                <div class="alert fail">
                    <strong>Erreur! </strong> vos données n'ont pas été enregistré.
                    <span class="close_alert">&times;</span>
                </div> 
       <?php endif ?>
        <div id="message">
          <h1 id="GIT">Get In Touch !</h1>
          <h1 id="let_start">Commençons quelque chose ensemble !</h1>
          <div id="contact_icone"> 
            <a id="logo_github" class="logo_contact" href=""><i class="fa-brands fa-github fa-2xl"></i></a>
            <a id="logo_mail" class="logo_contact" href="mailto:elhadjaliou.barry@usmba.ac.ma"><i class="fa-regular fa-envelope  fa-2xl"></i></a>
            <a id="logo_whatsapp" class="logo_contact" href="https://wa.me/224624227101"><i class="fa-brands fa-whatsapp  fa-2xl"></i></a>
            <a id="logo_IG" class="logo_contact" href="https://www.instagram.com/elhadj_ouli.a?igsh=MTZ1NTRnOW9hZW82dw%3D%3D&utm_source=qr"><i class="fa-brands fa-instagram  fa-2xl"></i></a>
          <br><br>
            </div>
        </div>
        <div id="formulaire">
             <span id="form_contact">Formulaire de contact</span>
             <form action="" method = "post">

              <div style="position: relative;">
                <input type="text" id="prenom" name="prenom" placeholder="">
                <label for="prenom">Entrez votre prenom</label>
              </div>

              <div style="position: relative;">
                <input type="text" id="nom" name="nom" placeholder="" >
                <label for="nom">Entrez votre nom</label>
              </div>

              <div> 
                <input type="radio" id="genre" name="genre" value="homme" style="font-size: 100%;"> <p class="sexe" >Homme</p>
                <input type="radio" id="genre" name="genre" value="femme" style="font-size: 100%;margin-left: 5%;"> <p class = "sexe" >Femme</p>
              </div>

              <div style="position: relative;">
                <input type="email" id="email" name="email" placeholder="" >
                <label for="email" >Entrez votre email</label>
              </div>

              <div style="position: relative;">
                <textarea name="message" id="message" style="height: 70px; " placeholder="" ></textarea>
                <label class="messag" for="message">Envoyez moi un message</label>
             </div>

                <input id="submit" type="submit" name="submit" value ="Me contacter">
             </form>
        </div>
      </section>

      <section id="footer">
            <br><h1 id="name_foot"> Barry Elhadj Aliou</h1>
            <h2 id="specialite">Computer Sciences student</h2>
            <h3 class="contact_me">Contacter moi ici !!!</h3>
          <div id="contact_icone"  style="margin-bottom: 20px;"> 
            <a id="logo_github" class="logo_contact" style="color: white;" href=""><i class="fa-brands fa-github fa-2xl"></i></a>
            <a id="logo_mail" class="logo_contact" style="color: white;" href="mailto:elhadjaliou.barry@usmba.ac.ma"><i class="fa-regular fa-envelope  fa-2xl"></i></a>
            <a id="logo_whatsapp" class="logo_contact" style="color: white;" href="https://wa.me/224624227101"><i class="fa-brands fa-whatsapp  fa-2xl"></i></a>
            <a id="logo_IG" class="logo_contact" style="color: white;" href="https://www.instagram.com/elhadj_ouli.a?igsh=MTZ1NTRnOW9hZW82dw%3D%3D&utm_source=qr"><i class="fa-brands fa-instagram  fa-2xl"></i></a>
            <br><br>
            </div>

          </section>
</body>
</html>