<?php

$instance = erLhcoreClassSystem::instance();

if ($instance->SiteAccess == erConfigClassLhConfig::getInstance()->getSetting( 'site', 'default_site_access' )) {    
    header('Location: ' .erLhcoreClassDesign::baseurldirect('site_admin/user/login') );
    exit;
}

$tpl = new erLhcoreClassTemplate( 'lhuser/login.tpl.php');

if (isset($_POST['Login']))
{
    $currentUser = erLhcoreClassUser::instance();
    
    if (!$currentUser->authenticate($_POST['Username'],$_POST['Password']))
    {     
            $Error = erTranslationClassLhTranslation::getInstance()->getTranslation('user/login','Incorrect username or password');
            $tpl->set('errors',array($Error));   
    } else {    
        erLhcoreClassModule::redirect();
        return ;
    }    
}

$pagelayout = erConfigClassLhConfig::getInstance()->getOverrideValue('site','login_pagelayout');
if ($pagelayout != null)
$Result['pagelayout'] = 'login';

$Result['content'] = $tpl->fetch();