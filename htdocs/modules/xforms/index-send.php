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
 * @package   \XoopsModules\Xforms\frontside
 * @author    XOOPS Module Development Team
 * @copyright Copyright (c) 2001-2019 {@link https://xoops.org XOOPS Project}
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 * @since     1.30
 */
use Xmf\Request;
use XoopsModules\Xforms;
use XoopsModules\Xforms\Constants;
use XoopsModules\Xforms\Captcha;
use XoopsModules\Xforms\Utility;
use XoopsModules\Xforms\MediaUploader;
use Xmf\FilterInput;

require __DIR__ . '/header.php';
require_once 'include/functions.php';
$myts   = \MyTextSanitizer::getInstance();

/* @var string $moduleDirName  */
/* @var \XoopsModules\Xforms\Helper $helper */
$helper->loadLanguage('admin');

$submit = Request::getCmd('submit', '', 'POST');
            require_once $GLOBALS['xoops']->path('/header.php');
            Xforms\load_css();

begin_proc:
/* ========================================================================== */
//-------------------------------
// Now execute the form
//-------------------------------
/* @var \XoopsSecurity $xoopsSecurity */
if (!$xoopsSecurity->check()) {
    $helper->redirect('index.php', Constants::REDIRECT_DELAY_MEDIUM, implode('<br>', $xoopsSecurity->getErrors()));
}

$formId = Request::getInt('form_id', 0, 'POST');
if (empty($formId)
    || !($form = $formsHandler->get($formId))
    || (false === $formsHandler->getSingleFormPermission($formId)))
{
    header('Location: ' . $GLOBALS['xoops']->url('www'));
    exit();
}
if (!$form->isActive()) {
    $helper->redirect('index.php', Constants::REDIRECT_DELAY_MEDIUM, _MD_XFORMS_MSG_INACTIVE);
}
//---------------------------------------------------------------
$xformsEleHandler = $helper->getHandler('Element');
$criteria = new \CriteriaCompo();
$criteria->add(new \Criteria('form_id', $form->getVar('form_id')), 'AND');
$criteria->add(new \Criteria('ele_display', Constants::ELEMENT_DISPLAY), 'AND');
$criteria->setSort('ele_order');
$criteria->order = 'ASC';
$eleObjArray = $xformsEleHandler->getObjects($criteria, true);

/* @var array $ele */
foreach ($_POST as $k => $v) {
    if (preg_match('/^ele_[0-9]+$/', $k)) {
        $n = explode('_', $k);
        $ele[$n[1]] = $v;
    }
}
$xoopsUploadFile = Request::getArray('xoops_upload_file', array(), 'POST');
if (!empty($xoopsUploadFile)) {
    foreach ($xoopsUploadFile as $k => $v) {
        $n          = explode('_', $v);
        $ele[$n[1]] = $v;
    }
}
    //verifie les email banni
    XoopsModules\Xforms\verifiy_banish($eleObjArray, $ele);
//---------------------------------------------------------------

// JJDai - si le formulaire n�c�ssite une r�ponse creation d'un tableau pour creer un enregistrement dans la table userform
if ($form->getVar('form_answer') == 1){
  $uFormHandler = $helper->getHandler('UserForm');
  $uform = $uFormHandler->get(0);
  $uform->setVar('form_id', $formId);
  //echo "avant : <pre>" .  print_r($uform, true) . "</pre>";
  $uFormHandler->insert($uform);
  //echo "apres : <pre>" .  print_r($uform, true) . "</pre>";
  $uform_id = $uform->getVar('uform_id');
  //echo "<hr>uform_id = {$uform_id}<hr>";
  //exit;
}else{
  $uform = null;
  $uform_id = 0;
}

//exit;



//$msg = $err = $attachments = array();
$msg = $err = array();

// Check captcha
xoops_load('captcha', $moduleDirName);
$xfCaptchaObj = Captcha::getInstance();
if (!$xfCaptchaObj->verify(true, _XFORMS_CPTCHA)) {  //null,'xoopsmodules\xforms\captcha'      null,'xoopscaptcha'
    $err[] = $xfCaptchaObj->getMessage();
}

require_once $helper->path('include/common.php');


/** {@internal $ele values are not sanitized here}} */

// Generate the extra info
$genInfo = array('UID' => '0',
               'UNAME' => '',
                  'IP' => '',
               'AGENT' => ''
);

/*
 * Loops through the elements of the form to save or send e-mail
 */
$uDataHandler = $helper->getHandler('UserData');
$udatas       = array();
$userMailText = ''; // Capturing email for user if have textbox in the form
$tUserMailText = array() ; // Capturing emails for user if have one or many textbox in the form
$saveToDB     = (Constants::SAVE_IN_DB == $form->getVar('form_save_db')) ? true : false;

if (0 == count($err)) {
    if (isset($GLOBALS['xoopsUser']) && ($GLOBALS['xoopsUser'] instanceof XoopsUser)) {
        $genInfo['UID']   = $GLOBALS['xoopsUser']->getVar('uid'); /*Set the user id*/
        $genInfo['UNAME'] = $GLOBALS['xoopsUser']->getVar('uname'); /*Set the user name*/
    }

    $proxy = $_SERVER['REMOTE_ADDR'];
    $ip    = '';
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } elseif (isset($_SERVER['HTTP_PROXY_CONNECTION'])) {
        $ip = $_SERVER['HTTP_PROXY_CONNECTION'];
    } elseif (isset($_SERVER['HTTP_VIA'])) {
        $ip = $_SERVER['HTTP_VIA'];
    }
    $ip = empty($ip) ? $_SERVER['REMOTE_ADDR'] : $ip;
    if ($proxy !== $ip) {
        $ip .= sprintf(_MD_XFORMS_PROXY, $proxy);
    }
    $genInfo['IP']    = $ip; // Set the IP
    $genInfo['AGENT'] = $_SERVER['HTTP_USER_AGENT']; // Set the Agent

    $timeData = time();
    //echo "elements : <pre>" . print_r($eleObjArray, true) . "</pre><hr>";
    
    foreach ($eleObjArray as $eleObj) {
    //echo "elements : <pre>" . print_r($eleObj, true) . "</pre><hr>";
        $eleArray   = $eleObj->getValues(array('ele_id', 'form_id', 'ele_type', 'ele_value', 'ele_req', 'ele_caption'));
        $eleId      = (int)$eleArray['ele_id'];
        $eleType    = FilterInput::clean($eleArray['ele_type'], 'ALPHANUM');
        $eleValue   = $eleArray['ele_value'];
        $eleReq     = (int)$eleArray['ele_req'];
        $eleCaption = Xforms\getHtml($eleArray['ele_caption']);

//    echo "eleArray (contient les donnees saisies): <pre>" . print_r($ele , true) . "</pre><hr>";
        if ('html' === $eleType) {
            $msg[$eleId] = Xforms\getHtml($eleValue[0]); //'<br><br>' .
            continue; // html element does not have data
        }

        $udata      = null;
        $uDataValue = array();
        $ufid       = -1;

        if ($saveToDB) {
            $udata = $uDataHandler->create();
            $udata->setVars(array('uid' => (int)$genInfo['UID'],
                              'form_id' => (int)$formId,
                           'udata_time' => (int)$timeData,
                             'udata_ip' => $genInfo['IP'],
                          'udata_agent' => $genInfo['AGENT'],
                               'ele_id' => $eleId,
                             'uform_id' => $uform_id,    //JJDai
                               )
            );
        }

        $ele[$eleId] = is_scalar($ele[$eleId]) ? trim($ele[$eleId]): $ele[$eleId];
        if (!empty($ele[$eleId])) {
            if ('' !== $eleCaption) {
                $tplTitle = "- <b>%s</b> : "; //JJDai - gras a ajouter en paramettre des formulaire peut �tre
                $msg[$eleId] = sprintf($tplTitle, Xforms\getHtml($eleCaption) );
            }
            //echo "traceElement===>Index<hr>";
            xoops_load('xoopslists');
            switch ($eleType) {
                case 'html':
                    exit("html");
                    break;
                case 'pattern':
                case 'textarea':
                    $msg[$eleId]  .= FilterInput::clean($ele[$eleId], 'STRING'); // @test this value filter
                    $uDataValue[0] = FilterInput::clean($ele[$eleId], 'STRING');
                    //echo "<pre>" . print_r($eleValue, true) . "</pre>";

                    if($eleValue[4] == 1){
                        //echo "<pre>" . print_r($ele[$eleId], true) . "</pre>"; exit;
                        $sep = " \n\t|,;";
                        $email = strtok($uDataValue[0], $sep);
                        while ($email !== false) {
                            $userMailText = checkEmail(trim($email));                        
                            if (!empty($userMailText)) {   
                                $tUserMailText[] = $userMailText;
                            }
                            $email = strtok($sep);
                        }                    
                    }
                    break;
                case 'color':
                    $msg[$eleId]  .= preg_replace('/[^0-9a-f#]/', '', $ele[$eleId]);
                    $uDataValue[0] = preg_replace('/[^0-9a-f#]/', '', $ele[$eleId]);
                    break;
                case 'date':
                    $msg[$eleId]  .= preg_replace('/[^0-9\-]/', '', $ele[$eleId]);
                    $uDataValue[0] = preg_replace('/[^0-9\-]/', '', $ele[$eleId]);
                    break;

                case 'email':
                    $email = FilterInput::clean($ele[$eleId], 'EMAIL'); // @test this value filter
                    $msg[$eleId]  .= $email;
                    $uDataValue[0] = $email;
                    $tUserMailText[] = $uDataValue[0];

                    //if (is_null($uform->getVar('uform_email'))) $uform->setVar('uform_email', $email);
                    if ($uform->getVar('uform_email') == '') $uform->setVar('uform_email', $email);

                    //echo "email===>{$uDataValue[0]}<br>";
                    //exit;
                    break;
                case 'number':
                    $msg[$eleId]  .= FilterInput::clean($ele[$eleId], 'INT'); // @test this value filter
                    $uDataValue[0] = FilterInput::clean($ele[$eleId], 'INT');
                    break;

                case 'chrono':
                    $tChrono = Xforms\format_chrono($eleArray); //$eleId  //[$eleId]
                    $chrono = $tChrono[1];
                    //$chrono = Xforms\format_chrono($eleArray); //$eleId  //[$eleId]
                    //echo "<pre>" . print_r($ele, true) . "</pre>"; exit;
                    $msg[$eleId]  .= FilterInput::clean($chrono, 'STRING');
                    $uDataValue[0] = FilterInput::clean($chrono, 'STRING');

                    if ($uform->getVar('uform_chrono') == '') $uform->setVar('uform_chrono', $tChrono[0]);

                    break;
                case 'timestamp':
                    $timestamp = Xforms\format_timestamp($eleArray['ele_value']);
                    //echo "<pre>" . print_r($ele, true) . "</pre>"; exit;
                    $msg[$eleId]  .= FilterInput::clean($timestamp, 'STRING');
                    $uDataValue[0] = FilterInput::clean($timestamp, 'STRING');
                    break;
                case 'range':
                    $msg[$eleId]  .= FilterInput::clean($ele[$eleId], 'FLOAT'); // @test this value filter
                    $uDataValue[0] = FilterInput::clean($ele[$eleId], 'FLOAT');
                    break;
                case 'time':
                    $msg[$eleId]  .= preg_replace('/[^0-9:]/', '', $ele[$eleId]);
                    $msg[$eleId]  .= preg_replace('/[^0-9:]/', '', $ele[$eleId]);
                    break;
                case 'url':
                    $msg[$eleId]  .= FilterInput::clean($ele[$eleId], 'WEBURL'); // @test this value filter
                    $uDataValue[0] = FilterInput::clean($ele[$eleId], 'WEBURL');
                    break;

                case 'checkbox':
                    $opt_count = 1;
                    $ch        = array();
                    foreach ($eleValue as $key=>$v) {
                    //while ($v = each($eleValue)) {
                        if (is_array($ele[$eleId])) {
                            if (in_array($opt_count, $ele[$eleId])) {
                                $other = Utility::checkOther($key, $eleId, $eleCaption);
                                if (false !== $other) {
                                    $ch[] = $other;
                                } else {
                                    $ch[] = $key;
                                }
                            }
                            ++$opt_count;
                        } else {
                            if (!empty($ele[$eleId])) {
                                $ch[] = $v['key'];
                            }
                        }
                    }
                    $msg[$eleId] .= !empty($ch) ? implode('<br>', $ch) : '';
                    $uDataValue   = $ch;
                    break;

                case 'obfuscated':
                    /** {@internal set msg to '***** - not transmitted in email'}}} */
                    $s             = '';
                    $data          = FilterInput::clean($ele[$eleId], 'STRING'); // @test this value filter
                    $msg[$eleId]  .= str_pad($s, strlen($data), '*');
                    $uDataValue[0] = $data;
                    break;

                case 'radio':
                    $opt_count = 1;
                    foreach ($eleValue as $key=>$v) {
                    //while ($v = each($eleValue)) {
                        if ($opt_count == $ele[$eleId]) {
                            $other = Utility::checkOther($key, $eleId, $eleCaption);
                            if (false !== $other) {
                                $msg[$eleId] .= FilterInput::clean($other, 'STRING');
                                $uDataValue[] = FilterInput::clean($other, 'STRING');
                                //$msg[$eleId] .= $other;
                                //$uDataValue[] = $other;
                            } else {
                                $msg[$eleId] .= $key;
                                $uDataValue[] = $key;
                            }
                        }
                        ++$opt_count;
                    }
                    break;

                case 'select':
                    $opt_count = 1;
                    $ch        = array();
                    if (is_array($ele[$eleId])) {
                        foreach ($eleValue[2] as $key=>$v) {
                        //while ($v = each($eleValue[2])) {
                            if (in_array($opt_count, $ele[$eleId])) {
                                $ch[] = $key;
                            }
                            ++$opt_count;
                        }
                    } else {
                        foreach ($eleValue[2] as $key=>$j) {
                        //while ($j = each($eleValue[2])) {
                            if ($opt_count == $ele[$eleId]) {
                                $ch[] = $key;
                            }
                            ++$opt_count;
                        }
                    }
                    $msg[$eleId] .= !empty($ch) ? implode('<br>', $ch) : '';
                    $uDataValue   = $ch;
                    break;

                case 'select2': //left for backward compatibility w/ v2.00 ALPHA 1
                case 'country':
                    $countries = \XoopsLists::getCountryList();
                    if (is_array($ele[$eleId])) {
                        $cntryList = '';
                        foreach ($ele[$eleId] as $thisVal) { // @FIXME: does this $ele[] needs to be filtered?
                            if (!empty($cntryList)) {
                                $cntryList .= ',';
                            }
                            $cntryList .= array_key_exists($thisVal, $countries) ? $countries[$thisVal] : '';
                        }
                        $msg[$eleId]  .= $cntryList;
                        $uDataValue[0] = $cntryList;
                    } else {
                        $msg[$eleId]  .= $countries[$ele[$eleId]];
                        $uDataValue[0] = $countries[$ele[$eleId]];
                    }
                    break;

                case 'text':
                    if (preg_match('/\{EMAIL\}/', $eleValue[2])) {
                        if (!checkEmail($ele[$eleId])) {
                            $err[] = _MD_XFORMS_ERR_INVALIDMAIL;
                        } else {
                            $reply_mail = $ele[$eleId];
                        }
                    }
                    if (preg_match('/\{UNAME\}/', $eleValue[2])) {
                        $reply_name = $ele[$eleId];  // @FIXME: this $ele[] needs to be filtered
                    }
                    $msg[$eleId]  .= $ele[$eleId]; // @FIXME: this $ele[] needs to be filtered
                    $uDataValue[0] = $ele[$eleId];

                    /* Obtain the user email from the form */
                  // JJDai - Ajout d'un test  $eleValue[3]==1 -
                  // si $eleValue[3]=)2 le champ contient le nom pour la r�ponse, donc pas de controle sur email
                    $userMailText = checkEmail(trim($ele[$eleId]));
                    if ((!empty($eleValue[3])) && ($eleValue[3]==1) && !empty($userMailText)) {   
                            $tUserMailText[] = $userMailText;
                    }
                    //echo "===>{$userMailText}<br>";
                    //exit;
                    break;

                   /*
                    if ((!empty($eleValue[3])) && ($eleValue[3]==1) && empty($userMailText) && !empty($ele[$eleId])) {
                        if (checkEmail($ele[$eleId])) {
                            $userMailText = $ele[$eleId];
                        } else {
                            $err[] = _MD_XFORMS_ERR_INVALIDMAIL;
                        }
                    }
                   */
                    // JJDai - ajout des info dans le cas d'un formulaire n�c�ssitant une r�ponse comme un formulaire de contact
                    //echo "<hr>form_id = {$eleId}<br>POST : <pre>". print_r($ele, true)  . "</pre>";
                    if ($eleValue[3] == 1) {
                        $uform->setVar('uform_email', $ele[$eleId]) ;
                        $email = FilterInput::clean($ele[$eleId], 'EMAIL'); // @test this value filter
                        if ($uform->getVar('uform_email') == '') $uform->setVar('uform_email', $email);
                    }elseif ($eleValue[3] == 2) {
                        $uform->setVar('uform_user', $ele[$eleId]);
                        if ($uform->getVar('uform_user') == '') $uform->setVar('uform_user', $ele[$eleId]);
                    }elseif ($eleValue[3] == 3) {
                        $uform->setVar('uform_object', $ele[$eleId]);
                        if ($uform->getVar('uform_object') == '') $uform->setVar('uform_object', $ele[$eleId]);
                    }



                    break;

                case 'yn':
                    $v = (2 == $ele[$eleId]) ? _NO : _YES;
                    $msg[$eleId]  .= $v;
                    $uDataValue[0] = $v;
                    break;

                case 'upload':
                case 'uploadimg':
                    if (isset($_FILES['ele_' . $eleId]) && !empty($_FILES['ele_' . $eleId]['name'])) {
                        /*
                        if (!class_exists('\XoopsModules\Xforms\MediaUploader')) {
                            xoops_load('MediaUploader', $moduleDirName);
                        }
                        */
                        $maxSize   = empty($eleValue[0]) ?    0 : (int)$eleValue[0];
                        $ext       = empty($eleValue[1]) ? null : explode('|', $eleValue[1]);
                        $mime      = empty($eleValue[2]) ? null : explode('|', $eleValue[2]);
                        $maxWidth  = empty($eleValue[4]) ? null : (int)$eleValue[4];
                        $maxHeight = empty($eleValue[5]) ? null : (int)$eleValue[5];

//                        if ('uploadimg' === $eleType) {
                            $uploader[$eleId] = new MediaUploader(XFORMS_UPLOAD_PATH, $maxSize, $ext, $mime, $maxWidth, $maxHeight);
//                        } else {
//                            $uploader[$eleId] = new \MediaUploader(XFORMS_UPLOAD_PATH, $maxSize, $ext, $mime);
//                        }
                        if (0 == $eleValue[0]) {
                            $uploader[$eleId]->setNoAdminSizeCheck(true);
                        }
                        if ($uploader[$eleId]->fetchMedia('ele_' . $eleId, null, $eleObj)) {
                            $uploader[$eleId]->prefix = $formId . '_';
                            if (false === $uploader[$eleId]->upload()) {
                                $err = array_merge($err, $uploader[$eleId]->getErrors(false));
                            } else {
                                $saved      = $uploader[$eleId]->savedFileName;
                                $uploaded[] = array('id' => $eleId,
                                                  'file' => $saved,
                                                  'name' => $_FILES['ele_' . $eleId]['name'],
                                                'saveto' => $eleValue[3]
                                );
                                $uDataValue = array('file' => $saved,
                                                    'name' => $_FILES['ele_' . $eleId]['name']
                                );
                                $ufid       = count($uploaded) - 1;
                            }
                        } else {
                            if (count($uploader[$eleId]->errors) > 0) {
                                $err = array_merge($err, $uploader[$eleId]->getErrors(false));
                            }
                        }
                    }
                    break;

                default:
                    break;
            }
        } elseif (Constants::ELEMENT_REQD == $eleReq) {
            $err[] = sprintf(_MD_XFORMS_ERR_REQ, $eleCaption);
        }



        
        if ($saveToDB) {
            $udata->setVar('udata_value', $uDataValue);
            $udatas[] = $udata;
            $newKey = $uDataHandler->insert($udata);
            if (false === $newKey) {
                $err = array_merge($err, $udata->getErrors());
            }
            if ($ufid >= 0) {
                $uploaded[$ufid]['udata_id'] = $udata->getVar('udata_id');
            }
        }
    } //  fin de la boucle for

    
    //-----------------------------------------
    //Enregistrement des infos si le formulaire n�c�ssite une r�ponse
    if (!is_null($uform)) {
      if (count($err) == 0) {
        $uform->unsetNew();
        $uFormHandler->insert($uform);
      }else{
        $uFormHandler->delete($uform);
      }
    }
}

