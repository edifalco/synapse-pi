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
                ->select("idUser_id", $post->idUser_id)
                ->type("description", $post->description)
                ->select("idProject_id", $post->idProject_id)
                ->press('Save')
                ->assertRouteIs('admin.posts.index')
                ->assertSeeIn("tr:last-child td[field-key='created']", $post->created)
                ->assertSeeIn("tr:last-child td[field-key='idUser']", $post->idUser->name)
                ->assertSeeIn("tr:last-child td[field-key='description']", $post->description)
                ->assertSeeIn("tr:last-child td[field-key='idProject']", $post->idProject->name)
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
                ->select("idUser_id", $post2->idUser_id)
                ->type("description", $post2->description)
                ->select("idProject_id", $post2->idProject_id)
                ->press('Update')
                ->assertRouteIs('admin.posts.index')
                ->assertSeeIn("tr:last-child td[field-key='created']", $post2->created)
                ->assertSeeIn("tr:last-child td[field-key='idUser']", $post2->idUser->name)
                ->assertSeeIn("tr:last-child td[field-key='description']", $post2->description)
                ->assertSeeIn("tr:last-child td[field-key='idProject']", $post2->idProject->name)
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
                ->assertSeeIn("td[field-key='idUser']", $post->idUser->name)
                ->assertSeeIn("td[field-key='description']", $post->description)
                ->assertSeeIn("td[field-key='idProject']", $post->idProject->name)
                ->logout();
        });
    }

}
