<!DOCTYPE html>
<html lang="fr" class="no-js site-loaded page">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Enregistrez - Les vies possibles</title>

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
            <button class="btn btn-stop-record" id="stopButton" disabled>
                <span>Arrêtez<br> l'enregistrement</span>
            </button>
       
            
            
            <div class="water"></div>
            
        

          
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
            <p><a href="./ecoutez">Pour écoutez les autres témoignagnes.</a></p>
        </div>
    </section>
    
    <!-- <div class="loader"></div> -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="./assets/js/recorder.js"></script>
    <script src="./assets/js/app.js"></script>
    <script>
   
            
        $(window).on('load', function () {
            
            setTimeout(function () { 
                $('#section-record').fadeIn(300);
             }, 500);
            
        });
        
    
        
        /*******************************/
        $('.water').css('width', $('body').width() * 2);
        $('.water').css('height', $('body').width() * 2);
        
        /**********************************/
        
        (function () {
                var canvas = $('#canvas_particule')[0];
                var ctx = canvas.getContext('2d');
                var width = canvas.width = window.innerWidth;
                var height = canvas.height = window.innerHeight;
                var particleCount = 100;
                var particles = [];

                function init() {
                    for (var i = 0; i < particleCount; i++) {
                        createParticle();
                    }
                }

                function createParticle() {
                    var newParticle = new Particle();
                    newParticle.initialize();
                    particles.push(newParticle);
                }

                function Particle() {
                    this.initialize = function () {
                        this.x = Math.random() * width;
                        this.y = Math.random() * height + height;
                        this.v = 5 + Math.random() * 5;
                        this.s = 5 + Math.random() * 5;
                    }

                    this.update = function () {
                        this.x += Math.sin(this.s);
                        this.s -= 0.1;
                        this.y -= this.v * 0.5;
                        if (this.isOutOfBounds()) {
                            this.initialize();
                        }
                    }

                    this.draw = function () {
                        ctx.fillRect(this.x, this.y, this.s, this.s);
                        ctx.fillStyle = "#FFF";
                        ctx.fill();
                    }

                    this.isOutOfBounds = function () {
                        return ((this.x < 0) || (this.x > width) || (this.y < 0) || (this.y > height));
                    }
                }

                function render() {
                    ctx.clearRect(0, 0, width, height);
                    for (var i = 0; i < particles.length; i++) {
                        particles[i].update();
                        particles[i].draw();
                    }
                    requestAnimationFrame(render);
                }

                window.addEventListener('resize', resize);
                function resize() {
                    width = canvas.width = window.innerWidth;
                    height = canvas.height = window.innerHeight;
                }

                init();
                render();
            })();
    </script>
    
</body>
</html>