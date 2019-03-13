<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ProjectPeriodTest extends DuskTestCase
{

    public function testCreateProjectPeriod()
    {
        $admin = \App\User::find(1);
        $project_period = factory('App\ProjectPeriod')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $project_period) {
            $browser->loginAs($admin)
                ->visit(route('admin.project_periods.index'))
                ->clickLink('Add new')
                ->type("date", $project_period->date)
                ->type("period_num", $project_period->period_num)
                ->select("project_id", $project_period->project_id)
                ->press('Save')
                ->assertRouteIs('admin.project_periods.index')
                ->assertSeeIn("tr:last-child td[field-key='date']", $project_period->date)
                ->assertSeeIn("tr:last-child td[field-key='period_num']", $project_period->period_num)
                ->assertSeeIn("tr:last-child td[field-key='project']", $project_period->project->name)
                ->logout();
        });
    }

    public function testEditProjectPeriod()
    {
        $admin = \App\User::find(1);
        $project_period = factory('App\ProjectPeriod')->create();
        $project_period2 = factory('App\ProjectPeriod')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $project_period, $project_period2) {
            $browser->loginAs($admin)
                ->visit(route('admin.project_periods.index'))
                ->click('tr[data-entry-id="' . $project_period->id . '"] .btn-info')
                ->type("date", $project_period2->date)
                ->type("period_num", $project_period2->period_num)
                ->select("project_id", $project_period2->project_id)
                ->press('Update')
                ->assertRouteIs('admin.project_periods.index')
                ->assertSeeIn("tr:last-child td[field-key='date']", $project_period2->date)
                ->assertSeeIn("tr:last-child td[field-key='period_num']", $project_period2->period_num)
                ->assertSeeIn("tr:last-child td[field-key='project']", $project_period2->project->name)
                ->logout();
        });
    }

    public function testShowProjectPeriod()
    {
        $admin = \App\User::find(1);
        $project_period = factory('App\ProjectPeriod')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $project_period) {
            $browser->loginAs($admin)
                ->visit(route('admin.project_periods.index'))
                ->click('tr[data-entry-id="' . $project_period->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='date']", $project_period->date)
                ->assertSeeIn("td[field-key='period_num']", $project_period->period_num)
                ->assertSeeIn("td[field-key='project']", $project_period->project->name)
                ->logout();
        });
    }

}
