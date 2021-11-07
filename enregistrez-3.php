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
        
        // Ported from Stefan Gustavson's java implementation
            // http://staffwww.itn.liu.se/~stegu/simplexnoise/simplexnoise.pdf
            // Read Stefan's excellent paper for details on how this code works.
            //
            // Sean McCullough banksean@gmail.com

            /**
             * You can pass in a random number generator object if you like.
             * It is assumed to have a random() method.
             */
        //     var ClassicalNoise = function (r) { // Classic Perlin noise in 3D, for comparison 
        //         if (r == undefined) r = Math;
        //         this.grad3 = [[1, 1, 0], [-1, 1, 0], [1, -1, 0], [-1, -1, 0],
        //         [1, 0, 1], [-1, 0, 1], [1, 0, -1], [-1, 0, -1],
        //         [0, 1, 1], [0, -1, 1], [0, 1, -1], [0, -1, -1]];
        //         this.p = [];
        //         for (var i = 0; i < 256; i++) {
        //             this.p[i] = Math.floor(r.random() * 256);
        //         }
        //         // To remove the need for index wrapping, double the permutation table length 
        //         this.perm = [];
        //         for (var i = 0; i < 512; i++) {
        //             this.perm[i] = this.p[i & 255];
        //         }
        //     };

        //     ClassicalNoise.prototype.dot = function (g, x, y, z) {
        //         return g[0] * x + g[1] * y + g[2] * z;
        //     };

        //     ClassicalNoise.prototype.mix = function (a, b, t) {
        //         return (1.0 - t) * a + t * b;
        //     };

        //     ClassicalNoise.prototype.fade = function (t) {
        //         return t * t * t * (t * (t * 6.0 - 15.0) + 10.0);
        //     };

        //     // Classic Perlin noise, 3D version 
        //     ClassicalNoise.prototype.noise = function (x, y, z) {
        //         // Find unit grid cell containing point 
        //         var X = Math.floor(x);
        //         var Y = Math.floor(y);
        //         var Z = Math.floor(z);

        //         // Get relative xyz coordinates of point within that cell 
        //         x = x - X;
        //         y = y - Y;
        //         z = z - Z;

        //         // Wrap the integer cells at 255 (smaller integer period can be introduced here) 
        //         X = X & 255;
        //         Y = Y & 255;
        //         Z = Z & 255;

        //         // Calculate a set of eight hashed gradient indices 
        //         var gi000 = this.perm[X + this.perm[Y + this.perm[Z]]] % 12;
        //         var gi001 = this.perm[X + this.perm[Y + this.perm[Z + 1]]] % 12;
        //         var gi010 = this.perm[X + this.perm[Y + 1 + this.perm[Z]]] % 12;
        //         var gi011 = this.perm[X + this.perm[Y + 1 + this.perm[Z + 1]]] % 12;
        //         var gi100 = this.perm[X + 1 + this.perm[Y + this.perm[Z]]] % 12;
        //         var gi101 = this.perm[X + 1 + this.perm[Y + this.perm[Z + 1]]] % 12;
        //         var gi110 = this.perm[X + 1 + this.perm[Y + 1 + this.perm[Z]]] % 12;
        //         var gi111 = this.perm[X + 1 + this.perm[Y + 1 + this.perm[Z + 1]]] % 12;

        //         // The gradients of each corner are now: 
        //         // g000 = grad3[gi000]; 
        //         // g001 = grad3[gi001]; 
        //         // g010 = grad3[gi010]; 
        //         // g011 = grad3[gi011]; 
        //         // g100 = grad3[gi100]; 
        //         // g101 = grad3[gi101]; 
        //         // g110 = grad3[gi110]; 
        //         // g111 = grad3[gi111]; 
        //         // Calculate noise contributions from each of the eight corners 
        //         var n000 = this.dot(this.grad3[gi000], x, y, z);
        //         var n100 = this.dot(this.grad3[gi100], x - 1, y, z);
        //         var n010 = this.dot(this.grad3[gi010], x, y - 1, z);
        //         var n110 = this.dot(this.grad3[gi110], x - 1, y - 1, z);
        //         var n001 = this.dot(this.grad3[gi001], x, y, z - 1);
        //         var n101 = this.dot(this.grad3[gi101], x - 1, y, z - 1);
        //         var n011 = this.dot(this.grad3[gi011], x, y - 1, z - 1);
        //         var n111 = this.dot(this.grad3[gi111], x - 1, y - 1, z - 1);
        //         // Compute the fade curve value for each of x, y, z 
        //         var u = this.fade(x);
        //         var v = this.fade(y);
        //         var w = this.fade(z);
        //         // Interpolate along x the contributions from each of the corners 
        //         var nx00 = this.mix(n000, n100, u);
        //         var nx01 = this.mix(n001, n101, u);
        //         var nx10 = this.mix(n010, n110, u);
        //         var nx11 = this.mix(n011, n111, u);
        //         // Interpolate the four results along y 
        //         var nxy0 = this.mix(nx00, nx10, v);
        //         var nxy1 = this.mix(nx01, nx11, v);
        //         // Interpolate the two last results along z 
        //         var nxyz = this.mix(nxy0, nxy1, w);

        //         return nxyz;
        //     };
        
        // var canvas = document.getElementById('canvas'),
        //         ctx = canvas.getContext('2d'),
        //         perlin = new ClassicalNoise(),
        //         variation = .0025,
        //         amp = 300,
        //         variators = [],
        //         max_lines = (navigator.userAgent.toLowerCase().indexOf('firefox') > -1) ? 25 : 40,
        //         canvasWidth,
        //         canvasHeight,
        //         start_y;

        //     for (var i = 0, u = 0; i < max_lines; i++, u += .02) {
        //         variators[i] = u;
        //     }

        //     function draw() {
        //         ctx.shadowColor = "rgba(43, 205, 255, 1)";
        //         ctx.shadowBlur = 0;

        //         for (var i = 0; i <= max_lines; i++) {
        //             ctx.beginPath();
        //             ctx.moveTo(0, start_y);
        //             for (var x = 0; x <= canvasWidth; x++) {
        //                 var y = perlin.noise(x * variation + variators[i], x * variation, 0);
        //                 ctx.lineTo(x, start_y + amp * y);
        //             }
        //             var color = Math.floor(150 * Math.abs(y));
        //             var alpha = Math.min(Math.abs(y) + 0.05, .05);
        //             ctx.strokeStyle = "rgba(255,255,255," + alpha * 2 + ")";
        //             ctx.stroke();
        //             ctx.closePath();

        //             variators[i] += .005;
        //         }
        //     }

        //     (function init() {
        //         resizeCanvas();
        //         animate();
        //         window.addEventListener('resize', resizeCanvas);
        //     })();

        //     function animate() {
        //         ctx.clearRect(0, 0, canvasWidth, canvasHeight);
        //         draw();
        //         requestAnimationFrame(animate);
        //     }

        //     function resizeCanvas() {
        //         canvasWidth = document.documentElement.clientWidth,
        //             canvasHeight = document.documentElement.clientHeight;

        //         canvas.setAttribute("width", canvasWidth);
        //         canvas.setAttribute("height", canvasHeight);

        //         start_y = canvasHeight / 2;
        //     }
        
        
        
        
        
        
        
        /*************** */
        // var w = c.width = window.innerWidth,
        //         h = c.height = window.innerHeight,
        //         ctx = c.getContext('2d'),

        //         opts = {
        //             particles: 200,
        //             baseSize: 30,
        //             addedSize: 20,
        //             baseSpeed: 3,
        //             addedSpeed: 2,
        //             colors: ['hsla(30,80%,50%,.5)', 'hsla(210,80%,50%,.5)']
        //         },

        //         particles = [],
        //         tick = 0;

        //     function Particle() {

        //         this.x = w / 2;
        //         this.y = h / 2;

        //         this.size = opts.baseSize + opts.addedSize * Math.random();

        //         var speed = opts.baseSpeed + opts.addedSpeed * Math.random(),
        //             rad = Math.random() * Math.PI * 2;

        //         this.vx = speed * Math.cos(rad);
        //         this.vy = speed * Math.sin(rad);

        //         this.color = opts.colors[(opts.colors.length * Math.random()) | 0];
        //     }
        //     Particle.prototype.step = function () {

        //         this.x += this.vx;
        //         this.y += this.vy;

        //         var flipX = true,
        //             flipY = true;

        //         if (this.x < 0)
        //             this.x = 0;
        //         else if (this.x > w)
        //             this.x = w;
        //         else
        //             flipX = false;

        //         if (this.y < 0)
        //             this.y = 0;
        //         else if (this.y > h)
        //             this.y = h;
        //         else
        //             flipY = false;

        //         if (flipX)
        //             this.vx *= -1;
        //         if (flipY)
        //             this.vy *= -1;

        //         ctx.fillStyle = this.color;
        //         ctx.beginPath();
        //         ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
        //         ctx.fill();
        //     }
        //     function anim() {

        //         window.requestAnimationFrame(anim);

        //         ++tick;

        //         ctx.globalCompositeOperation = 'source-over';
        //         ctx.fillStyle = 'rgba(0,0,0,1)';
        //         ctx.fillRect(0, 0, w, h);
        //         ctx.globalCompositeOperation = 'lighter';

        //         if (particles.length < opts.particles && Math.random() < .5)
        //             particles.push(new Particle);

        //         particles.map(function (particle) { particle.step(); });
        //     }
        //     anim();

        //     window.addEventListener('resize', function () {

        //         w = c.width = window.innerWidth;
        //         h = c.height = window.innerHeight;
        //     });
        
        /*******************************/
        // $('.water').css('width', $('body').width() * 2);
        // $('.water').css('height', $('body').width() * 2);
        
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