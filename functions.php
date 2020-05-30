<?php function my_scripts()
{
    wp_enqueue_style(
        'bootstrap',
        get_stylesheet_directory_uri() .
            '/inc/scripts/bootstrap/css/bootstrap.css',
        '',
        1.4
    );
    wp_enqueue_script(
        'bootstrapjs',
        get_stylesheet_directory_uri() .
            '/inc/scripts/bootstrap/js/bootstrap.bundle.js',
        array('jquery'),
        '',
        false
    );
    wp_enqueue_script(
        'script',
        get_stylesheet_directory_uri() . '/inc/scripts/script.js',
        array('jquery'),
        '',
        false
    );
    wp_enqueue_script(
        'jQuery',
        get_stylesheet_directory_uri() . '/inc/scripts/jquery-3.5.1.js',
        array('jquery'),
        '',
        false
    );
    wp_enqueue_script(
        'fontawersome',
        'https://kit.fontawesome.com/5955dccd8b.js',
        array('jquery'),
        '',
        false
    );
    wp_enqueue_style(
        'stylesheet',
        get_stylesheet_directory_uri() . '/style.css',
        '',
        1.4
    );
    wp_register_script(
        "ajax",
        get_stylesheet_directory_uri() . '/inc/scripts/ajax.js',
        array('jquery', 'wp-util')
    );
    wp_enqueue_script('ajax');
    wp_localize_script('ajax', 'myAjax', array(
        'ajaxurl' => admin_url('admin-ajax.php')
    ));
}
add_action('wp_enqueue_scripts', 'my_scripts');
add_action('wp_ajax_nopriv_display_fav_movies', 'display_fav_movies_callback');
add_action('wp_ajax_display_fav_movies', 'display_fav_movies_callback');
add_action('wp_ajax_nopriv_display_istoric_movies','display_istoric_movies_callback');
add_action('wp_ajax_display_istoric_movies', 'display_istoric_movies_callback');
add_action('wp_ajax_nopriv_trimitere_formular', 'trimitere_formular_callback');
add_action('wp_ajax_trimitere_formular', 'trimitere_formular_callback');
add_action('widgets_init', 'register_widget_areas');
add_action('after_setup_theme', 'register_navwalker');

function register_navwalker(){
	require_once get_template_directory() . '/inc/scripts/navwalker.php';
}


function __search_by_title_only( $search, $wp_query )
{
    global $wpdb;
    if(empty($search)) {
        return $search; // skip processing - no search term in query
    }
    $q = $wp_query->query_vars;
    $n = !empty($q['exact']) ? '' : '%';
    $search =
    $searchand = '';
    foreach ((array)$q['search_terms'] as $term) {
        $term = esc_sql($wpdb->esc_like($term));
        $search .= "{$searchand}($wpdb->posts.post_title LIKE '{$n}{$term}{$n}')";
        $searchand = ' AND ';
    }
    if (!empty($search)) {
        $search = " AND ({$search}) ";
        if (!is_user_logged_in())
            $search .= " AND ($wpdb->posts.post_password = '') ";
    }
    return $search;
}
add_filter('posts_search', '__search_by_title_only', 500, 2);   //make Wp search posts only by title

function trimitere_formular_callback()
{
    $nume = $_POST['nume'];
    $email = $_POST['email'];
    $mesaj = $_POST['mesaj'];
    mail(
        $email,
        "Confirmare",
        "Mesajul $mesaj trimis cu succes",
        "From: administrator@email.com"
    ); //email pentru utilizator

    mail(
        "administrator@email.com",
        "Test",
        "Ati primit un mesaj de la $nume"
    ); //complete email address and other details pentru admin

    wp_die();
}

function display_fav_movies_callback()
{
    $lista_id = json_decode(wp_unslash($_POST['id_favorite']));
    if (!$lista_id) {
        echo '<h3 class="alert alert-danger">No posts were found</h3>';
        wp_die();
    }

    $query = new WP_Query(array(
        'post__in' => $lista_id,
        'post_type' => 'dn_movies',
        'orderby' => 'post__in'
    ));
    if (!$query->have_posts()) {
        echo '<h3 class="alert alert-danger">No posts were found</h3>';
    } else {
        while ($query->have_posts()) {
            $query->the_post();
            $response .= include "template-parts/loop-movies.php";
            echo "</div></div>";
        }
    }

    wp_die();
}

