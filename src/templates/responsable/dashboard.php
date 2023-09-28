<?php
$dateDebutInscription = $user['date_deb_insc'];
$dateFormateeDebut = date('d/m/Y', strtotime($dateDebutInscription));

$dateFinInscription = $user['date_fin_insc'];
$dateFormateeFin = date('d/m/Y', strtotime($dateFinInscription));
?>
<?php

// traitement.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les nouvelles valeurs des paramètres depuis $_POST
    $nouveauDebutInscriptions = $_POST['debut_inscriptions'];
    $nouvelleFinInscriptions = $_POST['fin_inscriptions'];
    $nouveauNbMaxEntretiens = $_POST['nb_max_entretiens'];
    $idFormation = $_POST['id_formation'];
    dump($idFormation = $_POST['id_formation']);
    // Valider les données (assurez-vous que les dates sont au bon format, etc.)

    try {
        $pdo = new PDO('mysql:host=localhost;dbname=sae_s5', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'UPDATE Formation SET date_deb_insc = :debut, date_fin_insc = :fin, nb_max_entretiens = :max WHERE id_formation = :idFormation';
        $stmt = $pdo->prepare($sql);

        // Liez les valeurs aux paramètres de la requête
        $stmt->bindValue(':debut', $nouveauDebutInscriptions);
        $stmt->bindValue(':fin', $nouvelleFinInscriptions);
        $stmt->bindValue(':max', $nouveauNbMaxEntretiens);
        $stmt->bindValue(':idFormation', $idFormation);

        // Exécutez la requête
        $stmt->execute();

        // Rediriger l'utilisateur vers une page de confirmation ou une autre page après la mise à jour
    } catch (PDOException $e) {
        // Gérez les erreurs PDO, affichez un message d'erreur approprié à l'utilisateur
        echo 'Une erreur s\'est produite : '.$e->getMessage();
    }
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsable dashboard</title>
    <link rel="icon" href="./favicon.ico">
    <link rel="stylesheet" href="/assets/css/resp-dashboard.css">
</head>

<body>
    <header>

        <div id="header-div">
            <a href="/logout">
                <section id="logout">
                    <img src="/assets/medias/images/vector.png" alt="se déconnecter">
                </section>
            </a>
        </div>
    </header>
    <!-- Main Content -->
    <main>
        <div id="main-top">
            <div id="name-div">
                <p id="prenom"><?php echo $user['prenom_resp_stage']; ?></p>
                <p id="nom"><?php echo $user['nom_resp_stage']; ?></p>
            </div>
            <div id="inscription">Fin des inscriptions : <?php echo $dateFormateeFin; ?></div>
            <div id="menu">
                <div class="menu-choix choix-actif">Étudiants</div>
                <div class="menu-choix">Paramètres</div>
            </div>
        </div>
        <div class="main-mid">
            <div style=" align-self: stretch; justify-content: space-between; align-items: center; display: inline-flex">
                <div style="width: 200px; height: 57px; color: #153142; font-size: 24px; font-family: Signika; font-weight: 700; word-wrap: break-word">Liste des étudiants</div>
                <div style="width: 24px; height: 24px; position: relative">
                    <a href="/responsable/pdf" target='_blank' style="width: 20px; height: 19px; left: 2px; top: 2.50px; position: absolute; background: #153142"></a>
                </div>
            </div>
            <div style="align-self: stretch; justify-content: space-between; align-items: center; display: inline-flex">
                <div style="width: 150.20px; height: 40px; color: #153142; font-size: 20px; font-family: Noto Sans; font-weight: 500; word-wrap: break-word">Nom prénom</div>
                <div style="width: 106.43px; height: 40px; text-align: right; color: #153142; font-size: 20px; font-family: Noto Sans; font-weight: 500; word-wrap: break-word">Entretiens</div>
            </div>
            <div style="align-self: stretch; height: 174px; padding: 16px; background: #F5F5F5; box-shadow: 10px 10px 30px rgba(16.29, 16.24, 16.24, 0.15); border-radius: 12px; border: 1px #DEDEDE solid; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 16px; display: flex">
                <div style="width: 350px; justify-content: space-between; align-items: center; display: inline-flex">
                    <div style="width: 220.57px; height: 61px"><span style="color: black; font-size: 20px; font-family: Noto Sans; font-weight: 300; word-wrap: break-word">Saidouna--kadre<br /></span><span style="color: black; font-size: 20px; font-family: Noto Sans; font-weight: 400; word-wrap: break-word">DOGA</span></div>
                    <div style="text-align: right; color: black; font-size: 20px; font-family: Noto Sans; font-weight: 300; word-wrap: break-word">0</div>
                </div>
                <div><span style="color: #3D3D3D; font-size: 16px; font-family: Noto Sans; font-weight: 400; word-wrap: break-word">doga.</span><span style="color: #3D3D3D; font-size: 16px; font-family: Noto Sans; font-weight: 400; text-transform: lowercase; word-wrap: break-word">SAIDOUNAKADRE@mail.com</span></div>
                <div style="justify-content: center; align-items: center; gap: 10px; display: inline-flex">
                    <div style="width: 20px; height: 20px; position: relative">
                        <div style="width: 15px; height: 16.25px; left: 2.50px; top: 1.67px; position: absolute; background: #FF453A"></div>
                    </div>
                    <div class="rappel">Envoyer un rappel</div>
                </div>
            </div>

        </div>
        <div class="form-param d-none" style="width: 100%; height: 100%; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 32px; ">
            <button id="cancel" style="color: #1A98C0; font-size: 24px; font-family: Palanquin; font-weight: 400; word-wrap: break-word; background-color:unset;">Annuler</button>
            <form action="/responsable/dashboard" style="  align-self: stretch;  height: 527px;  flex-direction: column;  justify-content: flex-start;  align-items: flex-start;gap: 32px;  display: flex;" method="POST">
                <div style="width: 382px; padding-left: 16px; padding-right: 16px; padding-top: 32px; padding-bottom: 32px; background: #F5F5F5; box-shadow: 10px 10px 30px rgba(16.29, 16.24, 16.24, 0.15); border-radius: 20px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 16px; display: flex">
                    <label for="debut_inscriptions" style="width: 346px; height: 31px; color: black; font-size: 18px; font-family: Noto Sans; font-weight: 400; word-wrap: break-word">Début des inscriptions MMI :</label>
                    <input style="border:1px solid black; width: 346px; background-color:unset; height: 31px; color: black; font-size: 18px; font-weight: 400; word-wrap: break-word" type="date" id="debut_inscriptions" name="debut_inscriptions" value="<?php echo $dateFormateeDebut; ?>">
                </div>
                <div style="width: 382px; padding-left: 16px; padding-right: 16px; padding-top: 32px; padding-bottom: 32px; background: #F5F5F5; box-shadow: 10px 10px 30px rgba(16.29, 16.24, 16.24, 0.15); border-radius: 20px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 16px; display: flex">
                    <label for="fin_inscriptions">Fin des inscriptions MMI :</label>
                    <input type="date" style="border:1px solid black; width: 346px; background-color:unset; height: 31px; color: black; font-size: 18px; font-weight: 400; word-wrap: break-word" id="fin_inscriptions" name="fin_inscriptions" value="<?php echo $dateFormateeFin; ?>">
                </div>
                <div style="width: 382px; padding-left: 16px; padding-right: 16px; padding-top: 32px; padding-bottom: 32px; background: #F5F5F5; box-shadow: 10px 10px 30px rgba(16.29, 16.24, 16.24, 0.15); border-radius: 20px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 16px; display: flex">
                    <label for="nb_max_entretiens">Entretien(s) max par étudiant :</label>
                    <input type="number" style="border:1px solid black; width: 346px; background-color:unset; height: 31px; color: black; font-size: 18px; font-weight: 400; word-wrap: break-word" id="nb_max_entretiens" name="nb_max_entretiens" value="<?php echo $user['nb_max_entretiens']; ?>">
                </div>
                <input type="hidden" name="id_formation" value="<?php echo $user['id_formation']; ?>">
                <input style="color: #1A98C0; font-size: 24px; font-family: Palanquin; font-weight: 400; word-wrap: break-word; background-color:unset;" type="submit" value="Valider">
            </form>
        </div>
        <div class="main-mid d-none param" style="width: 100%; height: 100%; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 32px; ">
            <div style="color: #153142; font-size: 24px; font-family: Signika; font-weight: 700; word-wrap: break-word">Paramètres</div>
            <button id="modif-button" style="color: #1A98C0; font-size: 24px; font-family: Palanquin; font-weight: 400; word-wrap: break-word; background-color:unset;">Modifier</button>
            <div style="align-self: stretch; height: 456px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 24px; display: flex">
                <div style="width: 382px; padding-left: 16px; padding-right: 16px; padding-top: 32px; padding-bottom: 32px; background: #F5F5F5; box-shadow: 10px 10px 30px rgba(16.29, 16.24, 16.24, 0.15); border-radius: 20px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 16px; display: flex">
                    <div style="width: 346px; height: 31px; color: black; font-size: 18px; font-family: Noto Sans; font-weight: 400; word-wrap: break-word">Début des inscriptions MMI : <?php echo $dateFormateeDebut; ?></div>

                </div>
                <div style="width: 382px;  padding-left: 16px; padding-right: 16px; padding-top: 32px; padding-bottom: 32px; background: #F5F5F5; box-shadow: 10px 10px 30px rgba(16.29, 16.24, 16.24, 0.15); border-radius: 20px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 16px; display: flex">
                    <div style="width: 346px; height: 31px; color: black; font-size: 18px; font-family: Noto Sans; font-weight: 400; word-wrap: break-word">Fin des inscriptions MMI : <?php echo $dateFormateeFin; ?></div>

                </div>
                <div style="width: 382px;  padding-top: 24px; padding-bottom: 32px; padding-left: 16px; padding-right: 16px; background: #F5F5F5; box-shadow: 10px 10px 30px rgba(16.29, 16.24, 16.24, 0.15); border-radius: 20px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 16px; display: flex">
                    <div style="width: 354px; height: 31px; color: black; font-size: 18px; font-family: Noto Sans; font-weight: 400; word-wrap: break-word">Entretien(s) max par étudiant : <?php echo $user['nb_max_entretiens']; ?></div>

                </div>
            </div>
        </div>
    </main>
    <script>
        const etudiantButton = document.querySelector('.menu-choix.choix-actif');
        const paramButton = document.querySelector('.menu-choix:not(.choix-actif)');


        const etudiantDiv = document.querySelector('.main-mid:not(.d-none)');
        const paramDiv = document.querySelector('.main-mid.d-none');

        const modifButton = document.getElementById('modif-button');
        const cancelButton = document.getElementById('cancel');

        const formParam = document.querySelector('.form-param');
        const paramDivmodif = document.querySelector('.param');
        etudiantButton.addEventListener('click', () => {

            etudiantButton.classList.add('choix-actif');
            paramButton.classList.remove('choix-actif');


            etudiantDiv.classList.remove('d-none');

            paramDiv.classList.add('d-none');

            formParam.classList.add('d-none'); // Masque la div paramètres
        });

        paramButton.addEventListener('click', () => {

            paramButton.classList.add('choix-actif');
            etudiantButton.classList.remove('choix-actif');


            paramDiv.classList.remove('d-none');

            etudiantDiv.classList.add('d-none');
        });


        modifButton.addEventListener('click', () => {
            formParam.classList.remove('d-none'); // Affiche le formulaire
            paramDivmodif.classList.add('d-none'); // Masque la div paramètres
        });
        cancelButton.addEventListener('click', () => {
            paramDivmodif.classList.remove('d-none'); // Affiche le formulaire
            formParam.classList.add('d-none'); // Masque la div paramètres
        });
    </script>
</body>

</html>