<?php
SYSTEM\autoload::registerFolder(dirname(__FILE__),'SYSTEM\SAI');
require_once dirname(__FILE__).'/saistart_sys_sai/autoload.inc';

require_once dirname(__FILE__).'/saimod_sys_log/autoload.inc';
require_once dirname(__FILE__).'/saimod_sys_security/autoload.inc';
require_once dirname(__FILE__).'/saimod_sys_mod/autoload.inc';
require_once dirname(__FILE__).'/saimod_sys_config/autoload.inc';
require_once dirname(__FILE__).'/saimod_sys_api/autoload.inc';
require_once dirname(__FILE__).'/saimod_sys_locale/autoload.inc';
require_once dirname(__FILE__).'/saimod_sys_files/autoload.inc';
require_once dirname(__FILE__).'/saimod_sys_cache/autoload.inc';
require_once dirname(__FILE__).'/saimod_sys_cron/autoload.inc';
require_once dirname(__FILE__).'/saimod_sys_todo/autoload.inc';
require_once dirname(__FILE__).'/saimod_sys_docu/autoload.inc';
require_once dirname(__FILE__).'/saimod_sys_login/autoload.inc';