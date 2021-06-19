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

        if (empty($_POST['ok'])) {
            xoops_cp_header();
            $formId = Request::getInt('form_id', 0,  'GET');
            if ($formId) {
                //$formsHandler = $helper->getHandler('Forms');
                $formObj            = $formsHandler->get($formId);
                $formTitle          = $formObj->getVar('form_title');
                xoops_confirm(array('op' => 'active', 'form_id' => $formId, 'ok' => Constants::CONFIRM_OK), $_SERVER['SCRIPT_NAME'], sprintf(_AM_XFORMS_CONFIRM_ACTIVE, $formTitle));
            } else {
                redirect_header($_SERVER['SCRIPT_NAME'], Constants::REDIRECT_DELAY_MEDIUM, _AM_XFORMS_FORM_NOTEXISTS);
            }
        } else {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                redirect_header($_SERVER['SCRIPT_NAME'], Constants::REDIRECT_DELAY_MEDIUM, implode('<br>', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            $formId = Request::getInt('form_id', 0, 'POST');
            //$formsHandler = $helper->getHandler('Forms');
            if (!empty($formId) && ($formObj = $formsHandler->get($formId)) && !$formObj->isNew()) {
                if ($formsHandler->setActive($formObj)) {
                    redirect_header($_SERVER['SCRIPT_NAME'], Constants::REDIRECT_DELAY_NONE, _AM_XFORMS_DBUPDATED);
                }
                xoops_cp_header();
                echo $formObj->getHtmlErrors();
            } else {
                redirect_header($_SERVER['SCRIPT_NAME'], Constants::REDIRECT_DELAY_NONE, _AM_XFORMS_NOTHING_SELECTED);
            }
        }




















include __DIR__ . '/admin_footer.php';
xoops_cp_footer();
