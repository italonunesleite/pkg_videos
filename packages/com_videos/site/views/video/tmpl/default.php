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

// Load the backend helper.
require_once JPATH_ADMINISTRATOR . '/components/com_videos/helpers/videos.php';

// Include the component HTML helpers.
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');

// Create shortcuts to some parameters.
$params  = $this->item->params;
$canEdit = $params->get('access-edit');
$user    = JFactory::getUser();

// Load the tooltip behavior script.
JHtml::_('behavior.caption');

// Add JavaScript Frameworks.
JHtml::_('jquery.framework');

// Load JavaScript.
JHtml::script('com_videos/jquery.fitvids.min.js', false, true);

// Get the document object.
$doc = JFactory::getDocument();

$doc->addScriptDeclaration(
	'jQuery(document).ready(function($) {
	$(\'.video-play\').fitVids();
});'
);
?>
<div class="videos video-item<?php echo $this->pageclass_sfx; ?>">
	<div class="page-header">
		<h1>
			<?php if ($this->params->get('show_page_heading', 1)): ?>
				<?php echo $this->escape($this->params->get('page_heading')); ?> /
			<?php endif; ?>
			<?php echo $this->escape($this->item->title); ?>
		</h1>
	</div>

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="video-play">
				<iframe width="750" height="422" src="//www.youtube.com/embed/<?php echo VideosHelper::getYouTubeIdFromURL($this->item->url); ?>" frameborder="0" allowfullscreen></iframe>
			</div>
		</div>
	</div>

	<?php echo $this->item->event->afterDisplayContent; ?>
</div>
