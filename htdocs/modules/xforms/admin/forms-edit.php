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

        $clone  = Request::getInt('clone', 0, 'GET');
        $formId = Request::getInt('form_id', 0, 'GET');
        xoops_cp_header();
        Xforms\load_css();

        $adminObject->displayNavigation(basename(__FILE__) . '?op=edit');

        $form          = $formsHandler->get($formId); // will auto-create if form_id == 0
        $textFormTitle = new \XoopsFormText(_AM_XFORMS_TITLE, 'form_title', 50, 255, $form->getVar('form_title', 'e'));

        $permHelper = new \Xmf\Module\Helper\Permission($moduleDirName);
        if (0 === (int)$formId) {
            // new form so preselect Administrator group
            $groupIds = array(XOOPS_GROUP_ADMIN);
        } else {
            $groupIds = $permHelper->getGroupsForItem($formsHandler->perm_name, $formId);
        }
        $selectFormGroupPerm = new \XoopsFormSelectGroup(_AM_XFORMS_PERM, 'form_group_perm', true, $groupIds, 5, true);

        $selectFormSaveDb = new \XoopsFormRadioYN(_AM_XFORMS_SAVE_DB, 'form_save_db', ((((int)$form->getVar('form_save_db')) > 0) ? 1 : 0), _AM_XFORMS_SAVE_DB_YES, _AM_XFORMS_SAVE_DB_NO);
        $selectFormSaveDb->setDescription(_AM_XFORMS_SAVE_DB_DESC);

        $selectFormSendMethod = new \XoopsFormSelect(_AM_XFORMS_SEND_METHOD, 'form_send_method', $form->getVar('form_send_method'));
        $selectFormSendMethod->addOption(Constants::SEND_METHOD_MAIL, _AM_XFORMS_SEND_METHOD_MAIL);
        $selectFormSendMethod->addOption(Constants::SEND_METHOD_PM, _AM_XFORMS_SEND_METHOD_PM);
        $selectFormSendMethod->addOption(Constants::SEND_METHOD_NONE, _AM_XFORMS_SEND_METHOD_NONE);
        $selectFormSendMethod->setDescription(_AM_XFORMS_SEND_METHOD_DESC);

        $selectFormSendToGroup = new \XoopsFormSelectGroup(_AM_XFORMS_SENDTO, 'form_send_to_group', false, $form->getVar('form_send_to_group'));
        $selectFormSendToGroup->addOption('0', _AM_XFORMS_SENDTO_ADMIN);
        $selectFormSendToGroup->addOption('-1', _AM_XFORMS_SENDTO_OTHER);

        $sendToOther         = $form->getVar('form_send_to_other');
        $textFormSendToOther = new \XoopsFormText(_AM_XFORMS_SENDTO_OTHER_EMAILS, 'form_send_to_other', 50, 255, empty($sendToOther) ? '' : $sendToOther);
        $textFormSendToOther->setDescription(_AM_XFORMS_SENDTO_OTHER_DESC);

        $selectFormSendCopy = new \XoopsFormRadioYN(_AM_XFORMS_SEND_COPY, 'form_send_copy', ((((int)$form->getVar('form_send_copy')) > 0) ? 1 : 0), _YES, _NO);
        $selectFormSendCopy->setDescription(_AM_XFORMS_SEND_COPY_DESC);

        // set same configs for all editors on this page
        $sysHelper     = \Xmf\Module\Helper::getHelper('system');
        $editorConfigs = array('editor' => Xforms\get_editor_name(),
                                 'rows' => 5,
                                 'cols' => 90,
                                'width' => '100%',
                               'height' => '200px'
        );

        $editorConfigs = array_merge($editorConfigs, array('name' => 'form_email_header', 'value' => $form->getVar('form_email_header', 'e')));
        $tareaFormEmailHeader = new \XoopsFormEditor(_AM_XFORMS_EMAIL_HEADER, 'form_email_header', $editorConfigs);
        $tareaFormEmailHeader->setDescription(_AM_XFORMS_EMAIL_HEADER_DESC);
