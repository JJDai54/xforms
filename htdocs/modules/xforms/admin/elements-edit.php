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

        xoops_cp_header();
        /* @var \Xmf\Module\Admin $adminObject */
        $adminObject->displayNavigation(basename(__FILE__));
        Xforms\load_css();
/*
        if (!class_exists('XformsFormInput')) {
            include_once $helper->path('class/FormInput.php');
        }
*/
        if (Constants::ELE_NOT_VALID !== (int)$eleId) {
            $element     = $xformsEleHandler->get($eleId);
            $eleType     = $element->getVar('ele_type');
            $outputTitle = (Constants::FORM_CLONED === $clone) ? _AM_XFORMS_ELE_CREATE : sprintf(_AM_XFORMS_ELE_EDIT, Xforms\getHtml($element->getVar('ele_caption')));
        } else {
            $element     = $xformsEleHandler->create();
            $eleType     = mb_strtolower(Request::getCmd('ele_type', 'text'));
            $outputTitle = _AM_XFORMS_ELE_CREATE;
        }

        if ('date' === $eleType) { // only load jquery & modernizr if needed
            $GLOBALS['xoTheme']->addStylesheet('browse.php?modules/' . $moduleDirName . '/assets/css/jquery-ui.min.css');
            $GLOBALS['xoTheme']->addStylesheet('browse.php?modules/' . $moduleDirName . '/assets/css/jquery-ui.structure.min.css');
            $GLOBALS['xoTheme']->addStylesheet('browse.php?modules/' . $moduleDirName . '/assets/css/jquery-ui.theme.min.css');
            $GLOBALS['xoTheme']->addScript('browse.php?modules/' . $moduleDirName . '/assets/js/modernizr-custom.js');
            $GLOBALS['xoTheme']->addScript('browse.php?Frameworks/jquery/jquery.js');
            $GLOBALS['xoTheme']->addScript('browse.php?Frameworks/jquery/plugins/jquery.ui.js');
        }

        $sysHelper  = Helper::getHelper('system');
        $output     = new \XoopsThemeForm($outputTitle, 'form_ele', $_SERVER['SCRIPT_NAME'], 'post', true);

        $value      = $element->getVar('ele_value', 'f');
        $eleReq     = $element->getVar('ele_req');
        $displayRow = $element->getVar('ele_display_row');
        $eleDisplay = $element->getVar('ele_display');
        $eleOrder   = $element->getVar('ele_order');

        if ('html' !== $eleType) {
            // editor settings
            if (_XFORMS_EDITOR_MODE == 1){
//               $editorConfigs = array('editor' => Xforms\get_editor_name(),
//                                        'rows' => 10,
//                                        'cols' => 60,
//                                       'width' => '100%',
//                                      'height' => '350px',
//                                        'name' => 'ele_caption',
//                                       'value' => (Constants::FORM_CLONED === $clone)
//                                                  ? sprintf(_AM_XFORMS_COPIED, $element->getVar('ele_caption', 'e'))
//                                                  : $element->getVar('ele_caption', 'e')
//               );
//               // end editor settings
//               $textEleCaption  = new \XoopsFormEditor(_AM_XFORMS_ELE_CAPTION, 'ele_caption', $editorConfigs);
              $exp = (Constants::FORM_CLONED === $clone)
                                                 ? sprintf(_AM_XFORMS_COPIED, $element->getVar('ele_caption', 'e'))
                                                 : $element->getVar('ele_caption', 'e');
              $textEleCaption = Xforms\get_editor(_AM_XFORMS_ELE_CAPTION, 'ele_caption', $exp, $width='50%', $height = '260px');

            }else{
              $textEleCaption = new \XoopsFormText(_AM_XFORMS_ELE_CAPTION, 'ele_caption', 50, 255, $element->getVar('ele_caption'));
            }
//             if (_XFORMS_EDITOR_MODE == 1){
//             }else{
//               $textEleCaption = new \XoopsFormText(, '', 50, 255, );
//             }

/*
            $captionRenderer = $textEleCaption->editor->renderer;
            if (property_exists($captionRenderer, 'skipPreview')) {
                $textEleCaption->editor->renderer->skipPreview = true;
            }
*/
            $output->addElement($textEleCaption);

            if ('pattern' === $eleType) {
                $checkEleReq = new \XoopsFormHidden('ele_req', Constants::REQUIRED);
            } else {
                $checkEleReq = new \XoopsFormRadioYN(_AM_XFORMS_ELE_REQ, 'ele_req', $eleReq);
            }
            $output->addElement($checkEleReq);

            $checkEleDisplayRow = new \XoopsFormCheckBox(_AM_XFORMS_ELE_DISPLAY_ROW, 'ele_display_row', $displayRow);
            $checkEleDisplayRow->setDescription(_AM_XFORMS_ELE_DISPLAY_ROW_DESC);
            $checkEleDisplayRow->addOption(2, ' ');
            $output->addElement($checkEleDisplayRow);
        } else {
            $textEleCaption = new \XoopsFormText(_AM_XFORMS_ELE_CAPTION, 'ele_caption',50, 255, $element->getVar('ele_caption', 'e'));
            $textEleCaption->setDescription(_AM_XFORMS_ELE_HTML_CAPTION_DESC);
            $output->addElement($textEleCaption);
        }

        $checkEleDisplay = new \XoopsFormRadioYN(_AM_XFORMS_ELE_DISPLAY, 'ele_display', $eleDisplay);
        $output->addElement($checkEleDisplay);
        $orderEleDisp = new FormInput(_AM_XFORMS_ELE_ORDER, 'ele_order', 5, 5, $eleOrder, null, 'number');
        $orderEleDisp->setAttribute('min', 0);
        $orderEleDisp->setExtra('style="width: 5em;"');
        $output->addElement($orderEleDisp);

        $elementName = '';
        $validElements = $xformsEleHandler->getValidElements();
        $validKeys = array_keys($validElements);
        if (in_array($eleType, $validKeys)) {
            $elementName = constant('_AM_XFORMS_ELE_' . strtoupper($eleType));
            include $helper->path('admin/elements/ele_' . $eleType . '.php');
        } else {
            $helper->redirect('admin/index.php',
                                    Constants::REDIRECT_DELAY_MEDIUM,
                                    sprintf(_AM_XFORMS_ERR_BAD_ELEMENT, htmlspecialchars($eleType))
            );
        }

        $output->addElement(new \XoopsFormHidden('op', 'save'));
        $output->addElement(new \XoopsFormHidden('ele_type', $eleType));

        if ((0 === (int)$formId) || (Constants::FORM_CLONED === $clone)) {
            $selectApplyForm = new \XoopsFormSelect(_AM_XFORMS_ELE_APPLY_TO_FORM, 'form_id', $formId);
            $forms           = $formsHandler->getAll(null, null, true, false);
            foreach ($forms as $fObj) {
                $selectApplyForm->addOption($fObj->getVar('form_id'), $fObj->getVar('form_title'));
            }
            $output->addElement($selectApplyForm);
            $output->addElement(new \XoopsFormHidden('clone', Constants::FORM_CLONED));
        } else {
            $output->addElement(new \XoopsFormHidden('form_id', $formId));
        }

        if ((0 !== $eleId) && (Constants::FORM_NOT_CLONED === $clone)) {
            $output->addElement(new \XoopsFormHidden('ele_id', $eleId));
        }
        $tray = new \XoopsFormButtonTray('submit', _SUBMIT, 'submit', null);
        $output->addElement($tray);
        echo '<h4 class="center">' . $elementName . '</h4>';
        $output->display();
