<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Version details.
 *
 * @package     block_shop_access
 * @category    blocks
 * @author      Valery Fremaux <valery.fremaux@gmail.com>
 * @copyright   2016 onwards Valery Fremaux (http://www.mylearningfactory.com)
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$plugin->version   = 2016051500;        // The current plugin version (Date: YYYYMMDDXX).
$plugin->requires  = 2022041900;        // Requires this Moodle version.
$plugin->component = 'block_shop_access'; // Full name of the plugin (used for diagnostics).
$plugin->release = "4.0.0 (Build 2016022500)";
$plugin->maturity = MATURITY_STABLE;
$plugin->supported = [40, 40];
$plugin->dependencies = array('local_shop' => 2016022500, 'auth_ticket' => '2012060400');

// Non moodle attributes.
$plugin->codeincrement = '4.0.0000';