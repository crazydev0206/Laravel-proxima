<?php @session_start();
if(!isset($_SESSION['admin_id'])) {
?>
<script> window.location="../login"; </script>
<?php
}
else {
include('../common/connect.php');

if($_SERVER['REQUEST_METHOD']=='POST') {
    
  if(isset($_POST['p_id'])) {
  $id=test_input($_POST['p_id']);
      
  $q="DELETE FROM journals WHERE id='$id'";
  $r=@mysqli_query($dbc,$q);
  }
    
  }

$q="SELECT * FROM journals WHERE publisher!='' AND cite_score!='' ORDER BY id DESC";
$r=@mysqli_query($dbc,$q);

    $jou='active';
include('../common/header.php'); ?>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <?php include('../common/left_menu.php'); ?>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        All Journals
        <small><?php 
    $q2="SELECT id FROM journals";
    $r2=@mysqli_query($dbc,$q2);
    echo @mysqli_num_rows($r2); ?> total journals</small>
          <?php if(isset($error2)) echo '<br>'.$error2; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="../all_journals/">All Journals</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box" style="overflow:hidden; padding-top:20px; padding-left:10px; padding-right:10px;">
              
            <form action="" method="get">
          <div class="row">
            <div class="col-12 col-md-6">
              <div class="form-group">
                <input class="form-control" type="text" placeholder="Search by Keywords" name="keywords" value="<?php if(isset($_GET['keywords'])) echo $_GET['keywords']; ?>">
              </div>
            </div>
            <div class="col-12 col-md-6">
              <div class="input-group">
                <select class="form-control" name="category">
                    <option value="">All Journals</option>
                    <?php $i=0;
                    $q="SELECT name FROM journal_categories ORDER BY name ASC";
                    $r=@mysqli_query($dbc,$q);
                    if(@mysqli_num_rows($r)!=0) {
                        while($row=@mysqli_fetch_assoc($r)) {
                            if($i++==0) $category=$row['name'];
                    ?>
                  <option value="<?php echo $row['name']; ?>" <?php if(isset($_GET['category']) AND $_GET['category']==$row['name']) echo 'selected'; ?> ><?php echo $row['name']; ?></option>
                    <?php } } ?>
                </select>
                <span class="input-group-btn">
                  <button class="btn btn-secondary">
                    <span class="fa fa-search"></span>
                  </button>
                </span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-md-12">
              <div class="form-group float-left" style="float:left;">
                <label class="custom-control custom-radio">
                  <input class="custom-control-input" id="title-radio" name="type" type="radio" checked value="1">
                  <span class="custom-control-indicator"></span>
                  <span class="custom-control-description">Title</span>
                </label>
                <label class="custom-control custom-radio">
                  <input class="custom-control-input" id="issn-radio" name="type" type="radio" value="2" <?php if(isset($_GET['type']) AND $_GET['type']=='2') echo 'checked'; ?> >
                  <span class="custom-control-indicator"></span>
                  <span class="custom-control-description">ISSN</span>
                </label>
                <label class="custom-control custom-radio">
                  <input class="custom-control-input" id="publisher-radio" name="type" type="radio" value="3" <?php if(isset($_GET['type']) AND $_GET['type']=='3') echo 'checked'; ?> >
                  <span class="custom-control-indicator"></span>
                  <span class="custom-control-description">Publisher</span>
                </label>
              </div>
                
                <div class="form-group float-right" style="max-width:170px; float:right;">
                    <select class="form-control" name="s">
                        <option value="">Sort By</option>
                        <option value="1" <?php if(isset($_GET['s']) AND $_GET['s']=='1') echo 'selected'; ?> >Title Ascending</option>
                        <option value="2" <?php if(isset($_GET['s']) AND $_GET['s']=='2') echo 'selected'; ?> >Title Descending</option>
                        <option value="3" <?php if(isset($_GET['s']) AND $_GET['s']=='3') echo 'selected'; ?> >Highest H Index</option>
                        <option value="4" <?php if(isset($_GET['s']) AND $_GET['s']=='4') echo 'selected'; ?> >Lowest H Index</option>
                        <option value="5" <?php if(isset($_GET['s']) AND $_GET['s']=='5') echo 'selected'; ?> >Highest SJR</option>
                        <option value="6" <?php if(isset($_GET['s']) AND $_GET['s']=='6') echo 'selected'; ?> >Lowest SJR</option>
                        <option value="7" <?php if(isset($_GET['s']) AND $_GET['s']=='7') echo 'selected'; ?> >Highest Cite Score</option>
                        <option value="8" <?php if(isset($_GET['s']) AND $_GET['s']=='8') echo 'selected'; ?> >Lowest Cite Score</option>
                    </select>
              </div>
            </div>
            <!--<div class="col-12 col-md-6">
              <label class="custom-control custom-checkbox">
                <input class="custom-control-input" type="open_access_journals" disabled>
                <span class="custom-control-indicator"></span>
                <span class="custom-control-description">Display only Open Access journals</span>
              </label>
            </div>-->
          </div>
            </form>
        
            <!--<div class="box-header">
              <h3 class="box-title"></h3>
            </div>-->
            <!-- /.box-header -->

            <div class="box-body" style="margin-top:30px;">
                <style>
                      .dataTables_info, .dataTables_paginate, .paging_simple_numbers{
                          display:none;
                      }
                  </style>
              <table  class="table table-bordered table-striped"> <!--id="example_2"-->
                <thead>
                <tr>
                  <th>#ID</th>
                  <th>Title</th>
                  <th>ISSN</th>
                  <th>Publisher</th>
                  <th>SJR</th>
                  <th>Cite Score</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                  <?php $k=""; $c=""; $s="";
                        if(isset($_GET['s'])) {
                        $s=test_input($_GET['s']);
                            if($s=='1')
                        $s=" ORDER BY title ASC ";
                            else if($s=='2')
                        $s=" ORDER BY title DESC ";
                            else if($s=='3')
                        $s=" ORDER BY h_index DESC ";
                            else if($s=='4')
                        $s=" ORDER BY h_index ASC ";
                            else if($s=='5')
                        $s=" ORDER BY sjr DESC ";
                            else if($s=='6')
                        $s=" ORDER BY sjr ASC ";
                            else if($s=='7')
                        $s=" ORDER BY cite_score DESC ";
                            else if($s=='8')
                        $s=" ORDER BY cite_score ASC ";
                        }
                        if(isset($_GET['type']) AND $_GET['type']=='1' AND !empty($_GET['keywords'])) {
                        $keywords=test_input($_GET['keywords']);
                        $k=" AND title LIKE '%$keywords%' ";
                        }
                        else if(isset($_GET['type']) AND $_GET['type']=='2' AND !empty($_GET['keywords'])) {
                        $keywords=test_input($_GET['keywords']);
                        $k=" AND issn LIKE '%$keywords%' ";
                        }
                        else if(isset($_GET['type']) AND $_GET['type']=='3' AND !empty($_GET['keywords'])) {
                        $keywords=test_input($_GET['keywords']);
                        $k=" AND publisher LIKE '%$keywords%' ";
                        }
                        if(isset($_GET['category']) AND !empty($_GET['category'])){
                            $category=test_input($_GET['category']);
                            $c=" AND categories LIKE '%$category%' ";
                        }
                        if(isset($_GET['pa'])) {
                        $pa=test_input($_GET['pa']);
                                if($pa==1 OR $pa<1) $limit=0;
                                else $limit=($pa-1)*100;
                        //$q="SELECT j_id FROM j_cat_data WHERE name='$category' LIMIT $limit, 100";
                            }
                        else $limit=0;
                        $q="SELECT * FROM journals WHERE id!='1' ".$k.$c.$s." LIMIT $limit, 100";
                        /*if(isset($_GET['pa'])) {
                        $pa=test_input($_GET['pa']);
                                if($pa==1 OR $pa<1) $limit=0;
                                else $limit=($pa-1)*100;
                        $q="SELECT * FROM journals WHERE id!='1' LIMIT $limit, 100";
                            }
                            else
                        $q="SELECT * FROM journals WHERE id!='1' LIMIT 100";*/
                    $r=@mysqli_query($dbc,$q);
                  if(@mysqli_num_rows($r)!=0) {
                    while($row=@mysqli_fetch_assoc($r)) {
                        $p_id=$row['id'];
                   ?>
                <tr>
                  <td><?php echo $row['id']; ?></td>
                  <td><?php echo $row['title']; ?></td>
                  <td><?php echo $row['issn']; ?></td>
                  <td><?php echo $row['publisher']; ?></td>
                  <td><?php echo $row['sjr']; ?></td>
                  <td><?php echo $row['cite_score'] ?></td>
                  <td>
                      <a href="../abstracts/?id=<?php echo $p_id; ?>" target="_blank"><button type="submit" class="btn btn-primary">Abstracts</button></a><br>
                      <a href="../journal_reviews/?id=<?php echo $p_id; ?>" target="_blank"><button type="submit" class="btn btn-primary">Reviews</button></a>
                      
                      <a href="../edit_journal/?id=<?php echo $p_id; ?>"><button type="submit" class="btn btn-success"><i class="fa fa-edit"></i></button></a>
                    <form action="" method="post" style="display:inline;">
                    <input type="hidden" name="p_id" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Do you really want to delete this journal?');"><i class="fa fa-trash"></i></button>
                  </form>
                  </td>
                </tr>
                <?php } } else echo '<tr><td>No result found!</tr></td>'; ?>
                </tbody>
                <tfoot>

                </tfoot>
              </table>
            </div>
              
              <div class="job-content-pagination float-right" style="float:right;">
                  <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <?php 
                        if(isset($_GET['pa'])) $pa=test_input($_GET['pa']);
                        else $pa=1;
                        
                        if($pa>1) $pa=$pa-1;
                        if($pa<1) $pa=1;
                        ?>
                      <li class="page-item <?php if(($pa==1 AND $_GET['pa']=='1') OR !isset($_GET['pa'])) echo 'disabled'; ?>">
                        <a class="page-link" href="?pa=<?php echo $pa; if(isset($_GET['keywords'])) echo '&keywords='.$_GET['keywords']; if(isset($_GET['type'])) echo '&type='.$_GET['type']; if(isset($_GET['category'])) echo '&category='.$_GET['category']; if(isset($_GET['s'])) echo '&s='.$_GET['s']; ?>">Previous</a>
                      </li>
                        <?php 
                        if(isset($_GET['category']) AND !empty($_GET['category'])) { 
                        $category=test_input($_GET['category']);
                        $q="SELECT id FROM journals WHERE id!='1' ".$k.$c."";
                        }
                        else {
                        $q="SELECT id FROM journals WHERE id!='1' ".$k.$c."";
                        }
                        
                        //echo $q;
                        $r=@mysqli_query($dbc,$q);
                        $total=@mysqli_num_rows($r); //echo $total;
                        $pages=number_format($total/100,0); //echo $pages;
                        $j=1;
                        if(isset($_GET['pa'])) $pa=test_input($_GET['pa']);
                        
                        if($pa==1) $start=1;
                        else $start=$pa-4;
                        
                        if($start<1) $start=1;
                        
                        if(isset($_GET['pa'])) $ac=test_input($_GET['pa']);
                        else $ac=1;
                        for($i=$start;$i<=$pages;$i++) {
                        ?>
                      <li class="page-item <?php if($i==$ac) echo 'active'; ?>">
                        <a class="page-link" href="?pa=<?php echo $i; if(isset($_GET['keywords'])) echo '&keywords='.$_GET['keywords']; if(isset($_GET['type'])) echo '&type='.$_GET['type']; if(isset($_GET['category'])) echo '&category='.$_GET['category']; if(isset($_GET['s'])) echo '&s='.$_GET['s'];  ?>"><?php echo $i; ?></a>
                      </li>
                        <?php
                            if($j++==9) break; } 
                        
                        if(isset($_GET['pa'])) {
                            $pa=test_input($_GET['pa']);
                            $pa=$pa+1;
                        }
                        else $pa=2;
                        
                        if($pa>$pages) $pa=$pages;
                        if(isset($_GET['pa'])) $pa2=test_input($_GET['pa']);
                        else $pa2=1;
                        ?>
                      <li class="page-item <?php if(($pa2==$pages)) echo 'disabled'; ?>">
                        <a class="page-link" href="?pa=<?php echo $pa; if(isset($_GET['keywords'])) echo '&keywords='.$_GET['keywords']; if(isset($_GET['type'])) echo '&type='.$_GET['type']; if(isset($_GET['category'])) echo '&category='.$_GET['category']; if(isset($_GET['s'])) echo '&s='.$_GET['s'];  ?>">Next</a>
                      </li>
                    </ul>
                  </nav>
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
    include('../common/footer.php');
}
?>
