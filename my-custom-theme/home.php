<?php get_header(); ?> <!-- Loads the header.php file -->

<div class="container">
    <h1>Blog</h1>
    <div class="blog-grid">
        <?php if (have_posts()) : // Check if there are any blog posts
            while (have_posts()) : the_post(); ?> <!-- Loop through posts -->
                <div class="card">
                    <?php if (has_post_thumbnail()) { // If post has a featured image
                        the_post_thumbnail('medium', ['style' => 'width:100%;border-radius:5px;']); // Display thumbnail with custom style
                    } ?>
                    <h3><?php the_title(); ?></h3> <!-- Post title -->
                    <p><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p> <!-- Post excerpt limited to 20 words -->
                    <a href="<?php the_permalink(); ?>">Read More</a> <!-- Link to full post -->
                </div>
            <?php endwhile;
        else :
            echo '<p>No blog posts found.</p>'; // Message if no posts
        endif; ?>
    </div>
</div>

<?php get_footer(); ?> <!-- Loads the footer.php file -->
