<?php
/**
 * @package     Turquoise
 * @subpackage  tpl_turquoise
 * @copyright   Copyright (C) 2014 Rene Bentes Pinto, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access.
defined('_JEXEC') or die('Restricted access!');

// Define Variables
$created_year = 2013;
$cur_year = JFactory::getDate()->format('Y');
?>

<p>&copy; <?php echo (int)$cur_year > (int)$created_year ? $created_year . ' - ' . $cur_year : $created_year; ?>
  <a href="<?php echo JUri::root(); ?>"><strong><?php echo $app->getCfg('sitename'); ?></strong></a>.
  Todos os direitos reservados. Se&ccedil;&atilde;o de Inform&aacute;tica 8&ordm; BEC.
  <?php echo $app->getTemplate(true)->params->get('auth') ?  '<br>' . $app->getTemplate(true)->params->get('auth') : null; ?>
<?php if ($app->getTemplate(true)->params->get('copyright') == '1') :
  echo '<br>' . JText::_('MOD_FOOTER_LINE2');
  echo '<br>' . JText::_('TPL_TURQUOISE_PARAMETER_COPYRIGHT_VALUE_BOOTSTRAP');
  echo '<br>' . JText::_('TPL_TURQUOISE_PARAMETER_COPYRIGHT_VALUE_FONTAWESOME');
  echo '<br>' . JText::_('TPL_TURQUOISE_PARAMETER_COPYRIGHT_VALUE_JQUERY');
endif; ?>
</p>