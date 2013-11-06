

# -- Request URI: /hackathon/wp-admin/plugins.php?action=activate&plugin=monitoraquery%2Fmonitoraquery.php&plugin_status=all&paged=1&s&_wpnonce=3efb0b6598, Time: 2013-10-16 11:01:30 ------------

UPDATE `wp_options` SET `option_value` = 'a:4:{i:0;s:19:\"bbpress/bbpress.php\";i:1;s:24:\"buddypress/bp-loader.php\";i:2;s:31:\"monitoraquery/monitoraquery.php\";i:3;s:29:\"projectpress/projectpress.php\";}' WHERE `option_name` = 'active_plugins'

# -- Request URI: /hackathon/wp-admin/plugins.php?activate=true&plugin_status=all&paged=1&s=, Time: 2013-10-16 11:01:31 ------------

SELECT option_value FROM wp_options WHERE option_name = 'wordpress_api_key' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'active_sitewide_plugins' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = '_bbp_theme_package_id' LIMIT 1
SELECT * FROM wp_users WHERE user_login = 'admin'
SELECT user_id, meta_key, meta_value FROM wp_usermeta WHERE user_id IN (1)
SELECT option_value FROM wp_options WHERE option_name = 'widget_pages' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_calendar' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_tag_cloud' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_nav_menu' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_login_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_views_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_search_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_forums_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_topics_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_replies_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_stats_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bp_core_members_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bp_core_whos_online_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bp_core_recently_active_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bp_groups_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = '_bp_force_buddybar' LIMIT 1
SELECT ID, post_name, post_parent, post_title FROM wp_posts WHERE ID IN (4,6,5) AND post_status = 'publish' 
SELECT option_name AS name, option_value AS value FROM wp_options WHERE option_name IN ( 'bp-deactivated-components', 'bb-config-location', 'bp-xprofile-base-group-name', 'bp-xprofile-fullname-field-name', 'bp-blogs-first-install', 'bp-disable-profile-sync', 'hide-loggedout-adminbar', 'bp-disable-avatar-uploads', 'bp-disable-account-deletion', 'bp-disable-blogforum-comments', '_bp_theme_package_id', 'bp_restrict_group_creation', '_bp_enable_akismet', '_bp_force_buddybar', 'registration', 'avatar_default' )
SELECT option_value FROM wp_options WHERE option_name = 'bp-blogs-first-install' LIMIT 1
SELECT value FROM wp_bp_xprofile_data WHERE field_id = 1 AND user_id = 1
SELECT * FROM wp_users WHERE ID = 1 LIMIT 1
SELECT COUNT(DISTINCT m.group_id) FROM wp_bp_groups_members m, wp_bp_groups g WHERE m.group_id = g.id AND m.user_id = 1 AND m.is_confirmed = 1 AND m.is_banned = 0
SELECT SUM(unread_count) FROM wp_bp_messages_recipients WHERE user_id = 1 AND is_deleted = 0 AND sender_only = 0
SELECT option_value FROM wp_options WHERE option_name = 'db_upgraded' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'dismissed_update_core' LIMIT 1
SELECT comment_approved, COUNT( * ) AS num_comments FROM wp_comments  GROUP BY comment_approved
SELECT option_value FROM wp_options WHERE option_name = '_bbp_settings_integration' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = '_transient_timeout__bbp_activation_redirect' LIMIT 1
SELECT autoload FROM wp_options WHERE option_name = '_transient__bbp_activation_redirect'
SELECT autoload FROM wp_options WHERE option_name = '_transient_timeout__bbp_activation_redirect'
SELECT option_value FROM wp_options WHERE option_name = '_transient_timeout__bp_activation_redirect' LIMIT 1
SELECT autoload FROM wp_options WHERE option_name = '_transient__bp_activation_redirect'
SELECT autoload FROM wp_options WHERE option_name = '_transient_timeout__bp_activation_redirect'
SELECT COUNT(*) FROM wp_bp_user_blogs
SELECT option_value FROM wp_options WHERE option_name = '_transient_plugin_slugs' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = '_transient_timeout_plugin_slugs' LIMIT 1
UPDATE `wp_options` SET `option_value` = '1382007692' WHERE `option_name` = '_transient_timeout_plugin_slugs'
SELECT g.*, gm1.meta_value as total_member_count, gm2.meta_value as last_activity FROM wp_bp_groups_groupmeta gm1, wp_bp_groups_groupmeta gm2, wp_bp_groups_members m, wp_bp_groups g WHERE g.id = m.group_id AND g.id = gm1.group_id AND g.id = gm2.group_id AND gm2.meta_key = 'last_activity' AND gm1.meta_key = 'total_member_count' AND m.is_confirmed = 0 AND m.inviter_id != 0 AND m.invite_sent = 1 AND m.user_id = 1  ORDER BY m.date_modified ASC 
SELECT COUNT(DISTINCT m.group_id) FROM wp_bp_groups_members m, wp_bp_groups g WHERE m.group_id = g.id AND m.is_confirmed = 0 AND m.inviter_id != 0 AND m.invite_sent = 1 AND m.user_id = 1  ORDER BY date_modified ASC
SELECT SUM(unread_count) FROM wp_bp_messages_recipients WHERE user_id = 1 AND is_deleted = 0 AND sender_only = 0
SELECT * FROM wp_bp_notifications WHERE user_id = 1  AND is_new = 1 

# -- Request URI: /hackathon/, Time: 2013-10-16 11:01:36 ------------

