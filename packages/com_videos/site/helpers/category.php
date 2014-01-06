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
 * Videos Component Category Tree.
 *
 * @static
 * @package     Videos
 * @subpackage  com_videos
 * @author      Bruno Batista <bruno@atomtech.com.br>
 * @since       3.2
 */
class VideosCategories extends JCategories
{
	/**
	 * Class constructor.
	 *
	 * @param   array  $options  Array of options.
	 *
	 * @since   3.2
	 */
	public function __construct($options = array())
	{
		$options['table']     = '#__videos';
		$options['extension'] = 'com_videos';

		parent::__construct($options);
	}
}
