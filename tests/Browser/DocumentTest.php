<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class DocumentTest extends DuskTestCase
{

    public function testCreateDocument()
    {
        $admin = \App\User::find(1);
        $document = factory('App\Document')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $document) {
            $browser->loginAs($admin)
                ->visit(route('admin.documents.index'))
                ->clickLink('Add new')
                ->type("title", $document->title)
                ->type("folder", $document->folder)
                ->select("project_id", $document->project_id)
                ->select("deliverable_id", $document->deliverable_id)
                ->attach("document", base_path("tests/_resources/test.jpg"))
                ->press('Save')
                ->assertRouteIs('admin.documents.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $document->title)
                ->assertSeeIn("tr:last-child td[field-key='folder']", $document->folder)
                ->assertSeeIn("tr:last-child td[field-key='project']", $document->project->name)
                ->assertSeeIn("tr:last-child td[field-key='deliverable']", $document->deliverable->label_identification)
                ->assertVisible("a[href='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/" . \App\Document::first()->document . "']")
                ->logout();
        });
    }

    public function testEditDocument()
    {
        $admin = \App\User::find(1);
        $document = factory('App\Document')->create();
        $document2 = factory('App\Document')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $document, $document2) {
            $browser->loginAs($admin)
                ->visit(route('admin.documents.index'))
                ->click('tr[data-entry-id="' . $document->id . '"] .btn-info')
                ->type("title", $document2->title)
                ->type("folder", $document2->folder)
                ->select("project_id", $document2->project_id)
                ->select("deliverable_id", $document2->deliverable_id)
                ->attach("document", base_path("tests/_resources/test.jpg"))
                ->press('Update')
                ->assertRouteIs('admin.documents.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $document2->title)
                ->assertSeeIn("tr:last-child td[field-key='folder']", $document2->folder)
                ->assertSeeIn("tr:last-child td[field-key='project']", $document2->project->name)
                ->assertSeeIn("tr:last-child td[field-key='deliverable']", $document2->deliverable->label_identification)
                ->assertVisible("a[href='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/" . \App\Document::first()->document . "']")
                ->logout();
        });
    }

    public function testShowDocument()
    {
        $admin = \App\User::find(1);
        $document = factory('App\Document')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $document) {
            $browser->loginAs($admin)
                ->visit(route('admin.documents.index'))
                ->click('tr[data-entry-id="' . $document->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='title']", $document->title)
                ->assertSeeIn("td[field-key='folder']", $document->folder)
                ->assertSeeIn("td[field-key='project']", $document->project->name)
                ->assertSeeIn("td[field-key='deliverable']", $document->deliverable->label_identification)
                ->logout();
        });
    }

}