//        $tareaFormEmailHeader = new \XoopsFormDhtmlTextArea(_AM_XFORMS_EMAIL_HEADER, 'form_email_header', $form->getVar('form_email_header', 'e'), 5, 90);
//        $tareaFormEmailHeader->skipPreview = true;
/* JJDAi - Desactivation car il faut installé le plufin rendere pour tiny
        $renderer = $tareaFormEmailHeader->editor->renderer;
        if (property_exists($renderer, 'skipPreview')) {
            $tareaFormEmailHeader->editor->renderer->skipPreview = true;
        }
*/

        $editorConfigs = array_merge($editorConfigs, array('name' => 'form_email_footer', 'value' => $form->getVar('form_email_footer', 'e')));
        $tareaFormEmailFooter = new \XoopsFormEditor(_AM_XFORMS_EMAIL_FOOTER, 'form_email_footer', $editorConfigs);
        $tareaFormEmailFooter->setDescription(_AM_XFORMS_EMAIL_FOOTER_DESC);
//        $tareaFormEmailFooter = new \XoopsFormDhtmlTextArea(_AM_XFORMS_EMAIL_FOOTER, 'form_email_footer', $form->getVar('form_email_footer', 'e'), 5, 90);
//        $tareaFormEmailFooter->skipPreview = true;
/* JJDAi - Desactivation car il faut installé le plufin rendere pour tiny
        $renderer = $tareaFormEmailFooter->editor->renderer;
        if (property_exists($renderer, 'skipPreview')) {
            $tareaFormEmailFooter->editor->renderer->skipPreview = true;
        }
*/

        $editorConfigs = array_merge($editorConfigs, array('name' => 'form_email_uheader', 'value' => $form->getVar('form_email_uheader', 'e')));
        $tareaFormEmailUheader = new \XoopsFormEditor(_AM_XFORMS_EMAIL_UHEADER, 'form_email_uheader', $editorConfigs);
        $tareaFormEmailUheader->setDescription(_AM_XFORMS_EMAIL_UHEADER_DESC);
//        $tareaFormEmailUheader = new \XoopsFormDhtmlTextArea(_AM_XFORMS_EMAIL_UHEADER, 'form_email_uheader', $form->getVar('form_email_uheader', 'e'), 5, 90);
//        $tareaFormEmailUheader->skipPreview = true;
/* JJDAi - Desactivation car il faut installé le plufin rendere pour tiny
        $renderer = $tareaFormEmailUheader->editor->renderer;
        if (property_exists($renderer, 'skipPreview')) {
            $tareaFormEmailUheader->editor->renderer->skipPreview = true;
        }
*/

        $editorConfigs = array_merge($editorConfigs, array('name' => 'form_email_ufooter', 'value' => $form->getVar('form_email_ufooter', 'e')));
        $tareaFormEmailUfooter = new \XoopsFormEditor(_AM_XFORMS_EMAIL_UFOOTER, 'form_email_ufooter', $editorConfigs);
        $tareaFormEmailUfooter->setDescription(_AM_XFORMS_EMAIL_UFOOTER_DESC);
//        $tareaFormEmailUfooter = new \XoopsFormDhtmlTextArea(_AM_XFORMS_EMAIL_UFOOTER, 'form_email_ufooter', $form->getVar('form_email_ufooter', 'e'), 5, 90);
//        $tareaFormEmailUfooter->skipPreview = true;
/* JJDAi - Desactivation car il faut installé le plufin rendere pour tiny
        $renderer = $tareaFormEmailUfooter->editor->renderer;
        if (property_exists($renderer, 'skipPreview')) {
            $tareaFormEmailUfooter->editor->renderer->skipPreview = true;
        }
*/

        $selectFormDelimiter = new \XoopsFormSelect(_AM_XFORMS_DELIMETER, 'form_delimiter', $form->getVar('form_delimiter'));
        $selectFormDelimiter->addOption(Constants::DELIMITER_SPACE, _AM_XFORMS_DELIMETER_SPACE);
        $selectFormDelimiter->addOption(Constants::DELIMITER_BR, _AM_XFORMS_DELIMETER_BR);

        $textFormOrder = new FormInput(_AM_XFORMS_ORDER, 'form_order', 4, 5, $form->getVar('form_order'), null, 'number');
        $textFormOrder->setAttribute('min', 0);
        $textFormOrder->setExtra('style="width: 4em;text-align: center;"');
        $textFormOrder->setDescription(_AM_XFORMS_ORDER_DESC);

        $submitText           = $form->getVar('form_submit_text');
        $submitFormSubmitText = new \XoopsFormText(_AM_XFORMS_SUBMIT_TEXT, 'form_submit_text', 50, 50, empty($submitText) ? _SUBMIT : $submitText);

        $editorConfigs = array_merge($editorConfigs, array('name' => 'form_desc', 'value' => $form->getVar('form_desc', 'e')));
        $tareaFormDesc = new \XoopsFormEditor(_AM_XFORMS_DESC, 'form_desc', $editorConfigs);
        $tareaFormDesc->setDescription(_AM_XFORMS_DESC_DESC);
