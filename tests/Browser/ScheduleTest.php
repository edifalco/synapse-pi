<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ScheduleTest extends DuskTestCase
{

    public function testCreateSchedule()
    {
        $admin = \App\User::find(1);
        $schedule = factory('App\Schedule')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $schedule) {
            $browser->loginAs($admin)
                ->visit(route('admin.schedules.index'))
                ->clickLink('Add new')
                ->type("date", $schedule->date)
                ->type("description", $schedule->description)
                ->type("status", $schedule->status)
                ->select("project_id", $schedule->project_id)
                ->type("highlight", $schedule->highlight)
                ->press('Save')
                ->assertRouteIs('admin.schedules.index')
                ->assertSeeIn("tr:last-child td[field-key='date']", $schedule->date)
                ->assertSeeIn("tr:last-child td[field-key='description']", $schedule->description)
                ->assertSeeIn("tr:last-child td[field-key='status']", $schedule->status)
                ->assertSeeIn("tr:last-child td[field-key='project']", $schedule->project->name)
                ->assertSeeIn("tr:last-child td[field-key='highlight']", $schedule->highlight)
                ->logout();
        });
    }

    public function testEditSchedule()
    {
        $admin = \App\User::find(1);
        $schedule = factory('App\Schedule')->create();
        $schedule2 = factory('App\Schedule')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $schedule, $schedule2) {
            $browser->loginAs($admin)
                ->visit(route('admin.schedules.index'))
                ->click('tr[data-entry-id="' . $schedule->id . '"] .btn-info')
                ->type("date", $schedule2->date)
                ->type("description", $schedule2->description)
                ->type("status", $schedule2->status)
                ->select("project_id", $schedule2->project_id)
                ->type("highlight", $schedule2->highlight)
                ->press('Update')
                ->assertRouteIs('admin.schedules.index')
                ->assertSeeIn("tr:last-child td[field-key='date']", $schedule2->date)
                ->assertSeeIn("tr:last-child td[field-key='description']", $schedule2->description)
                ->assertSeeIn("tr:last-child td[field-key='status']", $schedule2->status)
                ->assertSeeIn("tr:last-child td[field-key='project']", $schedule2->project->name)
                ->assertSeeIn("tr:last-child td[field-key='highlight']", $schedule2->highlight)
                ->logout();
        });
    }

    public function testShowSchedule()
    {
        $admin = \App\User::find(1);
        $schedule = factory('App\Schedule')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $schedule) {
            $browser->loginAs($admin)
                ->visit(route('admin.schedules.index'))
                ->click('tr[data-entry-id="' . $schedule->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='date']", $schedule->date)
                ->assertSeeIn("td[field-key='description']", $schedule->description)
                ->assertSeeIn("td[field-key='status']", $schedule->status)
                ->assertSeeIn("td[field-key='project']", $schedule->project->name)
                ->assertSeeIn("td[field-key='highlight']", $schedule->highlight)
                ->logout();
        });
    }

}
