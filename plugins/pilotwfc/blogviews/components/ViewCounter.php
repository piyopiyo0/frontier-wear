<?php namespace PilotWfc\BlogViews\Components;

use Cms\Classes\ComponentBase;
use Tailor\Models\EntryRecord;

class ViewCounter extends ComponentBase
{
    public $post;

    public function componentDetails()
    {
        return [
            'name' => 'View Counter',
            'description' => 'Counts views for blog posts'
        ];
    }

    public function defineProperties()
    {
        return [
            'slug' => [
                'title'       => 'Post Slug',
                'description' => 'Slug of the blog post',
                'type'        => 'string',
                'default'     => '{{ :slug }}',
            ],
        ];
    }

    public function onRun()
    {
        $slug = $this->property('slug');
        $this->post = EntryRecord::inSection('Blog\Post')->where('slug', $slug)->first();

        if ($this->post) {
            $this->incrementViews($this->post);
        }
    }

    protected function incrementViews($post)
    {
        $post->views = ($post->views ?? 0) + 1;
        $post->save();
    }
}
