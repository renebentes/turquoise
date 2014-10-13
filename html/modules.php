<?php
/**
 * @package     Turquoise
 * @subpackage  tpl_turquoise
 * @copyright   Copyright (C) 2014 Rene Bentes Pinto, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access.
defined('_JEXEC') or die('Restricted access!');

/**
 * Module chrome for rendering user menu
 */
function modChrome_usermenu($module, &$params, $attribs)
{
  $module->content = substr($module->content, 17, strlen($module->content) - 22);
  echo $module->content;
}

/**
 * Module chrome for navbar rendering the module
 */
function modChrome_navbar($module, &$params, &$attribs)
{
  static $counterModules;
  static $modules;
  static $class_sfx;
  static $class_sfx_responsive;

  if ($counterModules < 1) :
    $counterModules = count(JModuleHelper::getModules($attribs['name']));
    $modules = array();
  endif;

  $registry = new JRegistry;
  $registry->loadString($module->params);
  $module->params = $registry->toArray();

  $temp            = new stdClass;
  $temp->content   = $module->content;
  $temp->params    = $module->params;
  $temp->title     = $module->title;
  $temp->showtitle = $module->showtitle;
  $temp->id        = $module->id;

  $moduleclass_sfx = explode(' ', $module->params['moduleclass_sfx']);
  foreach ($moduleclass_sfx as $key) :
    switch ($key) :
      case 'navbar-collapse' :
        $class_sfx_responsive = $key;
        break;
      case 'navbar-default' :
      case 'navbar-inverse' :
      case 'navbar-blue' :
      case 'navbar-blue-transparent' :
      case 'navbar-static-top' :
      case 'navbar-fixed-top' :
      case 'navbar-fixed' :
        $class_sfx .= ' ' . $key;
        break;
    endswitch;
  endforeach;

  $modules[] = $temp;

  if ($counterModules == 1) : ?>
    <nav class="navbar<?php echo htmlspecialchars(rtrim($class_sfx)); ?>" role="navigation">
      <div class="container">
      <?php if (isset($class_sfx_responsive) && $class_sfx_responsive == 'navbar-collapse') : ?>
        <div class="navbar-header">
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".nav-collapse">
            <span class="sr-only">Toggle Navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>

        <div class="navbar-collapse nav-collapse collapse">
      <?php endif; ?>

      <?php foreach ($modules as $renderModule) : ?>
        <?php echo $renderModule->content; ?>
      <?php endforeach; ?>

      <?php if (isset($class_sfx_responsive) && $class_sfx_responsive == 'navbar-collapse') : ?>
        </div>
      <?php endif;?>
      </div>
    </nav>
    <?php $counterModules--;
  else :
    $counterModules--;
  endif;
}

/**
 * Module chrome for standard rendering the module
 */
