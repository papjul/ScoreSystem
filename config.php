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

# URL website (without final /)
define('URL_WEBSITE', 'http://localhost/ScoreSystem');

# Time before reloading stats (in hours)
define('CACHE_TIME_HOUR', 24);
define('CACHE_TIME', CACHE_TIME_HOUR * 3600);

# Number of seconds between each generation
define('TIME_NEXTGEN', 5);

# Whether we want URL rewriting
define('URL_REWRITING', true);

# Font used in graph
define('FONT', './fonts/SEGOESC.TTF');

# Miscellaneous
define('NOW', time());

# Websites list (not a constant because not a scalar value)
$siteList = array('listal' => array('name'       => 'Listal',
                                    'status'     => true,
                                    'type'       => 'Movies',
                                    'url_before' => 'http://',
                                    'url_after'  => '.listal.com/rss/all/movies/?limit=10000',
                                    'element'    => 'rating',
                                    'elementParent' => 'item',
                                    'oneMoreChild' => true,
                                    'error'      => 'DOCTYPE'),
                  'mal'    => array('name'       => 'MyAnimeList',
                                    'status'     => true,
                                    'type'       => 'Animelist',
                                    'url_before' => 'http://myanimelist.net/malappinfo.php?status=all&u=',
                                    'url_after'  => '',
                                    'element'    => 'my_score',
                                    'elementParent' => 'anime',
                                    'oneMoreChild' => false,
                                    'error'      => 'Invalid username'));
/** EOF /**/