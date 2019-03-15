@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">

            <li>
                <select class="searchable-field form-control"></select>
            </li>

            <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                <a href="{{ url('/') }}">
                    <i class="fa fa-wrench"></i>
                    <span class="title">@lang('global.app_dashboard')</span>
                </a>
            </li>

            @can('project_access')
            <li>
                <a href="{{ route('admin.projects.index') }}">
                    <i class="fa fa-tags"></i>
                    <span>@lang('global.projects.title')</span>
                </a>
            </li>@endcan
            
            @can('partner_access')
            <li>
                <a href="{{ route('admin.partners.index') }}">
                    <i class="fa fa-tags"></i>
                    <span>@lang('global.partners.title')</span>
                </a>
            </li>@endcan
            
            @can('member_access')
            <li>
                <a href="{{ route('admin.members.index') }}">
                    <i class="fa fa-tags"></i>
                    <span>@lang('global.members.title')</span>
                </a>
            </li>@endcan
            
            @can('keyword_access')
            <li>
                <a href="{{ route('admin.keywords.index') }}">
                    <i class="fa fa-tags"></i>
                    <span>@lang('global.keywords.title')</span>
                </a>
            </li>@endcan
            
            @can('post_access')
            <li>
                <a href="{{ route('admin.posts.index') }}">
                    <i class="fa fa-tags"></i>
                    <span>@lang('global.posts.title')</span>
                </a>
            </li>@endcan
            
            @can('schedule_access')
            <li>
                <a href="{{ route('admin.schedules.index') }}">
                    <i class="fa fa-tags"></i>
                    <span>@lang('global.schedules.title')</span>
                </a>
            </li>@endcan
            
            @can('agenda_access')
            <li>
                <a href="{{ route('admin.agendas.index') }}">
                    <i class="fa fa-tags"></i>
                    <span>@lang('global.agenda.title')</span>
                </a>
            </li>@endcan
            
            @can('deliverable_access')
            <li>
                <a href="{{ route('admin.deliverables.index') }}">
                    <i class="fa fa-tags"></i>
                    <span>@lang('global.deliverables.title')</span>
                </a>
            </li>@endcan
            
            @can('document_access')
            <li>
                <a href="{{ route('admin.documents.index') }}">
                    <i class="fa fa-tags"></i>
                    <span>@lang('global.documents.title')</span>
                </a>
            </li>@endcan
            
            @can('budget_access')
            <li>
                <a href="{{ route('admin.budgets.index') }}">
                    <i class="fa fa-tags"></i>
                    <span>@lang('global.budgets.title')</span>
                </a>
            </li>@endcan
            
            @can('financial_access')
            <li>
                <a href="{{ route('admin.financials.index') }}">
                    <i class="fa fa-tags"></i>
                    <span>@lang('global.financials.title')</span>
                </a>
            </li>@endcan
            
            @can('publication_access')
            <li>
                <a href="{{ route('admin.publications.index') }}">
                    <i class="fa fa-tags"></i>
                    <span>@lang('global.publications.title')</span>
                </a>
            </li>@endcan
            
            @can('risk_access')
            <li>
                <a href="{{ route('admin.risks.index') }}">
                    <i class="fa fa-tags"></i>
                    <span>@lang('global.risks.title')</span>
                </a>
            </li>@endcan
            
            @can('team_access')
            <li>
                <a href="{{ route('admin.teams.index') }}">
                    <i class="fa fa-gears"></i>
                    <span>@lang('global.team.title')</span>
                </a>
            </li>@endcan
            
            @can('workpackage_access')
            <li>
                <a href="{{ route('admin.workpackages.index') }}">
                    <i class="fa fa-tags"></i>
                    <span>@lang('global.workpackages.title')</span>
                </a>
            </li>@endcan
            
            @can('acronym_access')
            <li>
                <a href="{{ route('admin.acronyms.index') }}">
                    <i class="fa fa-tags"></i>
                    <span>@lang('global.acronyms.title')</span>
                </a>
            </li>@endcan
            
            @can('effort_access')
            <li>
                <a href="{{ route('admin.efforts.index') }}">
                    <i class="fa fa-tags"></i>
                    <span>@lang('global.efforts.title')</span>
                </a>
            </li>@endcan
            
            @can('project_period_access')
            <li>
                <a href="{{ route('admin.project_periods.index') }}">
                    <i class="fa fa-gears"></i>
                    <span>@lang('global.project-periods.title')</span>
                </a>
            </li>@endcan
            
            @can('document_folder_access')
            <li>
                <a href="{{ route('admin.document_folders.index') }}">
                    <i class="fa fa-gears"></i>
                    <span>@lang('global.document-folders.title')</span>
                </a>
            </li>@endcan
            
            @can('country_access')
            <li>
                <a href="{{ route('admin.countries.index') }}">
                    <i class="fa fa-gears"></i>
                    <span>@lang('global.countries.title')</span>
                </a>
            </li>@endcan
            
            @can('schedule_status_access')
            <li>
                <a href="{{ route('admin.schedule_statuses.index') }}">
                    <i class="fa fa-gears"></i>
                    <span>@lang('global.schedule-statuses.title')</span>
                </a>
            </li>@endcan
            
            @can('schedule_highlight_access')
            <li>
                <a href="{{ route('admin.schedule_highlights.index') }}">
                    <i class="fa fa-gears"></i>
                    <span>@lang('global.schedule-highlights.title')</span>
                </a>
            </li>@endcan
            
            @can('risk_type_access')
            <li>
                <a href="{{ route('admin.risk_types.index') }}">
                    <i class="fa fa-gears"></i>
                    <span>@lang('global.risk-types.title')</span>
                </a>
            </li>@endcan
            
            @can('risk_impact_access')
            <li>
                <a href="{{ route('admin.risk_impacts.index') }}">
                    <i class="fa fa-gears"></i>
                    <span>@lang('global.risk-impacts.title')</span>
                </a>
            </li>@endcan
            
            @can('risk_probability_access')
            <li>
                <a href="{{ route('admin.risk_probabilities.index') }}">
                    <i class="fa fa-gears"></i>
                    <span>@lang('global.risk-probabilities.title')</span>
                </a>
            </li>@endcan
            
            @can('risk_proximity_access')
            <li>
                <a href="{{ route('admin.risk_proximities.index') }}">
                    <i class="fa fa-gears"></i>
                    <span>@lang('global.risk-proximities.title')</span>
                </a>
            </li>@endcan
            
            @can('project_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-gears"></i>
                    <span>@lang('global.project-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('alternativescore_access')
                    <li>
                        <a href="{{ route('admin.alternativescores.index') }}">
                            <i class="fa fa-tags"></i>
                            <span>@lang('global.alternativescores.title')</span>
                        </a>
                    </li>@endcan
                    
                </ul>
            </li>@endcan
            
            @can('admin_project_mgmt_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-gears"></i>
                    <span>@lang('global.admin-project-mgmt.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('acronym_project_access')
                    <li>
                        <a href="{{ route('admin.acronym_projects.index') }}">
                            <i class="fa fa-tags"></i>
                            <span>@lang('global.acronym-projects.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('cd_dissemination_access')
                    <li>
                        <a href="{{ route('admin.cd_disseminations.index') }}">
                            <i class="fa fa-tags"></i>
                            <span>@lang('global.cd-disseminations.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('cd_email_access')
                    <li>
                        <a href="{{ route('admin.cd_emails.index') }}">
                            <i class="fa fa-tags"></i>
                            <span>@lang('global.cd-emails.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('cd_intranet_access_access')
                    <li>
                        <a href="{{ route('admin.cd_intranet_accesses.index') }}">
                            <i class="fa fa-tags"></i>
                            <span>@lang('global.cd-intranet-access.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('cd_meeting_access')
                    <li>
                        <a href="{{ route('admin.cd_meetings.index') }}">
                            <i class="fa fa-tags"></i>
                            <span>@lang('global.cd-meetings.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('cd_score_access')
                    <li>
                        <a href="{{ route('admin.cd_scores.index') }}">
                            <i class="fa fa-tags"></i>
                            <span>@lang('global.cd-scores.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('cd_scores2_access')
                    <li>
                        <a href="{{ route('admin.cd_scores2s.index') }}">
                            <i class="fa fa-tags"></i>
                            <span>@lang('global.cd-scores2.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('deliverable_document_access')
                    <li>
                        <a href="{{ route('admin.deliverable_documents.index') }}">
                            <i class="fa fa-tags"></i>
                            <span>@lang('global.deliverable-documents.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('deliverable_partner_access')
                    <li>
                        <a href="{{ route('admin.deliverable_partners.index') }}">
                            <i class="fa fa-tags"></i>
                            <span>@lang('global.deliverable-partners.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('deliverable_reviewer_access')
                    <li>
                        <a href="{{ route('admin.deliverable_reviewers.index') }}">
                            <i class="fa fa-tags"></i>
                            <span>@lang('global.deliverable-reviewers.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('deliverable_status_access')
                    <li>
                        <a href="{{ route('admin.deliverable_statuses.index') }}">
                            <i class="fa fa-tags"></i>
                            <span>@lang('global.deliverable-status.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('deliverable_workpackage_access')
                    <li>
                        <a href="{{ route('admin.deliverable_workpackages.index') }}">
                            <i class="fa fa-tags"></i>
                            <span>@lang('global.deliverable-workpackages.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('document_favorite_access')
                    <li>
                        <a href="{{ route('admin.document_favorites.index') }}">
                            <i class="fa fa-tags"></i>
                            <span>@lang('global.document-favorites.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('financialvisibility_access')
                    <li>
                        <a href="{{ route('admin.financialvisibilities.index') }}">
                            <i class="fa fa-tags"></i>
                            <span>@lang('global.financialvisibilities.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('member_partner_access')
                    <li>
                        <a href="{{ route('admin.member_partners.index') }}">
                            <i class="fa fa-tags"></i>
                            <span>@lang('global.member-partners.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('memberrole_access')
                    <li>
                        <a href="{{ route('admin.memberroles.index') }}">
                            <i class="fa fa-tags"></i>
                            <span>@lang('global.memberroles.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('metriclabel_access')
                    <li>
                        <a href="{{ route('admin.metriclabels.index') }}">
                            <i class="fa fa-tags"></i>
                            <span>@lang('global.metriclabels.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('partnernum_access')
                    <li>
                        <a href="{{ route('admin.partnernums.index') }}">
                            <i class="fa fa-tags"></i>
                            <span>@lang('global.partnernums.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('metricicon_access')
                    <li>
                        <a href="{{ route('admin.metricicons.index') }}">
                            <i class="fa fa-tags"></i>
                            <span>@lang('global.metricicons.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('partnerrole_access')
                    <li>
                        <a href="{{ route('admin.partnerroles.index') }}">
                            <i class="fa fa-tags"></i>
                            <span>@lang('global.partnerroles.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('project_member_access')
                    <li>
                        <a href="{{ route('admin.project_members.index') }}">
                            <i class="fa fa-tags"></i>
                            <span>@lang('global.project-members.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('project_user_access')
                    <li>
                        <a href="{{ route('admin.project_users.index') }}">
                            <i class="fa fa-tags"></i>
                            <span>@lang('global.project-users.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('risk_highlight_access')
                    <li>
                        <a href="{{ route('admin.risk_highlights.index') }}">
                            <i class="fa fa-tags"></i>
                            <span>@lang('global.risk-highlights.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('risk_mreporter_access')
                    <li>
                        <a href="{{ route('admin.risk_mreporters.index') }}">
                            <i class="fa fa-tags"></i>
                            <span>@lang('global.risk-mreporters.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('risk_powner_access')
                    <li>
                        <a href="{{ route('admin.risk_powners.index') }}">
                            <i class="fa fa-tags"></i>
                            <span>@lang('global.risk-powners.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('risk_preporter_access')
                    <li>
                        <a href="{{ route('admin.risk_preporters.index') }}">
                            <i class="fa fa-tags"></i>
                            <span>@lang('global.risk-preporters.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('scoredescription_access')
                    <li>
                        <a href="{{ route('admin.scoredescriptions.index') }}">
                            <i class="fa fa-tags"></i>
                            <span>@lang('global.scoredescriptions.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('threshold_deliverable_access')
                    <li>
                        <a href="{{ route('admin.threshold_deliverables.index') }}">
                            <i class="fa fa-tags"></i>
                            <span>@lang('global.threshold-deliverables.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('threshold_risk_access')
                    <li>
                        <a href="{{ route('admin.threshold_risks.index') }}">
                            <i class="fa fa-tags"></i>
                            <span>@lang('global.threshold-risks.title')</span>
                        </a>
                    </li>@endcan
                    
                </ul>
            </li>@endcan
            
            @can('user_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>@lang('global.user-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('permission_access')
                    <li>
                        <a href="{{ route('admin.permissions.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span>@lang('global.permissions.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('role_access')
                    <li>
                        <a href="{{ route('admin.roles.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span>@lang('global.roles.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('user_access')
                    <li>
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fa fa-user"></i>
                            <span>@lang('global.users.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('user_action_access')
                    <li>
                        <a href="{{ route('admin.user_actions.index') }}">
                            <i class="fa fa-th-list"></i>
                            <span>@lang('global.user-actions.title')</span>
                        </a>
                    </li>@endcan
                    
                </ul>
            </li>@endcan
            
            @can('faq_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-question"></i>
                    <span>@lang('global.faq-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('faq_category_access')
                    <li>
                        <a href="{{ route('admin.faq_categories.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span>@lang('global.faq-categories.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('faq_question_access')
                    <li>
                        <a href="{{ route('admin.faq_questions.index') }}">
                            <i class="fa fa-question"></i>
                            <span>@lang('global.faq-questions.title')</span>
                        </a>
                    </li>@endcan
                    
                </ul>
            </li>@endcan
            

            

            



            <li class="{{ $request->segment(1) == 'change_password' ? 'active' : '' }}">
                <a href="{{ route('auth.change_password') }}">
                    <i class="fa fa-key"></i>
                    <span class="title">@lang('global.app_change_password')</span>
                </a>
            </li>

            <li>
                <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-arrow-left"></i>
                    <span class="title">@lang('global.app_logout')</span>
                </a>
            </li>
        </ul>
    </section>
</aside>

