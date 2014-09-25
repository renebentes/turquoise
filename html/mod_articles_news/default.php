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

<div class="newsflash list-unstyled">
  <?php foreach ($list as $item) :?>
  <?php
   require JModuleHelper::getLayoutPath('mod_articles_news', '_item');?>
  <?php endforeach; ?>
</div>