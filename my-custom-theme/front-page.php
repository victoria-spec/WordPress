<?php get_header(); ?> <!-- Loads the header.php file -->

<div class="content-wrapper">
    <h1>Welcome to the Project</h1>
    <p>This template allows you to track projects. User can add project date, description, start and end date.</p>

    <h2>Latest Project</h2>
    <?php
    // Query for the latest single project post
    $latest = new WP_Query(array('post_type' => 'project', 'posts_per_page' => 1));
    if ($latest->have_posts()) : while ($latest->have_posts()) : $latest->the_post(); ?>
        <div class="card">
            <h3><?php the_title(); ?></h3> <!-- Project title -->
            <p><?php echo esc_html(get_post_meta(get_the_ID(), 'project_description', true)); ?></p> <!-- Project description from custom field -->
            <p><strong>Start:</strong> <?php echo esc_html(get_post_meta(get_the_ID(), 'project_start_date', true)); ?></p> <!-- Start date -->
            <p><strong>End:</strong> <?php echo esc_html(get_post_meta(get_the_ID(), 'project_end_date', true)); ?></p> <!-- End date -->
            <a class="btn" href="<?php the_permalink(); ?>">View Details</a> <!-- Link to project details -->
        </div>
    <?php endwhile; wp_reset_postdata(); else : ?>
        <p>No projects yet.</p> <!-- Message if no projects found -->
    <?php endif; ?>

    <h2>All Projects</h2>
    <div class="project-grid">
        <?php
        // Query for the latest 6 projects
        $projects = new WP_Query(array('post_type' => 'project', 'posts_per_page' => 6));
        if ($projects->have_posts()) : while ($projects->have_posts()) : $projects->the_post(); ?>
            <div class="card">
                <h3><?php the_title(); ?></h3> <!-- Project title -->
                <p><strong>Start:</strong> <?php echo esc_html(get_post_meta(get_the_ID(), 'project_start_date', true)); ?></p> <!-- Start date -->
                <p><strong>End:</strong> <?php echo esc_html(get_post_meta(get_the_ID(), 'project_end_date', true)); ?></p> <!-- End date -->
                <a class="btn" href="<?php the_permalink(); ?>">Read More</a> <!-- Link to full project -->
            </div>
        <?php endwhile; wp_reset_postdata(); endif; ?>
    </div>

    <p style="text-align:center; margin-top:20px;">
        <a class="btn" href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>">See All Blogs</a> <!-- Link to blog listing -->
    </p>
</div>

<?php get_footer(); ?> <!-- Loads the footer.php file -->
