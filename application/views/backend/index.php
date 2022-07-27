<?php
$system_name        =  $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;
$system_title       =  $this->db->get_where('settings', array('type' => 'system_title'))->row()->description;
$account_type = $this->session->userdata('login_type');
$user_id = $this->session->userdata('login_user_id');
$user_type = $account_type;
$hsph_data = [
  'user_id' => $user_id,
  'user_type' => $user_type
];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title><?php echo $page_title; ?> | <?php echo $system_title; ?></title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta content="ie=edge" http-equiv="x-ua-compatible">
  <meta content="Aplikasi Sekolah, Homeschooling, Homeschooling Sukabumi, Homeschooling Permata Hati, HSPH, HS" name="keywords">
  <meta content="Homeschooling Permata Hati" name="author">
  <meta content="<?php echo $system_name . " " . $system_title; ?>" name="description">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <link href="<?php echo base_url(); ?>uploads/<?php echo $this->db->get_where('settings', array('type' => 'favicon'))->row()->description; ?>" rel="icon">
  <link href="<?php echo base_url(); ?>style/cms/css/main.css" media="all" rel="stylesheet">
  <!-- animate -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" media="all" rel="stylesheet">
  <link rel="stylesheet" href="https://pictogrammers.github.io/@mdi/font/2.0.46/css/materialdesignicons.min.css">

  <?php include 'topcss.php'; ?>

  <!-- Sweet Alert File -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body class="menu-position-side menu-side-left full-screen with-content-panel">
  <div class="with-side-panel">
    <div class="layout-w">
      <?php include $account_type . '/navigation.php'; ?>
      <?php include $account_type . '/' . $page_name . '.php'; ?>
      <div class="display-type"></div>
    </div>
    <?php include 'modal.php'; ?>
    <?php include 'scripts.php'; ?>
</body>

</html>