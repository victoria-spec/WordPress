<?php get_header(); // Load site header ?>

<div class="container">
    <?php
    if (have_posts()) : // Check if there are posts/projects
        while (have_posts()) : the_post(); // Start loop

            // Retrieve custom meta fields
            $start_date  = esc_html(get_post_meta(get_the_ID(), 'project_start_date', true));
            $end_date    = esc_html(get_post_meta(get_the_ID(), 'project_end_date', true));
            $description = esc_html(get_post_meta(get_the_ID(), 'project_description', true));
            $url         = esc_url(get_post_meta(get_the_ID(), 'project_url', true));
            ?>
            
            <article>
                <h1><?php the_title(); ?></h1>
                <p><strong>Start Date:</strong> <?php echo $start_date; ?></p>
                <p><strong>End Date:</strong> <?php echo $end_date; ?></p>
                <p><?php echo $description; ?></p>

                <?php if ($url) : ?>
                    <p><a href="<?php echo $url; ?>" target="_blank">Visit Project</a></p>
                <?php endif; ?>
            </article>

        <?php endwhile; // End loop
    endif; ?>
</div>

<?php get_footer(); // Load site footer ?>
