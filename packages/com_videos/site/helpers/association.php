<?php
/**
 * @package     Videos
 * @subpackage  com_videos
 *
 * @author      Bruno Batista <bruno@atomtech.com.br>
 * @copyright   Copyright (C) 2013 AtomTech, Inc. All rights reserved.
 * @license     Commercial License
 */

// No direct access.
defined('_JEXEC') or die;

// Register dependent classes.
JLoader::register('VideosHelper', JPATH_ADMINISTRATOR . '/components/com_videos/helpers/videos.php');
JLoader::register('CategoryHelperAssociation', JPATH_ADMINISTRATOR . '/components/com_categories/helpers/association.php');

/**
 * Videos Component Association Helper.
 *
 * @package     Videos
 * @subpackage  com_videos
 * @author      Bruno Batista <bruno@atomtech.com.br>
 * @since       3.2
 */
abstract class VideosHelperAssociation extends CategoryHelperAssociation
{
	/**
	 * Method to get the associations for a given item.
	 *
	 * @param   integer  $id    Id of the item.
	 * @param   string   $view  Name of the view.
	 *
	 * @return  array  Array of associations for the item.
	 *
	 * @since   3.2
	 */
	public static function getAssociations($id = 0, $view = null)
	{
		// Load route helper.
		jimport('helper.route', JPATH_COMPONENT_SITE);

		// Initialiase variables.
		$app  = JFactory::getApplication();
		$view = is_null($view) ? $app->input->get('view') : $view;
		$id   = empty($id) ? $app->input->getInt('id') : $id;

		if ($view == 'video')
		{
			if ($id)
			{
				$associations = JLanguageAssociations::getAssociations('com_videos', '#__videos', 'com_videos.item', $id);
				$return       = array();

				foreach ($associations as $tag => $item)
				{
					$return[$tag] = VideosHelperRoute::getVideoRoute($item->id, $item->catid, $item->language);
				}

				return $return;
			}
		}

		if ($view == 'category' || $view == 'categories')
		{
			return self::getCategoryAssociations($id, 'com_videos');
		}

		return array();
	}
}
