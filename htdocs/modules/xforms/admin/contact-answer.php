<?php

use XoopsModules\Xforms;
//include_once XOOPS_ROOT_PATH . '/modules/xforms/class/helper.php';
//include_once XOOPS_ROOT_PATH . '/modules/xforms/class/UserDataHandler.php';
use XoopsModules\Xforms\Helper as xHelper;
require dirname(__DIR__) . '/preloads/autoloader.php';
//$helper = xHelper::getInstance();


        xoops_cp_header();
        /* @var \Xmf\Module\Admin $adminObject */
        $adminObject->displayNavigation(basename(__FILE__));
        //$adminObject->addItemButton(_AM_XFORMS_NEW, basename(__FILE__) . '?op=edit', 'add');
        $adminObject->displayButton('left');
        //-------------------------------------------------------------------
//       $criteria = new \CriteriaCompo();
//       $criteria->add(new \Criteria('form_answer', 1, '='));
        $form = $formsHandler->get($formId);

        //-------------------------------------------------------------------
        //$uDataHandler = $helper::getInstance()->getHandler('UserData');
        $criteria = new \CriteriaCompo();
        $criteria->add(new \Criteria('uform_id', $uformId , '='));
        $criteria->setOrder('udata_id');
        $uData  = $uDataHandler->getAll($criteria,null,false,true);
        //-------------------------------------------------------------------
        //$xformsEleHandler = $helper->getHandler('Element');
        $criteria = new \CriteriaCompo();
        $criteria->add(new \Criteria('form_id', $formId , '='));
        $elements = $xformsEleHandler->getAll($criteria,"ele_id,ele_caption,ele_type",false,true);
        //$els = $xformsEleHandler->getObjects($criteria,null);
        //$elements = $xoopsDB->fetchArray($els);
        //exit;
        //-------------------------------------------------------------------
        echo '<form action="contact.php?op=sendmail" method="post">';
        echo '<table class="outer width100 bspacing1">'
           . '  <thead>'
           . '  <tr><th colspan="3">(#' . $form->getVar('form_id') . ') ' . $form->getVar('form_title') . '</th></tr>'
           . '  <tr>'
           . '    <td class="head center bottom width5">' . _AM_XFORMS_ID . '</td>'
           . '    <td class="head center bottom width25">' . _AM_XFORMS_ELE_CAPTION . '</td>'
           . '    <td class="head center bottom">' . _AM_XFORMS_ELE_VALUE . '</td>'
           . '  </tr>'
           . '  </thead>'
           . '  <tbody>';
      //------------------------------------------------------------------------------
        $row=0;
//echo "===>item<pre>" . print_r($uData, true) . "</pre>";
        foreach ($uData as $id=>$item){
          $ele = $elements[$item['ele_id']];
          $data = $item['udata_value'];
          $ligne = Xforms\get_class_tr($row);
          $exp="";
          //---------------------------------------------
          echo "    <tr class='{$ligne}'>";

          echo "    <td class='center'>{$item['ele_id']}</td>";
          echo "    <td class='left'>{$elements[$item['ele_id']]['ele_caption']}</td>";

          //echo "===>" . $elements[$item['ele_id']]['ele_type']."<br>";
          switch ($elements[$item['ele_id']]['ele_type']){
          case 'email':
            //echo "===>elements<pre>" . print_r($elements[$item['ele_id']], true) . "</pre>";
            //echo "===>elements<pre>" . print_r($item, true) . "</pre>";
              //$userEmail = $data[0];
              if (!$userEmail) $userEmail = $data[0];
              $exp = $data[0];
              //$userEmail = $item['udata_value'][0];
              //echo "userEmail = {$userEmail} - {$data[2]}<br>";
              break;
          case 'text':
            //echo "===>elements<pre>" . print_r($elements[$item['ele_id']], true) . "</pre>";
           // echo "===>ele<pre>" . print_r($ele, true) . "</pre>";
            switch($ele['ele_value'][3]){
              case 1: if (!$userEmail) $userEmail = $data[0]; break;
              case 2: $userName = $data[0]; break;
              case 3: $objet = $data[0]; break;
            }
            $exp = $data[0];
            // if ($ele['ele_value'][3] == 1){
            //             echo "===>item<pre>" . print_r($item, true) . "</pre>";
            // $userEmail = $data[0];
            // echo "===> email = {$userEmail}<br>";
            // }
            break;
          case 'textarea':
            //$exp = $myts->htmlSpecialChars($data[0]);
            $exp = (isset($data[0]) ? $myts->displayTarea($data[0]) : '' );
            break;

          default:
            if ($data) $exp = $data[0];
            break;
          }
          echo "    <td class='left'>" . $exp ."</td>";

          echo "    </tr>";

        }

//----------------------------------------------------
//historique des message envoyé
      //$uFormHandler = $helper->getHandler('UserForm');
      $uForm = $uFormHandler->get($uformId);
     //$criteria->setGroupBy('uform_id');


//$historic = $myts->htmlSpecialChars($uForm->getVar('uform_answer'));
//$historic = $myts->displayTarea($uForm->getVar('uform_answer'));
$historic = Xforms\getHtml($uForm->getVar('uform_answer'));
          $ligne = Xforms\get_class_tr($row);
          echo "    <tr class='{$ligne}'>";
          echo "    <td class='center'></td>";
          echo "    <td class='right'>" . _AM_XFORMS_ANSWER_HISTORIC . "</td>";
          echo "    <td class='left'>{$historic}</td>";
          echo "    </tr>";

