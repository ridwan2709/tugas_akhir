<?php
$group_info = $this->db->get_where('group_message_thread', array('group_message_thread_code' => $param2))->row_array();
$user_info  = json_decode($group_info['members']);
?>
<div class="modal-body" style="margin-top:0px;">
  <div class="modal-header" style="background-color:#00579c">
    <h6 class="title" style="color:white"><?php echo ($group_info['group_name']); ?></h6>
  </div>
  <div class="ui-block-content">
    <div class="row">
      <div class="col-md-12" style="margin-top: 10px;">
        <table class="table table-bordered">
          <thead>
            <tr class="bg-primary">
              <th class="text-white text-center"><?php echo '#'; ?></th>
              <th class="text-white text-center"><?php echo get_phrase('name'); ?></th>
            </tr>
          </thead>
          <?php for ($i = 0; $i < sizeof($user_info); $i++) :
            $user_data = explode('_', $user_info[$i]);
            $user_type = $user_data[0];
            $user_id   = $user_data[1];
          ?>
            <tr>
              <td style="text-align: center;"><?php echo $i + 1; ?> </td>
              <td><span><img src="<?php echo $this->crud_model->get_image_url($user_type, $user_id); ?>" class="img-circle purple" width="35" style="border-radius: 50%;"> &nbsp;&nbsp; <?php echo $this->db->get_where($user_type, array($user_type . '_id' => $user_id))->row()->first_name . " " . $this->db->get_where($user_type, array($user_type . '_id' => $user_id))->row()->last_name; ?></span></td>
            </tr>
          <?php endfor ?>
        </table>
      </div>


    </div>
  </div>
</div>