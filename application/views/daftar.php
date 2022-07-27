<?php include('header.php'); ?>

<link href="//db.onlinewebfonts.com/c/2c1ce06a505728976c1d2993407312b5?family=KFGQPC+Uthmanic+Script+HAFS" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://islamic-bit.netlify.app/hadits/daftar/index.css">
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

    .pagination li:not(.paginationjs-prev):not(.paginationjs-next) {
        border: none;
        padding: 0 .4rem;
        background-color: var(--white);
        font-family: "Poppins", sans-serif;
        font-size: 14px;
    }

    .pagination li a {
        color: #1c55e2;
    }

    .pagination li a:hover {
        color: #1c55e2;
    }

    .pagination li.active {
        background-color: #1c55e2 !important;
    }

    .pagination li.active a {
        color: var(--white);
    }

    .pagination li.active a:hover {
        color: var(--white);
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
    
        .top-line-lg {
            position: relative;
        }
    
        .bottom-line-lg {
            position: relative;
        }
    }

    @media (min-width: 992px) {
        .mb-lg-5 {
            margin-bottom: 3rem !important;
        }

        .pagination .container {
            width: 40%;
        }
    }
</style>

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

        <!-- Pagination -->
        <section class="pagination pagination1 mt-5" style="display: none;">
            <div class="container mx-auto"></div>
        </section>
        <!-- End Pagination -->

        <!-- Daftar Hadits -->
        <section class="daftar-hadits py-4">
            <div class="container mx-auto">
                <h3 style="color: var(--blue2);">Loading...</h3>
            </div>
        </section>
        <!-- End Daftar Hadits -->

        <!-- Pagination -->
        <section class="pagination pagination2 mt-5" style="display: none;">
            <div class="container mx-auto"></div>
        </section>
        <!-- End Pagination -->

    </body>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script src="https://islamic-bit.netlify.app/list.js"></script>
    <script src="https://islamic-bit.netlify.app/pagination.min.js"></script>
    <script>
        const param = document.location.href.split('?')[1].split('&');
        const idPerawi = param[0].split('=')[1]
        const jumlahHadits = param[1].split('=')[1]
        const page = param[2].split('=')[1]
        const range = param[3].split('=')[1]

        $.ajax({
            url: `https://api.hadith.sutanlab.id/books/${idPerawi}?range=${range}`,
            success: results => {
                const namaPerawi = results.data.name
                const dataHadits = results.data.hadiths
                let fragmentHadits = ''
                dataHadits.forEach(hadits => {
                    fragmentHadits += `
            <div class="hadits p-4 pt-5">
               <div class="detail">
                  <h5 class="nomer mb-3 a" style="color: #22214a;">${namaPerawi} No. ${hadits.number}</h5>
                  <h2 class="text-end mb-2 arab" style="font-weight: 600; line-height: 2.8rem">${hadits.arab}</h2>
                     <div class="info mt-3" style="letter-spacing: 1px;">
                        <div class="arti">
                           <h6 class="m-0 a" style="font-weight: 600; color: #22214a;">Artinya:</h6>
                           <h6 class="m-0 a" style="font-weight: 400; color: #22214a;">${hadits.id}</h6>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         `
                })

                $('.daftar-hadits .container').html(fragmentHadits)
                $('.nama-perawi').text(namaPerawi)

                // Lihat detail hadits saat tombol expand di click
                const expandDetail = document.querySelectorAll('.expand-detail');
                expandDetail.forEach(expand => {
                    expand.addEventListener('click', function() {
                        this.parentElement.querySelector('.info-hadits').classList.toggle('open');
                        this.classList.toggle('open');

                        if (this.parentElement.querySelector('.info-hadits').classList.contains('open')) {
                            const infoHeight = getComputedStyle(this.parentElement.querySelector('.info')).height;
                            this.parentElement.querySelector('.info-hadits').style.height = `calc(${infoHeight} + 2rem)`;
                        } else {
                            this.parentElement.querySelector('.info-hadits').style.height = '0';
                        }
                    })
                })

                // Mengubah display pagination menjadi block yang sebelumnya none saat API sudah diloads
                $('.pagination1').css('display', 'block')
                $('.pagination2').css('display', 'block')

                const pagiNext = document.querySelector('.paginationjs-next')
                const pagiPrev = document.querySelector('.paginationjs-prev')

                // Mengubah URL parameter saat pagination diclick sesuai dengan nomer
                pagiNext.addEventListener('click', function() {
                    if (!this.classList.contains('disabled')) {
                        changeURLParam(this)
                    }
                })
                pagiPrev.addEventListener('click', function() {
                    if (!this.classList.contains('disabled')) {
                        changeURLParam(this)
                    }
                })
            }
        })

        function changeURLParam(elem) {
            const rangeAwal = elem.getAttribute('data-num') * 20 - 19
            const rangeAkhir = (elem.getAttribute('data-num') * 20) > jumlahHadits ? jumlahHadits : (elem.getAttribute('data-num') * 20)

            document.location.href = `<?= base_url() ?>islamicApp/daftar/?id=${idPerawi}&jumlah=${jumlahHadits}&page=${elem.getAttribute('data-num')}&range=${rangeAwal}-${rangeAkhir}`
        }

        // Set library pagination.js untuk membuat pagination
        $('.pagination1 .container').pagination({
            dataSource: function(done) {
                var result = [];
                for (var i = 1; i <= parseInt(jumlahHadits); i++) {
                    result.push(i);
                }
                done(result);
            },
            pageNumber: page,
            pageSize: 20,
            afterPageOnClick: function() {
                makeBorderRadiusPagination()
                changeURLParam(document.querySelector('.pagination1 .active'))
            }
        })

        $('.pagination2 .container').pagination({
            dataSource: function(done) {
                var result = [];
                for (var i = 1; i <= parseInt(jumlahHadits); i++) {
                    result.push(i);
                }
                done(result);
            },
            pageNumber: page,
            pageSize: 20,
            afterPageOnClick: function() {
                makeBorderRadiusPagination()
                changeURLParam(document.querySelector('.pagination2 .active'))
            }
        })

        // Membuat border-radius pada item pagination di awal dan akhir
        function makeBorderRadiusPagination() {
            const paginationBtn1 = document.querySelectorAll('.pagination1 li');
            paginationBtn1[1].style.borderTopLeftRadius = '6px'
            paginationBtn1[1].style.borderBottomLeftRadius = '6px'

            paginationBtn1[paginationBtn1.length - 2].style.borderTopRightRadius = '6px'
            paginationBtn1[paginationBtn1.length - 2].style.borderBottomRightRadius = '6px'

            const paginationBtn2 = document.querySelectorAll('.pagination2 li');
            paginationBtn2[1].style.borderTopLeftRadius = '6px'
            paginationBtn2[1].style.borderBottomLeftRadius = '6px'

            paginationBtn2[paginationBtn2.length - 2].style.borderTopRightRadius = '6px'
            paginationBtn2[paginationBtn2.length - 2].style.borderBottomRightRadius = '6px'
        }
        makeBorderRadiusPagination()
    </script>

    <?php include('footer.php'); ?>