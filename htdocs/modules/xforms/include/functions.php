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
 * @package   \XoopsModules\Xforms\include
 * @author    XOOPS Module Development Team
 * @copyright Copyright (c) 2001-2019 {@link https://xoops.org XOOPS Project}
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 * @since     1.30
 */
namespace XoopsModules\Xforms;

use XoopsModules\Xforms\Helper as xHelper;
use Xmf\Module\Helper\Session;
use Xmf\FilterInput;

require dirname(__DIR__) . '/preloads/autoloader.php';
$helper = xHelper::getInstance();

//define ('_XFORMS_SHOW_TPL_NAME', 0);
define ('_XFORMS_SHOW_TPL_NAME', $helper->getConfig('displayTemplateName'));
define ('_XFORMS_ERR_ON_CAPTCHA', $helper->getConfig('returnModeOnCaptchaErr'));
  
define ('_XFORMS_DIRNAME', basename(dirname(__DIR__)));

define ('_XFORMS_EDITOR_MODE', 0);

define ('_XFORMS_CPTCHA', "xoopscaptcha"); // image
//define ('__XFORMS_DIRNAME', basename(dirname(__DIR__)));
define ('XFORMS_DEFAULT', 'default');

//define ('_XFORMS_CPTCHA', "xformscaptcha"); // text


// define ('_XFORMS_INACTIVE', 0);
// define ('_XFORMS_ACTIVE', 1);
// define ('_XFORMS_EXPIRED', 2);
/**********************************************
 *
 **********************************************/
function jecho($value, $exp='', $hr=false, $exitMsg=''){
//func_num_args

        echo "{$exp} = {$value}";
        $fl = (($hr) ? "<hr>" : "<br>");
        echo $fl;
        if ($exitMsg) exit($exitMsg);
}
/**********************************************
 *
 **********************************************/
function getHtml($exp){
//global $myts;
  $myts = \MyTextSanitizer::getInstance();
  //return  html_entity_decode($myts->displayTarea($exp));
  return  html_entity_decode($myts->displayTarea($exp));
}

/**********************************************
 *
 **********************************************/
function get_editor($caption, $name, $exp, $width='100%', $height = '260px'){
global $myts;
  $formHtmlConfigs = array('editor' => get_editor_name(),
                             'rows' => 8,
                             'cols' => 30,
                            'width' => $width,
                           'height' => $height,
                             'name' => $name,
                            'value' => $myts->htmlSpecialChars($exp)
  );
  $editor = new \XoopsFormEditor($caption, $name, $formHtmlConfigs);
  return $editor;
}

/**********************************************
 *
 **********************************************/
function get_editor_name($user = 'user'){ //user / admin / sys config
global $xoopsModuleConfig;
  //$sysHelper - > getConfig('general_editor')
  //get_editor_name()
  switch ($user){
  case 'user' :  $editor = $xoopsModuleConfig['editorAdmin']; break;
  case 'admin' : $editor = $xoopsModuleConfig['editorAdmin']; break;
  default :      $editor = $sysHelper->getConfig('general_editor'); break;
  }
  return $editor;

}

/**********************************************
 *
 **********************************************/
function format_chrono_temp($options){
$value    = intval($options[0]);
$nbDigits = intval($options[1]);
$prefix   = $options[3];
$suffix   = $options[4];
$step     = intval($options[2]);
$bold     = intval($options[5]);

//echo "<pre>" . print_r($options, true) . "</pre>";

$codesFormat = "dDjlNSwzWFmMntLoYyaABgGhHisu";

  $v = $value; // + $step
  $chrono = $prefix . str_pad($v , $nbDigits, "0", STR_PAD_LEFT) . $suffix;

  for($h=0; $h < strlen($codesFormat); $h++){
    $chrono = str_replace("{" . $codesFormat[$h] . "}" , date($codesFormat[$h]), $chrono);
  }

  if ($bold == 1){
    $chrono1 = "<B>{$chrono}</B>";
  }



  return array($chrono,$chrono1);


}

/**********************************************
 *
 **********************************************/
function format_chrono($eleArray){
global $xoopsDB;
    $ele_id      = (int)$eleArray['ele_id'];
 //echo "eleArray<pre>" . print_r($eleArray, true) . "</pre>";
    //-----------------------------------------------
    $sql = "SELECT * FROM " . $xoopsDB->prefix("xforms_element")
          . " WHERE ele_id = {$ele_id}";
    $rst = $xoopsDB->query($sql);
    $tEle = $xoopsDB->Fetcharray($rst);

    $data = unserialize($tEle['ele_value']);
    $keys = array_keys($data);

    $chrono = format_chrono_temp(array_values($data));
    //------------------------------------------------------------------
    //mise à jour du nouveau chrono
    $data[$keys[0]] += $data[$keys[2]];
    $serialData = serialize($data);

    $sql = "UPDATE " . $xoopsDB->prefix("xforms_element")
          . " SET ele_value = '{$serialData}'"
          . " WHERE ele_id = {$ele_id}";
    $xoopsDB->query($sql);



// echo "avant : " . $tEle['ele_value'] . "<br>";
// echo "apres : " . $serialData . "<br>";
//
//  echo "{$sql}<br>";
//  echo "<pre>" . print_r($rst, true) . "</pre>";
//  echo "<pre>" . print_r($DataValue, true) . "</pre>";
//  exit;

//   $v = $value + $step;
//   $chrono = $prefix . str_pad($v , $nbDigits, "0", STR_PAD_LEFT) . $suffix;
  return $chrono;


}
/**********************************************
 *
 **********************************************/
function format_timestamp($options){
//$value    = intval(mktime()));
//     $ele_id      = (int)$eleArray['ele_id'];
//     $values = $options['ele_value'];
 //echo "eleArray<pre>" . print_r($eleArray, true) . "</pre>";
    //-----------------------------------------------
    //echo (strftime("%A %d %B")); 
    
$tsFormat = $options[0];
$bold   = intval($options[1]);

//echo "<pre>" . print_r($options, true) . "</pre>";

  //$timestamp = date($tsFormat);
  //setlocale (LC_TIME, 'fr_FR.utf8','fra'); 
  $timestamp = utf8_encode  (strftime(utf8_decode($tsFormat)));
  //$timestamp = str_replace();

  if ($bold == 1){
    $timestamp = "<B>{$timestamp}</B>";
  }
//  echo "<hr>===>format_timestamp :  = {$tsFormat} ==> {$timestamp}<hr>";
  return $timestamp;
}

/**********************************************
 *
 **********************************************/
function get_color_set($color_set=''){
global $xoopsModuleCongig, $helper;
  if ($color_set == '' || $color_set == 'defaut' )
      $color_set = XFORMS_DEFAULT;


  return (($color_set == '') ? XFORMS_DEFAULT : $color_set);
}
/**********************************************
 *
 **********************************************/
function get_css_path(){
global $helper, $xoopsModuleCongig;
$helper = xHelper::getHelper("xforms");

    $cssFld = $helper->getConfig('css_folder');
    //$cssFld = $xoopsModuleCongig['css_folder'];

    if ($cssFld == "" ){
      $dir = "modules/" . _XFORMS_DIRNAME . "/assets/css";
    }else{

      if ($cssFld[0] == '/') $cssFld = substr($cssFld, 1);
      if ($cssFld[strlen($cssFld)-1] == '/') $cssFld = substr($cssFld, -1);
      $dir = $cssFld;
    }
//echo "<hr>{$dir}<hr>";
    return $dir;
}
/**********************************************
 *
 **********************************************/
function get_css_color(){
global $helper;

    $filename = XOOPS_ROOT_PATH . "/" . get_css_path() . "/style-item-color.css";
    $content = file_get_contents ($filename);

//echo "<br>{$filename}<br>{$content}<br>";
    $tLines = explode("\n" , $content);
//echo "nbLines = " . count($tLines) . "<pre>" . print_r($tLines, true) . "</pre>";
//echo "nbLines = " . count($tLines) ;
//  echo "<pre>" . print_r($tLines, true) . "</pre>";

    $tColors = array(XFORMS_DEFAULT => XFORMS_DEFAULT);
    foreach($tLines as $line){
      if(strlen($line)>0 && $line[0] == "."){
        $t = explode("-", $line);
        $color = substr($t[0],1);
        if (!array_key_exists($color, $tColors)){
            $tColors[$color] = $color;
        }
      }
    }

    return $tColors;
}

/**********************************************
 *
 **********************************************/
function load_css($color="*"){
global $helper;


    if ($helper->getConfig('css_folder') =="" ){
      $dir = "browse.php?" . get_css_path();
    }else{
      $dir = get_css_path();
    }
    //$dir = "" . $fld;

    $GLOBALS['xoTheme']->addStylesheet($GLOBALS['xoops']->url($dir . "/style-item-design.css"));
    $GLOBALS['xoTheme']->addStylesheet($GLOBALS['xoops']->url($dir . "/style-item-color.css"));

// echo "<hr>===> CSS folder : " . $helper->getConfig('css_folder',"s")  . "<br>";
// echo "<hr>===> CSS folder : " . $dir  . "<hr>";

}
/**********************************************
 *
 **********************************************/
function get_class_tr(&$row){
  $row = ($row + 1) % 2;
  $ligne = ($row == 0) ? 'odd' : 'even';
  return $ligne;
}

/**********************************************
 *
 **********************************************/
function load_jquery(){
global $helper;
}

/**********************************************
 *
 **********************************************/
function verifiy_banish($eleObjArray, $ele){
global $helper;

    //echo "elements : <pre>" . print_r($eleObjArray, true) . "</pre><hr>";
    $tUserMailText = array();
//echo "eleArray (contient les donnees saisies): <pre>" . print_r($ele , true) . "</pre><hr>";    
    
    foreach ($eleObjArray as $eleObj) {
//        echo "elements : <pre>" . print_r($eleObj, true) . "</pre><hr>";
        $eleArray   = $eleObj->getValues(array('ele_id', 'form_id', 'ele_type', 'ele_value', 'ele_req', 'ele_caption'));
        $eleId      = (int)$eleArray['ele_id'];
        $eleType    = FilterInput::clean($eleArray['ele_type'], 'ALPHANUM');
        $eleValue   = $eleArray['ele_value'];
        $eleReq     = (int)$eleArray['ele_req'];
        $eleCaption = getHtml($eleArray['ele_caption']);
        $ele[$eleId] = is_scalar($ele[$eleId]) ? trim($ele[$eleId]): $ele[$eleId];
        if (!empty($ele[$eleId])) {
            if ('' !== $eleCaption) {
                $tplTitle = "- <b>%s</b> : "; //JJDai - gras a ajouter en paramettre des formulaires peut être
                $msg[$eleId] = sprintf($tplTitle, getHtml($eleCaption) );
            }
            switch ($eleType) {    
                //----------------------------------------------------------------        
                case 'textarea':
//                     $msg[$eleId]  .= FilterInput::clean($ele[$eleId], 'STRING'); // @test this value filter
//                     $uDataValue[0] = FilterInput::clean($ele[$eleId], 'STRING');
//                     echo "<pre>" . print_r($eleValue, true) . "</pre>";

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
                //----------------------------------------------------------------        
                case 'email':
                    $email = FilterInput::clean($ele[$eleId], 'EMAIL'); // @test this value filter
                    //$msg[$eleId]  .= $email;
                    $uDataValue[0] = $email;
                    $tUserMailText[] = $uDataValue[0];

                    //if (is_null($uform->getVar('uform_email'))) $uform->setVar('uform_email', $email);
                    //if ($uform->getVar('uform_email') == '') $uform->setVar('uform_email', $email);

                    //echo "email===>{$uDataValue[0]}<br>";
                    //exit;
                    break;
                //----------------------------------------------------------------        
                case 'text':
                    if (preg_match('/\{EMAIL\}/', $eleValue[2])) {
                        if (!checkEmail($ele[$eleId])) {
                            //$err[] = _MD_XFORMS_ERR_INVALIDMAIL;
                        } else {
                            $reply_mail = $ele[$eleId];
                        }
                    }
//                     if (preg_match('/\{UNAME\}/', $eleValue[2])) {
//                         $reply_name = $ele[$eleId];  // @FIXME: this $ele[] needs to be filtered
//                     }
                    //$msg[$eleId]  .= $ele[$eleId]; // @FIXME: this $ele[] needs to be filtered
                    //$uDataValue[0] = $ele[$eleId];

                    /* Obtain the user email from the form */
                  // JJDai - Ajout d'un test  $eleValue[3]==1 -
                  // si $eleValue[3]=)2 le champ contient le nom pour la réponse, donc pas de controle sur email
                    $userMailText = checkEmail(trim($ele[$eleId]));
                    if ((!empty($eleValue[3])) && ($eleValue[3]==1) && !empty($userMailText)) {   
                            $tUserMailText[] = $userMailText;
                    }
                    //echo "===>{$userMailText}<br>";
                    //exit;
                    break;
            } // du switch
         }
    } // fin de la boucle for

/*            verif si un email trouvé  été banni     */
/* JJDai verifie si l'expediteur est banni */

//echo "<pre>" . print_r($tUserMailText, true) . "</pre><br>";
//exit;
    $banishHandler = $helper::getInstance()->getHandler('banish');
    foreach($tUserMailText AS $email){
      if ($banishHandler->is_banish($email)){
      //echo $helper->getConfig('caution_for_banish') . "<br>";
          //redirect_header($_SERVER['SCRIPT_NAME'], (int)Constants::REDIRECT_DELAY_LONG, $helper->getConfig('caution_for_banish'));
          redirect_header(XOOPS_URL, (int)Constants::REDIRECT_DELAY_LONG, $helper->getConfig('caution_for_banish'));
          exit;
      }
}


}