SELECT option_value FROM wp_options WHERE option_name = 'wordpress_api_key' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = '_bbp_theme_package_id' LIMIT 1
SELECT * FROM wp_users WHERE user_login = 'admin'
SELECT user_id, meta_key, meta_value FROM wp_usermeta WHERE user_id IN (1)
SELECT option_value FROM wp_options WHERE option_name = 'widget_pages' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_calendar' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_tag_cloud' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_nav_menu' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_login_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_views_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_search_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_forums_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_topics_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_replies_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_stats_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bp_core_members_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bp_core_whos_online_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bp_core_recently_active_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bp_groups_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = '_bp_force_buddybar' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'active_sitewide_plugins' LIMIT 1
SELECT ID, post_name, post_parent, post_title FROM wp_posts WHERE ID IN (4,6,5) AND post_status = 'publish' 
SELECT option_name AS name, option_value AS value FROM wp_options WHERE option_name IN ( 'bp-deactivated-components', 'bb-config-location', 'bp-xprofile-base-group-name', 'bp-xprofile-fullname-field-name', 'bp-blogs-first-install', 'bp-disable-profile-sync', 'hide-loggedout-adminbar', 'bp-disable-avatar-uploads', 'bp-disable-account-deletion', 'bp-disable-blogforum-comments', '_bp_theme_package_id', 'bp_restrict_group_creation', '_bp_enable_akismet', '_bp_force_buddybar', 'registration', 'avatar_default' )
SELECT option_value FROM wp_options WHERE option_name = 'bp-blogs-first-install' LIMIT 1
SELECT value FROM wp_bp_xprofile_data WHERE field_id = 1 AND user_id = 1
SELECT * FROM wp_users WHERE ID = 1 LIMIT 1
SELECT COUNT(DISTINCT m.group_id) FROM wp_bp_groups_members m, wp_bp_groups g WHERE m.group_id = g.id AND m.user_id = 1 AND m.is_confirmed = 1 AND m.is_banned = 0
SELECT SUM(unread_count) FROM wp_bp_messages_recipients WHERE user_id = 1 AND is_deleted = 0 AND sender_only = 0
SELECT SQL_CALC_FOUND_ROWS  wp_posts.ID FROM wp_posts  WHERE 1=1  AND wp_posts.post_type = 'post' AND (wp_posts.post_status = 'publish' OR wp_posts.post_status = 'closed' OR wp_posts.post_status = 'private' OR wp_posts.post_status = 'hidden')  ORDER BY wp_posts.post_date DESC LIMIT 0, 10
SELECT FOUND_ROWS()
SELECT wp_posts.* FROM wp_posts WHERE ID IN (1)
SELECT t.*, tt.*, tr.object_id FROM wp_terms AS t INNER JOIN wp_term_taxonomy AS tt ON tt.term_id = t.term_id INNER JOIN wp_term_relationships AS tr ON tr.term_taxonomy_id = tt.term_taxonomy_id WHERE tt.taxonomy IN ('category', 'post_tag', 'post_format') AND tr.object_id IN (1) ORDER BY t.name ASC
SELECT post_id, meta_key, meta_value FROM wp_postmeta WHERE post_id IN (1)
SELECT umeta_id FROM wp_usermeta WHERE meta_key = 'last_activity' AND user_id = 1
UPDATE `wp_usermeta` SET `meta_value` = '2013-10-16 11:01:37' WHERE `user_id` = 1 AND `meta_key` = 'last_activity'
SELECT * FROM wp_posts  WHERE (post_type = 'page' AND post_status = 'publish')     ORDER BY menu_order,wp_posts.post_title ASC
SELECT user_id, meta_key, meta_value FROM wp_usermeta WHERE user_id IN (1)
SELECT * FROM wp_comments  WHERE comment_approved = '1' AND comment_post_ID = 1  ORDER BY comment_date_gmt DESC 
SELECT   wp_posts.ID FROM wp_posts  WHERE 1=1  AND wp_posts.post_type = 'post' AND (wp_posts.post_status = 'publish')  ORDER BY wp_posts.post_date DESC LIMIT 0, 5
SELECT * FROM wp_comments JOIN wp_posts ON wp_posts.ID = wp_comments.comment_post_ID WHERE comment_approved = '1' AND wp_posts.post_status = 'publish'  ORDER BY comment_date_gmt DESC LIMIT 5
SELECT YEAR(post_date) AS `year`, MONTH(post_date) AS `month`, count(ID) as posts FROM wp_posts  WHERE post_type = 'post' AND post_status = 'publish' GROUP BY YEAR(post_date), MONTH(post_date) ORDER BY post_date DESC 
SELECT t.*, tt.* FROM wp_terms AS t INNER JOIN wp_term_taxonomy AS tt ON t.term_id = tt.term_id WHERE tt.taxonomy IN ('category') AND tt.count > 0 ORDER BY t.name ASC 
SELECT g.*, gm1.meta_value as total_member_count, gm2.meta_value as last_activity FROM wp_bp_groups_groupmeta gm1, wp_bp_groups_groupmeta gm2, wp_bp_groups_members m, wp_bp_groups g WHERE g.id = m.group_id AND g.id = gm1.group_id AND g.id = gm2.group_id AND gm2.meta_key = 'last_activity' AND gm1.meta_key = 'total_member_count' AND m.is_confirmed = 0 AND m.inviter_id != 0 AND m.invite_sent = 1 AND m.user_id = 1  ORDER BY m.date_modified ASC 
SELECT COUNT(DISTINCT m.group_id) FROM wp_bp_groups_members m, wp_bp_groups g WHERE m.group_id = g.id AND m.is_confirmed = 0 AND m.inviter_id != 0 AND m.invite_sent = 1 AND m.user_id = 1  ORDER BY date_modified ASC
SELECT SUM(unread_count) FROM wp_bp_messages_recipients WHERE user_id = 1 AND is_deleted = 0 AND sender_only = 0
SELECT comment_approved, COUNT( * ) AS num_comments FROM wp_comments  GROUP BY comment_approved
SELECT * FROM wp_bp_notifications WHERE user_id = 1  AND is_new = 1 
SELECT id FROM wp_bp_messages_notices WHERE is_active = 1

# -- Request URI: /hackathon/pagina-di-esempio/, Time: 2013-10-16 11:01:45 ------------

