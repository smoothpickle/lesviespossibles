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
    <link rel="stylesheet" href="./assets/css/styles.css">

    <meta name="description" content="Page description">
    <meta property="og:title" content="Les vies possibles">
    <meta property="og:description" content="Page description">
    <meta property="og:image" content="https://www.mywebsite.com/image.jpg">
    <meta property="og:image:alt" content="Image description">
    <meta property="og:locale" content="fr_CA">
    <meta property="og:type" content="website">
    <meta name="twitter:card" content="summary_large_image">
    <meta property="og:url" content="https://www.mywebsite.com/page">
    <link rel="canonical" href="https://www.mywebsite.com/page">

    <link rel="icon" href="/favicon.ico">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <meta name="theme-color" content="#FF00FF">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        // if (window.location.search.indexOf('siteloaded=true') > -1) {
        //     $('html').addClass('site-loaded')
        // }
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
                <button class="btn btn-intro-record"><span>Enregistrer</span></button>
            </div>
            <div class="full">
                <button class="btn btn-about">
                    <span class="sr-hide">À propos</span>
                </button>
            </div>
        </section>
        
        <section id="section-about">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vitae lacus libero. Aliquam sed volutpat metus. Praesent eu justo finibus, pulvinar neque sed, porta ex. Mauris venenatis, purus et sodales dignissim, metus ipsum rhoncus metus, at accumsan turpis purus eget lorem. Aenean pellentesque tortor sit amet tellus vestibulum dictum. Proin a odio sed odio hendrerit convallis. Proin cursus pharetra diam, eu pellentesque nibh consequat a. Donec luctus lacus ac augue posuere lacinia. In diam arcu, pellentesque eu gravida et, vestibulum vel nibh. Curabitur suscipit augue non quam dapibus sagittis. Suspendisse nec iaculis mauris. Curabitur tempor rhoncus porttitor. Curabitur eget tellus vel sem imperdiet tincidunt vel quis nisi. Duis sit amet rhoncus nunc, vel posuere magna. In elit metus, congue sed erat nec, tincidunt dignissim libero.</p>
        </section>
        
    </main>
  
    <div class="modal" id="modal-legal">
        <a href="#" class="btn btn-close" onclick="closeModal();">
            <span class="sr-hide">Fermer</span>
        </a>
        <div class="modal-content">
            <p>J’autorise Stanley Février à utiliser l’enregistrement sonore dans le cadre du projet Les vies possibles.</p>
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
                    $('#section-about').fadeIn().addClass('active');
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
            
            $('.btn-intro-record').on('click', function() {
                
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