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

        if (!isset($_POST['submit'])) {
            redirect_header($_SERVER['SCRIPT_NAME'], Constants::REDIRECT_DELAY_NONE, _AM_XFORMS_NOTHING_SELECTED);
        }
        // check security
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header($_SERVER['SCRIPT_NAME'], Constants::REDIRECT_DELAY_MEDIUM, implode('<br>', $GLOBALS['xoopsSecurity']->getErrors()));
        }

        $formSaveDb     = Request::getInt('form_save_db', 0, 'POST');
        $formSendMethod = Request::getCmd('form_save_method', '', 'POST');
        $formId         = Request::getInt('form_id', 0, 'POST');
        $cloneFormId    = Request::getInt('clone_form_id', 0, 'POST');

        if ((0 === (int)$formSaveDb) && (Constants::SEND_METHOD_NONE === $formSendMethod)) {
            redirect_header($_SERVER['SCRIPT_NAME'], Constants::REDIRECT_DELAY_NONE, _AM_XFORMS_NOTHING_SAVESENT);
        }

        $error = '';
        $form = $formsHandler->get((int)$formId);

        $formSendToGroup  = Request::getInt('form_send_to_group', 0, 'POST');
        $formSendToOther  = Request::getString('form_send_to_other', '', 'POST');
        $formSendCopy     = Request::getInt('form_send_copy', '', 'POST');
        $formSendMethod   = Request::getWord('form_send_method', 'POST');
        $formEmailHeader  = Request::getText('form_email_header', 'POST');
        $formEmailFooter  = Request::getText('form_email_footer', '', 'POST');
        $formEmailUheader = Request::getText('form_email_uheader', '', 'POST');
        $formEmailUfooter = Request::getText('form_email_ufooter', '', 'POST');
        $formType         = Request::getWord('form_type', 'XoopsThemeForm', 'POST');
        $formOrder        = Request::getInt('form_order', 0, 'POST');
        $formDelimiter    = Request::getString('form_delimiter', '', 'POST');
        $formTitle        = Request::getString('form_title', '', 'POST');
        $formSubmitText   = Request::getText('form_submit_text', '', 'POST');
        $formDesc         = Request::getText('form_desc', '', 'POST');
        $formIntro        = Request::getText('form_intro', '', 'POST');
        $formWhereTo      = Request::getString('form_whereto', '', 'POST');
        $formDisplayStyle = Request::getCmd('form_display_style', '', 'POST');
        $formColorSet     = Request::getCmd('form_color_set', '', 'POST');
        $defineFormBegin  = Request::getInt('define_form_begin', 0, 'POST');
        $defineFormEnd    = Request::getInt('define_form_end', 0, 'POST');
        $formActive       = Request::getInt('form_active', 0, 'POST');
        $formAnswer       = Request::getInt('form_answer', 0, 'POST');
//echo "<hr>{$formColorSet}<hr>";exit;
        //validate list of other email addresses
        $sToO = (!empty($formSendToOther)) ? explode(';', $formSendToOther) : array();
        $valArray = array();
        foreach ($sToO as $oEmail) {
            if ($valEmail = filter_var($oEmail, FILTER_VALIDATE_EMAIL)) {
                $valArray[] = $valEmail;
            }
        }
        $formSendToOther = (!empty($valArray)) ? implode(';', $valArray) : '';

        $form->setVars(array('form_send_to_group' => $formSendToGroup,
                             'form_send_to_other' => $formSendToOther,
                                 'form_send_copy' => $formSendCopy,
                               'form_send_method' => $formSendMethod,
                              'form_email_header' => $formEmailHeader,
                              'form_email_footer' => $formEmailFooter,
                             'form_email_uheader' => $formEmailUheader,
                             'form_email_ufooter' => $formEmailUfooter,
                                      'form_type' => $formType,
                                     'form_order' => $formOrder,
                                 'form_delimiter' => $formDelimiter,
                                     'form_title' => $formTitle,
                               'form_submit_text' => $formSubmitText,
                                      'form_desc' => $formDesc,
                                     'form_intro' => $formIntro,
                                   'form_whereto' => $formWhereTo,
                             'form_display_style' => $formDisplayStyle,
                                 'form_color_set' => $formColorSet,
                                     'form_begin' => 0,
                                    'form_active' => $formActive,
                                    'form_answer' => $formAnswer)
        );

        if (0 !== (int)$defineFormBegin) {
            $formBegin = Request::getArray('form_begin', array('date' => getdate(), 'time' => 0), 'POST');
            $formBegin = strtotime($formBegin['date']) + $formBegin['time'];
            $form->setVar('form_begin', (int)$formBegin);
        }

        if (0 !== (int)$defineFormEnd) {
            $formEnd = Request::getArray('form_end', array('date' => getdate(), 'time' => 0), 'POST');
            $formEnd = strtotime($formEnd['date']) + $formEnd['time'];
        } else {
            $formEnd = 0;
        }
        $form->setVar('form_end', (int)$formEnd);
        // now update the form
        if (!$ret = $formsHandler->insert($form)) {
            $error = $form->getHtmlErrors();
        } else {
            $formsHandler->deleteFormPermissions($ret);
            $formGroupPerm = Request::getArray('form_group_perm', array(), 'POST');
            if (count($formGroupPerm) > 0) {  //JJDai - correction tableau
                $formsHandler->insertFormPermissions($ret, $formGroupPerm);
            }
            $eleHandler = $helper->getHandler('Element');
            if (!empty($cloneFormId)) {
                $criteria = new \Criteria('form_id', $cloneFormId);
                $count    = $eleHandler->getCount($criteria);
                if ($count > 0) {
                    $elements = $eleHandler->getObjects($criteria);
                    foreach ($elements as $e) {
                        $values = $e->getValues();
                        unset($values['ele_id']);
                        $values['form_id'] = $ret;
                        $cloned = $eleHandler->create();
                        $cloned->setVars($values);
                        if (!$eleHandler->insert($cloned)) {
                            $error .= $cloned->getHtmlErrors();
                        }
                        unset($values, $cloned);
                    }
                }
            } elseif (empty($formId)) {
                $error = $eleHandler->insertDefaults($ret);
            }
        }
        if (!empty($error)) {
            xoops_cp_header();
            echo $error;
        } else {
            if (_AM_XFORMS_SAVE_THEN_ELEMENTS === $_POST['submit']) {
                redirect_header($helper->url('admin/elements.php?form_id=' . $ret), Constants::REDIRECT_DELAY_NONE, _AM_XFORMS_DBUPDATED);
            } else {
                redirect_header($_SERVER['SCRIPT_NAME'], Constants::REDIRECT_DELAY_NONE, _AM_XFORMS_DBUPDATED);
            }
        }




















include __DIR__ . '/admin_footer.php';
xoops_cp_footer();
