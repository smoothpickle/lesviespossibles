<?php
$files = array();
if ($handle = opendir('./pistes')) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
            $files[] = $entry;
        }
    }
    closedir($handle);
}
$json = json_encode($files);
// var_dump($json);
?>

<!DOCTYPE html>
<html lang="fr" class="no-js page">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">

    <title>Écoutez - Les vies possibles</title>

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
        
        <section id="section-listen">
            
            <div id="playerProgressBarWrapper">
                
                <div id="playerTime_Start"></div>
                <div id="playerProgressBar">
                    <div id="playerTime_Now"></div>
                </div>
                <div id="playerTime_End"></div>

                <button class="btn btn-play" id="btnPlay">
                    <span class="sr-hide">Jouez la piste</span>
                </button>
                <button class="btn btn-pause" id="btnStop">
                    <span class="sr-hide">Arrêter la piste</span>
                </button>
                <div class="anim-wrapper" id="anim-loading">
                    <div class="dot-pulse"></div>
                </div>
                <button class="btn btn-random" id="btnRandom">
                    <span class="sr-hide">Jouez une piste audio au hasard</span>
                </button>
            </div>

        </section>

    </main>


    <div class="modal-bg"></div>

    <!-- <div class="loader"></div> -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- <script src="./assets/js/script.js" type="module"></script> -->
    <script>
        
        var pistes = <?php echo $json ?>;
        console.log(pistes);
        
        Array.prototype.random = function () {
            return this[Math.floor((Math.random()*this.length))];
        }
        
        var audioElement = new Audio();
        
        var btnPlay = $('#btnPlay');
        var btnStop = $('#btnStop');
        var btnRandom = $('#btnRandom');
        var animLoading = $('#anim-loading');
        
        btnStop.hide();
        
        audioElement.src = './pistes/'+pistes.random();
        audioElement.load();
        
        $(audioElement).on('canplay', function() {
            console.log('audio is loaded');
            animLoading.hide();
            btnPlay.show();
            $(this).off('canplay');
        });
 
        $(audioElement).on('ended', function() {
            console.log('piste terminée');
            // plugin.skip();
            var track = pistes.random();
            
            audioElement.src = './pistes/'+track;
            audioElement.load();
            audioElement.play();
            
        });
        
        

        function buildProgressBar() {
			
			var audio = audioElement;
			var start = $('#playerTime_Start');
			var end = $('#playerTime_End');
			var progressBar = $('#playerProgressBar');
			var now = $('#playerTime_Now');

			function conversion (value) {
				var minute = Math.floor(value / 60);
				minute = minute.toString().length === 1 ? ('0' + minute) : minute;
				var second = Math.round(value % 60);
				second = second.toString().length === 1 ? ('0' + second) : second;
				return `${minute}:${second}`;
			}

			audio.onloadedmetadata = function () {
				end.text(conversion(audio.duration));
				start.text(conversion(audio.currentTime));
			}

			progressBar.on('click', function (event) {
				var coordStart = this.getBoundingClientRect().left;
				var coordEnd = event.pageX;
				var p = (coordEnd - coordStart) / this.offsetWidth;
                
				now.css({width: p.toFixed(3) * 100 + '%'});

				audio.currentTime = p * audio.duration;
				audio.play();
				
				btnPlay.hide();
                btnStop.show();
			});

			setInterval(() => {
				start.text(conversion(audio.currentTime));
				// now.style.width = audio.currentTime / audio.duration.toFixed(3) * 100 + '%';
				now.css({width: audio.currentTime / audio.duration.toFixed(3) * 100 + '%'});
			}, 1000);
            
        }
        
        buildProgressBar();
        
        btnPlay.on('click', function() {
           $(this).hide();
           btnStop.show();
           
           audioElement.play();
        });
        
        btnStop.on('click', function() {
           $(this).hide();
           btnPlay.show(); 
           
           audioElement.pause();
        });
        
        btnRandom.on('click', function() {
            
            btnPlay.hide();
            btnStop.hide();
            animLoading.show();
            
            audioElement.src = './pistes/'+pistes.random();
            audioElement.load();
            
            $(audioElement).on('canplay', function() {
                console.log('audio is loaded');
                animLoading.hide();
                btnPlay.hide();
                btnStop.show();
                audioElement.play();
                $(this).off('canplay');
            });
        
            
        });
        
        $(window).on('load', function () {
            
            // $('html').addClass('site-loaded');
            $('.loader').fadeOut(300);
            
            $('#section-listen').fadeIn(300);
            $('.btn-close').fadeIn(300);
            
        });
        
        
        
    </script>

</body>

</html>