SELECT option_value FROM wp_options WHERE option_name = 'wordpress_api_key' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = '_bbp_theme_package_id' LIMIT 1
SELECT * FROM wp_users WHERE user_login = 'admin'
SELECT user_id, meta_key, meta_value FROM wp_usermeta WHERE user_id IN (1)
SELECT option_value FROM wp_options WHERE option_name = 'widget_pages' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_calendar' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_tag_cloud' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_nav_menu' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_login_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_views_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_search_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_forums_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_topics_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_replies_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_stats_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bp_core_members_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bp_core_whos_online_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bp_core_recently_active_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bp_groups_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = '_bp_force_buddybar' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'active_sitewide_plugins' LIMIT 1
SELECT ID, post_name, post_parent, post_title FROM wp_posts WHERE ID IN (4,6,5) AND post_status = 'publish' 
SELECT option_name AS name, option_value AS value FROM wp_options WHERE option_name IN ( 'bp-deactivated-components', 'bb-config-location', 'bp-xprofile-base-group-name', 'bp-xprofile-fullname-field-name', 'bp-blogs-first-install', 'bp-disable-profile-sync', 'hide-loggedout-adminbar', 'bp-disable-avatar-uploads', 'bp-disable-account-deletion', 'bp-disable-blogforum-comments', '_bp_theme_package_id', 'bp_restrict_group_creation', '_bp_enable_akismet', '_bp_force_buddybar', 'registration', 'avatar_default' )
SELECT option_value FROM wp_options WHERE option_name = 'bp-blogs-first-install' LIMIT 1
SELECT value FROM wp_bp_xprofile_data WHERE field_id = 1 AND user_id = 1
SELECT * FROM wp_users WHERE ID = 1 LIMIT 1
SELECT COUNT(DISTINCT m.group_id) FROM wp_bp_groups_members m, wp_bp_groups g WHERE m.group_id = g.id AND m.user_id = 1 AND m.is_confirmed = 1 AND m.is_banned = 0
SELECT SUM(unread_count) FROM wp_bp_messages_recipients WHERE user_id = 1 AND is_deleted = 0 AND sender_only = 0
SELECT ID, post_name, post_parent, post_type FROM wp_posts WHERE post_name IN ('pagina-di-esempio') AND (post_type = 'page' OR post_type = 'attachment')
SELECT * FROM wp_posts WHERE ID = 2 LIMIT 1
SELECT   wp_posts.* FROM wp_posts  WHERE 1=1  AND (wp_posts.ID = '2') AND wp_posts.post_type = 'page'  ORDER BY wp_posts.post_date DESC 
SELECT post_id, meta_key, meta_value FROM wp_postmeta WHERE post_id IN (2)
SELECT p.ID FROM wp_posts AS p  WHERE p.post_date < '2013-10-15 07:45:26' AND p.post_type = 'page' AND p.post_status = 'publish'  ORDER BY p.post_date DESC LIMIT 1
SELECT p.ID FROM wp_posts AS p  WHERE p.post_date > '2013-10-15 07:45:26' AND p.post_type = 'page' AND p.post_status = 'publish'  ORDER BY p.post_date ASC LIMIT 1
SELECT * FROM wp_posts WHERE ID = 4 LIMIT 1
SELECT ID FROM wp_posts WHERE post_parent = 2 AND post_type = 'page' AND post_status = 'publish' LIMIT 1
SELECT * FROM wp_posts  WHERE (post_type = 'page' AND post_status = 'publish')     ORDER BY menu_order,wp_posts.post_title ASC
SELECT * FROM wp_comments  WHERE comment_approved = '1' AND comment_post_ID = 2  ORDER BY comment_date_gmt DESC 
SELECT * FROM wp_comments  WHERE comment_approved = '1' AND comment_post_ID = 2  ORDER BY comment_date_gmt DESC 
SELECT * FROM wp_comments WHERE comment_post_ID = 2 AND (comment_approved = '1' OR ( user_id = 1 AND comment_approved = '0' ) )  ORDER BY comment_date_gmt
SELECT   wp_posts.ID FROM wp_posts  WHERE 1=1  AND wp_posts.post_type = 'post' AND (wp_posts.post_status = 'publish')  ORDER BY wp_posts.post_date DESC LIMIT 0, 5
SELECT wp_posts.* FROM wp_posts WHERE ID IN (1)
SELECT t.*, tt.*, tr.object_id FROM wp_terms AS t INNER JOIN wp_term_taxonomy AS tt ON tt.term_id = t.term_id INNER JOIN wp_term_relationships AS tr ON tr.term_taxonomy_id = tt.term_taxonomy_id WHERE tt.taxonomy IN ('category', 'post_tag', 'post_format') AND tr.object_id IN (1) ORDER BY t.name ASC
SELECT post_id, meta_key, meta_value FROM wp_postmeta WHERE post_id IN (1)
SELECT * FROM wp_comments JOIN wp_posts ON wp_posts.ID = wp_comments.comment_post_ID WHERE comment_approved = '1' AND wp_posts.post_status = 'publish'  ORDER BY comment_date_gmt DESC LIMIT 5
SELECT YEAR(post_date) AS `year`, MONTH(post_date) AS `month`, count(ID) as posts FROM wp_posts  WHERE post_type = 'post' AND post_status = 'publish' GROUP BY YEAR(post_date), MONTH(post_date) ORDER BY post_date DESC 
SELECT t.*, tt.* FROM wp_terms AS t INNER JOIN wp_term_taxonomy AS tt ON t.term_id = tt.term_id WHERE tt.taxonomy IN ('category') AND tt.count > 0 ORDER BY t.name ASC 
SELECT g.*, gm1.meta_value as total_member_count, gm2.meta_value as last_activity FROM wp_bp_groups_groupmeta gm1, wp_bp_groups_groupmeta gm2, wp_bp_groups_members m, wp_bp_groups g WHERE g.id = m.group_id AND g.id = gm1.group_id AND g.id = gm2.group_id AND gm2.meta_key = 'last_activity' AND gm1.meta_key = 'total_member_count' AND m.is_confirmed = 0 AND m.inviter_id != 0 AND m.invite_sent = 1 AND m.user_id = 1  ORDER BY m.date_modified ASC 
SELECT COUNT(DISTINCT m.group_id) FROM wp_bp_groups_members m, wp_bp_groups g WHERE m.group_id = g.id AND m.is_confirmed = 0 AND m.inviter_id != 0 AND m.invite_sent = 1 AND m.user_id = 1  ORDER BY date_modified ASC
SELECT SUM(unread_count) FROM wp_bp_messages_recipients WHERE user_id = 1 AND is_deleted = 0 AND sender_only = 0
SELECT comment_approved, COUNT( * ) AS num_comments FROM wp_comments  GROUP BY comment_approved
SELECT * FROM wp_bp_notifications WHERE user_id = 1  AND is_new = 1 
SELECT id FROM wp_bp_messages_notices WHERE is_active = 1

# -- Request URI: /hackathon/wp-admin/plugins.php?action=deactivate&plugin=monitoraquery%2Fmonitoraquery.php&plugin_status=all&paged=1&s&_wpnonce=05a4bf833f, Time: 2013-10-16 11:01:59 ------------

