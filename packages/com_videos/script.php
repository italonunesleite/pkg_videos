<?php
/**
 * @package     Videos
 * @subpackage  com_videos
 *
 * @author      Bruno Batista <bruno.batista@ctis.com.br>
 * @copyright   Copyright (C) 2013 CTIS IT Services. All rights reserved.
 * @license     Commercial License
 */

// No direct access.
defined('_JEXEC') or die;

/**
 * Script file of Videos Component.
 *
 * @package     Videos
 * @subpackage  com_videos
 * @author      Bruno Batista <bruno.batista@ctis.com.br>
 * @since       3.2
 */
class Com_VideosInstallerScript
{
	/**
	 * Called after any type of action.
	 *
	 * @param   string            $route    Which action is happening (install|uninstall|discover_install).
	 * @param   JAdapterInstance  $adapter  The object responsible for running this script.
	 *
	 * @return  boolean  True on success.
	 *
	 * @since   3.2
	 */
	public function postflight($route, JAdapterInstance $adapter)
	{
		// Adding content_type for videos.
		$table = JTable::getInstance('Contenttype', 'JTable');

		if (!$table->load(array('type_alias' => 'com_videos.video')))
		{
			$common = new stdClass;
			$common->core_content_item_id = 'id';
			$common->core_title           = 'title';
			$common->core_state           = 'published';
			$common->core_alias           = 'alias';
			$common->core_created_time    = 'created';
			$common->core_modified_time   = 'modified';
			$common->core_body            = 'description';
			$common->core_hits            = 'hits';
			$common->core_publish_up      = 'publish_up';
			$common->core_publish_down    = 'publish_down';
			$common->core_access          = 'access';
			$common->core_params          = 'params';
			$common->core_featured        = 'featured';
			$common->core_metadata        = 'metadata';
			$common->core_language        = 'language';
			$common->core_images          = 'null';
			$common->core_urls            = 'link';
			$common->core_version         = 'version';
			$common->core_ordering        = 'ordering';
			$common->core_metakey         = 'metakey';
			$common->core_metadesc        = 'metadesc';
			$common->core_catid           = 'catid';
			$common->core_xreference      = 'xreference';
			$common->asset_id             = 'asset_id';

			$field_mappings = new stdClass;
			$field_mappings->common[] = $common;
			$field_mappings->special  = array();

			$special = new stdClass;
			$special->dbtable = '#__videos';
			$special->key     = 'id';
			$special->type    = 'Video';
			$special->prefix  = 'VideosTable';
			$special->config  = 'array()';

			$common = new stdClass;
			$common->dbtable  = '#__ucm_content';
			$common->key      = 'ucm_id';
			$common->type     = 'Corecontent';
			$common->prefix   = 'JTable';
			$common->config   = 'array()';

			$table_object = new stdClass;
			$table_object->special = $special;
			$table_object->common  = $common;

			$contenttype['type_title']     = 'Video';
			$contenttype['type_alias']     = 'com_videos.video';
			$contenttype['table']          = json_encode($table_object);
			$contenttype['rules']          = '';
			$contenttype['field_mappings'] = json_encode($field_mappings);
			$contenttype['router']         = 'VideosHelperRoute::getVideoRoute';

			$table->save($contenttype);
		}

		// Adding content_type for videos category.
		$table = JTable::getInstance('Contenttype', 'JTable');

		if (!$table->load(array('type_alias' => 'com_videos.category')))
		{
			$common = new stdClass;
			$common->core_content_item_id = 'id';
			$common->core_title           = 'title';
			$common->core_state           = 'published';
			$common->core_alias           = 'alias';
			$common->core_created_time    = 'created_time';
			$common->core_modified_time   = 'modified_time';
			$common->core_body            = 'description';
			$common->core_hits            = 'hits';
			$common->core_publish_up      = null;
			$common->core_publish_down    = null;
			$common->core_access          = 'access';
			$common->core_params          = 'params';
			$common->core_featured        = null;
			$common->core_metadata        = 'metadata';
			$common->core_language        = 'language';
			$common->core_images          = null;
			$common->core_urls            = null;
			$common->core_version         = 'version';
			$common->core_ordering        = null;
			$common->core_metakey         = 'metakey';
			$common->core_metadesc        = 'metadesc';
			$common->core_catid           = 'parent_id';
			$common->core_xreference      = null;
			$common->asset_id             = 'asset_id';

			$field_mappings = new stdClass;
			$field_mappings->common[] = $common;
			$field_mappings->special  = array();

			$special = new stdClass;
			$special->dbtable = '#__categories';
			$special->key     = 'id';
			$special->type    = 'Category';
			$special->prefix  = 'JTable';
			$special->config  = 'array()';

			$common = new stdClass;
			$common->dbtable  = '#__ucm_content';
			$common->key      = 'ucm_id';
			$common->type     = 'Corecontent';
			$common->prefix   = 'JTable';
			$common->config   = 'array()';

			$table_object = new stdClass;
			$table_object->special = $special;
			$table_object->common  = $common;

			$contenttype['type_title']     = 'Video Category';
			$contenttype['type_alias']     = 'com_videos.category';
			$contenttype['table']          = json_encode($table_object);
			$contenttype['rules']          = '';
			$contenttype['field_mappings'] = json_encode($field_mappings);
			$contenttype['router']         = 'VideosHelperRoute::getCategoryRoute';

			$table->save($contenttype);
		}
	}

	/**
	 * Called on installation.
	 *
	 * @param   JAdapterInstance  $adapter  The object responsible for running this script.
	 *
	 * @return  boolean  True on success.
	 *
	 * @since   3.2
	 */
	public function install(JAdapterInstance $adapter)
	{
		// Set the redirect location.
		$adapter->getParent()->setRedirectURL('index.php?option=com_videos');
	}

	/**
	 * Called on uninstallation.
	 *
	 * @param   JAdapterInstance  $adapter  The object responsible for running this script.
	 *
	 * @return  boolean  True on success.
	 *
	 * @since   3.2
	 */
	public function uninstall(JAdapterInstance $adapter)
	{
		echo '<p>' . JText::_('COM_VIDEOS_UNINSTALL_TEXT') . '</p>';
	}
}
