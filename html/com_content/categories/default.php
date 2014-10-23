<?php
/**
 * @package     Turquoise
 * @subpackage  tpl_turquoise
 * @copyright   Copyright (C) 2014 Rene Bentes Pinto, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access.
defined('_JEXEC') or die('Restricted access!');

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers');
JHtml::addIncludePath(dirname(dirname(__FILE__)));

?>
<section class="category-list<?php echo $this->pageclass_sfx; ?>">
<?php
  $this->subtemplatename = 'articles';
  echo JLayoutHelper::render('joomla.content.categories_default', $this);
?>
</section>