<?php
/**
 * @package     Turquoise
 * @subpackage  tpl_turquoise
 * @copyright   Copyright (C) 2014 Rene Bentes Pinto, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access.
defined('_JEXEC') or die;

require_once dirname(__FILE__) . '/helper.php';
$list = modTurquoiseArchiveHelper::getList($params);

?>

<ul class="archive-module nav nav-list">
<?php foreach ($list as $item) : ?>
  <li>
    <a href="<?php echo $item->link; ?>">
      <i class="fa fa-calendar"></i>
      <?php echo $item->text; ?>
      <span class="badge pull-right">
        <?php echo $item->count; ?>
      </span>
    </a>
  </li>
<?php endforeach; ?>
</ul>