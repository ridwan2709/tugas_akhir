<script>
    window.hsph_data = <?= json_encode($hsph_data) ?>;
    if (window.navigator.userAgent.indexOf('HSPH/2') !== -1) {
        Android.login(hsph_data.user_id, hsph_data.user_type);
    }
    window.base_url = <?= json_encode(base_url()) ?>
</script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<script src="<?php echo base_url(); ?>style/js/picker.js"></script>
<script src="<?php echo base_url(); ?>style/js/picker.en.js"></script>
<script src="<?php echo base_url(); ?>style/cms/bower_components/bootstrap-clockpicker/bootstrap-clockpicker.min.js"></script>

<script type="text/javascript">
    $('.clockpicker').clockpicker({
        placement: 'top',
        align: 'left',
        donetext: 'Done'
    });
</script>

<script>
    $(document).ready(function() {
        console.log('jquery tab-pane run success');

        $(".navs-item a, .nav-item a").click(function() {
            var id = $(this).attr("href");

            $('.tab-pane').each(function(index, object) {
                // console.log(object.id);
                $(this).removeClass('active');
            });

            $(id).addClass('active');
            $(id).removeClass('active');
            console.log(id);
        });

        $("figure.media").each(function(index) {
            var src = $(this).find("oembed").attr("url").replace("watch?v=", "embed/");
            // console.log(src);
            $(this).html('<iframe width="560" height="315" src="' + src + '?feature=oembed&autoplay=false" frameborder="0" allowfullscreen></iframe>');
        });
    });
</script>

<?php if ($this->session->flashdata('flash_message') != "") : ?>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        Toast.fire({
            icon: 'success',
            title: '<?php echo $this->session->flashdata("flash_message"); ?>'
        })
    </script>
<?php endif; ?>

<script type="text/javascript">
    $(".delete").click(function(e) {

        e.preventDefault();
        const href = $(this).attr('href');

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-ok',
                cancelButton: 'btn btn-cancel'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Delete',
            cancelButtonText: 'Cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                document.location.href = href;
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Your data is still stored safely',
                    'error'
                )
            }
        })

    });

    $(".save").click(function(e) {

        e.preventDefault();
        const href = $(this).attr('href');

        Swal.fire({
            title: 'Are you sure?',
            text: "This data will be saved directly!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Save'
        }).then((result) => {
            if (result.value) {
                document.location.href = href;
            }

        })

    });
</script>

<script>
    $(document).ready(function() {
        if ($("#mymce").length > 0) {
            tinymce.init({
                selector: "textarea#mymce",
                theme: "modern",
                height: 300,
                plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                    "save table contextmenu directionality emoticons template paste textcolor"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",

            });
        }
    });
</script>

