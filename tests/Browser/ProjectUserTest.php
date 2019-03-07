<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ProjectUserTest extends DuskTestCase
{

    public function testCreateProjectUser()
    {
        $admin = \App\User::find(1);
        $project_user = factory('App\ProjectUser')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $project_user) {
            $browser->loginAs($admin)
                ->visit(route('admin.project_users.index'))
                ->clickLink('Add new')
                ->select("userID_id", $project_user->userID_id)
                ->select("projectID_id", $project_user->projectID_id)
                ->press('Save')
                ->assertRouteIs('admin.project_users.index')
                ->assertSeeIn("tr:last-child td[field-key='userID']", $project_user->userID->name)
                ->assertSeeIn("tr:last-child td[field-key='projectID']", $project_user->projectID->name)
                ->logout();
        });
    }

    public function testEditProjectUser()
    {
        $admin = \App\User::find(1);
        $project_user = factory('App\ProjectUser')->create();
        $project_user2 = factory('App\ProjectUser')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $project_user, $project_user2) {
            $browser->loginAs($admin)
                ->visit(route('admin.project_users.index'))
                ->click('tr[data-entry-id="' . $project_user->id . '"] .btn-info')
                ->select("userID_id", $project_user2->userID_id)
                ->select("projectID_id", $project_user2->projectID_id)
                ->press('Update')
                ->assertRouteIs('admin.project_users.index')
                ->assertSeeIn("tr:last-child td[field-key='userID']", $project_user2->userID->name)
                ->assertSeeIn("tr:last-child td[field-key='projectID']", $project_user2->projectID->name)
                ->logout();
        });
    }

    public function testShowProjectUser()
    {
        $admin = \App\User::find(1);
        $project_user = factory('App\ProjectUser')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $project_user) {
            $browser->loginAs($admin)
                ->visit(route('admin.project_users.index'))
                ->click('tr[data-entry-id="' . $project_user->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='userID']", $project_user->userID->name)
                ->assertSeeIn("td[field-key='projectID']", $project_user->projectID->name)
                ->logout();
        });
    }

}
