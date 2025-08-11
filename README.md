# Custom WordPress Theme
This custom WordPress theme creates a combined blog and project portfolio website, allowing you to publish regular blog posts and showcase projects with dedicated details (start date, end date, description, and project link). It’s built from scratch following WordPress best practices, includes custom templates for displaying posts and projects, registers a custom post type for projects, styles the layout for a clean and responsive design, and provides a custom REST API endpoint to access project data programmatically.
## Features

* **Custom Post Type (CPT)** – project type with:
  * Start Date
  * End Date
  * Description
  * Project URL
* **Two Custom Page Templates**:
  
  * **Home** – Project highlights and intro.
  * **Blog & Projects** – Displays both blog posts and projects in a card grid.
* **Custom REST API Endpoint**:

  * GET /wp-json/simple-portfolio/v1/projects
* **Responsive Layout** – Works across desktop, tablet, and mobile.
* **Dynamic Navigation Menu** – Fully managed from WordPress dashboard.
* **Minimal, Clean Styles** – Easy to customize.

---

## File Structure

* **my-custom-theme/**:
   * functions.php         # Theme setup, CPT registration, custom fields, REST API
   * style.css             # Main stylesheet with theme header
   * header.php            # Global site header
   * footer.php            # Global site footer
   * index.php             # Default template
   * home.php              # Home page template
   * blog-projects.php     # Blog & Projects page template
   * single-project.php    # Single Project template
   * archive-project.php   # Projects archive template
 
## Installation
1. **Download or Clone** this repository:

bash
   git clone https://github.com/victoria-spec/WordPress
   
3. **Place in WordPress Themes Folder**:

   Move the theme folder to:   
   /wp-content/themes/
   
 3. **Activate the Theme**:

   * Go to **WordPress Admin → Appearance → Themes**.
   * Click **Activate** on this theme.

4. **Set Up Menus & Pages**:

   * Create **Home** and **Blog & Projects** pages.
   * Assign the correct templates from **Page Attributes**.
   * Set your menu under **Appearance → Menus**.

---

## Customization

* Edit **style.css** for color, fonts, and spacing.
* Modify **card-grid** styles in CSS to change layout.

