<?php
/**
 * Plugin plxShariff
 * 
 * @package PLX
 * @version 1.0
 * @date 04.01.2017
 * @author SudWebDesign.fr
 **/
if(!defined('PLX_ROOT')) exit; 
# Control du token du formulaire
plxToken::validateFormToken($_POST);

$all_services = 'Twitter,GooglePlus,Facebook,LinkedIn,StumbleUpon,Xing,Flattr,Pinterest,AddThis,Reddit,Whatsapp,Tumblr,Diaspora,Threema,Weibo,Tencent-weibo,Qzone,Mail,Print,Info';#,Print,Rss (next)
$plxBackend = PLX_PLUGINS.get_class($plxPlugin)."/backend.php";#backend plxShariff par defaut
$ttl=60;
if(!empty($_POST)) {
 $plxPlugin->setParam('style', $_POST['style'], 'string');
 $plxPlugin->setParam('theme', $_POST['theme'], 'string');
 $plxPlugin->setParam('mode', $_POST['mode'], 'string');
 $plxPlugin->setParam('js', $_POST['js'], 'string');
 $plxPlugin->setParam('themePerso', $_POST['themePerso'], 'string');
 $plxPlugin->setParam('services', (empty($_POST['services'])?$all_services:$_POST['services']), 'string');
 $plxPlugin->setParam('infoUrl', $_POST['infoUrl'], 'string');
 $plxPlugin->setParam('mailUrl', $_POST['mailUrl'], 'string');
 $plxPlugin->setParam('via', $_POST['via'], 'string');
 $plxPlugin->setParam('flatUser', $_POST['flatUser'], 'string');
 $plxPlugin->setParam('flatCat', $_POST['flatCat'], 'string');
 $plxPlugin->setParam('use_title', $_POST['use_title'], 'numeric');
 $plxPlugin->setParam('use_thumb', $_POST['use_thumb'], 'numeric');
 $plxPlugin->setParam('use_backend', $_POST['use_backend'], 'numeric');
 $plxPlugin->setParam('backend', (empty($_POST['backend'])?$plxBackend:$_POST['backend']), 'string');
 $plxPlugin->setParam('cache_ttl', (''==$_POST['cache_ttl'])?$ttl:$_POST['cache_ttl'], 'numeric');
 $plxPlugin->setParam('client_timeout', $_POST['client_timeout'], 'numeric');
 $plxPlugin->setParam('cache_sys', $_POST['cache_sys'], 'numeric');
 $plxPlugin->setParam('domains', $_POST['domains'], 'string');
 $plxPlugin->setParam('cc', $_POST['cc'], 'numeric');
 $plxPlugin->setParam('cacheClass', $_POST['cacheClass'], 'string');
 $plxPlugin->setParam('fcbk_app_id', $_POST['fcbk_app_id'], 'string');
 $plxPlugin->setParam('fcbk_secret', $_POST['fcbk_secret'], 'string');
 $plxPlugin->saveConfig();
 $plxPlugin->saveParams();
 header('Location: parametres_plugin.php?p='.get_class($plxPlugin));
 exit;
}

