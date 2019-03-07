<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class CdDisseminationTest extends DuskTestCase
{

    public function testCreateCdDissemination()
    {
        $admin = \App\User::find(1);
        $cd_dissemination = factory('App\CdDissemination')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $cd_dissemination) {
            $browser->loginAs($admin)
                ->visit(route('admin.cd_disseminations.index'))
                ->clickLink('Add new')
                ->type("month", $cd_dissemination->month)
                ->type("value", $cd_dissemination->value)
                ->select("project_id", $cd_dissemination->project_id)
                ->press('Save')
                ->assertRouteIs('admin.cd_disseminations.index')
                ->assertSeeIn("tr:last-child td[field-key='month']", $cd_dissemination->month)
                ->assertSeeIn("tr:last-child td[field-key='value']", $cd_dissemination->value)
                ->assertSeeIn("tr:last-child td[field-key='project']", $cd_dissemination->project->name)
                ->logout();
        });
    }

    public function testEditCdDissemination()
    {
        $admin = \App\User::find(1);
        $cd_dissemination = factory('App\CdDissemination')->create();
        $cd_dissemination2 = factory('App\CdDissemination')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $cd_dissemination, $cd_dissemination2) {
            $browser->loginAs($admin)
                ->visit(route('admin.cd_disseminations.index'))
                ->click('tr[data-entry-id="' . $cd_dissemination->id . '"] .btn-info')
                ->type("month", $cd_dissemination2->month)
                ->type("value", $cd_dissemination2->value)
                ->select("project_id", $cd_dissemination2->project_id)
                ->press('Update')
                ->assertRouteIs('admin.cd_disseminations.index')
                ->assertSeeIn("tr:last-child td[field-key='month']", $cd_dissemination2->month)
                ->assertSeeIn("tr:last-child td[field-key='value']", $cd_dissemination2->value)
                ->assertSeeIn("tr:last-child td[field-key='project']", $cd_dissemination2->project->name)
                ->logout();
        });
    }

    public function testShowCdDissemination()
    {
        $admin = \App\User::find(1);
        $cd_dissemination = factory('App\CdDissemination')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $cd_dissemination) {
            $browser->loginAs($admin)
                ->visit(route('admin.cd_disseminations.index'))
                ->click('tr[data-entry-id="' . $cd_dissemination->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='month']", $cd_dissemination->month)
                ->assertSeeIn("td[field-key='value']", $cd_dissemination->value)
                ->assertSeeIn("td[field-key='project']", $cd_dissemination->project->name)
                ->logout();
        });
    }

}
