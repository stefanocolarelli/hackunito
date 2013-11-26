<?php
/*
Plugin Name: BP Profile Search
Plugin URI: http://www.dontdream.it/bp-profile-search/
Description: Search BuddyPress Members Directory.
Version: 3.5.2
Author: Andrea Tarantini
Author URI: http://www.dontdream.it/
*/

global $bps_globals;
$bps_globals = new stdClass;
$bps_globals->plugin = 'BP Profile Search';
$bps_globals->version = '3.5.2';

include 'bps-functions.php';

add_action ('plugins_loaded', 'bps_translate');
function bps_translate ()
{
	load_plugin_textdomain ('bps', false, basename (dirname (__FILE__)). '/languages');
}

register_activation_hook (__FILE__, 'bps_activate');
function bps_activate ()
{
	return true;
}

add_action ('init', 'bps_init');
function bps_init ()
{
	global $bps_options;

	$bps_options = bps_active_for_network ()? get_site_option ('bps_options'): get_option ('bps_options');
	if ($bps_options == false)
	{
		bps_init_form ();
	}	

	return true;
}

function bps_active_for_network ()
{
	include_once ABSPATH. '/wp-admin/includes/plugin.php';
	return is_plugin_active_for_network ('bp-profile-search/bps-main.php');
}

function bps_admin_url ($tab=false)
{
	$page = 'users.php?page=bp-profile-search';
	if ($tab)  $page .= '&tab='. $tab;

	$url = bps_active_for_network ()? network_admin_url ($page): admin_url ($page);
	return $url;
}

add_action (bps_active_for_network ()? 'network_admin_menu': 'admin_menu', 'bps_add_pages', 20);
function bps_add_pages ()
{
	add_submenu_page ('users.php', __('Profile Search Setup', 'bps'), __('Profile Search', 'bps'), 'manage_options', 'bp-profile-search', 'bps_admin');

	return true;
}

add_filter (bps_active_for_network ()? 'network_admin_plugin_action_links': 'plugin_action_links', 'bps_row_meta', 10, 2);
function bps_row_meta ($links, $file)
{
	if ($file == plugin_basename (__FILE__))
	{
		$settings_link = '<a href="'. bps_admin_url (). '">'. __('Settings', 'bps'). '</a>';
		array_unshift ($links, $settings_link);
	}
	return $links;
}

function bps_init_form ()
{
	global $bps_options;

	$bps_options['header'] = __('<h4>Advanced Search</h4>', 'bps');
	$bps_options['show'] = array ('Enabled');
	$bps_options['message'] = __('Toggle Form', 'bps');
	$bps_options['fields'] = array ();
	$bps_options['numrange'] = 0;
	$bps_options['numlabel'] = __('Value Range', 'bps');
	$bps_options['numdesc'] = __('minimum and maximum value', 'bps');
	$bps_options['agerange'] = 0;
	$bps_options['agelabel'] = __('Age Range', 'bps');
	$bps_options['agedesc'] = __('minimum and maximum age', 'bps');
	$bps_options['directory'] = 'No';
	$bps_options['searchmode'] = 'Partial Match';

	return true;
}

function bps_admin ()
{
	$tabs = array ('main' => __('Form Configuration', 'bps'), 'options' => __('Advanced Options', 'bps'));

	$tab = $_GET['tab'];
	if (empty ($tab) || !isset ($tabs[$tab]))  $tab = 'main';
?>

<div class="wrap">
  <?php screen_icon (); ?>

  <h2><?php _e('Profile Search Setup', 'bps'); ?></h2>

  <ul class="subsubsub">
<?php
	foreach ($tabs as $action => $text)
	{
		$sep = (end ($tabs) != $text)? ' | ' : '';
		$class = ($action == $tab)? ' class="current"' : '';
		$href = bps_admin_url ($action);
		echo "\t\t<li><a href='$href'$class>$text</a>$sep</li>\n";
	}
?>
  </ul>
  <br class="clear" />

<?php
	$function = 'bps_admin_'. $tab;
	$function ();
?>
</div>
<?php
}

