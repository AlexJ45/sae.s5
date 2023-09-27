<?php

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
            <a href="">
                <section id="logout">
                    <img src="./assets/medias/images/vector.png" alt="se déconnecter">
                </section>
            </a>
        </div>
    </header>
    <!-- Main Content -->
    <main>
        <div id="main-top">
            <div id="name-div">
                <p id="prenom">Smail</p>
                <p id="nom"> BACHIR </p>
            </div>
            <div id="inscription">Fin des inscriptions : 22/12/2021</div>
            <div id="menu">
                <div class="menu-choix choix-actif">Étudiants</div>
                <div class="menu-choix">Paramètres</div>
            </div>
        </div>
        <div class="main-mid">
            <div style=" align-self: stretch; height: 48px; justify-content: space-between; align-items: center; display: inline-flex">
                <div style="width: 200px; height: 57px; color: #153142; font-size: 24px; font-family: Signika; font-weight: 700; word-wrap: break-word">Liste des étudiants</div>
                <div style="width: 24px; height: 24px; position: relative">
                    <div style="width: 20px; height: 19px; left: 2px; top: 2.50px; position: absolute; background: #153142"></div>
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
        <!-- <div class="main-mid">
            <h2 class="titre">Entreprises disponibles</h2>
            <div class="block-entreprise">
                <div style="align-self: stretch; height: 162px; padding: 16px; background: #F5F5F5; box-shadow: 10px 10px 30px rgba(16.29, 16.24, 16.24, 0.20); border-radius: 16px; flex-direction: column; justify-content: center; align-items: flex-start; gap: 20px; display: flex">
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
        -->

        <div class="main-mid d-none" style="width: 100%; height: 100%; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 32px; ">
            <div style="color: #153142; font-size: 24px; font-family: Signika; font-weight: 700; word-wrap: break-word">Paramètres</div>
            <div style="align-self: stretch; height: 456px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 24px; display: flex">
                <div style="width: 382px; height: 136px; padding-left: 16px; padding-right: 16px; padding-top: 32px; padding-bottom: 32px; background: #F5F5F5; box-shadow: 10px 10px 30px rgba(16.29, 16.24, 16.24, 0.15); border-radius: 20px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 16px; display: flex">
                    <div style="width: 346px; height: 31px; color: black; font-size: 18px; font-family: Noto Sans; font-weight: 400; word-wrap: break-word">Début des inscriptions MMI : 02/12/2021</div>
                    <div style="color: #1A98C0; font-size: 24px; font-family: Palanquin; font-weight: 400; word-wrap: break-word">Modifier</div>
                </div>
                <div style="width: 382px; height: 136px; padding-left: 16px; padding-right: 16px; padding-top: 32px; padding-bottom: 32px; background: #F5F5F5; box-shadow: 10px 10px 30px rgba(16.29, 16.24, 16.24, 0.15); border-radius: 20px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 16px; display: flex">
                    <div style="width: 346px; height: 31px; color: black; font-size: 18px; font-family: Noto Sans; font-weight: 400; word-wrap: break-word">Fin des inscriptions MMI : 22/12/2021</div>
                    <div style="color: #1A98C0; font-size: 24px; font-family: Palanquin; font-weight: 400; word-wrap: break-word">Modifier</div>
                </div>
                <div style="width: 382px; height: 136px; padding-top: 24px; padding-bottom: 32px; padding-left: 16px; padding-right: 16px; background: #F5F5F5; box-shadow: 10px 10px 30px rgba(16.29, 16.24, 16.24, 0.15); border-radius: 20px; flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 16px; display: flex">
                    <div style="width: 354px; height: 31px; color: black; font-size: 18px; font-family: Noto Sans; font-weight: 400; word-wrap: break-word">Entretien(s) max par étudiant : 5</div>
                    <div style="color: #1A98C0; font-size: 24px; font-family: Palanquin; font-weight: 400; word-wrap: break-word">Modifier</div>
                </div>
            </div>
        </div>
    </main>
    <script>
        const etudiantButton = document.querySelector('.menu-choix.choix-actif');
        const paramButton = document.querySelector('.menu-choix:not(.choix-actif)');


        const etudiantDiv = document.querySelector('.main-mid:not(.d-none)');
        const paramDiv = document.querySelector('.main-mid.d-none');


        etudiantButton.addEventListener('click', () => {

            etudiantButton.classList.add('choix-actif');
            paramButton.classList.remove('choix-actif');


            etudiantDiv.classList.remove('d-none');

            paramDiv.classList.add('d-none');
        });

        paramButton.addEventListener('click', () => {

            paramButton.classList.add('choix-actif');
            etudiantButton.classList.remove('choix-actif');


            paramDiv.classList.remove('d-none');

            etudiantDiv.classList.add('d-none');
        });
    </script>
</body>

</html>