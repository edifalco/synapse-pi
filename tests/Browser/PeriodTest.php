<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class PeriodTest extends DuskTestCase
{

    public function testCreatePeriod()
    {
        $admin = \App\User::find(1);
        $period = factory('App\Period')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $period) {
            $browser->loginAs($admin)
                ->visit(route('admin.periods.index'))
                ->clickLink('Add new')
                ->type("date", $period->date)
                ->type("period_num", $period->period_num)
                ->select("project_id", $period->project_id)
                ->press('Save')
                ->assertRouteIs('admin.periods.index')
                ->assertSeeIn("tr:last-child td[field-key='date']", $period->date)
                ->assertSeeIn("tr:last-child td[field-key='period_num']", $period->period_num)
                ->assertSeeIn("tr:last-child td[field-key='project']", $period->project->name)
                ->logout();
        });
    }

    public function testEditPeriod()
    {
        $admin = \App\User::find(1);
        $period = factory('App\Period')->create();
        $period2 = factory('App\Period')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $period, $period2) {
            $browser->loginAs($admin)
                ->visit(route('admin.periods.index'))
                ->click('tr[data-entry-id="' . $period->id . '"] .btn-info')
                ->type("date", $period2->date)
                ->type("period_num", $period2->period_num)
                ->select("project_id", $period2->project_id)
                ->press('Update')
                ->assertRouteIs('admin.periods.index')
                ->assertSeeIn("tr:last-child td[field-key='date']", $period2->date)
                ->assertSeeIn("tr:last-child td[field-key='period_num']", $period2->period_num)
                ->assertSeeIn("tr:last-child td[field-key='project']", $period2->project->name)
                ->logout();
        });
    }

    public function testShowPeriod()
    {
        $admin = \App\User::find(1);
        $period = factory('App\Period')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $period) {
            $browser->loginAs($admin)
                ->visit(route('admin.periods.index'))
                ->click('tr[data-entry-id="' . $period->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='date']", $period->date)
                ->assertSeeIn("td[field-key='period_num']", $period->period_num)
                ->assertSeeIn("td[field-key='project']", $period->project->name)
                ->logout();
        });
    }

}
