<?php

use Flarum\Foundation\Application;
use Illuminate\Contracts\Events\Dispatcher;
use Flarum\Event\ConfigureWebApp;
use Flarum\Event\ConfigureClientView;
use Flarum\Event\DiscussionWillBeSaved;
use Flarum\Event\DiscussionWasStarted;
use Flarum\Event\PostWasPosted;

return function (Dispatcher $events, Application $app) {

// Replies to Old Questions
$events->listen(PostWasPosted::class, function (PostWasPosted $event) {
       $post = $event -> post;
       $user = $post -> user;

		$title = $post->discussion->title;

		$cats = $post->discussion->tags;

		foreach ($cats as $category) {
			echo $category->slug;
		}
 });

// New Discussions
$events->listen(DiscussionWillBeSaved::class, function (DiscussionWillBeSaved $event) {
        $discussion = $event->discussion;

        $discussion->afterSave(function ($discussion) use ($mobileObj,$username) {

		        $discussion_id = $discussion->id;
		        $discussion_slug= $discussion->slug;
		        $discussion_title = $discussion->title;
		        $user_id = $discussion->start_user_id;
		        $post_id = $discussion->start_post_id;

		        if( $post_id ==0){

		        	$cats = $post->discussion->tags;

					foreach ($cats as $category) {
						echo $category->slug;
					}

		        }
         });
 });

};