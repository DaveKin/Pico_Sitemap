<?php

/**
* Pico XML Sitemap - Automatically generate a valid xml sitemap!
*
* This simple plugin will generate an XML sitemap of your Pico pages.
* To access the sitemap, point your browser to http://example.com/?sitemap.xml
*
* Instructions
* - Place the `PicoXMLSitemap.php` into your `plugins` directory.
* - Place `$config['PicoXMLSitemap.enabled'] = true;` in your `config/config.php`
* - Browse to `http://yoursite.com/?sitemap.xml` or
*   `http://yoursite.com/sitemap.xml` if you have mod_rewrite enabled.
* - Take a break, your work is done!
*
* @author Dave Kinsella
* @link https://github.com/Techn0tic/Pico_Sitemap
* @license http://opensource.org/licenses/MIT
* @version 1.0
*/
class PicoXMLSitemap extends AbstractPicoPlugin
{
    /**
    * Is Sitemap
    *
    * @var boolean is user requesting the sitemap?
    */
    private $is_sitemap = false;

    /**
    * Triggered after Pico has evaluated the request URL
    *
    * @see    Pico::getRequestUrl()
    * @param  string &$url part of the URL describing the requested contents
    * @return void
    */
    public function onRequestUrl(&$url)
    {
        // Are we requesting the sitemep?
        if($url == 'sitemap.xml') {
            //We are looking for the sitemap!
            $this->is_sitemap = true;
        }
    }

    /**
    * Triggered after Pico has read all known pages
    *
    * See {@link DummyPlugin::onSinglePageLoaded()} for details about the
    * structure of the page data.
    *
    * @see    Pico::getPages()
    * @see    Pico::getCurrentPage()
    * @see    Pico::getPreviousPage()
    * @see    Pico::getNextPage()
    * @param  array &$pages        data of all known pages
    * @param  array &$currentPage  data of the page being served
    * @param  array &$previousPage data of the previous page
    * @param  array &$nextPage     data of the next page
    * @return void
    */
    public function onPagesLoaded(&$pages, &$currentPage, &$previousPage, &$nextPage)
    {
        //Generate XML Sitemap
        if($this->is_sitemap){
            //Sitemap found, 200 OK
            header($_SERVER['SERVER_PROTOCOL'].' 200 OK');
            //Set content-type to application/xml
            header('Content-Type: application/xml; charset=UTF-8');
            //XML Start
            $xml = '<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
            //Page loop
            foreach( $pages as $page ){
                //Page URL
                $xml .= '<url><loc>'.$page['url'].'</loc>';
                //Page date/last modified
                if(!empty($page['date'])){
                    $xml .= '<lastmod>'.date('c', $page['time']).'</lastmod>';
                }
                $xml .= '</url>';
            }
            //XML End
            $xml .= '</urlset>';
            //Set content-type to text/xml
            header('Content-Type: text/xml');
            //Show generated sitemap
            die($xml);
        }
    }

}
