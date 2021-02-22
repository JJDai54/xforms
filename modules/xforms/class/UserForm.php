<?php

namespace XoopsModules\Xforms;

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
 * Module: Xforms
 *
 * @package   \XoopsModules\Xforms\class
 * @author    XOOPS Module Development Team
 * @copyright Copyright (c) 2001-2017 {@link https://xoops.org XOOPS Project}
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 * @since     1.30
 */
use XoopsModules\Xforms\Constants;
use XoopsModules\Xforms\Helper as xHelper;
use XoopsModules\Xforms\FormCaptcha;
use XoopsModules\Xforms\ElementRenderer;

/**
 * Class \XoopsUserForm\Xforms\UserForm
 */
class UserForm extends \XoopsObject
{
    /**
     * @var string this module's directory
     */
    protected $dirname;

    /**
     * XformsForms constructor
     */
    public function __construct()
    {
        /**@todo set var options for form_save_db, form_send_method, form_delimiter, form_display_style, form_active
         * for example
         * $this->initVar('form_save_db', XOBJ_DTYPE_INT, Constants::SAVE_IN_DB, true, 1, Constants::SAVE_IN_DB|Constants::DO_NOT_SAVE_IN_DB);
         * $this->initVar('form_send_method', XOBJ_DTYPE_TXTBOX, Constants::SEND_METHOD_MAIL, true, 1, Constants::SEND_METHOD_MAIL|Constants::SEND_METHOD_PM|Constants::SEND_METHOD_NONE);
         * $this->initVar('form_delimiter', XOBJ_DTYPE_TXTBOX, Constants::DELIMITER_SPACE, true, 1, Constants::DELIMITER_SPACE|Constants::DELIMITER_BR);
         * $this->initVar('form_display_style', XOBJ_DTYPE_TXTBOX, Constants::FORM_DISPLAY_STYLE_FORM, true, 1, Constants::FORM_DISPLAY_STYLE_FORM|Constants::FORM_DISPLAY_STYLE_POLL);
         * $this->initVar('form_active', XOBJ_DTYPE_INT, Constants::FORM_ACTIVE, true, Constants::FORM_ACTIVE|Constants::FORM_INACTIVE);
         */
        parent::__construct();
//public function initVar($key, $data_type, $value = null, $required = false, $maxlength = null, $options = '', $enumerations = '')
        $this->initVar('uform_id', XOBJ_DTYPE_INT);
        $this->initVar('form_id', XOBJ_DTYPE_INT);
        $this->initVar('uform_status', XOBJ_DTYPE_INT, 0, false);
        $this->initVar('uform_user', XOBJ_DTYPE_TXTBOX, '', true, 80);
        $this->initVar('uform_email', XOBJ_DTYPE_TXTBOX, '', true, 80);
        $this->initVar('uform_chrono', XOBJ_DTYPE_TXTBOX, '', true, 50);
        $this->initVar('uform_object', XOBJ_DTYPE_TXTBOX, '', true, 80);
        $this->initVar('uform_answer', XOBJ_DTYPE_TXTAREA);

        $this->dirname = basename(dirname(__DIR__));
    }

    /**
     * Check to see if status of userfrom
     * 0: =attente de reponse - 1=repondu
     * @return bool
     */
    public function getStatus()
    {
        return (int)$this->getVar('uform_status');
    }


    /**
     * Render the UserForm
     *
     * @since v2.00 ALPHA 2
     * @return boolean|array false on error|array containing variables for template
     */
    public function render($data=null)
    {
        // Instantiate
        /* @var \XoopsModules\Xforms\Helper $helper */
        $helper = xHelper::getInstance();     // module helper
        $myts = \MyTextSanitizer::getInstance();
/*
        if ((Constants::FORM_HIDDEN == $this->getVar('form_order'))
            && (!(isset($GLOBALS['xoopsUser']) || !$helper->isUserAdmin()))) {
            $this->setErrors(_NOPERM);
            return false;
        }

        xoops_load('xoopsformloader');
        //require_once $helper->path('class/ElementRenderer.php');
        $xformsEleHandler = $helper::getInstance()->getHandler('Element');
        //$xformsEleHandler = $helper->getHandler('Element');

        $helper->loadLanguage('admin');
        $helper->loadLanguage('main');

        // Read form elements
        $criteria = new \CriteriaCompo();
        $criteria->add(new \Criteria('form_id', $this->getVar('form_id')));
        $criteria->add(new \Criteria('ele_display', Constants::ELEMENT_DISPLAY));
        $criteria->setSort('ele_order');
        $criteria->oOrder = 'ASC';
        $eleObjects = $xformsEleHandler->getObjects($criteria, true);

        if (empty($eleObjects)) { // this form doesn't have any elements
            $this->setErrors(sprintf(_MD_XFORMS_ELE_ERR, $this->getVar('form_title'), 's'));
            return false;
        }

        $formOutput = new \XoopsThemeForm($this->getVar('form_title'), 'xforms_' . $this->getVar('form_id'), $helper->url('index.php'), 'post', true);
        $eleCount = 1;
        $multipart = false;
        foreach ($eleObjects as $elementObj) {
            $eleRenderer = new ElementRenderer($elementObj);
            $formEle     = $eleRenderer->constructElement(false, $this->getVar('form_delimiter'),$data);
            $req         = (Constants::ELEMENT_REQD !== (int)$elementObj->getVar('ele_req')) ? false : true;
            if (1 === $eleCount) {
                $formEle->setExtra('autofocus');  //give the 1st element focus on form load
            }
            $formEle->setExtra('tabindex="' . $eleCount++ . '"'); // allow tabbing through fields on form
            if (in_array($elementObj->getVar('ele_type'), array('upload', 'uploadimg'))) {
                $multipart = true; // will be a multipart form
            }
            $formOutput->addElement($formEle, $req);
            unset($formEle);
        }

        if ($multipart) { // set multipart attribute for form
            $formOutput->setExtra('enctype="multipart/form-data"');
        }
        $formOutput->addElement(new \XoopsFormHidden('form_id', $this->getVar('form_id')));

        // Load captcha
        //$xoopsUser = $GLOBALS['xoopsUser'];
        global $xoopsUser;
        if(!is_object($xoopsUser)){
          xoops_load('formCaptcha', $this->dirname);
          $xfFormCaptcha = new FormCaptcha(); // jjd-captcha
          $xfFormCaptcha->setExtra("autocomplete='off'");
          $formOutput->addElement($xfFormCaptcha);
        }

        $subButton = new \XoopsFormButton('', 'submit', $this->getVar('form_submit_text'), 'submit');
        $subButton->setExtra('tabindex="' . $eleCount++ . '"'); // allow tabbing to the Submit button too
        $formOutput->addElement($subButton, 1);

        $eles = array();
        foreach ($formOutput->getElements() as $currElement) {
            $id = $req = $name = $ele_type = false;
            $name    = $currElement->getName();
            $caption = $currElement->getCaption();
            if (!empty($name)) {
                $id = str_replace('ele_', '', $currElement->getName());
            } elseif (method_exists($currElement, 'getElements')) {
//            } elseif (method_exists($currElement, 'getElements') && is_callable('getElements')) {
                $obj = $currElement->getElements();
                if (count($obj) > 0) {
                    $id  = str_replace('ele_', '', $obj[0]->getName());
                    $id  = str_replace('[]', '', $id);
                }
            }
            $req         = false;
            $display_row = 1;
            if (isset($eleObjects[$id])) {
                $req         = $eleObjects[$id]->getVar('ele_req') ? true : false;
                $ele_type    = $eleObjects[$id]->getVar('ele_type');
                $display_row = (int)$eleObjects[$id]->getVar('ele_display_row');
            }

            $eles[] = array('caption' => Xforms\getHtml($caption),
                               'name' => $name,
                               'body' => $currElement->render(),
                             'hidden' => $currElement->isHidden(),
                           'required' => $req,
                        'display_row' => $display_row,
                           'ele_type' => $ele_type
            );
        }

        $js          = $formOutput->renderValidationJS();
        $isHiddenTxt = (Constants::FORM_HIDDEN == $this->getVar('form_order')) ? _MD_XFORMS_FORM_IS_HIDDEN : '';

        $assignArray = array('form_output' => array('title' => $formOutput->getTitle(),
                                                     'name' => $formOutput->getName(),
                                                   'action' => $formOutput->getAction(),
                                                   'method' => $formOutput->getMethod(),
                                                    'extra' => 'onsubmit="return xoopsFormValidate_' . $formOutput->getName() . '();"' . $formOutput->getExtra(),
                                               'javascript' => $js,
                                                 'elements' => $eles),
                                          'form_req_prefix' => $helper->getConfig('prefix'),
                                          'form_req_suffix' => $helper->getConfig('suffix'),
                                               'form_intro' => Xforms\getHtml($this->getVar('form_intro')),
                                           'form_color_set' => Xforms\getHtml($this->getVar('form_color_set')),
                                         'form_text_global' => Xforms\getHtml($helper->getConfig('global')),
                                           'form_is_hidden' => $isHiddenTxt,
                                          'xoops_pagetitle' => $this->getVar('form_title'),
                                           'form_edit_link' => $this->getEditLinkInfo()

        );
*/
        return $assignArray;
    }
}