<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class CdScores2Test extends DuskTestCase
{

    public function testCreateCdScores2()
    {
        $admin = \App\User::find(1);
        $cd_scores2 = factory('App\CdScores2')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $cd_scores2) {
            $browser->loginAs($admin)
                ->visit(route('admin.cd_scores2s.index'))
                ->clickLink('Add new')
                ->type("month", $cd_scores2->month)
                ->type("value", $cd_scores2->value)
                ->select("project_id", $cd_scores2->project_id)
                ->press('Save')
                ->assertRouteIs('admin.cd_scores2s.index')
                ->assertSeeIn("tr:last-child td[field-key='month']", $cd_scores2->month)
                ->assertSeeIn("tr:last-child td[field-key='value']", $cd_scores2->value)
                ->assertSeeIn("tr:last-child td[field-key='project']", $cd_scores2->project->name)
                ->logout();
        });
    }

    public function testEditCdScores2()
    {
        $admin = \App\User::find(1);
        $cd_scores2 = factory('App\CdScores2')->create();
        $cd_scores22 = factory('App\CdScores2')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $cd_scores2, $cd_scores22) {
            $browser->loginAs($admin)
                ->visit(route('admin.cd_scores2s.index'))
                ->click('tr[data-entry-id="' . $cd_scores2->id . '"] .btn-info')
                ->type("month", $cd_scores22->month)
                ->type("value", $cd_scores22->value)
                ->select("project_id", $cd_scores22->project_id)
                ->press('Update')
                ->assertRouteIs('admin.cd_scores2s.index')
                ->assertSeeIn("tr:last-child td[field-key='month']", $cd_scores22->month)
                ->assertSeeIn("tr:last-child td[field-key='value']", $cd_scores22->value)
                ->assertSeeIn("tr:last-child td[field-key='project']", $cd_scores22->project->name)
                ->logout();
        });
    }

    public function testShowCdScores2()
    {
        $admin = \App\User::find(1);
        $cd_scores2 = factory('App\CdScores2')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $cd_scores2) {
            $browser->loginAs($admin)
                ->visit(route('admin.cd_scores2s.index'))
                ->click('tr[data-entry-id="' . $cd_scores2->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='month']", $cd_scores2->month)
                ->assertSeeIn("td[field-key='value']", $cd_scores2->value)
                ->assertSeeIn("td[field-key='project']", $cd_scores2->project->name)
                ->logout();
        });
    }

}
