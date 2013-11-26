<?php

if (class_exists( 'BP_Group_Extension' ) ){
if ( !class_exists( 'Idea_Progetto_Group_Extension' ) ) :

	class Idea_Progetto_Group_Extension extends BP_Group_Extension {
    function __construct() {
		global $bp;
        $args = array(
            // need localization (English version default)
            'slug' => 'campo-idea-progetto',
            'name' => 'Campo Idea progetto',
            'nav_item_position' => 5,
            'screens' => array(
                'edit' => array(
                    'name' => 'Campo idea progetto',
                    // The submit button
                    'submit_text' => 'Test',
                ),
                'create' => array(
                    'position' => 5,
                ),
            ),
        );
        parent::init( $args );
    }
 
    function display() {
        echo 'Per ora non inseriamo nulla, tanto sarà fatta la scheda';
    }
 
    function settings_screen( $group_id ) {
        $setting = groups_get_groupmeta( $group_id, 'idea_progetto_group_extension_setting' );
        $setting2 = groups_get_groupmeta( $group_id, 'idea_progetto_group_extension_setting2' );
 
        ?>
        Salva la descrizione 1: <input type="text" name="idea_progetto_group_extension_setting" value="<?php echo esc_attr( $setting ); ?>" />
        Salva descrizione 2: <input type="text" name="idea_progetto_group_extension_setting2" value="<?php echo esc_attr( $setting2 ); ?>" />
        <?php
    }
 
    function settings_screen_save( $group_id ) {
        $setting = isset( $_POST['idea_progetto_group_extension_setting'] ) ? $_POST['idea_progetto_group_extension_setting'] : '';
        groups_update_groupmeta( $group_id, 'idea_progetto_group_extension_setting', $setting );
		
		$setting2 = isset( $_POST['idea_progetto_group_extension_setting2'] ) ? $_POST['idea_progetto_group_extension_setting2'] : '';
        groups_update_groupmeta( $group_id, 'idea_progetto_group_extension_setting2', $setting2 );
    }
 
    /**
     * create_screen() is an optional method that, when present, will
     * be used instead of settings_screen() in the context of group
     * creation.
     *
     * Similar overrides exist via the following methods:
     *   * create_screen_save()
     *   * edit_screen()
     *   * edit_screen_save()
     *   * admin_screen()
     *   * admin_screen_save()
     */
    // function create_screen_save( $group_id ) {
    function create_screen( $group_id ) {
        $setting = groups_get_groupmeta( $group_id, 'idea_progetto_group_extension_setting' );
		$setting2 = groups_get_groupmeta( $group_id, 'idea_progetto_group_extension_setting2' );
 
        ?>Titolo e descrizione campo 1: <textarea rows="4" cols="50" name="idea_progetto_group_extension_setting" value="<?php echo esc_attr( $setting ) ?>"><?php echo esc_attr( $setting ) ?></textarea>
        <br />
		Titolo e descrizione campo 2: <input type="text" name="idea_progetto_group_extension_setting2" value="<?php echo esc_attr( $setting2 ) ?>" />
        <?php
    }
 
}
bp_register_group_extension( 'Idea_Progetto_Group_Extension' );
 
endif;

if ( !class_exists( 'Impatto_Progetto_Group_Extension' ) ) :

	class Impatto_Progetto_Group_Extension extends BP_Group_Extension {
    function __construct() {
		global $bp;
        $args = array(
            'slug' => 'campo-impatto-progetto',
            'name' => 'Campo Impatto progetto',
            'nav_item_position' => 6,
			'visibility' => 'private', // questo serve per i campi che devono essere visibili solo all'admin
            'screens' => array(
                'edit' => array(
                    'name' => 'Campo idea progetto',
                    // Changes the text of the Submit button
                    // on the Edit page
                    'submit_text' => 'Test',
                ),
                'create' => array(
                    'position' => 6,
                ),
            ),
        );
        parent::init( $args );
    }
 
    function display() {
        echo 'Idem qui: per ora non inseriamo nulla, tanto sarà fatta una scheda, non so a quanti tab';
    }
 
    function settings_screen( $group_id ) {
			$group_id = bp_get_current_group_id();
        $setting = groups_get_groupmeta( $group_id, 'impatto_progetto_group_extension_setting' );
 
        ?>
        Salva campi 3: <input type="text" name="impatto_progetto_group_extension_setting" value="<?php echo esc_attr( $setting ) ?>" />
        <?php
    }
 
    function settings_screen_save( $group_id ) {
			$group_id = bp_get_current_group_id();
        $setting = isset( $_POST['impatto_progetto_group_extension_setting'] ) ? $_POST['impatto_progetto_group_extension_setting'] : '';
        groups_update_groupmeta( $group_id, 'impatto_progetto_group_extension_setting', $setting );
    }
 
    /**
     * create_screen() is an optional method that, when present, will
     * be used instead of settings_screen() in the context of group
     * creation.
     *
     * Similar overrides exist via the following methods:
     *   * create_screen_save()
     *   * edit_screen()
     *   * edit_screen_save()
     *   * admin_screen()
     *   * admin_screen_save()
     */
    function create_screen( $group_id ) {
        $setting = groups_get_groupmeta( $group_id, 'impatto_progetto_group_extension_setting' );
 
        ?>Titolo e descrizione del campo 3 : <input type="text" name="impatto_progetto_group_extension_setting" value="<?php echo esc_attr( $setting ) ?>" />
        <?php
    }
 
}
bp_register_group_extension( 'Impatto_Progetto_Group_Extension' );
 
endif;

if ( !class_exists( 'Need_Group_Extension' ) ) :

	class Need_Group_Extension extends BP_Group_Extension {
    function __construct() {
		//global $bp;
        $args = array(
            'slug' => 'campo-need',
            'name' => 'Campo Need',
            'nav_item_position' => 8,
            'screens' => array(
                'edit' => array(
                    'name' => 'Campo Need',
                    // Changes the text of the Submit button
                    // on the Edit page
                    'submit_text' => 'Test',
                ),
                'create' => array(
                    'position' => 8,
                ),
            ),
        );
        parent::init( $args );
    }
 
    function display() {
        echo 'Idem qui: per ora non inseriamo nulla, tanto sarà fatta una scheda, non so a quanti tab';
    }
 
    function settings_screen( $group_id ) {
		$group_id = bp_get_current_group_id();
        $setting = groups_get_groupmeta( $group_id, 'need_group_extension_setting' );
        ?>
        Salva campi 3: <input type="text" name="need_group_extension_setting" value="<?php echo esc_attr( $setting ) ?>" />
        <?php
		$dump = create_fieldlist();
		$post_ID = groups_get_groupmeta( $group_id, $meta_key = 'post_node');
		$term_list = wp_get_post_terms($post_ID, 'need', array("fields" => "names"));
		$optionvalue = '<form name="competenze_form" action="" method="POST" enctype="multipart/form-data"><fieldset><legend>Competenze</legend><br>';
		foreach( $dump as $option ){
			$nome = $option->name;
			foreach( $term_list as $term ){
				if($term == $nome){$checked = 'checked="checked"';break;}
				else{$checked = '';}
			}
			// $nometag = str_replace(" ","-",$nome); versione php
			$nometag = sanitize_title($nome); // versione Wp
			$optionvalue .= '<input type="checkbox" name="competenze[]" value="'.strtolower($nometag).'" '.$checked.'/> '.$nome.'<br />';
			//$optionvalue .= '<input type="checkbox" name="'.$nome.'" value="'.strtolower($nometag).'" '.$checked.'/> '.$nome.'<br />';
		}
		$optionvalue .= '</fieldset><input type="submit" name="submit-competenze" value="Invia"></form>';
		echo $optionvalue;
		if(isset($_POST['submit-competenze'])) {
			$projectneed = ( $_POST['competenze'] ); 
			var_dump($projectneed);    
				foreach($_POST['competenze'] as $value){
				  echo $value;
				}
			//$termini get_term_by('slug', $projectneed, 'need')
			//var_dump($termini);
			//$idObj = get_category_by_slug('category-name'); 
			//$id = $idObj->term_id;
//			$cat_ID = get_cat_ID( $_POST['competenze'] );    

/* 			if($cat_ID == 0) {  
				$cat_name = $_POST['newcat'];  
				$parentCatID = 0;
				$arg = array('description' => $cat_name, 'parent' => $parentCatID);
				$new_cat_ID = wp_insert_term($cat_name, "category", $arg);
				
				echo '<span class="fec-cat-added">Category Added</span><br />';
			}

			else {
				echo '<span class="fec-error">That category already exists!</span><br />';
			} */
			$prova = wp_set_post_terms( $post_ID, $projectneed, 'need' ); // sovrascrive le attuali impostazioni
			var_dump($prova);
		}
    }
 
    function settings_screen_save( $group_id ) {
        $setting = isset( $_POST['need_group_extension_setting'] ) ? $_POST['need_group_extension_setting'] : '';
        groups_update_groupmeta( $group_id, 'need_group_extension_setting', $setting );
    }
 
}
bp_register_group_extension( 'Need_Group_Extension' );
 
endif;

if ( !class_exists( 'Ambiti_Group_Extension' ) ) :

	class Ambiti_Group_Extension extends BP_Group_Extension {
    function __construct() {
		//global $bp;
        $args = array(
            'slug' => 'campo-ambiti',
            'name' => 'Campo Ambiti',
            'nav_item_position' => 7,
            'screens' => array(
                'edit' => array(
                    'name' => 'Campo Ambiti',
                    // Changes the text of the Submit button
                    // on the Edit page
                    'submit_text' => 'Test',
                ),
                'create' => array(
                    'position' => 7,
                ),
            ),
        );
        parent::init( $args );
    }
 
    function display() {
        echo 'Idem qui: per ora non inseriamo nulla, tanto sarà fatta una scheda, non so a quanti tab';
    }
 
    function settings_screen() {
		echo do_shortcode('[front-end-subcat]');
    }
 
    function settings_screen_save( $group_id ) {
        $setting = isset( $_POST['ambiti_group_extension_setting'] ) ? $_POST['ambiti_group_extension_setting'] : '';
        groups_update_groupmeta( $group_id, 'ambiti_group_extension_setting', $setting );
    }
 
}
bp_register_group_extension( 'Ambiti_Group_Extension' );
 
endif;

function create_fieldlist( ){
	global $bp;
	$field = new BP_XProfile_Field( 2 );
	$dump = $field->get_children();	
	return $dump;
	}
	
/*	
function create_fieldlist( $group_id ){
	global $bp;
	$field = new BP_XProfile_Field( 2 );
	$dump = $field->get_children();	
	//Returns Array of Term ID's for "need"
	$post_ID = groups_get_groupmeta( $group_id, $meta_key = 'post_node');
	$term_list = wp_get_post_terms($post_ID, 'need', array("fields" => "slug"));
	$optionvalue = '<form action=""><fieldset><legend>Competenze</legend><br>';
	foreach( $dump as $option ){
		$nome = $option->name;
		// $nometag = str_replace(" ","-",$nome); versione php
		$nometag = sanitize_title($nome); // versione Wp
		$optionvalue .= '<input type="checkbox" name="'.$nome.'" value="'.strtolower($nometag).'" /> '.$nome.'<br />';
	}
	$optionvalue .= '</fieldset></form>';
	$optionvalue .= $post_ID.' oppure '.$group_id;
	print_r($term_list);
	echo $optionvalue;
	//wp_set_post_terms( $post_id, $terms, 'need', 'false' ); // sovrascrive le attuali impostazioni
}
*/

function create_group_node ( $group_id ) {
	global $bp;
			
	$group = groups_get_group( array( 'group_id' => $group_id ) );
	// controllo, di fatto, se il gruppo non è stato già creato (ex facendo step back nel processo di creazione)
	$groupmeta = groups_get_groupmeta( $group_id, $meta_key = 'post_node');

	// Insert or edit the post into the database and get the id for update_groupmeta field
	if (!$groupmeta):
		$my_post = array(
			'post_title'    => $group->name,
			'post_content'  => $group->description,
			'post_status'   => 'publish',
			'post_author'   => $group->creator_id,
			'post_type' => 'project',
			//'post_category' => array(8,39)
		);
		$post_ID = wp_insert_post( $my_post );
	else:
		$my_post = array(
			'ID' => $groupmeta,
			'post_title'    => $group->name,
			'post_content'  => $group->description,
		);
		$post_ID = wp_update_post( $my_post );
	endif;
	
	//add post id to groupmeta
    groups_update_groupmeta( $group_id, 'post_node', $post_ID );
	//add group id to postmeta; underscore hide the postmeta in editor
	add_post_meta( $post_ID, '_group_node', $group_id, true ) || update_post_meta( $post_ID, '_group_node', $group_id );
}

// fired quando il post è completamente finito add_action( 'groups_group_create_complete',  'create_group_node' );
add_action( 'groups_created_group',  'create_group_node' );

}

 
/* Se troviamo codice alternativo a Bp, possiamo metterlo qui sotto */

?>