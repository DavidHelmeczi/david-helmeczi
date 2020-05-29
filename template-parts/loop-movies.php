<?php
    $runtime = get_field('runtime'); ?>
		<div class="page" id="page-<?php the_ID(); ?>">

    <script>

      var pageId='<?php echo the_ID(); ?>';

    </script>

    <div class="row border"> <? //delimitator intre filme ?>

    <div class="col-lg-4 col-md-6"> <? // coloana cu featured image ?>

    <div class="featured-image">

    <?php if (has_post_thumbnail()) {
    the_post_thumbnail();
    } else {  //daca filmul nu are featured image folosim un placeholder
    ?>
    <img src='https://popcornusa.s3.amazonaws.com/placeholder-movieimage.png' class="img-thumbnail img-fluid" style="width:300px">
    <?php 
    } ?>
    </div>
    </div>
    <div class="col-lg-8 col-md-6 bg-light order-first order-md-last"> <? // coloana cu continut ?>
   
    <h1 class="text-danger font-weight-light"><?php
    the_title();
    echo get_the_term_list($post->ID, 'dn_years', ' ', ', ', ''); //afisam anul/anii
    ?>
    <i id="heart-<?php echo the_ID(); ?>" onclick="classToggle(this)" class="fa-heart ml-4 far" data-toggle="tooltip" data-placement="right" title="Adauga la favorite"></i> <? // butonul favorite ?>
    </h1>

    <script>

    var element = document.getElementById("heart-<?php echo the_ID(); ?>"); //gasim iconita corespunzator filmului 
    if(favorite.includes(pageId) && element.classList.contains("fas")!="true"){
      element.classList.toggle('fas'); //daca filmul a fost adaugat ca si favorit adaugam class-ul "fas" care schimba iconita
      }

    </script>

    <h2 class="font-weight-light font-italic">Descriere</h2>
    <?php the_content(); ?>
    <h2 class="font-weight-light font-italic">Durata</h2><?php runtime(
        $runtime
    ); ?>
  <div class='btn bg-dark' id='detalii'>
						<a href="<?php echo get_permalink(); ?>" class="text-light">Mai multe detalii</a></div>  <?php  ?></br><h2 class="font-weight-light font-italic">Genuri</h2>
    <?php echo get_the_term_list($post->ID, 'dn_genres', '', ', ', ''); ?>
    
    <!-- Note that several DIVs arent closed in case you want to add something inside the film's container that doesn't show on every page where loop-movies is included -->

					
