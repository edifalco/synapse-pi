<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class CdMeetingTest extends DuskTestCase
{

    public function testCreateCdMeeting()
    {
        $admin = \App\User::find(1);
        $cd_meeting = factory('App\CdMeeting')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $cd_meeting) {
            $browser->loginAs($admin)
                ->visit(route('admin.cd_meetings.index'))
                ->clickLink('Add new')
                ->type("month", $cd_meeting->month)
                ->type("value", $cd_meeting->value)
                ->select("project_id", $cd_meeting->project_id)
                ->press('Save')
                ->assertRouteIs('admin.cd_meetings.index')
                ->assertSeeIn("tr:last-child td[field-key='month']", $cd_meeting->month)
                ->assertSeeIn("tr:last-child td[field-key='value']", $cd_meeting->value)
                ->assertSeeIn("tr:last-child td[field-key='project']", $cd_meeting->project->name)
                ->logout();
        });
    }

    public function testEditCdMeeting()
    {
        $admin = \App\User::find(1);
        $cd_meeting = factory('App\CdMeeting')->create();
        $cd_meeting2 = factory('App\CdMeeting')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $cd_meeting, $cd_meeting2) {
            $browser->loginAs($admin)
                ->visit(route('admin.cd_meetings.index'))
                ->click('tr[data-entry-id="' . $cd_meeting->id . '"] .btn-info')
                ->type("month", $cd_meeting2->month)
                ->type("value", $cd_meeting2->value)
                ->select("project_id", $cd_meeting2->project_id)
                ->press('Update')
                ->assertRouteIs('admin.cd_meetings.index')
                ->assertSeeIn("tr:last-child td[field-key='month']", $cd_meeting2->month)
                ->assertSeeIn("tr:last-child td[field-key='value']", $cd_meeting2->value)
                ->assertSeeIn("tr:last-child td[field-key='project']", $cd_meeting2->project->name)
                ->logout();
        });
    }

    public function testShowCdMeeting()
    {
        $admin = \App\User::find(1);
        $cd_meeting = factory('App\CdMeeting')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $cd_meeting) {
            $browser->loginAs($admin)
                ->visit(route('admin.cd_meetings.index'))
                ->click('tr[data-entry-id="' . $cd_meeting->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='month']", $cd_meeting->month)
                ->assertSeeIn("td[field-key='value']", $cd_meeting->value)
                ->assertSeeIn("td[field-key='project']", $cd_meeting->project->name)
                ->logout();
        });
    }

}