function modChrome_standard($module, &$params, &$attribs)
{
  static $counterModules;
  static $modules;
  static $modulesTab;
  $class = null;

  if ($counterModules < 1) :
    $counterModules = count(JModuleHelper::getModules($attribs['name']));
    $modules        = array();
    $modulesTab     = array();
  endif;

  $registry = new JRegistry;
  $registry->loadString($module->params);
  $module->params = $registry->toArray();

  $temp            = new stdClass;
  $temp->content   = $module->content;
  $temp->params    = $module->params;
  $temp->title     = $module->title;
  $temp->showtitle = $module->showtitle;
  $temp->id        = $module->id;

  if (preg_match('/nav-tabs/', $module->params['moduleclass_sfx'])) :
    $modulesTab[] = $temp;
  else :
    $modules[] = $temp;
  endif;

  if ($counterModules == 1) :
    $counter = 0;

    foreach($modulesTab as $renderModule) :
      $counter++;
      if ($counter == 1) : ?>
        <ul class="nav nav-tabs">
        <?php $class = ' class="active"';
      else :
        $class = null;
      endif;

      $moduleclass_sfx = explode(' ', $renderModule->params['moduleclass_sfx']);
      $class_sfx = null;
      foreach ($moduleclass_sfx as $key) :
        if (preg_match('/fa/', $key) || preg_match('/glyphicon/', $key)) :
          $class_sfx .= $key . ' ';
        endif;
      endforeach;

      if ($counter <= 2) : ?>
        <li<?php echo $class; ?>>
          <a href="#module-<?php echo $renderModule->id; ?>" data-toggle="tab">
            <?php echo !empty($class_sfx) ? '<span class="' . rtrim($class_sfx) . '"></span>' : null; ?>
            <?php echo $renderModule->title; ?>
          </a>
        </li>
      <?php  else :
        if ($counter == 3) : ?>
          <li class="<?php echo $attribs['name'] == 'right' ? 'tab-right ' : null; ?>dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="fa fa-plus"></span>
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
        <?php endif; ?>
              <li>
                <a href="#module-<?php echo $renderModule->id; ?>" data-toggle="tab">
                  <?php echo !empty($class_sfx) ? '<span class="' . rtrim($class_sfx) . '"></span>' : null; ?>
                  <?php echo $renderModule->title; ?>
                </a>
              </li>
        <?php if ($counter == count($modulesTab)) : ?>
            </ul>
          </li>
        <?php endif;
      endif;

      if ($counter == count($modulesTab)) : ?>
        </ul>
      <?php endif;
    endforeach;

    $counter = 0;
    foreach($modulesTab as $renderModule) :
      $counter++;
      if ($counter == 1) : ?>
        <div class="tab-content">
        <?php $class = ' in active';
      else :
        $class = null;
      endif; ?>
          <div class="tab-pane fade<?php echo $class; ?>" id="module-<?php echo $renderModule->id; ?>">
            <?php echo $renderModule->content; ?>
          </div>
      <?php if ($counter == count($modulesTab)) : ?>
        </div>
      <?php endif;
    endforeach;

    foreach ($modules as $renderModule) : ?>
      <div class="panel<?php echo $renderModule->params['moduleclass_sfx'] ? htmlspecialchars($renderModule->params['moduleclass_sfx']) : ' panel-default'; ?>">
      <?php if ($renderModule->showtitle != 0) : ?>
        <div class="panel-heading">
          <h4 class="panel-title"><?php echo $renderModule->title; ?></h4>
        </div>
      <?php endif; ?>
        <div class="panel-body">
          <?php echo $renderModule->content; ?>
        </div>
      </div>
    <?php endforeach;

    $counterModules--;
  else :
    $counterModules--;
  endif;
}

/**
 * Module chrome for rendering the module as featured class hero-unit
 */
function modChrome_featured($module, &$params, &$attribs)
{
  if (!empty($module->content)): ?>
    <div class="row<?php echo htmlspecialchars($params->get('moduleclass_sfx')); ?>">
      <div class="col-md-12">
      <?php if ($module->showtitle != 0) : ?>
        <div class="page-header">
          <h1><?php echo $module->title; ?></h1>
        </div>
      <?php endif; ?>
        <?php echo $module->content; ?>
      </div>
    </div>
  <?php endif;
}

/**
 * Module chrome for rendering the module in columns of fixed width
 */
function modChrome_column($module, &$params, &$attribs)
{
  static $counterModules;
  static $modules;

  if ($counterModules < 1) :
    $counterModules = count(JModuleHelper::getModules($attribs['name']));
    $modules = array();
  endif;

  $registry = new JRegistry;
  $registry->loadString($module->params);
  $module->params = $registry->toArray();

  $temp            = new stdClass;
  $temp->content   = $module->content;
  $temp->params    = $module->params;
  $temp->title     = $module->title;
  $temp->showtitle = $module->showtitle;
  $temp->id        = $module->id;
  $temp->name      = $module->name;

  $modules[] = $temp;

  if ($counterModules == 1 ) :
    $counter = 0; ?>
    <div class="row">
    <?php foreach ($modules as $renderModule) :
      $counter++;
      if (!empty($renderModule->content)) : ?>
        <div class="<?php echo $renderModule->name; ?><?php echo $renderModule->params['moduleclass_sfx'] ? ' ' . htmlspecialchars($renderModule->params['moduleclass_sfx']) : 'col-md-3'; ?>">
        <?php if ($renderModule->showtitle != 0) : ?>
          <div class="page-header">
            <h4><?php echo $renderModule->title; ?></h4>
          </div>
        <?php endif; ?>
          <?php echo $renderModule->content; ?>
        </div>
      <?php endif;
    endforeach; ?>
    </div>
    <?php $counterModules--;
  else :
    $counterModules--;
  endif;
}

/**
 * Module chrome for rendering the module in well box
 */
function modChrome_well($module, &$params, &$attribs)
{
  if (!empty($module->content)) : ?>
    <div class="well well-sm<?php echo $params->get('moduleclass_sfx'); ?>">
    <?php if ($module->showtitle) : ?>
      <div class="page-header">
        <h4><?php echo $module->title; ?></h4>
      </div>
    <?php endif; ?>
      <?php echo $module->content; ?>
    </div>
  <?php endif;
}