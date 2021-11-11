<!DOCTYPE html>
<html lang="fr" class="no-js page">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Enregistrez - Les vies possibles</title>
    
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">

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
        <a href="./index.php?siteloaded=true" class="btn btn-close">
            <span class="sr-hide">Fermer</span>
        </a>
    </header>

    <main>

    <section id="section-record">
        
        <div class="step-1">
            <button class="btn btn-record" id="recordButton">
                <span>Commencez<br> l'enregistrement</span>
            </button>
        </div>

        <div class="step-2">
            <div class="step-inner">
                <div id="time">
                    <span id="hours">00</span>
                    <span class="sep">:</span>
                    <span id="minutes">00</span>
                    <span class="sep">:</span>
                    <span id="seconds">00</span>
                    <span class="sep">:</span>
                    <span id="milliseconds">000</span>
                </div>
                <button class="btn btn-stop-record btn-small" id="stopButton" disabled>
                    <span>Arrêtez l'enregistrement</span>
                </button>
            </div>
            
            <div class='box'>
                <div class='wave -one'></div>
            </div>
          
        </div>
        
        <div class="step-3">
            <p>Enregistrement <br> en attente</p>
            <div class="hidden" aria-hidden="true">
                <div id="formats">Format: start recording to see sample rate</div>
                <p><strong>Pistes:</strong></p>
                <ol id="recordingsList"></ol>
            </div>
            <div class="controls">
                <a href="./enregistrez" class="btn btn-erase-audio btn-small mr-20">Effacer</a>
                <button class="btn btn-send-audio btn-small" id="sendButton">Envoyez</button>
            </div>
        </div>
        
        <div class="step-4">
            <p>Merci de votre participation</p>
            <p><a class="link-theme-a" href="./ecoutez">Pour écoutez les autres témoignagnes.</a></p>
        </div>
    </section>
    
    <!-- <div class="loader"></div> -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="./assets/js/recorder.js"></script>
    <script src="./assets/js/app.js?v=343"></script>
    <script>
            
        $(window).on('load', function () {
            
            setTimeout(function () { 
                $('#section-record').fadeIn(300);
             }, 500);
            
        });
        
    </script>
    
</body>
</html>