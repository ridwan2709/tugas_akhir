<?php include('header.php'); ?>

<link href="//db.onlinewebfonts.com/c/2c1ce06a505728976c1d2993407312b5?family=KFGQPC+Uthmanic+Script+HAFS" rel="stylesheet" type="text/css" />
<style>
    @font-face {
        font-family: "KFGQPC Uthmanic Script HAFS";
        src: url("//db.onlinewebfonts.com/t/2c1ce06a505728976c1d2993407312b5.eot");
        src: url("//db.onlinewebfonts.com/t/2c1ce06a505728976c1d2993407312b5.eot?#iefix") format("embedded-opentype"), url("//db.onlinewebfonts.com/t/2c1ce06a505728976c1d2993407312b5.woff2") format("woff2"), url("//db.onlinewebfonts.com/t/2c1ce06a505728976c1d2993407312b5.woff") format("woff"), url("//db.onlinewebfonts.com/t/2c1ce06a505728976c1d2993407312b5.ttf") format("truetype"), url("//db.onlinewebfonts.com/t/2c1ce06a505728976c1d2993407312b5.svg#KFGQPC Uthmanic Script HAFS") format("svg");
    }

    .arab {
        font-family: "KFGQPC Uthmanic Script HAFS";
        font-size: 24px;
        color: #26254e;
    }

    .faq .section-title h2,
    .faq .section-title p {
        color: #26254e;
    }

    .faq {
        background: none;
    }

    .bx-help-circle:before {
        content: "\ea6f";
    }

    section {
        padding: 50px 0;
    }

    .faq .faq-list li {
        padding: 0 30px 0 30px;
    }

    a {
        color: #1c55e2;
    }

    .mb-3 {
        margin-bottom: 1rem !important;
    }

    .py-5 {
        padding-top: 3rem !important;
        padding-bottom: 3rem !important;
    }

    .justify-content-center {
        -webkit-justify-content: center !important;
        justify-content: center !important;
    }

    .integration-list .item img {
        width: 100px;
        height: auto;
        background: #fff;
    }

    .rounded-circle {
        border-radius: 50% !important;
    }

    .shadow {
        box-shadow: 0 0.5rem 1rem rgb(0 0 0 / 15%) !important;
    }

    img,
    svg {
        vertical-align: middle;
    }

    img:hover {
        opacity: 0.6;
        filter: alpha(opacity=60);
        /* For IE8 and earlier */
    }

    @media (min-width: 1200px) {
        .top-line-lg:before {
            content: "";
            display: inline-block;
            width: 160px;
            height: 80px;
            z-index: -1;
            background: transparent;
            border: none;
            border-top: dashed 3px #cccff8;
            padding: 30px;
            border-radius: 50%;
            position: absolute;
            right: -80px;
            top: -10px;
        }
    }

    @media (min-width: 1200px) {
        .bottom-line-lg:before {
            content: "";
            display: inline-block;
            width: 160px;
            height: 80px;
            z-index: -1;
            background: transparent;
            border: none;
            border-bottom: dashed 3px #cccff8;
            padding: 30px;
            border-radius: 50%;
            position: absolute;
            right: -80px;
            bottom: -10px;
        }
    }

    @media (min-width: 1200px) {
        .top-line-lg {
            position: relative;
        }
    }

    @media (min-width: 1200px) {
        .bottom-line-lg {
            position: relative;
        }
    }

    @media (min-width: 992px) {
        .mb-lg-5 {
            margin-bottom: 3rem !important;
        }
    }
</style>
<script>
    $.ajax({
        url: 'https://islamic-api-zhirrr.vercel.app/api/kisahnabi',
        success: results => {
            const dataKisahNabi = results
            console.log(dataKisahNabi)
            let fragmentKisahNabi = ''

            dataKisahNabi.forEach((nabi, i) => {
                if (i !== 15 && i !== 16 && i !== 17) {
                    fragmentKisahNabi += `
             <a href="full/?id=${i}&kisah=${nabi.name.replace('(Part 1)', '')}" class="d-block" style="color: var(--blue2);">
                <div class="nama-nabi px-4 pt-4 pb-3">
                   <h3 class="mb-3" style="font-weight: 600;">${nabi.name.replace('(Part 1)', '')}</h3>
                   <p class="highlight">
                      ${nabi.usia}
                   </p>
                </div>
             </a>
          `;
                }
            })

            $('.kisah-nabi .container').html(fragmentKisahNabi)
        }
    })
