<?php
/**
* @package   yoo_master
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// include config and layout
$base = dirname(dirname(dirname(__FILE__)));
include($base.'/config.php');

// no direct access
defined('_JEXEC') or die;

JHtml::_('behavior.framework');

$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));

// Create a shortcut for params.
$params = &$this->item->params;
?>

<?php if (empty($this->items)) : ?>
	<p><?php echo JText::_('COM_CONTACT_NO_ARTICLES'); ?></p>
<?php else : ?>

<form action="<?php echo htmlspecialchars(JFactory::getURI()->toString()); ?>" method="post" name="adminForm" id="adminForm">

	<?php if ($this->params->get('show_pagination_limit')) : ?>
	<div class="filter">
		<?php echo JText::_('JGLOBAL_DISPLAY_NUM'); ?>
		<?php echo $this->pagination->getLimitBox(); ?>
	</div>
	<?php endif; ?>

	<table class="zebra">
		<?php if ($this->params->get('show_headings')) : ?>
		<thead>
			<tr>

				<th class="item-title">
					<?php echo JHtml::_('grid.sort', 'COM_CONTACT_CONTACT_EMAIL_NAME_LABEL', 'a.name', $listDirn, $listOrder); ?>
				</th>
				
				<?php if ($this->params->get('show_position_headings')) : ?>
				<th class="item-position">
					<?php echo JHtml::_('grid.sort', 'COM_CONTACT_POSITION', 'a.con_position', $listDirn, $listOrder); ?>
				</th>
				<?php endif; ?>
				
				<?php if ($this->params->get('show_email_headings')) : ?>
				<th class="item-email">
					<?php echo JText::_('JGLOBAL_EMAIL'); ?>
				</th>
				<?php endif; ?>
				
				<?php if ($this->params->get('show_telephone_headings')) : ?>
				<th class="item-phone">
					<?php echo JText::_('COM_CONTACT_TELEPHONE'); ?>
				</th>
				<?php endif; ?>
	
				<?php if ($this->params->get('show_mobile_headings')) : ?>
				<th class="item-phone">
					<?php echo JText::_('COM_CONTACT_MOBILE'); ?>
				</th>
				<?php endif; ?>
	
				<?php if ($this->params->get('show_fax_headings')) : ?>
				<th class="item-phone">
					<?php echo JText::_('COM_CONTACT_FAX'); ?>
				</th>
				<?php endif; ?>
	
				<?php if ($this->params->get('show_suburb_headings')) : ?>
				<th class="item-suburb">
					<?php echo JHtml::_('grid.sort', 'COM_CONTACT_SUBURB', 'a.suburb', $listDirn, $listOrder); ?>
				</th>
				<?php endif; ?>
	
				<?php if ($this->params->get('show_state_headings')) : ?>
				<th class="item-state">
					<?php echo JHtml::_('grid.sort', 'COM_CONTACT_STATE', 'a.state', $listDirn, $listOrder); ?>
				</th>
				<?php endif; ?>
	
				<?php if ($this->params->get('show_country_headings')) : ?>
				<th class="item-state">
					<?php echo JHtml::_('grid.sort', 'COM_CONTACT_COUNTRY', 'a.country', $listDirn, $listOrder); ?>
				</th>
				<?php endif; ?>

			</tr>
		</thead>
		<?php endif; ?>

		<tbodys>
			<?php foreach($this->items as $i => $item) : ?>
				<tr class="<?php if ($i % 2 == 1) { echo 'even'; } else { echo 'odd'; } ?>" itemscope itemtype="http://schema.org/Person">

					<td class="item-title">
						<a href="<?php echo JRoute::_(ContactHelperRoute::getContactRoute($item->slug, $item->catid)); ?>" itemprop="url">
							<span itemprop="name"><?php echo $item->name; ?></span>
						</a>
					</td>

					<?php if ($this->params->get('show_position_headings')) : ?>
						<td class="item-position" itemprop="jobTitle">
							<?php echo $item->con_position; ?>
						</td>
					<?php endif; ?>

					<?php if ($this->params->get('show_email_headings')) : ?>
						<td class="item-email" itemprop="email">
							<?php echo $item->email_to; ?>
						</td>
					<?php endif; ?>

					<?php if ($this->params->get('show_telephone_headings')) : ?>
						<td class="item-phone" itemprop="telephone">
							<?php echo $item->telephone; ?>
						</td>
					<?php endif; ?>

					<?php if ($this->params->get('show_mobile_headings')) : ?>
						<td class="item-phone" itemprop="telephone">
							<?php echo $item->mobile; ?>
						</td>
					<?php endif; ?>

					<?php if ($this->params->get('show_fax_headings')) : ?>
					<td class="item-phone" itemprop="faxNumber">
						<?php echo $item->fax; ?>
					</td>
					<?php endif; ?>

					<?php if ($this->params->get('show_suburb_headings')) : ?>
						<td class="item-suburb" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
							<span itemprop="addressLocality"><?php echo $item->suburb; ?></span>
						</td>
					<?php endif; ?>

					<?php if ($this->params->get('show_state_headings')) : ?>
						<td class="item-state" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
							<span itemprop="addressRegion"><?php echo $item->state; ?></span>
						</td>
					<?php endif; ?>

					<?php if ($this->params->get('show_country_headings')) : ?>
						<td class="item-state" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
							<span itemprop="addressCountry"><?php echo $item->country; ?></span>
						</td>
					<?php endif; ?>

				</tr>
			<?php endforeach; ?>

		</tbody>
	</table>

	<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
	<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
</form>
<?php endif;