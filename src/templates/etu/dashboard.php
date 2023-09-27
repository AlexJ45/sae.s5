<?php
    $formation = Formation::getInstance()->find($user['id_formation']);
    $entreprises = Entreprise::getInstance()->findByFormation($user['id_formation']);
    $inscriptions = Postuler::getInstance()->findby(['id_etudiant' => $user['id']]);

    ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Étudiant Dashboard</title>
    <link rel="icon" href="./favicon.ico">
    <link rel="stylesheet" href="/assets/css/etu-dashboard.css">
</head>

<body>
    <header>

        <div id="header-div">
            <a href="/logout">
                <section id="logout">
                    <img src="./assets/media/images/logout.png" alt="">
                </section>
            </a>
        </div>
    </header>
    <!-- Main Content -->
    <main>
        <div id="main-top">
            <div id="name-div">
                <p id="prenom"><?php echo $user['prenom_etudiant']; ?></p>
                <p id="nom"><?php echo $user['nom_etudiant']; ?> </p>
            </div>
            <div id="inscription">Fin des inscriptions : 
                <?php
                    $date = date_create($formation['date_fin_insc']);
    echo date_format($date, 'd/m/Y');
    ?>
            </div>
            <div id="menu">
                <div class="menu-choix choix-actif">Entreprises</div>
                <div class="menu-choix">Mes inscriptions</div>
            </div>
        </div>
        <div class="main-mid">
            <h2 class="titre">Entreprises disponibles</h2>
            <div class="block-entreprise">
            <?php
            dump($entreprises);
    foreach ($entreprises as $entreprise) {
        $offres = Offre::getInstance()->findby(['id_entreprise' => $entreprise['id'], 'id_formation' => $formation['id']]);
        ?>
                <div>
                    <div class="entreprise">
                        <div style="flex-direction: column; justify-content: center; align-items: flex-start; gap: 10px; display: flex">
                            <div class="entreprise-nom"><?php echo $entreprise['nom_entreprise']; ?></div>
                            <?php foreach ($offres as $offre) {?>
                                <a class="entreprise-fichier"href="./assets/medias/documents/<?php echo $offre['fichier_offre']; ?>" target="_blank"><?php echo $offre['fichier_offre']; ?></a>
                           <?php }?>
                        </div>
                    </div>
                    <button class="button">
                        <div class="texte-button">M’inscrire</div>
                        <div class="arrow">

                        </div>
                    </button>
                </div>
                <?php } ?>
            </div>
        </div>

        <div class="main-mid d-none">
            <h2 class="titre">Mes inscriptions</h2>
            <div class="block-entreprise">
                <?php foreach ($inscriptions as $inscription) {
                    $entreprise = Entreprise::getInstance()->find($inscription['id_entreprise']);
                    $offres = Offre::getInstance()->findby(['id_entreprise' => $entreprise['id'], 'id_formation' => $formation['id']]);
                    ?>
                <div style="align-self: stretch; height: 102px; padding: 16px; background: #F5F5F5; box-shadow: 10px 10px 30px rgba(16.29, 16.24, 16.24, 0.20); border-radius: 16px; flex-direction: column; justify-content: center; align-items: flex-start; gap: 20px; display: flex">
                    <div class="entreprise">
                        <div style="flex-direction: column; justify-content: center; align-items: flex-start; gap: 10px; display: flex">
                            <div class="entreprise-nom"><?php echo $entreprise['nom_entreprise']; ?></div>
                            <?php foreach ($offres as $offre) {?>
                                <a class="entreprise-fichier"href="./assets/medias/documents/<?php echo $offre['fichier_offre']; ?>" target="_blank"><?php echo $offre['fichier_offre']; ?></a>
                           <?php }?>
                        </div>
                    </div>
                </div>
                <?php } ?>
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