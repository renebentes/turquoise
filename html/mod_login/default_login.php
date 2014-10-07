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

<form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post" role="login">
<?php if ($params->get('pretext')): ?>
  <div class="pretext">
    <p><?php echo $params->get('pretext'); ?></p>
  </div>
<?php endif; ?>
  <div class="form-group">
  <?php if (!$params->get('usetext')) : ?>
    <label for="modlgn-username" class="sr-only"><?php echo JText::_('MOD_LOGIN_VALUE_USERNAME'); ?></label>
    <div class="input-group">
      <span class="input-group-addon">
        <i class="glyphicon glyphicon-user hasTooltip" title="<?php echo JText::_('MOD_LOGIN_VALUE_USERNAME') ?>"></i>
      </span>
      <input id="modlgn-username" type="text" name="username" class="form-control" size="18" placeholder="<?php echo JText::_('MOD_LOGIN_VALUE_USERNAME') ?>" />
      <span class="input-group-btn extra-tooltip" title="<?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_USERNAME'); ?>">
        <a class="btn btn-default" href="<?php echo JRoute::_('index.php?option=com_users&view=reset'); ?>">
          <i class="fa fa-question"></i>
        </a>
      </span>
    </div>
    <?php else : ?>
      <label for="modlgn-username"><?php echo JText::_('MOD_LOGIN_VALUE_USERNAME'); ?></label>
      <input id="modlgn-username" type="text" name="username" class="form-control" size="18" placeholder="<?php echo JText::_('MOD_LOGIN_VALUE_USERNAME') ?>" />
    <?php endif; ?>
  </div>
  <div class="form-group">
  <?php if(!$params->get('usetext')) : ?>
    <label for="modlgn-passwd" class="sr-only"><?php echo JText::_('JGLOBAL_PASSWORD'); ?></label>
    <div class="input-group">
      <span class="input-group-addon">
        <i class="glyphicon glyphicon-lock hasTooltip" title="<?php echo JText::_('JGLOBAL_PASSWORD') ?>"></i>
      </span>
      <input id="modlgn-passwd" type="password" name="password" class="form-control" size="18"  placeholder="<?php echo JText::_('JGLOBAL_PASSWORD') ?>" />
      <span class="input-group-btn extra-tooltip" title="<?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_PASSWORD'); ?>">
        <a class="btn btn-default" href="<?php echo JRoute::_('index.php?option=com_users&view=remind'); ?>">
          <i class="fa fa-question"></i>
        </a>
      </span>
    </div>
  <?php else : ?>
    <label for="modlgn-passwd"><?php echo JText::_('JGLOBAL_PASSWORD'); ?></label>
    <input id="modlgn-passwd" type="password" name="password" class="form-control" size="18"  placeholder="<?php echo JText::_('JGLOBAL_PASSWORD') ?>" />
  <?php endif; ?>
  </div>
  <?php if (count($twofactormethods) > 1) : ?>
    <div class="form-group">
    <?php if (!$params->get('usetext')) : ?>
      <label for="modlgn-secretkey" class="sr-only"><?php echo JText::_('JGLOBAL_SECRETKEY') ?></label>
      <div class="input-group">
        <span class="input-group-addon">
          <i class="fa fa-key hasTooltip" title="<?php echo JText::_('JGLOBAL_SECRETKEY') ?>"></i>
        </span>
        <input id="modlgn-secretkey" autocomplete="off" type="text" name="secretkey" class="form-control" size="18" placeholder="<?php echo JText::_('JGLOBAL_SECRETKEY') ?>" />
        <span class="input-group-addon extra-tooltip" title="<?php echo JText::_('JGLOBAL_SECRETKEY_HELP'); ?>">
          <i class="fa fa-question"></i>
        </span>
      </div>
    <?php else : ?>
      <label for="modlgn-secretkey"><?php echo JText::_('JGLOBAL_SECRETKEY') ?></label>
      <div class="input-group">
        <input id="modlgn-secretkey" autocomplete="off" type="text" name="secretkey" class="form-control" size="18" placeholder="<?php echo JText::_('JGLOBAL_SECRETKEY') ?>" />
        <span class="input-group-addon extra-tooltip" title="<?php echo JText::_('JGLOBAL_SECRETKEY_HELP'); ?>">
          <i class="fa fa-question"></i>
        </span>
      </div>
    <?php endif; ?>
    </div>
  <?php endif; ?>
<?php if (JPluginHelper::isEnabled('system', 'remember')) : ?>
  <div class="checkbox">
    <label for="modlgn-remember">
      <input id="modlgn-remember" type="checkbox" name="remember" value="yes"/>
      <?php echo JText::_('MOD_LOGIN_REMEMBER_ME') ?>
    </label>
  </div>
<?php endif; ?>
  <button type="submit" name="Submit" class="btn btn-primary pull-right">
    <i class="glyphicon glyphicon-log-in"></i>
    <?php echo JText::_('JLOGIN') ?>
  </button>
  <input type="hidden" name="option" value="com_users" />
  <input type="hidden" name="task" value="user.login" />
  <input type="hidden" name="return" value="<?php echo $return; ?>" />
  <?php echo JHtml::_('form.token'); ?>
<?php if ($params->get('posttext')): ?>
  <div class="posttext">
    <p><?php echo $params->get('posttext'); ?></p>
  </div>
<?php endif; ?>
</form>