</script>

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Hadits Rosul</h2>
                <ol>
                    <li><a href="<?= base_url() ?>/islamicApp">Salam</a></li>
                    <li>Hadits Rosul</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs -->

    <body>
        <!-- ======= Frequently Asked Questions Section ======= -->
        <section id="faq" class="faq section-bg">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>Hadits Rosul</h2>
                    <p>Berikut beberapa kumpulan hadits yang sudah disusun berdasarkan perawinya oleh 9 imam (Kutubut Tis'ah)</p>
                </div>
                <div class="integration-list row justify-content-center py-5" style="text-align-last: center;">
                    <div class="item col-4 col-md-3 col-lg-2 mb-3 mb-lg-5"><a href="<?= base_url() ?>islamicApp/daftar/?id=abu-daud&jumlah=4419&page=1&range=1-20"><img class="shadow" src="https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1561990135l/52188737._SX318_SY475_.jpg" alt=""></a>
                        <p>Abu Daud <br />4419 Hadits</p>
                    </div>
                    <div class="item col-4 col-md-3 col-lg-2 mb-3 mb-lg-5"><a href="<?= base_url() ?>islamicApp/daftar/?id=ahmad&jumlah=4305&page=1&range=1-20"><img class="shadow" src="https://www.islamweb.net/PicStore/Random/1335250622_177123.jpg" alt=""></a>
                        <p>Ahmad <br />4305 Hadits</p>
                    </div>
                    <div class="item col-4 col-md-3 col-lg-2 mb-3 mb-lg-5"><a href="<?= base_url() ?>islamicApp/daftar/?id=bukhari&jumlah=4419&page=1&range=1-20"><img class="shadow" src="https://upload.wikimedia.org/wikipedia/id/d/d7/ArabicSahihBukhari.jpg" alt=""></a>
                        <p>Bukhari <br />6638 Hadits</p>
                    </div>
                    <div class="item col-4 col-md-3 col-lg-2 mb-3 mb-lg-5"><a href="<?= base_url() ?>islamicApp/daftar/?id=darimi&jumlah=4419&page=1&range=1-20"><img class="shadow" src="https://hadis.uk/wp-content/uploads/2011/09/sunan_darimee.jpg" alt=""></a>
                        <p>Darimi <br />2949 Hadits</p>
                    </div>
                    <div class="item col-4 col-md-3 col-lg-2 mb-3 mb-lg-5"><a href="<?= base_url() ?>islamicApp/daftar/?id=ibnu-majah&jumlah=4419&page=1&range=1-20"><img class="shadow" src="https://2.bp.blogspot.com/_JGI0Xv0341s/TG9NJPnQp_I/AAAAAAAAALk/5vnjOy64dcc/s1600/sunan+ibnu+majah.jpg" alt=""></a>
                        <p>Ibnu Majah <br />4285 Hadits</p>
                    </div>
                    <div class="item col-4 col-md-3 col-lg-2 mb-3 mb-lg-5"><a href="<?= base_url() ?>islamicApp/daftar/?id=malik&jumlah=4419&page=1&range=1-20"><img class="shadow" src="https://upload.wikimedia.org/wikipedia/commons/6/69/Muwatta_El_Imam_Malik.jpg" alt=""></a>
                        <p>Malik <br />1587 Hadits</p>
                    </div>
                    <div class="item col-4 col-md-3 col-lg-2 mb-3 mb-lg-5"><a href="<?= base_url() ?>islamicApp/daftar/?id=muslim&jumlah=4419&page=1&range=1-20"><img class="shadow" src="https://upload.wikimedia.org/wikipedia/id/5/5c/SaheehMuslim.jpg" alt=""></a>
                        <p>Muslim <br />4930 Hadits</p>
                    </div>
                    <div class="item col-4 col-md-3 col-lg-2 mb-3 mb-lg-5"><a href="<?= base_url() ?>islamicApp/daftar/?id=nasai&jumlah=4419&page=1&range=1-20"><img class="shadow" src="https://2.bp.blogspot.com/-CUuZRJdyH9Q/T3nJAZsZREI/AAAAAAAAA0o/nF1qksB0xCU/s1600/sunan+nasa'i.jpg" alt=""></a>
                        <p>Nasai <br />5364 Hadits</p>
                    </div>
                    <div class="item col-4 col-md-3 col-lg-2 mb-3 mb-lg-5"><a href="<?= base_url() ?>islamicApp/daftar/?id=tirmidzi&jumlah=4419&page=1&range=1-20"><img class="shadow" src="https://store.sunnahpublishing.net/wp-content/uploads/2016/04/jami-at-tirmidhi-2-1.gif" alt=""></a>
                        <p>Tirmidzi <br />3625 Hadits</p>
                    </div>
                </div>
            </div>
        </section><!-- End Frequently Asked Questions Section -->
    </body>

    <?php include('footer.php'); ?>