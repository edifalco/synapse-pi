<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class DocumentFavoriteTest extends DuskTestCase
{

    public function testCreateDocumentFavorite()
    {
        $admin = \App\User::find(1);
        $document_favorite = factory('App\DocumentFavorite')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $document_favorite) {
            $browser->loginAs($admin)
                ->visit(route('admin.document_favorites.index'))
                ->clickLink('Add new')
                ->select("document_id", $document_favorite->document_id)
                ->select("project_id", $document_favorite->project_id)
                ->press('Save')
                ->assertRouteIs('admin.document_favorites.index')
                ->assertSeeIn("tr:last-child td[field-key='document']", $document_favorite->document->title)
                ->assertSeeIn("tr:last-child td[field-key='project']", $document_favorite->project->name)
                ->logout();
        });
    }

    public function testEditDocumentFavorite()
    {
        $admin = \App\User::find(1);
        $document_favorite = factory('App\DocumentFavorite')->create();
        $document_favorite2 = factory('App\DocumentFavorite')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $document_favorite, $document_favorite2) {
            $browser->loginAs($admin)
                ->visit(route('admin.document_favorites.index'))
                ->click('tr[data-entry-id="' . $document_favorite->id . '"] .btn-info')
                ->select("document_id", $document_favorite2->document_id)
                ->select("project_id", $document_favorite2->project_id)
                ->press('Update')
                ->assertRouteIs('admin.document_favorites.index')
                ->assertSeeIn("tr:last-child td[field-key='document']", $document_favorite2->document->title)
                ->assertSeeIn("tr:last-child td[field-key='project']", $document_favorite2->project->name)
                ->logout();
        });
    }

    public function testShowDocumentFavorite()
    {
        $admin = \App\User::find(1);
        $document_favorite = factory('App\DocumentFavorite')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $document_favorite) {
            $browser->loginAs($admin)
                ->visit(route('admin.document_favorites.index'))
                ->click('tr[data-entry-id="' . $document_favorite->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='document']", $document_favorite->document->title)
                ->assertSeeIn("td[field-key='project']", $document_favorite->project->name)
                ->logout();
        });
    }

}