SELECT option_value FROM wp_options WHERE option_name = 'wordpress_api_key' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'active_sitewide_plugins' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = '_bbp_theme_package_id' LIMIT 1
SELECT * FROM wp_users WHERE user_login = 'admin'
SELECT user_id, meta_key, meta_value FROM wp_usermeta WHERE user_id IN (1)
SELECT option_value FROM wp_options WHERE option_name = 'widget_pages' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_calendar' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_tag_cloud' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_nav_menu' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_login_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_views_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_search_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_forums_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_topics_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_replies_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_stats_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bp_core_members_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bp_core_whos_online_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bp_core_recently_active_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bp_groups_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = '_bp_force_buddybar' LIMIT 1
SELECT ID, post_name, post_parent, post_title FROM wp_posts WHERE ID IN (4,6,5) AND post_status = 'publish' 
SELECT option_name AS name, option_value AS value FROM wp_options WHERE option_name IN ( 'bp-deactivated-components', 'bb-config-location', 'bp-xprofile-base-group-name', 'bp-xprofile-fullname-field-name', 'bp-blogs-first-install', 'bp-disable-profile-sync', 'hide-loggedout-adminbar', 'bp-disable-avatar-uploads', 'bp-disable-account-deletion', 'bp-disable-blogforum-comments', '_bp_theme_package_id', 'bp_restrict_group_creation', '_bp_enable_akismet', '_bp_force_buddybar', 'registration', 'avatar_default' )
SELECT option_value FROM wp_options WHERE option_name = 'bp-blogs-first-install' LIMIT 1
SELECT value FROM wp_bp_xprofile_data WHERE field_id = 1 AND user_id = 1
SELECT * FROM wp_users WHERE ID = 1 LIMIT 1
SELECT COUNT(DISTINCT m.group_id) FROM wp_bp_groups_members m, wp_bp_groups g WHERE m.group_id = g.id AND m.user_id = 1 AND m.is_confirmed = 1 AND m.is_banned = 0
SELECT SUM(unread_count) FROM wp_bp_messages_recipients WHERE user_id = 1 AND is_deleted = 0 AND sender_only = 0
SELECT option_value FROM wp_options WHERE option_name = 'db_upgraded' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'dismissed_update_core' LIMIT 1
SELECT comment_approved, COUNT( * ) AS num_comments FROM wp_comments  GROUP BY comment_approved
SELECT option_value FROM wp_options WHERE option_name = '_bbp_settings_integration' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = '_transient_timeout__bbp_activation_redirect' LIMIT 1
SELECT autoload FROM wp_options WHERE option_name = '_transient__bbp_activation_redirect'
SELECT autoload FROM wp_options WHERE option_name = '_transient_timeout__bbp_activation_redirect'
SELECT option_value FROM wp_options WHERE option_name = '_transient_timeout__bp_activation_redirect' LIMIT 1
SELECT autoload FROM wp_options WHERE option_name = '_transient__bp_activation_redirect'
SELECT autoload FROM wp_options WHERE option_name = '_transient_timeout__bp_activation_redirect'
SELECT COUNT(*) FROM wp_bp_user_blogs
UPDATE `wp_options` SET `option_value` = 'a:3:{i:0;s:19:\"bbpress/bbpress.php\";i:1;s:24:\"buddypress/bp-loader.php\";i:3;s:29:\"projectpress/projectpress.php\";}' WHERE `option_name` = 'active_plugins'
UPDATE `wp_options` SET `option_value` = 'a:1:{s:31:\"monitoraquery/monitoraquery.php\";i:1381921319;}' WHERE `option_name` = 'recently_activated'

# -- Request URI: /hackathon/wp-admin/plugins.php?action=activate&plugin=monitoraquery%2Fmonitoraquery.php&plugin_status=all&paged=1&s&_wpnonce=3efb0b6598, Time: 2013-10-16 11:02:59 ------------

UPDATE `wp_options` SET `option_value` = 'a:4:{i:0;s:19:\"bbpress/bbpress.php\";i:1;s:24:\"buddypress/bp-loader.php\";i:2;s:31:\"monitoraquery/monitoraquery.php\";i:3;s:29:\"projectpress/projectpress.php\";}' WHERE `option_name` = 'active_plugins'
UPDATE `wp_options` SET `option_value` = 'a:0:{}' WHERE `option_name` = 'recently_activated'

# -- Request URI: /hackathon/wp-admin/plugins.php?activate=true&plugin_status=all&paged=1&s=, Time: 2013-10-16 11:03:01 ------------

SELECT option_value FROM wp_options WHERE option_name = 'wordpress_api_key' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'active_sitewide_plugins' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = '_bbp_theme_package_id' LIMIT 1
SELECT * FROM wp_users WHERE user_login = 'admin'
SELECT user_id, meta_key, meta_value FROM wp_usermeta WHERE user_id IN (1)
SELECT option_value FROM wp_options WHERE option_name = 'widget_pages' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_calendar' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_tag_cloud' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_nav_menu' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_login_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_views_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_search_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_forums_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_topics_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_replies_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_stats_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bp_core_members_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bp_core_whos_online_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bp_core_recently_active_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bp_groups_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = '_bp_force_buddybar' LIMIT 1
SELECT ID, post_name, post_parent, post_title FROM wp_posts WHERE ID IN (4,6,5) AND post_status = 'publish' 
SELECT option_name AS name, option_value AS value FROM wp_options WHERE option_name IN ( 'bp-deactivated-components', 'bb-config-location', 'bp-xprofile-base-group-name', 'bp-xprofile-fullname-field-name', 'bp-blogs-first-install', 'bp-disable-profile-sync', 'hide-loggedout-adminbar', 'bp-disable-avatar-uploads', 'bp-disable-account-deletion', 'bp-disable-blogforum-comments', '_bp_theme_package_id', 'bp_restrict_group_creation', '_bp_enable_akismet', '_bp_force_buddybar', 'registration', 'avatar_default' )
SELECT option_value FROM wp_options WHERE option_name = 'bp-blogs-first-install' LIMIT 1
SELECT value FROM wp_bp_xprofile_data WHERE field_id = 1 AND user_id = 1
SELECT * FROM wp_users WHERE ID = 1 LIMIT 1
SELECT COUNT(DISTINCT m.group_id) FROM wp_bp_groups_members m, wp_bp_groups g WHERE m.group_id = g.id AND m.user_id = 1 AND m.is_confirmed = 1 AND m.is_banned = 0
SELECT SUM(unread_count) FROM wp_bp_messages_recipients WHERE user_id = 1 AND is_deleted = 0 AND sender_only = 0
SELECT option_value FROM wp_options WHERE option_name = 'db_upgraded' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'dismissed_update_core' LIMIT 1
SELECT comment_approved, COUNT( * ) AS num_comments FROM wp_comments  GROUP BY comment_approved
SELECT option_value FROM wp_options WHERE option_name = '_bbp_settings_integration' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = '_transient_timeout__bbp_activation_redirect' LIMIT 1
SELECT autoload FROM wp_options WHERE option_name = '_transient__bbp_activation_redirect'
SELECT autoload FROM wp_options WHERE option_name = '_transient_timeout__bbp_activation_redirect'
SELECT option_value FROM wp_options WHERE option_name = '_transient_timeout__bp_activation_redirect' LIMIT 1
SELECT autoload FROM wp_options WHERE option_name = '_transient__bp_activation_redirect'
SELECT autoload FROM wp_options WHERE option_name = '_transient_timeout__bp_activation_redirect'
SELECT COUNT(*) FROM wp_bp_user_blogs
SELECT option_value FROM wp_options WHERE option_name = '_transient_plugin_slugs' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = '_transient_timeout_plugin_slugs' LIMIT 1
UPDATE `wp_options` SET `option_value` = '1382007781' WHERE `option_name` = '_transient_timeout_plugin_slugs'
SELECT g.*, gm1.meta_value as total_member_count, gm2.meta_value as last_activity FROM wp_bp_groups_groupmeta gm1, wp_bp_groups_groupmeta gm2, wp_bp_groups_members m, wp_bp_groups g WHERE g.id = m.group_id AND g.id = gm1.group_id AND g.id = gm2.group_id AND gm2.meta_key = 'last_activity' AND gm1.meta_key = 'total_member_count' AND m.is_confirmed = 0 AND m.inviter_id != 0 AND m.invite_sent = 1 AND m.user_id = 1  ORDER BY m.date_modified ASC 
SELECT COUNT(DISTINCT m.group_id) FROM wp_bp_groups_members m, wp_bp_groups g WHERE m.group_id = g.id AND m.is_confirmed = 0 AND m.inviter_id != 0 AND m.invite_sent = 1 AND m.user_id = 1  ORDER BY date_modified ASC
SELECT SUM(unread_count) FROM wp_bp_messages_recipients WHERE user_id = 1 AND is_deleted = 0 AND sender_only = 0
SELECT * FROM wp_bp_notifications WHERE user_id = 1  AND is_new = 1 

