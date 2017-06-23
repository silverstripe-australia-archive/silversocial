<?php

/**
 * A dataobject that explicitly uses the restrictable extension.
 *
 * Legacy to support those items that used to inherit this but now can
 * use the extension directly
 * 
 * @author marcus@symbiote.com.au
 * @license BSD License http://silverstripe.org/bsd-license/
 */
class RestrictedObject extends DataObject {
	public static $extensions = array(
		'Restrictable',
	);
}