$parms = null;
$parms['style'] = $plxPlugin->getParam('style')!='' ? $plxPlugin->getParam('style') : 'horizontal';
$parms['theme'] = $plxPlugin->getParam('theme')!='' ? $plxPlugin->getParam('theme') : 'color';
$parms['mode'] = $plxPlugin->getParam('mode')!='' ? $plxPlugin->getParam('mode') : 'complete';
$parms['js'] = $plxPlugin->getParam('js')!='' ? $plxPlugin->getParam('js') : 'complete';
$parms['themePerso'] = $plxPlugin->getParam('themePerso')!='' ? $plxPlugin->getParam('themePerso') : '';
$parms['services'] = $plxPlugin->getParam('services');#!='' ? $plxPlugin->getParam('services') : $all_services;
$parms['infoUrl'] = $plxPlugin->getParam('infoUrl')!='' ? $plxPlugin->getParam('infoUrl') : '';#$plxAdmin->racine
$parms['mailUrl'] = $plxPlugin->getParam('mailUrl')!='' ? $plxPlugin->getParam('mailUrl') : '';
$parms['via'] = $plxPlugin->getParam('via')!='' ? $plxPlugin->getParam('via') : '';
$parms['flatUser'] = $plxPlugin->getParam('flatUser')!='' ? $plxPlugin->getParam('flatUser') : '';
$parms['flatCat'] = $plxPlugin->getParam('flatCat')!='' ? $plxPlugin->getParam('flatCat') : '';#$plxAdmin->racine
$parms['use_title'] = $plxPlugin->getParam('use_title')!='' ? $plxPlugin->getParam('use_title') : 1;
$parms['use_thumb'] = $plxPlugin->getParam('use_thumb')!='' ? $plxPlugin->getParam('use_thumb') : 1;
$parms['use_backend'] = $plxPlugin->getParam('use_backend')!='' ? $plxPlugin->getParam('use_backend') : 1;
$parms['backend'] = $plxPlugin->getParam('backend')!='' ? $plxPlugin->getParam('backend') : $plxBackend;
$parms['cache_ttl'] = $plxPlugin->getParam('cache_ttl')!='' ? $plxPlugin->getParam('cache_ttl') : $ttl;
$parms['client_timeout'] = $plxPlugin->getParam('client_timeout')!='' ? $plxPlugin->getParam('client_timeout') : 30;
$parms['cache_sys'] = $plxPlugin->getParam('cache_sys')!='' ? $plxPlugin->getParam('cache_sys') : 1;
$parms['domains'] = $plxPlugin->getParam('domains')!='' ? $plxPlugin->getParam('domains') : '';
$parms['cc'] = $plxPlugin->getParam('cc')!='' ? $plxPlugin->getParam('cc') : 0;
$parms['cacheClass'] = $plxPlugin->getParam('cacheClass')!='' ? $plxPlugin->getParam('cacheClass') : '';
$parms['fcbk_app_id'] = $plxPlugin->getParam('fcbk_app_id')!='' ? $plxPlugin->getParam('fcbk_app_id') : '';
$parms['fcbk_secret'] = $plxPlugin->getParam('fcbk_secret')!='' ? $plxPlugin->getParam('fcbk_secret') : '';
if (!defined('PLX_VERSION')) {#avant 5.5 display it ?>
 <h2><?php $plxPlugin->name() ?></h2>
<?php } ?>
<h4 class="in-action-bar">
 <?php $plxPlugin->lang('L_CONFIG') ?><br />
 <?php echo '<a title="'.L_HELP_TITLE.'" href="parametres_help.php?help=plugin&amp;page='.get_class($plxPlugin).'">'.L_HELP.'</a>'; ?>
