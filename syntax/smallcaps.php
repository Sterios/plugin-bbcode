<?php
/**
 * @file       bbcode/syntax/smallcaps.php
 * @brief      Small-caps formatting support for BBCode Plugin
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     Luis Machuca Bezzaza <luis.machuca@gulix.cl>
 *
 * This file adds smallcaps (font-variant:small-caps) support to the 
 * BBCode plugin. It also adds preliminary support for the ODT Renderer.
 */
if(!defined('DOKU_INC')) define('DOKU_INC',realpath(dirname(__FILE__).'/../../').'/');
if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
require_once(DOKU_PLUGIN.'syntax.php');

/**
 * All DokuWiki plugins to extend the parser/rendering mechanism
 * need to inherit from this class
 */
class syntax_plugin_bbcode_smallcaps extends DokuWiki_Syntax_Plugin {

    function getType() { return 'formatting'; }
    function getAllowedTypes() { return array('formatting', 'substition', 'disabled'); }   
    function getSort() { return 105; }
    function connectTo($mode) { $this->Lexer->addEntryPattern('\[c\](?=.*?\x5B/c\x5D)',$mode,'plugin_bbcode_smallcaps'); }
    function postConnect() { $this->Lexer->addExitPattern('\[/c\]','plugin_bbcode_smallcaps'); }

    /**
     * Handle the match
     */
    function handle($match, $state, $pos, &$handler) {
        switch ($state) {
          case DOKU_LEXER_ENTER :
            $match = substr($match, 2,-2);
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
                // the class is not necessary, but it's there in case it's needed later
                $renderer->doc .= '<span class="bbcode_smallcaps" style="font-variant: small-caps;">';
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
        else if ($mode == 'odt') {
            static $style= false;
            if ($style === false) { 
                $renderer->autostyles["smallcaps"] = $this->ODT_autostyle('BBCode_smallcaps');
                $style= true;
            }
            switch ($state) {
              case DOKU_LEXER_ENTER :
                // styling via the created auto-style, pretty straightforward...
                $renderer->doc .= '<text:span text:style-name="BBCode_smallcaps">';
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
        // explicit support for text renderer is not needed
        return false;
    }

    
    /**
     * create an autostyle for small-caps with the name given.
     */
    private function ODT_autostyle ($aname) {
        static $autostyle= '
            <style:style style:name="$1" style:display-name="BBCode smallcaps" style:family="text">
                <style:text-properties fo:font-variant="small-caps"/>
            </style:style>';
        return str_replace('$1',$aname, $autostyle);
    }

}