/*************************************************************************
 * Send forms if "form_send_method" is "e" or "p", "n" for not send
 *************************************************************************/

if ((0 == count($err)) && (Constants::SEND_METHOD_NONE !== $form->getVar('form_send_method'))) {
    /*
     * Include message template
     */
    if (is_dir(XFORMS_ROOT_PATH . 'language/' . $GLOBALS['xoopsConfig']['language'] . '/mail_template')) {
        $templateDir = XFORMS_ROOT_PATH . 'language/' . $GLOBALS['xoopsConfig']['language'] . '/mail_template/';
    } else {
        $templateDir = XFORMS_ROOT_PATH . 'language/english/mail_template/';
    }

    /* Mail to sending internal */  //JJDai - email
    $interMail = xoops_getMailer();
    $interMail->setHTML();
    $interMail->setTemplateDir($templateDir);
    $interMail->setTemplate('xforms.tpl');
    $title =  html_entity_decode($form->getVar('form_title'), ENT_QUOTES);
    $interMail->setSubject(sprintf(_MD_XFORMS_MSG_SUBJECT, $GLOBALS['xoopsConfig']['sitename'], $title));
//     echo  "<pre>" . html_entity_decode($form->getVar('form_title'),ENT_QUOTES) . "</pre><br>";
//     echo  "<pre>" . $form->getVar('form_title') . "</pre><br>";
    //exit;

    /*
     * Add extra general info
    */
    $interMail->assign(array('UNAME' => '',
                             'ULINK' => '',
                                'IP' => '',
                             'AGENT' => '',
                           'FORMURL' => '')
    );

    $xformsMoreInfoConfig = $helper->getConfig('moreinfo');
    if (in_array('user', $xformsMoreInfoConfig)) {
        if (isset($GLOBALS['xoopsUser']) && ($GLOBALS['xoopsUser'] instanceof XoopsUser)) {
            $interMail->assign('UNAME', sprintf(
                _MD_XFORMS_MSG_UNAME,
                $GLOBALS['xoopsUser']->getVar('uname'))
            );
            $interMail->assign('ULINK', sprintf(
                _MD_XFORMS_MSG_UINFO,
                $GLOBALS['xoops']->url('userinfo.php?uid=' . $GLOBALS['xoopsUser']->getVar('uid')))
            );
        } else {
            $interMail->assign('UNAME', sprintf(
                _MD_XFORMS_MSG_UNAME,
                $GLOBALS['xoopsConfig']['anonymous'])
            );
            $interMail->assign('ULINK', '');
        }
    }
    if (in_array('ip', $xformsMoreInfoConfig)) {
        $proxy = $_SERVER['REMOTE_ADDR'];
        $ip    = '';
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_PROXY_CONNECTION'])) {
            $ip = $_SERVER['HTTP_PROXY_CONNECTION'];
        } elseif (isset($_SERVER['HTTP_VIA'])) {
            $ip = $_SERVER['HTTP_VIA'];
        }
        $ip = empty($ip) ? $_SERVER['REMOTE_ADDR'] : $ip;
        if ($proxy !== $ip) {
            $ip = $ip . sprintf(_MD_XFORMS_PROXY, $proxy);
        }
        $interMail->assign('IP', sprintf(_MD_XFORMS_MSG_IP, $ip));
    }
    if (in_array('agent', $xformsMoreInfoConfig)) {
        $interMail->assign('AGENT', sprintf(_MD_XFORMS_MSG_AGENT, $_SERVER['HTTP_USER_AGENT']));
    }
    if (in_array('form', $xformsMoreInfoConfig)) {
        $interMail->assign('FORMURL', sprintf(
            _MD_XFORMS_MSG_FORMURL,
            $helper->url('index.php?form_id=' . $formId))
        );
    }

    /*
     * Set header and footer of email
     */
    $eheader = Xforms\getHtml($form->getVar('form_email_header'));
    $efooter = Xforms\getHtml($form->getVar('form_email_foter'));
    $interMail->assign('EHEADER', $eheader);
    $interMail->assign('EFOOTER', $efooter);

