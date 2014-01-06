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
?>
<div class="videos video-list<?php echo $this->pageclass_sfx; ?>">
	<?php if ($this->params->get('show_page_heading')): ?>
		<div class="page-header">
			<h1>
				<?php echo $this->escape($this->params->get('page_heading')); ?>
			</h1>
		</div>
	<?php endif; ?>

	<div class="row">
		<?php foreach ($this->items as $item): ?>
			<div class="col-md-3">
				<div class="video-item">
					<figure>
						<a href="<?php echo JRoute::_(VideosHelperRoute::getVideoRoute($item->slug, $item->catslug)); ?>">
							<img src="<?php echo VideosHelper::getVideoThumbnails($item->url, 'medium'); ?>" alt="<?php echo $item->title; ?>">
						</a>
					</figure>
					<article>
						<h5>
							<a href="<?php echo JRoute::_(VideosHelperRoute::getVideoRoute($item->slug, $item->catslug)); ?>">
								<i class="icon-play-circle"></i> <?php echo $this->escape($item->title); ?>
							</a>
						</h5>
					</article>
				</div>
			</div>
		<?php endforeach; ?>
	</div>

	<?php if ($this->params->get('show_pagination', 1)): ?>
		<div class="pagination">
			<?php if ($this->params->def('show_pagination_results', 1)): ?>
				<p class="counter">
					<?php echo $this->pagination->getPagesCounter(); ?>
				</p>
			<?php endif; ?>
			<?php echo $this->pagination->getPagesLinks(); ?>
		</div>
	<?php endif; ?>
</div>
