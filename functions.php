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

### Some useful functions for images
# Average
function get_average($scores)
{
    $count = 0;
    $total = 0;

    foreach($scores as $key => $value)
    {
        $count += $key * $value;
        $total += $value;
    }

    $result = round(($count / $total), 2);
    return $result;
}

# Color according to the number of ratings foreach
function get_color($score, $score_max, $im)
{
    # =/
    global $color_80, $color_60, $color_40, $color_20, $color_0;

    $percent = ceil((($score) / ($score_max)) * 100);

    if($percent >= 80) return $color_80;
    elseif($percent >= 60) return $color_60;
    elseif($percent >= 40) return $color_40;
    elseif($percent >= 20) return $color_20;
    else return	$color_0;
}

# To get the text on the right in 
function right_text($text, $size, $im)
{
    $dimensions = imagettfbbox($size, 0, FONT, $text);
    $textWidth = abs($dimensions[4] - $dimensions[0]);
    $align_right_x = imagesx($im) - $textWidth;
    $rectif_x = 10;

    return $align_right_x - $rectif_x;
}
/** EOF /**/