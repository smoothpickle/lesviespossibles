<!DOCTYPE html>
<html lang="fr" class="no-js <?php echo (isset($_GET['siteloaded']) ? 'site-loaded' : ''); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Les vies possibles</title>

    <script type="module">
        document.documentElement.classList.remove('no-js');
        document.documentElement.classList.add('js');
    </script>
    
    <link rel="stylesheet" href="https://use.typekit.net/sqz3hxj.css">
    <link rel="stylesheet" href="./assets/css/styles.css?v=2">

    <!-- Primary Meta Tags -->
    <meta name="title" content="Les vies possibles">
    <meta name="description" content="Veuillez laisser votre message.">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://lesviespossibles.org/">
    <meta property="og:title" content="Les vies possibles">
    <meta property="og:description" content="Veuillez laisser votre message.">
    <meta property="og:image" content="https://lesviespossibles.org/fb-img.png">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://lesviespossibles.org/">
    <meta property="twitter:title" content="Les vies possibles">
    <meta property="twitter:description" content="Veuillez laisser votre message.">
    <meta property="twitter:image" content="https://lesviespossibles.org/twitter-img.png">

    <!-- <link rel="icon" href="/favicon.ico">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png"> -->
    <!-- <meta name="theme-color" content="#FF00FF"> -->
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-91D99E8XNS"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-91D99E8XNS');
    </script>
</head>

<body>
  <!-- Content -->
    <header>
        <h1>
            <a href="./index.php?siteloaded=true">
                <img alt="" src="./assets/img/header.svg" />
                <span class="sr-hide">
                    Les vies possibles
                </span>
            </a>
        </h1>
        <a href="#" class="btn btn-close">
            <span class="sr-hide">Fermer</span>
        </a>
    </header>

    <main>
        
        <section class="active" id="section-intro">
            <div class="half">
                <a href="./ecoutez" class="btn btn-intro-listen"><span>Écoutez</span></a>
            </div>
            <div class="half">
                <button class="btn btn-intro-record" data-action="openModal"><span>Enregistrer</span></button>
            </div>
            <div class="full">
                <!-- <button class="btn btn-about">
                    <span class="sr-hide">À propos</span>
                </button> -->
                <a class="link-theme-a btn-about" href="#">Projet</a>
            </div>
        </section>
        
        <section id="section-about">
            <p>Le projet <em>Les vies possibles</em> de Stanley Février aborde la question de la détresse psychologique vécue par les artistes. Il interroge les signaux de détresse émis par ces derniers et leur difficile reconnaissance par le milieu des arts, la pression qu’exerce ce dernier et l’absence cumulée de réponses auxquelles de nombreux artistes font face. Nommée Cabine SOS et installée dans divers lieux en lien avec le monde des arts, cette œuvre interactive vise à recueillir et diffuser les témoignages de personnes ayant vécues des situations d’angoisse et de détresse.</p>
            <p><a class="link-theme-a" href="#" data-action="openModal">Veuillez laisser votre message</a>.</p>
        </section>
        
    </main>
  
    <div class="modal" id="modal-legal">
        <a href="#" class="btn btn-close" onclick="closeModal();">
            <span class="sr-hide">Fermer</span>
        </a>
        <div class="modal-content">
            <p>J’autorise Stanley Février à utiliser l’enregistrement sonore dans le cadre du projet <em>Les vies possibles</em>.</p>
            <button class="btn btn-refuse btn-small" onclick="closeModal();">Refuser</button>
            <a href="./enregistrez" class="btn btn-accept btn-small">Accepter</a>
        </div>
    </div>
    
    <div class="modal-bg"></div>

    <div class="loader"></div>

    <!-- <script src="./assets/js/script.js" type="module"></script> -->
    <script>

        function closeModal() {

            $('.modal').fadeOut(300);
            $('.modal-bg').fadeOut(300);
        }
            
        $(window).on('load', function () {
            
            var sections = $('section');
            var headerBtnClose = $('header').find('.btn-close');

            $('html').addClass('site-loaded');
            $('.loader').fadeOut(300);
            
            $('.btn-about').on('click', function() {
                // Open about section

                $('section.active').fadeOut(300, function() {
                    
                    $(this).removeClass('active');
                    $('#section-about').fadeIn(300, function() {
                        $(window).scrollTop(0);
                    }).addClass('active');
                    headerBtnClose.fadeIn();
                });
                
            });
            
            headerBtnClose.on('click', function() {
                // Open intro section
                $(this).fadeOut(300);
                
                 $('section.active').fadeOut(300, function () {
                     $(this).removeClass('active');
                    $('#section-intro').addClass('active').fadeIn();
                });
            });
            
            $('.btn-intro-listen').on('click', function() {
               // Open listen section
               
                $('section.active').fadeOut(300, function () {

                    $(this).removeClass('active');
                    $('#section-listen').addClass('active').fadeIn(300);
                    headerBtnClose.fadeIn();
                });
            });
            
            $('[data-action="openModal"]').on('click', function() {
                
                $('.modal').fadeIn(300);
                $('.modal-bg').fadeIn(300);
                
            });
            
            // $('.btn-accept').on('click', function() {
            //     closeModal();
                
            //     $('section.active').fadeOut(300, function () {

            //         $(this).removeClass('active');
            //         $('#section-record').addClass('active').fadeIn(300);

            //     });
                
            // });
            
        });
    </script>
    
</body>
</html>