</h4>
<form id="shariff" action="parametres_plugin.php?p=<?php echo get_class($plxPlugin) ?>" method="post">
<div id="tabContainer">
 <div class="tabs">
  <ul>
   <li id="tabHeader_Frontend">Frontend Js</li>
   <li id="tabHeader_Backend">Backend PHP</li>
  </ul>
 </div>
 <div class="tabscontent">
  <div class="tabpage clear" id="tabpage_Frontend"><noscript><h3>Frontend Js</h3></noscript>
   <fieldset class="config">
    <div class="grid">
     <div class="col sml-12 med-5 label-centered">
      <label for="id_style"><?php $plxPlugin->lang('L_CONFIG_STYLE') ?>&nbsp;:</label>
     </div>
     <div class="col sml-12 med-7">
      <?php plxUtils::printSelect('style',array('horizontal'=>$plxPlugin->getlang('L_HORIZONTAL'),'vertical'=>$plxPlugin->getlang('L_VERTICAL')),$parms['style']) ?>
     </div>
    </div>
    <div class="grid">
     <div class="col sml-12 med-5 label-centered">
      <label for="id_theme"><?php $plxPlugin->lang('L_CONFIG_THEME') ?>&nbsp;:</label>
     </div>
     <div class="col sml-12 med-7">
      <?php plxUtils::printSelect('theme',array('color'=>$plxPlugin->getlang('L_THEME_COLOR'),'grey'=>$plxPlugin->getlang('L_THEME_GREY'),'white'=>$plxPlugin->getlang('L_THEME_WHITE')),$parms['theme']) ?>
     </div>
    </div>
    <div class="grid">
     <div class="col sml-12 med-5 label-centered">
      <label for="id_mode"><?php $plxPlugin->lang('L_CONFIG_MODE') ?>&nbsp;:</label>
     </div>
     <div class="col sml-12 med-7">
      <?php plxUtils::printSelect('mode',array('min'=>$plxPlugin->getlang('L_CONFIG_MIN'),'complete'=>$plxPlugin->getlang('L_MODE_COMPLETE')),$parms['mode']) ?>
     </div>
    </div>
    <div class="grid">
     <div class="col sml-12 med-5 label-centered">
      <label for="id_js"><?php $plxPlugin->lang('L_CONFIG_JS') ?>&nbsp;:</label>
     </div>
     <div class="col sml-12 med-7">
      <?php plxUtils::printSelect('js',array('min'=>$plxPlugin->getlang('L_CONFIG_MIN'),'complete'=>$plxPlugin->getlang('L_JS_COMPLETE')),$parms['js']) ?>
     </div>
    </div>
    <div class="grid">
     <div class="col sml-12 med-5 label-centered">
      <label for="id_themePerso"><?php $plxPlugin->lang('L_CONFIG_THEME_P') ?>&nbsp;:</label>
     </div>
     <div class="col sml-12 med-7">
      <?php plxUtils::printInput('themePerso', $parms['themePerso'], 'text', '20-255', false, '', 'mycolor'); ?>
     </div>
    </div>
    <div class="grid">
     <div class="col sml-12 med-12 label-centered">
      <label for="id_services"><?php $plxPlugin->lang('L_CONFIG_SERVICES') ?>&nbsp;:</label>
     </div>
     <div class="col sml-12 med-12">
      <?php plxUtils::printInput('services', $parms['services'], 'text', '66-255', false, '', $all_services); ?>
     </div>
     <div class="col sml-12 med-12"><i><sup><?php echo $plxPlugin->getlang('L_EX').' : '.$all_services; ?></sup></i>
     </div>
    </div>
    <div class="grid">
     <div class="col sml-12 med-5 label-centered">
      <label for="id_infoUrl"><?php $plxPlugin->lang('L_CONFIG_INFOURL') ?>&nbsp;:</label>
     </div>
     <div class="col sml-12 med-7">
      <?php plxUtils::printInput('infoUrl', $parms['infoUrl'], 'text', '50-255', false, '', 'ex : faq.html'); ?>
     </div>
    </div>
    <div class="grid">
     <div class="col sml-12 med-5 label-centered">
      <label for="id_mailUrl"><?php $plxPlugin->lang('L_CONFIG_MAILURL') ?>&nbsp;:</label>
     </div>
     <div class="col sml-12 med-7">
      <?php plxUtils::printInput('mailUrl', $parms['mailUrl'], 'text', '50-255', false, '', 'ex : mailto: '); ?>
     </div>
    </div>
    <div class="grid">
     <div class="col sml-12 med-5 label-centered">
      <label for="id_via"><?php $plxPlugin->lang('L_CONFIG_VIA') ?>&nbsp;:</label>
     </div>
     <div class="col sml-12 med-7">
      <?php plxUtils::printInput('via', $parms['via'], 'text', '50-255', false, '', $plxPlugin->getLang('L_CONFIG_INFO_VIDE')); ?>
     </div>
    </div>
    <div class="grid">
     <div class="col sml-12 med-5 label-centered">
      <label for="id_flatUser"><?php $plxPlugin->lang('L_CONFIG_FLATTR_USER') ?>&nbsp;:</label>
     </div>
     <div class="col sml-12 med-7">
      <?php plxUtils::printInput('flatUser', $parms['flatUser'], 'text', '50-255', false, '', $plxPlugin->getLang('L_CONFIG_INFO_VIDE')); ?>
     </div>
    </div>
    <div class="grid">
     <div class="col sml-12 med-5 label-centered">
      <label for="id_flatCat"><?php $plxPlugin->lang('L_CONFIG_FLATTR_CAT') ?>&nbsp;:</label>
     </div>
     <div class="col sml-12 med-7">
