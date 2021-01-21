<?php

require_once '../vendor/autoload.php';
require_once '../config.php';

use TwitterSorteator\TwitterSorteator;

if (!empty($_POST['link'])) {

    $link = filter_input(INPUT_POST, 'link', FILTER_SANITIZE_URL);

    $twitterSorteator = new TwitterSorteator($link, $config);

    $pessoaSorteada = 'https://twitter.com/' . $twitterSorteator->sorteia();
    $pessoas = $twitterSorteator->nomes();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Twitter Sorteator</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="public/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="public/vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="public/vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="public/vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>

<body>

    <div class="bg-contact2" style="background-image: url('images/bg-01.jpg');">
        <div class="container-contact2">
            <div class="wrap-contact2">
                <form class="contact2-form validate-form" action="index.php" method="POST">
                    <span class="contact2-form-title">
                        Twitter Sorteator
                    </span>

                    <?php if (empty($_POST['link'])) { ?>

                        <div class="wrap-input2 validate-input" data-validate="Name is required">
                            <input class="input2" type="text" name="link">
                            <span class="focus-input2" data-placeholder="LINK PARA O TWEET"></span>
                        </div>

                        <div class="container-contact2-form-btn">
                            <div class="wrap-contact2-form-btn">
                                <div class="contact2-form-bgbtn"></div>
                                <button class="contact2-form-btn">
                                    Verificar Link
                                </button>
                            </div>
                        </div>


                    <?php } ?>

                    <?php if (!empty($_POST['link'])) { ?>

                        <h3 class="centeriza">
                            <?= $twitterSorteator->link ?>
                        </h3>

                        <br />
                        <br />

                        <h3>
                            Total de Retweets: <?= count($twitterSorteator->retweets) ?>
                        </h3>

                        <?php if (!empty($twitterSorteator->retweets)) { ?>
                            <ul class="names">
                                <?php foreach ($twitterSorteator->retweets as $pessoa) { ?>
                                    <li> <?= $pessoa ?> </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>

                        <br />

                        <h3>
                            Total de Retweets com Comentários: <?= count($twitterSorteator->retweetsComComentario) ?>
                        </h3>

                        <?php if (!empty($twitterSorteator->retweetsComComentario)) { ?>
                            <ul class="names">
                                <?php foreach ($twitterSorteator->retweetsComComentario as $pessoa) { ?>
                                    <li> <?= $pessoa ?> </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>

                        <br />

                        <h3>
                            Pessoa sorteada: <a href="<?= $pessoaSorteada ?>"><?= $pessoaSorteada ?></a>
                        </h3>

                        <div class="container-contact2-form-btn">
                            <div class="wrap-contact2-form-btn">
                                <div class="contact2-form-bgbtn"></div>
                                <a href="" id="twitter-share-btt" rel="nofollow" target="_blank" class="twitter-share-button contact2-form-btn" style="text-decoration: none;">
                                    Compartilhar no Twitter
                                </a>
                            </div>
                        </div>
                    <?php } ?>

                </form>
            </div>
        </div>
    </div>


    <script src="public/vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="public/vendor/bootstrap/js/popper.js"></script>
    <script src="public/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="public/vendor/select2/select2.min.js"></script>
    <script src="js/main.js"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'UA-23581568-13');
    </script>

    <?php if (!empty($_POST['link'])) { ?>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var url = encodeURIComponent(window.location.href);
                var text = encodeURIComponent(`
A conta sorteada em <?= $link ?> foi @<?= str_replace('https://twitter.com/', '', $pessoaSorteada) ?>


Sorteio realizado utilizando:
`);

                document.getElementById("twitter-share-btt").href = "https://twitter.com/intent/tweet?url=" + url + "&text=" + text;
            }, false);
        </script>
    <?php } ?>
</body>

</html>