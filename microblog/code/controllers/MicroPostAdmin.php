<?php

/**
 *
 * @author marcus@symbiote.com.au
 * @license BSD License http://silverstripe.org/bsd-license/
 */
class MicroPostAdmin extends ModelAdmin {
	public static $managed_models = array('MicroPost', 'PublicProfile');
	public static $url_segment = 'microposts';
	public static $menu_title = 'Posts';
}