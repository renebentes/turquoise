<?php
/**
 * @package     Turquoise
 * @subpackage  tpl_turquoise
 * @copyright   Copyright (C) 2014 Rene Bentes Pinto, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access.
defined('_JEXEC') or die;

?>

<form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" id="login-form" method="post" role="logout">
  <input type="hidden" name="option" value="com_users" />
  <input type="hidden" name="task" value="user.logout" />
  <input type="hidden" name="return" value="<?php echo $return; ?>" />
  <?php echo JHtml::_('form.token'); ?>
</form>
<a href="#" id="logout">
  <i class="glyphicon glyphicon-log-out"></i>
  <?php echo JText::_('JLOGOUT'); ?>
</a>