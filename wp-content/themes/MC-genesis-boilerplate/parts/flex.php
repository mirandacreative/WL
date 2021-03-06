<?php
// check if the flexible content field has rows of data
if (have_rows('main')):

    // loop through the rows of data
    while (have_rows('main')) : the_row();

        if (get_row_layout() == 'title_section'):
            get_template_part('parts/flexible/title-section');

        elseif (get_row_layout() == 'blurb_single'):
            get_template_part('parts/flexible/blurb-single');

        elseif (get_row_layout() == 'blurb_col'):
            get_template_part('parts/flexible/blurb-col');

        elseif (get_row_layout() == 'tile_cards'):
            get_template_part('parts/flexible/card-grid');

        elseif (get_row_layout() == 'event_blocks'):
            get_template_part('parts/flexible/event-blocks'); 

        elseif (get_row_layout() == 'color_buttons'):
            get_template_part('parts/flexible/color-buttons');

        elseif (get_row_layout() == 'pdf'):
            get_template_part('parts/flexible/pdf');  

        elseif (get_row_layout() == 'accordions'):
            get_template_part('parts/flexible/accordions'); 

        elseif (get_row_layout() == 'carousel'):
            get_template_part('parts/flexible/carousel');

        elseif (get_row_layout() == 'search'):
            get_template_part('parts/flexible/search');   
              
        elseif (get_row_layout() == 'director_cards'):
            get_template_part('parts/flexible/director-cards');

        elseif (get_row_layout() == 'programs'):
            get_template_part('parts/flexible/programs');

        elseif (get_row_layout() == 'three_col_list'):
            get_template_part('parts/flexible/three-col-list');

        elseif (get_row_layout() == 'people_cards'):
            get_template_part('parts/flexible/people-cards');      

        elseif (get_row_layout() == 'gallery'):
            get_template_part('parts/flexible/gallery');   

        elseif (get_row_layout() == 'resource'):
            get_template_part('parts/flexible/resource');

        elseif (get_row_layout() == 'lists'):
            get_template_part('parts/flexible/lists');                              

        endif;

    endwhile;

else :
    // no layouts found
 ?>
     <h1><?php the_title() ?></h1>
    <?php
endif;
?>