<?php
/**
 * @package     Turquoise
 * @subpackage  tpl_turquoise
 * @copyright   Copyright (C) 2014 Rene Bentes Pinto, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access.
defined('_JEXEC') or die('Restricted access!');

echo $cck->getValue('art_introtext');

if ($cck->getValue('work_gallery')) :
  for ($i = 0; $i <= count($cck->getValue('work_gallery')) - 1; $i++) :
    if ($i % 2 == 0) : ?>
    <div class="row">
    <?php endif; ?>
      <div class="col-md-6">
        <div class="thumbnail">
          <img class="img-responsive hasTooltip" src="<?php echo $cck->getValue('work_gallery')[$i]->thumb2; ?>" title="<?php echo $cck->getValue('work_gallery')[$i]->image_alt; ?>" alt="<?php echo $cck->getValue('work_gallery')[$i]->image_alt; ?>" />
          <div class="caption">
            <p><?php echo $cck->getValue('work_gallery')[$i]->image_alt; ?></p>
          </div>
        </div>
      </div>
    <?php if ($i % 2 != 0 || $i == count($cck->getValue('work_gallery')) - 1) : ?>
    </div>
    <?php endif; ?>
  <?php endfor; ?>
<?php endif; ?>

<h4>Cronograma de Execução</h4>
<?php
$progress = 'progress-bar-success';
if ($cck->getValue('work_execution') <= 30) :
  $progress = 'progress-bar-danger';
elseif ($cck->getValue('work_execution') > 30 && $cck->getValue('work_execution') <= 50) :
  $progress = 'progress-bar-warning';
elseif ($cck->getValue('work_execution') > 50 && $cck->getValue('work_execution') < 100) :
  $progress = 'progress-bar-info';
endif;?>
<div class="progress">
  <div class="progress-bar <?php echo $progress; ?>" role="progressbar" aria-valuenow="<?php echo $cck->getValue('work_execution'); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $cck->getValue('work_execution'); ?>%;">
    <?php echo $cck->getValue('work_execution'); ?>%
  </div>
</div>