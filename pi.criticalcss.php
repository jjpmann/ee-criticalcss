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

    public function __construct()
    {
        $this->bail = ee()->config->item('critical_css') === 'off';
    }

    public function run()
    {

        echo "<pre>".__FILE__.'<br>'.__METHOD__.' : '.__LINE__."<br><br>"; var_dump( ee()->config->item('critical_css') ); exit;
        

        if ($this->bail) {
            return;
        }

        $base = $_SERVER['DOCUMENT_ROOT'] . '/assets/css/critical/';
        
        $name = ee()->TMPL->fetch_param('name');

        $file = $base . $name .'.css';
        if (ENV !== 'local') {
            $file = $base . $name .'.min.css';
        }

        if (file_exists($file)) {
            $css = file_get_contents($file);
            return "<!-- {$name} --><style media='screen'>{$css}</style>";
        }

        return;
    }

}