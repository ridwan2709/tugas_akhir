<?php $events = $this->db->get('events')->result_array(); ?>
<div class="content-w">
  <?php include 'fancy.php'; ?>
  <div class="header-spacer"></div>
  <div class="conty"><br>
    <div class="container-fluid">
      <div class="layout-w">
        <div class="content-w">
          <div class="container-fluid">
            <div class="element-box">
              <h3 class="form-header"><?php echo get_phrase('calendar_events'); ?></h3><br>
              <div class="table-responsive">
                <div id="calendar" class="col-centered"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="display-type"></div>
    </div>

    <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="ModalAdd" aria-hidden="true">
      <div class="modal-dialog window-popup create-friend-group create-friend-group-1" role="document">
        <div class="modal-content">
          <form method="POST" action="<?php echo base_url() ?>admin/calendar/create">
            <a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close"></a>
            <div class="modal-header">
              <h6 class="title"><?php echo get_phrase('add_event'); ?></h6>
            </div>
            <div class="modal-body">
              <div class="form-group label-floating">
                <label class="control-label"><?php echo get_phrase('title'); ?></label>
                <input class="form-control" name="title" type="text" id="title" required="">
              </div>
              <div class="form-group label-floating">
                <label class="control-label"><?php echo get_phrase('description'); ?></label>
                <textarea class="form-control" name="deskripsi" type="text" id="deskripsi" required=""></textarea>
              </div>
              <div class="form-group label-floating is-select">
                <label class="control-label"><?php echo get_phrase('color'); ?></label>
                <div class="select">
                  <select name="color" id="color" required="">
                    <option value=""><?php echo get_phrase('select'); ?></option>
                    <option style="color:#0071c5;" value="#0071c5">&#9724; Dark blue</option>
                    <option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquoise</option>
                    <option style="color:#008000;" value="#008000">&#9724; Green</option>
                    <option style="color:#FFD700;" value="#FFD700">&#9724; Yellow</option>
                    <option style="color:#FF8C00;" value="#FF8C00">&#9724; Orange</option>
                    <option style="color:#FF0000;" value="#FF0000">&#9724; Red</option>
                    <option style="color:#000;" value="#000">&#9724; Black</option>
                  </select>
                </div>
              </div>
              <div class="form-group with-button">
                <label>Start Date</label>
                <input type="datetime-local" class="form-control" name="start" value="<?php echo get_phrase('start_date'); ?>" type="text" id="start" required="">
              </div>
              <div class="form-group with-button">
                <label>End Date</label>
                <input type="datetime-local" class="form-control" name="end" value="<?php echo get_phrase('end_date'); ?>" type="text" id="end" required="">
              </div>
              <button type="submit" class="btn btn-rounded btn-success btn-lg full-width"><?php echo get_phrase('add'); ?></button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="ModalEdit" aria-hidden="true">
      <div class="modal-dialog window-popup create-friend-group create-friend-group-1" role="document">
        <div class="modal-content">
          <form method="POST" action="<?php echo base_url() ?>admin/calendar/update">
            <a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close"></a>
            <div class="modal-header">
              <h6 class="title"><?php echo get_phrase('edit_event'); ?></h6>
            </div>
            <div class="modal-body">
              <div class="form-group with-button">
                <label> <?php echo get_phrase('title'); ?></label><input class="form-control" name="title" placeholder="<?php echo get_phrase('title'); ?>" type="text" id="title" required="">
              </div>
              <div class="form-group with-button">
                <label> <?php echo get_phrase('description'); ?></label><textarea class="form-control" name="deskripsi" type="text" id="deskripsi" required=""></textarea>
              </div>
              <div class="form-group label-floating is-select">
                <label class="control-label"><?php echo get_phrase('color'); ?></label>
                <div class="select">
                  <select name="color" id="color" required="">
                    <option value=""><?php echo get_phrase('select'); ?></option>
                    <option style="color:#0071c5;" value="#0071c5">&#9724; Dark blue</option>
                    <option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquoise</option>
                    <option style="color:#008000;" value="#008000">&#9724; Green</option>
                    <option style="color:#FFD700;" value="#FFD700">&#9724; Yellow</option>
                    <option style="color:#FF8C00;" value="#FF8C00">&#9724; Orange</option>
                    <option style="color:#FF0000;" value="#FF0000">&#9724; Red</option>
                    <option style="color:#000;" value="#000">&#9724; Black</option>
                  </select>
                </div>
              </div>
              <input type="hidden" name="id" class="form-control" id="id">
              <div class="form-group with-button">
                <label>Start Date</label>
                <input class="form-control" name="start" value="<?php echo get_phrase('start_date'); ?>" type="text" id="start_edit" required="">
              </div>
              <div class="form-group with-button">
                <label>End Date</label>
                <input class="form-control" name="end" value="<?php echo get_phrase('end_date'); ?>" type="text" id="end_edit" required="">
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <div class="checkbox">
                    <label class="text-danger"><input type="checkbox" name="delete"> <?php echo get_phrase('delete'); ?></label>
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-rounded btn-success btn-lg full-width"><?php echo get_phrase('update'); ?></button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <script>
      $(document).ready(function() {
        $('#calendar').fullCalendar({
          header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,basicWeek,basicDay'
          },
          defaultDate: $('#calendar').fullCalendar('today'),
          editable: true,
          displayEventTime: true,
          displayEventEnd: false,
          timeFormat: 'h:mma',
          defaultView: 'month',
          contentHeight: '100%',
          lang: '<?php echo $this->db->get_where('settings', array('type' => 'calendar'))->row()->description; ?>',
          eventLimit: true,
          selectable: true,
          selectHelper: true,
          select: function(start, end) {
            $('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
            $('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
            $('#ModalAdd').modal('show');
          },
          eventAfterAllRender: function(view) {
            if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
              $('#calendar').fullCalendar('changeView', 'agendaDay');
            }
          },
          eventRender: function(event, element) {
            element.bind('dblclick', function() {
              $('#ModalEdit #id').val(event.id);
              $('#ModalEdit #start_edit').val(moment(event.start).format('YYYY-MM-DD HH:mm:ss'));
              $('#ModalEdit #end_edit').val(moment(event.end).format('YYYY-MM-DD HH:mm:ss'));
              $('#ModalEdit #title').val(event.title);
              $('#ModalEdit #deskripsi').val(event.deskripsi);
              $('#ModalEdit #color').val(event.color);
              $('#ModalEdit').modal('show');
            });
          },
          eventDrop: function(event, delta, revertFunc) {
            edit(event);
          },
          eventResize: function(event, dayDelta, minuteDelta, revertFunc) {
            edit(event);
          },
          events: [
            <?php foreach ($events as $event) :
              $start = explode(" ", $event['start']);
              $end = explode(" ", $event['end']);
              if ($start[1] == '00:00:00') {
                $start = $start[0];
              } else {
                $start = $event['start'];
              }
              if ($end[1] == '00:00:00') {
                $end = $end[0];
              } else {
                $end = $event['end'];
              }
            ?> {
                id: '<?php echo $event['id']; ?>',
                title: `<?php echo $event['title']; ?>`,
                deskripsi: `<?php echo $event['deskripsi']; ?>`,
                start: '<?php echo $start; ?>',
                end: '<?php echo $end; ?>',
                color: '<?php echo $event['color']; ?>',
              },
            <?php endforeach; ?>
          ]
        });

        function edit(event) {
          start = event.start.format('YYYY-MM-DD HH:mm:ss');
          if (event.end) {
            end = event.end.format('YYYY-MM-DD HH:mm:ss');
          } else {
            end = start;
          }
          id = event.id;
          Event = [];
          Event[0] = id;
          Event[1] = start;
          Event[2] = end;
          $.ajax({
            url: '<?php echo base_url(); ?>admin/calendar/update_date/',
            type: "POST",
            data: {
              Event: Event
            },
            success: function(rep) {
              if (rep == 'OK') {
                const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 8000
                });
                Toast.fire({
                  type: 'success',
                  title: '<?php echo get_phrase('successfully_updated'); ?>'
                })
              } else {
                alert('Error update');
              }
            }
          });
        }
      });
    </script>
  </div>
</div>