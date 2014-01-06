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

foreach ($this->form->getGroup('video') as $field)
{
	$classnames = 'control-group';
	$rel        = '';
	$showon     = $this->form->getFieldAttribute($field->fieldname, 'showon', null, 'video');

	if (!empty($showon))
	{
		JHtml::_('jquery.framework');
		JHtml::_('script', 'jui/cms.js', false, true);

		$id         = $this->form->getFormControl();
		$showon     = explode(':', $showon, 2);
		$classnames .= ' showon_' . implode(' showon_', explode(',', $showon[1]));
		$rel        = ' rel="showon_' . $id . '[video][' . $showon[0] . ']"';
	}
?>
	<div class="<?php echo $classnames; ?>"<?php echo $rel; ?>>
		<?php if (!$field->hidden) : ?>
			<div class="control-label">
				<?php echo $field->label; ?>
			</div>
		<?php endif; ?>
		<div class="controls">
			<?php echo $field->input; ?>
		</div>
	</div>
<?php
}
