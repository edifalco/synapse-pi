<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class RiskTest extends DuskTestCase
{

    public function testCreateRisk()
    {
        $admin = \App\User::find(1);
        $risk = factory('App\Risk')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $risk) {
            $browser->loginAs($admin)
                ->visit(route('admin.risks.index'))
                ->clickLink('Add new')
                ->type("code", $risk->code)
                ->type("version", $risk->version)
                ->type("parent_id", $risk->parent_id)
                ->type("description", $risk->description)
                ->type("score", $risk->score)
                ->type("flag", $risk->flag)
                ->select("project_id", $risk->project_id)
                ->type("impact", $risk->impact)
                ->type("probability", $risk->probability)
                ->type("proximity", $risk->proximity)
                ->type("title", $risk->title)
                ->type("contingency", $risk->contingency)
                ->type("mitigation", $risk->mitigation)
                ->type("triggerevents", $risk->triggerevents)
                ->type("resolved", $risk->resolved)
                ->type("risk_date", $risk->risk_date)
                ->type("version_date", $risk->version_date)
                ->type("type", $risk->type)
                ->type("notes", $risk->notes)
                ->press('Save')
                ->assertRouteIs('admin.risks.index')
                ->assertSeeIn("tr:last-child td[field-key='code']", $risk->code)
                ->assertSeeIn("tr:last-child td[field-key='version']", $risk->version)
                ->assertSeeIn("tr:last-child td[field-key='parent_id']", $risk->parent_id)
                ->assertSeeIn("tr:last-child td[field-key='description']", $risk->description)
                ->assertSeeIn("tr:last-child td[field-key='score']", $risk->score)
                ->assertSeeIn("tr:last-child td[field-key='flag']", $risk->flag)
                ->assertSeeIn("tr:last-child td[field-key='project']", $risk->project->name)
                ->assertSeeIn("tr:last-child td[field-key='impact']", $risk->impact)
                ->assertSeeIn("tr:last-child td[field-key='probability']", $risk->probability)
                ->assertSeeIn("tr:last-child td[field-key='proximity']", $risk->proximity)
                ->assertSeeIn("tr:last-child td[field-key='title']", $risk->title)
                ->assertSeeIn("tr:last-child td[field-key='contingency']", $risk->contingency)
                ->assertSeeIn("tr:last-child td[field-key='mitigation']", $risk->mitigation)
                ->assertSeeIn("tr:last-child td[field-key='triggerevents']", $risk->triggerevents)
                ->assertSeeIn("tr:last-child td[field-key='resolved']", $risk->resolved)
                ->assertSeeIn("tr:last-child td[field-key='risk_date']", $risk->risk_date)
                ->assertSeeIn("tr:last-child td[field-key='version_date']", $risk->version_date)
                ->assertSeeIn("tr:last-child td[field-key='type']", $risk->type)
                ->assertSeeIn("tr:last-child td[field-key='notes']", $risk->notes)
                ->logout();
        });
    }

    public function testEditRisk()
    {
        $admin = \App\User::find(1);
        $risk = factory('App\Risk')->create();
        $risk2 = factory('App\Risk')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $risk, $risk2) {
            $browser->loginAs($admin)
                ->visit(route('admin.risks.index'))
                ->click('tr[data-entry-id="' . $risk->id . '"] .btn-info')
                ->type("code", $risk2->code)
                ->type("version", $risk2->version)
                ->type("parent_id", $risk2->parent_id)
                ->type("description", $risk2->description)
                ->type("score", $risk2->score)
                ->type("flag", $risk2->flag)
                ->select("project_id", $risk2->project_id)
                ->type("impact", $risk2->impact)
                ->type("probability", $risk2->probability)
                ->type("proximity", $risk2->proximity)
                ->type("title", $risk2->title)
                ->type("contingency", $risk2->contingency)
                ->type("mitigation", $risk2->mitigation)
                ->type("triggerevents", $risk2->triggerevents)
                ->type("resolved", $risk2->resolved)
                ->type("risk_date", $risk2->risk_date)
                ->type("version_date", $risk2->version_date)
                ->type("type", $risk2->type)
                ->type("notes", $risk2->notes)
                ->press('Update')
                ->assertRouteIs('admin.risks.index')
                ->assertSeeIn("tr:last-child td[field-key='code']", $risk2->code)
                ->assertSeeIn("tr:last-child td[field-key='version']", $risk2->version)
                ->assertSeeIn("tr:last-child td[field-key='parent_id']", $risk2->parent_id)
                ->assertSeeIn("tr:last-child td[field-key='description']", $risk2->description)
                ->assertSeeIn("tr:last-child td[field-key='score']", $risk2->score)
                ->assertSeeIn("tr:last-child td[field-key='flag']", $risk2->flag)
                ->assertSeeIn("tr:last-child td[field-key='project']", $risk2->project->name)
                ->assertSeeIn("tr:last-child td[field-key='impact']", $risk2->impact)
                ->assertSeeIn("tr:last-child td[field-key='probability']", $risk2->probability)
                ->assertSeeIn("tr:last-child td[field-key='proximity']", $risk2->proximity)
                ->assertSeeIn("tr:last-child td[field-key='title']", $risk2->title)
                ->assertSeeIn("tr:last-child td[field-key='contingency']", $risk2->contingency)
                ->assertSeeIn("tr:last-child td[field-key='mitigation']", $risk2->mitigation)
                ->assertSeeIn("tr:last-child td[field-key='triggerevents']", $risk2->triggerevents)
                ->assertSeeIn("tr:last-child td[field-key='resolved']", $risk2->resolved)
                ->assertSeeIn("tr:last-child td[field-key='risk_date']", $risk2->risk_date)
                ->assertSeeIn("tr:last-child td[field-key='version_date']", $risk2->version_date)
                ->assertSeeIn("tr:last-child td[field-key='type']", $risk2->type)
                ->assertSeeIn("tr:last-child td[field-key='notes']", $risk2->notes)
                ->logout();
        });
    }

    public function testShowRisk()
    {
        $admin = \App\User::find(1);
        $risk = factory('App\Risk')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $risk) {
            $browser->loginAs($admin)
                ->visit(route('admin.risks.index'))
                ->click('tr[data-entry-id="' . $risk->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='code']", $risk->code)
                ->assertSeeIn("td[field-key='version']", $risk->version)
                ->assertSeeIn("td[field-key='parent_id']", $risk->parent_id)
                ->assertSeeIn("td[field-key='description']", $risk->description)
                ->assertSeeIn("td[field-key='score']", $risk->score)
                ->assertSeeIn("td[field-key='flag']", $risk->flag)
                ->assertSeeIn("td[field-key='project']", $risk->project->name)
                ->assertSeeIn("td[field-key='impact']", $risk->impact)
                ->assertSeeIn("td[field-key='probability']", $risk->probability)
                ->assertSeeIn("td[field-key='proximity']", $risk->proximity)
                ->assertSeeIn("td[field-key='title']", $risk->title)
                ->assertSeeIn("td[field-key='contingency']", $risk->contingency)
                ->assertSeeIn("td[field-key='mitigation']", $risk->mitigation)
                ->assertSeeIn("td[field-key='triggerevents']", $risk->triggerevents)
                ->assertSeeIn("td[field-key='resolved']", $risk->resolved)
                ->assertSeeIn("td[field-key='risk_date']", $risk->risk_date)
                ->assertSeeIn("td[field-key='version_date']", $risk->version_date)
                ->assertSeeIn("td[field-key='type']", $risk->type)
                ->assertSeeIn("td[field-key='notes']", $risk->notes)
                ->logout();
        });
    }

}
