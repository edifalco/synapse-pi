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
                ->select("project_id", $risk->project_id)
                ->type("code", $risk->code)
                ->type("version", $risk->version)
                ->check("flag")
                ->check("resolved")
                ->select("type_id", $risk->type_id)
                ->type("date", $risk->date)
                ->type("title", $risk->title)
                ->type("description", $risk->description)
                ->type("trigger_events", $risk->trigger_events)
                ->select("impact_id", $risk->impact_id)
                ->select("probability_id", $risk->probability_id)
                ->select("proximity_id", $risk->proximity_id)
                ->type("score", $risk->score)
                ->type("mitigation", $risk->mitigation)
                ->select("owner_id", $risk->owner_id)
                ->type("notes", $risk->notes)
                ->type("contingency", $risk->contingency)
                ->type("version_date", $risk->version_date)
                ->type("parent_id", $risk->parent_id)
                ->press('Save')
                ->assertRouteIs('admin.risks.index')
                ->assertSeeIn("tr:last-child td[field-key='project']", $risk->project->name)
                ->assertSeeIn("tr:last-child td[field-key='code']", $risk->code)
                ->assertSeeIn("tr:last-child td[field-key='version']", $risk->version)
                ->assertChecked("flag")
                ->assertChecked("resolved")
                ->assertSeeIn("tr:last-child td[field-key='type']", $risk->type->name)
                ->assertSeeIn("tr:last-child td[field-key='date']", $risk->date)
                ->assertSeeIn("tr:last-child td[field-key='title']", $risk->title)
                ->assertSeeIn("tr:last-child td[field-key='description']", $risk->description)
                ->assertSeeIn("tr:last-child td[field-key='trigger_events']", $risk->trigger_events)
                ->assertSeeIn("tr:last-child td[field-key='impact']", $risk->impact->name)
                ->assertSeeIn("tr:last-child td[field-key='probability']", $risk->probability->name)
                ->assertSeeIn("tr:last-child td[field-key='proximity']", $risk->proximity->name)
                ->assertSeeIn("tr:last-child td[field-key='score']", $risk->score)
                ->assertSeeIn("tr:last-child td[field-key='mitigation']", $risk->mitigation)
                ->assertSeeIn("tr:last-child td[field-key='owner']", $risk->owner->surname)
                ->assertSeeIn("tr:last-child td[field-key='notes']", $risk->notes)
                ->assertSeeIn("tr:last-child td[field-key='contingency']", $risk->contingency)
                ->assertSeeIn("tr:last-child td[field-key='version_date']", $risk->version_date)
                ->assertSeeIn("tr:last-child td[field-key='parent_id']", $risk->parent_id)
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
                ->select("project_id", $risk2->project_id)
                ->type("code", $risk2->code)
                ->type("version", $risk2->version)
                ->check("flag")
                ->check("resolved")
                ->select("type_id", $risk2->type_id)
                ->type("date", $risk2->date)
                ->type("title", $risk2->title)
                ->type("description", $risk2->description)
                ->type("trigger_events", $risk2->trigger_events)
                ->select("impact_id", $risk2->impact_id)
                ->select("probability_id", $risk2->probability_id)
                ->select("proximity_id", $risk2->proximity_id)
                ->type("score", $risk2->score)
                ->type("mitigation", $risk2->mitigation)
                ->select("owner_id", $risk2->owner_id)
                ->type("notes", $risk2->notes)
                ->type("contingency", $risk2->contingency)
                ->type("version_date", $risk2->version_date)
                ->type("parent_id", $risk2->parent_id)
                ->press('Update')
                ->assertRouteIs('admin.risks.index')
                ->assertSeeIn("tr:last-child td[field-key='project']", $risk2->project->name)
                ->assertSeeIn("tr:last-child td[field-key='code']", $risk2->code)
                ->assertSeeIn("tr:last-child td[field-key='version']", $risk2->version)
                ->assertChecked("flag")
                ->assertChecked("resolved")
                ->assertSeeIn("tr:last-child td[field-key='type']", $risk2->type->name)
                ->assertSeeIn("tr:last-child td[field-key='date']", $risk2->date)
                ->assertSeeIn("tr:last-child td[field-key='title']", $risk2->title)
                ->assertSeeIn("tr:last-child td[field-key='description']", $risk2->description)
                ->assertSeeIn("tr:last-child td[field-key='trigger_events']", $risk2->trigger_events)
                ->assertSeeIn("tr:last-child td[field-key='impact']", $risk2->impact->name)
                ->assertSeeIn("tr:last-child td[field-key='probability']", $risk2->probability->name)
                ->assertSeeIn("tr:last-child td[field-key='proximity']", $risk2->proximity->name)
                ->assertSeeIn("tr:last-child td[field-key='score']", $risk2->score)
                ->assertSeeIn("tr:last-child td[field-key='mitigation']", $risk2->mitigation)
                ->assertSeeIn("tr:last-child td[field-key='owner']", $risk2->owner->surname)
                ->assertSeeIn("tr:last-child td[field-key='notes']", $risk2->notes)
                ->assertSeeIn("tr:last-child td[field-key='contingency']", $risk2->contingency)
                ->assertSeeIn("tr:last-child td[field-key='version_date']", $risk2->version_date)
                ->assertSeeIn("tr:last-child td[field-key='parent_id']", $risk2->parent_id)
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
                ->assertSeeIn("td[field-key='project']", $risk->project->name)
                ->assertSeeIn("td[field-key='code']", $risk->code)
                ->assertSeeIn("td[field-key='version']", $risk->version)
                ->assertNotChecked("flag")
                ->assertNotChecked("resolved")
                ->assertSeeIn("td[field-key='type']", $risk->type->name)
                ->assertSeeIn("td[field-key='date']", $risk->date)
                ->assertSeeIn("td[field-key='title']", $risk->title)
                ->assertSeeIn("td[field-key='description']", $risk->description)
                ->assertSeeIn("td[field-key='trigger_events']", $risk->trigger_events)
                ->assertSeeIn("td[field-key='impact']", $risk->impact->name)
                ->assertSeeIn("td[field-key='probability']", $risk->probability->name)
                ->assertSeeIn("td[field-key='proximity']", $risk->proximity->name)
                ->assertSeeIn("td[field-key='score']", $risk->score)
                ->assertSeeIn("td[field-key='mitigation']", $risk->mitigation)
                ->assertSeeIn("td[field-key='owner']", $risk->owner->surname)
                ->assertSeeIn("td[field-key='notes']", $risk->notes)
                ->assertSeeIn("td[field-key='contingency']", $risk->contingency)
                ->assertSeeIn("td[field-key='version_date']", $risk->version_date)
                ->assertSeeIn("td[field-key='parent_id']", $risk->parent_id)
                ->logout();
        });
    }

}
