<?php

namespace jjpmann\EE;

/**
 * @category    Modules
 *
 * @author      Jerry Price
 *
 * @link        https://github.com/jjpmann
 */

require_once('config.php');

class criticalcss {

    protected $bail;
    protected $base;

    public function __construct()
    {
        $this->bail = ee()->config->item('critical_css') === 'off';
        $this->base = ee()->config->item('critical_css_base') ?: '/assets/css/critical/';
    }

    public function run()
    {

        if ($this->bail) {
            return;
        }
        
        $name = ee()->TMPL->fetch_param('name');

        $file = $this->base . $name .'.css';
        if (ENV !== 'local') {
            $file = $this->base . $name .'.min.css';
        }

        if (file_exists($file)) {
            $css = file_get_contents($file);
            return "<!-- {$name} --><style media='screen'>{$css}</style>";
        }

        if (DEBUG) {
            return "<!-- criticalcss: {$file} -->";
        }
        return;
    }

}