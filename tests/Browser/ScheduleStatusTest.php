<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ScheduleStatusTest extends DuskTestCase
{

    public function testCreateScheduleStatus()
    {
        $admin = \App\User::find(1);
        $schedule_status = factory('App\ScheduleStatus')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $schedule_status) {
            $browser->loginAs($admin)
                ->visit(route('admin.schedule_statuses.index'))
                ->clickLink('Add new')
                ->type("name", $schedule_status->name)
                ->press('Save')
                ->assertRouteIs('admin.schedule_statuses.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $schedule_status->name)
                ->logout();
        });
    }

    public function testEditScheduleStatus()
    {
        $admin = \App\User::find(1);
        $schedule_status = factory('App\ScheduleStatus')->create();
        $schedule_status2 = factory('App\ScheduleStatus')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $schedule_status, $schedule_status2) {
            $browser->loginAs($admin)
                ->visit(route('admin.schedule_statuses.index'))
                ->click('tr[data-entry-id="' . $schedule_status->id . '"] .btn-info')
                ->type("name", $schedule_status2->name)
                ->press('Update')
                ->assertRouteIs('admin.schedule_statuses.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $schedule_status2->name)
                ->logout();
        });
    }

    public function testShowScheduleStatus()
    {
        $admin = \App\User::find(1);
        $schedule_status = factory('App\ScheduleStatus')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $schedule_status) {
            $browser->loginAs($admin)
                ->visit(route('admin.schedule_statuses.index'))
                ->click('tr[data-entry-id="' . $schedule_status->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $schedule_status->name)
                ->logout();
        });
    }

}
