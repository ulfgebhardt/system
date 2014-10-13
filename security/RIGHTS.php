<?php
namespace SYSTEM\SECURITY;

class RIGHTS {
    //Never use anything with 0 in php
    const SYS_DONOTUSE                  = 0;
    //System Administrator Interface
    const SYS_SAI                       = 1;
    //Security Module
    const SYS_SAI_SECURITY              = 5; //access
    const SYS_SAI_SECURITY_RIGHTS_EDIT  = 6; //edit rights
    //Database Text Module
    const SYS_SAI_LOCALE                = 10;
    //Image Module
    const SYS_SAI_FILES                 = 15;
    //Api Module
    const SYS_SAI_API                   = 20;
    const SYS_SAI_API_EDIT              = 21;
    
    const SYS_SAI_CRON                  = 25;
    
    //Reserve first 1000 ids.
    const RESERVED_SYS_0_999 = 999;
}