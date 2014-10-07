<?php
/**
 * @package     Turquoise
 * @subpackage  tpl_turquoise
 * @copyright   Copyright (C) 2014 Rene Bentes Pinto, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access.
defined('_JEXEC') or die('Restricted access!');
?>
<dd class="extra-tooltip" title="<?php echo JText::_('TPL_TURQUOISE_TOOLTIP_HITS'); ?>">
  <span class="fa fa-eye fa-fw"></span>
  <?php echo $displayData['item']->hits; ?>
  <meta itemprop="interactionCount" content="UserPageVisits:<?php echo $displayData['item']->hits; ?>" />
</dd>