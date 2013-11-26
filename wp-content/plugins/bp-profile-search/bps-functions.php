<?php
include 'bps-searchform.php';

function bps_fields ($name, $values)
{
	global $field;
	global $bps_options;
	global $dateboxes;
	global $textboxes;

	if (function_exists ('bp_has_profile')) : 
		if (bp_has_profile ('hide_empty_fields=0')) :
			$dateboxes = array ('');
			$textboxes = array ('');

			while (bp_profile_groups ()) : 
				bp_the_profile_group (); 

				echo '<strong>'. bp_get_the_profile_group_name (). ':</strong><br />';

				while (bp_profile_fields ()) : 
					bp_the_profile_field(); 
					$disabled = '';

					switch (bp_get_the_profile_field_type ())
					{
					case 'datebox':	
						$disabled = 'disabled="disabled"';
						$dateboxes[bp_get_the_profile_field_id ()] = bp_get_the_profile_field_name ();
						break;
					case 'textbox':	
					case 'selectbox':	
						if ($field->id == $bps_options['numrange'])  $disabled = 'disabled="disabled"';
						$textboxes[bp_get_the_profile_field_id ()] = bp_get_the_profile_field_name ();
						break;
					}
?>
<label>
	<input type="checkbox" name="<?php echo $name; ?>[]" value="<?php echo $field->id; ?>" <?php echo $disabled; ?>
		<?php if (in_array ($field->id, (array)$values))  echo ' checked="checked"'; ?> />
	<?php bp_the_profile_field_name (); ?>
</label><br />
<?php
				endwhile;
			endwhile; 
		endif;
	endif; 

	return true;
}

function bps_agerange ($name, $value)
{
	global $dateboxes;

	if (count ($dateboxes) > 1)
	{
		echo "<select name=\"$name\">\n";
		foreach ($dateboxes as $fid => $fname)
		{
			echo "<option value=\"$fid\"";
			if ($fid == $value)  echo " selected=\"selected\"";
			echo ">$fname &nbsp;</option>\n";
		}
		echo "</select>\n";
	}
	else
		_e('There is no date field in user profiles.', 'bps');

	return true;
}

function bps_numrange ($name, $value)
{
	global $textboxes;

	if (count ($textboxes) > 1)
	{
		echo "<select name=\"$name\">\n";
		foreach ($textboxes as $fid => $fname)
		{
			echo "<option value=\"$fid\"";
			if ($fid == $value)  echo " selected=\"selected\"";
			echo ">$fname &nbsp;</option>\n";
		}
		echo "</select>\n";
	}
	else
		_e('There is no textbox or selectbox field in user profiles.', 'bps');

	return true;
}

add_action ('wp_loaded', 'bps_set_cookie');
function bps_set_cookie ()
{
	global $bps_args;

	if (isset ($_POST['bp_profile_search']))
	{
		$bps_args = $_POST;
		add_action ('bp_before_directory_members_content', 'bps_your_search');
		setcookie ('bp-profile-search', serialize ($_POST), 0, COOKIEPATH);
	}
	else if (isset ($_COOKIE['bp-profile-search']))
	{
		if (defined ('DOING_AJAX'))
			$bps_args = unserialize (stripslashes ($_COOKIE['bp-profile-search']));
	}
}

add_action ('wp', 'bps_del_cookie');
function bps_del_cookie ()
{
	if (isset ($_POST['bp_profile_search']))  return false;

	if (isset ($_COOKIE['bp-profile-search']))
	{
		if (is_page (bp_get_members_root_slug ()))
			setcookie ('bp-profile-search', '', 0, COOKIEPATH);
	}
}

