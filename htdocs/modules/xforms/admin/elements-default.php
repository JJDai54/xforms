<?php
/*
 You may not change or alter any portion of this comment or credits of
 supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit
 authors.

 This program is distributed in the hope that it will be useful, but
 WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */
/**
 * Module: xForms
 *
 * @package   \XoopsModules\Xforms\admin
 * @author    XOOPS Module Development Team
 * @copyright Copyright (c) 2001-2019 {@link https://xoops.org XOOPS Project}
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 * @since     1.30
 *
 * @see \Xmf\Request
 * @see \Xmf\Module\Helper
 * @see \Xmf\Module\Admin
 * @see \XoopsModules\Xforms\Helper
 */

use XoopsModules\Xforms;
use XoopsModules\Xforms\Constants;
use XoopsModules\Xforms\FormInput;
use Xmf\Module\Helper;
use Xmf\Request;

require_once __DIR__ . '/admin_header.php';
require_once '../include/functions.php';

/* @var \XoopsModules\Xforms\Helper $helper */
/* @var \XoopsModules\Xforms\ElementHandler $xformsEleHandler */
$xformsEleHandler = $helper->getHandler('Element');

$myts = \MyTextSanitizer::getInstance();

/* @var \XoopsModules\Xforms\FormsHandler $formsHandler */
if ($formsHandler->getCount() < 1) {
    $helper->redirect('admin/main.php?op=edit', Constants::REDIRECT_DELAY_NONE, _AM_XFORMS_GO_CREATE_FORM);
}

$op         = Request::getCmd('op', '');
$clone      = Request::getInt('clone', Constants::FORM_NOT_CLONED);
$formId     = Request::getInt('form_id', Constants::FORM_NOT_VALID);
$eleId      = Request::getInt('ele_id', Constants::ELE_NOT_VALID);

//JJDai - la fonction "Request" sanityse le html, big probleme
//$eleValue   = Request::getArray('ele_value', '');
$eleValue   = $_POST['ele_value'];

$eleCaption = Request::getText('ele_caption', '', 'POST');
$eleOrder   = Request::getInt('ele_order', 0, 'POST');
$eleReq     = Request::getInt('ele_req', Constants::ELEMENT_NOT_REQD, 'POST');
$submit     = Request::getCmd('submit', '', 'POST');


//----------------------------------------------------------
        xoops_cp_header();
        $adminObject->displayNavigation(basename(__FILE__));

        //get the valid element types
        $validEleTypes = $xformsEleHandler->getValidElements();

        $counter = 0;
        $cssClass = '';
        echo '  <table class="outer bspacing1">'
           . '    <thead>'
           . '    <tr><th colspan="2">' . _AM_XFORMS_ELE_CREATE . '</th></tr>'
           . '    </thead>'
           . '    <tbody>';
        foreach ($validEleTypes as $thisType => $thisDesc) {
            if (++$counter % 2) {
                //odd
                $cssClass = ('odd' === $cssClass) ? 'even' : 'odd';
                echo '    <tr><td class="' . $cssClass . ' center"><a href="' . $_SERVER['SCRIPT_NAME'] . '?op=edit&amp;ele_type=' . $thisType . '">' . $thisDesc . '</a></td>';
            } else {
                //even
                echo '<td class="' . $cssClass . ' center"><a href="' . $_SERVER['SCRIPT_NAME'] . '?op=edit&amp;ele_type=' . $thisType . '">' . $thisDesc . '</a></td></tr>';
            }
        }
        if ($counter % 2) { //odd so finish out table row
            echo '<td class="' . $cssClass . ' center">&nbsp;</td></tr>';
        }
        echo '  </tbody>'
           . '  </table>';