# -- Request URI: /hackathon/, Time: 2013-10-16 11:03:06 ------------

SELECT option_value FROM wp_options WHERE option_name = 'wordpress_api_key' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = '_bbp_theme_package_id' LIMIT 1
SELECT * FROM wp_users WHERE user_login = 'admin'
SELECT user_id, meta_key, meta_value FROM wp_usermeta WHERE user_id IN (1)
SELECT option_value FROM wp_options WHERE option_name = 'widget_pages' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_calendar' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_tag_cloud' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_nav_menu' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_login_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_views_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_search_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_forums_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_topics_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_replies_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_stats_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bp_core_members_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bp_core_whos_online_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bp_core_recently_active_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bp_groups_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = '_bp_force_buddybar' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'active_sitewide_plugins' LIMIT 1
SELECT ID, post_name, post_parent, post_title FROM wp_posts WHERE ID IN (4,6,5) AND post_status = 'publish' 
SELECT option_name AS name, option_value AS value FROM wp_options WHERE option_name IN ( 'bp-deactivated-components', 'bb-config-location', 'bp-xprofile-base-group-name', 'bp-xprofile-fullname-field-name', 'bp-blogs-first-install', 'bp-disable-profile-sync', 'hide-loggedout-adminbar', 'bp-disable-avatar-uploads', 'bp-disable-account-deletion', 'bp-disable-blogforum-comments', '_bp_theme_package_id', 'bp_restrict_group_creation', '_bp_enable_akismet', '_bp_force_buddybar', 'registration', 'avatar_default' )
SELECT option_value FROM wp_options WHERE option_name = 'bp-blogs-first-install' LIMIT 1
SELECT value FROM wp_bp_xprofile_data WHERE field_id = 1 AND user_id = 1
SELECT * FROM wp_users WHERE ID = 1 LIMIT 1
SELECT COUNT(DISTINCT m.group_id) FROM wp_bp_groups_members m, wp_bp_groups g WHERE m.group_id = g.id AND m.user_id = 1 AND m.is_confirmed = 1 AND m.is_banned = 0
SELECT SUM(unread_count) FROM wp_bp_messages_recipients WHERE user_id = 1 AND is_deleted = 0 AND sender_only = 0
SELECT SQL_CALC_FOUND_ROWS  wp_posts.ID FROM wp_posts  WHERE 1=1  AND wp_posts.post_type = 'post' AND (wp_posts.post_status = 'publish' OR wp_posts.post_status = 'closed' OR wp_posts.post_status = 'private' OR wp_posts.post_status = 'hidden')  ORDER BY wp_posts.post_date DESC LIMIT 0, 10
SELECT FOUND_ROWS()
SELECT wp_posts.* FROM wp_posts WHERE ID IN (1)
SELECT t.*, tt.*, tr.object_id FROM wp_terms AS t INNER JOIN wp_term_taxonomy AS tt ON tt.term_id = t.term_id INNER JOIN wp_term_relationships AS tr ON tr.term_taxonomy_id = tt.term_taxonomy_id WHERE tt.taxonomy IN ('category', 'post_tag', 'post_format') AND tr.object_id IN (1) ORDER BY t.name ASC
SELECT post_id, meta_key, meta_value FROM wp_postmeta WHERE post_id IN (1)
SELECT * FROM wp_posts  WHERE (post_type = 'page' AND post_status = 'publish')     ORDER BY menu_order,wp_posts.post_title ASC
SELECT * FROM wp_comments  WHERE comment_approved = '1' AND comment_post_ID = 1  ORDER BY comment_date_gmt DESC 
SELECT   wp_posts.ID FROM wp_posts  WHERE 1=1  AND wp_posts.post_type = 'post' AND (wp_posts.post_status = 'publish')  ORDER BY wp_posts.post_date DESC LIMIT 0, 5
SELECT * FROM wp_comments JOIN wp_posts ON wp_posts.ID = wp_comments.comment_post_ID WHERE comment_approved = '1' AND wp_posts.post_status = 'publish'  ORDER BY comment_date_gmt DESC LIMIT 5
SELECT YEAR(post_date) AS `year`, MONTH(post_date) AS `month`, count(ID) as posts FROM wp_posts  WHERE post_type = 'post' AND post_status = 'publish' GROUP BY YEAR(post_date), MONTH(post_date) ORDER BY post_date DESC 
SELECT t.*, tt.* FROM wp_terms AS t INNER JOIN wp_term_taxonomy AS tt ON t.term_id = tt.term_id WHERE tt.taxonomy IN ('category') AND tt.count > 0 ORDER BY t.name ASC 
SELECT g.*, gm1.meta_value as total_member_count, gm2.meta_value as last_activity FROM wp_bp_groups_groupmeta gm1, wp_bp_groups_groupmeta gm2, wp_bp_groups_members m, wp_bp_groups g WHERE g.id = m.group_id AND g.id = gm1.group_id AND g.id = gm2.group_id AND gm2.meta_key = 'last_activity' AND gm1.meta_key = 'total_member_count' AND m.is_confirmed = 0 AND m.inviter_id != 0 AND m.invite_sent = 1 AND m.user_id = 1  ORDER BY m.date_modified ASC 
SELECT COUNT(DISTINCT m.group_id) FROM wp_bp_groups_members m, wp_bp_groups g WHERE m.group_id = g.id AND m.is_confirmed = 0 AND m.inviter_id != 0 AND m.invite_sent = 1 AND m.user_id = 1  ORDER BY date_modified ASC
SELECT SUM(unread_count) FROM wp_bp_messages_recipients WHERE user_id = 1 AND is_deleted = 0 AND sender_only = 0
SELECT comment_approved, COUNT( * ) AS num_comments FROM wp_comments  GROUP BY comment_approved
SELECT * FROM wp_bp_notifications WHERE user_id = 1  AND is_new = 1 
SELECT id FROM wp_bp_messages_notices WHERE is_active = 1

