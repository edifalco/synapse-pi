<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class DeliverableTest extends DuskTestCase
{

    public function testCreateDeliverable()
    {
        $admin = \App\User::find(1);
        $deliverable = factory('App\Deliverable')->make();

        $relations = [
            factory('App\Member')->create(), 
            factory('App\Member')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $deliverable, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.deliverables.index'))
                ->clickLink('Add new')
                ->type("label_identification", $deliverable->label_identification)
                ->type("title", $deliverable->title)
                ->type("short_title", $deliverable->short_title)
                ->type("date", $deliverable->date)
                ->select("status_id", $deliverable->status_id)
                ->type("notes", $deliverable->notes)
                ->select("project_id", $deliverable->project_id)
                ->type("confidentiality", $deliverable->confidentiality)
                ->type("submission_date", $deliverable->submission_date)
                ->type("due_date_months", $deliverable->due_date_months)
                ->select('select[name="responsible[]"]', $relations[0]->id)
                ->select('select[name="responsible[]"]', $relations[1]->id)
                ->select("workpackages_id", $deliverable->workpackages_id)
                ->press('Save')
                ->assertRouteIs('admin.deliverables.index')
                ->assertSeeIn("tr:last-child td[field-key='label_identification']", $deliverable->label_identification)
                ->assertSeeIn("tr:last-child td[field-key='title']", $deliverable->title)
                ->assertSeeIn("tr:last-child td[field-key='short_title']", $deliverable->short_title)
                ->assertSeeIn("tr:last-child td[field-key='date']", $deliverable->date)
                ->assertSeeIn("tr:last-child td[field-key='status']", $deliverable->status->label)
                ->assertSeeIn("tr:last-child td[field-key='notes']", $deliverable->notes)
                ->assertSeeIn("tr:last-child td[field-key='project']", $deliverable->project->name)
                ->assertSeeIn("tr:last-child td[field-key='confidentiality']", $deliverable->confidentiality)
                ->assertSeeIn("tr:last-child td[field-key='submission_date']", $deliverable->submission_date)
                ->assertSeeIn("tr:last-child td[field-key='due_date_months']", $deliverable->due_date_months)
                ->assertSeeIn("tr:last-child td[field-key='responsible'] span:first-child", $relations[0]->surname)
                ->assertSeeIn("tr:last-child td[field-key='responsible'] span:last-child", $relations[1]->surname)
                ->assertSeeIn("tr:last-child td[field-key='workpackages']", $deliverable->workpackages->wp_id)
                ->logout();
        });
    }

    public function testEditDeliverable()
    {
        $admin = \App\User::find(1);
        $deliverable = factory('App\Deliverable')->create();
        $deliverable2 = factory('App\Deliverable')->make();

        $relations = [
            factory('App\Member')->create(), 
            factory('App\Member')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $deliverable, $deliverable2, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.deliverables.index'))
                ->click('tr[data-entry-id="' . $deliverable->id . '"] .btn-info')
                ->type("label_identification", $deliverable2->label_identification)
                ->type("title", $deliverable2->title)
                ->type("short_title", $deliverable2->short_title)
                ->type("date", $deliverable2->date)
                ->select("status_id", $deliverable2->status_id)
                ->type("notes", $deliverable2->notes)
                ->select("project_id", $deliverable2->project_id)
                ->type("confidentiality", $deliverable2->confidentiality)
                ->type("submission_date", $deliverable2->submission_date)
                ->type("due_date_months", $deliverable2->due_date_months)
                ->select('select[name="responsible[]"]', $relations[0]->id)
                ->select('select[name="responsible[]"]', $relations[1]->id)
                ->select("workpackages_id", $deliverable2->workpackages_id)
                ->press('Update')
                ->assertRouteIs('admin.deliverables.index')
                ->assertSeeIn("tr:last-child td[field-key='label_identification']", $deliverable2->label_identification)
                ->assertSeeIn("tr:last-child td[field-key='title']", $deliverable2->title)
                ->assertSeeIn("tr:last-child td[field-key='short_title']", $deliverable2->short_title)
                ->assertSeeIn("tr:last-child td[field-key='date']", $deliverable2->date)
                ->assertSeeIn("tr:last-child td[field-key='status']", $deliverable2->status->label)
                ->assertSeeIn("tr:last-child td[field-key='notes']", $deliverable2->notes)
                ->assertSeeIn("tr:last-child td[field-key='project']", $deliverable2->project->name)
                ->assertSeeIn("tr:last-child td[field-key='confidentiality']", $deliverable2->confidentiality)
                ->assertSeeIn("tr:last-child td[field-key='submission_date']", $deliverable2->submission_date)
                ->assertSeeIn("tr:last-child td[field-key='due_date_months']", $deliverable2->due_date_months)
                ->assertSeeIn("tr:last-child td[field-key='responsible'] span:first-child", $relations[0]->surname)
                ->assertSeeIn("tr:last-child td[field-key='responsible'] span:last-child", $relations[1]->surname)
                ->assertSeeIn("tr:last-child td[field-key='workpackages']", $deliverable2->workpackages->wp_id)
                ->logout();
        });
    }

    public function testShowDeliverable()
    {
        $admin = \App\User::find(1);
        $deliverable = factory('App\Deliverable')->create();

        $relations = [
            factory('App\Member')->create(), 
            factory('App\Member')->create(), 
        ];

        $deliverable->responsible()->attach([$relations[0]->id, $relations[1]->id]);

        $this->browse(function (Browser $browser) use ($admin, $deliverable, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.deliverables.index'))
                ->click('tr[data-entry-id="' . $deliverable->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='label_identification']", $deliverable->label_identification)
                ->assertSeeIn("td[field-key='title']", $deliverable->title)
                ->assertSeeIn("td[field-key='short_title']", $deliverable->short_title)
                ->assertSeeIn("td[field-key='date']", $deliverable->date)
                ->assertSeeIn("td[field-key='status']", $deliverable->status->label)
                ->assertSeeIn("td[field-key='notes']", $deliverable->notes)
                ->assertSeeIn("td[field-key='project']", $deliverable->project->name)
                ->assertSeeIn("td[field-key='confidentiality']", $deliverable->confidentiality)
                ->assertSeeIn("td[field-key='submission_date']", $deliverable->submission_date)
                ->assertSeeIn("td[field-key='due_date_months']", $deliverable->due_date_months)
                ->assertSeeIn("tr:last-child td[field-key='responsible'] span:first-child", $relations[0]->surname)
                ->assertSeeIn("tr:last-child td[field-key='responsible'] span:last-child", $relations[1]->surname)
                ->assertSeeIn("td[field-key='workpackages']", $deliverable->workpackages->wp_id)
                ->logout();
        });
    }

}
