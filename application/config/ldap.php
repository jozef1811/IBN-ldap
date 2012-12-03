<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['host'] 		= 'ldap.ibn.sk';
$config['port'] 		= 389;
$config['base_dn'] 		= 'O=Ibn,DC=Main'; 
$config['login_attribute'] 	= 'uid';
$config['member_attribute'] 	= 'memberUid';
$config['user_dn'] 		= 'OU=People,O=Ibn,DC=Main';
$config['group_dn'] 		= 'OU=Groups,O=Ibn,DC=Main';
$config['admin_username'] 	= 'cn=admin,dc=Main';
$config['admin_password'] 	= 'b0z3nk4Ld4p';

?>
