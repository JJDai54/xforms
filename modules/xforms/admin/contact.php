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
/*
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
//echo "===>status={$status}<br>";

$uformId  = Request::getInt('uform_id', 0, 'GET');
$formId   = Request::getInt('form_id', 0, 'GET');

        $banishHandler = $helper::getInstance()->getHandler('banish');

switch ($op) {
    case 'list':
    default:
        //echo "===>item<pre>" . print_r($_GET, true) . "</pre>";
        $formId   = Request::getInt('form_id', 0, 'POST');
        if ($formId == 0) $formId  = Request::getInt('form_id', 0, 'GET');
        //$formId   = 23;
        include_once "contact-list.php";
        break ;
      //======================================================================
    case 'view':
    case 'answer':
        include_once "contact-answer.php";
        break ;

      //======================================================================
    case 'sendmail':
        include_once "contact-sendmail.php";
        break ;
      //======================================================================
    case 'delete':
        include_once "contact-delete.php";
        break ;
      //======================================================================
    case 'delete_ok':
        $uformId = Request::getInt('uform_id', 0, 'POST');
        $ok  = Request::getInt('ok', 0, 'POST');

        include_once "contact-delete_ok.php";
        break ;

      //======================================================================
    case 'banish':
        $uformId = Request::getInt('uform_id', 0, 'GET');
        $email = Request::getString('email', '', 'GET');
        $action = Request::getString('action', '', 'GET');
        include_once "contact-banish.php";
        break ;
      //======================================================================
    case 'banish_ok':
        $uformId = Request::getInt('uform_id', 0, 'POST');
        $email = Request::getString('email', '', 'POST');
        $action = Request::getString('action', '', 'POST');
        $ok  = Request::getInt('ok', 0, 'POST');

        include_once "contact-banish_ok.php";
        break ;
}

include __DIR__ . '/admin_footer.php';
xoops_cp_footer();
