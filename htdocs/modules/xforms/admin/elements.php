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
 * @package   \XoopsModules\Xforms\admin\elements
 * @author    XOOPS Module Development Team
 * @copyright Copyright (c) 2001-2019 {@link https://xoops.org XOOPS Project}
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 * @since     1.30
 */
use XoopsModules\Xforms;
use XoopsModules\Xforms\Constants;
use XoopsModules\Xforms\Helper as xHelper;
use XoopsModules\Xforms\ElementRenderer;
use XoopsModules\Xforms\FormInput;
use Xmf\Module\Admin;
use Xmf\Request;

require __DIR__ . '/admin_header.php';
require_once '../include/functions.php';

/* @var \XoopsModules\Xforms\Helper $helper */
/* @var \XoopsModules\Xforms\FormsHandler $formsHandler */
/* @var \XoopsModules\Xforms\ElementHandler $xformsEleHandler */
$xformsEleHandler = $helper->getHandler('Element');

//$op = Request::getCmd('op', '', 'GET');
$op = Request::getCmd('op', '');
$clone      = Request::getInt('clone', Constants::FORM_NOT_CLONED);
$formId     = Request::getInt('form_id', Constants::FORM_NOT_VALID);
$eleId      = Request::getInt('ele_id', Constants::ELE_NOT_VALID);

//JJDai - la fonction "Request" sanityse le html, big probleme
//$eleValue   = Request::getArray('ele_value', '');
//$eleValue   =  Request::getArray('ele_value'); //$_POST['ele_value'];

$eleCaption = Request::getText('ele_caption', '', 'POST');
$eleOrder   = Request::getInt('ele_order', 0, 'POST');
$eleReq     = Request::getInt('ele_req', Constants::ELEMENT_NOT_REQD, 'POST');
$submit     = Request::getCmd('submit', '', 'POST');
//echo "<hr><pre>POST :" . print_r($_POST,true) . "<hr>GET :" . print_r($_GET,true) . "</pre><hr>";
//exit;

switch ($op) {

    case 'list': // Save element(s)
        include_once('elements-list.php');
        break;
        
    case 'save': // Save element(s)
        include_once('elements-save.php');
        break;
        
    case 'edit': // Save element(s)
        include_once('elements-edit.php');
        break;

    case 'delete': // Save element(s)
        include_once('elements-delete.php');
        break;
        
    case 'save-list': // Save element (s)
        include_once('elements-save-list.php');
        break;
        
    default: 
//echo "<hr><pre>" . print_r($_POST,true) . "</pre><hr>";
        include_once('elements-default.php');
        break;
    }        
require __DIR__ . '/admin_footer.php';
