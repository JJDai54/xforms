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
 * Main administration page
 *
 * @package   \XoopsModules\Xforms\admin
 * @author    XOOPS Module Development Team
 * @copyright Copyright (c) 2001-2019 {@link https://xoops.org XOOPS Project}
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 * @since     1.30
 */
use Xmf\Request;
use XoopsModules\Xforms;
use XoopsModules\Xforms\Constants;
use XoopsModules\Xforms\FormInput;

require_once __DIR__ . '/admin_header.php';
//echo __DIR__ ."<br>";
require_once  '../include/functions.php';
require_once  'status.php';

$myts = \MyTextSanitizer::getInstance();

$op        = Request::getCmd('op', 'list');
$showAll   = Request::getBool('showall', false, 'POST');
$saveorder = Request::getBool('saveorder', false, 'POST');
$selectStatus   = Request::getInt('selectStatus', -1);
$cloneFormId = Request::getInt('clone_form_id', 0, 'GET');
//echo "===>status={$status}<br>";

/*
if ($showAll) {
    $op = 'list';
} elseif ($saveOrder) {
    $op = 'saveorder';
}
*/
//JJDai -modif pour affichage des différents status: actif,inactif,exoiré,tout
if ($saveorder) {
    $op = 'saveorder';
}
//echo "===>op={$op}<br>";
//exit;

switch ($op) {
    case 'list':
    default:
        include_once "forms-list.php";
        break;

    case 'edit':
        include_once "forms-edit.php";
        break;

    case 'delete':
        include_once "forms-delete.php";
        break;

    case 'change-status':
        include_once "forms-status.php";
        break;
        
    case 'active':
        include_once "forms-active.php";
        break;

    case 'inactive':
        include_once "forms-inactive.php";
        break;

    case 'saveorder':
        include_once "forms-saveorder.php";
        break;

    case 'saveform':
        include_once "forms-saveform.php";
        break;
}

include __DIR__ . '/admin_footer.php';
xoops_cp_footer();