function display_istoric_movies_callback()
{
    $lista_id = json_decode(wp_unslash($_POST['id_istoric']));
    if (!$lista_id) {
        echo '<h3 class="alert alert-danger">No posts were found</h3>';
        wp_die();
    }

    $query = new WP_Query(array(
        'post__in' => $lista_id,
        'post_type' => 'dn_movies',
        'orderby' => 'post__in'
    ));
    if (!$query->have_posts()) {
        echo '<h3 class="alert alert-danger">No posts were found</h3>';
    } else {
        while ($query->have_posts()) {
            $query->the_post();
            $response .= include "template-parts/loop-movies.php";
            echo "</div></div>";
        }
    }

    wp_die();
}

function register_widget_areas()
{
    register_sidebar(array(
        'name' => 'Footer area',
        'id' => 'footer_area',
        'description' => 'This widget area discription',
        'before_widget' =>
            '<section class="footer-area col-lg-4 mb-4 footer-area-one">',
        'after_widget' => '</section>',
        'before_title' => '<h4>',
        'after_title' => '</h4>'
    ));
}


function wpb_custom_new_menu()
{
    register_nav_menu('header-menu', 'Menu location');
}
add_action('init', 'wpb_custom_new_menu');

add_theme_support('post-thumbnails');

function dn_custom_logo_setup()
{
    $defaults = array(
        'height' => 30,
        'width' => 25,
        'flex-height' => true,
        'flex-width' => true
    );
    add_theme_support('custom-logo', $defaults);
}
add_action('after_setup_theme', 'dn_custom_logo_setup');

register_post_type('dn_movies', array(
    'labels' => array(
        'name' => _x('Arhiva', 'post type general name')
    ),
    'public' => true,
    'has_archive' => true,
    'supports' => array(
        'title',
        'editor',
        'excerpt',
        'author',
        'thumbnail',
        'custom-fields',
        'revisions'
    ),
    'rewrite' => array('slug' => 'movie')
));

register_post_type('dn_actors', array(
    'labels' => array(
        'name' => _x('Actors', 'post type general name')
    ),
    'public' => true,
    'has_archive' => true,
    'rewrite' => array('slug' => 'actor')
));

register_post_type('dn_directors', array(
    'labels' => array(
        'name' => _x('Directors', 'post type general name')
    ),
    'public' => true,
    'has_archive' => true,
    'rewrite' => array('slug' => 'director')
));

register_taxonomy(
    'dn_genres',
    array('dn_movies', 'dn_actors', 'dn_directors'),
    array(
        'hierarchical' => true,
        'labels' => array(
            'name' => _x('Genres', 'taxonomy general name')
        ),
        'show_ui' => true,
        'has_archive' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'genuri')
    )
);

register_taxonomy('dn_years', 'dn_movies', array(
    'hierarchical' => true,
    'labels' => array(
        'name' => _x('Years', 'taxonomy general name')
    ),
    'show_ui' => true,
    'has_archive' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'year')
));

function runtime($runtime)
{
    $ore = 0;
    $minute = $runtime;
    while ($minute >= 60) {
        $ore++;
        $minute -= 60;
    }
    if ($ore > 1) {
        echo "$ore ore $minute minute"; //daca avem mai mult de 1 ora runtime scrie "ore" 
    } else {
        echo "$ore ora $minute minute";//else scrie "ora"
    }
}

function dn_pagination_bar()
{
    global $wp_query;

    $total_pages = $wp_query->max_num_pages;

    if ($total_pages > 1) {
        $current_page = max(1, get_query_var('paged'));
        $big = 999999999; // need an unlikely integer

        echo paginate_links(array(
            'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
            'format' => '&paged=%#%',
            'current' => $current_page,
            'total' => $total_pages,
            'after_page_number' => '&nbsp;',
            'before_page_number' => '&nbsp;'
        ));
    }
}

add_action('mb_relationships_init', function () {
    MB_Relationships_API::register([
        'id' => 'movies_to_actors',
        'from' => [
            'post_type' => 'dn_movies',
            'meta_box' => [
                'title' => 'Actors'
            ]
        ],
        'to' => [
            'post_type' => 'dn_actors',
            'meta_box' => [
                'title' => 'Movies'
            ]
        ]
    ]);

    MB_Relationships_API::register([
        'id' => 'movies_to_directors',
        'from' => [
            'post_type' => 'dn_movies',
            'meta_box' => [
                'title' => 'Directors'
            ]
        ],
        'to' => [
            'post_type' => 'dn_directors',
            'meta_box' => [
                'title' => 'Movies'
            ]
        ]
    ]);
});
function dn_archive_title($title) //functie care afiseaza frumos titlurile
{
    if (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_tag()) {
        $title = single_tag_title('', false);
    } elseif (is_author()) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif (is_post_type_archive()) {
        $title = post_type_archive_title('', false);
    } elseif (is_tax()) {
        $title = single_term_title('', false);
    }

    return $title;
}

add_filter('get_the_archive_title', 'dn_archive_title');
