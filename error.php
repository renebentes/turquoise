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
$doc = JFactory::getDocument();

if ($this->error->getCode() == 404) :
  $doc->setTitle($app->getCfg('sitename') . ' - ' . JText::_('TPL_TURQUOISE_TITLE_ERROR_PAGE_NOT_FOUND'));
elseif ($this->error->getCode() == 403) :
  $doc->setTitle($app->getCfg('sitename') . ' - ' . JText::_('TPL_TURQUOISE_TITLE_ERROR_FORBIDDEN'));
else :
  $doc->setTitle($app->getCfg('sitename') . ' - ' . JText::_('TPL_TURQUOISE_TITLE_ERROR_SERVER_BUSY'));
endif;

// Additional stylesheets and javascripts
$doc->addStylesheet($this->path . '/css/error.css');

$debug = JFactory::getConfig()->get('debug_lang');
if ((defined('JDEBUG') && JDEBUG) || $debug) :
  $doc->addStylesheet($this->baseurl . '/media/cms/css/debug.css');
endif;

?>

<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
  <?php echo $doc->getBuffer('head', 'head'); ?>
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
    <header class="wrap-header">
      <div class="header">
        <div class="container">
          <div class="row">
            <div class="col-md-2">
              <a class="hasTooltip" href="<?php echo JUri::root(); ?>" rel="tooltip" data-original-title="<?php echo $app->getCfg('sitename'); ?>">
                <?php echo tplTurquoiseHelper::getLogo($this); ?>
              </a>
            </div>
            <div class="col-md-7">
              <h1><?php echo $this->params->get('name'); ?></h1>
            <?php if ($this->params->get('slogan')) : ?>
              <p class="lead"><?php echo $this->params->get('slogan'); ?></p>
            <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </header>
    <main id="content" class="container">
      <div class="row">
        <div class="col-md-6 col-md-offset-3 text-center">
          <h2><?php echo $this->error->getCode(); ?></h2>
          <h4><?php echo $this->error->getCode() == 404 ? JText::_('JERROR_LAYOUT_PAGE_NOT_FOUND') : $this->error->getMessage(); ?></h4>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <?php $module = JModuleHelper::getModule('search');
          if(isset($module->position)) {
            $module->position = $module->position == 'search' ? 'error' : $module->position;
            echo JModuleHelper::renderModule($module);
          } ?>

          <ul class="nav nav-pills nav-justified">
            <li><a href="<?php echo JUri::root(); ?>"><i class="glyphicon glyphicon-home"></i> <?php echo JText::_('JERROR_LAYOUT_HOME_PAGE'); ?></a></li>
            <li><a href="mailto:webmaster@8bec.eb.mil.br"><i class="glyphicon glyphicon-envelope"></i> <?php echo JText::_('TPL_TURQUOISE_ERROR_LAYOUT_CONTACT_WEBMASTER'); ?></a></li>
          </ul>
        </div>
      </div>
    </main>
  <?php if ($doc->countModules('footermenu') || $doc->countModules('footer') || $doc->countModules('copyright')) : ?>
    <footer class="wrap-footer">
      <div class="container">
      <?php if ($doc->countModules('footer')) : ?>
        <?php echo $doc->getBuffer('modules', 'footer', array('name' => 'footer', 'style' => 'column')); ?>
      <?php endif; ?>
      </div>
    <?php if ($doc->countModules('copyright')) : ?>
      <div class="footer-bottom">
        <div class="container">
          <?php echo $doc->getBuffer('modules', 'copyright', array('name' => 'copyright', 'style' => 'column')); ?>
        </div>
      </div>
    <?php endif; ?>
    <?php if ($doc->countModules('footermenu')) : ?>
      <?php echo $doc->getBuffer('modules', 'footer-menu', array('name' => 'footer-menu', 'style' => 'none')); ?>
    <?php endif; ?>
    </footer>
  <?php endif; ?>
    <?php echo $doc->getBuffer('modules', 'debug', array('name' => 'debug', 'style' => 'none')); ?>
    <a href="#" class="btn btn-primary btn-lg scroll-top" role="button"><i class="glyphicon glyphicon-chevron-up"></i></a>
  </body>
</html>