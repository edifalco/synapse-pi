<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class PartnerroleTest extends DuskTestCase
{

    public function testCreatePartnerrole()
    {
        $admin = \App\User::find(1);
        $partnerrole = factory('App\Partnerrole')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $partnerrole) {
            $browser->loginAs($admin)
                ->visit(route('admin.partnerroles.index'))
                ->clickLink('Add new')
                ->select("partner_id", $partnerrole->partner_id)
                ->type("role_id", $partnerrole->role_id)
                ->select("project_id", $partnerrole->project_id)
                ->press('Save')
                ->assertRouteIs('admin.partnerroles.index')
                ->assertSeeIn("tr:last-child td[field-key='partner']", $partnerrole->partner->name)
                ->assertSeeIn("tr:last-child td[field-key='role_id']", $partnerrole->role_id)
                ->assertSeeIn("tr:last-child td[field-key='project']", $partnerrole->project->name)
                ->logout();
        });
    }

    public function testEditPartnerrole()
    {
        $admin = \App\User::find(1);
        $partnerrole = factory('App\Partnerrole')->create();
        $partnerrole2 = factory('App\Partnerrole')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $partnerrole, $partnerrole2) {
            $browser->loginAs($admin)
                ->visit(route('admin.partnerroles.index'))
                ->click('tr[data-entry-id="' . $partnerrole->id . '"] .btn-info')
                ->select("partner_id", $partnerrole2->partner_id)
                ->type("role_id", $partnerrole2->role_id)
                ->select("project_id", $partnerrole2->project_id)
                ->press('Update')
                ->assertRouteIs('admin.partnerroles.index')
                ->assertSeeIn("tr:last-child td[field-key='partner']", $partnerrole2->partner->name)
                ->assertSeeIn("tr:last-child td[field-key='role_id']", $partnerrole2->role_id)
                ->assertSeeIn("tr:last-child td[field-key='project']", $partnerrole2->project->name)
                ->logout();
        });
    }

    public function testShowPartnerrole()
    {
        $admin = \App\User::find(1);
        $partnerrole = factory('App\Partnerrole')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $partnerrole) {
            $browser->loginAs($admin)
                ->visit(route('admin.partnerroles.index'))
                ->click('tr[data-entry-id="' . $partnerrole->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='partner']", $partnerrole->partner->name)
                ->assertSeeIn("td[field-key='role_id']", $partnerrole->role_id)
                ->assertSeeIn("td[field-key='project']", $partnerrole->project->name)
                ->logout();
        });
    }

}