/* JJDai - ces tests ne sert pas grand chose il me semble
    if (empty($eheader)) {
        $interMail->assign('EHEADER', '');
    } else {
        $interMail->assign('EHEADER', $eheader);
    }

    if (empty($efooter)) {
        $interMail->assign('EFOOTER', '');
    } else {
        $interMail->assign('EFOOTER', $efooter);
    }
*/

    /*
     * Prepare mail copy for user
     */
    $copyMail = $copyMsg = null;
    $sendCopy = (0 !== ((int)$form->getVar('form_send_copy'))) ? true : false;
    if ($sendCopy) {
        $copyMail = xoops_getMailer();
        $copyMail->setHTML();
        $copyMail->setTemplateDir($templateDir);
        $copyMail->setTemplate('xforms_copy.tpl');
        $copyMail->setSubject(sprintf(_MD_XFORMS_MSG_SUBJECT_COPY, $title));
        $mailCharset = $helper->getConfig('mail_charset');
        $charset = !empty($mailCharset) ? $mailCharset : _CHARSET;
        $copyMail->charSet = $charset;

        /* Set header and footer of email */
        $euheader = Xforms\getHtml($form->getVar('form_email_uheader'));
        if (empty($euheader)) {
            $copyMail->assign('EHEADER', '');
        } else {
            $copyMail->assign('EHEADER', $euheader);
        }
        $eufooter = Xforms\getHtml($form->getVar('form_email_ufooter'));
        if (empty($eufooter)) {
            $copyMail->assign('EFOOTER', '');
        } else {
            $copyMail->assign('EFOOTER', $eufooter);
        }
        $copyMsg = $msg;
    }

    /*
     * Send form by selected method
     */
    $send_group = (int)$form->getVar('form_send_to_group');
    $group      = false;
    if (-1 !== $send_group) {
        $group = $member_handler->getGroup($send_group);
    }
    if (Constants::SEND_METHOD_PM == $form->getVar('form_send_method') 
        && (isset($GLOBALS['xoopsUser']) 
        && ($GLOBALS['xoopsUser'] instanceof XoopsUser)) 
        && (false !== $group)) {
//exit('000');
        /* Send by private message */
        $interMail->setTemplate('xforms_pm.tpl');
        $interMail->usePM();
        $interMail->setToGroups($group);
    } else {
        /* Send by e-mail */
        $interMail->useMail();
        $interMail->setFromName($GLOBALS['xoopsConfig']['sitename']);
        $interMail->setFromEmail($GLOBALS['xoopsConfig']['adminmail']);
        if (isset($reply_mail)) {
            $interMail->multimailer->addReplyTo($reply_mail, isset($reply_name) ? '"' . $reply_name . '"' : null);
        }
        $mailCharset        = $helper->getConfig('mail_charset');
        $charset            = !empty($mailCharset) ? $mailCharset : _CHARSET;
        $interMail->charSet = $charset;
        if ($send_group > 0) {
            /* Setting the selected groups */
            $interMail->setToGroups($group);     
//exit('001');
        } else {                                     
            if (-1 == $send_group) {                
//exit('002');
                /* Setting the emails specifics */
                $emailsto = explode(';', $form->getVar('form_send_to_other'));
                if (!empty($emailsto)) {             
//exit('003');
                    $interMail->setToEmails($emailsto);
                    echo "<hr><pre>zzz : " . print_r($emailsto, true) . "</pre><hr>";  
                            
                } else {                           
//exit('004');
                    $interMail->setToEmails($GLOBALS['xoopsConfig']['adminmail']);
                }
            } else {                                
//exit('005');
                /* Setting the admin e-mail */
                $interMail->setToEmails($GLOBALS['xoopsConfig']['adminmail']);
            }
        }
    }

    /***********************************************************************
     * Attaching the uploaded files (images and files)
     ***********************************************************************/
    if (isset($uploaded) && (count($uploaded) > 0)) {
        foreach ($uploaded as $a) {
            if (false === $interMail->isMail || $a['saveto']) {
                if ($saveToDB) {
                    $msg[$a['id']] .= sprintf(
                        _MD_XFORMS_UPLOADED_FILE,
                        '<a href="' . $helper->url('file.php?ui=' . $a['udata_id'] . '&fm=' . $formId . '&el=' . $a['id']) . '">' . $a['name'] . '</a>'
                    );
                } else {
                    $msg[$a['id']] .= sprintf(_MD_XFORMS_UPLOADED_FILE, '<a href="' . $helper->url('file.php?f=' . $a['file'] . '&fn=' . $a['name']) . '">' . $a['name'] . '</a>');
                }
            } else {
                if ($interMail->multimailer->addAttachment(XFORMS_UPLOAD_PATH . "/{$a['file']}", $a['name'])) {
                    $msg[$a['id']] .= sprintf(_MD_XFORMS_ATTACHED_FILE, $a['name']);
                } else {
                    $err[] = $interMail->multimailer->ErrorInfo;
                }
            }
            if ($sendCopy) {
                $copyMsg[$a['id']] .= sprintf(_MD_XFORMS_UPLOADED_FILE, $a['name']);
            }
        }
    }
    /************************************************************************
     * Send the message, email or private message and send the copy if the option is selected.
     ************************************************************************/
    if (Constants::SEND_METHOD_PM == $form->getVar('form_send_method')) {
        $msg = implode("\n\n", $msg);
        $msg = preg_replace('/<br>/', "\n", $msg);
//        $msg = strip_tags(htmlspecialchars_decode($msg), '<href>');
        $interMail->assign('MSG', $msg);
    } else {
        $interMail->assign('MSG', implode('<br><br>', $msg));
    }
    if (!$interMail->send(true)) {
        $err = array_merge($err, $interMail->getErrors(false)); // get mail errors as an array
    }
    if ($sendCopy && (0 == count($err))) {
        $emailstoCopy = array();
        //modif JJDai : l'email saisi n'est pas forcement celui de l'utilisateur connect�
        //aussi il faut d(abord v�rifier si un email a ete saisi)
        $uMailText = checkEmail(trim($userMailText));
        
        if (count($tUserMailText) > 0){
            for($h=0; $h < count($tUserMailText); $h++){
                $emailstoCopy[] = $tUserMailText[$h];
            }
        }elseif(isset($GLOBALS['xoopsUser']) && ($GLOBALS['xoopsUser'] instanceof XoopsUser)){
            $emailstoCopy[] = $GLOBALS['xoopsUser']->getVar('email');
        }
//         if (!is_null($uMailText)){
//             $emailstoCopy[] = $uMailText;
//         }elseif(isset($GLOBALS['xoopsUser']) && ($GLOBALS['xoopsUser'] instanceof XoopsUser)){
//             $emailstoCopy[] = $GLOBALS['xoopsUser']->getVar('email');
//         }
 /*
        if (isset($GLOBALS['xoopsUser']) && ($GLOBALS['xoopsUser'] instanceof XoopsUser) && false) {
            $emailstoCopy[] = $GLOBALS['xoopsUser']->getVar('email');
        } elseif ($uMailText = checkEmail(trim($userMailText))) {
            $emailstoCopy[] = $uMailText;
        }
 */       
 
        $copyMail->setToEmails($emailstoCopy);
        if (!empty($copyMail->toEmails)) {
            $copyMail->assign('MSG', implode('<br><br>', $copyMsg));
            $copyMail->send(true); /* Don't control errors for send copy */
        }
    }
}

