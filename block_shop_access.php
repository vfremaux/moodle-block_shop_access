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
 * @package     block_shop_access
 * @category    blocks
 * @author      Valery Fremaux <valery.fremaux@gmail.com>
 * @copyright   Valery Fremaux <valery.fremaux@gmail.com> (MyLearningFactory.com)
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die;

require_once($CFG->dirroot.'/local/shop/xlib.php');

class block_shop_access extends block_base {

    public function init() {
        $this->title = get_string('blocktitle', 'block_shop_access');
    }

    public function has_config() {
        return false;
    }

    public function specialization() {
        global $PAGE;
        $PAGE->set_context(context_system::instance());

        $this->title = isset($this->config->title) ? format_string($this->config->title) : $this->title;
    }

    public function instance_allow_config() {
        return true;
    }

    public function instance_allow_multiple() {
        return true;
    }

    public function applicable_formats() {
        // Default case: the block can be used in all course types.
        return array('all' => true);
    }

    public function get_content() {
        global $OUTPUT;

        $this->content = new StdClass();
        $this->content->text = '';

        $context = context_block::instance($this->instance->id);

        if (!local_shop_has_shops()) {
            $this->content->text = $OUTPUT->notification(get_string('errornoshops', 'block_shop_access'), 'error');
        } else {

            if (empty($this->config->shopinstance)) {
                $this->content->text = $OUTPUT->notification(get_string('errorshopnotassigned', 'block_shop_access'), 'error');
            }

            if (!empty($this->config->shopinstance)) {
                $this->content->text .= '<div class="shop">';
                $params = array('view' => 'shop', 'shopid' => $this->config->shopinstance, 'blockid' => $this->instance->id);
                $shopurl = new moodle_url('/local/shop/front/view.php', $params);
                $this->content->text .= '<a href="'.$shopurl.'">'.get_string('shop', 'block_shop_access').'</a>';
                $this->content->text .= '</div>';
            }
        }

        if (has_capability('local/shop:salesadmin', $context)) {
            if (!empty($this->config->shopinstance)) {
                $params = array('shopid' => $this->config->shopinstance, 'blockid' => $this->instance->id);
                $adminurl = new moodle_url('/local/shop/index.php', $params);
                $label = get_string('salesadmin', 'block_shop_access');
                $this->content->footer = '<a class="smalltext" href="'.$adminurl.'">'.$label.'</a>';
            }
        }

        return $this->content;
    }

    public static function get_instances_list() {
        global $DB;

        if (!$availableshops = $DB->get_records('block_instances', array('blockname' => 'shop'))) {
            return array();
        }

        $shops = array();
        foreach ($availableshops as $blockshop) {
            $config = unserialize(base64_decode($blockshop->configdata));
            $shops[$blockshop->id] = $blockshop->id.' - '.@$config->title;
        }

        return $shops;
    }
}