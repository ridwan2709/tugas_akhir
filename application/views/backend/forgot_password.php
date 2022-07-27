<?php $title = $this->db->get_where('settings', array('type' => 'system_title'))->row()->description; ?>
<?php $system_name = $this->db->get_where('settings', array('type' => 'system_name'))->row()->description; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo get_phrase('recover_your_password'); ?> | <?php echo $title; ?></title>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>style/login/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>style/login/css/fontawesome-all.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>style/login/css/iofrm-style.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>style/login/css/iofrm-theme16.css">
  <link href="<?php echo base_url(); ?>uploads/<?php echo $this->db->get_where('settings', array('type' => 'favicon'))->row()->description; ?>" rel="icon">
  <style>
    body {
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
    }
  </style>
</head>

<body>

  <div id="login">
    <div class="form-body without-side">
      <div class="row">
        <div class="form-holder">
          <div class="form-content">
            <div class="form-items">
              <center><img class="logo-size" src="<?php echo base_url(); ?>uploads/<?php echo $this->db->get_where('settings', array('type' => 'logo'))->row()->description; ?>" alt="" style="width:120px;"></center>
              <br>
              <h5 style="text-align:center"><?php echo get_phrase('recover_your_password'); ?></h5><br>
              <?php echo form_open(base_url() . 'login/lost_password/recovery'); ?>
              <input class="form-control" type="text" name="field" placeholder="<?php echo get_phrase('your_email'); ?>" required>
              <div class="form-button" style="text-align:center">
                <button id="submit" type="submit" class="ibtn"><?php echo get_phrase('recover'); ?></button>
              </div>
              </form>
              <br><br>
              <div class="page-links">
                <a href="<?php echo base_url(); ?>login/"><?php echo get_phrase('login_to_account'); ?></a> &nbsp;&nbsp;&nbsp;
                <?php if ($this->db->get_where('settings', array('type' => 'register'))->row()->description == 1) : ?><a href="<?php echo base_url(); ?>register/"><?php echo get_phrase('create_account'); ?></a><?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="<?php echo base_url(); ?>style/login/js/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>style/login/js/popper.min.js"></script>
  <script src="<?php echo base_url(); ?>style/login/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>style/login/js/main.js"></script>
</body>

</html>