// Redirect user to error page on error in the process
if (0 < count($err)) {
//echo "<hr>Liste des formulaires : <pre>". print_r($_POST, true)  . "</pre>";

    //--------------------------------------------
    // retour avec persistance des donn�es saisies
    if (_XFORMS_ERR_ON_CAPTCHA == 1) {
      $submit=null;
      //$_POST = array();
      $_GET = array('form_id'=>$formId);
      goto begin_proc;
    }
    //--------------------------------------------

    if (isset($uploaded) && (count($uploaded) > 0)) {
        foreach ($uploaded as $u) {
            @unlink(XFORMS_UPLOAD_PATH . "/{$u['file']}");
        }
    }
    if ($saveToDB) {
        if (!empty($udatas) && (count($udatas) > 0)) {
            foreach ($udatas as $ud) {
                $uDataHandler->delete($ud);
            }
        }
    }
//exit ("Erreur de saisie du captcha<hr>");
    $GLOBALS['xoopsOption']['template_main'] = 'xforms_error.tpl';
    include_once $GLOBALS['xoops']->path('header.php');
    $GLOBALS['xoopsTpl']->assign(array('error_heading' => _MD_XFORMS_ERR_HEADING,
                                              'errors' => $err,
                                             'go_back' => _BACK,
                                          'xforms_url' => 'javascript:history.go(-1)',
                                          //'xforms_url' => $helper->url('index.php?form_id=' . $formId),
                                     'xoops_pagetitle' => _MD_XFORMS_ERR_HEADING)
    );
    include $GLOBALS['xoops']->path('/footer.php');
//    echo "fin===>Erreur de saisie du captcha<hr>";
    exit();
}

/*
 * Redirect the user to the success page on send the form
 */
$whereto = $form->getVar('form_whereto');
$whereto = (!empty($whereto)) ? str_replace('{SITE_URL}', $GLOBALS['xoops']->url('www'), $whereto) : $GLOBALS['xoops']->url('www/index.php');
redirect_header($whereto, Constants::REDIRECT_DELAY_NONE, _MD_XFORMS_MSG_SENT);
