<?php

/**
 * @author marcus@symbiote.com.au
 * @license BSD License http://silverstripe.org/bsd-license/
 */
class RescanPostsTask extends BuildTask {
	public function run($request) {
		$id = (int) $request->getVar('id');
		
		if ($id) {
			$post = DataList::create('MicroPost')->byID($id);
			if ($post) {
				singleton('QueuedJobService')->queueJob(new ProcessPostJob($post));
			}
		} else if ($request->getVar('all')) {
			$posts = DataList::create('MicroPost');
			foreach ($posts as $post) {
				if ($post->Content != '[spam]') {
					singleton('QueuedJobService')->queueJob(new ProcessPostJob($post));
				}
			}
		}
	}
}
