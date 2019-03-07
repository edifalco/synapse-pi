<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class BudgetTest extends DuskTestCase
{

    public function testCreateBudget()
    {
        $admin = \App\User::find(1);
        $budget = factory('App\Budget')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $budget) {
            $browser->loginAs($admin)
                ->visit(route('admin.budgets.index'))
                ->clickLink('Add new')
                ->select("partner_id", $budget->partner_id)
                ->type("value", $budget->value)
                ->type("period", $budget->period)
                ->select("project_id", $budget->project_id)
                ->press('Save')
                ->assertRouteIs('admin.budgets.index')
                ->assertSeeIn("tr:last-child td[field-key='partner']", $budget->partner->name)
                ->assertSeeIn("tr:last-child td[field-key='value']", $budget->value)
                ->assertSeeIn("tr:last-child td[field-key='period']", $budget->period)
                ->assertSeeIn("tr:last-child td[field-key='project']", $budget->project->name)
                ->logout();
        });
    }

    public function testEditBudget()
    {
        $admin = \App\User::find(1);
        $budget = factory('App\Budget')->create();
        $budget2 = factory('App\Budget')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $budget, $budget2) {
            $browser->loginAs($admin)
                ->visit(route('admin.budgets.index'))
                ->click('tr[data-entry-id="' . $budget->id . '"] .btn-info')
                ->select("partner_id", $budget2->partner_id)
                ->type("value", $budget2->value)
                ->type("period", $budget2->period)
                ->select("project_id", $budget2->project_id)
                ->press('Update')
                ->assertRouteIs('admin.budgets.index')
                ->assertSeeIn("tr:last-child td[field-key='partner']", $budget2->partner->name)
                ->assertSeeIn("tr:last-child td[field-key='value']", $budget2->value)
                ->assertSeeIn("tr:last-child td[field-key='period']", $budget2->period)
                ->assertSeeIn("tr:last-child td[field-key='project']", $budget2->project->name)
                ->logout();
        });
    }

    public function testShowBudget()
    {
        $admin = \App\User::find(1);
        $budget = factory('App\Budget')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $budget) {
            $browser->loginAs($admin)
                ->visit(route('admin.budgets.index'))
                ->click('tr[data-entry-id="' . $budget->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='partner']", $budget->partner->name)
                ->assertSeeIn("td[field-key='value']", $budget->value)
                ->assertSeeIn("td[field-key='period']", $budget->period)
                ->assertSeeIn("td[field-key='project']", $budget->project->name)
                ->logout();
        });
    }

}