//        $tareaFormDesc = new \XoopsFormDhtmlTextArea(_AM_XFORMS_DESC, 'form_desc', $form->getVar('form_desc', 'e'), 5, 90);
//        $tareaFormDesc->skipPreview = true;
/* JJDAi - Desactivation car il faut installé le plufin rendere pour tiny
        $renderer = $tareaFormDesc->editor->renderer;
        if (property_exists($renderer, 'skipPreview')) {
            $tareaFormDesc->editor->renderer->skipPreview = true;
        }
*/

        $editorConfigs = array_merge($editorConfigs, array('name' => 'form_intro', 'value' => $form->getVar('form_intro', 'e')));
        $tareaFormIntro = new \XoopsFormEditor(_AM_XFORMS_INTRO, 'form_intro', $editorConfigs);
        $tareaFormIntro->setDescription(_AM_XFORMS_INTRO_DESC);
//        $tareaFormIntro = new \XoopsFormDhtmlTextArea(_AM_XFORMS_INTRO, 'form_intro', $form->getVar('form_intro', 'e'), 5, 90);
//        $tareaFormIntro->skipPreview = true;
/* JJDAi - Desactivation car il faut installé le plufin rendere pour tiny
        $renderer = $tareaFormIntro->editor->renderer;
        if (property_exists($renderer, 'skipPreview')) {
            $tareaFormIntro->editor->renderer->skipPreview = true;
        }
*/

        $textFormContactLabel = new \XoopsFormLabel('<span style="font-weight: bold; font-size: larger;">' . _AM_XFORMS_CONTACT_INFO . '</span>', '', 'contact_label');

        $textFormWhereTo = new \XoopsFormText(_AM_XFORMS_WHERETO, 'form_whereto', 50, 255, $form->getVar('form_whereto'));
        $textFormWhereTo->setDescription(_AM_XFORMS_WHERETO_DESC);

        $selectFormDisplayStyle = new \XoopsFormSelect(_AM_XFORMS_DISPLAY_STYLE, 'form_display_style', $form->getVar('form_display_style'));
        $selectFormDisplayStyle->addOption(Constants::FORM_DISPLAY_STYLE_FORM, _AM_XFORMS_DISPLAY_STYLE_FORM);
        $selectFormDisplayStyle->addOption(Constants::FORM_DISPLAY_STYLE_POLL, _AM_XFORMS_DISPLAY_STYLE_POLL);
        $selectFormDisplayStyle->setDescription(_AM_XFORMS_DISPLAY_STYLE_DESC);


        $selectFormColorSet = new \XoopsFormSelect(_AM_XFORMS_COLOR_SET, 'form_color_set', $form->getVar('form_color_set'));
