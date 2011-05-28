<?php
/**
 * @file       bbcode/syntax/color.php
 * @brief      Color formatting support for BBCode Plugin
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     Esther Brunner <esther@kaffeehaus.ch>
 * @author     Christopher Smith <chris@jalakai.co.uk>
 * @author     Luis Machuca Bezzaza <luis.machuca@gulix.cl>
 * @version    2011-05-25
 */
if(!defined('DOKU_INC')) define('DOKU_INC',realpath(dirname(__FILE__).'/../../').'/');
if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
require_once(DOKU_PLUGIN.'syntax.php');

/**
 * All DokuWiki plugins to extend the parser/rendering mechanism
 * need to inherit from this class
 */
class syntax_plugin_bbcode_color extends DokuWiki_Syntax_Plugin {

    static $htmlcolors = array (
        'red' => '#ff0000',
        'green' => '#008000',
        'blue' => '#0000ff',
        'aqua' => '#00ffff',
        'cyan' => '#00ffff',
        'fuchsia' => '#ff00ff',
        'lime' => '#00ff00',
        'magenta' => '#ff00ff',
        'maroon' => '#800000',
        'navy' => '#000080',
        'olive' => '#808000',
        'purple' => '#800080',
        'teal' => '#008080',
        'yellow' => '#ffff00',
        'black' => '#000000',
        'gray' => '#808080',
        'grey' => '#808080',
        'silver' => '#c0c0c0',
        'white' => '#ffffff',
        );
    static $browsercolors = array (
            'aliceblue' => '#f0f8ff' ,
            'antiquewhite' => '#faebd7' ,
            'aqua' => '#00ffff' ,
            'aquamarine' => '#7fffd4' ,
            'azure' => '#f0ffff' ,
            'beige' => '#f5f5dc' ,
            'bisque' => '#ffe4c4' ,
            'black' => '#000000' ,
            'blanchedalmond' => '#ffebcd' ,
            'blue' => '#0000ff' ,
            'blueviolet' => '#8a2be2' ,
            'brown' => '#a52a2a' ,
            'burlywood' => '#deb887' ,
            'cadetblue' => '#5f9ea0' ,
            'chartreuse' => '#7fff00' ,
            'chocolate' => '#d2691e' ,
            'coral' => '#ff7f50' ,
            'cornflowerblue' => '#6495ed' ,
            'cornsilk' => '#fff8dc' ,
            'crimson' => '#dc143c' ,
            'cyan' => '#00ffff' ,
            'darkblue' => '#00008b' ,
            'darkcyan' => '#008b8b' ,
            'darkgoldenrod' => '#b8860b' ,
            'darkgray' => '#a9a9a9' ,
            'darkgreen' => '#006400' ,
            'darkkhaki' => '#bdb76b' ,
            'darkmagenta' => '#8b008b' ,
            'darkolivegreen' => '#556b2f' ,
            'darkorange' => '#ff8c00' ,
            'darkorchid' => '#9932cc' ,
            'darkred' => '#8b0000' ,
            'darksalmon' => '#e9967a' ,
            'darkseagreen' => '#8fbc8f' ,
            'darkslateblue' => '#483d8b' ,
            'darkslategray' => '#2f4f4f' ,
            'darkturquoise' => '#00ced1' ,
            'darkviolet' => '#9400d3' ,
            'deeppink' => '#ff1493' ,
            'deepskyblue' => '#00bfff' ,
            'dimgray' => '#696969' ,
            'dodgerblue' => '#1e90ff' ,
            'firebrick' => '#b22222' ,
            'floralwhite' => '#fffaf0' ,
            'forestgreen' => '#228b22' ,
            'fuchsia' => '#ff00ff' ,
            'gainsboro' => '#dcdcdc' ,
            'ghostwhite' => '#f8f8ff' ,
            'gold' => '#ffd700' ,
            'goldenrod' => '#daa520' ,
            'gray' => '#808080' ,
            'green' => '#008000' ,
            'greenyellow' => '#adff2f' ,
            'honeydew' => '#f0fff0' ,
            'hotpink' => '#ff69b4' ,
            'indianred' => '#cd5c5c' ,
            'indigo' => '#4b0082' ,
            'ivory' => '#fffff0' ,
            'khaki' => '#f0e68c' ,
            'lavender' => '#e6e6fa' ,
            'lavenderblush' => '#fff0f5' ,
            'lawngreen' => '#7cfc00' ,
            'lemonchiffon' => '#fffacd' ,
            'lightblue' => '#add8e6' ,
            'lightcoral' => '#f08080' ,
            'lightcyan' => '#e0ffff' ,
            'lightgoldenrodyellow' => '#fafad2' ,
            'lightgrey' => '#d3d3d3' ,
            'lightgreen' => '#90ee90' ,
            'lightpink' => '#ffb6c1' ,
            'lightsalmon' => '#ffa07a' ,
            'lightseagreen' => '#20b2aa' ,
            'lightskyblue' => '#87cefa' ,
            'lightslategray' => '#778899' ,
            'lightsteelblue' => '#b0c4de' ,
            'lightyellow' => '#ffffe0' ,
            'lime' => '#00ff00' ,
            'limegreen' => '#32cd32' ,
            'linen' => '#faf0e6' ,
            'magenta' => '#ff00ff' ,
            'maroon' => '#800000' ,
            'mediumaquamarine' => '#66cdaa' ,
            'mediumblue' => '#0000cd' ,
            'mediumorchid' => '#ba55d3' ,
            'mediumpurple' => '#9370d8' ,
            'mediumseagreen' => '#3cb371' ,
            'mediumslateblue' => '#7b68ee' ,
            'mediumspringgreen' => '#00fa9a' ,
            'mediumturquoise' => '#48d1cc' ,
            'mediumvioletred' => '#c71585' ,
            'midnightblue' => '#191970' ,
            'mintcream' => '#f5fffa' ,
            'mistyrose' => '#ffe4e1' ,
            'moccasin' => '#ffe4b5' ,
            'navajowhite' => '#ffdead' ,
            'navy' => '#000080' ,
            'oldlace' => '#fdf5e6' ,
            'olive' => '#808000' ,
            'olivedrab' => '#6b8e23' ,
            'orange' => '#ffa500' ,
            'orangered' => '#ff4500' ,
            'orchid' => '#da70d6' ,
            'palegoldenrod' => '#eee8aa' ,
            'palegreen' => '#98fb98' ,
            'paleturquoise' => '#afeeee' ,
            'palevioletred' => '#d87093' ,
            'papayawhip' => '#ffefd5' ,
            'peachpuff' => '#ffdab9' ,
            'peru' => '#cd853f' ,
            'pink' => '#ffc0cb' ,
            'plum' => '#dda0dd' ,
            'powderblue' => '#b0e0e6' ,
            'purple' => '#800080' ,
            'red' => '#ff0000' ,
            'rosybrown' => '#bc8f8f' ,
            'royalblue' => '#4169e1' ,
            'saddlebrown' => '#8b4513' ,
            'salmon' => '#fa8072' ,
            'sandybrown' => '#f4a460' ,
            'seagreen' => '#2e8b57' ,
            'seashell' => '#fff5ee' ,
            'sienna' => '#a0522d' ,
            'silver' => '#c0c0c0' ,
            'skyblue' => '#87ceeb' ,
            'slateblue' => '#6a5acd' ,
            'slategray' => '#708090' ,
            'snow' => '#fffafa' ,
            'springgreen' => '#00ff7f' ,
            'steelblue' => '#4682b4' ,
            'tan' => '#d2b48c' ,
            'teal' => '#008080' ,
            'thistle' => '#d8bfd8' ,
            'tomato' => '#ff6347' ,
            'turquoise' => '#40e0d0' ,
            'violet' => '#ee82ee' ,
            'wheat' => '#f5deb3' ,
            'white' => '#ffffff' ,
            'whitesmoke' => '#f5f5f5' ,
            'yellow' => '#ffff00' ,
            'yellowgreen' => '#9acd32' ,
            );

