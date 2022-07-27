<?php
$result_exam = $this->db->get_where('online_exam', array(
    'online_exam_id' => $online_exam_id
));
$row_exam = $result_exam->row();

if (isset($row_exam)) {
    $exam_date = $row_exam->exam_date;
    $class_id = $row_exam->class_id;
    $section_id = $row_exam->section_id;
    $subject_id = $row_exam->subject_id;
    $duration = ($row_exam->duration * 60);
}

$nama_cookie = $class_id . '-' . $section_id . '-' . $subject_id . '-' . $online_exam_id;
?>
<script>
    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        var expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    function getCookie(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    function checkCookie() {
        var cStartTime = getCookie("<?= $nama_cookie ?>");
        if (cStartTime != "") {
            console.log(cStartTime);
        } else {
            cStartTime = "<?= date('d-m-Y H:i:s'); ?>";
            if (cStartTime != "" && cStartTime != null) {
                var d = new Date();
                var exdays = 1 * (24 * 60 * 60 * 1000);
                d.setTime(d.getTime() + (exdays));
                setCookie("<?= $nama_cookie ?>", cStartTime, d.toUTCString());
            }
        }
    }

    function deleteCookie(cname) {
        setCookie(cname, "", "Thu, 01 Jan 1970 00:00:00 UTC; path=/;");
    }
</script>

<script src="<?php echo base_url(); ?>style/js/jquery.twbsPagination.js"></script>
<style>
    .page {
        display: none;
    }

    .sactive a {
        background: #0084ff;
        color: #fff;
    }

    .page-active {
        display: block;
    }
</style>
<?php
$questions_number = $this->db->get_where('question_bank', array('online_exam_id' => $online_exam_id))->num_rows();

$online_exam_result = $this->db->get_where('online_exam_result', array(
    'online_exam_id' => $online_exam_id
));
$oe_row = $online_exam_result->row();

if (isset($oe_row)) {
}

$current_timestamp = strtotime("now");
$start_user_click = $jam_mulai;
$start_user_click = base64_decode($start_user_click);
$start_user_click = strtotime($start_user_click);
$time_start = date('H:i', $start_user_click);
$time_end = date('H:i', ($start_user_click + $duration));
$exam_started = date('d-M-Y', $exam_date) . " " . $time_start;
$exam_ends_timestamp = date('d-M-Y', $exam_date) . " " . $time_end;

$exam_started = strtotime($exam_started);
$exam_ends_timestamp = strtotime($exam_ends_timestamp);
$time_start = strtotime($time_start);
$time_end = strtotime($time_end);

if ($current_timestamp < $exam_started) {
} elseif ($current_timestamp >= $exam_started) {
    if ($current_timestamp < $exam_ends_timestamp) {
    } elseif ($current_timestamp > $exam_ends_timestamp) {
    }
} else {
}

$datainfo = base64_encode($class_id . '-' . $section_id . '-' . $subject_id);
$sisa_waktu = $exam_ends_timestamp - $start_user_click;
$total_duration1 = $duration;
$jarak_mengerjakan = $exam_ends_timestamp - $exam_started;
$exam_ends_timestamp2 = $exam_started + $total_duration1;

if ($exam_ends_timestamp2 > $exam_ends_timestamp) {
    $exam_ends_timestamp2 = $exam_ends_timestamp;
}

$total_duration = $time_end - $current_timestamp;
$total_hour = intval($total_duration / 3600);
$total_minute = intval(($total_duration / 60) % 60);
$total_second = intval($total_duration % 60);

$online_exam_row = $exam_info->row();
$this->db->order_by('question_bank_id', 'RANDOM');
$questions = $this->db->get_where('question_bank', array('online_exam_id' => $online_exam_id))->result_array();

$total_marks = 0;
foreach ($questions as $row) {
    $total_marks += $row['mark'];
}
?>
<div class="content-w">
    <div class="conty">
        <?php include 'fancy.php'; ?>
        <div class="header-spacer"></div>
        <div class="ui-block responsive-flex1200">
            <div style="text-align: center; height: 110px">
                <h4 style="font-weight: bolder"><?php echo $online_exam_row->title; ?><br></h4>


                <h4><b><?php echo get_phrase('duration'); ?></b>: <?php echo ($online_exam_row->duration) . ' ' . get_phrase('minutes'); ?><br></h4>
                <div style="height:30px; font-size:25px; font-weight:200; color: #212121;" id="timer_value">
                    <span id="hour_timer"> 0 </span>
                    <span style="font-size:20px;">Jam</span>
                    <span class="blink_text">:</span>
                    <span id="minute_timer"> 0 </span>
                    <span style="font-size:20px;">Menit</span>
                    <span class="blink_text">:</span>
                    <span id="second_timer"> 0 </span>
                    <span style="font-size:20px;">Detik</span>
                </div>
            </div>
        </div>
        <hr>

        <div class="content-i">
            <div class="content-box">
                <form class="" action="<?php echo base_url(); ?>student/submit_online_exam/<?php echo $online_exam_id; ?>/" method="post" enctype="multipart/form-data" id="answer_script">
                    <div class="row">
                        <?php
                        $var = 0;
                        $id1 = 1;
                        $id2 = 1;
                        $id3 = 1;
                        $id4 = 1;
                        $count = 1;
                        foreach ($questions as $question) : $var++;
                        ?>
                            <element class="col-sm-6 col-aligncenter page " id="page<?php echo $var; ?>">
                                <div class="pipeline white lined-primary">
                                    <div class="pipeline-header">
                                        <h5><b><?php echo $count++; ?>.</b>
                                            <?php
                                            if ($question['type'] == 'fill_in_the_blanks') {
                                                echo str_replace('^', '__________', $question['question_title']);
                                                $img = $question['image'];
                                            ?>
                                                <img src="<?php echo base_url(); ?>uploads/exam_image/<?php echo $img; ?>.jpg">
                                            <?php
                                            } else {
                                                echo $question['question_title'];
                                            }
                                            ?>
                                        </h5><span>Bobot nilai : <?php echo $question['mark']; ?></span>
                                    </div>
                                    <?php if ($question['type'] == 'multiple_choice') : ?>
                                        <?php
                                        if ($question['options'] != '' || $question['options'] != null)
                                            $options = json_decode($question['options']);
                                        else
                                            $options = array();
                                        for ($i = 0; $i < $question['number_of_options']; $i++) :
                                        ?>
                                            <div class="col-sm-12 form-check">
                                                <label class="containers"><?php echo $options[$i]; ?>
                                                    <input type="checkbox" name="<?php echo $question['question_bank_id'] . '[]'; ?>" value="<?php echo $i + 1; ?>">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                    <?php
                                        endfor;
                                    endif;
                                    ?>
                                    <?php if ($question['type'] == 'true_false') : ?>
                                        <div class="skills-item">
                                            <div class="skills-item-info">
                                                <span class="skills-item-title">
                                                    <span class="radio">
                                                        <h6><label>
                                                                <input type="radio" name="<?php echo $question['question_bank_id'] . '[]'; ?>" value="true"><span class="circle"></span><span class="check"></span>
                                                                <?php echo get_phrase('true'); ?>
                                                            </label></h6>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="skills-item">
                                            <div class="skills-item-info">
                                                <span class="skills-item-title">
                                                    <span class="radio">
                                                        <h6><label>
                                                                <input type="radio" name="<?php echo $question['question_bank_id'] . '[]'; ?>" value="false"><span class="circle"></span><span class="check"></span>
                                                                <?php echo get_phrase('false'); ?>
                                                            </label></h6>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($question['type'] == 'fill_in_the_blanks') : ?>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea type="text" id="<?php echo 'ckeditor' . $question['question_bank_id']; ?>" name="<?php echo $question['question_bank_id'] . '[]'; ?>" class="form-control ckeditor" placeholder="<?php echo get_phrase('answer'); ?>"></textarea>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </element>
                        <?php endforeach; ?>
                    </div>
                    <div class="container">
                        <ul id="pagination-demo" class="pagination justify-content-center"></ul>
                    </div>
                    <input type="hidden" value="<?php echo $datainfo; ?>" name="datainfo">
                    <div class="col-sm-12 text-center">
                        <button style="margin-top:25px" class="btn btn-rounded btn-success text-center" id="subbutton"><?php echo get_phrase('finish_exam'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    ClassicEditor.create(document.querySelector('#ckeditor1'))
        .catch(error => {
            console.error(error);
        });
</script>
<script>
    $(document).ready(function() {
        disableReload();
        $(".pagination").rPage();
    });

    // slight update to account for browsers not supporting e.which
    function disableF5(e) {
        if ((e.which || e.keyCode) == 116) {
            confirm('Semua jawaban akan hilang jika di refresh!');
            e.preventDefault();
        }
    };

    function disableReload() {
        // To disable f5
        /* jQuery < 1.7 */
        $(document).bind("keydown", disableF5);
        /* OR jQuery >= 1.7 */
        $(document).on("keydown", disableF5);

        // To re-enable f5
        /* jQuery < 1.7 */
        $(document).unbind("keydown", disableF5);
        /* OR jQuery >= 1.7 */
        $(document).off("keydown", disableF5);

        // disable browser refresh
        window.onbeforeunload = function(event) {
            // swal.fire('Semua jawaban akan hilang jika di refresh!');
            event.preventDefault();
            return "Semua jawaban akan hilang jika di refresh!";
        }
    }
</script>
<script type="text/javascript">
    $('#pagination-demo').twbsPagination({
        totalPages: <?php echo $questions_number; ?>,
        startPage: 1,
        visiblePages: 5,
        initiateStartPageClick: true,
        href: false,
        hrefVariable: '{{number}}',
        first: 'First',
        prev: 'Previous',
        next: 'Next',
        last: 'Last',
        loop: false,
        onPageClick: function(event, page) {
            $('.page-active').removeClass('page-active');
            $('#page' + page).addClass('page-active');
        },
        paginationClass: 'pagination',
        nextClass: 'next',
        prevClass: 'prev',
        lastClass: 'last',
        firstClass: 'first',
        pageClass: 'pages',
        activeClass: 'active sactive',
        disabledClass: 'disabled'
    });
</script>
<script type="text/javascript">
    var timer_starting_hour = <?php echo $total_hour; ?>;
    document.getElementById("hour_timer").innerHTML = timer_starting_hour;
    var timer_starting_minute = <?php echo $total_minute; ?>;
    document.getElementById("minute_timer").innerHTML = timer_starting_minute;
    var timer_starting_second = <?php echo $total_second; ?>;
    document.getElementById("second_timer").innerHTML = timer_starting_second;
    var timer = timer_starting_second;
    var mytimer = setInterval(function() {
        run_timer()
    }, 1000);

    function run_timer() {
        if (timer == 0 && timer_starting_minute == 0 && timer_starting_hour == 0) {
            $("#answer_script").submit();
        } else {
            var questions = <?php echo json_encode($questions); ?>;
            var totalSoal = questions.length;
            var banyaknyaFormEmpty = 0;
            var type = "";

            for (var i = 0; i < totalSoal; i++) {
                var question = questions[i];
                var formEmpty = "default";

                if (question.type == "fill_in_the_blanks") {
                    var id = question.question_bank_id;
                    formEmpty = CKEDITOR.instances['ckeditor' + id].getData();
                } else if (question.type == "multiple_choice" || question.type == "true_false") {
                    var id = question.question_bank_id;
                    var check = $('input[name="' + id + '[]"]:checked').length;
                    formEmpty = check > 0 ? 1 : "";
                }

                banyaknyaFormEmpty = formEmpty == "" ? parseInt(banyaknyaFormEmpty) + 1 : banyaknyaFormEmpty;
            }
            // var checkboxEmpty =
            var infoFormEmpty = 'Masih ada ' + banyaknyaFormEmpty + ' soal yang belum terjawab!';
            console.log(infoFormEmpty);

            if (banyaknyaFormEmpty > 0) {
                $("#answer_script").submit(function(event) {
                    event.preventDefault();
                });
                $('#subbutton').html(infoFormEmpty);
                //swal.fire('warning!', infoFormEmpty);
            } else {
                $("#answer_script").unbind('submit');
                $('#subbutton').html('Ujian Selesai');
            }

            timer--;
            if (timer < 0) {
                timer = 59;
                timer_starting_minute--;
                if (timer_starting_minute >= 0) {
                    document.getElementById("minute_timer").innerHTML = timer_starting_minute;
                }
            }
            if (timer_starting_minute < 0) {
                timer_starting_minute = 59;
                document.getElementById("minute_timer").innerHTML = timer_starting_minute;
                timer_starting_hour--;
                document.getElementById("hour_timer").innerHTML = timer_starting_hour;
            }
            document.getElementById("second_timer").innerHTML = timer;
        }
    }
</script>

<script src="<?php echo base_url(); ?>style/cms/bower_components/ckeditor/ckeditor.js"></script>

<style type="text/css">
    .col-aligncenter {
        float: none;
        margin: 0 auto;
    }

    .blink_text {
        -webkit-animation-name: blinker;
        -webkit-animation-duration: 1s;
        -webkit-animation-timing-function: linear;
        -webkit-animation-iteration-count: infinite;
        -moz-animation-name: blinker;
        -moz-animation-duration: 1s;
        -moz-animation-timing-function: linear;
        -moz-animation-iteration-count: infinite;
        animation-name: blinker;
        animation-duration: 1s;
        animation-timing-function: linear;
        animation-iteration-count: infinite;
    }

    @-moz-keyframes blinker {
        0% {
            opacity: 1.0;
        }

        50% {
            opacity: 0.0;
        }

        100% {
            opacity: 1.0;
        }
    }

    @-webkit-keyframes blinker {
        0% {
            opacity: 1.0;
        }

        50% {
            opacity: 0.0;
        }

        100% {
            opacity: 1.0;
        }
    }

    @keyframes blinker {
        0% {
            opacity: 1.0;
        }

        50% {
            opacity: 0.0;
        }

        100% {
            opacity: 1.0;
        }
    }
</style>
<style media="screen">
    .containers {
        display: block;
        position: relative;
        padding-left: 35px;
        margin-bottom: 12px;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    .containers input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
    }

    .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 20px;
        width: 23px;
        background-color: #eee;
    }

    .containers:hover input~.checkmark {
        background-color: #ccc;
    }

    .containers input:checked~.checkmark {
        background-color: #2196F3;
    }

    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    .containers input:checked~.checkmark:after {
        display: block;
    }

    .containers .checkmark:after {
        left: 9px;
        top: 5px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 3px 3px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }
</style>