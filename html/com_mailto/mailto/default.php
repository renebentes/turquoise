<?php
/**
 * @package     Turquoise
 * @subpackage  tpl_turquoise
 * @copyright   Copyright (C) 2014 Rene Bentes Pinto, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access.
defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');

$script   = array();
$script[] = '';
$script[] = 'Joomla.submitbutton = function(pressbutton) {';
$script[] = '  var form = document.getElementById(\'mailtoForm\')';
$script[] = '  if (form.mailto.value == "" || form.from.value == "") {';
$script[] = '    alert(\'' . JText::_('COM_MAILTO_EMAIL_ERR_NOINFO') . '\');';
$script[] = '    return false;';
$script[] = '  }';
$script[] = '  form.submit();';
$script[] = '};';

JFactory::getDocument()->addScriptDeclaration(implode("\n", $script));
$data = $this->get('data');
?>
<form class="form-horizontal" action="<?php echo JUri::base() ?>index.php" id="mailtoForm" method="post" role="form">
  <div class="form-group">
    <label class="col-sm-2 control-label" for="mailto_field"><?php echo JText::_('COM_MAILTO_EMAIL_TO'); ?></label>
    <div class="col-sm-10">
      <input type="text" id="mailto_field" name="mailto" class="form-control" size="25" value="<?php echo $this->escape($data->mailto); ?>"/>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label" for="sender_field"><?php echo JText::_('COM_MAILTO_SENDER'); ?></label>
    <div class="col-sm-10">
      <input type="text" id="sender_field" name="sender" class="form-control" value="<?php echo $this->escape($data->sender); ?>" size="25" />
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label" for="from_field"><?php echo JText::_('COM_MAILTO_YOUR_EMAIL'); ?></label>
    <div class="col-sm-10">
      <input type="text" id="from_field" name="from" class="form-control" value="<?php echo $this->escape($data->from); ?>" size="25" />
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label" for="subject_field"><?php echo JText::_('COM_MAILTO_SUBJECT'); ?></label>
    <div class="col-sm-10">
      <input type="text" id="subject_field" name="subject" class="form-control" value="<?php echo $this->escape($data->subject); ?>" size="25" />
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <div class="pull-right">
        <button type="button" class="btn btn-success" onclick="return Joomla.submitbutton('send');"><?php echo JText::_('COM_MAILTO_SEND'); ?></button>
        <button type="button" class="btn btn-danger" onclick="javascript:$('#modal-email').modal('hide')"><?php echo JText::_('COM_MAILTO_CANCEL'); ?></button>
      </div>
    </div>
  </div>
  <input type="hidden" name="layout" value="<?php echo $this->getLayout();?>" />
  <input type="hidden" name="option" value="com_mailto" />
  <input type="hidden" name="task" value="send" />
  <input type="hidden" name="tmpl" value="component" />
  <input type="hidden" name="link" value="<?php echo $data->link; ?>" />
  <?php echo JHtml::_('form.token'); ?>
</form>