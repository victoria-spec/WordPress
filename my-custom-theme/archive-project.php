<?php get_header(); ?>
<!-- Loads the header.php template file from the theme -->
<div class="container">
    <h1>Projects</h1>

    <!-- Filter Form -->
    <form method="get" action="<?php echo esc_url(get_post_type_archive_link('project')); ?>" class="project-filter-form">
        <label for="start_date">Start Date:</label>
        <input type="date" name="start_date" id="start_date" value="<?php echo isset($_GET['start_date']) ? esc_attr($_GET['start_date']) : ''; ?>">

        <label for="end_date">End Date:</label>
        <input type="date" name="end_date" id="end_date" value="<?php echo isset($_GET['end_date']) ? esc_attr($_GET['end_date']) : ''; ?>">

        <button type="submit">Filter</button>
    </form>

    <div class="project-grid">
        <?php
        // Filter logic
        // Prepare the meta_query array to store custom field filtering rules
        $meta_query = [];
        // If the user entered a start date, filter projects that start ON or AFTER that date    
        if (!empty($_GET['start_date'])) {
            $meta_query[] = [
                'key' => 'project_start_date',// Custom field name
                'value' => sanitize_text_field($_GET['start_date']),// User input, sanitized
                'compare' => '>=',// Greater than or equal to
                'type' => 'DATE' // Compare as date
            ];
        }
        // If the user entered an end date, filter projects that end ON or BEFORE that date    
        if (!empty($_GET['end_date'])) {
            $meta_query[] = [
                'key' => 'project_end_date', // Custom field name
                'value' => sanitize_text_field($_GET['end_date']),// User input, sanitized
                'compare' => '<=',// Less than or equal to
                'type' => 'DATE'// Compare as date
            ];
        }

     
     // Query arguments for WP_Query
        $args = [
            'post_type' => 'project',
            'posts_per_page' => 10,
            'orderby' => 'date',
            'order' => 'DESC',
            'meta_query' => $meta_query
        ];
        // Create a new query based on the arguments
        $projects_query = new WP_Query($args);
         // If there are matching projects

        if ($projects_query->have_posts()) :
            while ($projects_query->have_posts()) : $projects_query->the_post();
                // Get the custom start and end dates for this project
                $start_date = esc_html(get_post_meta(get_the_ID(), 'project_start_date', true));
                $end_date = esc_html(get_post_meta(get_the_ID(), 'project_end_date', true));
                ?>
                <!-- Project Card -->
                <div class="project-card">
                    <h3><?php the_title(); ?></h3>
                    <p><strong>Start:</strong> <?php echo $start_date; ?></p>
                    <p><strong>End:</strong> <?php echo $end_date; ?></p>
                    <a href="<?php the_permalink(); ?>">View Details</a><!-- Link to project page -->
                </div>
            <?php endwhile;
            wp_reset_postdata();// Reset the query to the default
        else : // Message if no projects match the filter
            echo '<p>No projects found matching your criteria.</p>';
        endif;
        ?>
    </div>
</div>

<?php get_footer(); ?>
