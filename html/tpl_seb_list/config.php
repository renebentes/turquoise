<?php
/**
 * @package     Turquoise
 * @subpackage  tpl_turquoise
 * @copyright   Copyright (C) 2014 Rene Bentes Pinto, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access.
defined('_JEXEC') or die('Restricted access!');

global $user;

$app      = JFactory::getApplication();
$path_lib = JPATH_SITE . '/libraries/cck/rendering/rendering.php';
$user     = JCck::getUser();

if (!file_exists($path_lib))
{
  print('/libraries/cck/rendering/rendering.php file is missing.');
  die;
}

require_once $path_lib;
?>