# -- Request URI: /hackathon/2013/10/15/ciao-mondo/, Time: 2013-10-16 11:03:13 ------------

SELECT option_value FROM wp_options WHERE option_name = 'wordpress_api_key' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = '_bbp_theme_package_id' LIMIT 1
SELECT * FROM wp_users WHERE user_login = 'admin'
SELECT user_id, meta_key, meta_value FROM wp_usermeta WHERE user_id IN (1)
SELECT option_value FROM wp_options WHERE option_name = 'widget_pages' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_calendar' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_tag_cloud' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_nav_menu' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_login_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_views_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_search_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_forums_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_topics_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_replies_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_stats_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bp_core_members_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bp_core_whos_online_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bp_core_recently_active_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bp_groups_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = '_bp_force_buddybar' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'active_sitewide_plugins' LIMIT 1
SELECT ID, post_name, post_parent, post_title FROM wp_posts WHERE ID IN (4,6,5) AND post_status = 'publish' 
SELECT option_name AS name, option_value AS value FROM wp_options WHERE option_name IN ( 'bp-deactivated-components', 'bb-config-location', 'bp-xprofile-base-group-name', 'bp-xprofile-fullname-field-name', 'bp-blogs-first-install', 'bp-disable-profile-sync', 'hide-loggedout-adminbar', 'bp-disable-avatar-uploads', 'bp-disable-account-deletion', 'bp-disable-blogforum-comments', '_bp_theme_package_id', 'bp_restrict_group_creation', '_bp_enable_akismet', '_bp_force_buddybar', 'registration', 'avatar_default' )
SELECT option_value FROM wp_options WHERE option_name = 'bp-blogs-first-install' LIMIT 1
SELECT value FROM wp_bp_xprofile_data WHERE field_id = 1 AND user_id = 1
SELECT * FROM wp_users WHERE ID = 1 LIMIT 1
SELECT COUNT(DISTINCT m.group_id) FROM wp_bp_groups_members m, wp_bp_groups g WHERE m.group_id = g.id AND m.user_id = 1 AND m.is_confirmed = 1 AND m.is_banned = 0
SELECT SUM(unread_count) FROM wp_bp_messages_recipients WHERE user_id = 1 AND is_deleted = 0 AND sender_only = 0
SELECT   wp_posts.* FROM wp_posts  WHERE 1=1  AND YEAR(wp_posts.post_date)='2013' AND MONTH(wp_posts.post_date)='10' AND DAYOFMONTH(wp_posts.post_date)='15' AND wp_posts.post_name = 'ciao-mondo' AND wp_posts.post_type = 'post'  ORDER BY wp_posts.post_date DESC 
SELECT t.*, tt.*, tr.object_id FROM wp_terms AS t INNER JOIN wp_term_taxonomy AS tt ON tt.term_id = t.term_id INNER JOIN wp_term_relationships AS tr ON tr.term_taxonomy_id = tt.term_taxonomy_id WHERE tt.taxonomy IN ('category', 'post_tag', 'post_format') AND tr.object_id IN (1) ORDER BY t.name ASC
SELECT post_id, meta_key, meta_value FROM wp_postmeta WHERE post_id IN (1)
SELECT p.ID FROM wp_posts AS p  WHERE p.post_date < '2013-10-15 07:45:26' AND p.post_type = 'post' AND p.post_status = 'publish'  ORDER BY p.post_date DESC LIMIT 1
SELECT p.ID FROM wp_posts AS p  WHERE p.post_date > '2013-10-15 07:45:26' AND p.post_type = 'post' AND p.post_status = 'publish'  ORDER BY p.post_date ASC LIMIT 1
SELECT * FROM wp_posts  WHERE (post_type = 'page' AND post_status = 'publish')     ORDER BY menu_order,wp_posts.post_title ASC
SELECT * FROM wp_comments  WHERE comment_approved = '1' AND comment_post_ID = 1  ORDER BY comment_date_gmt DESC 
SELECT * FROM wp_comments WHERE comment_post_ID = 1 AND (comment_approved = '1' OR ( user_id = 1 AND comment_approved = '0' ) )  ORDER BY comment_date_gmt
SELECT   wp_posts.ID FROM wp_posts  WHERE 1=1  AND wp_posts.post_type = 'post' AND (wp_posts.post_status = 'publish')  ORDER BY wp_posts.post_date DESC LIMIT 0, 5
SELECT * FROM wp_comments JOIN wp_posts ON wp_posts.ID = wp_comments.comment_post_ID WHERE comment_approved = '1' AND wp_posts.post_status = 'publish'  ORDER BY comment_date_gmt DESC LIMIT 5
SELECT YEAR(post_date) AS `year`, MONTH(post_date) AS `month`, count(ID) as posts FROM wp_posts  WHERE post_type = 'post' AND post_status = 'publish' GROUP BY YEAR(post_date), MONTH(post_date) ORDER BY post_date DESC 
SELECT t.*, tt.* FROM wp_terms AS t INNER JOIN wp_term_taxonomy AS tt ON t.term_id = tt.term_id WHERE tt.taxonomy IN ('category') AND tt.count > 0 ORDER BY t.name ASC 
SELECT g.*, gm1.meta_value as total_member_count, gm2.meta_value as last_activity FROM wp_bp_groups_groupmeta gm1, wp_bp_groups_groupmeta gm2, wp_bp_groups_members m, wp_bp_groups g WHERE g.id = m.group_id AND g.id = gm1.group_id AND g.id = gm2.group_id AND gm2.meta_key = 'last_activity' AND gm1.meta_key = 'total_member_count' AND m.is_confirmed = 0 AND m.inviter_id != 0 AND m.invite_sent = 1 AND m.user_id = 1  ORDER BY m.date_modified ASC 
SELECT COUNT(DISTINCT m.group_id) FROM wp_bp_groups_members m, wp_bp_groups g WHERE m.group_id = g.id AND m.is_confirmed = 0 AND m.inviter_id != 0 AND m.invite_sent = 1 AND m.user_id = 1  ORDER BY date_modified ASC
SELECT SUM(unread_count) FROM wp_bp_messages_recipients WHERE user_id = 1 AND is_deleted = 0 AND sender_only = 0
SELECT comment_approved, COUNT( * ) AS num_comments FROM wp_comments  GROUP BY comment_approved
SELECT * FROM wp_bp_notifications WHERE user_id = 1  AND is_new = 1 
SELECT id FROM wp_bp_messages_notices WHERE is_active = 1

# -- Request URI: /hackathon/wp-admin/admin-ajax.php, Time: 2013-10-16 11:04:42 ------------

