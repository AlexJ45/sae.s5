<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    Postuler::getInstance()->create([
        'id_entreprise' => $_POST['id_entreprise'],
        'id_etudiant' => $user['id_etudiant'],
      ]);
}$formation = Formation::getInstance()->findBy(['id_formation' => $user['id_formation']]);
$formation = $formation[0];
$entreprises = Entreprise::getInstance()->findByFormation($formation['id_formation']);
$inscriptions = Postuler::getInstance()->findBy(['id_etudiant' => $user['id_etudiant']]);

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
                    <img src="/assets/medias/images/logout.png" alt="">
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
                $date = date(date_format(date_create($formation['date_fin_insc']), 'd/m/Y'));
echo $date;
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

foreach ($entreprises as $entreprise) {
    $inscriptions_entreprise = [];
    foreach ($inscriptions as $inscription) {
        array_push($inscriptions_entreprise, $inscription['id_entreprise']);
    }
    if (!in_array($entreprise['id_entreprise'], $inscriptions_entreprise)) {
        $offres = Offre::getInstance()->findby(['id_entreprise' => $entreprise['id_entreprise'], 'id_formation' => $formation['id_formation']]);

        ?>
                <div>
                    <div class="entreprise">
                        <div style="flex-direction: column; justify-content: center; align-items: flex-start; gap: 10px; display: flex">
                            <div class="entreprise-nom"><?php echo $entreprise['nom_entreprise']; ?></div>
                            <?php foreach ($offres as $offre) {?>
                                <a class="entreprise-fichier" href="/assets/medias/documents/<?php echo $offre['fichier_offre']; ?>"  target="_blank"><?php echo $offre['fichier_offre']; ?></a>
                           <?php }?>
                        </div>
                    </div>
                    <?php $date = new DateTime($formation['date_fin_insc']);
        $current_date = new DateTime();
        if ($date >= $current_date && count($inscriptions) < $formation['nbr_max_entretiens']) {?>
                    <form action="" method="POST">
                        <input type="hidden" name='id_entreprise' value="<?php echo $entreprise['id_entreprise']; ?>">
                        <button class="button">
                            <div class="texte-button">M’inscrire 
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17.2558 9.41089L11.4225 3.57756C11.0971 3.25214 10.5696 3.25214 10.2442 3.57756C9.91875 3.90298 9.91875 4.43047 10.2442 4.75589L14.655 9.16673H3.33333C2.87333 9.16673 2.5 9.54006 2.5 10.0001C2.5 10.4601 2.87333 10.8334 3.33333 10.8334H14.655L10.2442 15.2442C9.91875 15.5696 9.91875 16.0971 10.2442 16.4226C10.4071 16.5855 10.62 16.6667 10.8333 16.6667C11.0467 16.6667 11.2596 16.5855 11.4225 16.4226L17.2558 10.5892C17.5813 10.2638 17.5813 9.73631 17.2558 9.41089Z" fill="currentColor"/>
                                </svg>
                            </div>
                        </button>
                    </form>
                    <?php } ?> 
                </div>
                <?php }
    } ?>
            </div>
        </div>

        <div class="main-mid d-none">
            <h2 class="titre">Mes inscriptions</h2>
            <div class="block-entreprise">
                <?php foreach ($inscriptions as $inscription) {
                    $entreprise = Entreprise::getInstance()->findBy(['id_entreprise' => $inscription['id_entreprise']]);
                    $entreprise = $entreprise[0];
                    $offres = Offre::getInstance()->findBy(['id_entreprise' => $entreprise['id_entreprise'], 'id_formation' => $formation['id_formation']]);
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