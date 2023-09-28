<?php
$etudiant = Etudiant::getInstance();
$formation = Formation::getInstance()->findBy(['id_formation' => $user['id_formation']]);
$formation = $formation[0];

$etudiants = $etudiant->getEtudiantsTries($user['id_formation']);
$occurrences = 0;

$dateDebutInscription = $user['date_deb_insc'];
$dateFormateeDebut = date('d/m/Y', strtotime($dateDebutInscription));

$dateFinInscription = $user['date_fin_insc'];
$dateFormateeFin = date('d/m/Y', strtotime($dateFinInscription));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        Formation::getInstance()->update($formation['id_formation'], ['date_deb_insc' => $_POST['debut_inscriptions'], 'date_fin_insc' => $_POST['fin_inscriptions'], 'nb_max_entretiens' => $_POST['nb_max_entretiens']]);
        HTTP::redirect('/responsable/dashboard');
    } catch (PDOException $e) {
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
                    <img src="/assets/medias/images/logout.png" alt="">
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
            <div style="align-self: stretch; justify-content: space-between; align-items: center; display: inline-flex">
                <div style="width: 200px; height: 57px; color: #153142; font-size: 24px; font-family: Signika; font-weight: 700; word-wrap: break-word">Liste des étudiants</div>
                <div style="width: 24px; height: 24px; position: relative">
                    <div style="width: 20px; height: 19px; left: 2px; top: 2.50px; position: absolute; background: #153142"></div>
                </div>
            </div>
            <div style="align-self: stretch; justify-content: space-between; align-items: center; display: inline-flex">
                <div style="width: 150.20px; height: 40px; color: #153142; font-size: 20px; font-family: Noto Sans; font-weight: 500; word-wrap: break-word">Nom prénom</div>
                <div style="width: 106.43px; height: 40px; text-align: right; color: #153142; font-size: 20px; font-family: Noto Sans; font-weight: 500; word-wrap: break-word">Entretiens</div>
            </div>

            <?php foreach ($etudiants as $etudiant) {
                $occurrences = $etudiant['nombre_de_fois'];
                $afficherDiv = $occurrences == 0;

                ?>
                <div class="block-etudiant">
                    <div class="etudiant-info">
                        <div>
                            <p class="nom"><?php echo $etudiant['nom_etudiant']; ?></p>
                            <p class="nom prenom"><?php echo $etudiant['prenom_etudiant']; ?></p>
                        </div>
                        <p class="entretiens"><?php echo $occurrences; ?></p>
                    </div>
                    <p class="mail"><?php echo $etudiant['email_etudiant']; ?></p>
                    <?php if ($afficherDiv) { ?>
                        <div class="rappel">
                            <div class="rappel-cloche">
                                <img class="cloche" src="">
                            </div>
                            <button id="rappel_<?php echo $etudiant['id_etudiant']; ?>" class="rappel-texte">Envoyer un rappel</button>
                        </div><?php } ?>
                </div>
            <?php } ?>

        </div>
        <div class="form-param d-none">
            <button id="cancel">Annuler</button>
            <form id="form-param" action="/responsable/dashboard" style="" method="POST">
                <div style="width: 382px; padding-left: 16px; padding-right: 16px; padding-top: 32px; padding-bottom: 32px; background: #F5F5F5; box-shadow: 10px 10px 30px rgba(16.29, 16.24, 16.24, 0.15); border-radius: 20px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 16px; display: flex">
                    <label for="debut_inscriptions" style="width: 346px; height: 31px; color: black; font-size: 18px; font-family: Noto Sans; font-weight: 400; word-wrap: break-word">Début des inscriptions MMI :</label>
                    <input style=" border: 1px solid #ccc;border-radius: 4px; width: 346px; background-color:unset; height: 31px; color: black; font-size: 18px; font-weight: 400; word-wrap: break-word" type="date" id="debut_inscriptions" name="debut_inscriptions" value="<?php echo $dateFormateeDebut; ?>">
                </div>
                <div style="width: 382px; padding-left: 16px; padding-right: 16px; padding-top: 32px; padding-bottom: 32px; background: #F5F5F5; box-shadow: 10px 10px 30px rgba(16.29, 16.24, 16.24, 0.15); border-radius: 20px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 16px; display: flex">
                    <label for="fin_inscriptions">Fin des inscriptions MMI :</label>
                    <input type="date" class="input" id="fin_inscriptions" name="fin_inscriptions" value="<?php echo $dateFormateeFin; ?>">
                </div>
                <div style="width: 382px; padding-left: 16px; padding-right: 16px; padding-top: 32px; padding-bottom: 32px; background: #F5F5F5; box-shadow: 10px 10px 30px rgba(16.29, 16.24, 16.24, 0.15); border-radius: 20px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 16px; display: flex">
                    <label for="nb_max_entretiens">Entretien(s) max par étudiant :</label>
                    <input type="number" style=" border: 1px solid #ccc;border-radius: 4px; width: 346px; background-color:unset; height: 31px; color: black; font-size: 18px; font-weight: 400; word-wrap: break-word" id="nb_max_entretiens" name="nb_max_entretiens" value="<?php echo $user['nb_max_entretiens']; ?>">
                </div>
                <input style="color: #1A98C0; font-size: 24px; font-family: Palanquin; font-weight: 400; word-wrap: break-word; background-color:unset;" type="submit" value="Valider">
            </form>
        </div>
        <div class="main-mid d-none param">
            <h3 id="param-titre">Paramètres</h3>
            <button id="modif-button">Modifier</button>
            <div class="div-params">
                <div class="param-div">
                    <p class="param-value">Début des inscriptions MMI : <?php echo $dateFormateeDebut; ?></p>

                </div>
                <div class="param-div">
                    <p class="param-value">Fin des inscriptions MMI : <?php echo $dateFormateeFin; ?></p>

                </div>
                <div class="param-div">
                    <p class="param-value" style="">Entretien(s) max par étudiant : <?php echo $user['nb_max_entretiens']; ?></p>

                </div>
            </div>
        </div>
    </main>
    <script>
        <?php foreach ($etudiants as $etudiant) { ?>

            <?php if (isset($etudiant['id_etudiant'])) { ?>
                var element = document.getElementById("rappel_<?php echo $etudiant['id_etudiant']; ?>");
                console.log("Element trouvé : ", element);
                if (element) {
                    element.addEventListener("click", function() {
                        // Récupérez l'adresse e-mail de l'étudiant concerné
                        var email = "<?php echo $etudiant['email_etudiant']; ?>";

                        // Utilisez JavaScript pour envoyer un e-mail (vous devez mettre en place la logique d'envoi d'e-mail côté serveur)
                        // Vous pouvez utiliser une API de messagerie ou un service d'envoi d'e-mails comme PHPMailer.
                        // Exemple simplifié (vous devrez adapter cela à votre configuration) :
                        fetch("/mail", {
                                method: "POST",
                                body: JSON.stringify({
                                    email: email
                                }),
                                headers: {
                                    "Content-Type": "application/json"
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                // Gérez la réponse (par exemple, affichez un message de confirmation)
                                if (data.success) {
                                    alert("E-mail de rappel envoyé avec succès à " + email);
                                } else {
                                    alert("Échec de l'envoi de l'e-mail de rappel");
                                }
                            })
                            .catch(error => {
                                console.error("Erreur lors de l'envoi de l'e-mail : " + error);
                            });
                    });
                }
        <?php }
            } ?>
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

            formParam.classList.add('d-none');
        });

        paramButton.addEventListener('click', () => {

            paramButton.classList.add('choix-actif');
            etudiantButton.classList.remove('choix-actif');


            paramDiv.classList.remove('d-none');

            etudiantDiv.classList.add('d-none');
        });


        modifButton.addEventListener('click', () => {
            formParam.classList.remove('d-none');
            paramDivmodif.classList.add('d-none');
        });
        cancelButton.addEventListener('click', () => {
            paramDivmodif.classList.remove('d-none');
            formParam.classList.add('d-none');
        });
    </script>
</body>

</html>