SELECT option_value FROM wp_options WHERE option_name = 'wordpress_api_key' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'active_sitewide_plugins' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = '_bbp_theme_package_id' LIMIT 1
SELECT * FROM wp_users WHERE user_login = 'admin'
SELECT user_id, meta_key, meta_value FROM wp_usermeta WHERE user_id IN (1)
SELECT option_value FROM wp_options WHERE option_name = 'widget_pages' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_calendar' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_tag_cloud' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_nav_menu' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_login_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_views_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_search_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_forums_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_topics_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_replies_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_stats_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bp_core_members_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bp_core_whos_online_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bp_core_recently_active_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bp_groups_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = '_bp_force_buddybar' LIMIT 1
SELECT ID, post_name, post_parent, post_title FROM wp_posts WHERE ID IN (4,6,5) AND post_status = 'publish' 
SELECT option_name AS name, option_value AS value FROM wp_options WHERE option_name IN ( 'bp-deactivated-components', 'bb-config-location', 'bp-xprofile-base-group-name', 'bp-xprofile-fullname-field-name', 'bp-blogs-first-install', 'bp-disable-profile-sync', 'hide-loggedout-adminbar', 'bp-disable-avatar-uploads', 'bp-disable-account-deletion', 'bp-disable-blogforum-comments', '_bp_theme_package_id', 'bp_restrict_group_creation', '_bp_enable_akismet', '_bp_force_buddybar', 'registration', 'avatar_default' )
SELECT option_value FROM wp_options WHERE option_name = 'bp-blogs-first-install' LIMIT 1
SELECT value FROM wp_bp_xprofile_data WHERE field_id = 1 AND user_id = 1
SELECT * FROM wp_users WHERE ID = 1 LIMIT 1
SELECT COUNT(DISTINCT m.group_id) FROM wp_bp_groups_members m, wp_bp_groups g WHERE m.group_id = g.id AND m.user_id = 1 AND m.is_confirmed = 1 AND m.is_banned = 0
SELECT SUM(unread_count) FROM wp_bp_messages_recipients WHERE user_id = 1 AND is_deleted = 0 AND sender_only = 0
SELECT option_value FROM wp_options WHERE option_name = '_transient_timeout__bbp_activation_redirect' LIMIT 1
SELECT autoload FROM wp_options WHERE option_name = '_transient__bbp_activation_redirect'
SELECT autoload FROM wp_options WHERE option_name = '_transient_timeout__bbp_activation_redirect'
SELECT option_value FROM wp_options WHERE option_name = '_bbp_settings_integration' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = '_transient_timeout__bp_activation_redirect' LIMIT 1
SELECT autoload FROM wp_options WHERE option_name = '_transient__bp_activation_redirect'
SELECT autoload FROM wp_options WHERE option_name = '_transient_timeout__bp_activation_redirect'
SELECT COUNT(*) FROM wp_bp_user_blogs

# -- Request URI: /hackathon/wp-admin/plugins.php, Time: 2013-10-16 11:05:18 ------------

SELECT option_value FROM wp_options WHERE option_name = 'wordpress_api_key' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'active_sitewide_plugins' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = '_bbp_theme_package_id' LIMIT 1
SELECT * FROM wp_users WHERE user_login = 'admin'
SELECT user_id, meta_key, meta_value FROM wp_usermeta WHERE user_id IN (1)
SELECT option_value FROM wp_options WHERE option_name = 'widget_pages' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_calendar' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_tag_cloud' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_nav_menu' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_login_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_views_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_search_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_forums_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_topics_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_replies_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_stats_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bp_core_members_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bp_core_whos_online_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bp_core_recently_active_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bp_groups_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = '_bp_force_buddybar' LIMIT 1
SELECT ID, post_name, post_parent, post_title FROM wp_posts WHERE ID IN (4,6,5) AND post_status = 'publish' 
SELECT option_name AS name, option_value AS value FROM wp_options WHERE option_name IN ( 'bp-deactivated-components', 'bb-config-location', 'bp-xprofile-base-group-name', 'bp-xprofile-fullname-field-name', 'bp-blogs-first-install', 'bp-disable-profile-sync', 'hide-loggedout-adminbar', 'bp-disable-avatar-uploads', 'bp-disable-account-deletion', 'bp-disable-blogforum-comments', '_bp_theme_package_id', 'bp_restrict_group_creation', '_bp_enable_akismet', '_bp_force_buddybar', 'registration', 'avatar_default' )
SELECT option_value FROM wp_options WHERE option_name = 'bp-blogs-first-install' LIMIT 1
SELECT value FROM wp_bp_xprofile_data WHERE field_id = 1 AND user_id = 1
SELECT * FROM wp_users WHERE ID = 1 LIMIT 1
SELECT COUNT(DISTINCT m.group_id) FROM wp_bp_groups_members m, wp_bp_groups g WHERE m.group_id = g.id AND m.user_id = 1 AND m.is_confirmed = 1 AND m.is_banned = 0
SELECT SUM(unread_count) FROM wp_bp_messages_recipients WHERE user_id = 1 AND is_deleted = 0 AND sender_only = 0
SELECT option_value FROM wp_options WHERE option_name = 'db_upgraded' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'dismissed_update_core' LIMIT 1
SELECT comment_approved, COUNT( * ) AS num_comments FROM wp_comments  GROUP BY comment_approved
SELECT option_value FROM wp_options WHERE option_name = '_bbp_settings_integration' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = '_transient_timeout__bbp_activation_redirect' LIMIT 1
SELECT autoload FROM wp_options WHERE option_name = '_transient__bbp_activation_redirect'
SELECT autoload FROM wp_options WHERE option_name = '_transient_timeout__bbp_activation_redirect'
SELECT option_value FROM wp_options WHERE option_name = '_transient_timeout__bp_activation_redirect' LIMIT 1
SELECT autoload FROM wp_options WHERE option_name = '_transient__bp_activation_redirect'
SELECT autoload FROM wp_options WHERE option_name = '_transient_timeout__bp_activation_redirect'
SELECT COUNT(*) FROM wp_bp_user_blogs
UPDATE `wp_options` SET `option_value` = 'O:8:\"stdClass\":3:{s:12:\"last_checked\";i:1381921519;s:7:\"checked\";a:6:{s:19:\"akismet/akismet.php\";s:5:\"2.5.9\";s:19:\"bbpress/bbpress.php\";s:5:\"2.4.1\";s:24:\"buddypress/bp-loader.php\";s:5:\"1.8.1\";s:9:\"hello.php\";s:3:\"1.6\";s:29:\"projectpress/projectpress.php\";s:3:\"0.1\";s:31:\"monitoraquery/monitoraquery.php\";s:10:\"2012.11.04\";}s:8:\"response\";a:0:{}}' WHERE `option_name` = '_site_transient_update_plugins'
UPDATE `wp_options` SET `option_value` = 'O:8:\"stdClass\":3:{s:12:\"last_checked\";i:1381921519;s:7:\"checked\";a:7:{s:19:\"akismet/akismet.php\";s:5:\"2.5.9\";s:19:\"bbpress/bbpress.php\";s:5:\"2.4.1\";s:24:\"buddypress/bp-loader.php\";s:5:\"1.8.1\";s:9:\"hello.php\";s:3:\"1.6\";s:27:\"p3-profiler/p3-profiler.php\";s:5:\"1.4.1\";s:29:\"projectpress/projectpress.php\";s:3:\"0.1\";s:31:\"monitoraquery/monitoraquery.php\";s:10:\"2012.11.04\";}s:8:\"response\";a:0:{}}' WHERE `option_name` = '_site_transient_update_plugins'
SELECT option_value FROM wp_options WHERE option_name = '_transient_plugin_slugs' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = '_transient_timeout_plugin_slugs' LIMIT 1
UPDATE `wp_options` SET `option_value` = '1382007920' WHERE `option_name` = '_transient_timeout_plugin_slugs'
UPDATE `wp_options` SET `option_value` = 'a:7:{i:0;s:19:\"akismet/akismet.php\";i:1;s:19:\"bbpress/bbpress.php\";i:2;s:24:\"buddypress/bp-loader.php\";i:3;s:9:\"hello.php\";i:4;s:27:\"p3-profiler/p3-profiler.php\";i:5;s:29:\"projectpress/projectpress.php\";i:6;s:31:\"monitoraquery/monitoraquery.php\";}' WHERE `option_name` = '_transient_plugin_slugs'
SELECT g.*, gm1.meta_value as total_member_count, gm2.meta_value as last_activity FROM wp_bp_groups_groupmeta gm1, wp_bp_groups_groupmeta gm2, wp_bp_groups_members m, wp_bp_groups g WHERE g.id = m.group_id AND g.id = gm1.group_id AND g.id = gm2.group_id AND gm2.meta_key = 'last_activity' AND gm1.meta_key = 'total_member_count' AND m.is_confirmed = 0 AND m.inviter_id != 0 AND m.invite_sent = 1 AND m.user_id = 1  ORDER BY m.date_modified ASC 
SELECT COUNT(DISTINCT m.group_id) FROM wp_bp_groups_members m, wp_bp_groups g WHERE m.group_id = g.id AND m.is_confirmed = 0 AND m.inviter_id != 0 AND m.invite_sent = 1 AND m.user_id = 1  ORDER BY date_modified ASC
SELECT SUM(unread_count) FROM wp_bp_messages_recipients WHERE user_id = 1 AND is_deleted = 0 AND sender_only = 0
SELECT * FROM wp_bp_notifications WHERE user_id = 1  AND is_new = 1 

