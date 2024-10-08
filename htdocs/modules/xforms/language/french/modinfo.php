<?php
/*
 * Name: modinfo.php
 * Description:
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license http://www.fsf.org/copyleft/gpl.html GNU public license
 * @package : XOOPS
 * @Module : Xoops FAQ
 * @subpackage : Menu Language
 * @since 2.5.7
 * @author John Neill - JJDai
 * @version $Id: modinfo.php 0000 10/04/2009 09:08:46 John Neill $
 * Traduction: LionHell 
 * upgrade to xoops 2.5.7 by Jean-Jacques DELALANDRE
 */
 
defined( 'XOOPS_ROOT_PATH' ) or die( 'Accès restreint' );

define('_MI_XFORMS_INST_TABLE_EXISTS', "la table %s existe déjà");
define('_MI_XFORMS_INST_NO_TABLE', "la table %s n'existe pas");
define('_MI_XFORMS_GLOBAL_DEFAULT', "<b><span style=\"color:red\">*</span> Requis </b>');  //'[b] * Requis [/b]");
define('_MI_XFORMS_BLK_FORM_DESC', "Un bloc pour afficher un seul formulaire disponible (avec autorisation)");
define('_MI_XFORMS_BLK_LIST_DESC', "Un bloc pour lister les formulaires disponibles (conscients des permissions)");
define('_MI_XFORMS_ADMENU5', "A propos");
define('_MI_XFORMS_ADMENU5_DESC', "A propos de ce module");
define('_MI_XFORMS_ADMENU0_DESC', "Page d'accueil Admin");
define('_MI_XFORMS_UPLOADDIR_DESC', "Tous les fichiers de téléchargement seront stockés ici lorsqu'un formulaire est envoyé via un message privé");
define('_MI_XFORMS_BLOCKS', "Blocks");
define('_MI_XFORMS_CAPTCHA_EVERYONE', "Captcha pour tous les utilisateurs");
define('_MI_XFORMS_CAPTCHA_ANON_ONLY', "Captcha pour les utilisateurs anonymes");
define('_MI_XFORMS_INST_NO_DEL_DIRS', "Impossible de supprimer les anciens répertoires");
define('_MI_XFORMS_INST_NO_DEL_UPLOAD', "Impossible de supprimer le répertoire de téléchargement (%s)");
define('_MI_XFORMS_INST_DIR_NOT_FOUND', "Impossible de trouver le répertoire %s");
define('_MI_XFORMS_ADMENU2', "Créer / Modifier un formulaire");
define('_MI_XFORMS_ADMENU3_DESC', "Créer / Modifier un élément de formulaire");
define('_MI_XFORMS_ADMENU2_DESC', "Créer / Modifier un formulaire spécifique");
define('_MI_XFORMS_ADMENU3', "Create / Edit form element");
define('_MI_XFORMS_ADMENU4_DESC', "Créer / Voir un rapport de formulaire");
define('_MI_XFORMS_TEXTAREA_COLS', "Colonnes par défaut des zones de texte");
define('_MI_XFORMS_DEFAULT_TITLE', "Titre de la page principale par défaut");
define('_MI_XFORMS_TEXT_MAX', "Longueur maximale par défaut des zones de texte");
define('_MI_XFORMS_TEXTAREA_ROWS', "Lignes par défaut des zones de texte");
define('_MI_XFORMS_TEXT_WIDTH', "Largeur par défaut des zones de texte");
define('_MI_XFORMS_CAPTCHA_NONE', "Ne pas utiliser captcha");
define('_MI_XFORMS_INTRO_DEFAULT', "N'hésitez pas à nous contacter via les moyens suivants:");
define('_MI_XFORMS_BLK_FORM', "Bloc de formulaire");
define('_MI_XFORMS_HELP_ELEMENTS', "Éléments de formulaire");
define('_MI_XFORMS_BLK_LIST', "Form list block");
define('_MI_XFORMS_ADMENU4', "Rapport de formulaire");
define('_MI_XFORMS_DEFAULT_TITLE_DESC', "Page Forms");
define('_MI_XFORMS_ADMENU0', "Home");
define('_MI_XFORMS_ADMENU6', "Import");
define('_MI_XFORMS_IMPORT', "Import");
define('_MI_XFORMS_ADMENU6_DESC', "Importer des données à partir de modules similaires");
define('_MI_XFORMS_CAPTCHA_INHERIT', "Hériter des paramètres de XOOPS");
define('_MI_XFORMS_INTRO', "Texte d'introduction dans la page principale");
define('_MI_XFORMS_HELP_ISSUES', "Issues");
define('_MI_XFORMS_MAIL_CHARSET_DESC', "Laisser vide pour " .  _CHARSET  . "");
define('_MI_XFORMS_TMPL_MAIN_DESC', "Page principale de \"xForms\"");
define('_MI_XFORMS_ADMENU1_DESC', "Gérer les formulaires définis");
define('_MI_XFORMS_ADMENU1', "Gérer les formulaires");
define('_MI_XFORMS_UPGRADE', "Mise à jour");
define('_MI_XFORMS_PERPAGE', "Nombre de formulaires à afficher par page (dans Admin)");
define('_MI_XFORMS_SHOW_TPL_NAME_DESC', "Option à utiliser pour le développement, la désactiver en production");
define('_MI_XFORMS_HELP_OVERVIEW', "Aperçu");
define('_MI_XFORMS_TMPL_ERROR_DESC', "Page pour montrer quand une erreur se produit");
define('_MI_XFORMS_UPLOADDIR', "Chemin physique pour stocker les fichiers téléchargés SANS barre oblique");
define('_MI_XFORMS_PREFERENCE', "Préférence");
define('_MI_XFORMS_ELE_SELECT_CTRY_DEFAULT', "Selectionner le pays par defaut");
define('_MI_XFORMS_CAPTCHA_DESC', "Sélectionnez les utilisateurs qui utiliseront captcha lors de la soumission des formulaires. <br> Valeur par défaut: <em> ' " .  _MI_XFORMS_CAPTCHA_INHERIT . " '</em>");
define('_MI_XFORMS_MOREINFO', "Envoyer des informations supplémentaires avec les données soumises");
define('_MI_XFORMS_SHOWFORMS', "Afficher \"xForms\" sur la page d'index?");
define('_MI_XFORMS_SHOW_TPL_NAME', "Afficher le nom des templates");
define('_MI_XFORMS_NOFORM_DEFAULT', "Désolé, il n'y a actuellement aucun formulaire (visible pour vous).");
define('_MI_XFORMS_MOREINFO_IP', "Adresse IP du soumissionnaire");
define('_MI_XFORMS_MOREINFO_AGENT', "Agent utilisateur du soumissionnaire (info navigateur)");
define('_MI_XFORMS_TMPL_FORM_DESC', "Template for forms");
define('_MI_XFORMS_TMPL_POLL_DESC', "Template for polls");
define('_MI_XFORMS_MAIL_CHARSET', "Encodage de texte pour envoyer des emails");
define('_MI_XFORMS_PREFIX', "Préfixe les champs obligatoires");
define('_MI_XFORMS_NOFORM', "Texte affiché quand aucun formulaire n'est visible pour l'utilisateur actuel");
define('_MI_XFORMS_SUFFIX', "Suffixe pour les champs obligatoires");
define('_MI_XFORMS_GLOBAL', "Texte à afficher dans chaque bas page de formulaire");
define('_MI_XFORMS_DESC', "Ce module est utilisé pour créer des formulaires pour collecter les entrées utilisateur.");
define('_MI_XFORMS_MOREINFO_FORM', "URL du formulaire soumis");
define('_MI_XFORMS_CAPTCHA', "Utiliser captcha lors de la soumission des formulaires?");
define('_MI_XFORMS_MOREINFO_USER', "Nom d'utilisateur et URL vers la page d'informations utilisateur");
define('_MI_XFORMS_NAME', "xForms");
define('_MI_XFORMS_SHOWFORMS_DESC', "Oui - les formulaires disponibles pour l'utilisateur seront affichés sur la page d'index. Non - l'utilisateur sera envoyé à la page d'accueil du site si aucun formulaire spécifique n'est sélectionné.");
define('_MI_XFORMS_PERPAGE_DESC', "Par page");
define('_MI_XFORMS_EDITOR_ADMIN', "Editeur à utiliser (admin):");
define('_MI_XFORMS_EDITOR_ADMIN_DESC', "Selectionner l'éditeur de texte utiliser dans le Back office. Si vous avez une installation standard vous pouvez juste sélectionner DHTML, Compact et tinyMCE");
define('_MI_XFORMS_EDITOR_USER', "Editeur à utiliser (utilisateur):");
define('_MI_XFORMS_EDITOR_USER_DESC', "Selectionner l'éditeur de texte utiliser dans le Front office. Si vous avez une installation standard vous pouvez juste sélectionner DHTML, Compact et tinyMCE");
define('_MI_XFORMS_BLOCKS_ADMIN', "Blocks Admin");
define('_MI_XFORMS_CAPTCHA_MODE', "Mode de retour sur erreur de captcha");
define('_MI_XFORMS_CAPTCHA_MODE0', "Retour à un formulaire vierge");
define('_MI_XFORMS_CAPTCHA_MODE1', "Retour à un formulaire prérempli");
define('_MI_XFORMS_CSS_FOLDER', "Emplacement des feuiles de style");
define('_MI_XFORMS_CSS_FOLDER_DESC', "Les feuilles de styles peuvent être placées dans un dossier commun pour être utilisées par d'autres modules.<br>Laisser vide utilise des feuille CSS du module par défaut.<br>Le chemin doit être indiqué par rapport à la racine du site.");
define('_MI_XFORMS_ADMENU7', "Contact");
define('_MI_XFORMS_ADMENU7_DESC', "Formulaires de contact, permet de répondre soumissions");
define('_MI_XFORMS_COLOR_SET', "Jeu de couleurs");
define('_MI_XFORMS_COLOR_SET_DESC', "Défini le jeu de couleur par défaut des articles. Les jeux de couleurs sont définis dans le CSS \"style-item-color.css\" du module ou du theme ou du framework janus (voir les options du module)");

define('_MI_XFORMS_BANISH', "Avertissement pour les banissements");
define('_MI_XFORMS_BANISH_DESC', "Ce texte sera affiché aux utilisateurs bannis");
define('_MI_XFORMS_BANISH_DEFAULT', "Votre courriel a été bannis, probablement pour cause de spam.");

define('_MI_XFORMS_ADMENU8', "Bannis");
define('_MI_XFORMS_ADMENU8_DESC', "Email bannis pour cause de spam");
                       

?>
