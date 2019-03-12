<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ProjectTest extends DuskTestCase
{

    public function testCreateProject()
    {
        $admin = \App\User::find(1);
        $project = factory('App\Project')->make();

        $relations = [
            factory('App\Partner')->create(), 
            factory('App\Partner')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $project, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.projects.index'))
                ->clickLink('Add new')
                ->type("name", $project->name)
                ->type("description", $project->description)
                ->type("date", $project->date)
                ->type("duration", $project->duration)
                ->type("image", $project->image)
                ->select('select[name="partners[]"]', $relations[0]->id)
                ->select('select[name="partners[]"]', $relations[1]->id)
                ->press('Save')
                ->assertRouteIs('admin.projects.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $project->name)
                ->assertSeeIn("tr:last-child td[field-key='description']", $project->description)
                ->assertSeeIn("tr:last-child td[field-key='date']", $project->date)
                ->assertSeeIn("tr:last-child td[field-key='duration']", $project->duration)
                ->assertSeeIn("tr:last-child td[field-key='image']", $project->image)
                ->assertSeeIn("tr:last-child td[field-key='partners'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='partners'] span:last-child", $relations[1]->name)
                ->logout();
        });
    }

    public function testEditProject()
    {
        $admin = \App\User::find(1);
        $project = factory('App\Project')->create();
        $project2 = factory('App\Project')->make();

        $relations = [
            factory('App\Partner')->create(), 
            factory('App\Partner')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $project, $project2, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.projects.index'))
                ->click('tr[data-entry-id="' . $project->id . '"] .btn-info')
                ->type("name", $project2->name)
                ->type("description", $project2->description)
                ->type("date", $project2->date)
                ->type("duration", $project2->duration)
                ->type("image", $project2->image)
                ->select('select[name="partners[]"]', $relations[0]->id)
                ->select('select[name="partners[]"]', $relations[1]->id)
                ->press('Update')
                ->assertRouteIs('admin.projects.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $project2->name)
                ->assertSeeIn("tr:last-child td[field-key='description']", $project2->description)
                ->assertSeeIn("tr:last-child td[field-key='date']", $project2->date)
                ->assertSeeIn("tr:last-child td[field-key='duration']", $project2->duration)
                ->assertSeeIn("tr:last-child td[field-key='image']", $project2->image)
                ->assertSeeIn("tr:last-child td[field-key='partners'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='partners'] span:last-child", $relations[1]->name)
                ->logout();
        });
    }

    public function testShowProject()
    {
        $admin = \App\User::find(1);
        $project = factory('App\Project')->create();

        $relations = [
            factory('App\Partner')->create(), 
            factory('App\Partner')->create(), 
        ];

        $project->partners()->attach([$relations[0]->id, $relations[1]->id]);

        $this->browse(function (Browser $browser) use ($admin, $project, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.projects.index'))
                ->click('tr[data-entry-id="' . $project->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $project->name)
                ->assertSeeIn("td[field-key='description']", $project->description)
                ->assertSeeIn("td[field-key='date']", $project->date)
                ->assertSeeIn("td[field-key='duration']", $project->duration)
                ->assertSeeIn("td[field-key='image']", $project->image)
                ->assertSeeIn("tr:last-child td[field-key='partners'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='partners'] span:last-child", $relations[1]->name)
                ->logout();
        });
    }

}
