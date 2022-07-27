<!DOCTYPE html>
<html>
  <head>
    <title><?php echo get_phrase('terms_conditions');?> | <?php echo $this->db->get_where('settings', array('type' => 'system_title'))->row()->description;?></title>
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>style/cms/bower_components/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>style/cms/bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>style/cms/icon_fonts_assets/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">
    <link href="<?php echo base_url();?>style/cms/icon_fonts_assets/picons-thin/style.css" rel="stylesheet">
    <link href="<?php echo base_url();?>uploads/<?php echo $this->db->get_where('settings', array('type' => 'favicon'))->row()->description;?>" rel="icon">
    <link href="<?php echo base_url();?>style/cms/css/main.css?version=3.3" rel="stylesheet">
    <style>
    body{
    background: #1b55e2;
    }
    div#login {
    top: 0;
    position: fixed;
    width: 100%;
    height: 100%;
    z-index: 1;
    overflow: auto;
    left: 0;
    padding: 50px 0;
    }
    </style>
  </head>
  <body class="auth-wrapper login">
    <div id="login">
      <div class="auth-box-w wider">
        <div class="logo-wy">
          <a href="<?php echo base_url();?>"><img alt="" src="<?php echo base_url();?>uploads/<?php echo $this->db->get_where('settings', array('type' => 'logo'))->row()->description;?>" width="30%"></a><br><br>
        </div>
        <div class="steps-w">
          <div class="step-contents">
            <div class="step-content active" id="stepContent1">
                <h4><?php echo get_phrase('terms_conditions');?></h4><hr>
              <div class="row" style="font-family: Proxima Nova W01, Rubik, -apple-system, system-ui, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, sans-serif"; "font-size: 16px;">
                <br>
                <?php echo $this->db->get_where('academic_settings' , array('type' =>'terms'))->row()->description;?>
                <hr>
                <div class="pull-right"><br><br><br>
                    <a class="btn btn-purple btn-rounded text-white" href="<?php echo base_url();?>login/"> <?php echo get_phrase('return');?></a>
                <br><br>
              </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="<?php echo base_url();?>style/login/js/jquery.min.js"></script>
    <script src="<?php echo base_url();?>style/login/js/main.js"></script>
  </body>
</html>