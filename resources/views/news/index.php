<?php include(app_path().'/common/header.php'); ?>
<style>
    @media only screen and (max-width: 756px) {
        ul.home__news__list li {
            padding-left: 0px; 
            padding-right: 0px;
        }
    }
    
    ul.home__news__list li {
    flex-basis: auto;
    }
    
    .card
    {
        margin-bottom: 30px;
        border: 1px solid rgba(0,0,0,.125) !important;
    }
</style>

<div class='body__content'>
<div class='ride__share__page page__common p-60 with-b-top'>
<div class='container'>
<div class='row'>
<div class='col-12 col-md-12 col-lg-12'>
    
    <div class="row">
        
        <?php 
        if(!empty($news)) {
            foreach($news as $n) {
        ?>
        <div class="col-12 col-md-4">
            <div class="card">
  <a href="<?php echo url('article/'.$n->url); ?>"><img class="card-img-top" style="height:250px;object-fit: cover;" src="<?php echo url('article_images/'.$n->image); ?>" alt="Card image cap"></a>
  <div class="card-body">
    <h5 class="card-title" style="height:70px;overflow: hidden;"><?php echo $n->title; ?></h5>
    <p style="height:100px !important;overflow: hidden !important;" class="card-text"><?php echo substr(strip_tags(str_replace('</p>', ' ', $n->description)), 0, 200).'...'; ?></p>
    <a href="<?php echo url('article/'.$n->url); ?>" class="btn btn-primary">Read article</a>
  </div>
</div>
        </div>
        <?php } } ?>
        
    </div>
    
</div>
</div>
</div>
</div>

</div>

<?php include(app_path().'/common/footer.php'); ?>
