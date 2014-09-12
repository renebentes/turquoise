<?php
/**
 * @package     Turquoise
 * @subpackage  tpl_turquoise
 * @copyright   Copyright (C) 2014 Rene Bentes Pinto, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access.
defined('_JEXEC') or die('Restricted access!');

$params = $displayData['params'];
$item   = $displayData['item'];
?>
<p class="readmore">
  <a class="pull-left" href="<?php echo $displayData['link']; ?>" itemprop="url">
    <span class="fa fa-arrow-circle-right"></span>
  <?php if (!$params->get('access-view')) :
    echo JText::_('COM_CONTENT_REGISTER_TO_READ_MORE');
  elseif ($readmore = $item->alternative_readmore) :
    echo $readmore;
    if ($params->get('show_readmore_title', 0) != 0) :
      echo JHtml::_('string.truncate', $item->title, $params->get('readmore_limit'));
    endif;
  elseif ($params->get('show_readmore_title', 0) == 0) :
    echo JText::sprintf('COM_CONTENT_READ_MORE_TITLE');
  else :
    echo JText::_('COM_CONTENT_READ_MORE');
    echo JHtml::_('string.truncate', $item->title, $params->get('readmore_limit'));
  endif; ?>
  </a>
</p>