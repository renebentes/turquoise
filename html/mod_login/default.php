<?php
/**
 * @package     Turquoise
 * @subpackage  tpl_turquoise
 * @copyright   Copyright (C) 2014 Rene Bentes Pinto, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access.
defined('_JEXEC') or die('Restricted access!');

require_once JPATH_SITE . '/components/com_users/helpers/route.php';

JHtml::_('behavior.keepalive');
?>

<?php if ($module->position == 'login') : ?>
  <ul class="nav navbar-nav navbar-right">
  <?php $usersConfig = JComponentHelper::getParams('com_users');
  if ($usersConfig->get('allowUserRegistration')) : ?>
    <li>
      <a href="<?php echo JRoute::_('index.php?option=com_users&view=registration'); ?>">
        <span class="glyphicon glyphicon-plus-sign"></span>
        <?php echo JText::_('MOD_LOGIN_REGISTER'); ?>
      </a>
    </li>
  <?php endif; ?>
    <li class="dropdown">
      <a  href="#" class="dropdown-toggle" data-toggle="dropdown">
        <span class="glyphicon glyphicon-user"></span>
        <?php echo JText::_('JLOGIN') ?>
        <span class="caret"></span>
      </a>
      <ul class="dropdown-menu" role="menu">
        <li>
          <?php require JModuleHelper::getLayoutPath('mod_login', 'default_login'); ?>
        </li>
      </ul>
    </li>
  </ul>
<?php else :
  require JModuleHelper::getLayoutPath('mod_login', 'default_login');
endif; ?>