//----------------------------------------------------
// $idReponse = "reponse[%s]";
// $r = 0; //sprintf($idReponse, $r++)
if ($op == 'answer'){
  $formIdHidden = new \XoopsFormHidden('reponse[form_id]', $formId);
  echo $formIdHidden->render();
  $uformIdHidden = new \XoopsFormHidden('reponse[uform_id]', $uformId);
  echo $uformIdHidden->render();

            $ligne = Xforms\get_class_tr($row);
            echo "    <tr class='{$ligne}'>";
            echo "    <td class='center'></td>";
            echo "    <td class='right'>" . _AM_XFORMS_IDS_UFORM . "</td>";
            echo "    <td class='left'>{$formId} / {$uformId}</td>";
            echo "    </tr>";
  //----------------------------------------------------
  $userNameHidden = new \XoopsFormHidden('reponse[username]', $userName);
            $ligne = Xforms\get_class_tr($row);
            echo "    <tr class='{$ligne}'>";
            echo "    <td class='center'></td>";
            echo "    <td class='right'>" . _AM_XFORMS_GUEST . "</td>";
            echo "    <td class='left'>{$userName}{$userNameHidden->render()}</td>";
            echo "    </tr>";
  //----------------------------------------------------
  //$userEmailHidden = new \XoopsFormHidden('reponse[email]', $userEmail);
  $inputEmail = new \XoopsFormText('', 'reponse[email]', 60, 255, $userEmail);
            $ligne = Xforms\get_class_tr($row);
            echo "    <tr class='{$ligne}'>";
            echo "    <td class='center'></td>";
            echo "    <td class='right'>" . _AM_XFORMS_ELE_EMAIL . "</td>";
            echo "    <td class='left'>{$inputEmail->render()}</td>";
            //echo "    <td class='left'>{$userEmail}{$userEmailHidden->render()}</td>";
            echo "    </tr>";
  //----------------------------------------------------
  $inputObjet = new \XoopsFormText('', 'reponse[objet]', 60, 255, $objet);
            $ligne = Xforms\get_class_tr($row);
            echo "    <tr class='{$ligne}'>";
            echo "    <td class='center'></td>";
            echo "    <td class='right'>" . _AM_XFORMS_OBJET . "</td>";
            echo "    <td class='left'>{$inputObjet->render()}</td>";
            echo "    </tr>";
  //----------------------------------------------------
  //    $inputReponse = new \XoopsFormText('', 'reponse', 40, 255, $optVal);
  //$inputReponse = new \XoopsFormTextArea('', 'repponse[1]', 'rrrrrrrrrrr', 5, 25);

  // $defaultEditorConfigs = array('editor' => Xforms\get_editor_name(), //
  //                                 'rows' => 8,
  //                                 'cols' => 90,
  //                                'width' => '100%',
  //                               'height' => '260px',
  //                                 'name' => 'ele_value[0]',
  //                                'value' => isset($value[0]) ? $myts->htmlSpecialChars($value[0]) : ''
  // );
  // $inputReponse = new \XoopsFormEditor('', 'reponse[message]', $defaultEditorConfigs);
  $value = isset($value[0]) ? $value[0] : '';
  $inputReponse = Xforms\get_editor('', 'reponse[message]', $value, $width='100%', $height = '260px');

            $ligne = Xforms\get_class_tr($row);
            echo "    <tr class='{$ligne}'>";
            echo "    <td class='center'></td>";
            echo "    <td class='right'>" . _AM_XFORMS_ANSWER . "</td>";
            echo "    <td class='left'>{$inputReponse->render()}</td>";
            echo "    </tr>";
  //----------------------------------------------------
  $submitBtn = new \XoopsFormButton('', 'submit', _AM_XFORMS_SEND_MAIL , 'submit');
  $cancelBtn = new \XoopsFormButton('', 'button', _CANCEL , 'submit');
  $cancelBtn->setExtra("onClick='history.go(-1);return true;'");

            $ligne = Xforms\get_class_tr($row);
            echo "    <tr class='{$ligne}'>";
            echo "    <td class='center'></td>";
            echo "    <td class='right'></td>";
            echo "    <td class='left'>{$cancelBtn->render()} {$submitBtn->render()}</td>";
            echo "    </tr>";
  //----------------------------------------------------




          echo "    </table>";
          echo "    </form>";
}else{
  $cancelBtn = new \XoopsFormButton('', 'button', _CANCEL , 'submit');
            $ligne = Xforms\get_class_tr($row);
            echo "    <tr class='{$ligne}'>";
            echo "    <td class='center'></td>";
            echo "    <td class='right'></td>";
            echo "    <td class='left'>{$cancelBtn->render()}</td>";
            echo "    </tr>";
}

      //------------------------------------------------------------------------------
/*
         // echo "formId / name = {$form['form_id']} | {$form['form_title']}<br>";
          echo "formId / name = {$form->getVar('form_id')} | {$form->getVar('form_title')}<br>";



        foreach ($uData as $id=>$item){
          echo "udata_id = {$item['udata_id']}<br>";
          echo "caption = {$elements[$item['ele_id']]['ele_caption']}<br>";


echo "===>item<pre>" . print_r($item, true) . "</pre>";
//           $data = unserialize($item['udata_value']);
// echo "===>value<pre>" . print_r($item['udata_value'], true) . "</pre>";
// echo "===>data<pre>" . print_r($data, true) . "</pre><hr>";
          $data = $item['udata_value'];
echo "===>data<pre>" . print_r($data, true) . "</pre><hr>";
        }
*/
