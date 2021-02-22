<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * wgGallery module for xoops
 *
 * @copyright      module for xoops
 * @license        GPL 2.0 or later
 * @package        wggallery
 * @since          1.0
 * @min_xoops      2.5.9
 * @author         Wedega - Email:<webmaster@wedega.com> - Website:<https://wedega.com>
 * @version        $Id: 1.0 admin.php 1 Mon 2018-03-19 10:04:52Z XOOPS Project (www.xoops.org) $
 */
require_once __DIR__ . '/common.php';

// ---------------- Index Admin ----------------
define ('_AM_WGGALLERY_OPTION_GT_SHOW_1', 'Afficher toujours');
define ('_AM_WGGALLERY_OPTION_GT_SHOW_2', 'Afficher la barre de navigation uniquement lorsque la largeur de l\'�cran est sup�rieure � 768 pixels');
define ('_AM_WGGALLERY_OPTION_GT_SHOW_3', 'Afficher la barre de navigation uniquement lorsque la largeur de l\'�cran est sup�rieure � 992 pixels');
define ('_AM_WGGALLERY_OPTION_GT_SHOW_4', 'Afficher la barre de navigation uniquement lorsque la largeur de l\'�cran est sup�rieure � 1200 pixels');
define ('_AM_WGGALLERY_OPTION_GT_TOOLBAR', 'Afficher la barre d\'outils');
define ('_AM_WGGALLERY_OPTION_GT_TOOLBARZOOM', 'Afficher les boutons de zoom dans la barre d\'outils');
define ('_AM_WGGALLERY_OPTION_GT_TOOLBARDOWNLOAD', 'Afficher les boutons de t�l�chargement dans la barre d\'outils');
define ('_AM_WGGALLERY_OPTION_GT_TOOLBARDOWNLOAD_DESC', 'Si vous activez cette option, le fichier source sera toujours t�l�charg�. Faites attention: ceci dans les permissions d�finies dans les param�tres de l\'album.');
define ('_AM_WGGALLERY_OPTION_GT_FULLSCREEN', 'Passer en plein �cran au d�marrage du diaporama');
define ('_AM_WGGALLERY_OPTION_GT_TRANSDURATION', 'Vitesse de transition');
define ('_AM_WGGALLERY_OPTION_GT_TRANSDURATION_DESC', 'P�riode d\'animation en millisecondes entre 2 images');
define ('_AM_WGGALLERY_OPTION_GT_INDEXIMG', 'Type d\'image sur la page d\'index');
define ('_AM_WGGALLERY_OPTION_GT_INDEXIMGHEIGHT', 'Hauteur de l\'image');
define ('_AM_WGGALLERY_OPTION_GT_SHOWLABEL', 'Afficher l\'index de l\'image (Image {actuelle} de {total}%)');
define ('_AM_WGGALLERY_OPTION_GT_LCLSKIN', 'Commandes de style');
define ('_AM_WGGALLERY_OPTION_GT_ANIMTIME', 'Vitesse d\'animation');
define ('_AM_WGGALLERY_OPTION_GT_ANIMTIME_DESC', 'Temps pour l\'animation (par exemple redimensionner l\'image) entre deux images en millisecondes');
define ('_AM_WGGALLERY_OPTION_GT_LCLCOUNTER', 'Afficher le compteur');
define ('_AM_WGGALLERY_OPTION_GT_LCLPROGRESSBAR', 'Afficher la barre de progression');
define ('_AM_WGGALLERY_OPTION_GT_LCLMAXWIDTH', 'Largeur maximale de la galerie (en % de la fen�tre)');
define ('_AM_WGGALLERY_OPTION_GT_LCLMAXHEIGTH', 'Hauteur maximale de la galerie (en % de la fen�tre)');
define ('_AM_WGGALLERY_OPTION_GT_BACKGROUND', 'Arri�re-plan');
define ('_AM_WGGALLERY_OPTION_GT_BACKHEIGHT', 'Hauteur du fond');
define ('_AM_WGGALLERY_OPTION_GT_BORDER', 'Border');
define ('_AM_WGGALLERY_OPTION_GT_BORDERWIDTH', 'Largeur');
define ('_AM_WGGALLERY_OPTION_GT_BORDERCOLOR', 'Couleur');
define ('_AM_WGGALLERY_OPTION_GT_BORDERPADDING', 'Padding');
define ('_AM_WGGALLERY_OPTION_GT_BORDERRADIUS', 'Radius');
define ('_AM_WGGALLERY_OPTION_GT_SHADOW', 'Afficher l\'ombre');
define ('_AM_WGGALLERY_OPTION_GT_LCLDATAPOSITION', 'Position des donn�es');
define ('_AM_WGGALLERY_OPTION_GT_LCLDATAPOSITION_UNDER', 'Sous');
define ('_AM_WGGALLERY_OPTION_GT_LCLDATAPOSITION_OVER', 'Dessus');
define ('_AM_WGGALLERY_OPTION_GT_LCLDATAPOSITION_RSIDE', 'C�t� droit');
define ('_AM_WGGALLERY_OPTION_GT_LCLDATAPOSITION_LSIDE', 'C�t� gauche');
define ('_AM_WGGALLERY_OPTION_GT_LCLDATAPOSITION_DESC', "Veuillez noter que lightbox utilise un syst�me intelligent qui passe automatiquement � '". _AM_WGGALLERY_OPTION_GT_LCLDATAPOSITION_OVER. "' d�s que l\'�l�ment devient trop petit � cause de longs textes ou d\'une petite fen�tre.");
define ('_AM_WGGALLERY_OPTION_GT_LCLCMDPOSITION', 'Position de la commande');
define ('_AM_WGGALLERY_OPTION_GT_LCLCMDPOSITION_INNER', 'Inner');
define ('_AM_WGGALLERY_OPTION_GT_LCLCMDPOSITION_OUTER', 'Externe');
define ('_AM_WGGALLERY_OPTION_GT_LCLCMDPOSITION_DESC', "Veuillez noter que lightbox passera automatiquement � '". _AM_WGGALLERY_OPTION_GT_LCLCMDPOSITION_OUTER. "' si les commandes internes sont trop larges pour l\'�l�ment repr�sent�");
define ('_AM_WGGALLERY_OPTION_GT_LCLTHUMBSWIDTH', 'Largeur des vignettes (en pixel)');
define ('_AM_WGGALLERY_OPTION_GT_LCLTHUMBSHEIGTH', 'Hauteur des vignettes (en pixel)');
define ('_AM_WGGALLERY_OPTION_GT_LCLFULLSCREEN', "Afficher la commande 'Plein �cran'");
define ('_AM_WGGALLERY_OPTION_GT_LCLFSIMGBEHAVIOUR', 'Comportement de l\'image plein �cran');
define ('_AM_WGGALLERY_OPTION_GT_LCLFSIMGBEHAVIOUR_FIT', 'fit - l\'image sera compl�tement visible (laissant �ventuellement des espaces sur les bords)');
define ('_AM_WGGALLERY_OPTION_GT_LCLFSIMGBEHAVIOUR_FILL', 'fill - image remplira toujours l\' �cran (une partie pourrait �tre �ventuellement masqu�e) ');
define ('_AM_WGGALLERY_OPTION_GT_LCLFSIMGBEHAVIOUR_SMART', "smart - LC Lightbox utilise le mode 'fit' et passe � 'fill' uniquement si le rapport hauteur / largeur des images est similaire � l\'espace disponible");
define ('_AM_WGGALLERY_OPTION_GT_LCLSOCIALS', "Show command 'Socials'");
define ('_AM_WGGALLERY_OPTION_GT_LCLSOCIALS_FB', 'Facebook App ID');
define ('_AM_WGGALLERY_OPTION_GT_LCLSOCIALS_FB_DESC', 'N\'oubliez pas d\'ajouter le SDK Facebook dans votre site Web');
define ('_AM_WGGALLERY_OPTION_GT_LCLDOWNLOAD', "Afficher la commande 'T�l�charger'");
define ('_AM_WGGALLERY_OPTION_GT_LCLRCLICK', 'D�sactiver le clic droit de la souris');
define ('_AM_WGGALLERY_OPTION_GT_LCLTOGGLETXT', "Afficher la commande � bascule 'Texte'");
define ('_AM_WGGALLERY_OPTION_GT_LCLNAVBTNPOS', 'Position des boutons de navigation');
define ('_AM_WGGALLERY_OPTION_GT_LCLNAVBTNPOS_N', 'Normal');
define ('_AM_WGGALLERY_OPTION_GT_LCLNAVBTNPOS_M', 'Middle');
define ('_AM_WGGALLERY_OPTION_GT_LCLSLIDESHOW', "Afficher la commande 'Lecture'");
// Ajout / modification de type d\'album
define ('_AM_WGGALLERY_ALBUMTYPE_ADD', 'Add Albumtype');
define ('_AM_WGGALLERY_ALBUMTYPE_EDIT', 'Edit Albumtype');
// options des types d\'album
define ('_AM_WGGALLERY_OPTION_AT_SET', 'D�finir les options pour le type d\'album s�lectionn�');
define ('_AM_WGGALLERY_OPTION_AT_SETINFO', 'Les param�tres des types d\'albums seront utilis�s pour la page d\'index et les blocs d\'album');
define ('_AM_WGGALLERY_OPTION_AT_HOVER', 'Effet de survol');
define ('_AM_WGGALLERY_OPTION_AT_NB_COLS_ALB', 'Nombre de colonnes pour la liste des albums');
define ('_AM_WGGALLERY_OPTION_AT_NB_COLS_CAT', 'Nombre de colonnes pour la liste des cat�gories');
// options communes
define ('_AM_WGGALLERY_OPTION_OPACITIY', 'Opacity');
define ('_AM_WGGALLERY_OPTION_SHOWTITLE', 'Afficher le titre');
define ('_AM_WGGALLERY_OPTION_SHOWDESCR', 'Afficher la description');
define ('_AM_WGGALLERY_OPTION_CSS', 'S�lectionnez css pour le style');
define ('_AM_WGGALLERY_OPTION_SHOWSUBMITTER', 'Afficher le soumissionnaire');
// Entretien
define ('_AM_WGGALLERY_MAINTENANCE_ALBUM_SELECT', 'Choisir un album');
define ('_AM_WGGALLERY_MAINTENANCE_EXECUTE_DR', 'Supprimer et r�initialiser');
define ('_AM_WGGALLERY_MAINTENANCE_EXECUTE_R', 'D�finir les param�tres par d�faut');
define ('_AM_WGGALLERY_MAINTENANCE_EXECUTE_RIL', 'Redimensionner toutes les grandes images');
define ('_AM_WGGALLERY_MAINTENANCE_EXECUTE_RIM', 'Redimensionner toutes les images moyennes');
define ('_AM_WGGALLERY_MAINTENANCE_EXECUTE_RIT', 'Redimensionner tous les vignettes');
define ('_AM_WGGALLERY_MAINTENANCE_EXECUTE_DUI', 'Supprimer les images inutilis�es');
define ('_AM_WGGALLERY_MAINTENANCE_EXECUTE_DUI_SHOW', 'Afficher la liste des images inutilis�es');
define ('_AM_WGGALLERY_MAINTENANCE_SUCCESS_RESET', 'R�initialisation r�ussie:');
define ('_AM_WGGALLERY_MAINTENANCE_SUCCESS_CREATE', 'Cr�ation r�ussie:');
define ('_AM_WGGALLERY_MAINTENANCE_SUCCESS_RESIZE', 'Redimensionnement r�ussi: %s fois redimensionn� pour %t images');
define ('_AM_WGGALLERY_MAINTENANCE_SUCCESS_DELETE', 'Suppression r�ussie:');
define ('_AM_WGGALLERY_MAINTENANCE_ERROR_RESET', 'Erreur lors de la r�initialisation:');
define ('_AM_WGGALLERY_MAINTENANCE_ERROR_CREATE', 'Erreur lors de la cr�ation:');
define ('_AM_WGGALLERY_MAINTENANCE_ERROR_DELETE', 'Erreur lors de la suppression:');
define ('_AM_WGGALLERY_MAINTENANCE_ERROR_RESIZE', 'Erreur lors du redimensionnement:');
define ('_AM_WGGALLERY_MAINTENANCE_ERROR_READDIR', 'Erreur lors de la lecture du r�pertoire:');
define ('_AM_WGGALLERY_MAINTENANCE_TYP', 'Type de maintenance');
define ('_AM_WGGALLERY_MAINTENANCE_DESC', 'Description');
define ('_AM_WGGALLERY_MAINTENANCE_RESULTS', 'Results');
define ('_AM_WGGALLERY_MAINTENANCE_GT', 'Maintain gallerytypes');
define ('_AM_WGGALLERY_MAINTENANCE_GT_DESC', 'Supprimer les types de galerie non pris en charge et / ou r�initialiser tous les types de galerie aux valeurs par d�faut');
define ('_AM_WGGALLERY_MAINTENANCE_GT_SURERESET', 'Tous les param�tres de la galerie existants seront mis � jour avec les param�tres par d�faut. Voulez-vous continuer?');
define ('_AM_WGGALLERY_MAINTENANCE_GT_SUREDELETE', 'Tous les types de galerie existants (param�tres inclus) seront supprim�s et remplac�s par les types de galerie actuels. Voulez-vous continuer?');
define ('_AM_WGGALLERY_MAINTENANCE_AT', 'Maintain albumtypes');
define ('_AM_WGGALLERY_MAINTENANCE_AT_DESC', 'Supprimer les types d\'album n\'est plus pris en charge et / ou r�initialiser tous les types d\'album aux valeurs par d�faut');
define ('_AM_WGGALLERY_MAINTENANCE_AT_SURERESET', 'Tous les param�tres d\'album existants seront mis � jour avec les types d\'album par d�faut. Voulez-vous continuer?');
define ('_AM_WGGALLERY_MAINTENANCE_AT_SUREDELETE', 'Tous les types d\'album existants (param�tres inclus) seront supprim�s et remplac�s par les types d\'album actuels. Voulez-vous continuer?');
define ('_AM_WGGALLERY_MAINTENANCE_RESIZE', 'Redimensionner les images');
define ('_AM_WGGALLERY_MAINTENANCE_RESIZE_DESC', 'Redimensionner les images ou les vignettes � la hauteur maximale correspondant aux pr�f�rences du module. <br> Param�tres actuels: <ul>
<li> grand: largeur max %lw px / hauteur max %lh px </li>
<li> moyen: largeur max %mw px / hauteur max %mh px </li>
<li> vignette: largeur max %tw px / hauteur max %th px </li>
</ul> ');
define ('_AM_WGGALLERY_MAINTENANCE_RESIZE_INFO', 'Le redimensionnement de "grandes images" n\'est possible que si l\'image originale est disponible!');
define ('_AM_WGGALLERY_MAINTENANCE_RESIZE_SELECT', 'S�lectionnez le type d\'images � redimensionner');
define ('_AM_WGGALLERY_MAINTENANCE_DELETE_UNUSED', 'Nettoyer le r�pertoire des images');
define ('_AM_WGGALLERY_MAINTENANCE_DELETE_UNUSED_DESC', 'Toutes les images actuellement inutilis�es des r�pertoires suivants seront supprim�es: <ul>
<li>%p / albums / </li>
<li>%p / large / </li>
<li>%p / moyen / </li>
<li>%p / thumbs / </li>
<li>%p / temp / </li>
</ul> ');
define ('_AM_WGGALLERY_MAINTENANCE_DELETE_INVALID', "Supprimer les �l�ments non valides dans la table 'images'");
define ('_AM_WGGALLERY_MAINTENANCE_DELETE_INVALID_DESC', "Supprimer les �l�ments non valides dans la table 'images', par exemple l\'�l�ment a �t� cr��, mais une erreur s'est produite lors du t�l�chargement");
define ('_AM_WGGALLERY_MAINTENANCE_DELETE_INVALID_IMG', 'Article invalide: img_id');
define ('_AM_WGGALLERY_MAINTENANCE_DELETE_UNUSED_NONE', 'Aucune image inutilis�e trouv�e');
define ('_AM_WGGALLERY_MAINTENANCE_DUI_SUREDELETE', 'Toutes les images d\'album actuellement inutilis�es seront supprim�es! Voulez-vous continuer?');
define ('_AM_WGGALLERY_MAINTENANCE_WATERMARK', 'Ajouter des filigranes � un album plus tard');
define ('_AM_WGGALLERY_MAINTENANCE_WATERMARK_DESC', 'Ajouter des filigranes � un album s�lectionn�. <br> Attention: les filigranes existants ne seront pas supprim�s. <br> S\'il y a d�j� des filigranes dessus, un filigrane suppl�mentaire sera ajout� aux images.');
define ('_AM_WGGALLERY_MAINTENANCE_IMGDIR', 'Image des �l�ments cass�s dans le r�pertoire');
define ('_AM_WGGALLERY_MAINTENANCE_IMGDIR_DESC', 'Les �l�ments des images de table sont recherch�s, l� o� l\'image n\'est pas dans le r�pertoire de t�l�chargement.');
define ('_AM_WGGALLERY_MAINTENANCE_IMGALB', 'Image des �l�ments cass�s dans les albums');
define ('_AM_WGGALLERY_MAINTENANCE_IMGALB_DESC', 'Les �l�ments des images de table sont recherch�s, o� l\'album parent n\'existe plus (plus).');
define ('_AM_WGGALLERY_MAINTENANCE_ITEM_SEARCH', 'Rechercher des �l�ments');
define ('_AM_WGGALLERY_MAINTENANCE_IMG_SEARCHOK', 'Aucune image cass�e trouv�e');
define ('_AM_WGGALLERY_MAINTENANCE_IMG_CLEAN', 'Nettoyer les �l�ments cass�s');
define ('_AM_WGGALLERY_MAINTENANCE_CHECK_SYSTEM', 'V�rifications du syst�me');
define ('_AM_WGGALLERY_MAINTENANCE_CHECK_SYSTEMDESC', 'V�rifie si les param�tres php sont compatibles avec les param�tres de votre module');
define ('_AM_WGGALLERY_MAINTENANCE_CHECK_RESULTS', 'R�sultat des v�rifications syst�me');
define ('_AM_WGGALLERY_MAINTENANCE_CHECK_TYPE', "V�rifier le param�tre PHP '%s'");
define ('_AM_WGGALLERY_MAINTENANCE_CHECK_MS_DESC', 'Le param�tre du module autorise %s octets');
define ('_AM_WGGALLERY_MAINTENANCE_CHECK_PMS_INFO', 'D�finit la taille maximale des donn�es de publication autoris�es');
define ('_AM_WGGALLERY_MAINTENANCE_CHECK_PMS_DESC', 'Taille maximale du fichier pour la publication: %s (%b octets)');
define ('_AM_WGGALLERY_MAINTENANCE_CHECK_FU_INFO', 'Autoriser ou non les t�l�chargements de fichiers HTTP');
define ('_AM_WGGALLERY_MAINTENANCE_CHECK_FU_DESC', 'File upload allowes:');
define ('_AM_WGGALLERY_MAINTENANCE_CHECK_UMF_INFO', 'D�finit la taille maximale pour le t�l�chargement de fichiers');
define ('_AM_WGGALLERY_MAINTENANCE_CHECK_UMF_DESC', 'Taille maximale de fichier pour le t�l�chargement de fichier: %s (%b octets)');
define ('_AM_WGGALLERY_MAINTENANCE_CHECK_ML_INFO1', 'D�finit la quantit� maximale de m�moire en octets qu\'un script est autoris� � allouer');
define ('_AM_WGGALLERY_MAINTENANCE_CHECK_ML_INFO2', 'Si vous avez des probl�mes avec le t�l�chargement de grandes images, augmentez cette valeur');
define ('_AM_WGGALLERY_MAINTENANCE_CHECK_ML_DESC', 'Limite de m�moire maximale: %s (%b octets)');
define ('_AM_WGGALLERY_MAINTENANCE_CHECK_MS_ERROR1', 'Veuillez r�duire la configuration du module ou augmenter la configuration php');
define ('_AM_WGGALLERY_MAINTENANCE_CHECK_MS_ERROR2', 'Veuillez activer le param�tre php');
define ('_AM_WGGALLERY_MAINTENANCE_CHECK_MS_ERROR3', 'memory_limit doit �tre sup�rieur � upload_max_filesize et sup�rieur � post_max_size');
define ('_AM_WGGALLERY_MAINTENANCE_READ_EXIF', 'Lire les donn�es Exif');
define ('_AM_WGGALLERY_MAINTENANCE_READ_EXIF_DESC', 'Lisez et enregistrez � nouveau les donn�es exif pour toutes les images');
define ('_AM_WGGALLERY_MAINTENANCE_READ_EXIF_READ', 'Lire les donn�es exif manquantes');
define ('_AM_WGGALLERY_MAINTENANCE_READ_EXIF_READALL', 'Relire toutes les donn�es exif');
define ('_AM_WGGALLERY_MAINTENANCE_READ_EXIF_SUCCESS', 'Lecture exif r�ussie');
define ('_AM_WGGALLERY_MAINTENANCE_READ_EXIF_ERROR', 'Erreur lors de la lecture d\'exif');
define ('_AM_WGGALLERY_MAINTENANCE_CHECK_SPACE', 'V�rifier l\'espace utilis� dans le r�pertoire de t�l�chargement');
define ('_AM_WGGALLERY_MAINTENANCE_CHECK_SPACE_DESC', 'Les r�pertoires de t�l�chargement suivants seront v�rifi�s afin d\'obtenir de l\'espace utilis�: <ul>
<li>%p / albums / </li>
<li>%p / large / </li>
<li>%p / moyen / </li>
<li>%p / thumbs / </li>
<li>%p / temp / </li>
</ul> ');
define ('_AM_WGGALLERY_MAINTENANCE_ERROR_SOURCE', 'Erreur - fichier source n�cessaire introuvable:');
define ('_AM_WGGALLERY_MAINTENANCE_CHECK_MT', 'V�rifier les types MIME');
define ('_AM_WGGALLERY_MAINTENANCE_CHECK_MT_DESC', 'V�rifier la table image pour: <ul>
<li> types MIME non valides </li>
<li> types MIME non autoris�s selon les pr�f�rences du module </li>
</ul> ');
define ('_AM_WGGALLERY_MAINTENANCE_CHECK_MT_SEARCH', 'Rechercher des mimetypes invalides');
define ('_AM_WGGALLERY_MAINTENANCE_CHECK_MT_CLEAN', 'Nettoyer les types MIME invalides');
define ('_ _AM_WGGALLERY_MAINTENANCE_CHECK_MT_SUCCESS', 'le type de mime %s de %t sont valides');
define ('_AM_WGGALLERY_MAINTENANCE_CHECK_MT_SUCCESSOK', 'Type MIME valide');
define ('_AM_WGGALLERY_MAINTENANCE_CHECK_MT_ERROR', 'Type de mime invalide');
define ('_AM_WGGALLERY_MAINTENANCE_CHECK_MT_SAVESUCCESS', 'Mimetype r�ussi avec succ�s');
define ('_AM_WGGALLERY_MAINTENANCE_CHECK_MT_SAVEERROR', 'Erreur lors de la sauvegarde du type MIME');
define ('_AM_WGGALLERY_MAINTENANCE_INVALIDRATE', 'Nettoyage des notes / likes');
define ('_AM_WGGALLERY_MAINTENANCE_INVALIDRATE_DESC', 'Supprimer les notes / likes, o� l\'image n\'existe plus');
define ('_AM_WGGALLERY_MAINTENANCE_INVALIDRATE_NUM', '%e des �valuations de %s ne sont pas valides');
define ('_AM_WGGALLERY_MAINTENANCE_INVALIDRATE_RESULT', '%s de %t �valuations nettoy�es');
define ('_AM_WGGALLERY_MAINTENANCE_INVALIDCATS', 'Nettoyage des cat�gories utilis�es');
define ('_AM_WGGALLERY_MAINTENANCE_INVALIDCATS_DESC', 'Supprimer la cat�gorie dans les albums et les images, si la cat�gorie n\'existe plus');
define ('_AM_WGGALLERY_MAINTENANCE_INVALIDCATS_RESULT', '%t �l�ments ont �t� nettoy�s');
// Importer
define ('_AM_WGGALLERY_IMPORT', 'Importer des donn�es et des fichiers � partir d\'autres modules de la galerie');
define ('_AM_WGGALLERY_IMPORT_LIST', 'Liste des modules pris en charge');
define ('_AM_WGGALLERY_IMPORT_SUPPORT', 'Modules pris en charge pour l\'importation');
define ('_AM_WGGALLERY_IMPORT_SUP_INSTALLED', 'le module est install�');
define ('_AM_WGGALLERY_IMPORT_SUP_NOTINSTALLED', 'le module n\'est pas install�');
define ('_AM_WGGALLERY_IMPORT_FOUND', 'R�sultat de la recherche');
define ('_AM_WGGALLERY_IMPORT_READ', 'Lire les donn�es du module');
define ('_AM_WGGALLERY_IMPORT_EXEC', 'Importer des donn�es et des fichiers');
define ('_AM_WGGALLERY_IMPORT_NUMALB', 'Nombre d\'albums');
define ('_AM_WGGALLERY_IMPORT_NUMIMG', 'Nombre d\'images');
define ('_AM_WGGALLERY_IMPORT_INFO_SIZE', 'Attention: les images ne seront pas redimensionn�es en corrigeant les pr�f�rences du module. Si vous souhaitez redimensionner, utilisez "Maintenance" apr�s l\'importation.');
define ('_AM_WGGALLERY_IMPORT_ERR', 'L\'importation de donn�es n\'est possible que lorsque les tableaux d\'albums et d\'images sont vides');
define ('_AM_WGGALLERY_IMPORT_ERR_ALBEXIST', 'Il existe d�j� des albums');
define ('_AM_WGGALLERY_IMPORT_ERR_IMGEXIST', 'Il existe d�j� des images');
define ('_AM_WGGALLERY_IMPORT_SUCCESS', '%a albums et %i images ont �t� import�s avec succ�s');
define ('_AM_WGGALLERY_IMPORT_ERROR', 'Une erreur est survenue lors de l\'importation');

define ('_AM_WGGALLERY_MAINTENANCE_DELETE_EXIF', 'Supprimer les donn�es Exif');
define ('_AM_WGGALLERY_MAINTENANCE_EXIF_CURRENT', 'Donn�es exif actuellement manquantes: %c des images %t');
define ('_AM_WGGALLERY_MAINTENANCE_DELETE_EXIF_SUCCESS', 'Donn�es Exif supprim�es avec succ�s');
define ('_AM_WGGALLERY_MAINTENANCE_DELETE_EXIF_ERROR', 'Erreur lors de la suppression des donn�es Exif');

define ('_AM_WGGALLERY_PERMS_ALBDEFAULT', 'Autorisations par d�faut nouvel album');
define ('_AM_WGGALLERY_PERMS_ALBDEFAULT_DESC', 'D�finissez les autorisations par d�faut pour la cr�ation d\'un nouvel album');


// JJDai - defitions manquantes
define ('_AM_WGGALLERY_OPTION_GT_SLIDERTYPE', 'Type de diaporama');
define ('_AM_WGGALLERY_OPTION_GT_SLIDERTYPE_1', 'Tailles d�finies');
define ('_AM_WGGALLERY_OPTION_GT_SLIDERTYPE_2', 'Largeur totale du mod�le');
define ('_AM_WGGALLERY_ADD_ALBUM', 'Ajoutez un nouvel album');
define ('_AM_WGGALLERY_ADD_CATEGORY', 'Ajouter une cat�gorie');
define ('_AM_WGGALLERY_ADD_IMAGE', 'Ajoutez une image');
define ('_AM_WGGALLERY_ALBUM_IMGID', 'ID de l\'image');
define ('_AM_WGGALLERY_ALBUM_IMGNAME', 'Nom de l\'image');
define ('_AM_WGGALLERY_ALBUMS_LIST', 'Liste des albums');
define ('_AM_WGGALLERY_ALBUMTYPES_LIST', 'Liste des types d\'albums');
define ('_AM_WGGALLERY_CAT_ALBUM', 'Utiliser la cat�gorie pour les albums');
define ('_AM_WGGALLERY_CAT_ERROR_CHANGE', 'Erreur lors du changement d\'option');
define ('_AM_WGGALLERY_CAT_ID', 'Id');
define ('_AM_WGGALLERY_CAT_IMAGE', 'Utiliser la cat�gorie pour les images');
define ('_AM_WGGALLERY_CAT_SEARCH', 'Utiliser la cat�gorie pour la recherche');
define ('_AM_WGGALLERY_CAT_TEXT', 'Texte de la cat�gorie');
define ('_AM_WGGALLERY_CATEGORIES_LIST', 'Liste des cat�gories');
define ('_AM_WGGALLERY_GALLERYTYPES_LIST', 'Liste des types de galleries');
define ('_AM_WGGALLERY_GT_AT_CREDITS', 'Cr�dits');
define ('_AM_WGGALLERY_GT_AT_DATE', 'Date');
define ('_AM_WGGALLERY_GT_AT_ID', 'Id');
define ('_AM_WGGALLERY_GT_AT_NAME', 'Nom');
define ('_AM_WGGALLERY_GT_AT_OPTIONS', 'Options');
define ('_AM_WGGALLERY_GT_AT_PRIMARY', 'Primary');
define ('_AM_WGGALLERY_GT_AT_PRIMARY_0', 'Pas actuellement principal');
define ('_AM_WGGALLERY_GT_AT_PRIMARY_1', 'Actuellement primaire');
define ('_AM_WGGALLERY_GT_AT_PRIMARY_SET', 'Principal');
define ('_AM_WGGALLERY_GT_AT_TEMPLATE', 'Mod�le');
define ('_AM_WGGALLERY_IMAGES_LIST', 'Liste des images');
define ('_AM_WGGALLERY_OPTION_GT_ARROWS', 'types de fl�ches');
define ('_AM_WGGALLERY_OPTION_GT_AUTOOPEN', 'Ouvrir automatiquement la fen�tre du diaporama');
define ('_AM_WGGALLERY_OPTION_GT_AUTOPLAY', 'Jouer automatiquement');
define ('_AM_WGGALLERY_OPTION_GT_BULLETS', 'Bullet types');
define ('_AM_WGGALLERY_OPTION_GT_BULLETS_DESC', 'Ne pas utiliser de puces avec des miniatures');
define ('_AM_WGGALLERY_OPTION_GT_BUTTTONCLOSE', 'Afficher le bouton de fermeture');
define ('_AM_WGGALLERY_OPTION_GT_COLORBOXSTYLE', 'Colorbox Style');
define ('_AM_WGGALLERY_OPTION_GT_FILLMODE', 'Options de remplissage d\'image');
define ('_AM_WGGALLERY_OPTION_GT_FILLMODE_0', '�tirer');
define ('_AM_WGGALLERY_OPTION_GT_FILLMODE_1', 'Conteneur (conserver le rapport hauteur / largeur / ajuster l\'image au conteneur interne)');
define ('_AM_WGGALLERY_OPTION_GT_FILLMODE_2', 'Cover (garder le ratio d\'aspect / ajuster l\'image au conteneur externe');
define ('_AM_WGGALLERY_OPTION_GT_FILLMODE_4', 'Taille actuelle');
define ('_AM_WGGALLERY_OPTION_GT_FILLMODE_5', 'Conteneur pour les grandes images, taille actuelle pour les petites images');
define ('_AM_WGGALLERY_OPTION_GT_LASTROW', 'Derni�re ligne');
define ('_AM_WGGALLERY_OPTION_GT_LASTROW_DESC', 'Si la derni�re ligne doit �tre ajust�e � la pleine largeur des lignes pr�c�dentes.');
define ('_AM_WGGALLERY_OPTION_GT_LOADINGS', 'type de symbole de chargement');
define ('_AM_WGGALLERY_OPTION_GT_MARGINS', 'Distance entre les images');
define ('_AM_WGGALLERY_OPTION_GT_MAXHEIGHT', 'Hauteur maximale de l\'image');
define ('_AM_WGGALLERY_OPTION_GT_MAXHEIGHT_DESC', 'D�finissez la hauteur maximale de l\'image du conteneur d\'images en pixels. Non valide pour'. _AM_WGGALLERY_OPTION_GT_SLIDERTYPE_2. "'");
define ('_AM_WGGALLERY_OPTION_GT_MAXWIDTH', 'Largeur maximale de l\'image');
define ('_AM_WGGALLERY_OPTION_GT_MAXWIDTH_DESC', "D�finissez la largeur d'image maximale du conteneur d\'image en pixels. Non valide pour '". _AM_WGGALLERY_OPTION_GT_SLIDERTYPE_2. "'");
define ('_AM_WGGALLERY_OPTION_GT_NAVBAR', 'Afficher la barre de navigation avec des vignettes');
define ('_AM_WGGALLERY_OPTION_GT_ORIENTATION', 'Ciblage');
define ('_AM_WGGALLERY_OPTION_GT_ORIENTATION_H', 'Horizontal');
define ('_AM_WGGALLERY_OPTION_GT_ORIENTATION_V', 'Vertical');
define ('_AM_WGGALLERY_OPTION_GT_OUTERBORDER', 'Distance ext�rieure du conteneur d\'image');
define ('_AM_WGGALLERY_OPTION_GT_PLAYOPTION_1', 'Jouer � plusieurs reprises');
define ('_AM_WGGALLERY_OPTION_GT_PLAYOPTION_12', 'Arr�ter au clic ou � chaque action de l\'utilisateur');
define ('_AM_WGGALLERY_OPTION_GT_PLAYOPTION_2', 'Arr�ter � la derni�re photo');
define ('_AM_WGGALLERY_OPTION_GT_PLAYOPTION_4', 'Stop on click');
define ('_AM_WGGALLERY_OPTION_GT_PLAYOPTION_8', 'Arr�ter � l\'action de l\'utilisateur (cliquez sur la fl�che / puce / aper�u de l\'image, faites glisser la diapositive, appuyez sur le bouton gauche ou droit)');
define ('_AM_WGGALLERY_OPTION_GT_PLAYOPTION_DESC', 'Lancer automatiquement le diaporama apr�s ouverture');
define ('_AM_WGGALLERY_OPTION_GT_PLAYOPTIONS', 'play options');
define ('_AM_WGGALLERY_OPTION_GT_RANDOMIZE', 'Afficher les images dans un ordre al�atoire');
define ('_AM_WGGALLERY_OPTION_GT_ROWHEIGHT', 'Row Height');
define ('_AM_WGGALLERY_OPTION_GT_SET', 'D�finir les options pour le type de galerie s�lectionn�');
define ('_AM_WGGALLERY_OPTION_GT_SHOWTHUMBS', 'Afficher les vignettes');
define ('_AM_WGGALLERY_OPTION_GT_SHOWTHUMBSDOTS', 'Afficher les vignettes ou les points');
define ('_AM_WGGALLERY_OPTION_GT_SLIDESHOW', 'Show picture show');
define ('_AM_WGGALLERY_OPTION_GT_SLIDESHOW_OPTIONS', 'Options pour le diaporama (toutes les options ne sont pas appliqu�es � chaque style de bo�te de couleur):');
define ('_AM_WGGALLERY_OPTION_GT_SLIDESHOWSPEED', 'vitesse du diaporama');
define ('_AM_WGGALLERY_OPTION_GT_SLIDESHOWSPEED_DESC', 'Intervalle en millisecondes avant que l\'image suivante ne soit affich�e');
define ('_AM_WGGALLERY_OPTION_GT_SOURCE', 'Source du diaporama');
define ('_AM_WGGALLERY_OPTION_GT_SOURCE_DESC', "Attention: si l\'utilisateur n\'a pas le droit de t�l�charger une grande image, la source de cet utilisateur est automatiquement r�duite � \'images moyennes\' pour emp�cher le t�l�chargement non autoris� de grandes images en cliquant sur le bouton droit de la souris . <br> Les utilisateurs ayant le droit de t�l�charger de grandes images seront affich�s m�me si vous avez s�lectionn� \'grandes images\' ");
define ('_AM_WGGALLERY_OPTION_GT_SOURCE_LARGE', 'grandes images');
define ('_AM_WGGALLERY_OPTION_GT_SOURCE_MEDIUM', 'images du milieu');
define ('_AM_WGGALLERY_OPTION_GT_SOURCE_PREVIEW', 'Vignette source');
define ('_AM_WGGALLERY_OPTION_GT_SOURCE_THUMB', 'Miniatures');
define ('_AM_WGGALLERY_OPTION_GT_SPEEDOPEN', 'Vitesse pour ouvrir le diaporama');
define ('_AM_WGGALLERY_OPTION_GT_THUMBNAILS', 'Type de vignettes de liste');
define ('_AM_WGGALLERY_OPTION_GT_TRANSEFFECT', 'effet de transition');
define ('_AM_WGGALLERY_OPTION_GT_TRANSORDER', 'Transition de commande');
define ('_AM_WGGALLERY_OPTION_GT_TRANSORDER_INORDER', 'Dans l\'ordre de la liste');
define ('_AM_WGGALLERY_OPTION_GT_TRANSORDER_RANDOM', 'Al�atoire');
define ('_AM_WGGALLERY_STATISTICS', 'Statistiques');
define ('_AM_WGGALLERY_THEREARE_ALBUMS', "Il y a <span class = 'bold'> %s </span> album(s) dans la base de donn�es");
define ('_AM_WGGALLERY_THEREARE_ALBUMTYPES', "Il y a <span class = 'bold'> %s </span> type(s) d'albums dans la base de donn�es");
define ('_AM_WGGALLERY_THEREARE_CATEGORIES', "Il y a <span class = 'bold'> %s </span> cat�gorie(s) dans la base de donn�es");
define ('_AM_WGGALLERY_THEREARE_GALLERYTYPES', "Il y a <span class = 'bold'> %s </span> type(s) de galeries dans la base de donn�es");
define ('_AM_WGGALLERY_THEREARE_IMAGES', "Il y a <span class = 'bold'> %s </span> image(s) dans la base de donn�es");
define ('_AM_WGGALLERY_THEREARE_WATERMARKS', "Il y a <span class = 'bold'> %s </span> filigrane(s) dans la base de donn�es");
define ('_AM_WGGALLERY_THEREARENT_CATEGORIES', 'Cat�gorie parent');
define ('_AM_WGGALLERY_THEREARENT_WATERMARKS', 'Aucun filigrane n\'est actuellement d�fini !');
define ('_AM_WGGALLERY_WATERMARKS_LIST', 'Liste des filigranes');
