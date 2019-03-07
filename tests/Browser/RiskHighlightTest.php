<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class RiskHighlightTest extends DuskTestCase
{

    public function testCreateRiskHighlight()
    {
        $admin = \App\User::find(1);
        $risk_highlight = factory('App\RiskHighlight')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $risk_highlight) {
            $browser->loginAs($admin)
                ->visit(route('admin.risk_highlights.index'))
                ->clickLink('Add new')
                ->select("risk_id", $risk_highlight->risk_id)
                ->select("project_id", $risk_highlight->project_id)
                ->press('Save')
                ->assertRouteIs('admin.risk_highlights.index')
                ->assertSeeIn("tr:last-child td[field-key='risk']", $risk_highlight->risk->code)
                ->assertSeeIn("tr:last-child td[field-key='project']", $risk_highlight->project->name)
                ->logout();
        });
    }

    public function testEditRiskHighlight()
    {
        $admin = \App\User::find(1);
        $risk_highlight = factory('App\RiskHighlight')->create();
        $risk_highlight2 = factory('App\RiskHighlight')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $risk_highlight, $risk_highlight2) {
            $browser->loginAs($admin)
                ->visit(route('admin.risk_highlights.index'))
                ->click('tr[data-entry-id="' . $risk_highlight->id . '"] .btn-info')
                ->select("risk_id", $risk_highlight2->risk_id)
                ->select("project_id", $risk_highlight2->project_id)
                ->press('Update')
                ->assertRouteIs('admin.risk_highlights.index')
                ->assertSeeIn("tr:last-child td[field-key='risk']", $risk_highlight2->risk->code)
                ->assertSeeIn("tr:last-child td[field-key='project']", $risk_highlight2->project->name)
                ->logout();
        });
    }

    public function testShowRiskHighlight()
    {
        $admin = \App\User::find(1);
        $risk_highlight = factory('App\RiskHighlight')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $risk_highlight) {
            $browser->loginAs($admin)
                ->visit(route('admin.risk_highlights.index'))
                ->click('tr[data-entry-id="' . $risk_highlight->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='risk']", $risk_highlight->risk->code)
                ->assertSeeIn("td[field-key='project']", $risk_highlight->project->name)
                ->logout();
        });
    }

}
