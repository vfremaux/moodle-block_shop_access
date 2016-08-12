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

defined('MOODLE_INTERNAL') || die();

/**
 * @package   local_shop_access
 * @category  blocks
 * @author    Valery Fremaux (valery.fremaux@gmail.com)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$capabilities = array(

    'block/shop_access:addinstance' => array(

        'captype' => 'write',
        'contextlevel' => CONTEXT_COURSE,
        'archetypes' => array(
            'manager' => CAP_ALLOW
        )
    ),

    'block/shop_access:myaddinstance' => array(

        'captype' => 'write',
        'contextlevel' => CONTEXT_SYSTEM,
        'archetypes' => array(
            'manager' => CAP_ALLOW
        )
    ),

    /**
     * people having this capability will be able to trigger immediate
     * product production, event if paiement reception has not been checked
     */
    'block/shop_access:usenoninstantpayments' => array (

        'captype' => 'write',
        'contextlevel' => CONTEXT_BLOCK,
        'archetypes' => array(
            'manager' => CAP_ALLOW,
            'user' => CAP_ALLOW
        )
    ),

    /**
    * people having this capability will be able to trigger immediate
    * product production, event if paiement reception has not been checked
    */
    'block/shop_access:paycheckoverride' => array (

        'captype' => 'write',
        'contextlevel' => CONTEXT_SYSTEM,
        'archetypes' => array(
            'manager' => CAP_ALLOW
        )
    ),

    /**
    * people having this capability will always be discounted whatever they
    * purchase. discount applies only for logged in accounts.
    * Capability should be applied at system level for more stable effect.
    * this may need a special role to be defined
    */
    'block/shop_access:discountagreed' => array (
        
        'captype' => 'write',
        'contextlevel' => CONTEXT_BLOCK,
        'archetypes' => array(
        )
    ),

    /**
    * people having this capability will always be discounted with rate 2 whatever they
    * purchase. discount applies only for logged in accounts.
    * Capability should be applied at system level for more stable effect.
    * this may need a special role to be defined
    */
    'block/shop_access:seconddiscountagreed' => array (
        
        'captype' => 'write',
        'contextlevel' => CONTEXT_BLOCK,
        'archetypes' => array(
        )
    ),

    /**
     * people having this capability will always be discounted with rate 3 whatever they
     * purchase. discount applies only for logged in accounts.
     * Capability should be applied at system level for more stable effect.
     * this may need a special role to be defined
     */
    'block/shop_access:thirddiscountagreed' => array (
        
        'captype' => 'write',
        'contextlevel' => CONTEXT_BLOCK,
        'archetypes' => array(
        )
    ),
);