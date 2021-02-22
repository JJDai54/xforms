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
define ('_AM_WGGALLERY_OPTION_GT_SHOW_2', 'Afficher la barre de navigation uniquement lorsque la largeur de l\'écran est supérieure à 768 pixels');
define ('_AM_WGGALLERY_OPTION_GT_SHOW_3', 'Afficher la barre de navigation uniquement lorsque la largeur de l\'écran est supérieure à 992 pixels');
define ('_AM_WGGALLERY_OPTION_GT_SHOW_4', 'Afficher la barre de navigation uniquement lorsque la largeur de l\'écran est supérieure à 1200 pixels');
define ('_AM_WGGALLERY_OPTION_GT_TOOLBAR', 'Afficher la barre d\'outils');
define ('_AM_WGGALLERY_OPTION_GT_TOOLBARZOOM', 'Afficher les boutons de zoom dans la barre d\'outils');
define ('_AM_WGGALLERY_OPTION_GT_TOOLBARDOWNLOAD', 'Afficher les boutons de téléchargement dans la barre d\'outils');
define ('_AM_WGGALLERY_OPTION_GT_TOOLBARDOWNLOAD_DESC', 'Si vous activez cette option, le fichier source sera toujours téléchargé. Faites attention: ceci dans les permissions définies dans les paramètres de l\'album.');
define ('_AM_WGGALLERY_OPTION_GT_FULLSCREEN', 'Passer en plein écran au démarrage du diaporama');
define ('_AM_WGGALLERY_OPTION_GT_TRANSDURATION', 'Vitesse de transition');
define ('_AM_WGGALLERY_OPTION_GT_TRANSDURATION_DESC', 'Période d\'animation en millisecondes entre 2 images');
define ('_AM_WGGALLERY_OPTION_GT_INDEXIMG', 'Type d\'image sur la page d\'index');
define ('_AM_WGGALLERY_OPTION_GT_INDEXIMGHEIGHT', 'Hauteur de l\'image');
define ('_AM_WGGALLERY_OPTION_GT_SHOWLABEL', 'Afficher l\'index de l\'image (Image {actuelle} de {total}%)');
define ('_AM_WGGALLERY_OPTION_GT_LCLSKIN', 'Commandes de style');
define ('_AM_WGGALLERY_OPTION_GT_ANIMTIME', 'Vitesse d\'animation');
define ('_AM_WGGALLERY_OPTION_GT_ANIMTIME_DESC', 'Temps pour l\'animation (par exemple redimensionner l\'image) entre deux images en millisecondes');
define ('_AM_WGGALLERY_OPTION_GT_LCLCOUNTER', 'Afficher le compteur');
define ('_AM_WGGALLERY_OPTION_GT_LCLPROGRESSBAR', 'Afficher la barre de progression');
define ('_AM_WGGALLERY_OPTION_GT_LCLMAXWIDTH', 'Largeur maximale de la galerie (en % de la fenêtre)');
define ('_AM_WGGALLERY_OPTION_GT_LCLMAXHEIGTH', 'Hauteur maximale de la galerie (en % de la fenêtre)');
define ('_AM_WGGALLERY_OPTION_GT_BACKGROUND', 'Arrière-plan');
define ('_AM_WGGALLERY_OPTION_GT_BACKHEIGHT', 'Hauteur du fond');
define ('_AM_WGGALLERY_OPTION_GT_BORDER', 'Border');
define ('_AM_WGGALLERY_OPTION_GT_BORDERWIDTH', 'Largeur');
define ('_AM_WGGALLERY_OPTION_GT_BORDERCOLOR', 'Couleur');
define ('_AM_WGGALLERY_OPTION_GT_BORDERPADDING', 'Padding');
define ('_AM_WGGALLERY_OPTION_GT_BORDERRADIUS', 'Radius');
define ('_AM_WGGALLERY_OPTION_GT_SHADOW', 'Afficher l\'ombre');
define ('_AM_WGGALLERY_OPTION_GT_LCLDATAPOSITION', 'Position des données');
define ('_AM_WGGALLERY_OPTION_GT_LCLDATAPOSITION_UNDER', 'Sous');
define ('_AM_WGGALLERY_OPTION_GT_LCLDATAPOSITION_OVER', 'Dessus');
define ('_AM_WGGALLERY_OPTION_GT_LCLDATAPOSITION_RSIDE', 'Côté droit');
define ('_AM_WGGALLERY_OPTION_GT_LCLDATAPOSITION_LSIDE', 'Côté gauche');
define ('_AM_WGGALLERY_OPTION_GT_LCLDATAPOSITION_DESC', "Veuillez noter que lightbox utilise un système intelligent qui passe automatiquement à '". _AM_WGGALLERY_OPTION_GT_LCLDATAPOSITION_OVER. "' dès que l\'élément devient trop petit à cause de longs textes ou d\'une petite fenêtre.");
define ('_AM_WGGALLERY_OPTION_GT_LCLCMDPOSITION', 'Position de la commande');
define ('_AM_WGGALLERY_OPTION_GT_LCLCMDPOSITION_INNER', 'Inner');
define ('_AM_WGGALLERY_OPTION_GT_LCLCMDPOSITION_OUTER', 'Externe');
define ('_AM_WGGALLERY_OPTION_GT_LCLCMDPOSITION_DESC', "Veuillez noter que lightbox passera automatiquement à '". _AM_WGGALLERY_OPTION_GT_LCLCMDPOSITION_OUTER. "' si les commandes internes sont trop larges pour l\'élément représenté");
define ('_AM_WGGALLERY_OPTION_GT_LCLTHUMBSWIDTH', 'Largeur des vignettes (en pixel)');
define ('_AM_WGGALLERY_OPTION_GT_LCLTHUMBSHEIGTH', 'Hauteur des vignettes (en pixel)');
define ('_AM_WGGALLERY_OPTION_GT_LCLFULLSCREEN', "Afficher la commande 'Plein écran'");
define ('_AM_WGGALLERY_OPTION_GT_LCLFSIMGBEHAVIOUR', 'Comportement de l\'image plein écran');
define ('_AM_WGGALLERY_OPTION_GT_LCLFSIMGBEHAVIOUR_FIT', 'fit - l\'image sera complètement visible (laissant éventuellement des espaces sur les bords)');
define ('_AM_WGGALLERY_OPTION_GT_LCLFSIMGBEHAVIOUR_FILL', 'fill - image remplira toujours l\' écran (une partie pourrait être éventuellement masquée) ');
define ('_AM_WGGALLERY_OPTION_GT_LCLFSIMGBEHAVIOUR_SMART', "smart - LC Lightbox utilise le mode 'fit' et passe à 'fill' uniquement si le rapport hauteur / largeur des images est similaire à l\'espace disponible");
define ('_AM_WGGALLERY_OPTION_GT_LCLSOCIALS', "Show command 'Socials'");
define ('_AM_WGGALLERY_OPTION_GT_LCLSOCIALS_FB', 'Facebook App ID');
define ('_AM_WGGALLERY_OPTION_GT_LCLSOCIALS_FB_DESC', 'N\'oubliez pas d\'ajouter le SDK Facebook dans votre site Web');
define ('_AM_WGGALLERY_OPTION_GT_LCLDOWNLOAD', "Afficher la commande 'Télécharger'");
define ('_AM_WGGALLERY_OPTION_GT_LCLRCLICK', 'Désactiver le clic droit de la souris');
define ('_AM_WGGALLERY_OPTION_GT_LCLTOGGLETXT', "Afficher la commande à bascule 'Texte'");
define ('_AM_WGGALLERY_OPTION_GT_LCLNAVBTNPOS', 'Position des boutons de navigation');
define ('_AM_WGGALLERY_OPTION_GT_LCLNAVBTNPOS_N', 'Normal');
define ('_AM_WGGALLERY_OPTION_GT_LCLNAVBTNPOS_M', 'Middle');
define ('_AM_WGGALLERY_OPTION_GT_LCLSLIDESHOW', "Afficher la commande 'Lecture'");
// Ajout / modification de type d\'album
define ('_AM_WGGALLERY_ALBUMTYPE_ADD', 'Add Albumtype');
define ('_AM_WGGALLERY_ALBUMTYPE_EDIT', 'Edit Albumtype');
// options des types d\'album
define ('_AM_WGGALLERY_OPTION_AT_SET', 'Définir les options pour le type d\'album sélectionné');
define ('_AM_WGGALLERY_OPTION_AT_SETINFO', 'Les paramètres des types d\'albums seront utilisés pour la page d\'index et les blocs d\'album');
define ('_AM_WGGALLERY_OPTION_AT_HOVER', 'Effet de survol');
define ('_AM_WGGALLERY_OPTION_AT_NB_COLS_ALB', 'Nombre de colonnes pour la liste des albums');
define ('_AM_WGGALLERY_OPTION_AT_NB_COLS_CAT', 'Nombre de colonnes pour la liste des catégories');
// options communes
define ('_AM_WGGALLERY_OPTION_OPACITIY', 'Opacity');
define ('_AM_WGGALLERY_OPTION_SHOWTITLE', 'Afficher le titre');
define ('_AM_WGGALLERY_OPTION_SHOWDESCR', 'Afficher la description');
define ('_AM_WGGALLERY_OPTION_CSS', 'Sélectionnez css pour le style');
define ('_AM_WGGALLERY_OPTION_SHOWSUBMITTER', 'Afficher le soumissionnaire');
// Entretien
define ('_AM_WGGALLERY_MAINTENANCE_ALBUM_SELECT', 'Choisir un album');
define ('_AM_WGGALLERY_MAINTENANCE_EXECUTE_DR', 'Supprimer et réinitialiser');
define ('_AM_WGGALLERY_MAINTENANCE_EXECUTE_R', 'Définir les paramètres par défaut');
define ('_AM_WGGALLERY_MAINTENANCE_EXECUTE_RIL', 'Redimensionner toutes les grandes images');
define ('_AM_WGGALLERY_MAINTENANCE_EXECUTE_RIM', 'Redimensionner toutes les images moyennes');
define ('_AM_WGGALLERY_MAINTENANCE_EXECUTE_RIT', 'Redimensionner tous les vignettes');
define ('_AM_WGGALLERY_MAINTENANCE_EXECUTE_DUI', 'Supprimer les images inutilisées');
define ('_AM_WGGALLERY_MAINTENANCE_EXECUTE_DUI_SHOW', 'Afficher la liste des images inutilisées');
define ('_AM_WGGALLERY_MAINTENANCE_SUCCESS_RESET', 'Réinitialisation réussie:');
define ('_AM_WGGALLERY_MAINTENANCE_SUCCESS_CREATE', 'Création réussie:');
define ('_AM_WGGALLERY_MAINTENANCE_SUCCESS_RESIZE', 'Redimensionnement réussi: %s fois redimensionné pour %t images');
define ('_AM_WGGALLERY_MAINTENANCE_SUCCESS_DELETE', 'Suppression réussie:');
define ('_AM_WGGALLERY_MAINTENANCE_ERROR_RESET', 'Erreur lors de la réinitialisation:');
define ('_AM_WGGALLERY_MAINTENANCE_ERROR_CREATE', 'Erreur lors de la création:');
define ('_AM_WGGALLERY_MAINTENANCE_ERROR_DELETE', 'Erreur lors de la suppression:');
define ('_AM_WGGALLERY_MAINTENANCE_ERROR_RESIZE', 'Erreur lors du redimensionnement:');
define ('_AM_WGGALLERY_MAINTENANCE_ERROR_READDIR', 'Erreur lors de la lecture du répertoire:');
define ('_AM_WGGALLERY_MAINTENANCE_TYP', 'Type de maintenance');
define ('_AM_WGGALLERY_MAINTENANCE_DESC', 'Description');
define ('_AM_WGGALLERY_MAINTENANCE_RESULTS', 'Results');
define ('_AM_WGGALLERY_MAINTENANCE_GT', 'Maintain gallerytypes');
define ('_AM_WGGALLERY_MAINTENANCE_GT_DESC', 'Supprimer les types de galerie non pris en charge et / ou réinitialiser tous les types de galerie aux valeurs par défaut');
define ('_AM_WGGALLERY_MAINTENANCE_GT_SURERESET', 'Tous les paramètres de la galerie existants seront mis à jour avec les paramètres par défaut. Voulez-vous continuer?');
define ('_AM_WGGALLERY_MAINTENANCE_GT_SUREDELETE', 'Tous les types de galerie existants (paramètres inclus) seront supprimés et remplacés par les types de galerie actuels. Voulez-vous continuer?');
define ('_AM_WGGALLERY_MAINTENANCE_AT', 'Maintain albumtypes');
define ('_AM_WGGALLERY_MAINTENANCE_AT_DESC', 'Supprimer les types d\'album n\'est plus pris en charge et / ou réinitialiser tous les types d\'album aux valeurs par défaut');
define ('_AM_WGGALLERY_MAINTENANCE_AT_SURERESET', 'Tous les paramètres d\'album existants seront mis à jour avec les types d\'album par défaut. Voulez-vous continuer?');
define ('_AM_WGGALLERY_MAINTENANCE_AT_SUREDELETE', 'Tous les types d\'album existants (paramètres inclus) seront supprimés et remplacés par les types d\'album actuels. Voulez-vous continuer?');
define ('_AM_WGGALLERY_MAINTENANCE_RESIZE', 'Redimensionner les images');
define ('_AM_WGGALLERY_MAINTENANCE_RESIZE_DESC', 'Redimensionner les images ou les vignettes à la hauteur maximale correspondant aux préférences du module. <br> Paramètres actuels: <ul>
<li> grand: largeur max %lw px / hauteur max %lh px </li>
<li> moyen: largeur max %mw px / hauteur max %mh px </li>
<li> vignette: largeur max %tw px / hauteur max %th px </li>
</ul> ');
define ('_AM_WGGALLERY_MAINTENANCE_RESIZE_INFO', 'Le redimensionnement de "grandes images" n\'est possible que si l\'image originale est disponible!');
define ('_AM_WGGALLERY_MAINTENANCE_RESIZE_SELECT', 'Sélectionnez le type d\'images à redimensionner');
define ('_AM_WGGALLERY_MAINTENANCE_DELETE_UNUSED', 'Nettoyer le répertoire des images');
define ('_AM_WGGALLERY_MAINTENANCE_DELETE_UNUSED_DESC', 'Toutes les images actuellement inutilisées des répertoires suivants seront supprimées: <ul>
<li>%p / albums / </li>
<li>%p / large / </li>
<li>%p / moyen / </li>
<li>%p / thumbs / </li>
<li>%p / temp / </li>
</ul> ');
define ('_AM_WGGALLERY_MAINTENANCE_DELETE_INVALID', "Supprimer les éléments non valides dans la table 'images'");
define ('_AM_WGGALLERY_MAINTENANCE_DELETE_INVALID_DESC', "Supprimer les éléments non valides dans la table 'images', par exemple l\'élément a été créé, mais une erreur s'est produite lors du téléchargement");
define ('_AM_WGGALLERY_MAINTENANCE_DELETE_INVALID_IMG', 'Article invalide: img_id');
define ('_AM_WGGALLERY_MAINTENANCE_DELETE_UNUSED_NONE', 'Aucune image inutilisée trouvée');
define ('_AM_WGGALLERY_MAINTENANCE_DUI_SUREDELETE', 'Toutes les images d\'album actuellement inutilisées seront supprimées! Voulez-vous continuer?');
define ('_AM_WGGALLERY_MAINTENANCE_WATERMARK', 'Ajouter des filigranes à un album plus tard');
define ('_AM_WGGALLERY_MAINTENANCE_WATERMARK_DESC', 'Ajouter des filigranes à un album sélectionné. <br> Attention: les filigranes existants ne seront pas supprimés. <br> S\'il y a déjà des filigranes dessus, un filigrane supplémentaire sera ajouté aux images.');
define ('_AM_WGGALLERY_MAINTENANCE_IMGDIR', 'Image des éléments cassés dans le répertoire');
define ('_AM_WGGALLERY_MAINTENANCE_IMGDIR_DESC', 'Les éléments des images de table sont recherchés, là où l\'image n\'est pas dans le répertoire de téléchargement.');
define ('_AM_WGGALLERY_MAINTENANCE_IMGALB', 'Image des éléments cassés dans les albums');
define ('_AM_WGGALLERY_MAINTENANCE_IMGALB_DESC', 'Les éléments des images de table sont recherchés, où l\'album parent n\'existe plus (plus).');
define ('_AM_WGGALLERY_MAINTENANCE_ITEM_SEARCH', 'Rechercher des éléments');
define ('_AM_WGGALLERY_MAINTENANCE_IMG_SEARCHOK', 'Aucune image cassée trouvée');
define ('_AM_WGGALLERY_MAINTENANCE_IMG_CLEAN', 'Nettoyer les éléments cassés');
define ('_AM_WGGALLERY_MAINTENANCE_CHECK_SYSTEM', 'Vérifications du système');
define ('_AM_WGGALLERY_MAINTENANCE_CHECK_SYSTEMDESC', 'Vérifie si les paramètres php sont compatibles avec les paramètres de votre module');
define ('_AM_WGGALLERY_MAINTENANCE_CHECK_RESULTS', 'Résultat des vérifications système');
define ('_AM_WGGALLERY_MAINTENANCE_CHECK_TYPE', "Vérifier le paramètre PHP '%s'");
define ('_AM_WGGALLERY_MAINTENANCE_CHECK_MS_DESC', 'Le paramètre du module autorise %s octets');
define ('_AM_WGGALLERY_MAINTENANCE_CHECK_PMS_INFO', 'Définit la taille maximale des données de publication autorisées');
define ('_AM_WGGALLERY_MAINTENANCE_CHECK_PMS_DESC', 'Taille maximale du fichier pour la publication: %s (%b octets)');
define ('_AM_WGGALLERY_MAINTENANCE_CHECK_FU_INFO', 'Autoriser ou non les téléchargements de fichiers HTTP');
define ('_AM_WGGALLERY_MAINTENANCE_CHECK_FU_DESC', 'File upload allowes:');
define ('_AM_WGGALLERY_MAINTENANCE_CHECK_UMF_INFO', 'Définit la taille maximale pour le téléchargement de fichiers');
define ('_AM_WGGALLERY_MAINTENANCE_CHECK_UMF_DESC', 'Taille maximale de fichier pour le téléchargement de fichier: %s (%b octets)');
define ('_AM_WGGALLERY_MAINTENANCE_CHECK_ML_INFO1', 'Définit la quantité maximale de mémoire en octets qu\'un script est autorisé à allouer');
define ('_AM_WGGALLERY_MAINTENANCE_CHECK_ML_INFO2', 'Si vous avez des problèmes avec le téléchargement de grandes images, augmentez cette valeur');
define ('_AM_WGGALLERY_MAINTENANCE_CHECK_ML_DESC', 'Limite de mémoire maximale: %s (%b octets)');
define ('_AM_WGGALLERY_MAINTENANCE_CHECK_MS_ERROR1', 'Veuillez réduire la configuration du module ou augmenter la configuration php');
define ('_AM_WGGALLERY_MAINTENANCE_CHECK_MS_ERROR2', 'Veuillez activer le paramètre php');
define ('_AM_WGGALLERY_MAINTENANCE_CHECK_MS_ERROR3', 'memory_limit doit être supérieur à upload_max_filesize et supérieur à post_max_size');
define ('_AM_WGGALLERY_MAINTENANCE_READ_EXIF', 'Lire les données Exif');
define ('_AM_WGGALLERY_MAINTENANCE_READ_EXIF_DESC', 'Lisez et enregistrez à nouveau les données exif pour toutes les images');
define ('_AM_WGGALLERY_MAINTENANCE_READ_EXIF_READ', 'Lire les données exif manquantes');
define ('_AM_WGGALLERY_MAINTENANCE_READ_EXIF_READALL', 'Relire toutes les données exif');
define ('_AM_WGGALLERY_MAINTENANCE_READ_EXIF_SUCCESS', 'Lecture exif réussie');
define ('_AM_WGGALLERY_MAINTENANCE_READ_EXIF_ERROR', 'Erreur lors de la lecture d\'exif');
define ('_AM_WGGALLERY_MAINTENANCE_CHECK_SPACE', 'Vérifier l\'espace utilisé dans le répertoire de téléchargement');
define ('_AM_WGGALLERY_MAINTENANCE_CHECK_SPACE_DESC', 'Les répertoires de téléchargement suivants seront vérifiés afin d\'obtenir de l\'espace utilisé: <ul>
<li>%p / albums / </li>
<li>%p / large / </li>
<li>%p / moyen / </li>
<li>%p / thumbs / </li>
<li>%p / temp / </li>
</ul> ');
define ('_AM_WGGALLERY_MAINTENANCE_ERROR_SOURCE', 'Erreur - fichier source nécessaire introuvable:');
define ('_AM_WGGALLERY_MAINTENANCE_CHECK_MT', 'Vérifier les types MIME');
define ('_AM_WGGALLERY_MAINTENANCE_CHECK_MT_DESC', 'Vérifier la table image pour: <ul>
<li> types MIME non valides </li>
<li> types MIME non autorisés selon les préférences du module </li>
</ul> ');
define ('_AM_WGGALLERY_MAINTENANCE_CHECK_MT_SEARCH', 'Rechercher des mimetypes invalides');
define ('_AM_WGGALLERY_MAINTENANCE_CHECK_MT_CLEAN', 'Nettoyer les types MIME invalides');
define ('_ _AM_WGGALLERY_MAINTENANCE_CHECK_MT_SUCCESS', 'le type de mime %s de %t sont valides');
define ('_AM_WGGALLERY_MAINTENANCE_CHECK_MT_SUCCESSOK', 'Type MIME valide');
define ('_AM_WGGALLERY_MAINTENANCE_CHECK_MT_ERROR', 'Type de mime invalide');
define ('_AM_WGGALLERY_MAINTENANCE_CHECK_MT_SAVESUCCESS', 'Mimetype réussi avec succès');
define ('_AM_WGGALLERY_MAINTENANCE_CHECK_MT_SAVEERROR', 'Erreur lors de la sauvegarde du type MIME');
define ('_AM_WGGALLERY_MAINTENANCE_INVALIDRATE', 'Nettoyage des notes / likes');
define ('_AM_WGGALLERY_MAINTENANCE_INVALIDRATE_DESC', 'Supprimer les notes / likes, où l\'image n\'existe plus');
define ('_AM_WGGALLERY_MAINTENANCE_INVALIDRATE_NUM', '%e des évaluations de %s ne sont pas valides');
define ('_AM_WGGALLERY_MAINTENANCE_INVALIDRATE_RESULT', '%s de %t évaluations nettoyées');
define ('_AM_WGGALLERY_MAINTENANCE_INVALIDCATS', 'Nettoyage des catégories utilisées');
define ('_AM_WGGALLERY_MAINTENANCE_INVALIDCATS_DESC', 'Supprimer la catégorie dans les albums et les images, si la catégorie n\'existe plus');
define ('_AM_WGGALLERY_MAINTENANCE_INVALIDCATS_RESULT', '%t éléments ont été nettoyés');
// Importer
define ('_AM_WGGALLERY_IMPORT', 'Importer des données et des fichiers à partir d\'autres modules de la galerie');
define ('_AM_WGGALLERY_IMPORT_LIST', 'Liste des modules pris en charge');
define ('_AM_WGGALLERY_IMPORT_SUPPORT', 'Modules pris en charge pour l\'importation');
define ('_AM_WGGALLERY_IMPORT_SUP_INSTALLED', 'le module est installé');
define ('_AM_WGGALLERY_IMPORT_SUP_NOTINSTALLED', 'le module n\'est pas installé');
define ('_AM_WGGALLERY_IMPORT_FOUND', 'Résultat de la recherche');
define ('_AM_WGGALLERY_IMPORT_READ', 'Lire les données du module');
define ('_AM_WGGALLERY_IMPORT_EXEC', 'Importer des données et des fichiers');
define ('_AM_WGGALLERY_IMPORT_NUMALB', 'Nombre d\'albums');
define ('_AM_WGGALLERY_IMPORT_NUMIMG', 'Nombre d\'images');
define ('_AM_WGGALLERY_IMPORT_INFO_SIZE', 'Attention: les images ne seront pas redimensionnées en corrigeant les préférences du module. Si vous souhaitez redimensionner, utilisez "Maintenance" après l\'importation.');
define ('_AM_WGGALLERY_IMPORT_ERR', 'L\'importation de données n\'est possible que lorsque les tableaux d\'albums et d\'images sont vides');
define ('_AM_WGGALLERY_IMPORT_ERR_ALBEXIST', 'Il existe déjà des albums');
define ('_AM_WGGALLERY_IMPORT_ERR_IMGEXIST', 'Il existe déjà des images');
define ('_AM_WGGALLERY_IMPORT_SUCCESS', '%a albums et %i images ont été importés avec succès');
define ('_AM_WGGALLERY_IMPORT_ERROR', 'Une erreur est survenue lors de l\'importation');

define ('_AM_WGGALLERY_MAINTENANCE_DELETE_EXIF', 'Supprimer les données Exif');
define ('_AM_WGGALLERY_MAINTENANCE_EXIF_CURRENT', 'Données exif actuellement manquantes: %c des images %t');
define ('_AM_WGGALLERY_MAINTENANCE_DELETE_EXIF_SUCCESS', 'Données Exif supprimées avec succès');
define ('_AM_WGGALLERY_MAINTENANCE_DELETE_EXIF_ERROR', 'Erreur lors de la suppression des données Exif');

define ('_AM_WGGALLERY_PERMS_ALBDEFAULT', 'Autorisations par défaut nouvel album');
define ('_AM_WGGALLERY_PERMS_ALBDEFAULT_DESC', 'Définissez les autorisations par défaut pour la création d\'un nouvel album');


// JJDai - defitions manquantes
define ('_AM_WGGALLERY_OPTION_GT_SLIDERTYPE', 'Type de diaporama');
define ('_AM_WGGALLERY_OPTION_GT_SLIDERTYPE_1', 'Tailles définies');
define ('_AM_WGGALLERY_OPTION_GT_SLIDERTYPE_2', 'Largeur totale du modèle');
define ('_AM_WGGALLERY_ADD_ALBUM', 'Ajoutez un nouvel album');
define ('_AM_WGGALLERY_ADD_CATEGORY', 'Ajouter une catégorie');
define ('_AM_WGGALLERY_ADD_IMAGE', 'Ajoutez une image');
define ('_AM_WGGALLERY_ALBUM_IMGID', 'ID de l\'image');
define ('_AM_WGGALLERY_ALBUM_IMGNAME', 'Nom de l\'image');
define ('_AM_WGGALLERY_ALBUMS_LIST', 'Liste des albums');
define ('_AM_WGGALLERY_ALBUMTYPES_LIST', 'Liste des types d\'albums');
define ('_AM_WGGALLERY_CAT_ALBUM', 'Utiliser la catégorie pour les albums');
define ('_AM_WGGALLERY_CAT_ERROR_CHANGE', 'Erreur lors du changement d\'option');
define ('_AM_WGGALLERY_CAT_ID', 'Id');
define ('_AM_WGGALLERY_CAT_IMAGE', 'Utiliser la catégorie pour les images');
define ('_AM_WGGALLERY_CAT_SEARCH', 'Utiliser la catégorie pour la recherche');
define ('_AM_WGGALLERY_CAT_TEXT', 'Texte de la catégorie');
define ('_AM_WGGALLERY_CATEGORIES_LIST', 'Liste des catégories');
define ('_AM_WGGALLERY_GALLERYTYPES_LIST', 'Liste des types de galleries');
define ('_AM_WGGALLERY_GT_AT_CREDITS', 'Crédits');
define ('_AM_WGGALLERY_GT_AT_DATE', 'Date');
define ('_AM_WGGALLERY_GT_AT_ID', 'Id');
define ('_AM_WGGALLERY_GT_AT_NAME', 'Nom');
define ('_AM_WGGALLERY_GT_AT_OPTIONS', 'Options');
define ('_AM_WGGALLERY_GT_AT_PRIMARY', 'Primary');
define ('_AM_WGGALLERY_GT_AT_PRIMARY_0', 'Pas actuellement principal');
define ('_AM_WGGALLERY_GT_AT_PRIMARY_1', 'Actuellement primaire');
define ('_AM_WGGALLERY_GT_AT_PRIMARY_SET', 'Principal');
define ('_AM_WGGALLERY_GT_AT_TEMPLATE', 'Modèle');
define ('_AM_WGGALLERY_IMAGES_LIST', 'Liste des images');
define ('_AM_WGGALLERY_OPTION_GT_ARROWS', 'types de flèches');
define ('_AM_WGGALLERY_OPTION_GT_AUTOOPEN', 'Ouvrir automatiquement la fenêtre du diaporama');
define ('_AM_WGGALLERY_OPTION_GT_AUTOPLAY', 'Jouer automatiquement');
define ('_AM_WGGALLERY_OPTION_GT_BULLETS', 'Bullet types');
define ('_AM_WGGALLERY_OPTION_GT_BULLETS_DESC', 'Ne pas utiliser de puces avec des miniatures');
define ('_AM_WGGALLERY_OPTION_GT_BUTTTONCLOSE', 'Afficher le bouton de fermeture');
define ('_AM_WGGALLERY_OPTION_GT_COLORBOXSTYLE', 'Colorbox Style');
define ('_AM_WGGALLERY_OPTION_GT_FILLMODE', 'Options de remplissage d\'image');
define ('_AM_WGGALLERY_OPTION_GT_FILLMODE_0', 'Étirer');
define ('_AM_WGGALLERY_OPTION_GT_FILLMODE_1', 'Conteneur (conserver le rapport hauteur / largeur / ajuster l\'image au conteneur interne)');
define ('_AM_WGGALLERY_OPTION_GT_FILLMODE_2', 'Cover (garder le ratio d\'aspect / ajuster l\'image au conteneur externe');
define ('_AM_WGGALLERY_OPTION_GT_FILLMODE_4', 'Taille actuelle');
define ('_AM_WGGALLERY_OPTION_GT_FILLMODE_5', 'Conteneur pour les grandes images, taille actuelle pour les petites images');
define ('_AM_WGGALLERY_OPTION_GT_LASTROW', 'Dernière ligne');
define ('_AM_WGGALLERY_OPTION_GT_LASTROW_DESC', 'Si la dernière ligne doit être ajustée à la pleine largeur des lignes précédentes.');
define ('_AM_WGGALLERY_OPTION_GT_LOADINGS', 'type de symbole de chargement');
define ('_AM_WGGALLERY_OPTION_GT_MARGINS', 'Distance entre les images');
define ('_AM_WGGALLERY_OPTION_GT_MAXHEIGHT', 'Hauteur maximale de l\'image');
define ('_AM_WGGALLERY_OPTION_GT_MAXHEIGHT_DESC', 'Définissez la hauteur maximale de l\'image du conteneur d\'images en pixels. Non valide pour'. _AM_WGGALLERY_OPTION_GT_SLIDERTYPE_2. "'");
define ('_AM_WGGALLERY_OPTION_GT_MAXWIDTH', 'Largeur maximale de l\'image');
define ('_AM_WGGALLERY_OPTION_GT_MAXWIDTH_DESC', "Définissez la largeur d'image maximale du conteneur d\'image en pixels. Non valide pour '". _AM_WGGALLERY_OPTION_GT_SLIDERTYPE_2. "'");
define ('_AM_WGGALLERY_OPTION_GT_NAVBAR', 'Afficher la barre de navigation avec des vignettes');
define ('_AM_WGGALLERY_OPTION_GT_ORIENTATION', 'Ciblage');
define ('_AM_WGGALLERY_OPTION_GT_ORIENTATION_H', 'Horizontal');
define ('_AM_WGGALLERY_OPTION_GT_ORIENTATION_V', 'Vertical');
define ('_AM_WGGALLERY_OPTION_GT_OUTERBORDER', 'Distance extérieure du conteneur d\'image');
define ('_AM_WGGALLERY_OPTION_GT_PLAYOPTION_1', 'Jouer à plusieurs reprises');
define ('_AM_WGGALLERY_OPTION_GT_PLAYOPTION_12', 'Arrêter au clic ou à chaque action de l\'utilisateur');
define ('_AM_WGGALLERY_OPTION_GT_PLAYOPTION_2', 'Arrêter à la dernière photo');
define ('_AM_WGGALLERY_OPTION_GT_PLAYOPTION_4', 'Stop on click');
define ('_AM_WGGALLERY_OPTION_GT_PLAYOPTION_8', 'Arrêter à l\'action de l\'utilisateur (cliquez sur la flèche / puce / aperçu de l\'image, faites glisser la diapositive, appuyez sur le bouton gauche ou droit)');
define ('_AM_WGGALLERY_OPTION_GT_PLAYOPTION_DESC', 'Lancer automatiquement le diaporama après ouverture');
define ('_AM_WGGALLERY_OPTION_GT_PLAYOPTIONS', 'play options');
define ('_AM_WGGALLERY_OPTION_GT_RANDOMIZE', 'Afficher les images dans un ordre aléatoire');
define ('_AM_WGGALLERY_OPTION_GT_ROWHEIGHT', 'Row Height');
define ('_AM_WGGALLERY_OPTION_GT_SET', 'Définir les options pour le type de galerie sélectionné');
define ('_AM_WGGALLERY_OPTION_GT_SHOWTHUMBS', 'Afficher les vignettes');
define ('_AM_WGGALLERY_OPTION_GT_SHOWTHUMBSDOTS', 'Afficher les vignettes ou les points');
define ('_AM_WGGALLERY_OPTION_GT_SLIDESHOW', 'Show picture show');
define ('_AM_WGGALLERY_OPTION_GT_SLIDESHOW_OPTIONS', 'Options pour le diaporama (toutes les options ne sont pas appliquées à chaque style de boîte de couleur):');
define ('_AM_WGGALLERY_OPTION_GT_SLIDESHOWSPEED', 'vitesse du diaporama');
define ('_AM_WGGALLERY_OPTION_GT_SLIDESHOWSPEED_DESC', 'Intervalle en millisecondes avant que l\'image suivante ne soit affichée');
define ('_AM_WGGALLERY_OPTION_GT_SOURCE', 'Source du diaporama');
define ('_AM_WGGALLERY_OPTION_GT_SOURCE_DESC', "Attention: si l\'utilisateur n\'a pas le droit de télécharger une grande image, la source de cet utilisateur est automatiquement réduite à \'images moyennes\' pour empêcher le téléchargement non autorisé de grandes images en cliquant sur le bouton droit de la souris . <br> Les utilisateurs ayant le droit de télécharger de grandes images seront affichés même si vous avez sélectionné \'grandes images\' ");
define ('_AM_WGGALLERY_OPTION_GT_SOURCE_LARGE', 'grandes images');
define ('_AM_WGGALLERY_OPTION_GT_SOURCE_MEDIUM', 'images du milieu');
define ('_AM_WGGALLERY_OPTION_GT_SOURCE_PREVIEW', 'Vignette source');
define ('_AM_WGGALLERY_OPTION_GT_SOURCE_THUMB', 'Miniatures');
define ('_AM_WGGALLERY_OPTION_GT_SPEEDOPEN', 'Vitesse pour ouvrir le diaporama');
define ('_AM_WGGALLERY_OPTION_GT_THUMBNAILS', 'Type de vignettes de liste');
define ('_AM_WGGALLERY_OPTION_GT_TRANSEFFECT', 'effet de transition');
define ('_AM_WGGALLERY_OPTION_GT_TRANSORDER', 'Transition de commande');
define ('_AM_WGGALLERY_OPTION_GT_TRANSORDER_INORDER', 'Dans l\'ordre de la liste');
define ('_AM_WGGALLERY_OPTION_GT_TRANSORDER_RANDOM', 'Aléatoire');
define ('_AM_WGGALLERY_STATISTICS', 'Statistiques');
define ('_AM_WGGALLERY_THEREARE_ALBUMS', "Il y a <span class = 'bold'> %s </span> album(s) dans la base de données");
define ('_AM_WGGALLERY_THEREARE_ALBUMTYPES', "Il y a <span class = 'bold'> %s </span> type(s) d'albums dans la base de données");
define ('_AM_WGGALLERY_THEREARE_CATEGORIES', "Il y a <span class = 'bold'> %s </span> catégorie(s) dans la base de données");
define ('_AM_WGGALLERY_THEREARE_GALLERYTYPES', "Il y a <span class = 'bold'> %s </span> type(s) de galeries dans la base de données");
define ('_AM_WGGALLERY_THEREARE_IMAGES', "Il y a <span class = 'bold'> %s </span> image(s) dans la base de données");
define ('_AM_WGGALLERY_THEREARE_WATERMARKS', "Il y a <span class = 'bold'> %s </span> filigrane(s) dans la base de données");
define ('_AM_WGGALLERY_THEREARENT_CATEGORIES', 'Catégorie parent');
define ('_AM_WGGALLERY_THEREARENT_WATERMARKS', 'Aucun filigrane n\'est actuellement défini !');
define ('_AM_WGGALLERY_WATERMARKS_LIST', 'Liste des filigranes');
