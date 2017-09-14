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

    public function __construct()
    {

    }

    public function run()
    {

        echo "<pre>".__FILE__.'<br>'.__METHOD__.' : '.__LINE__."<br><br>"; var_dump( ee()->config->item('critical_css') ); exit;
        

        if (ee()->config->item('critical_css') === 'off') {
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
            return "<!-- {$name} --><style media='screen'>.forPrint{display:none;}{$css}</style>";
        }

        return;
    }

}