function bps_admin_main ()
{
	global $bps_options;

	if ($_POST['action'] == 'update')
		$message = bps_update_form (array ('header', 'show', 'message', 'fields', 'numrange', 'numlabel', 'numdesc', 'agerange', 'agelabel', 'agedesc', 'directory'));
?>

<?php if ($message) : ?>
  <div id="message" class="updated fade"><p><?php echo $message; ?></p></div>
<?php endif; ?>

  <form method="post" action="<?php echo bps_admin_url ('main'); ?>">
	<?php wp_nonce_field ('bps_admin_main'); ?>
	<input type="hidden" name="action" value="update" />
	
	<h3><?php _e('Form Header and Fields', 'bps'); ?></h3>

	<p><?php _e('Select the header text and the profile fields to include in your search form.', 'bps'); ?></p>
	<p><?php printf (__('After you configure your form, you can display it:
	<ul>
	<li>a) In your Members Directory page, selecting the relevant option below</li>
	<li>b) In a sidebar or widget area, using the %2$s widget</li>
	<li>c) In a post or page, using the shortcode %1$s</li>
	</ul>
	Please note that the Form Header and the Toggle Form feature apply to case a) only.', 'bps'),
	"<strong>[bp_profile_search_form]</strong>",
	'<em>'. __('BP Profile Search', 'bps'). '</em>'); ?></p>
	<p><?php _e('<a href="http://dontdream.it/bp-profile-search/">See the plugin documentation</a> for more detailed instructions.', 'bps'); ?></p>

	<table class="form-table">
	<tr valign="top"><th scope="row"><?php _e('Form Header:', 'bps'); ?></th><td>
		<textarea name="bps_options[header]" class="large-text code" rows="4"><?php echo $bps_options['header']; ?></textarea>
	</td></tr>
	<tr valign="top"><th scope="row"><?php _e('Toggle Form:', 'bps'); ?></th><td>
		<label><input type="checkbox" name="bps_options[show][]" value="Enabled"<?php if (in_array ('Enabled', (array)$bps_options['show'])) echo ' checked="checked"'; ?> /> <?php _e('Enabled', 'bps'); ?></label><br />
	</td></tr>
	<tr valign="top"><th scope="row"><?php _e('Toggle Form Message:', 'bps'); ?></th><td>
		<input type="text" name="bps_options[message]" value="<?php echo $bps_options['message']; ?>"  />
	</td></tr>
	<tr valign="top"><th scope="row"><?php _e('Selected Profile Fields:', 'bps'); ?></th><td>
		<?php bps_fields ('bps_options[fields]', $bps_options['fields']); ?>
	</td></tr>
	</table>
	
	<h3><?php _e('Value Range Search', 'bps'); ?></h3>

	<p><?php _e('If user profiles include a numeric field, you can enable the Value Range Search option. To enable, select the numeric field below.', 'bps'); ?></p>

	<table class="form-table">
	<tr valign="top"><th scope="row"><?php _e('Numeric Field:', 'bps'); ?></th><td>
		<?php bps_numrange ('bps_options[numrange]', $bps_options['numrange']); ?>
	</td></tr>
	<tr valign="top"><th scope="row"><?php _e('Field Label:', 'bps'); ?></th><td>
		<input type="text" name="bps_options[numlabel]" value="<?php echo $bps_options['numlabel']; ?>"  />
	</td></tr>
	<tr valign="top"><th scope="row"><?php _e('Field Description:', 'bps'); ?></th><td>
		<input type="text" name="bps_options[numdesc]" value="<?php echo $bps_options['numdesc']; ?>" class="large-text" />
	</td></tr>
	</table>
	
	<h3><?php _e('Age Range Search', 'bps'); ?></h3>

	<p><?php _e('If user profiles include a birth date field, you can enable the Age Range Search option. To enable, select the birth date field below.', 'bps'); ?></p>

	<table class="form-table">
	<tr valign="top"><th scope="row"><?php _e('Birth Date Field:', 'bps'); ?></th><td>
		<?php bps_agerange ('bps_options[agerange]', $bps_options['agerange']); ?>
	</td></tr>
	<tr valign="top"><th scope="row"><?php _e('Field Label:', 'bps'); ?></th><td>
		<input type="text" name="bps_options[agelabel]" value="<?php echo $bps_options['agelabel']; ?>"  />
	</td></tr>
	<tr valign="top"><th scope="row"><?php _e('Field Description:', 'bps'); ?></th><td>
		<input type="text" name="bps_options[agedesc]" value="<?php echo $bps_options['agedesc']; ?>" class="large-text" />
	</td></tr>
	</table>
	
	<h3><?php _e('Add to Members Directory page', 'bps'); ?></h3>

	<p><?php _e('Automatically add your form to the Members Directory page.', 'bps'); ?></p>

	<table class="form-table">
	<tr valign="top"><th scope="row"><?php _e('Add to Members Directory:', 'bps'); ?></th><td>
		<label><input type="radio" name="bps_options[directory]" value="Yes"<?php if ('Yes' == $bps_options['directory']) echo ' checked="checked"'; ?> /> <?php _e('Yes', 'bps'); ?></label><br />
		<label><input type="radio" name="bps_options[directory]" value="No"<?php if ('No' == $bps_options['directory']) echo ' checked="checked"'; ?> /> <?php _e('No', 'bps'); ?></label><br />
	</td></tr>
	</table>

	<p class="submit">
	  <input type="submit" class="button-primary" value="<?php _e('Save Settings', 'bps'); ?>" />
	</p>
  </form>

