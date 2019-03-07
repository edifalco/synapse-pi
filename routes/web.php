<?php
Route::get('/', function () { return redirect('/admin/home'); });

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index');
    
    Route::resource('acronym_projects', 'Admin\AcronymProjectsController');
    Route::post('acronym_projects_mass_destroy', ['uses' => 'Admin\AcronymProjectsController@massDestroy', 'as' => 'acronym_projects.mass_destroy']);
    Route::post('acronym_projects_restore/{id}', ['uses' => 'Admin\AcronymProjectsController@restore', 'as' => 'acronym_projects.restore']);
    Route::delete('acronym_projects_perma_del/{id}', ['uses' => 'Admin\AcronymProjectsController@perma_del', 'as' => 'acronym_projects.perma_del']);
    Route::resource('acronyms', 'Admin\AcronymsController');
    Route::post('acronyms_mass_destroy', ['uses' => 'Admin\AcronymsController@massDestroy', 'as' => 'acronyms.mass_destroy']);
    Route::post('acronyms_restore/{id}', ['uses' => 'Admin\AcronymsController@restore', 'as' => 'acronyms.restore']);
    Route::delete('acronyms_perma_del/{id}', ['uses' => 'Admin\AcronymsController@perma_del', 'as' => 'acronyms.perma_del']);
    Route::resource('agendas', 'Admin\AgendasController');
    Route::post('agendas_mass_destroy', ['uses' => 'Admin\AgendasController@massDestroy', 'as' => 'agendas.mass_destroy']);
    Route::post('agendas_restore/{id}', ['uses' => 'Admin\AgendasController@restore', 'as' => 'agendas.restore']);
    Route::delete('agendas_perma_del/{id}', ['uses' => 'Admin\AgendasController@perma_del', 'as' => 'agendas.perma_del']);
    Route::resource('alternativescores', 'Admin\AlternativescoresController');
    Route::post('alternativescores_mass_destroy', ['uses' => 'Admin\AlternativescoresController@massDestroy', 'as' => 'alternativescores.mass_destroy']);
    Route::post('alternativescores_restore/{id}', ['uses' => 'Admin\AlternativescoresController@restore', 'as' => 'alternativescores.restore']);
    Route::delete('alternativescores_perma_del/{id}', ['uses' => 'Admin\AlternativescoresController@perma_del', 'as' => 'alternativescores.perma_del']);
    Route::resource('budgets', 'Admin\BudgetsController');
    Route::post('budgets_mass_destroy', ['uses' => 'Admin\BudgetsController@massDestroy', 'as' => 'budgets.mass_destroy']);
    Route::resource('cd_disseminations', 'Admin\CdDisseminationsController');
    Route::post('cd_disseminations_mass_destroy', ['uses' => 'Admin\CdDisseminationsController@massDestroy', 'as' => 'cd_disseminations.mass_destroy']);
    Route::post('cd_disseminations_restore/{id}', ['uses' => 'Admin\CdDisseminationsController@restore', 'as' => 'cd_disseminations.restore']);
    Route::delete('cd_disseminations_perma_del/{id}', ['uses' => 'Admin\CdDisseminationsController@perma_del', 'as' => 'cd_disseminations.perma_del']);
    Route::resource('cd_emails', 'Admin\CdEmailsController');
    Route::post('cd_emails_mass_destroy', ['uses' => 'Admin\CdEmailsController@massDestroy', 'as' => 'cd_emails.mass_destroy']);
    Route::resource('cd_intranet_accesses', 'Admin\CdIntranetAccessesController');
    Route::post('cd_intranet_accesses_mass_destroy', ['uses' => 'Admin\CdIntranetAccessesController@massDestroy', 'as' => 'cd_intranet_accesses.mass_destroy']);
    Route::post('cd_intranet_accesses_restore/{id}', ['uses' => 'Admin\CdIntranetAccessesController@restore', 'as' => 'cd_intranet_accesses.restore']);
    Route::delete('cd_intranet_accesses_perma_del/{id}', ['uses' => 'Admin\CdIntranetAccessesController@perma_del', 'as' => 'cd_intranet_accesses.perma_del']);
    Route::resource('cd_meetings', 'Admin\CdMeetingsController');
    Route::post('cd_meetings_mass_destroy', ['uses' => 'Admin\CdMeetingsController@massDestroy', 'as' => 'cd_meetings.mass_destroy']);
    Route::post('cd_meetings_restore/{id}', ['uses' => 'Admin\CdMeetingsController@restore', 'as' => 'cd_meetings.restore']);
    Route::delete('cd_meetings_perma_del/{id}', ['uses' => 'Admin\CdMeetingsController@perma_del', 'as' => 'cd_meetings.perma_del']);
    Route::resource('cd_scores', 'Admin\CdScoresController');
    Route::post('cd_scores_mass_destroy', ['uses' => 'Admin\CdScoresController@massDestroy', 'as' => 'cd_scores.mass_destroy']);
    Route::post('cd_scores_restore/{id}', ['uses' => 'Admin\CdScoresController@restore', 'as' => 'cd_scores.restore']);
    Route::delete('cd_scores_perma_del/{id}', ['uses' => 'Admin\CdScoresController@perma_del', 'as' => 'cd_scores.perma_del']);
    Route::resource('cd_scores2s', 'Admin\CdScores2sController');
    Route::post('cd_scores2s_mass_destroy', ['uses' => 'Admin\CdScores2sController@massDestroy', 'as' => 'cd_scores2s.mass_destroy']);
    Route::resource('deliverable_documents', 'Admin\DeliverableDocumentsController');
    Route::post('deliverable_documents_mass_destroy', ['uses' => 'Admin\DeliverableDocumentsController@massDestroy', 'as' => 'deliverable_documents.mass_destroy']);
    Route::post('deliverable_documents_restore/{id}', ['uses' => 'Admin\DeliverableDocumentsController@restore', 'as' => 'deliverable_documents.restore']);
    Route::delete('deliverable_documents_perma_del/{id}', ['uses' => 'Admin\DeliverableDocumentsController@perma_del', 'as' => 'deliverable_documents.perma_del']);
    Route::resource('deliverable_members', 'Admin\DeliverableMembersController');
    Route::post('deliverable_members_mass_destroy', ['uses' => 'Admin\DeliverableMembersController@massDestroy', 'as' => 'deliverable_members.mass_destroy']);
    Route::post('deliverable_members_restore/{id}', ['uses' => 'Admin\DeliverableMembersController@restore', 'as' => 'deliverable_members.restore']);
    Route::delete('deliverable_members_perma_del/{id}', ['uses' => 'Admin\DeliverableMembersController@perma_del', 'as' => 'deliverable_members.perma_del']);
    Route::resource('deliverable_partners', 'Admin\DeliverablePartnersController');
    Route::post('deliverable_partners_mass_destroy', ['uses' => 'Admin\DeliverablePartnersController@massDestroy', 'as' => 'deliverable_partners.mass_destroy']);
    Route::post('deliverable_partners_restore/{id}', ['uses' => 'Admin\DeliverablePartnersController@restore', 'as' => 'deliverable_partners.restore']);
    Route::delete('deliverable_partners_perma_del/{id}', ['uses' => 'Admin\DeliverablePartnersController@perma_del', 'as' => 'deliverable_partners.perma_del']);
    Route::resource('deliverable_reviewers', 'Admin\DeliverableReviewersController');
    Route::post('deliverable_reviewers_mass_destroy', ['uses' => 'Admin\DeliverableReviewersController@massDestroy', 'as' => 'deliverable_reviewers.mass_destroy']);
    Route::post('deliverable_reviewers_restore/{id}', ['uses' => 'Admin\DeliverableReviewersController@restore', 'as' => 'deliverable_reviewers.restore']);
    Route::delete('deliverable_reviewers_perma_del/{id}', ['uses' => 'Admin\DeliverableReviewersController@perma_del', 'as' => 'deliverable_reviewers.perma_del']);
    Route::resource('deliverable_statuses', 'Admin\DeliverableStatusesController');
    Route::post('deliverable_statuses_mass_destroy', ['uses' => 'Admin\DeliverableStatusesController@massDestroy', 'as' => 'deliverable_statuses.mass_destroy']);
    Route::resource('deliverable_workpackages', 'Admin\DeliverableWorkpackagesController');
    Route::post('deliverable_workpackages_mass_destroy', ['uses' => 'Admin\DeliverableWorkpackagesController@massDestroy', 'as' => 'deliverable_workpackages.mass_destroy']);
    Route::post('deliverable_workpackages_restore/{id}', ['uses' => 'Admin\DeliverableWorkpackagesController@restore', 'as' => 'deliverable_workpackages.restore']);
    Route::delete('deliverable_workpackages_perma_del/{id}', ['uses' => 'Admin\DeliverableWorkpackagesController@perma_del', 'as' => 'deliverable_workpackages.perma_del']);
    Route::resource('deliverables', 'Admin\DeliverablesController');
    Route::post('deliverables_mass_destroy', ['uses' => 'Admin\DeliverablesController@massDestroy', 'as' => 'deliverables.mass_destroy']);
    Route::post('deliverables_restore/{id}', ['uses' => 'Admin\DeliverablesController@restore', 'as' => 'deliverables.restore']);
    Route::delete('deliverables_perma_del/{id}', ['uses' => 'Admin\DeliverablesController@perma_del', 'as' => 'deliverables.perma_del']);
    Route::resource('document_favorites', 'Admin\DocumentFavoritesController');
    Route::post('document_favorites_mass_destroy', ['uses' => 'Admin\DocumentFavoritesController@massDestroy', 'as' => 'document_favorites.mass_destroy']);
    Route::post('document_favorites_restore/{id}', ['uses' => 'Admin\DocumentFavoritesController@restore', 'as' => 'document_favorites.restore']);
    Route::delete('document_favorites_perma_del/{id}', ['uses' => 'Admin\DocumentFavoritesController@perma_del', 'as' => 'document_favorites.perma_del']);
    Route::resource('documents', 'Admin\DocumentsController');
    Route::post('documents_mass_destroy', ['uses' => 'Admin\DocumentsController@massDestroy', 'as' => 'documents.mass_destroy']);
    Route::post('documents_restore/{id}', ['uses' => 'Admin\DocumentsController@restore', 'as' => 'documents.restore']);
    Route::delete('documents_perma_del/{id}', ['uses' => 'Admin\DocumentsController@perma_del', 'as' => 'documents.perma_del']);
    Route::resource('efforts', 'Admin\EffortsController');
    Route::post('efforts_mass_destroy', ['uses' => 'Admin\EffortsController@massDestroy', 'as' => 'efforts.mass_destroy']);
    Route::post('efforts_restore/{id}', ['uses' => 'Admin\EffortsController@restore', 'as' => 'efforts.restore']);
    Route::delete('efforts_perma_del/{id}', ['uses' => 'Admin\EffortsController@perma_del', 'as' => 'efforts.perma_del']);
    Route::resource('financials', 'Admin\FinancialsController');
    Route::post('financials_mass_destroy', ['uses' => 'Admin\FinancialsController@massDestroy', 'as' => 'financials.mass_destroy']);
    Route::post('financials_restore/{id}', ['uses' => 'Admin\FinancialsController@restore', 'as' => 'financials.restore']);
    Route::delete('financials_perma_del/{id}', ['uses' => 'Admin\FinancialsController@perma_del', 'as' => 'financials.perma_del']);
    Route::resource('financialvisibilities', 'Admin\FinancialvisibilitiesController');
    Route::post('financialvisibilities_mass_destroy', ['uses' => 'Admin\FinancialvisibilitiesController@massDestroy', 'as' => 'financialvisibilities.mass_destroy']);
    Route::post('financialvisibilities_restore/{id}', ['uses' => 'Admin\FinancialvisibilitiesController@restore', 'as' => 'financialvisibilities.restore']);
    Route::delete('financialvisibilities_perma_del/{id}', ['uses' => 'Admin\FinancialvisibilitiesController@perma_del', 'as' => 'financialvisibilities.perma_del']);
    Route::resource('keywords', 'Admin\KeywordsController');
    Route::post('keywords_mass_destroy', ['uses' => 'Admin\KeywordsController@massDestroy', 'as' => 'keywords.mass_destroy']);
    Route::post('keywords_restore/{id}', ['uses' => 'Admin\KeywordsController@restore', 'as' => 'keywords.restore']);
    Route::delete('keywords_perma_del/{id}', ['uses' => 'Admin\KeywordsController@perma_del', 'as' => 'keywords.perma_del']);
    Route::resource('member_partners', 'Admin\MemberPartnersController');
    Route::post('member_partners_mass_destroy', ['uses' => 'Admin\MemberPartnersController@massDestroy', 'as' => 'member_partners.mass_destroy']);
    Route::post('member_partners_restore/{id}', ['uses' => 'Admin\MemberPartnersController@restore', 'as' => 'member_partners.restore']);
    Route::delete('member_partners_perma_del/{id}', ['uses' => 'Admin\MemberPartnersController@perma_del', 'as' => 'member_partners.perma_del']);
    Route::resource('memberroles', 'Admin\MemberrolesController');
    Route::post('memberroles_mass_destroy', ['uses' => 'Admin\MemberrolesController@massDestroy', 'as' => 'memberroles.mass_destroy']);
    Route::post('memberroles_restore/{id}', ['uses' => 'Admin\MemberrolesController@restore', 'as' => 'memberroles.restore']);
    Route::delete('memberroles_perma_del/{id}', ['uses' => 'Admin\MemberrolesController@perma_del', 'as' => 'memberroles.perma_del']);
    Route::resource('members', 'Admin\MembersController');
    Route::post('members_mass_destroy', ['uses' => 'Admin\MembersController@massDestroy', 'as' => 'members.mass_destroy']);
    Route::post('members_restore/{id}', ['uses' => 'Admin\MembersController@restore', 'as' => 'members.restore']);
    Route::delete('members_perma_del/{id}', ['uses' => 'Admin\MembersController@perma_del', 'as' => 'members.perma_del']);
    Route::resource('metricicons', 'Admin\MetriciconsController');
    Route::post('metricicons_mass_destroy', ['uses' => 'Admin\MetriciconsController@massDestroy', 'as' => 'metricicons.mass_destroy']);
    Route::post('metricicons_restore/{id}', ['uses' => 'Admin\MetriciconsController@restore', 'as' => 'metricicons.restore']);
    Route::delete('metricicons_perma_del/{id}', ['uses' => 'Admin\MetriciconsController@perma_del', 'as' => 'metricicons.perma_del']);
    Route::resource('metriclabels', 'Admin\MetriclabelsController');
    Route::post('metriclabels_mass_destroy', ['uses' => 'Admin\MetriclabelsController@massDestroy', 'as' => 'metriclabels.mass_destroy']);
    Route::post('metriclabels_restore/{id}', ['uses' => 'Admin\MetriclabelsController@restore', 'as' => 'metriclabels.restore']);
    Route::delete('metriclabels_perma_del/{id}', ['uses' => 'Admin\MetriclabelsController@perma_del', 'as' => 'metriclabels.perma_del']);
    Route::resource('partnernums', 'Admin\PartnernumsController');
    Route::post('partnernums_mass_destroy', ['uses' => 'Admin\PartnernumsController@massDestroy', 'as' => 'partnernums.mass_destroy']);
    Route::post('partnernums_restore/{id}', ['uses' => 'Admin\PartnernumsController@restore', 'as' => 'partnernums.restore']);
    Route::delete('partnernums_perma_del/{id}', ['uses' => 'Admin\PartnernumsController@perma_del', 'as' => 'partnernums.perma_del']);
    Route::resource('partnerroles', 'Admin\PartnerrolesController');
    Route::post('partnerroles_mass_destroy', ['uses' => 'Admin\PartnerrolesController@massDestroy', 'as' => 'partnerroles.mass_destroy']);
    Route::post('partnerroles_restore/{id}', ['uses' => 'Admin\PartnerrolesController@restore', 'as' => 'partnerroles.restore']);
    Route::delete('partnerroles_perma_del/{id}', ['uses' => 'Admin\PartnerrolesController@perma_del', 'as' => 'partnerroles.perma_del']);
    Route::resource('partners', 'Admin\PartnersController');
    Route::post('partners_mass_destroy', ['uses' => 'Admin\PartnersController@massDestroy', 'as' => 'partners.mass_destroy']);
    Route::post('partners_restore/{id}', ['uses' => 'Admin\PartnersController@restore', 'as' => 'partners.restore']);
    Route::delete('partners_perma_del/{id}', ['uses' => 'Admin\PartnersController@perma_del', 'as' => 'partners.perma_del']);
    Route::resource('periods', 'Admin\PeriodsController');
    Route::post('periods_mass_destroy', ['uses' => 'Admin\PeriodsController@massDestroy', 'as' => 'periods.mass_destroy']);
    Route::post('periods_restore/{id}', ['uses' => 'Admin\PeriodsController@restore', 'as' => 'periods.restore']);
    Route::delete('periods_perma_del/{id}', ['uses' => 'Admin\PeriodsController@perma_del', 'as' => 'periods.perma_del']);
    Route::resource('posts', 'Admin\PostsController');
    Route::post('posts_mass_destroy', ['uses' => 'Admin\PostsController@massDestroy', 'as' => 'posts.mass_destroy']);
    Route::post('posts_restore/{id}', ['uses' => 'Admin\PostsController@restore', 'as' => 'posts.restore']);
    Route::delete('posts_perma_del/{id}', ['uses' => 'Admin\PostsController@perma_del', 'as' => 'posts.perma_del']);
    Route::resource('project_members', 'Admin\ProjectMembersController');
    Route::post('project_members_mass_destroy', ['uses' => 'Admin\ProjectMembersController@massDestroy', 'as' => 'project_members.mass_destroy']);
    Route::post('project_members_restore/{id}', ['uses' => 'Admin\ProjectMembersController@restore', 'as' => 'project_members.restore']);
    Route::delete('project_members_perma_del/{id}', ['uses' => 'Admin\ProjectMembersController@perma_del', 'as' => 'project_members.perma_del']);
    Route::resource('project_partners', 'Admin\ProjectPartnersController');
    Route::post('project_partners_mass_destroy', ['uses' => 'Admin\ProjectPartnersController@massDestroy', 'as' => 'project_partners.mass_destroy']);
    Route::post('project_partners_restore/{id}', ['uses' => 'Admin\ProjectPartnersController@restore', 'as' => 'project_partners.restore']);
    Route::delete('project_partners_perma_del/{id}', ['uses' => 'Admin\ProjectPartnersController@perma_del', 'as' => 'project_partners.perma_del']);
    Route::resource('project_users', 'Admin\ProjectUsersController');
    Route::post('project_users_mass_destroy', ['uses' => 'Admin\ProjectUsersController@massDestroy', 'as' => 'project_users.mass_destroy']);
    Route::post('project_users_restore/{id}', ['uses' => 'Admin\ProjectUsersController@restore', 'as' => 'project_users.restore']);
    Route::delete('project_users_perma_del/{id}', ['uses' => 'Admin\ProjectUsersController@perma_del', 'as' => 'project_users.perma_del']);
    Route::resource('projects', 'Admin\ProjectsController');
    Route::post('projects_mass_destroy', ['uses' => 'Admin\ProjectsController@massDestroy', 'as' => 'projects.mass_destroy']);
    Route::post('projects_restore/{id}', ['uses' => 'Admin\ProjectsController@restore', 'as' => 'projects.restore']);
    Route::delete('projects_perma_del/{id}', ['uses' => 'Admin\ProjectsController@perma_del', 'as' => 'projects.perma_del']);
    Route::resource('publications', 'Admin\PublicationsController');
    Route::post('publications_mass_destroy', ['uses' => 'Admin\PublicationsController@massDestroy', 'as' => 'publications.mass_destroy']);
    Route::post('publications_restore/{id}', ['uses' => 'Admin\PublicationsController@restore', 'as' => 'publications.restore']);
    Route::delete('publications_perma_del/{id}', ['uses' => 'Admin\PublicationsController@perma_del', 'as' => 'publications.perma_del']);
    Route::resource('risk_highlights', 'Admin\RiskHighlightsController');
    Route::post('risk_highlights_mass_destroy', ['uses' => 'Admin\RiskHighlightsController@massDestroy', 'as' => 'risk_highlights.mass_destroy']);
    Route::post('risk_highlights_restore/{id}', ['uses' => 'Admin\RiskHighlightsController@restore', 'as' => 'risk_highlights.restore']);
    Route::delete('risk_highlights_perma_del/{id}', ['uses' => 'Admin\RiskHighlightsController@perma_del', 'as' => 'risk_highlights.perma_del']);
    Route::resource('risk_mowners', 'Admin\RiskMownersController');
    Route::post('risk_mowners_mass_destroy', ['uses' => 'Admin\RiskMownersController@massDestroy', 'as' => 'risk_mowners.mass_destroy']);
    Route::post('risk_mowners_restore/{id}', ['uses' => 'Admin\RiskMownersController@restore', 'as' => 'risk_mowners.restore']);
    Route::delete('risk_mowners_perma_del/{id}', ['uses' => 'Admin\RiskMownersController@perma_del', 'as' => 'risk_mowners.perma_del']);
    Route::resource('risk_mreporters', 'Admin\RiskMreportersController');
    Route::post('risk_mreporters_mass_destroy', ['uses' => 'Admin\RiskMreportersController@massDestroy', 'as' => 'risk_mreporters.mass_destroy']);
    Route::post('risk_mreporters_restore/{id}', ['uses' => 'Admin\RiskMreportersController@restore', 'as' => 'risk_mreporters.restore']);
    Route::delete('risk_mreporters_perma_del/{id}', ['uses' => 'Admin\RiskMreportersController@perma_del', 'as' => 'risk_mreporters.perma_del']);
    Route::resource('risk_powners', 'Admin\RiskPownersController');
    Route::post('risk_powners_mass_destroy', ['uses' => 'Admin\RiskPownersController@massDestroy', 'as' => 'risk_powners.mass_destroy']);
    Route::post('risk_powners_restore/{id}', ['uses' => 'Admin\RiskPownersController@restore', 'as' => 'risk_powners.restore']);
    Route::delete('risk_powners_perma_del/{id}', ['uses' => 'Admin\RiskPownersController@perma_del', 'as' => 'risk_powners.perma_del']);
    Route::resource('risk_preporters', 'Admin\RiskPreportersController');
    Route::post('risk_preporters_mass_destroy', ['uses' => 'Admin\RiskPreportersController@massDestroy', 'as' => 'risk_preporters.mass_destroy']);
    Route::post('risk_preporters_restore/{id}', ['uses' => 'Admin\RiskPreportersController@restore', 'as' => 'risk_preporters.restore']);
    Route::delete('risk_preporters_perma_del/{id}', ['uses' => 'Admin\RiskPreportersController@perma_del', 'as' => 'risk_preporters.perma_del']);
    Route::resource('risks', 'Admin\RisksController');
    Route::post('risks_mass_destroy', ['uses' => 'Admin\RisksController@massDestroy', 'as' => 'risks.mass_destroy']);
    Route::post('risks_restore/{id}', ['uses' => 'Admin\RisksController@restore', 'as' => 'risks.restore']);
    Route::delete('risks_perma_del/{id}', ['uses' => 'Admin\RisksController@perma_del', 'as' => 'risks.perma_del']);
    Route::resource('schedules', 'Admin\SchedulesController');
    Route::post('schedules_mass_destroy', ['uses' => 'Admin\SchedulesController@massDestroy', 'as' => 'schedules.mass_destroy']);
    Route::post('schedules_restore/{id}', ['uses' => 'Admin\SchedulesController@restore', 'as' => 'schedules.restore']);
    Route::delete('schedules_perma_del/{id}', ['uses' => 'Admin\SchedulesController@perma_del', 'as' => 'schedules.perma_del']);
    Route::resource('scoredescriptions', 'Admin\ScoredescriptionsController');
    Route::post('scoredescriptions_mass_destroy', ['uses' => 'Admin\ScoredescriptionsController@massDestroy', 'as' => 'scoredescriptions.mass_destroy']);
    Route::post('scoredescriptions_restore/{id}', ['uses' => 'Admin\ScoredescriptionsController@restore', 'as' => 'scoredescriptions.restore']);
    Route::delete('scoredescriptions_perma_del/{id}', ['uses' => 'Admin\ScoredescriptionsController@perma_del', 'as' => 'scoredescriptions.perma_del']);
    Route::resource('threshold_deliverables', 'Admin\ThresholdDeliverablesController');
    Route::post('threshold_deliverables_mass_destroy', ['uses' => 'Admin\ThresholdDeliverablesController@massDestroy', 'as' => 'threshold_deliverables.mass_destroy']);
    Route::post('threshold_deliverables_restore/{id}', ['uses' => 'Admin\ThresholdDeliverablesController@restore', 'as' => 'threshold_deliverables.restore']);
    Route::delete('threshold_deliverables_perma_del/{id}', ['uses' => 'Admin\ThresholdDeliverablesController@perma_del', 'as' => 'threshold_deliverables.perma_del']);
    Route::resource('threshold_risks', 'Admin\ThresholdRisksController');
    Route::post('threshold_risks_mass_destroy', ['uses' => 'Admin\ThresholdRisksController@massDestroy', 'as' => 'threshold_risks.mass_destroy']);
    Route::post('threshold_risks_restore/{id}', ['uses' => 'Admin\ThresholdRisksController@restore', 'as' => 'threshold_risks.restore']);
    Route::delete('threshold_risks_perma_del/{id}', ['uses' => 'Admin\ThresholdRisksController@perma_del', 'as' => 'threshold_risks.perma_del']);
    Route::resource('workpackages', 'Admin\WorkpackagesController');
    Route::post('workpackages_mass_destroy', ['uses' => 'Admin\WorkpackagesController@massDestroy', 'as' => 'workpackages.mass_destroy']);
    Route::post('workpackages_restore/{id}', ['uses' => 'Admin\WorkpackagesController@restore', 'as' => 'workpackages.restore']);
    Route::delete('workpackages_perma_del/{id}', ['uses' => 'Admin\WorkpackagesController@perma_del', 'as' => 'workpackages.perma_del']);
    Route::resource('permissions', 'Admin\PermissionsController');
    Route::post('permissions_mass_destroy', ['uses' => 'Admin\PermissionsController@massDestroy', 'as' => 'permissions.mass_destroy']);
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);



 
});
