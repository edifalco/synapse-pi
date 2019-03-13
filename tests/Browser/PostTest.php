<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class PostTest extends DuskTestCase
{

    public function testCreatePost()
    {
        $admin = \App\User::find(1);
        $post = factory('App\Post')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $post) {
            $browser->loginAs($admin)
                ->visit(route('admin.posts.index'))
                ->clickLink('Add new')
                ->type("created", $post->created)
                ->select("user_id", $post->user_id)
                ->type("description", $post->description)
                ->select("project_id", $post->project_id)
                ->press('Save')
                ->assertRouteIs('admin.posts.index')
                ->assertSeeIn("tr:last-child td[field-key='created']", $post->created)
                ->assertSeeIn("tr:last-child td[field-key='user']", $post->user->name)
                ->assertSeeIn("tr:last-child td[field-key='description']", $post->description)
                ->assertSeeIn("tr:last-child td[field-key='project']", $post->project->name)
                ->logout();
        });
    }

    public function testEditPost()
    {
        $admin = \App\User::find(1);
        $post = factory('App\Post')->create();
        $post2 = factory('App\Post')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $post, $post2) {
            $browser->loginAs($admin)
                ->visit(route('admin.posts.index'))
                ->click('tr[data-entry-id="' . $post->id . '"] .btn-info')
                ->type("created", $post2->created)
                ->select("user_id", $post2->user_id)
                ->type("description", $post2->description)
                ->select("project_id", $post2->project_id)
                ->press('Update')
                ->assertRouteIs('admin.posts.index')
                ->assertSeeIn("tr:last-child td[field-key='created']", $post2->created)
                ->assertSeeIn("tr:last-child td[field-key='user']", $post2->user->name)
                ->assertSeeIn("tr:last-child td[field-key='description']", $post2->description)
                ->assertSeeIn("tr:last-child td[field-key='project']", $post2->project->name)
                ->logout();
        });
    }

    public function testShowPost()
    {
        $admin = \App\User::find(1);
        $post = factory('App\Post')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $post) {
            $browser->loginAs($admin)
                ->visit(route('admin.posts.index'))
                ->click('tr[data-entry-id="' . $post->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='created']", $post->created)
                ->assertSeeIn("td[field-key='user']", $post->user->name)
                ->assertSeeIn("td[field-key='description']", $post->description)
                ->assertSeeIn("td[field-key='project']", $post->project->name)
                ->logout();
        });
    }

}
