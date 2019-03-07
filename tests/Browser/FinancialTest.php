<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class FinancialTest extends DuskTestCase
{

    public function testCreateFinancial()
    {
        $admin = \App\User::find(1);
        $financial = factory('App\Financial')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $financial) {
            $browser->loginAs($admin)
                ->visit(route('admin.financials.index'))
                ->clickLink('Add new')
                ->type("document", $financial->document)
                ->select("project_id", $financial->project_id)
                ->type("title", $financial->title)
                ->press('Save')
                ->assertRouteIs('admin.financials.index')
                ->assertSeeIn("tr:last-child td[field-key='document']", $financial->document)
                ->assertSeeIn("tr:last-child td[field-key='project']", $financial->project->name)
                ->assertSeeIn("tr:last-child td[field-key='title']", $financial->title)
                ->logout();
        });
    }

    public function testEditFinancial()
    {
        $admin = \App\User::find(1);
        $financial = factory('App\Financial')->create();
        $financial2 = factory('App\Financial')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $financial, $financial2) {
            $browser->loginAs($admin)
                ->visit(route('admin.financials.index'))
                ->click('tr[data-entry-id="' . $financial->id . '"] .btn-info')
                ->type("document", $financial2->document)
                ->select("project_id", $financial2->project_id)
                ->type("title", $financial2->title)
                ->press('Update')
                ->assertRouteIs('admin.financials.index')
                ->assertSeeIn("tr:last-child td[field-key='document']", $financial2->document)
                ->assertSeeIn("tr:last-child td[field-key='project']", $financial2->project->name)
                ->assertSeeIn("tr:last-child td[field-key='title']", $financial2->title)
                ->logout();
        });
    }

    public function testShowFinancial()
    {
        $admin = \App\User::find(1);
        $financial = factory('App\Financial')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $financial) {
            $browser->loginAs($admin)
                ->visit(route('admin.financials.index'))
                ->click('tr[data-entry-id="' . $financial->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='document']", $financial->document)
                ->assertSeeIn("td[field-key='project']", $financial->project->name)
                ->assertSeeIn("td[field-key='title']", $financial->title)
                ->logout();
        });
    }

}