    function getType() { return 'formatting'; }
    function getAllowedTypes() { return array('formatting', 'substition', 'disabled'); }   
    function getSort() { return 105; }
    function connectTo($mode) { $this->Lexer->addEntryPattern('\[color=.*?\](?=.*?\x5B/color\x5D)',$mode,'plugin_bbcode_color'); }
    function postConnect() { $this->Lexer->addExitPattern('\[/color\]','plugin_bbcode_color'); }

    /**
     * Handle the match
     */
    function handle($match, $state, $pos, &$handler) {
        switch ($state) {
          case DOKU_LEXER_ENTER :
            $match = substr($match, 7, -1);
            if (preg_match('/".+?"/',$match)) $match = substr($match, 1, -1); // addition #1: unquote
            return array($state, $match);
          case DOKU_LEXER_UNMATCHED :
            return array($state, $match);
          case DOKU_LEXER_EXIT :
            return array($state, '');
        }
        return array();
    }

    /**
     * Create output
     */
    function render($mode, &$renderer, $data) {
        list($state, $match) = $data;
        if($mode == 'xhtml') {
            switch ($state) {
              case DOKU_LEXER_ENTER :
                $mvalid= $this->_isValid($match);
                echo "<pre> { ${match} =&gt; ${mvalid} } </pre>";
                if ($mvalid) {
                    // the class isn't needed, but in case someone needs to do something with color...
                    $renderer->doc .= '<span class="bbcode_color" style="color:'. $match. '">';
                } else {
                    $renderer->doc .= '<span>';
                }
                break;
              case DOKU_LEXER_UNMATCHED :
                $renderer->doc .= $renderer->_xmlEntities($match);
                break;
              case DOKU_LEXER_EXIT :
                $renderer->doc .= '</span>';
                break;
            }
            return true;
        }
        else if($mode == 'odt') {
            switch ($state) {
              case DOKU_LEXER_ENTER :
                $mvalid= $this->_isValid($match);
                // non-#rrggbb tuples shall not pass!
                if ($mvalid[0]==='#') {
                    $mname= substr($mvalid,1);
                    // add the autostyle if it's not already available
                    $stylename= "bbcode_color_${mname}";
                    if (!array_key_exists($stylename, $renderer->autostyles)) {
                        $renderer->autostyles[$stylename]= '
            <style:style style:name="'.$stylename.'" style:display-name="BBCode Color '.$mvalid.'" style:family="text">
                <style:text-properties fo:color="'.$mvalid.'"/>
            </style:style>';
                    }
                    $renderer->doc .= '<text:span text:style-name="'.$stylename.'">';
                } else {
                    $renderer->doc .= '<text:span>';
                }
                break;
              case DOKU_LEXER_UNMATCHED :
                $renderer->doc .= $renderer->_xmlEntities($match);
                break;
              case DOKU_LEXER_EXIT :
                $renderer->doc .= '</text:span>';
                break;
            }
            return true;
        }
        return false;
    }