<?php 
       $json = (array)@json_decode(file_get_contents('https://api.flattr.com/rest/v2/categories'));
       if (empty($json)){
        plxUtils::printInput('flatCat', $parms['flatCat'], 'text', '20-100', false, '', $plxPlugin->getLang('L_CONFIG_INFO_VIDE'));
       }else{
         $flattrCat[''] = $plxPlugin->getLang('L_CONFIG_AUCUNE'); 
        foreach($json as $fname)
         $flattrCat[$fname->id] = $fname->text; 
        plxUtils::printSelect('flatCat',$flattrCat,$parms['flatCat']);
       }
?>
     </div>
    </div>
    <div class="grid">
     <div class="col sml-12 med-5 label-centered">
      <label for="id_use_title"><?php $plxPlugin->lang('L_CONFIG_USE_TITLE') ?>&nbsp;:</label>
     </div>
     <div class="col sml-12 med-7">
      <?php plxUtils::printSelect('use_title',array('1'=>L_YES,'0'=>L_NO),$parms['use_title']) ?>
     </div>
    </div>
    <div class="grid">
     <div class="col sml-12 med-5 label-centered">
      <label for="id_use_thumb"><?php $plxPlugin->lang('L_CONFIG_USE_THUMB') ?>&nbsp;:</label>
     </div>
     <div class="col sml-12 med-7">
      <?php plxUtils::printSelect('use_thumb',array('1'=>L_YES,'0'=>L_NO),$parms['use_thumb']) ?>
     </div>
    </div>
   </fieldset>
  </div>
  <div class="tabpage clear" id="tabpage_Backend"><noscript><h3>Backend PHP</h3></noscript>
   <fieldset class="config">
    <div class="grid">
     <div class="col sml-12 med-5 label-centered">
      <label for="id_fcbk_app_id"><?php $plxPlugin->lang('L_CONFIG_USE_BACKEND') ?>&nbsp;:</label>
     </div>
     <div class="col sml-12 med-7">
      <?php plxUtils::printSelect('use_backend',array('1'=>L_YES,'0'=>L_NO),$parms['use_backend']) ?>
      <span>&nbsp;<a target="_blank" href="<?php echo $parms['backend'] ?>?url=<?php echo urlencode(rtrim($plxAdmin->racine,'/')) ?>">Backend Tester</a></span>
     </div>
    </div>
    <div class="grid">
     <div class="col sml-12 med-5 label-centered">
      <label for="id_fcbk_app_id"><?php $plxPlugin->lang('L_CONFIG_BACKEND') ?>&nbsp;:</label>
     </div>
     <div class="col sml-12 med-7">
      <?php plxUtils::printInput('backend', $parms['backend'], 'text', '50-255', false, '', $plxBackend); ?>
     </div>
    </div>
    <div class="grid">
     <div class="col sml-12 med-5 label-centered">
      <label for="id_cache_ttl"><?php $plxPlugin->lang('L_CONFIG_CACHE_TTL') ?>&nbsp;:</label>
     </div>
     <div class="col sml-12 med-7">
      <?php plxUtils::printInput('cache_ttl', $parms['cache_ttl'], 'text', '5-20', false, '', $ttl); ?>
     </div>
    </div>
    <div class="grid">
     <div class="col sml-12 med-5 label-centered">
      <label for="id_client_timeout"><?php $plxPlugin->lang('L_CONFIG_CLIENT_TIMEOUT') ?>&nbsp;:</label>
     </div>
     <div class="col sml-12 med-7">
      <?php plxUtils::printInput('client_timeout', $parms['client_timeout'], 'text', '5-20', false, '', '0'); ?>
     </div>
    </div>
    <div class="grid">
     <div class="col sml-12 med-5 label-centered">
      <label for="id_cache_sys"><?php $plxPlugin->lang('L_CONFIG_CACHE_SYS') ?>&nbsp;:</label>
     </div>
     <div class="col sml-12 med-7">
      <?php plxUtils::printSelect('cache_sys',array('1'=>L_YES,'0'=>L_NO),$parms['cache_sys']) ?>
     </div>
    </div>
    <div class="grid">
     <div class="col sml-12 med-5 label-centered">
      <label for="id_domains"><?php $plxPlugin->lang('L_CONFIG_DOMAINS') ?>&nbsp;:</label>
     </div>
     <div class="col sml-12 med-7">
      <?php plxUtils::printInput('domains', $parms['domains'], 'text', '50-255', false, '', 'ex : '.$_SERVER['HTTP_HOST']); ?>
     </div>
    </div>
    <div class="grid">
     <div class="col sml-12 med-5 label-centered">
      <label for="id_cc"><?php $plxPlugin->lang('L_CONFIG_CC') ?>&nbsp;:</label>
     </div>
     <div class="col sml-12 med-7">
      <?php plxUtils::printSelect('cc',array('1'=>L_YES,'0'=>L_NO),$parms['cc']) ?>
     </div>
    </div>
    <div class="grid">
     <div class="col sml-12 med-5 label-centered">
      <label for="id_cacheClass"><?php $plxPlugin->lang('L_CONFIG_CACHE_CLASS') ?>&nbsp;:</label>
     </div>
     <div class="col sml-12 med-7">
      <?php plxUtils::printInput('cacheClass', $parms['cacheClass'], 'text', '50-255', false, '', 'ex : Heise\\\\Shariff\\\\ZendCache'); ?>
     </div>
    </div>
    <div class="grid">
     <div class="col sml-12 med-5 label-centered">
      <label for="id_fcbk_app_id"><?php $plxPlugin->lang('L_CONFIG_FCBK_APP_ID') ?>&nbsp;:</label>
     </div>
     <div class="col sml-12 med-7">
      <?php plxUtils::printInput('fcbk_app_id', $parms['fcbk_app_id'], 'text', '20-50', false, '', 'app_id'); ?>
     </div>
    </div>
    <div class="grid">
     <div class="col sml-12 med-5 label-centered">
      <label for="id_fcbk_secret"><?php $plxPlugin->lang('L_CONFIG_FCBK_SECRET') ?>&nbsp;:</label>
     </div>
     <div class="col sml-12 med-7">
      <?php plxUtils::printInput('fcbk_secret', $parms['fcbk_secret'], 'text', '20-50', false, '', 'secret'); ?>
     </div>
    </div>
   </fieldset>
  </div>
 </div>
</div>
 <?php echo plxToken::getTokenPostMethod() ?>
 <p class="in-action-bar">
  <input type="submit" name="submit" value="<?php echo $plxPlugin->getLang('L_CONFIG_SAVE') ?>" />
 </p>
</form>
<script type="text/javascript" src="<?php echo PLX_PLUGINS.get_class($plxPlugin)."/tabs/tabs.js" ?>"></script>
<?php include(dirname(__FILE__).'/lang/fr-info.php'); ?>