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
                ->type("description", $schedule->description)
                ->type("date", $schedule->date)
                ->select("project_id", $schedule->project_id)
                ->select("status_id", $schedule->status_id)
                ->select("highlight_id", $schedule->highlight_id)
                ->press('Save')
                ->assertRouteIs('admin.schedules.index')
                ->assertSeeIn("tr:last-child td[field-key='description']", $schedule->description)
                ->assertSeeIn("tr:last-child td[field-key='date']", $schedule->date)
                ->assertSeeIn("tr:last-child td[field-key='project']", $schedule->project->name)
                ->assertSeeIn("tr:last-child td[field-key='status']", $schedule->status->name)
                ->assertSeeIn("tr:last-child td[field-key='highlight']", $schedule->highlight->name)
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
                ->type("description", $schedule2->description)
                ->type("date", $schedule2->date)
                ->select("project_id", $schedule2->project_id)
                ->select("status_id", $schedule2->status_id)
                ->select("highlight_id", $schedule2->highlight_id)
                ->press('Update')
                ->assertRouteIs('admin.schedules.index')
                ->assertSeeIn("tr:last-child td[field-key='description']", $schedule2->description)
                ->assertSeeIn("tr:last-child td[field-key='date']", $schedule2->date)
                ->assertSeeIn("tr:last-child td[field-key='project']", $schedule2->project->name)
                ->assertSeeIn("tr:last-child td[field-key='status']", $schedule2->status->name)
                ->assertSeeIn("tr:last-child td[field-key='highlight']", $schedule2->highlight->name)
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
                ->assertSeeIn("td[field-key='description']", $schedule->description)
                ->assertSeeIn("td[field-key='date']", $schedule->date)
                ->assertSeeIn("td[field-key='project']", $schedule->project->name)
                ->assertSeeIn("td[field-key='status']", $schedule->status->name)
                ->assertSeeIn("td[field-key='highlight']", $schedule->highlight->name)
                ->logout();
        });
    }

}
