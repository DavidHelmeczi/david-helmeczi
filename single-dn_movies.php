<?php 

//comentarii detailate in template-parts/loop-movies.php

get_header();
if (have_posts()) {
    while (have_posts()) {
        the_post();
        $runtime = get_field('runtime'); ?>
        <div class="page" id="page-<?php the_ID(); ?>">
            <script>
                var pageId = '<?php echo the_ID(); ?>';
                if (getCookie("istoricCookie")) {
                    var istoric = JSON.parse(getCookie("istoricCookie")); //daca cookie-ul este deja setat il folosim in JS
                } else {
                    var istoric = []; //else il cream
                }
                if (!inArray(pageId, istoric)) {
                    istoric.unshift(pageId);  //daca filmul inca nu se afla in array-ul il adaugam la inceput
                } else {
                    const index = istoric.indexOf(pageId);
                    istoric.splice(index, 1);
                    istoric.unshift(pageId); //else il stergem si adaugam la inceput

                }
                setCookie("istoricCookie", JSON.stringify(istoric)); //salvam cookie-ul
            </script>
            <style>
                .form-control::-webkit-input-placeholder {
                    color: red;
                }
            </style>
            <div class="row border">
                <div class="col-lg-4 col-md-6">
                    <div class="featured-image">
                        <?php if (has_post_thumbnail()) {
            the_post_thumbnail();
        } else {
            ?><img src='https://popcornusa.s3.amazonaws.com/placeholder-movieimage.png' class="img-thumbnail img-fluid" style="width:300px"><?php
        } ?></div>
                </div>
                <div class="col-lg-8 col-md-6 bg-light order-first order-md-last">

                    <h1 class="text-danger font-weight-light"><?php
                    the_title();
                    echo get_the_term_list($post->ID,'dn_years',' ',', ',''); ?>
                    <i id="heart-<?php echo the_ID(); ?>" onclick="classToggle(this)" class="fa-heart ml-4 far" data-toggle="tooltip" data-placement="right" title="Adauga la favorite"></i></h1>
                    <script>
                        var element = document.getElementById("heart-<?php echo the_ID(); ?>");
                        if (favorite.includes(pageId) && element.classList.contains("fas") != "true") {
                            element.classList.toggle('fas');
                        }
                    </script>

                    <h2 class="font-weight-light font-italic">Descriere</h2>
                    <?php the_content(); ?>

                    <h2 class="font-weight-light font-italic">Durata</h2><?php runtime(
                        $runtime
                    ); ?>
                    </br>

                    <h2 class="font-weight-light font-italic">Genuri</h2>
                    <?php echo get_the_term_list($post->ID,'dn_genres','',', ',''); ?>
                    </br>

                    <h2 class="font-weight-light font-italic">Genuri</h2>
                    <?php echo get_the_term_list($post->ID,'dn_genres','',', ',''); ?>
                    </br>

                    <div id="extradetalii">

                        <h2 class="font-weight-light font-italic">Director</h2>
                        <?php
                        $connected = new WP_Query([
                            'relationship' => [
                                'id' => 'movies_to_directors',
                                'from' => get_the_ID()
                            ],
                            'nopaging' => true
                        ]);

                        while ($connected->have_posts()):
                                            $connected->the_post();
                        if (get_the_title() != 'N/A') { ?>
                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></br>
                                            <?php } else {
                            the_title(); ?> </br> <?php
                        }
                        endwhile;
                        wp_reset_postdata(); ?>
                        <h2 class="font-weight-light font-italic">Actori</h2>
                        <?php
                        $connected = new WP_Query([
                            'relationship' => [
                                'id' => 'movies_to_actors',
                                'from' => get_the_ID()
                            ],
                            'nopaging' => true
                        ]);

        while ($connected->have_posts()):
                            $connected->the_post(); ?>
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></br>
                        <?php
                        endwhile;
        wp_reset_postdata(); ?>
                    </div>
                </div>
            </div>
        </div>

<?php
    }
}
?>

<div class="alert alert-success d-none mt-4" role="alert" id="confirmare">
    <h4 class="alert-heading">Succes!</h4>
    <p>Mesajul a fost trimis cu succes</p>
</div>  <!-- mesaj de confirmare -->


<form id="formular" class="">
    <div class="form-group">
        <label for="Nume">Nume</label>
        <input type="text" class="form-control" value="" aria-label="Username" id="Nume" aria-describedby="basic-addon1">
    </div>
    <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" value=" ">
        <small id="emailHelp" class="form-text text-muted">Introduceti o adresa existenta</small>
    </div>
    <div class="form-group">
        <label for="mesaj">Mesaj</label>
        <textarea class="form-control" id="mesaj" rows="3" value=""></textarea>
    </div>
    <button id="submitform" type="submit" class="btn btn-primary">Submit</button>
</form>

<script>
    var inputNume = document.getElementById("Nume");
    var inputEmail = document.getElementById("email");
    var inputMesaj = document.getElementById("mesaj");
    var confirmare = document.getElementById("confirmare");
    var formular = document.getElementById("formular");

    if (localStorage.getItem("nume")) {
        inputNume.value = localStorage.getItem("nume");  //daca utilizatorul si-a mai folosit numele pe site we auto-complete it
    }
    if (localStorage.getItem("email")) {
        inputEmail.value = localStorage.getItem("email"); //same with e-mail address
    }

    $("#submitform").click(function(e) {
        e.preventDefault();
        if (inputNume.value == "") {
            inputNume.placeholder = "Va rugam introduceti numele!"; 
        }

        if (!isValidEmailAddress(inputEmail.value) == true) {
            inputEmail.value = "";
            inputEmail.placeholder = "Adresa e-mail incorect!";

        }

        if (inputMesaj.value == "") {
            inputMesaj.placeholder = "Va rugam introduceti mesajul!";

        }

        if (inputNume.value != "" && isValidEmailAddress(inputEmail.value) == true && inputMesaj.value != "") {
            $('#submitform').prop('disabled', true);
            $('#email').prop('disabled', true);
            $('#mesaj').prop('disabled', true);
            $('#Nume').prop('disabled', true); //disable all inputs and buttons to prevent errors during ajax request
            localStorage.setItem("email", inputEmail.value); //salvam adresa de email for later use
            localStorage.setItem("nume", inputNume.value); // same here
            jQuery.ajax({
                type: "post",
                url: myAjax.ajaxurl,
                data: {
                    'action': 'trimitere_formular',
                    'nume': inputNume.value,
                    'email': inputEmail.value,
                    'mesaj': inputMesaj.value
                },
                success: function() {
                    confirmare.classList.remove('d-none'); //afisam mesajul de confirmare
                    formular.classList.add('d-none'); //ascundem formularul
                }

            })

        }
    });
</script>
<?php get_footer(); ?>