<?php
}

function bps_admin_options ()
{
	global $bps_options;

	if ($_POST['action'] == 'update')
		$message = bps_update_form (array ('searchmode'));
?>

<?php if ($message) : ?>
  <div id="message" class="updated fade"><p><?php echo $message; ?></p></div>
<?php endif; ?>

  <form method="post" action="<?php echo bps_admin_url ('options'); ?>">
	<?php wp_nonce_field ('bps_admin_options'); ?>
	<input type="hidden" name="action" value="update" />
	
	<h3><?php _e('Text Search Mode', 'bps'); ?></h3>

	<p><?php _e('Select your text search mode here. Choose between partial match (a search for <em>John</em> matches <em>John</em>, <em>Johnson</em>, <em>Long John Silver</em>, and so on) and exact match (a search for <em>John</em> matches <em>John</em> only). In both modes the wildcard characters <em>% (percent sign)</em>, matching zero or more characters, and <em>_ (underscore)</em>, matching exactly one character, may be used.', 'bps'); ?></p>

	<table class="form-table">
	<tr valign="top"><th scope="row"><?php _e('Text Search Mode:', 'bps'); ?></th><td>
		<label><input type="radio" name="bps_options[searchmode]" value="Partial Match"<?php if ('Partial Match' == $bps_options['searchmode']) echo ' checked="checked"'; ?> /> <?php _e('Partial Match', 'bps'); ?></label><br />
		<label><input type="radio" name="bps_options[searchmode]" value="Exact Match"<?php if ('Exact Match' == $bps_options['searchmode']) echo ' checked="checked"'; ?> /> <?php _e('Exact Match', 'bps'); ?></label><br />
	</td></tr>
	</table>

	<p class="submit">
	  <input type="submit" class="button-primary" value="<?php _e('Save Settings', 'bps'); ?>" />
	</p>
  </form>

<?php
}

function bps_update_form ($vars)
{
	global $bps_options;

	foreach ($vars as $var)
		$bps_options[$var] = stripslashes_deep ($_POST['bps_options'][$var]);

	bps_active_for_network ()? update_site_option ('bps_options', $bps_options): update_option ('bps_options', $bps_options);

	return __('Settings saved.', 'bps');
}
?>
