<?php
/**
 * @package     Turquoise
 * @subpackage  tpl_turquoise
 * @copyright   Copyright (C) 2014 Rene Bentes Pinto, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access.
defined('_JEXEC') or die;

$doc = JFactory::getDocument();

JHtml::_('behavior.keepalive');
?>

<?php if ($module->position == 'login') : ?>
  <ul class="nav navbar-nav navbar-right">
  <?php $usersConfig = JComponentHelper::getParams('com_users');
  if ($type == 'login' && $usersConfig->get('allowUserRegistration')) : ?>
    <li>
      <a href="<?php echo JRoute::_('index.php?option=com_users&view=registration'); ?>">
        <i class="glyphicon glyphicon-plus-sign"></i>
        <?php echo JText::_('MOD_LOGIN_REGISTER'); ?>
      </a>
    </li>
  <?php endif; ?>
    <li class="dropdown">
      <a  href="#" class="dropdown-toggle" data-toggle="dropdown">
    <?php if ($type == 'logout') : ?>
        <i class="glyphicon glyphicon-user"></i>
        <?php require JModuleHelper::getLayoutPath('mod_login', 'default_greeting'); ?>
        <i class="caret"></i>
      </a>
      <ul class="dropdown-menu">
      <?php if ($doc->countModules('usermenu')) : ?>
          <?php $renderer = $doc->loadRenderer('modules');
          echo $renderer->render('usermenu', array('style' => 'usermenu'), null); ?>
        <li class="divider"></li>
      <?php endif; ?>
        <li>
          <?php require JModuleHelper::getLayoutPath('mod_login', 'default_logout'); ?>
        </li>
      </ul>
    <?php else : ?>
        <i class="glyphicon glyphicon-user"></i>
        <?php echo JText::_('JLOGIN') ?>
        <i class="caret"></i>
      </a>
      <ul class="dropdown-menu">
        <li>
          <?php require JModuleHelper::getLayoutPath('mod_login', 'default_login'); ?>
        </li>
      </ul>
  <?php endif; ?>
    </li>
  </ul>
<?php else :
  if ($type == 'logout') :
    require JModuleHelper::getLayoutPath('mod_login', 'default_greeting');
    require JModuleHelper::getLayoutPath('mod_login', 'default_logout');
  else :
    require JModuleHelper::getLayoutPath('mod_login', 'default_login');
  endif; ?>
<?php endif; ?>