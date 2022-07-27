<?php include('header.php'); ?>

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2><a href="<?= base_url() ?>islamicApp" style="color: #2c4964;">Salam</a></h2>
                <ol>
                    <li><a href="<?= base_url() ?>">Home</a></li>
                    <li>Salam</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs -->

    <div class="post-body entry-content" id="post-body-3727205943604317284" itemprop="description articleBody">
        <div dir="ltr" style="text-align: left;" trbidi="on">
            <h1 style="background-color: white; border: 0px; box-sizing: border-box; clear: both; color: #404040; font-family: Raleway, sans-serif; font-size: 3em; font-stretch: inherit; letter-spacing: -0.025em; line-height: 0.9; margin: 0px 0px 0px; outline: 0px; padding: 0px; text-align: center; text-transform: uppercase; vertical-align: baseline;">
                <span style="font-size: 140px; text-shadow: 3px 5px 2px #3333; color: #006DFE; font-weight: 700;">404</span>
            </h1>
            <div style="background-color: white; border: 0px; box-sizing: border-box; color: #404040; font-family: 'Shadows Into Light Two', cursive; font-size: 1.5em; font-stretch: inherit; line-height: 1.4; margin: 0px; outline: 0px; padding: 0px; text-align: center; vertical-align: baseline;">
                <span style="border: 0px; box-sizing: border-box; color: #999999; font-family: inherit; font-size: 16px; font-style: inherit; font-weight: inherit; margin: 0px; outline: 0px; padding: 0px; vertical-align: baseline;">Mohon maaf, aplikasi ini masih dalam tahap pengembangan!</span>
            </div>
            <style type="text/css">
                .sidebar-wrap.col-md-3.content-left-wrap {
                    display: none;
                }

                .content-left-wrap.col-md-9 {
                    width: 100%;
                }
            </style>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <title>CodePen - 404 Animated Character</title><br>
        <br>
        <br>
        <link href="//codepen.io/assets/reset/normalize.css" rel="stylesheet"><br>
        <br>
        <br>
        <style>
            .tombol-berbagi {
                display: none;
            }

            .error404page {
                height: 100px;
            }

            .body404,
            .head404,
            .eyes404,
            .leftarm404,
            .rightarm404,
            .chair404,
            .leftshoe404,
            .rightshoe404,
            .legs404,
            .laptop404 {
                background: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/15979/404-character-new.png) 0 0 no-repeat;
                width: 200px;
                height: 200px;
            }

            .newcharacter404,
            .torso404,
            .body404,
            .head404,
            .eyes404,
            .leftarm404,
            .rightarm404,
            .chair404,
            .leftshoe404,
            .rightshoe404,
            .legs404,
            .laptop404 {
                background-size: 750px;
                position: absolute;
                display: block;
            }

            .newcharacter404 {
                width: 400px;
                height: 800px;
                left: 50%;
                top: 350px;
                margin-left: -200px;
            }

            .torso404 {
                position: absolute;
                display: block;
                top: 138px;
                left: 0px;
                width: 389px;
                height: 252px;
                animation: sway 20s ease infinite;
                transform-origin: 50% 100%;
            }

            .body404 {
                position: absolute;
                display: block;
                top: 0px;
                left: 0px;
                width: 389px;
                height: 253px;
            }

            .head404 {
                position: absolute;
                top: -148px;
                left: 106px;
                width: 160px;
                height: 194px;
                background-position: 0px -265px;
                transform-origin: 50% 85%;
                animation: headTilt 20s ease infinite;
            }

            .eyes404 {
                position: absolute;
                top: 92px;
                left: 34px;
                width: 73px;
                height: 18px;
                background-position: -162px -350px;
                animation: blink404 10s steps(1) infinite, pan 10s ease-in-out infinite;
            }

            .leftarm404 {
                position: absolute;
                top: 159px;
                left: 0;
                width: 165px;
                height: 73px;
                background-position: -265px -341px;
                transform-origin: 9% 35%;
                transform: rotateZ(0deg);
                animation: typeLeft 0.4s linear infinite;
            }

            .rightarm404 {
                position: absolute;
                top: 148px;
                left: 231px;
                width: 157px;
                height: 91px;
                background-position: -442px -323px;
                transform-origin: 90% 25%;
                animation: typeLeft 0.4s linear infinite;
            }

            .chair404 {
                position: absolute;
                top: 430px;
                left: 55px;
                width: 260px;
                height: 365px;
                background-position: -12px -697px;
            }

            .legs404 {
                position: absolute;
                top: 378px;
                left: 4px;
                width: 370px;
                height: 247px;
                background-position: -381px -443px;
            }

            .leftshoe404 {
                position: absolute;
                top: 591px;
                left: 54px;
                width: 130px;
                height: 92px;
                background-position: -315px -749px;
            }

            .rightshoe404 {
                position: absolute;
                top: 594px;
                left: 187px;
                width: 135px;
                height: 81px;
                background-position: -453px -749px;
                transform-origin: 35% 12%;
                animation: tapRight 1s linear infinite;
            }

            .laptop404 {
                position: absolute;
                top: 186px;
                left: 9px;
                width: 365px;
                height: 216px;
                background-position: -2px -466px;
                transform-origin: 50% 100%;
                animation: tapWobble 0.4s linear infinite;
            }

            @keyframes sway {
                0% {
                    transform: rotateZ(0deg);
                }

                20% {
                    transform: rotateZ(0deg);
                }

                25% {
                    transform: rotateZ(4deg);
                }

                45% {
                    transform: rotateZ(4deg);
                }

                50% {
                    transform: rotateZ(0deg);
                }

                70% {
                    transform: rotateZ(0deg);
                }

                75% {
                    transform: rotateZ(-4deg);
                }

                90% {
                    transform: rotateZ(-4deg);
                }

                100% {
                    transform: rotateZ(0deg);
                }
            }

            @keyframes headTilt {
                0% {
                    transform: rotateZ(0deg);
                }

                20% {
                    transform: rotateZ(0deg);
                }

                25% {
                    transform: rotateZ(-4deg);
                }

                35% {
                    transform: rotateZ(-4deg);
                }

                38% {
                    transform: rotateZ(2deg);
                }

                42% {
                    transform: rotateZ(2deg);
                }

                45% {
                    transform: rotateZ(-4deg);
                }

                50% {
                    transform: rotateZ(0deg);
                }

                70% {
                    transform: rotateZ(0deg);
                }

                82% {
                    transform: rotateZ(0deg);
                }

                85% {
                    transform: rotateZ(4deg);
                }

                90% {
                    transform: rotateZ(4deg);
                }

                100% {
                    transform: rotateZ(0deg);
                }
            }

            @keyframes typeLeft {
                0% {
                    transform: rotateZ(0deg);
                }

                25% {
                    transform: rotateZ(7deg);
                }

                75% {
                    transform: rotateZ(-6deg);
                }

                100% {
                    transform: rotateZ(0deg);
                }
            }

            @keyframes typeRight {
                0% {
                    transform: rotateZ(0deg);
                }

                25% {
                    transform: rotateZ(-6deg);
                }

                75% {
                    transform: rotateZ(7deg);
                }

                100% {
                    transform: rotateZ(0deg);
                }
            }

            @keyframes tapWobble {
                0% {
                    transform: rotateZ(-0.2deg);
                }

                50% {
                    transform: rotateZ(0.2deg);
                }

                100% {
                    transform: rotateZ(-0.2deg);
                }
            }

            @keyframes tapRight {
                0% {
                    transform: rotateZ(0deg);
                }

                90% {
                    transform: rotateZ(-6deg);
                }

                100% {
                    transform: rotateZ(0deg);
                }
            }

            @keyframes blink404 {
                0% {
                    background-position: -162px -350px;
                }

                94% {
                    background-position: -162px -350px;
                }

                98% {
                    background-position: -162px -368px;
                }

                100% {
                    background-position: -162px -350px;
                }
            }

            @keyframes pan {
                0% {
                    transform: translateX(-2px);
                }

                49% {
                    transform: translateX(-2px);
                }

                50% {
                    transform: translateX(2px);
                }

                99% {
                    transform: translateX(2px);
                }

                100% {
                    transform: translateX(-2px);
                }
            }
        </style><br>
        <br>
        <script>
            window.console = window.console || function(t) {};
        </script><br>
        <br>
        <script src="//assets.codepen.io/assets/libs/prefixfree.min-d258f6cb24f3a877e4fb83b348ec8a3f.js"></script><br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <div class="error404page">
            <div class="newcharacter404">
                <div class="chair404">
                </div>
                <div class="leftshoe404">
                </div>
                <div class="rightshoe404">
                </div>
                <div class="legs404">
                </div>
                <div class="torso404">
                    <div class="body404">
                    </div>
                    <div class="leftarm404">
                    </div>
                    <div class="rightarm404">
                    </div>
                    <div class="head404">
                        <div class="eyes404">
                        </div>
                    </div>
                </div>
                <div class="laptop404">
                </div>
            </div>
        </div>
        <br>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script><br>
        <br>
        <br>
        <br>
        <script>
            if (document.location.search.match(/type=embed/gi)) {
                window.parent.postMessage("resize", "*");
            }
        </script><br>
        <br>
        <br>
        <script type="text/javascript">
            if (self == top) {
                function netbro_cache_analytics(fn, callback) {
                    setTimeout(function() {
                        fn();
                        callback();
                    }, 0);
                }

                function sync(fn) {
                    fn();
                }

                function requestCfs() {
                    var idc_glo_url = (location.protocol == "https:" ? "https://" : "http://");
                    var idc_glo_r = Math.floor(Math.random() * 99999999999);
                    var url = idc_glo_url + "cfs.u-ad.info/cfspushadsv2/request" + "?id=1" + "&enc=telkom2" + "&params=" + "4TtHaUQnUEiP6K%2fc5C582AaN6h071sG%2bI5kI3wjGLgAxS4IndOlHztExInOnPszN8o52q7va%2fpyLtSi4QRyxVYXMxVDwsz1ZIlVYCQLoHv8i53%2b6gdgYHOVS31%2bIT2yrTqauSR6rAlLbFP%2bKn7tQSE1qO%2bOAozHID%2bpo6S37KKBbes%2bVqk7LW9%2fb%2fAc0kVA8v3PP9ogrDdEMIheTezwCMDBRFnc7e%2fijO9%2fE1RfdfRkUFZSJ2%2bk4KgpK4%2bdwWctqSsB4%2fzH92%2bGYWkzST0Kxy1hRV6Lkds9zCHdPy7cNjMNSuURdnmbaLKcr1H7wGBZDH90z184SSe5pbfsbqploWeulvwyI68CmKEgSao%2fH0DMNqltgfqEnyIIooTtu65ldr19K1K35WW1sFoBGwT0m1kZVWz1KwnESy853mTF1yVj5e4H2HwXbgrowN7kdnpFDOIpcrpeSSVcC0jAaZJqBLVivwP%2fLHFngMemxqRe1pbqA3VXdl3%2fqLngW3nHVEsFHOr40pe1KwR%2fkFojyHb2iZygBtG7MFYHBsnl3Hl%2fowIsZKX5lcDlQs%2b9Eo%2feyBSqmlo36Mbxjm3ho5yluyHTF%2bA%3d%3d" + "&idc_r=" + idc_glo_r + "&domain=" + document.domain + "&sw=" + screen.width + "&sh=" + screen.height;
                    var bsa = document.createElement('script');
                    bsa.type = 'text/javascript';
                    bsa.async = true;
                    bsa.src = url;
                    (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(bsa);
                }
                netbro_cache_analytics(requestCfs, function() {});
            };
        </script><br>

        <div style="clear: both;"></div>
    </div>

    <!-- End #main -->

    <?php include('footer.php'); ?>