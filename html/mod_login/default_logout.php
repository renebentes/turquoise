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

?>
<?php if ($module->position == 'login') : ?>
  <ul class="nav navbar-nav navbar-right">
    <li class="dropdown">
      <a  href="#" class="dropdown-toggle" data-toggle="dropdown">
        <span class="glyphicon glyphicon-user"></span>
        <?php require JModuleHelper::getLayoutPath('mod_login', 'default_greeting'); ?>
        <span class="caret"></span>
      </a>
      <ul class="dropdown-menu" role="menu">
      <?php /* if ($doc->countModules('usermenu')) : ?>
          <?php $renderer = $doc->loadRenderer('modules');
          echo $renderer->render('usermenu', array('style' => 'usermenu'), null); ?>
        <li class="divider"></li>
      <?php endif; */?>
        <li>
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
        </li>
      </ul>
    </li>
  </ul>
<?php else :
  require JModuleHelper::getLayoutPath('mod_login', 'default_greeting'); ?>
  <form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" id="login-form" method="post" role="logout">
    <input type="hidden" name="option" value="com_users" />
    <input type="hidden" name="task" value="user.logout" />
    <input type="hidden" name="return" value="<?php echo $return; ?>" />
    <?php echo JHtml::_('form.token'); ?>
  </form>
<?php endif; ?>
