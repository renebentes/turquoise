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

// Additional stylesheets and javascripts
$doc->addStylesheet($this->path . '/css/print.css?v=1', 'text/css', 'print');
if (isset($_GET['print']) && $_GET['print'] == '1') :
  $doc->addScriptDeclaration('window.print();');
endif;
?>

<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
  <head>
    <jdoc:include type="head" />

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
    <div class="container">
      <div class="row">
        <div class="col-md-12">
        <?php if(tplTurquoiseHelper::isNewJoomla()) : ?>
          <jdoc:include type="message" />
        <?php else :
          tplTurquoiseHelper::renderMessages();
        endif; ?>
          <jdoc:include type="component" />
        </div>
      </div>
    </div>
  </body>
</html>