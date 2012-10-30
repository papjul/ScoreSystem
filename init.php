<?php
/** 
 * Score System
 * Copyright © 2011-2012 Julien Papasian
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

## Security functions. Most credits goes to Nuked-Klan
# To get rid of magic_quotes_gpc in PHP 5.3
@ini_set('magic_quotes_runtime', 0);

# Delete global vars
foreach ($GLOBALS as $k => $v)
    if(in_array($k, array('GLOBALS', '_POST', '_GET', '_COOKIE', '_FILES', '_SERVER', '_ENV', '_REQUEST', '_SESSION')) === false)
    {
        $GLOBALS[$k] = NULL;
        unset($GLOBALS[$k]);
    }

# Protecting from SQL (UNION) and XSS/CSS injections
$query_string = strtolower(rawurldecode($_SERVER['QUERY_STRING']));
$bad_string   = array('%20union%20', '/*', '*/union/*', '+union+', 'load_file', 'outfile', 'document.cookie', 'onmouse', '<script', '<iframe', '<applet', '<meta', '<style', '<form', '<img', '<body', '<link', '..', 'http://', '%3C%3F');
$size = count($bad_string);
for($i = 0; $i < $size; ++$i)
     if(strpos($query_string, $bad_string[$i])) exit('What were you expecting to do?');

unset($query_string, $bad_string, $string_value);

# Add security to a value
function SecureVar($value)
{
    if(is_array($value))
    {
        foreach($value as $k => $v)
            $value[$k] = SecureVar($value[$k]);

        return $value;
    }
    elseif(!get_magic_quotes_gpc())
        return str_replace(array('&', '<', '>', '0x'), array('&amp;', '&lt;', '&gt;', '\0x'), addslashes($value)) ;

    else
        return str_replace(array('&', '<', '>', '0x'), array('&amp;', '&lt;', '&gt;', '\0x'), $value);
}

$_GET  = array_map('SecureVar', $_GET);
$_POST = array_map('SecureVar', $_POST);
$_REQUEST = array_merge($_POST, $_GET);

# Make IE8 turn off content sniffing. Everbody else should ignore this
header('X-Content-Type-Options: nosniff');

session_start();

# Allow inclusions
define('SAFE', true);
/** EOF /**/ 