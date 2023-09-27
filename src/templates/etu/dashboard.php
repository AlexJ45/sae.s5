<?php
/*
require('./../../Entity/Etudiant.php');
session_start();


if (!isset($_SESSION['loaded']) || $_SESSION['loaded'] !== true || !isset($_SESSION['email'])) {
    // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
    header("Location: /connexion.php");
    exit;
}


$prenom = $_SESSION['prenom_etudiant'];
$nom = $_SESSION['nom_etudiant'];
*/
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Étudiant dashboard</title>
    <link rel="icon" href="./favicon.ico">
    <link rel="stylesheet" href="/assets/css/etu-dashboard.css">
</head>

<body>
    <header>

        <div id="header-div">
            <a href="">
                <section id="logout">
                    <img src="/public/assets/img/logout.png" alt="">
                </section>
            </a>
        </div>
    </header>
    <!-- Main Content -->
    <main>
        <div id="main-top">
            <div id="name-div">
                <p id="prenom">Sergio</p>
                <p id="nom"> BOUIN NAVE RODRIGUES </p>
            </div>
            <div id="inscription">Fin des inscriptions : 22/12/2021</div>
            <div id="menu">
                <div class="menu-choix choix-actif">Entreprises</div>
                <div class="menu-choix">Mes inscriptions</div>
            </div>
        </div>
        <div class="main-mid">
            <h2 class="titre">Entreprises disponibles</h2>
            <div class="block-entreprise">
                <div>
                    <div class="entreprise">
                        <div style="flex-direction: column; justify-content: center; align-items: flex-start; gap: 10px; display: flex">
                            <div class="entreprise-nom">Schneider electric</div>
                            <div class="entreprise-fichier">document1.pdf</div>
                        </div>
                    </div>
                    <button class="button">
                        <div class="texte-button">M’inscrire</div>
                        <div class="arrow">

                        </div>
                    </button>
                </div>
            </div>
        </div>

        <div class="main-mid d-none">
            <h2 class="titre">Mes inscriptions</h2>
            <div class="block-entreprise">
                <div style="align-self: stretch; height: 102px; padding: 16px; background: #F5F5F5; box-shadow: 10px 10px 30px rgba(16.29, 16.24, 16.24, 0.20); border-radius: 16px; flex-direction: column; justify-content: center; align-items: flex-start; gap: 20px; display: flex">
                    <div class="entreprise">
                        <div style="flex-direction: column; justify-content: center; align-items: flex-start; gap: 10px; display: flex">
                            <div class="entreprise-nom">Schneider electric</div>
                            <div class="entreprise-fichier">document1.pdf</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        const entrepriseButton = document.querySelector('.menu-choix.choix-actif');
        const inscriptionsButton = document.querySelector('.menu-choix:not(.choix-actif)');


        const entrepriseDiv = document.querySelector('.main-mid:not(.d-none)');
        const inscriptionsDiv = document.querySelector('.main-mid.d-none');


        entrepriseButton.addEventListener('click', () => {

            entrepriseButton.classList.add('choix-actif');
            inscriptionsButton.classList.remove('choix-actif');


            entrepriseDiv.classList.remove('d-none');

            inscriptionsDiv.classList.add('d-none');
        });

        inscriptionsButton.addEventListener('click', () => {

            inscriptionsButton.classList.add('choix-actif');
            entrepriseButton.classList.remove('choix-actif');


            inscriptionsDiv.classList.remove('d-none');

            entrepriseDiv.classList.add('d-none');
        });
    </script>
</body>

</html>