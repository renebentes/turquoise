<?php
/**
 * @package     Turquoise
 * @subpackage  tpl_turquoise
 * @copyright   Copyright (C) 2014 Rene Bentes Pinto, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access.
defined('_JEXEC') or die('Restricted access!');

if ($params->get('name') == 0) :
  $login = $user->get('name');
else :
  $login = $user->get('username');
endif;
if ($params->get('greeting')) :
  echo JText::sprintf('MOD_LOGIN_HINAME', htmlspecialchars($login));
else :
  echo htmlspecialchars($login);
endif;