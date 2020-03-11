@php
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\DB;
    use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

    $langue_code = app()->getLocale();
    $langue_selected = DB::table('languages')->where('code',$langue_code)->first()->native_name;

@endphp

<header id="m_header" class="m-grid__item    m-header " m-minimize-offset="200" m-minimize-mobile-offset="200">
    <div class="m-container m-container--fluid m-container--full-height">
        <div class="m-stack m-stack--ver m-stack--desktop">
            <!-- BEGIN: Brand -->
            <div class="m-stack__item m-brand  m-brand--skin-dark ">
                <div class="m-stack m-stack--ver m-stack--general">
                    <div class="m-stack__item m-stack__item--middle m-brand__logo">
                        <a href="{{route('admin.dashboard')}}" class="m-brand__logo-wrapper">
                            <img alt="" src="{{ themes('demo/default/media/img/logo/logo_default_dark.png') }}"/>
                        </a>
                    </div>
                    <div class="m-stack__item m-stack__item--middle m-brand__tools">

                        <!-- BEGIN: Left Aside Minimize Toggle -->
                        <a href="javascript:;" id="m_aside_left_minimize_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-desktop-inline-block">
                            <span></span>
                        </a>
                        <!-- END -->

                        <!-- BEGIN: Responsive Aside Left Menu Toggler -->
                        <a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
                            <span></span>
                        </a>
                        <!-- END -->



                        <!-- BEGIN: Responsive Header Menu Toggler -->
                        <a id="m_aside_header_menu_mobile_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
                            <span></span>
                        </a>
                        <!-- END -->


                        <!-- BEGIN: Topbar Toggler -->

                        <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
                            <i class="flaticon-more"></i>
                        </a>
                        <!-- BEGIN: Topbar Toggler -->
                    </div>
                </div>
            </div>
            <!-- END: Brand -->
            <div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
                <!-- BEGIN: Horizontal Menu -->
                <button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-dark " id="m_aside_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
                <!-- END: Horizontal Menu -->
                <!-- BEGIN: Topbar -->
                <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
                    <div class="m-stack__item m-topbar__nav-wrapper">
                        <ul class="m-topbar__nav m-nav m-nav--inline">
                            <li class="m-nav__item m-topbar__quick-actions m-topbar__quick-actions--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push m-dropdown--mobile-full-width m-dropdown--skin-light" m-dropdown-toggle="click">
                                <a href="{{LaravelLocalization::getLocalizedURL('fr', null, [], true)}}" class="m-portlet__nav-link m-dropdown__toggle btn m-btn m-btn--link" style="margin: 15px 0 0 0;">
                                    <i class="fa fa-language"></i>
                                    <span class="langname"> {{__('header.header-dropdown-language-selected', ['selected' =>  $langue_selected])}} </span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <div class="m-dropdown__wrapper" style="width: 140px">
                                    <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust" style="left: auto; right: 30px;"></span>
                                    <div class="m-dropdown__inner">
                                        <div class="m-dropdown__header m--align-center" style="background-color: #6f47d0; background-size: cover;">
                                            <div class="m-card-user m-card-user--skin-dark">
                                                <div class="m-card-user__details">
                                                    <span class="m-card-user__name m--font-weight-500" style="align-items: center;">{{__('header.header-dropdown-language-label')}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="m-dropdown__body">
                                            <div class="m-dropdown__content">
                                                <ul class="m-nav m-nav--skin-light">
                                                    <li class="m-nav__item">
                                                        <a href="{{LaravelLocalization::getLocalizedURL('en', null, [], true)}}" class="m-nav__link">
                                                            <img alt="" src="{{ asset('storage/photos/flag/us.png')}}"> English </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="{{LaravelLocalization::getLocalizedURL('fr', null, [], true)}}" class="m-nav__link">
                                                            <img alt="" src="{{ asset('storage/photos/flag/fr.png')}}"> Français </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>


                        </ul>
                    </div>
                    <div class="m-stack__item m-topbar__nav-wrapper">
                        <ul class="m-topbar__nav m-nav m-nav--inline">
                            <li class="m-nav__item m-topbar__quick-actions m-topbar__quick-actions--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push m-dropdown--mobile-full-width m-dropdown--skin-light" m-dropdown-toggle="click">

                                <a href="#" class="m-nav__link m-dropdown__toggle">
                                    <span class="m-nav__link-badge m-badge m-badge--dot m-badge--info m--hide"></span>
                                    <span class="m-topbar__userpic">
                                        @if (Auth::user()->avatar == NULL)
                                            <img src="{{asset('/img/default.png')}}" class="m--img-rounded m--marginless">
                                        @else
                                            <img src="{{asset('/storage/avatar/')}}/{{Auth::user()->avatar}}" class="m--img-rounded m--marginless">
                                        @endif

                                    </span>
                                </a>
                                <div class="m-dropdown__wrapper">
                                    <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                    <div class="m-dropdown__inner">
                                        <div class="m-dropdown__header m--align-center" style="background-color: #6f47d0; background-size: cover;">
                                            <div class="m-card-user m-card-user--skin-dark" >
                                                <div class="m-card-user m-card-user--skin-dark">

                                                    <div class="m-card-user__pic">
                                                        @if (Auth::user()->avatar == NULL)
                                                            <img src="{{asset('/img/default.png')}}" class="m--img-rounded m--marginless" alt="">
                                                        @else
                                                            <img src="{{asset('/storage/avatar/')}}/{{Auth::user()->avatar}}" class="m--img-rounded m--marginless">
                                                        @endif
                                                        <!--
                                                        <span class="m-type m-type--lg m--bg-danger"><span class="m--font-light">S<span><span>
                                                        -->
                                                    </div>
                                                    <div class="m-card-user__details">
                                                        <span class="m-card-user__name m--font-weight-500">{{ Auth::user()->name }}</span>
                                                        <a href="{{route('profils.index')}}" class="m-card-user__email m--font-weight-300 m-link">{{ Auth::user()->email }}</a>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                        <div class="m-dropdown__body">
                                            <div class="m-dropdown__content">
                                                <ul class="m-nav m-nav--skin-light">
                                                    <li class="m-nav__section m--hide">
                                                        <span class="m-nav__section-text">Section</span>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="{{route('profils.index')}}" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-profile-1"></i>
                                                            <span class="m-nav__link-title">
                                                                <span class="m-nav__link-wrap">
                                                                    <span class="m-nav__link-text">{{__('header.header-dropwdown-profile')}}</span>
                                                                </span>
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__separator m-nav__separator--fit">
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="{{ route('admin.logout') }}" class="btn m-btn--pill btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">{{__('header.header-dropwdown-logout')}}</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <!--
                            <li id="m_quick_sidebar_toggle" class="m-nav__item">
                                <a href="#" class="m-nav__link m-dropdown__toggle">
                                    <span class="m-nav__link-icon"><i class="flaticon-grid-menu"></i></span>
                                </a>
                            </li>
                            -->
                        </ul>
                    </div>
                </div>
                <!-- END: Topbar -->
            </div>
        </div>
    </div>
</header>