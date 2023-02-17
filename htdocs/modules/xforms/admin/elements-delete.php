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
//-----------------------------------------------------------

        $eleId = (int)$eleId; // fix for Xmf\Request bug in XOOPS < 2.5.9 FINAL
        if (0 === (int)$eleId) {
            $helper->redirect('admin/main.php',
                              Constants::REDIRECT_DELAY_NONE,
                              _AM_XFORMS_NOTHING_SELECTED
            );
        }
        if (empty($_POST['ok'])) {
            $element = $xformsEleHandler->get($eleId);
            xoops_cp_header();
            xoops_confirm(array('op' => 'delete', 'ele_id' => $eleId, 'form_id' => $formId, 'ok' => Constants::CONFIRM_OK), $_SERVER['SCRIPT_NAME'], sprintf(_AM_XFORMS_ELE_CONFIRM_DELETE, $element->getVar('ele_caption')), _YES);
        } else {
            if (!$GLOBALS['xoopsSecurity']->check()) {
            //exit;
                redirect_header($_SERVER['SCRIPT_NAME'], Constants::REDIRECT_DELAY_MEDIUM, implode('<br>', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            //delete the element
            $eleObj = $xformsEleHandler->get($eleId);
            $xformsEleHandler->delete($eleObj);
            //delete the userdata for this element too
            $uDataHandler = $helper::getInstance()->getHandler('UserData');
            //$uDataHandler = $helper->getHandler('UserData');
            $uDataHandler->deleteAll(new \Criteria('ele_id', $eleId));
            redirect_header($helper->url('admin/elements.php?op=list&form_id=' . $formId), Constants::REDIRECT_DELAY_NONE, _AM_XFORMS_DBUPDATED);
        }
