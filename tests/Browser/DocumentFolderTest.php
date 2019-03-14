<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class DocumentFolderTest extends DuskTestCase
{

    public function testCreateDocumentFolder()
    {
        $admin = \App\User::find(1);
        $document_folder = factory('App\DocumentFolder')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $document_folder) {
            $browser->loginAs($admin)
                ->visit(route('admin.document_folders.index'))
                ->clickLink('Add new')
                ->type("name", $document_folder->name)
                ->press('Save')
                ->assertRouteIs('admin.document_folders.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $document_folder->name)
                ->logout();
        });
    }

    public function testEditDocumentFolder()
    {
        $admin = \App\User::find(1);
        $document_folder = factory('App\DocumentFolder')->create();
        $document_folder2 = factory('App\DocumentFolder')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $document_folder, $document_folder2) {
            $browser->loginAs($admin)
                ->visit(route('admin.document_folders.index'))
                ->click('tr[data-entry-id="' . $document_folder->id . '"] .btn-info')
                ->type("name", $document_folder2->name)
                ->press('Update')
                ->assertRouteIs('admin.document_folders.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $document_folder2->name)
                ->logout();
        });
    }

    public function testShowDocumentFolder()
    {
        $admin = \App\User::find(1);
        $document_folder = factory('App\DocumentFolder')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $document_folder) {
            $browser->loginAs($admin)
                ->visit(route('admin.document_folders.index'))
                ->click('tr[data-entry-id="' . $document_folder->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $document_folder->name)
                ->logout();
        });
    }

}
