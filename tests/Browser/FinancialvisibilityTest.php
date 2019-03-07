<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class FinancialvisibilityTest extends DuskTestCase
{

    public function testCreateFinancialvisibility()
    {
        $admin = \App\User::find(1);
        $financialvisibility = factory('App\Financialvisibility')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $financialvisibility) {
            $browser->loginAs($admin)
                ->visit(route('admin.financialvisibilities.index'))
                ->clickLink('Add new')
                ->type("type", $financialvisibility->type)
                ->type("status", $financialvisibility->status)
                ->select("id_project_id", $financialvisibility->id_project_id)
                ->press('Save')
                ->assertRouteIs('admin.financialvisibilities.index')
                ->assertSeeIn("tr:last-child td[field-key='type']", $financialvisibility->type)
                ->assertSeeIn("tr:last-child td[field-key='status']", $financialvisibility->status)
                ->assertSeeIn("tr:last-child td[field-key='id_project']", $financialvisibility->id_project->name)
                ->logout();
        });
    }

    public function testEditFinancialvisibility()
    {
        $admin = \App\User::find(1);
        $financialvisibility = factory('App\Financialvisibility')->create();
        $financialvisibility2 = factory('App\Financialvisibility')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $financialvisibility, $financialvisibility2) {
            $browser->loginAs($admin)
                ->visit(route('admin.financialvisibilities.index'))
                ->click('tr[data-entry-id="' . $financialvisibility->id . '"] .btn-info')
                ->type("type", $financialvisibility2->type)
                ->type("status", $financialvisibility2->status)
                ->select("id_project_id", $financialvisibility2->id_project_id)
                ->press('Update')
                ->assertRouteIs('admin.financialvisibilities.index')
                ->assertSeeIn("tr:last-child td[field-key='type']", $financialvisibility2->type)
                ->assertSeeIn("tr:last-child td[field-key='status']", $financialvisibility2->status)
                ->assertSeeIn("tr:last-child td[field-key='id_project']", $financialvisibility2->id_project->name)
                ->logout();
        });
    }

    public function testShowFinancialvisibility()
    {
        $admin = \App\User::find(1);
        $financialvisibility = factory('App\Financialvisibility')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $financialvisibility) {
            $browser->loginAs($admin)
                ->visit(route('admin.financialvisibilities.index'))
                ->click('tr[data-entry-id="' . $financialvisibility->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='type']", $financialvisibility->type)
                ->assertSeeIn("td[field-key='status']", $financialvisibility->status)
                ->assertSeeIn("td[field-key='id_project']", $financialvisibility->id_project->name)
                ->logout();
        });
    }

}
