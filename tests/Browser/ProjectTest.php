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

        

        $this->browse(function (Browser $browser) use ($admin, $project) {
            $browser->loginAs($admin)
                ->visit(route('admin.projects.index'))
                ->clickLink('Add new')
                ->type("name", $project->name)
                ->type("description", $project->description)
                ->type("date", $project->date)
                ->type("duration", $project->duration)
                ->type("image", $project->image)
                ->select("partners_id", $project->partners_id)
                ->press('Save')
                ->assertRouteIs('admin.projects.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $project->name)
                ->assertSeeIn("tr:last-child td[field-key='description']", $project->description)
                ->assertSeeIn("tr:last-child td[field-key='date']", $project->date)
                ->assertSeeIn("tr:last-child td[field-key='duration']", $project->duration)
                ->assertSeeIn("tr:last-child td[field-key='image']", $project->image)
                ->assertSeeIn("tr:last-child td[field-key='partners']", $project->partners->name)
                ->logout();
        });
    }

    public function testEditProject()
    {
        $admin = \App\User::find(1);
        $project = factory('App\Project')->create();
        $project2 = factory('App\Project')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $project, $project2) {
            $browser->loginAs($admin)
                ->visit(route('admin.projects.index'))
                ->click('tr[data-entry-id="' . $project->id . '"] .btn-info')
                ->type("name", $project2->name)
                ->type("description", $project2->description)
                ->type("date", $project2->date)
                ->type("duration", $project2->duration)
                ->type("image", $project2->image)
                ->select("partners_id", $project2->partners_id)
                ->press('Update')
                ->assertRouteIs('admin.projects.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $project2->name)
                ->assertSeeIn("tr:last-child td[field-key='description']", $project2->description)
                ->assertSeeIn("tr:last-child td[field-key='date']", $project2->date)
                ->assertSeeIn("tr:last-child td[field-key='duration']", $project2->duration)
                ->assertSeeIn("tr:last-child td[field-key='image']", $project2->image)
                ->assertSeeIn("tr:last-child td[field-key='partners']", $project2->partners->name)
                ->logout();
        });
    }

    public function testShowProject()
    {
        $admin = \App\User::find(1);
        $project = factory('App\Project')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $project) {
            $browser->loginAs($admin)
                ->visit(route('admin.projects.index'))
                ->click('tr[data-entry-id="' . $project->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $project->name)
                ->assertSeeIn("td[field-key='description']", $project->description)
                ->assertSeeIn("td[field-key='date']", $project->date)
                ->assertSeeIn("td[field-key='duration']", $project->duration)
                ->assertSeeIn("td[field-key='image']", $project->image)
                ->assertSeeIn("td[field-key='partners']", $project->partners->name)
                ->logout();
        });
    }

}
