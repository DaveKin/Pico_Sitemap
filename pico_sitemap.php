<?php

/**
 * Generate an xml sitemap for Pico
 *
 * @author Dave Kinsella
 * @link https://github.com/Techn0tic/Pico_Sitemap
 * @license http://opensource.org/licenses/MIT
 */
class Pico_Sitemap {

	
	public function request_url(&$url)
	{
		if($url == 'sitemap.xml') $this->generate_sitemap();
	}
	
	private function generate_sitemap()
	{
		$baseurl = str_replace('sitemap.xml','',$_SERVER['SCRIPT_URI']);
		$xml = '<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
		$files = $this->get_files( CONTENT_DIR, CONTENT_EXT );
		$needles = array( CONTENT_DIR, CONTENT_EXT, '/index' );
		foreach( $files as $file ){
			$url = str_replace( $needles, '', $file );
   			if( $url != '404' ) $xml .= '<url><loc>'.$baseurl.$url.'</loc></url>';
		}
		$xml .= '</urlset>';
		header('Content-Type: text/xml');
		die($xml);
	}

	private function get_files($directory, $ext = '')
	{
	    $array_items = array();
	    if($handle = opendir($directory)){
	        while(false !== ($file = readdir($handle))){
	            if($file != "." && $file != ".."){
	                if(is_dir($directory. "/" . $file)){
	                    $array_items = array_merge($array_items, $this->get_files($directory. "/" . $file, $ext));
	                } else {
	                    $file = $directory . "/" . $file;
	                    if(!$ext || strstr($file, $ext)) $array_items[] = preg_replace("/\/\//si", "/", $file);
	                }
	            }
	        }
	        closedir($handle);
	    }
	    return $array_items;
	}
}

?>