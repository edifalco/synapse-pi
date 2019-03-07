<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ProjectPartnerTest extends DuskTestCase
{

    public function testCreateProjectPartner()
    {
        $admin = \App\User::find(1);
        $project_partner = factory('App\ProjectPartner')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $project_partner) {
            $browser->loginAs($admin)
                ->visit(route('admin.project_partners.index'))
                ->clickLink('Add new')
                ->select("project_id", $project_partner->project_id)
                ->select("partner_id", $project_partner->partner_id)
                ->press('Save')
                ->assertRouteIs('admin.project_partners.index')
                ->assertSeeIn("tr:last-child td[field-key='project']", $project_partner->project->name)
                ->assertSeeIn("tr:last-child td[field-key='partner']", $project_partner->partner->name)
                ->logout();
        });
    }

    public function testEditProjectPartner()
    {
        $admin = \App\User::find(1);
        $project_partner = factory('App\ProjectPartner')->create();
        $project_partner2 = factory('App\ProjectPartner')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $project_partner, $project_partner2) {
            $browser->loginAs($admin)
                ->visit(route('admin.project_partners.index'))
                ->click('tr[data-entry-id="' . $project_partner->id . '"] .btn-info')
                ->select("project_id", $project_partner2->project_id)
                ->select("partner_id", $project_partner2->partner_id)
                ->press('Update')
                ->assertRouteIs('admin.project_partners.index')
                ->assertSeeIn("tr:last-child td[field-key='project']", $project_partner2->project->name)
                ->assertSeeIn("tr:last-child td[field-key='partner']", $project_partner2->partner->name)
                ->logout();
        });
    }

    public function testShowProjectPartner()
    {
        $admin = \App\User::find(1);
        $project_partner = factory('App\ProjectPartner')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $project_partner) {
            $browser->loginAs($admin)
                ->visit(route('admin.project_partners.index'))
                ->click('tr[data-entry-id="' . $project_partner->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='project']", $project_partner->project->name)
                ->assertSeeIn("td[field-key='partner']", $project_partner->partner->name)
                ->logout();
        });
    }

}
