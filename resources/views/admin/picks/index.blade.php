<?php
$picks_page='active';
include(app_path().'/admin/common/header.php'); ?>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <?php include(app_path().'/admin/common/left_menu.php'); ?>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        All Picks
        <small><?php echo count($picks); ?> total picks</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo url('admin/picks'); ?>">All Picks</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <!--<div class="box-header">
              <h3 class="box-title"></h3>
            </div>-->
            <!-- /.box-header -->
              
              <button class="btn btn-success" style="float:right;" onclick="add_new()">+ Add New</button>

          <form role="form" action="" method="post" style="margin-top:5px; display:none;" id="add_new">
              {{ csrf_field() }}
              <div class="box-body">
                  <div class="form-group">
                  <label for="exampleInputEmail1">Pick for<font style="color:red;">*</font></label>
                  <select class="form-control" id="exampleInputEmail1" placeholder="" required name="type" onchange="this.options[this.selectedIndex].onclick()">
                      <option value="">Select Type</option>
                      <option value="NFL" onclick="show_teams(this.value)">NFL</option>
                      <option value="NBA" onclick="show_teams(this.value)">NBA</option>
                  </select>
                </div>
                  
                <div class="form-group">
                  <label for="exampleInputEmail1">Title<font style="color:red;">*</font></label>
                  <input type="text" class="form-control" id="title" placeholder="" required name="title">
                </div>
                  
                  <div class="form-group">
                  <label for="exampleInputEmail1">Team<font style="color:red;">*</font></label>
                  <select class="form-control" placeholder="" name="team" id="teams" required>
                      <option value="">Select Pick Type First</option>
                  </select>
                </div>
                  
                  <div class="form-group">
                  <label for="exampleInputEmail1">Pick<font style="color:red;">*</font></label>
                  <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" required name="pick">
                </div>
                  
                  <div class="form-group">
                  <label for="exampleInputEmail1">Notes<font style="color:red;">*</font></label>
                  <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" required name="notes" value="No Notes">
                </div>
                  
                  <div class="form-group">
                  <label for="exampleInputEmail1">Date<font style="color:red;">*</font></label>
                  <input type="date" class="form-control" id="title" placeholder="" required name="date">
                </div>
                
                <div class="form-group">
                  <label for="exampleInputEmail1">Time<font style="color:red;">*</font></label>
                  <input type="time" class="form-control" id="title" placeholder="" required name="time">
                </div>
                  
              </div>

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Add</button>
              </div>
              <hr>
          </form>
              <script>
                  function add_new(){
                      $("#add_new").slideToggle();
                  }
                  
                  function show_teams(type){
                      if(type=='NFL'){
                          $("#teams").empty();
                          $("#teams").append('<option value="">Select NFL Team</option>\
                      <option value="Arizona Cardinals">Arizona Cardinals</option>\
                      <option value="Atlanta Falcons">Atlanta Falcons</option>\
                      <option value="Baltimore Ravens">Baltimore Ravens</option>\
                      <option value="Buffalo Bills">Buffalo Bills</option>\
                      <option value="Carolina Panthers">Carolina Panthers</option>\
                      <option value="Chicago Bears">Chicago Bears</option>\
                      <option value="Cincinnati Bengals">Cincinnati Bengals</option>\
                      <option value="Cleveland Browns">Cleveland Browns</option>\
                      <option value="Dallas Cowboys">Dallas Cowboys</option>\
                      <option value="Denver Broncos">Denver Broncos</option>\
                      <option value="Detroit Lions">Detroit Lions</option>\
                      <option value="Green Bay Packers">Green Bay Packers</option>\
                      <option value="Houston Texans">Houston Texans</option>\
                      <option value="Indianapolis Colts">Indianapolis Colts</option>\
                      <option value="Jacksonville Jaguars">Jacksonville Jaguars</option>\
                      <option value="Kansas City Chiefs">Kansas City Chiefs</option>\
                      <option value="Miami Dolphins">Miami Dolphins</option>\
                      <option value="Minnesota Vikings">Minnesota Vikings</option>\
                      <option value="New England Patriots">New England Patriots</option>\
                      <option value="New Orleans Saints">New Orleans Saints</option>\
                      <option value="New York Giants">New York Giants</option>\
                      <option value="New York Jets">New York Jets</option>\
                      <option value="Oakland Raiders">Oakland Raiders</option>\
                      <option value="Philadelphia Eagles">Philadelphia Eagles</option>\
                      <option value="Pittsburgh Steelers">Pittsburgh Steelers</option>\
                      <option value="St. Louis Rams">St. Louis Rams</option>\
                      <option value="San Diego Chargers">San Diego Chargers</option>');
                          $("#title").val('NFL Pick');
                      }
                      else if(type=='NBA'){
                          $("#teams").empty();
                          $("#teams").append('<option value="">Select NBA Team</option>\
                      <option value="Atlanta Hawks">Atlanta Hawks</option>\
                      <option value="Boston Celtics">Boston Celtics</option>\
                      <option value="Brooklyn Nets">Brooklyn Nets</option>\
                      <option value="Charlotte Hornets">Charlotte Hornets</option>\
                      <option value="Chicago Bulls">Chicago Bulls</option>\
                      <option value="Cleveland Cavaliers">Cleveland Cavaliers</option>\
                      <option value="Dallas Mavericks">Dallas Mavericks</option>\
                      <option value="Denver Nuggets">Denver Nuggets</option>\
                      <option value="Detroit Pistons">Detroit Pistons</option>\
                      <option value="Golden State Warriors">Golden State Warriors</option>\
                      <option value="Houston Rockets">Houston Rockets</option>\
                      <option value="Indiana Pacers">Indiana Pacers</option>\
                      <option value="Los Angeles Clippers">Los Angeles Clippers</option>\
                      <option value="Memphis Grizzlies">Memphis Grizzlies</option>\
                      <option value="Miami Heat">Miami Heat</option>\
                      <option value="Milwaukee Bucks">Milwaukee Bucks</option>\
                      <option value="Minnesota Timberwolves">Minnesota Timberwolves</option>\
                      <option value="New Orleans Pelicans">New Orleans Pelicans</option>\
                      <option value="New York Knicks">New York Knicks</option>\
                      <option value="Oklahoma City Thunder">Oklahoma City Thunder</option>\
                      <option value="Orlando Magic">Orlando Magic</option>\
                      <option value="Philadelphia 76ers">Philadelphia 76ers</option>\
                      <option value="Phoenix Suns">Phoenix Suns</option>\
                      <option value="Portland Trail Blazers">Portland Trail Blazers</option>\
                      <option value="Sacramento Kings">Sacramento Kings</option>\
                      <option value="San Antonio Spurs">San Antonio Spurs</option>\
                      <option value="Toronto Raptors">Toronto Raptors</option>\
                      <option value="Utah Jazz">Utah Jazz</option>\
                      <option value="Washington Wizards">Washington Wizards</option>');
                          $("#title").val('NBA Pick');
                      }
                  }
              </script>

            <div class="box-body" style="margin-top:30px;">
                <?php if(isset($error) AND !empty($error)) echo $error.'<br><br>'; ?>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#ID</th>
                  <th>Pick For</th>
                  <th>Title</th>
                  <th>Team</th>
                    <th>Pick</th>
                    <th>Notes</th>
                    <th>Posted On</th>
                    <th>Result</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                    if(!empty($picks)) {
                        foreach($picks as $row) {
                        $r_id=$row->id;
                   ?>
                <tr>
                  <td><?php echo $row->id; ?></td>
                  <td><?php echo $row->type; ?></td>
                  <td><?php echo $row->title; ?></td>
                    <td><?php echo $row->team; ?></td>
                    <td><?php echo $row->pick; ?></td>
                    <td><?php echo $row->notes; ?></td>
                    <td><?php echo $row->on_date; ?></td>
                    <td><?php echo $row->result; ?></td>
                  <td>
                      <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#details-<?php echo $r_id; ?>"><i class="fa fa-list"></i></button>
                    <form action="" method="post" style="display:inline;">
                        {{ csrf_field() }}
                    <input type="hidden" name="delete_id" value="<?php echo $row->id; ?>">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Do you really want to delete this pick?');"><i class="fa fa-trash"></i></button>
                  </form>
                  </td>
                </tr>
                <?php } } ?>
                    
                </tbody>
                <tfoot>

                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php
if(!empty($picks)) {
        foreach($picks as $row) {
?>

    <div class="modal fade" id="details-<?php echo $row->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="update" value="<?php echo $row->id; ?>">
              <div class="modal-header">
                  <h5 class="modal-title">Details</h5>
              </div>
              <div class="modal-body">
                  
                  <table class="table table-striped">
                <tbody>
                    <?php $reference=array(); ?>
                    
                    <tr><td><b>Result:</b></td><td>
                        <select name="result" class="form-control" required>
                            <option value="" selected>Select</option>
                            <option value="Win" <?php if($row->result=='Win') echo 'selected'; ?> >Win</option>
                            <option value="Loss" <?php if($row->result=='Loss') echo 'selected'; ?> >Loss</option>
                            <option value="Push" <?php if($row->result=='Push') echo 'selected'; ?> >Push</option>
                        </select>
                        </td></tr>
                    
                    </tbody>
                <tfoot>

                </tfoot>
              </table>
                  
              </div>
              <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
              </div>
                  </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

<?php } } ?>
<?php include(app_path().'/admin/common/footer.php'); 
?>