# -- Request URI: /hackathon/wp-admin/plugins.php?action=deactivate&plugin=monitoraquery%2Fmonitoraquery.php&plugin_status=all&paged=1&s&_wpnonce=05a4bf833f, Time: 2013-10-16 11:05:27 ------------

SELECT option_value FROM wp_options WHERE option_name = 'wordpress_api_key' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'active_sitewide_plugins' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = '_bbp_theme_package_id' LIMIT 1
SELECT * FROM wp_users WHERE user_login = 'admin'
SELECT user_id, meta_key, meta_value FROM wp_usermeta WHERE user_id IN (1)
SELECT option_value FROM wp_options WHERE option_name = 'widget_pages' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_calendar' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_tag_cloud' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_nav_menu' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_login_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_views_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_search_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_forums_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_topics_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_replies_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bbp_stats_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bp_core_members_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bp_core_whos_online_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bp_core_recently_active_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'widget_bp_groups_widget' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = '_bp_force_buddybar' LIMIT 1
SELECT ID, post_name, post_parent, post_title FROM wp_posts WHERE ID IN (4,6,5) AND post_status = 'publish' 
SELECT option_name AS name, option_value AS value FROM wp_options WHERE option_name IN ( 'bp-deactivated-components', 'bb-config-location', 'bp-xprofile-base-group-name', 'bp-xprofile-fullname-field-name', 'bp-blogs-first-install', 'bp-disable-profile-sync', 'hide-loggedout-adminbar', 'bp-disable-avatar-uploads', 'bp-disable-account-deletion', 'bp-disable-blogforum-comments', '_bp_theme_package_id', 'bp_restrict_group_creation', '_bp_enable_akismet', '_bp_force_buddybar', 'registration', 'avatar_default' )
SELECT option_value FROM wp_options WHERE option_name = 'bp-blogs-first-install' LIMIT 1
SELECT value FROM wp_bp_xprofile_data WHERE field_id = 1 AND user_id = 1
SELECT * FROM wp_users WHERE ID = 1 LIMIT 1
SELECT COUNT(DISTINCT m.group_id) FROM wp_bp_groups_members m, wp_bp_groups g WHERE m.group_id = g.id AND m.user_id = 1 AND m.is_confirmed = 1 AND m.is_banned = 0
SELECT SUM(unread_count) FROM wp_bp_messages_recipients WHERE user_id = 1 AND is_deleted = 0 AND sender_only = 0
SELECT option_value FROM wp_options WHERE option_name = 'db_upgraded' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = 'dismissed_update_core' LIMIT 1
SELECT comment_approved, COUNT( * ) AS num_comments FROM wp_comments  GROUP BY comment_approved
SELECT option_value FROM wp_options WHERE option_name = '_bbp_settings_integration' LIMIT 1
SELECT option_value FROM wp_options WHERE option_name = '_transient_timeout__bbp_activation_redirect' LIMIT 1
SELECT autoload FROM wp_options WHERE option_name = '_transient__bbp_activation_redirect'
SELECT autoload FROM wp_options WHERE option_name = '_transient_timeout__bbp_activation_redirect'
SELECT option_value FROM wp_options WHERE option_name = '_transient_timeout__bp_activation_redirect' LIMIT 1
SELECT autoload FROM wp_options WHERE option_name = '_transient__bp_activation_redirect'
SELECT autoload FROM wp_options WHERE option_name = '_transient_timeout__bp_activation_redirect'
SELECT COUNT(*) FROM wp_bp_user_blogs
UPDATE `wp_options` SET `option_value` = 'a:3:{i:0;s:19:\"bbpress/bbpress.php\";i:1;s:24:\"buddypress/bp-loader.php\";i:3;s:29:\"projectpress/projectpress.php\";}' WHERE `option_name` = 'active_plugins'
UPDATE `wp_options` SET `option_value` = 'a:1:{s:31:\"monitoraquery/monitoraquery.php\";i:1381921528;}' WHERE `option_name` = 'recently_activated'