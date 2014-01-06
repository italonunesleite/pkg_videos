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
 * Videos Component Controller.
 *
 * @package     Videos
 * @subpackage  com_videos
 * @author      Bruno Batista <bruno@atomtech.com.br>
 * @since       3.2
 */
class VideosController extends JControllerLegacy
{
	/**
	 * The default view.
	 *
	 * @var     string
	 * @since   3.2
	 */
	protected $default_view = 'videos';

	/**
	 * Method to display a view.
	 *
	 * @param   boolean  $cachable   If true, the view output will be cached.
	 * @param   array    $urlparams  An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
	 *
	 * @return  JControllerLegacy  This object to support chaining.
	 *
	 * @since   3.2
	 */
	public function display($cachable = false, $urlparams = false)
	{
		// Set the default view name and format from the Request.
		$view   = $this->input->get('view', $this->default_view);
		$layout = $this->input->get('layout', 'default', 'string');
		$id     = $this->input->getInt('id');

		// Check for edit form.
		if ($view == 'video' && $layout == 'edit' && !$this->checkEditId('com_videos.edit.video', $id))
		{
			// Somehow the person just went to the form - we do not allow that.
			$this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id));
			$this->setMessage($this->getError(), 'error');
			$this->setRedirect(JRoute::_('index.php?option=com_videos&view=videos', false));

			return false;
		}

		parent::display();

		return $this;
	}
}
