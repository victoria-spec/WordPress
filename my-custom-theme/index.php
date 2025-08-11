<?php get_header(); ?> <!-- Load the header.php file -->

<div class="content-wrapper">
    <h1>Blog & Projects</h1>

    <?php
    // Query arguments: get both blog posts and projects
    $args = array(
        'post_type'      => array('post', 'project'), // Include both regular posts and 'project' CPT
        'posts_per_page' => -1, // Show all results (no pagination)
        'orderby'        => 'date', // Sort by date
        'order'          => 'DESC', // Newest first
    );

    // Create new WP_Query with the above arguments
    $query = new WP_Query($args);

    // Check if there are any results
    if ($query->have_posts()) :
    ?>
        <div class="card-grid">
            <?php while ($query->have_posts()) : $query->the_post(); ?> <!-- Loop through each post/project -->
                <div class="card">
                    <?php if (has_post_thumbnail()) : ?> <!-- Check if featured image exists -->
                        <a href="<?php the_permalink(); ?>"> <!-- Link to single post/project -->
                            <?php the_post_thumbnail('medium', ['style' => 'width:100%; border-radius:8px;']); ?> <!-- Display featured image -->
                        </a>
                    <?php endif; ?>

                    <!-- Display the title as a clickable link -->
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

                    <?php if (get_post_type() === 'project') : ?> <!-- If this item is a Project -->
                        <p><strong>Start Date:</strong> <?php echo esc_html(get_post_meta(get_the_ID(), '_project_start_date', true)); ?></p>
                        <p><strong>End Date:</strong> <?php echo esc_html(get_post_meta(get_the_ID(), '_project_end_date', true)); ?></p>
                        <p><?php echo esc_html(get_post_meta(get_the_ID(), '_project_description', true)); ?></p>
                        <a href="<?php echo esc_url(get_post_meta(get_the_ID(), '_project_url', true)); ?>" target="_blank" class="button">View Project</a>
                    <?php else : ?> <!-- If this item is a Blog Post -->
                        <p><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p> <!-- Shortened excerpt -->
                        <a href="<?php the_permalink(); ?>" class="button">Read More</a>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        </div>
    <?php
        wp_reset_postdata(); // Reset post data after custom query
    else :
        echo '<p>No posts or projects found.</p>'; // Message if no results
    endif;
    ?>
</div>

<?php get_footer(); ?> <!-- Load the footer.php file -->
