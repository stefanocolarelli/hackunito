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
        Salva la descrizione 1: <input type="text" name="idea_progetto_group_extension_setting" value="<?php echo esc_attr( $setting ) ?>" />
        Salva descrizione 2: <input type="text" name="idea_progetto_group_extension_setting2" value="<?php echo esc_attr( $setting2 ) ?>" />
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
    function create_screen_save( $group_id ) {
        $setting = groups_get_groupmeta( $group_id, 'idea_progetto_group_extension_setting' );
		$setting2 = groups_get_groupmeta( $group_id, 'idea_progetto_group_extension_setting2' );
 
        ?>Titolo e descrizione campo 1: <textarea rows="4" cols="50" name="idea_progetto_group_extension_setting" value="<?php echo esc_attr( $setting ) ?>"> <?php echo esc_attr( $setting ) ?> </textarea>
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
        $setting = groups_get_groupmeta( $group_id, 'impatto_progetto_group_extension_setting' );
 
        ?>
        Salva campi 3: <input type="text" name="impatto_progetto_group_extension_setting" value="<?php echo esc_attr( $setting ) ?>" />
        <?php
    }
 
    function settings_screen_save( $group_id ) {
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

}

 
/* Se troviamo codice alternativo a Bp, possiamo metterlo qui sotto */

?>