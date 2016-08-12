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
 * @package     block_shop_access
 * @category    blocks
 * @author      Valery Fremaux <valery.fremaux@gmail.com>
 * @copyright   Valery Fremaux <valery.fremaux@gmail.com> (MyLearningFactory.com)
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * The form for editing block shop settings. 
 * Block shop gives direct access to the shop front and back office.
 */

require_once($CFG->dirroot.'/local/shop/paymodes/paymode.class.php');

class block_shop_access_edit_form extends block_edit_form {

    protected function specific_definition($mform) {
        global $DB;

        // Fields for editing HTML block title and contents.
        $mform->addElement('header', 'configheader', get_string('blocksettings', 'block'));

        $mform->addElement('text', 'config_title', get_string('configtitle', 'block_shop_access'));
        $mform->setType('config_title', PARAM_MULTILANG);

        if ($shops = $DB->get_records('local_shop')) {
            foreach ($shops as $shop) {
                $shopoptions[$shop->id] = format_string($shop->name);
            }
            $mform->addElement('select', 'config_shopinstance', get_string('configshopinstance', 'block_shop_access'), $shopoptions);
        } else {
            $context = context_block::instance($this->instance->id);
            $str = get_string('errornoshops', 'block_shop_access');
            if (has_capability('local/shop:salesadmin', $context)) {
                $gotoadminstr = get_string('gotoadminlink', 'block_shop_access');
                $backshopurl = new moodle_url('/local/shop/index.php');
                $str .= '<a href="'.$backshopurl.'">'.$gotoadminstr.'</a>';
                $mform->addElement('static', 'config_shopinstance', $str);
            }
        }
    }

    function set_data($defaults) {
        if (!$this->block->user_can_edit() && !empty($this->block->config->title)) {
            // If a title has been set but the user cannot edit it format it nicely.
            $title = $this->block->config->title;
            $defaults->config_title = format_string($title, true, $this->page->context);
            // Remove the title from the config so that parent::set_data doesn't set it.
            unset($this->block->config->title);
        }

        parent::set_data($defaults);
    }
}