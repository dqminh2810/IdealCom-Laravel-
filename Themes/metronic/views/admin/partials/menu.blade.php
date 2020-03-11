<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn"><i class="la la-close"></i></button>
<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">
    <!-- BEGIN: Aside Menu -->
    <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " m-menu-vertical="1" m-menu-scrollable="0" m-menu-dropdown-timeout="500">
        <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
            <li class="m-menu__item  m-menu__item--active" aria-haspopup="true">
                <a href="{{ route('admin.dashboard') }}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-line-graph"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">{{__('menu.menu-dashboard')}}</span>
                            <!-- <span class="m-menu__link-badge"><span class="m-badge m-badge--danger">2</span></span> -->
                        </span>
                    </span>
                </a>
            </li>
            <li class="m-menu__section">
                <h4 class="m-menu__section-text">Configuration système</h4>
                <i class="m-menu__section-icon flaticon-more-v3"></i>
            </li>
            <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;" class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon flaticon-cogwheel"></i><span class="m-menu__link-text">{{__('menu.menu-system')}}</span><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span class="m-menu__link"><span class="m-menu__link-text">Système</span></span>
                        </li>
                        <li class="m-menu__item " aria-haspopup="true">
                            <a href="?page=components/base/state&demo=default" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">{{__('menu.menu-item-data-schema')}}</span>
                            </a>
                        </li>
                        @permission('admin-modules')
                        <li class="m-menu__item " aria-haspopup="true">
                            <a href="{{ route('modules.index') }}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">{{__('menu.menu-item-application-module')}}</span>
                            </a>
                        </li>
                        @endpermission
                        @permission('admin-cookies')
                        <li class="m-menu__item " aria-haspopup="true">
                            <a href="{{ route('cookies.index') }}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">{{__('menu.menu-item-cookie')}}</span>
                            </a>
                        </li>
                        @endpermission
                        <li class="m-menu__item " aria-haspopup="true">
                            <a href="?page=components/base/state&demo=default" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">{{__('menu.menu-item-config-setting')}}</span>
                            </a>
                        </li>
                        <li class="m-menu__item " aria-haspopup="true">
                            <a href="?page=components/base/state&demo=default" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">{{__('menu.menu-item-permanent-link')}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            @permission('admin-env|admin-roles|admin-permissions|admin-agences|admin-domains|admin-languages|admin-traductions')
            <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;" class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon flaticon-interface-3"></i><span class="m-menu__link-text">{{__('menu.menu-environment')}}</span><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true">
                            <span class="m-menu__link"><span class="m-menu__link-text">Environnement</span></span>
                        </li>
                        @permission('admin-agences')
                        <li class="m-menu__item " aria-haspopup="true">
                            <a href="{{ route('agences.index') }}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">{{__('menu.menu-item-agency')}}</span>
                            </a>
                        </li>
                        @endpermission
                        @permission('admin-roles')
                        <li class="m-menu__item " aria-haspopup="true">
                            <a href="{{ route('roles.index') }}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">{{__('menu.menu-item-role')}}</span>
                            </a>
                        </li>
                        @endpermission
                        @permission('admin-permissions')
                        <li class="m-menu__item " aria-haspopup="true">
                            <a href="{{ route('permissions.index') }}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">{{__('menu.menu-item-permission')}}</span>
                            </a>
                        </li>
                        @endpermission
                        @permission('admin-domains')
                        <li class="m-menu__item " aria-haspopup="true">
                            <a href="{{ route('domains.index') }}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">{{__('menu.menu-item-domain')}}</span>
                            </a>
                        </li>
                        @endpermission
                        @permission('admin-languages')
                        <li class="m-menu__item " aria-haspopup="true">
                            <a href="{{ route('languages.index') }}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">{{__('menu.menu-item-language')}}</span>
                            </a>
                        </li>
                        <li class="m-menu__item " aria-haspopup="true">
                            <a href="?page=components/base/state&demo=default" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">{{__('menu.menu-item-translate')}}</span>
                            </a>
                        </li>
                        @endpermission
                    </ul>
                </div>
            </li>
            @endpermission
            @permission('admin-countries')
            <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;" class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon flaticon-map-location"></i><span class="m-menu__link-text">{{__('menu.menu-geography')}}</span><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span class="m-menu__link"><span class="m-menu__link-text">Géographie</span></span>
                        </li>
                        <li class="m-menu__item " aria-haspopup="true">
                            <a href="{{ route('countries.index') }}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">{{__('menu.menu-item-country')}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @endpermission
            @permission('admin-menus')
            <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;" class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon flaticon-layers"></i><span class="m-menu__link-text">Menus</span><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span class="m-menu__link"><span class="m-menu__link-text">Menus</span></span>
                        </li>
                        <li class="m-menu__item " aria-haspopup="true">
                            <a href="{{ route('menus.index') }}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">{{__('menu.menu-item-menu-management')}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @endpermission
            @permission('admin-users')
            <li class="m-menu__section">
                <h4 class="m-menu__section-text">Utilisateurs</h4>
                <i class="m-menu__section-icon flaticon-more-v3"></i>
            </li>
            <li class="m-menu__item " aria-haspopup="true">
                <a href="{{ route('users.index') }}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-user-settings"></i>
                    <span class="m-menu__link-text">{{__('menu.menu-user-management')}}</span>
                </a>
            </li>
            @endpermission
            <li class="m-menu__section">
                <h4 class="m-menu__section-text">Contenu</h4>
                <i class="m-menu__section-icon flaticon-more-v3"></i>
            </li>
            <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;" class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon flaticon-computer"></i><span class="m-menu__link-text">{{__('menu.menu-multimedia')}}</span><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span class="m-menu__link"><span class="m-menu__link-text">Multimédia</span></span>
                        </li>
                        @permission('admin-medias-documents')
                        <li class="m-menu__item " aria-haspopup="true">
                            <a href="{{ route('documents.index') }}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">{{__('menu.menu-item-document')}}</span>
                            </a>
                        </li>
                        @endpermission
                        @permission('admin-medias-photos')
                        <li class="m-menu__item " aria-haspopup="true">
                            <a href="{{ route('photos.index') }}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">{{__('menu.menu-item-photo')}}</span>
                            </a>
                        </li>
                        @endpermission
                        @permission('admin-medias-videos')
                        <li class="m-menu__item " aria-haspopup="true">
                            <a href="{{ route('videos.index') }}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">{{__('menu.menu-item-video')}}</span>
                            </a>
                        </li>
                        @endpermission
                    </ul>
                </div>
            </li>
            <li class="m-menu__item " aria-haspopup="true">
                <a href="{{ route('news.index') }}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-edit"></i>
                    <span class="m-menu__link-text">{{__('menu.menu-news')}}</span>
                </a>
            </li>
            <li class="m-menu__item " aria-haspopup="true">
                <a href="?page=apps/mail/mail&amp;demo=default" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-web"></i>
                    <span class="m-menu__link-text">{{__('menu.menu-carousel')}}</span>
                </a>
            </li>
            @permission('admin-pages')
            <li class="m-menu__item " aria-haspopup="true">
                <a href="{{ route('pages.index') }}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-file"></i>
                    <span class="m-menu__link-text">{{__('menu.menu-content-page')}}</span>
                </a>
            </li>
            @endpermission
            <li class="m-menu__section">
                <h4 class="m-menu__section-text">Formulaires</h4>
                <i class="m-menu__section-icon flaticon-more-v3"></i>
            </li>
            @permission('admin-formulaires')

            <li class="m-menu__item " aria-haspopup="true">
                <a href="{{ route('formulaires.index') }}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-tabs"></i>
                    <span class="m-menu__link-text">{{__('menu.menu-forms-management')}}</span>
                </a>
            </li>
            @endpermission
            <li class="m-menu__section">
                <h4 class="m-menu__section-text">Newsletters</h4>
                <i class="m-menu__section-icon flaticon-more-v3"></i>
            </li>
            @permission('admin-subscribers')
            <li class="m-menu__item " aria-haspopup="true">
                <a href="{{route('groups.index')}}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-users"></i>
                    <span class="m-menu__link-text">{{__('menu.menu-subscriber-groups')}}</span>
                </a>
            </li>
            <li class="m-menu__item " aria-haspopup="true">
                <a href="{{route('subscribers.index')}}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-user-ok"></i>
                    <span class="m-menu__link-text">{{__('menu.menu-subscriber')}}</span>
                </a>
            </li>
            @endpermission
            <li class="m-menu__item " aria-haspopup="true">
                <a href="?page=apps/mail/mail&amp;demo=default" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-multimedia-3"></i>
                    <span class="m-menu__link-text">{{__('menu.menu-newsletter')}}</span>
                </a>
            </li>
            <li class="m-menu__section">
                <h4 class="m-menu__section-text">Demandes</h4>
                <i class="m-menu__section-icon flaticon-more-v3"></i>
            </li>
            <li class="m-menu__item " aria-haspopup="true">
                <a href="{{ route('answers.show', 1) }}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-speech-bubble-1"></i>
                    <span class="m-menu__link-text">{{__('menu.menu-contact')}}</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- END: Aside Menu -->
</div>