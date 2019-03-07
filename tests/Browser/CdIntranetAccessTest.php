<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class CdIntranetAccessTest extends DuskTestCase
{

    public function testCreateCdIntranetAccess()
    {
        $admin = \App\User::find(1);
        $cd_intranet_access = factory('App\CdIntranetAccess')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $cd_intranet_access) {
            $browser->loginAs($admin)
                ->visit(route('admin.cd_intranet_accesses.index'))
                ->clickLink('Add new')
                ->type("month", $cd_intranet_access->month)
                ->type("value", $cd_intranet_access->value)
                ->select("project_id", $cd_intranet_access->project_id)
                ->press('Save')
                ->assertRouteIs('admin.cd_intranet_accesses.index')
                ->assertSeeIn("tr:last-child td[field-key='month']", $cd_intranet_access->month)
                ->assertSeeIn("tr:last-child td[field-key='value']", $cd_intranet_access->value)
                ->assertSeeIn("tr:last-child td[field-key='project']", $cd_intranet_access->project->name)
                ->logout();
        });
    }

    public function testEditCdIntranetAccess()
    {
        $admin = \App\User::find(1);
        $cd_intranet_access = factory('App\CdIntranetAccess')->create();
        $cd_intranet_access2 = factory('App\CdIntranetAccess')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $cd_intranet_access, $cd_intranet_access2) {
            $browser->loginAs($admin)
                ->visit(route('admin.cd_intranet_accesses.index'))
                ->click('tr[data-entry-id="' . $cd_intranet_access->id . '"] .btn-info')
                ->type("month", $cd_intranet_access2->month)
                ->type("value", $cd_intranet_access2->value)
                ->select("project_id", $cd_intranet_access2->project_id)
                ->press('Update')
                ->assertRouteIs('admin.cd_intranet_accesses.index')
                ->assertSeeIn("tr:last-child td[field-key='month']", $cd_intranet_access2->month)
                ->assertSeeIn("tr:last-child td[field-key='value']", $cd_intranet_access2->value)
                ->assertSeeIn("tr:last-child td[field-key='project']", $cd_intranet_access2->project->name)
                ->logout();
        });
    }

    public function testShowCdIntranetAccess()
    {
        $admin = \App\User::find(1);
        $cd_intranet_access = factory('App\CdIntranetAccess')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $cd_intranet_access) {
            $browser->loginAs($admin)
                ->visit(route('admin.cd_intranet_accesses.index'))
                ->click('tr[data-entry-id="' . $cd_intranet_access->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='month']", $cd_intranet_access->month)
                ->assertSeeIn("td[field-key='value']", $cd_intranet_access->value)
                ->assertSeeIn("td[field-key='project']", $cd_intranet_access->project->name)
                ->logout();
        });
    }

}
