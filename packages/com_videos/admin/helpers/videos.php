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

/**
 * Videos helper.
 *
 * @package     Videos
 * @subpackage  com_videos
 * @author      Bruno Batista <bruno@atomtech.com.br>
 * @since       3.2
 */
class VideosHelper extends JHelperContent
{
	/**
	 * Configure the Linkbar.
	 *
	 * @param   string  $vName  The name of the active view.
	 *
	 * @return  void
	 *
	 * @since   3.2
	 */
	public static function addSubmenu($vName)
	{
		JHtmlSidebar::addEntry(
			JText::_('COM_VIDEOS_SUBMENU_VIDEOS'),
			'index.php?option=com_videos&view=videos',
			$vName == 'videos'
		);

		JHtmlSidebar::addEntry(
			JText::_('COM_VIDEOS_SUBMENU_CATEGORIES'),
			'index.php?option=com_categories&extension=com_videos',
			$vName == 'categories'
		);

		JHtmlSidebar::addEntry(
			JText::_('COM_VIDEOS_SUBMENU_FEATURED'),
			'index.php?option=com_videos&view=featured',
			$vName == 'featured'
		);
	}

	/**
	 * Gets a list of the actions that can be performed.
	 *
	 * @param   integer  $categoryId  The category ID.
	 * @param   integer  $id          The item ID.
	 * @param   string   $assetName   The asset name.
	 *
	 * @return  JObject  A JObject containing the allowed actions.
	 *
	 * @since   3.2
	 */
	public static function getActions($categoryId = 0, $id = 0, $assetName = '')
	{
		// Initialiase variables.
		$user   = JFactory::getUser();
		$result = new JObject;
		$path   = JPATH_ADMINISTRATOR . '/components/' . $assetName . '/access.xml';

		if (empty($id) && empty($categoryId))
		{
			$section = 'component';
		}
		elseif (empty($id))
		{
			$section = 'category';
			$assetName .= '.category.' . (int) $categoryId;
		}
		else
		{
			$section = 'video';
			$assetName .= '.video.' . (int) $id;
		}

		$actions = JAccess::getActionsFromFile($path, "/access/section[@name='" . $section . "']/");

		foreach ($actions as $action)
		{
			$result->set($action->name, $user->authorise($action->name, $assetName));
		}

		return $result;
	}

	/**
	 * Method to get the video thumbnails.
	 *
	 * @param   string  $url   The url of video to get thumbnails.
	 * @param   string  $size  The size of image. [default|medium|high|standard|max]
	 *
	 * @return  mixed  If have size return the image url, or array with all sizes.
	 *
	 * @since   3.2
	 */
	public static function getVideoThumbnails($url, $size = null)
	{
		// Initialiase variables.
		$id = self::getYouTubeIdFromURL($url);

		if (!isset($id))
		{
			return false;
		}

		$thumbnails = array(
			'default'  => 'https://i1.ytimg.com/vi/' . $id . '/default.jpg',
			'medium'   => 'https://i1.ytimg.com/vi/' . $id . '/mqdefault.jpg',
			'high'     => 'https://i1.ytimg.com/vi/' . $id . '/hqdefault.jpg',
			'standard' => 'https://i1.ytimg.com/vi/' . $id . '/sddefault.jpg',
			'max'      => 'https://i1.ytimg.com/vi/' . $id . '/maxresdefault.jpg',
		);

		if ($size)
		{
			return $thumbnails[$size];
		}

		return $thumbnails;
	}

	/**
	 * Method to get the video id.
	 *
	 * @param   string  $url  The url from youtube.
	 *
	 * @return  mixed
	 *
	 * @since   3.2
	 */
	public static function getYouTubeIdFromURL($url)
	{
		// Initialiase variables.
		$pattern = '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i';

		preg_match($pattern, $url, $matches);

		return isset($matches[1]) ? $matches[1] : false;
	}
}