<!-- input color -->
<script type="text/javascript" src="<?php echo base_url(); ?>jscolor.js"></script>
<script src="<?php echo base_url(); ?>style/cms/bower_components/jquery/dist/jquery.min.js"></script>
<script src='<?php echo base_url(); ?>style/fullcalendar/js/jquery.js'></script>
<script src='<?php echo base_url(); ?>assets/js/jquery.mask.min.js'></script>
<script src="<?php echo base_url(); ?>style/cms/bower_components/moment/moment.js"></script>
<script src="<?php echo base_url(); ?>style/cms/bower_components/tether/dist/js/tether.min.js"></script>
<script src="<?php echo base_url(); ?>style/cms/js/ckeditor.js"></script>
<script src="<?php echo base_url(); ?>style/cms/bower_components/bootstrap-validator/dist/validator.min.js"></script>
<script src="<?php echo base_url(); ?>style/cms/bower_components/dropzone/dist/dropzone.js"></script>
<script src="<?php echo base_url(); ?>style/cms/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>style/cms/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>style/cms/bower_components/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js"></script>
<script src="<?php echo base_url(); ?>style/cms/bower_components/bootstrap/js/dist/util.js"></script>
<script src="<?php echo base_url(); ?>style/cms/bower_components/bootstrap/js/dist/tab.js"></script>
<script src="<?php echo base_url(); ?>style/cms/js/main.js"></script>
<script src="<?php echo base_url(); ?>style/cms/bower_components/dragula.js/dist/dragula.min.js"></script>
<script src="<?php echo base_url(); ?>style/cms/bower_components/bootstrap/js/dist/modal.js"></script>
<script src="<?php echo base_url(); ?>style/cms/bower_components/bootstrap/js/dist/tooltip.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>style/cms/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>style/tinymce/tinymce.min.js"></script>
<script src="<?php echo base_url(); ?>style/cms/bower_components/popper.js/dist/umd/popper.min.js"></script>
<script src="<?php echo base_url(); ?>style/cms/bower_components/slick-carousel/slick/slick.min.js"></script>
<script src="<?php echo base_url(); ?>style/cms/bower_components/bootstrap/js/dist/alert.js"></script>
<script src="<?php echo base_url(); ?>style/cms/bower_components/bootstrap/js/dist/button.js"></script>
<script src="<?php echo base_url(); ?>style/cms/bower_components/bootstrap/js/dist/carousel.js"></script>
<script src="<?php echo base_url(); ?>style/cms/bower_components/bootstrap/js/dist/collapse.js"></script>
<script src="<?php echo base_url(); ?>style/cms/bower_components/bootstrap/js/dist/dropdown.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ajax-form-submission.js"></script>
<script src='<?php echo base_url(); ?>style/fullcalendar/js/fullcalendar.min.js'></script>
<script src="<?php echo base_url(); ?>style/olapp/js/jquery.appear.js"></script>
<script src="<?php echo base_url(); ?>style/olapp/js/jquery.matchHeight.js"></script>
<script src="<?php echo base_url(); ?>style/olapp/js/svgxuse.js"></script>
<script src="<?php echo base_url(); ?>style/olapp/js/Headroom.js"></script>
<script src="<?php echo base_url(); ?>style/olapp/js/velocity.js"></script>
<script src="<?php echo base_url(); ?>style/olapp/js/ScrollMagic.js"></script>
<script src="<?php echo base_url(); ?>style/olapp/js/jquery.waypoints.js"></script>
<script src="<?php echo base_url(); ?>style/olapp/js/jquery.countTo.js"></script>
<script src="<?php echo base_url(); ?>style/olapp/js/material.min.js"></script>
<script src="<?php echo base_url(); ?>style/olapp/js/bootstrap-select.js"></script>
<script src="<?php echo base_url(); ?>style/olapp/js/smooth-scroll.js"></script>
<script src="<?php echo base_url(); ?>style/olapp/js/selectize.js"></script>
<script src="<?php echo base_url(); ?>style/olapp/js/swiper.jquery.js"></script>
<script src="<?php echo base_url(); ?>style/olapp/js/moment.js"></script>
<script src="<?php echo base_url(); ?>style/olapp/js/isotope.pkgd.js"></script>
<script src="<?php echo base_url(); ?>style/olapp/js/circle-progress.js"></script>
<script src="<?php echo base_url(); ?>style/olapp/js/loader.js"></script>
<script src="<?php echo base_url(); ?>style/olapp/js/jquery.magnific-popup.js"></script>
<script src="<?php echo base_url(); ?>style/olapp/js/sticky-sidebar.js"></script>
<script src="<?php echo base_url(); ?>style/olapp/js/base-init.js"></script>
<script defer src="<?php echo base_url(); ?>style/olapp/fonts/fontawesome-all.js"></script>
<script src="<?php echo base_url(); ?>style/olapp/Bootstrap/dist/js/bootstrap.bundle.js"></script>
<script>
    window.MathJax = {
        MathML: {
            extensions: ["mml3.js", "content-mathml.js"]
        }
    };
</script>
<script type="text/javascript" async src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.0/MathJax.js?config=MML_HTMLorMML"></script>