<?php
/**
 * @package     Turquoise
 * @subpackage  tpl_turquoise
 * @copyright   Copyright (C) 2014 Rene Bentes Pinto, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access.
defined('_JEXEC') or die('Restricted access!');

$params    = $displayData->params;
$extension = $displayData->get('category')->extension;

if ($params->get('show_page_heading')) : ?>
  <div class="page-header">
    <h1><?php echo $displayData->escape($params->get('page_heading')); ?></h1>
  </div>
<?php endif; ?>

<?php if ($params->get('show_base_description')) : ?>
  <div class="well well-sm">
  <?php if($params->get('categories_description')) : ?>
    <?php echo JHtml::_('content.prepare', $displayData->params->get('categories_description'), '',  $extension . '.categories'); ?>
  <?php else : ?>
    <?php  if ($displayData->parent->description) : ?>
        <?php echo JHtml::_('content.prepare', $displayData->parent->description, '', $displayData->parent->extension . '.categories'); ?>
    <?php endif; ?>
  <?php endif; ?>
<?php endif; ?>