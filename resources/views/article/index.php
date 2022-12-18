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
    
    div.article p{
        font-size:19px;
        margin-bottom: 0px;
    }
</style>

<div class='body__content'>
<div class='ride__share__page page__common p-60 with-b-top'>
<div class='container'>
<h3 class='page-title bottom-border mb-3 pb-1'><?php echo $article->title; ?></h3>
<div class='row'>
<div class='col-12 col-md-12 col-lg-12 article'>
    
    <img src="<?php echo url('article_images/'.$article->image); ?>" style="max-width:100%;width: 100%;height: 500px;object-fit: cover;">


    <?php 

    $writerImage = $article->writer_image;

    $addedby = $article->added_by;

    $addedOn = $article->added_on;

    $addedOn = date('d F Y H:i A', strtotime($addedOn));

    if ($writerImage == "") {
        // code...
        $writerImage = "../assets/admin/dist/img/avatar5.png";
    }else{

        $writerImage = "../article_writers_image/".$writerImage;
    }

    ?>

    <div class="row" style="margin-top:20px;">
        <div class="col-2 col-md-1" style="text-align:center;">
            <img src="<?=$writerImage; ?>" style="width:50px;border-radius: 50px;height: 50px;object-fit: cover;margin-top: 3px;">
        </div>
        <div class="col-10 col-md-10">
            <p style="font-weight: 700;"><?=$addedby; ?></p>
            <p>Updated On <?=$addedOn; ?></p>
        </div>
    </div>

    <p class="mt-4 mb-0"><?php echo $article->description; ?></p>
    
</div>
</div>
</div>
</div>

</div>

<?php include(app_path().'/common/footer.php'); ?>
