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

// Load the tabstate behavior script.
JHtml::_('behavior.tabstate');

// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_videos'))
{
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

// Register dependent classes.
JLoader::register('VideosHelper', __DIR__ . '/helpers/videos.php');

// Execute the task.
$controller = JControllerLegacy::getInstance('Videos');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
