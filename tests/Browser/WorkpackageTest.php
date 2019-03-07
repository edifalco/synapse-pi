<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class WorkpackageTest extends DuskTestCase
{

    public function testCreateWorkpackage()
    {
        $admin = \App\User::find(1);
        $workpackage = factory('App\Workpackage')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $workpackage) {
            $browser->loginAs($admin)
                ->visit(route('admin.workpackages.index'))
                ->clickLink('Add new')
                ->type("wp_id", $workpackage->wp_id)
                ->type("name", $workpackage->name)
                ->select("project_id", $workpackage->project_id)
                ->type("order", $workpackage->order)
                ->press('Save')
                ->assertRouteIs('admin.workpackages.index')
                ->assertSeeIn("tr:last-child td[field-key='wp_id']", $workpackage->wp_id)
                ->assertSeeIn("tr:last-child td[field-key='name']", $workpackage->name)
                ->assertSeeIn("tr:last-child td[field-key='project']", $workpackage->project->name)
                ->assertSeeIn("tr:last-child td[field-key='order']", $workpackage->order)
                ->logout();
        });
    }

    public function testEditWorkpackage()
    {
        $admin = \App\User::find(1);
        $workpackage = factory('App\Workpackage')->create();
        $workpackage2 = factory('App\Workpackage')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $workpackage, $workpackage2) {
            $browser->loginAs($admin)
                ->visit(route('admin.workpackages.index'))
                ->click('tr[data-entry-id="' . $workpackage->id . '"] .btn-info')
                ->type("wp_id", $workpackage2->wp_id)
                ->type("name", $workpackage2->name)
                ->select("project_id", $workpackage2->project_id)
                ->type("order", $workpackage2->order)
                ->press('Update')
                ->assertRouteIs('admin.workpackages.index')
                ->assertSeeIn("tr:last-child td[field-key='wp_id']", $workpackage2->wp_id)
                ->assertSeeIn("tr:last-child td[field-key='name']", $workpackage2->name)
                ->assertSeeIn("tr:last-child td[field-key='project']", $workpackage2->project->name)
                ->assertSeeIn("tr:last-child td[field-key='order']", $workpackage2->order)
                ->logout();
        });
    }

    public function testShowWorkpackage()
    {
        $admin = \App\User::find(1);
        $workpackage = factory('App\Workpackage')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $workpackage) {
            $browser->loginAs($admin)
                ->visit(route('admin.workpackages.index'))
                ->click('tr[data-entry-id="' . $workpackage->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='wp_id']", $workpackage->wp_id)
                ->assertSeeIn("td[field-key='name']", $workpackage->name)
                ->assertSeeIn("td[field-key='project']", $workpackage->project->name)
                ->assertSeeIn("td[field-key='order']", $workpackage->order)
                ->logout();
        });
    }

}
