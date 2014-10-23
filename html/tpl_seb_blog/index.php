<?php
/**
 * @package     Turquoise
 * @subpackage  tpl_turquoise
 * @copyright   Copyright (C) 2014 Rene Bentes Pinto, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access.
defined('_JEXEC') or die('Restricted access!');

// -- Initialize
require_once dirname(__FILE__) . '/config.php';

$cck = CCK_Rendering::getInstance($this->template);
if ($cck->initialize() === false)
  return;

// Params init
$items = $cck->getItems();
$max   = count($items);

// Prepare Top Items
$numTop    = !$cck->getStyleParam('top_items', 1) ? 1 : (int)$cck->getStyleParam('top_items', 1);
$columnTop = !$cck->getStyleParam('top_columns', 1) ? 1 : (int) $cck->getStyleParam('top_columns');
$limit     = $numTop;
for ($i = 0; $i < $limit && $i < $max; $i++) :
  $topItems[$i] = array_slice($items, $i, 1);
endfor;

// Prepare Middle Items
$numMiddle    = !$cck->getStyleParam('middle_items', 4) ? 4 : (int)$cck->getStyleParam('middle_items', 4);
$columnMiddle = !$cck->getStyleParam('middle_columns', 2) ? 1 : (int) $cck->getStyleParam('middle_columns');
$limit        = $numTop + $numMiddle;
for ($i = $numTop; $i < $limit && $i < $max; $i++)
  $middleItems[$i] = array_slice($items, $i, 1);

// Prepare Bottom Items
$numBottom    = !$cck->getStyleParam('bottom_items', 0) ? 0 : (int)$cck->getStyleParam('bottom_items', 0);
$columnBottom = !$cck->getStyleParam('bottom_columns', 3) ? 1 : (int) $cck->getStyleParam('bottom_columns');
$start        = $limit;
$limit        = $numTop + $numMiddle + $numBottom;
for ($i = $start; $i < $limit && $i < $max; $i++)
  $bottomItems[$i] = array_slice($items, $i, 1);
?>

<section class="blog<?php echo !empty($cck->id_class) ? ' ' . $cck->id_class : null; ?>" itemscope itemtype="http://schema.org/Blog">
<?php if (!empty($topItems)) :
  $display = $cck->getStyleParam('top_display', 'renderItem');
  if ($display == 'renderItem')
    $display_params = array();
  else
  {
    $display_params = array('field_name' => $cck->getStyleParam('top_display_field_name', ''), 'target' => strtolower(substr($display, strpos($display, '_') + 1)));
    $display        = 'renderItemField';
  }

  $counter = 0;
  foreach ($topItems as $key => $item) :
    $row = $key % $columnTop + 1;
    if ($row == 1) : ?>
      <div class="row">
    <?php endif; ?>
    <div class="col-md-<?php echo round(12 / $columnTop); ?>" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
    <?php foreach ($item as $value)
      echo $cck->$display($value->pk, $display_params);
    ?>
    </div>
    <?php $counter++;
    if ($row == $columnTop || $counter == $numTop) : ?>
      </div>
      <hr class="half-rule">
    <?php endif; ?>
  <?php endforeach;
endif; ?>

<?php if (!empty($middleItems)) :
  $display = $cck->getStyleParam('middle_display', 'renderItem');
  if ($display == 'renderItem')
    $display_params = array();
  else
  {
    $display_params = array('field_name' => $cck->getStyleParam('middle_display_field_name', ''), 'target' => strtolower(substr($display, strpos($display, '_') + 1)));
    $display        = 'renderItemField';
  }

  $counter = 0;
  foreach ($middleItems as $key => $item) :
    $row = ($key - $numTop) % $columnMiddle + 1;
    if ($row == 1) : ?>
      <div class="row">
    <?php endif; ?>
    <div class="col-md-<?php echo round(12 / $columnMiddle); ?>" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
    <?php foreach ($item as $value)
      echo $cck->$display($value->pk, $display_params);
    ?>
    </div>
    <?php $counter++;
    if ($row == $columnMiddle || $counter == $numMiddle) : ?>
      </div>
      <hr class="half-rule">
    <?php endif; ?>
  <?php endforeach;
endif; ?>

<?php if (!empty($bottomItems)) :
  $display = $cck->getStyleParam('bottom_display', 'renderItem');
  if ($display == 'renderItem')
    $display_params = array();
  else
  {
    $display_params = array('field_name' => $cck->getStyleParam('bottom_display_field_name', ''), 'target' => strtolower(substr($display, strpos($display, '_') + 1)));
    $display        = 'renderItemField';
  }

  $counter = 0;
  foreach ($bottomItems as $key => $item) :
    $row = ($key - $numTop - $numMiddle) % $columnBottom + 1;
    if ($row == 1) : ?>
      <div class="row">
    <?php endif; ?>
    <div class="col-md-<?php echo round(12 / $columnBottom); ?>" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
    <?php foreach ($item as $value)
      echo $cck->$display($value->pk, $display_params);
    ?>
    </div>
    <?php $counter++;
    if ($row == $columnBottom || $counter == $numBottom) : ?>
      </div>
      <hr class="half-rule">
    <?php endif; ?>
  <?php endforeach;
endif; ?>
</section>