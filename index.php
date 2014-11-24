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

// Check width of the front-end
if ($this->countModules('left') && $this->countModules('right')) :
  $col = 6;
elseif ($this->countModules('left') || $this->countModules('right')) :
  $col = 9;
else :
  $col = 12;
endif;

?>

<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
  <head>
    <jdoc:include type="head" />

    <!--[if lt IE 9]>
      <script src="<?php echo $this->path; ?>/js/html5shiv.min.js" type="text/javascript"></script>
      <script src="<?php echo $this->path; ?>/js/respond.min.js" type="text/javascript"></script>
    <![endif]-->
  </head>
  <body<?php echo tplTurquoiseHelper::getPageClass(); ?> role="document">
    <a href="#content" class="sr-only">Skip to content</a>
    <header class="wrap-header">
    <?php if ($this->countModules('topmenu') || $this->countModules('login') || $this->countModules('search')) : ?>
      <nav class="navbar navbar-blue-transparent navbar-sm" role="navigation">
        <div class="container">
        <?php if ($this->countModules('topmenu')) : ?>
          <jdoc:include type="modules" name="topmenu" style="none" />
        <?php endif; ?>
        <?php if ($this->countModules('search')) : ?>
          <div class="col-md-3 navbar-right">
            <jdoc:include type="modules" name="search" style="none" />
          </div>
        <?php endif; ?>
        <?php if ($this->countModules('login')) : ?>
          <jdoc:include type="modules" name="login" style="none" />
        <?php endif; ?>
        </div>
      </nav>
    <?php endif;?>
      <div class="header container">
        <div class="row">
          <div class="col-md-2 visible-md visible-lg">
            <a class="hasTooltip" href="<?php echo JUri::root(); ?>" rel="tooltip" data-original-title="<?php echo JFactory::getApplication()->getCfg('sitename'); ?>">
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
    </header>
  <?php if ($this->countModules('submenu')) : ?>
    <jdoc:include type="modules" name="submenu" style="navbar" />
  <?php endif; ?>
  <?php if ($this->countModules('breadcrumbs')) : ?>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <jdoc:include type="modules" name="breadcrumbs" style="none" />
        </div>
      </div>
    </div>
  <?php endif; ?>
    <main id="content" class="container">
      <div class="row">
      <?php if ($this->countModules('left')) : ?>
        <div class="col-md-3">
          <jdoc:include type="modules" name="left" style="well" />
        </div>
      <?php endif; ?>
        <div class="col-md-<?php echo $col; ?>">
        <?php tplTurquoiseHelper::renderMessages(); ?>
        <?php if (tplTurquoiseHelper::isFrontpage() && $this->countModules('featured')) : ?>
          <jdoc:include type="modules" name="featured" style="row" />
        <?php endif; ?>
          <div class="row">
            <div class="col-md-12">
              <jdoc:include type="component" />
            </div>
          </div>
          <jdoc:include type="modules" name="bellow" style="row" />
        </div>
      <?php if ($this->countModules('right')) : ?>
        <div class="col-md-3">
          <jdoc:include type="modules" name="right" style="standard" />
        </div>
      <?php endif; ?>
      </div>
    </main>
  <?php if ($this->countModules('footermenu') || $this->countModules('footer') || $this->countModules('copyright')) : ?>
    <footer class="wrap-footer">
    <?php if ($this->countModules('footer')) : ?>
      <div class="container">
        <jdoc:include type="modules" name="footer" style="column" />
      </div>
    <?php endif; ?>
    <?php if ($this->countModules('copyright')) : ?>
      <div class="footer-bottom">
        <div class="container">
          <jdoc:include type="modules" name="copyright" style="column" />
        </div>
      </div>
    <?php endif; ?>
    <?php if ($this->countModules('footermenu')) : ?>
      <jdoc:include type="modules" name="footermenu" style="none" />
    <?php endif; ?>
    </footer>
  <?php endif; ?>
    <a href="#" class="btn btn-primary btn-lg scroll-top" role="button"><i class="glyphicon glyphicon-chevron-up"></i></a>
    <jdoc:include type="modules" name="debug" />
  </body>
</html>