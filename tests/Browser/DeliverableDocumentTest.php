<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class DeliverableDocumentTest extends DuskTestCase
{

    public function testCreateDeliverableDocument()
    {
        $admin = \App\User::find(1);
        $deliverable_document = factory('App\DeliverableDocument')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $deliverable_document) {
            $browser->loginAs($admin)
                ->visit(route('admin.deliverable_documents.index'))
                ->clickLink('Add new')
                ->select("deliverable_id", $deliverable_document->deliverable_id)
                ->select("document_id", $deliverable_document->document_id)
                ->press('Save')
                ->assertRouteIs('admin.deliverable_documents.index')
                ->assertSeeIn("tr:last-child td[field-key='deliverable']", $deliverable_document->deliverable->label_identification)
                ->assertSeeIn("tr:last-child td[field-key='document']", $deliverable_document->document->title)
                ->logout();
        });
    }

    public function testEditDeliverableDocument()
    {
        $admin = \App\User::find(1);
        $deliverable_document = factory('App\DeliverableDocument')->create();
        $deliverable_document2 = factory('App\DeliverableDocument')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $deliverable_document, $deliverable_document2) {
            $browser->loginAs($admin)
                ->visit(route('admin.deliverable_documents.index'))
                ->click('tr[data-entry-id="' . $deliverable_document->id . '"] .btn-info')
                ->select("deliverable_id", $deliverable_document2->deliverable_id)
                ->select("document_id", $deliverable_document2->document_id)
                ->press('Update')
                ->assertRouteIs('admin.deliverable_documents.index')
                ->assertSeeIn("tr:last-child td[field-key='deliverable']", $deliverable_document2->deliverable->label_identification)
                ->assertSeeIn("tr:last-child td[field-key='document']", $deliverable_document2->document->title)
                ->logout();
        });
    }

    public function testShowDeliverableDocument()
    {
        $admin = \App\User::find(1);
        $deliverable_document = factory('App\DeliverableDocument')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $deliverable_document) {
            $browser->loginAs($admin)
                ->visit(route('admin.deliverable_documents.index'))
                ->click('tr[data-entry-id="' . $deliverable_document->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='deliverable']", $deliverable_document->deliverable->label_identification)
                ->assertSeeIn("td[field-key='document']", $deliverable_document->document->title)
                ->logout();
        });
    }

}
