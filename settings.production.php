<?php

$db_url = 'mysql://%%DB_USER%%:%%DB_PW%%@%%DB_HOST%%/%%DB_DB%%';
$db_prefix = '';

$update_free_access = FALSE;

ini_set('arg_separator.output',     '&amp;');
ini_set('magic_quotes_runtime',     0);
ini_set('magic_quotes_sybase',      0);
ini_set('session.cache_expire',     200000);
ini_set('session.cache_limiter',    'none');
ini_set('session.cookie_lifetime',  2000000);
ini_set('session.gc_maxlifetime',   200000);
ini_set('session.save_handler',     'user');
ini_set('session.use_cookies',      1);
ini_set('session.use_only_cookies', 1);
ini_set('session.use_trans_sid',    0);
ini_set('url_rewriter.tags',        '');

$conf = array(
    'environment' => 'production',
);

/**
 * Cacherouter config
 */
$conf['cache_inc'] = realpath(dirname(__FILE__)) .  '/../all/modules/cacherouter/cacherouter.inc';
$conf['cacherouter'] = array(
  'default' => array(
    'engine'     => 'apc',
    'static'     => FALSE,
    'fast_cache' => TRUE,
    'prefix'     => '%%DB_DB%%',
  ),
);