function bps_search ($posted)
{
	global $bp;
	global $wpdb;
	global $bps_options;

	$emptyform = true;
	$results = array ('users' => array (0), 'validated' => true);

	if (bp_has_profile ('hide_empty_fields=0')):
		while (bp_profile_groups ()):
			bp_the_profile_group ();
			while (bp_profile_fields ()): 
				bp_the_profile_field ();

				$id = bp_get_the_profile_field_id ();
				$value = $posted["field_$id"];
				$to = $posted["field_{$id}_to"];

				if ($value == '' && $to == '')  continue;

				$sql = "SELECT DISTINCT user_id FROM {$bp->profile->table_name_data}";

				switch (bp_get_the_profile_field_type ())
				{
				case 'textbox':
					if ($id == $bps_options['numrange'])
					{
						$sql .= $wpdb->prepare (" WHERE field_id = %d AND value >= %d AND value <= %d", $id, $value, $to);
						break;
					}
				case 'textarea':
					$value = $posted["field_$id"];
					$escaped = '%'. like_escape ($wpdb->escape ($posted["field_$id"])). '%';
					if ($bps_options['searchmode'] == 'Partial Match')
						$sql .= $wpdb->prepare (" WHERE field_id = %d AND value LIKE %s", $id, $escaped);
					else					
						$sql .= $wpdb->prepare (" WHERE field_id = %d AND value = %s", $id, $value);
					break;

				case 'selectbox':
					if ($id == $bps_options['numrange'])
					{
						$sql .= $wpdb->prepare (" WHERE field_id = %d AND value >= %d AND value <= %d", $id, $value, $to);
						break;
					}
				case 'radio':
					$value = $posted["field_$id"];
					$sql .= $wpdb->prepare (" WHERE field_id = %d AND value = %s", $id, $value);
					break;

				case 'multiselectbox':
				case 'checkbox':
					$values = $posted["field_$id"];
					$sql .= $wpdb->prepare (" WHERE field_id = %d", $id);
					$like = array ();
					foreach ($values as $value)
					{
						$escaped = '%"'. like_escape ($wpdb->escape ($value)). '"%';
						$like[] = $wpdb->prepare ("value = %s OR value LIKE %s", $value, $escaped);
					}	
					$sql .= ' AND ('. implode (' OR ', $like). ')';	
					break;

				case 'datebox':
					if ($id != $bps_options['agerange']) continue;

					$time = time ();
					$day = date ("j", $time);
					$month = date ("n", $time);
					$year = date ("Y", $time);
					$ymin = $year - $to - 1;
					$ymax = $year - $value;

					$sql .= $wpdb->prepare (" WHERE field_id = %d AND DATE(value) > %s AND DATE(value) <= %s", $id, "$ymin-$month-$day", "$ymax-$month-$day");
					break;
				}

				$sql = apply_filters ('bps_field_query', $sql);
				$found = $wpdb->get_col ($sql);
				if (!isset ($users)) 
					$users = $found;
				else
					$users = array_intersect ($users, $found);

				$emptyform = false;
				if (count ($users) == 0)  return $results;

			endwhile;
		endwhile;
	endif;

	if ($emptyform == true)
	{
		$results['validated'] = false;
		return $results;
	}

	$results['users'] = $users;
	return $results;
}

add_action ('bp_before_members_loop', 'bps_add_filter');
add_action ('bp_after_members_loop', 'bps_remove_filter');
function bps_add_filter ()
{
	add_filter ('bp_pre_user_query_construct', 'bps_user_query');
}
function bps_remove_filter ()
{
	remove_filter ('bp_pre_user_query_construct', 'bps_user_query');
}

function bps_user_query ($query)
{
	global $bps_args;

	if (!isset ($bps_args))  return $query;

	$bps_results = bps_search ($bps_args);
	if ($bps_results['validated'])
	{
		$users = $bps_results['users'];

		if ($query->query_vars['include'] !== false)
		{
			$included = $query->query_vars['include'];
			if (!is_array ($included))
				$included = explode (',', $included);

			$users = array_intersect ($users, $included);
			if (count ($users) == 0)  $users = array (0);
		}

		$query->query_vars['include'] = $users;
	}

	return $query;
}

add_shortcode ('bp_profile_search_form', 'bps_shortcode');
function bps_shortcode ($attr, $content)
{
	ob_start ();
	bps_display_form (0, 'bps_shortcode');
	return ob_get_clean ();
}

class bps_widget extends WP_Widget
{
	function bps_widget ()
	{
		$widget_ops = array ('description' => __('Your BP Profile Search form', 'bps'));
		$this->WP_Widget ('bp_profile_search', __('BP Profile Search', 'bps'), $widget_ops);
	}

	function widget ($args, $instance)
	{
		extract ($args);
		$title = apply_filters ('widget_title', $instance['title']);
	
		echo $before_widget;
		if ($title)
			echo $before_title. $title. $after_title;
		bps_display_form (0, 'bps_widget');
		echo $after_widget;
	}

	function update ($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		return $instance;
	}

	function form ($instance)
	{
		$title = $instance['title'];
?>
<p>
	<label for="<?php echo $this->get_field_id ('title'); ?>"><?php _e('Title:', 'bps'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id ('title'); ?>" name="<?php echo $this->get_field_name ('title'); ?>" type="text" value="<?php echo esc_attr ($title); ?>" />
</p>
<?php
	}
}

add_action ('widgets_init', 'bps_widget_init');
function bps_widget_init ()
{
	register_widget ('bps_widget');
}
?>
