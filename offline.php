<?php
/**
 * @package     Turquoise
 * @subpackage  tpl_turquoise
 * @copyright   Copyright (C) 2014 Rene Bentes Pinto, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access.
defined('_JEXEC') or die('Restricted access!');

include_once JPATH_THEMES . '/' . $this->template . '/helper.php';
tplTurquoiseHelper::init($this);

$app = JFactory::getApplication();

// Additional stylesheets and javascripts
JFactory::getDocument()->addStyleSheet($this->path . '/css/offline.css?v=1');

?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
  <head>
    <jdoc:include type="head" />
    <!--[if lt IE 9]>
    <?php if ($this->params->get('load') == 'remote') : ?>
      <script src="http://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.min.js" type="text/javascript"></script>
      <script src="http://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js" type="text/javascript"></script>
    <?php else : ?>
      <script src="<?php echo $this->path; ?>/js/html5shiv.min.js" type="text/javascript"></script>
      <script src="<?php echo $this->path; ?>/js/respond.min.js" type="text/javascript"></script>
    <?php endif; ?>
    <![endif]-->
  </head>
  <body>
    <a href="#content" class="sr-only">Skip to content</a>
    <main id="content" class="container">
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <div class="alert alert-info">
          <?php if ($app->getCfg('offline_image')) : ?>
            <img class="img-responsive pull-left" src="<?php echo $app->getCfg('offline_image'); ?>" alt="<?php echo $app->getCfg('sitename'); ?>" />
          <?php endif; ?>
          <?php if ($app->getCfg('display_offline_message', 1) == 1 && str_replace(' ', '', $app->getCfg('offline_message')) != ''): ?>
            <p class="text-center"><?php echo $app->getCfg('offline_message'); ?></p>
          <?php elseif ($app->getCfg('display_offline_message', 1) == 2 && str_replace(' ', '', JText::_('JOFFLINE_MESSAGE')) != ''): ?>
            <p class="text-center"><?php echo JText::_('JOFFLINE_MESSAGE'); ?></p>
          <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 col-md-offset-4">
        <?php if(tplTurquoiseHelper::isNewJoomla()) : ?>
          <jdoc:include type="message" />
        <?php else :
          tplTurquoiseHelper::renderMessages();
        endif; ?>
          <form action="<?php echo JRoute::_('index.php', true); ?>" method="post" name="login" role="form">
            <div class="form-group">
              <label for="username" class="sr-only"><?php echo JText::_('JGLOBAL_USERNAME'); ?></label>
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="glyphicon glyphicon-user hasTooltip" data-original-title="<?php echo JText::_('JGLOBAL_USERNAME') ?>"></i>
                </span>
                <input type="text" name="username" id="username" class="form-control" placeholder="<?php echo JText::_('JGLOBAL_USERNAME'); ?>" size="18" autofocus />
              </div>
            </div>
            <div class="form-group">
              <label for="password" class="sr-only"><?php echo JText::_('JGLOBAL_PASSWORD'); ?></label>
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="glyphicon glyphicon-lock hasTooltip" data-original-title="<?php echo JText::_('JGLOBAL_PASSWORD') ?>"></i>
                </span>
                <input type="password" name="password" id="password" class="form-control" placeholder="<?php echo JText::_('JGLOBAL_PASSWORD'); ?>" />
              </div>
            </div>
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="remember" value="yes" />
                  <?php echo JText::_('JGLOBAL_REMEMBER_ME'); ?>
                </label>
              </div>
            </div>
            <div class="form-group">
              <button class="btn btn-primary btn-lg btn-block" type="submit"><?php echo JText::_('JLOGIN'); ?></button>
              <input type="hidden" name="option" value="com_users" />
              <input type="hidden" name="task" value="user.login" />
              <input type="hidden" name="return" value="<?php echo base64_encode(JURI::base()); ?>" />
              <?php echo JHTML::_('form.token'); ?>
            </div>
          </form>
        </div>
      </div>
    </main>
  </body>
</html>