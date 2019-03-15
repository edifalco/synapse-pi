<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ScheduleHighlightTest extends DuskTestCase
{

    public function testCreateScheduleHighlight()
    {
        $admin = \App\User::find(1);
        $schedule_highlight = factory('App\ScheduleHighlight')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $schedule_highlight) {
            $browser->loginAs($admin)
                ->visit(route('admin.schedule_highlights.index'))
                ->clickLink('Add new')
                ->type("name", $schedule_highlight->name)
                ->press('Save')
                ->assertRouteIs('admin.schedule_highlights.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $schedule_highlight->name)
                ->logout();
        });
    }

    public function testEditScheduleHighlight()
    {
        $admin = \App\User::find(1);
        $schedule_highlight = factory('App\ScheduleHighlight')->create();
        $schedule_highlight2 = factory('App\ScheduleHighlight')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $schedule_highlight, $schedule_highlight2) {
            $browser->loginAs($admin)
                ->visit(route('admin.schedule_highlights.index'))
                ->click('tr[data-entry-id="' . $schedule_highlight->id . '"] .btn-info')
                ->type("name", $schedule_highlight2->name)
                ->press('Update')
                ->assertRouteIs('admin.schedule_highlights.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $schedule_highlight2->name)
                ->logout();
        });
    }

    public function testShowScheduleHighlight()
    {
        $admin = \App\User::find(1);
        $schedule_highlight = factory('App\ScheduleHighlight')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $schedule_highlight) {
            $browser->loginAs($admin)
                ->visit(route('admin.schedule_highlights.index'))
                ->click('tr[data-entry-id="' . $schedule_highlight->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $schedule_highlight->name)
                ->logout();
        });
    }

}
