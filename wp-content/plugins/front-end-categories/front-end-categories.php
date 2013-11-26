<?php
/*
Plugin Name: Front-end Taxonomies
Plugin URI: http://hackunito.it
Description: A WordPress plugin to add creation of hierarchial taxonomy to the front-end.
Author: Stefano Colarelli at #hackUniTO, Jack McConnell at Voltronik
Author URI: http://riqua.eu
Version: 0.2
*/

/******************************
* Global Variables
******************************/

$fec_prefix = 'fet_';
$fec_plugin_name = 'Front-end Taxonomies';


/******************************
* Functions
******************************/

#riqua aggiungi lingua ###################

// Create category on front-end
function fec_cat_create() {

	// Output HTML
	ob_start(); ?>
		<form action="" method="post">
			<label><?php __('Area of interest', fet); ?></label>
			<input type="text" name="newcat" value="">
			<input type="submit" name="submit-cat" value="Submit">
		</form><br />
	<?php
	echo ob_get_clean();
 

	// Create new category
	if(isset($_POST['submit-cat'])) {
		//#riqua $cat_ID = get_cat_ID( $_POST['newcat'] );   
		$cat_ID = get_term_by( 'name', $_POST['newcat'], 'area-of-interest' );		

		if($cat_ID == 0) {  
			$cat_name = $_POST['newcat'];  
			$parentCatID = 0;
			$arg = array('description' => $cat_name, 'parent' => $parentCatID);
			$new_cat_ID = wp_insert_term($cat_name, "area-of-interest", $arg);
			//#riqua $new_cat_ID = wp_insert_term($cat_name, "category", $arg);
			
			echo '<span class="fec-cat-added">'.__('Area added successfully', fet).'</span><br />';
		}

		else {
			echo '<span class="fec-error">That category already exists!</span><br />';
		}

	}

}

// Shortcode for creating category
add_shortcode('front-end-cat', 'fec_cat_create');


// Create sub-category on front-end
function fec_subcat_create() {

	// Output HTML
	ob_start(); ?>
		<form action="" method="post">
			<label>Sub-category name:</label>
			<input type="text" name="newsubcat" value="" /><br />

			<label>Add sub-category to which parent category?</label>
		    <?php 
			//#riqua wp_dropdown_categories(array('hide_empty' => 0, 'name' => 'cat-parent' , 'orderby ' => 'id' , 'order' => 'DESC' , 'hierarchical' => true , 'show_option_none' => '-')) ;
			wp_dropdown_categories(array('taxonomy' => 'area-of-interest', 'hide_empty' => 0, 'name' => 'cat-parent' , 'orderby ' => 'id' , 'order' => 'DESC' , 'hierarchical' => true , 'show_option_none' => '-')) ;
			?>
			<input type="submit" name="submit-subcat" value="Submit">
		</form>
	<?php
	echo ob_get_clean();


	// Create new sub-category
	if(isset($_POST['submit-subcat'])) {

		if(!empty($_REQUEST['newsubcat'])) {
			//#riqua $cat_ID = get_cat_ID( $_POST['newsubcat'] ); 
			$cat_ID = get_term_by( 'name', $_POST['newsubcat'], 'area-of-interest' );		
				
				if($cat_ID == 0) {  
					$subcat_name = $_POST['newsubcat'];  
					$parentCatID = $_POST['cat-parent'];
					$arg = array('description' => $subcat_name, 'parent' => $parentCatID);
					//#riqua $new_subcat_ID = wp_insert_term($subcat_name, "category", $arg);
					$new_subcat_ID = wp_insert_term($subcat_name, "area-of-interest", $arg);

					echo '<span class="fec-subcat-added">'.__('Area added successfully', fet).'</span><br />';
				}  

				else {
					echo '<span class="fec-error">That sub-category already exists!</span><br />';
				}
		}
	}

}

// Shortcode for creating sub-category
add_shortcode('front-end-subcat', 'fec_subcat_create');