    /**
     * Validate color
     * 
     * This is a moderalety strong validation -- first it ensures that the 
     * format is correct and there is nothing harmful, then returns 
     * a convenient form of its argument.
     */
    function _isValid($c) {
        $c = trim($c);
        $pattern= "/^(\#[0-9a-fA-F]{6})$/x";
        if (preg_match($pattern,$c)) return $c;
        // stretch a #rgb tuple to the form #rrggbb
        $pattern= "/^(\#[0-9a-fA-F]{3})$/x";
        if (preg_match($pattern,$c)) {
            list($hash,$R,$G,$B) = str_split($c);
            return "#$R$R$G$G$B$B";
        }
        // return rgb() and hsl() formulas as-is
        // TODO: return rgba() and hsla() too?
        $pattern = "/^
            (rgb\(([0-9]{1,3}%?,){2}[0-9]{1,3}%?\))|      # rgb triplet
            (hsl\([0-9]+,(100|[0-9][0-9]?)%,(100|[0-9][0-9])%\))  #hsl triplet
            $/x";
        if (preg_match($pattern, $c)) return $c;
        // return lowercase HTML colornames as-is
        if (ctype_lower($c) && !empty(self::$htmlcolors[$c])) return self::$htmlcolors[$c]; 
        // demans CamelCase SVG colornames for easier distinction
        $d= strtolower($c);
        if (ctype_upper($c[0]) && !empty(self::$browsercolors[$d])) return self::$browsercolors[$d];
        // at this point we weren't handed over something usable
        return false;
    }
}