//         $selectFormColorSer->addOption(Constants::FORM_DISPLAY_STYLE_FORM, _AM_XFORMS_DISPLAY_STYLE_FORM);
//         $selectFormColorSer->addOption(Constants::FORM_DISPLAY_STYLE_POLL, _AM_XFORMS_DISPLAY_STYLE_POLL);
        $selectFormColorSet->addOptionArray(Xforms\get_css_color());
        $selectFormColorSet->setDescription(_AM_XFORMS_COLOR_SET_DESC);




        $radioFormDefineBegin = new \XoopsFormRadioYN(_AM_XFORMS_DEFINE_BEGIN, 'define_form_begin', (((int)$form->getVar('form_begin') > 0) ? 1 : 0), _YES, _NO);
        $textFormBegin        = new \XoopsFormDateTime(_AM_XFORMS_BEGIN, 'form_begin', 15, $form->getVar('form_begin'));
        $beginTray            = new \XoopsFormElementTray(_AM_XFORMS_BEGIN, '<br>');
        $beginTray->addElement($radioFormDefineBegin);
        $beginTray->addElement($textFormBegin);
        $beginTray->setDescription(_AM_XFORMS_DEFINE_BEGIN_DESC);

        $radioFormDefineEnd = new \XoopsFormRadioYN(_AM_XFORMS_DEFINE_END, 'define_form_end', (((int)$form->getVar('form_end') > 0) ? 1 : 0), _YES, _NO);
        $textFormEnd        = new \XoopsFormDateTime(_AM_XFORMS_END, 'form_end', 15, $form->getVar('form_end'));
        $endTray            = new \XoopsFormElementTray(_AM_XFORMS_END, '<br>');
        $endTray->addElement($radioFormDefineEnd);
        $endTray->addElement($textFormEnd);
        $endTray->setDescription(_AM_XFORMS_DEFINE_END_DESC);

        $selectFormActive = new \XoopsFormRadioYN(_AM_XFORMS_ACTIVE, 'form_active', (((int)$form->getVar('form_active') > 0) ? 1 : 0), _YES, _NO);
        $selectFormActive->setDescription(_AM_XFORMS_ACTIVE_DESC);

        //$selectFormAnswer = new \XoopsFormRadioYN(_AM_XFORMS_CONTACT_XFORM, 'form_answer', (((int)$form->getVar('form_answer') > 0) ? 1 : 0), _YES, _NO);
        $selectFormAnswer = new \XoopsFormRadio(_AM_XFORMS_TYPE_XFORM, 'form_answer', $form->getVar('form_answer'));
        $selectFormAnswer->addoption(0, _AM_XFORMS_CLASSIC_XFORM);
        $selectFormAnswer->addoption(1, _AM_XFORMS_CONTACT_XFORM);
        $selectFormAnswer->addoption(2, _AM_XFORMS_INFORMATION_XFORM);
        $selectFormAnswer->setDescription(_AM_XFORMS_TYPE_XFORM_DESC);

        $hiddenOp = new \XoopsFormHidden('op', 'saveform');
        $submit   = new \XoopsFormButton('', 'submit', _AM_XFORMS_SAVE, 'submit');
        $submit1  = new \XoopsFormButton('', 'submit', _AM_XFORMS_SAVE_THEN_ELEMENTS, 'submit');
        $submit2  = new \XoopsFormButton('', 'gotoform', _CANCEL);
        $submit2->setExtra("onclick=\"window.location.href='" . $helper->url('admin/main.php') . "'\"");
        $tray     = new \XoopsFormElementTray('');
        $tray->addElement($submit);
        $tray->addElement($submit1);
        $tray->addElement($submit2);

        $hiddenFormId = $cloneFormId = '';

        if (empty($formId)) {
            $caption = _AM_XFORMS_NEW;
        } else {
            if ($clone) {
                $caption       = sprintf(_AM_XFORMS_COPIED, $form->getVar('form_title'));
                $cloneFormId   = new \XoopsFormHidden('clone_form_id', $formId);
                $textFormTitle = new \XoopsFormText(_AM_XFORMS_TITLE, 'form_title', 50, 255, sprintf(_AM_XFORMS_COPIED, $form->getVar('form_title', 'e')));
            } else {
                $caption       = sprintf(_AM_XFORMS_EDIT, $form->getVar('form_title'));
                $hiddenFormId = new \XoopsFormHidden('form_id', $formId);
            }
        }
        $output = new \XoopsThemeForm($caption, 'editform', $_SERVER['SCRIPT_NAME'], 'post', true);
        $output->addElement($textFormTitle, true);
        $output->addElement($tareaFormDesc);
        $output->addElement($selectFormActive);
        $output->addElement($selectFormAnswer);
        $output->addElement($textFormOrder);
        $output->addElement($selectFormDisplayStyle);
        $output->addElement($selectFormColorSet);


        $output->addElement($beginTray);
        $output->addElement($endTray);
        $output->addElement($tareaFormIntro);
        $output->addElement($selectFormDelimiter);
        $output->addElement($submitFormSubmitText, true);
        $output->addElement($textFormWhereTo);
        $output->addElement($selectFormGroupPerm);
        $output->addElement($selectFormSaveDb);
        $output->addElement($textFormContactLabel);
        $output->addElement($selectFormSendMethod);
        $output->addElement($selectFormSendToGroup);
        $output->addElement($textFormSendToOther);
        $output->addElement($selectFormSendCopy);
        $output->addElement($tareaFormEmailHeader);
        $output->addElement($tareaFormEmailFooter);
        $output->addElement($tareaFormEmailUheader);
        $output->addElement($tareaFormEmailUfooter);
        $output->addElement($hiddenOp);
        if ($hiddenFormId instanceof \XoopsFormHidden) {
            $output->addElement($hiddenFormId);
        }
        if ($cloneFormId instanceof \XoopsFormHidden) {
            $output->addElement($cloneFormId);
        }
        $output->addElement($tray);
        $output->display();




















include __DIR__ . '/admin_footer.php';
xoops_cp_footer();
