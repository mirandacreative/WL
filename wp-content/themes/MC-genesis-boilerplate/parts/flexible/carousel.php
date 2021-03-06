<?php
/*
Carousel Module  & Alert
*/
?>
<section id="carousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner" role="listbox">
        <?php
        $alert = get_field('slider_alert', 'option');
        if ($alert) {
            ?>
            <div class="alert">
                <i class="material-icons">warning</i> 
                <span class="message"><?= $alert; ?></span>
                <span id="hide-alert" class="close">
                    <i class="material-icons">close</i>
                </span>
            </div>
            <?php
        }
        ?>
        <?php if (have_rows('slider')):
            $count = 0;
            while (have_rows('slider')) : the_row();
                $count++;
                $url = get_sub_field('url');
                $image = get_sub_field('image');
                $headline = get_sub_field('image_headline');
                $status = '';
                if ($count == 1) {
                    $status = ' active';
                };
                ?>
                <div class="carousel-item <?= $status; ?>">
                    <a class="carulink" href="<?= $url; ?>">
                    <img class="d-block img-fluid" src="<?= $image; ?>" alt="first slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h3><?= $headline; ?></h3>
                    </div>
                    </a>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
        <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
</section>
<?php if(is_front_page() ){get_template_part('template-parts/hours_language_mobile'); } ?>