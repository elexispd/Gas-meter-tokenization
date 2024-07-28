<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('dist/img/entak_logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Entak Energy LTD.</span>
    </a>

    <div class="sidebar">
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item menu-open">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('dashboard*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                @can('create', auth()->user())
                <li class="nav-item">
                    <a href="#" class="nav-link {{ strpos(Route::currentRouteName(), 'admin.') === 0  ? 'active' : '' }} ">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Admins
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        @can('show', auth()->user())
                            <li class="nav-item">
                                <a href="{{ route('admin.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add Admin</p>
                                </a>
                            </li>
                        @endcan

                        <li class="nav-item">
                            <a href="{{ route('admin.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Admins</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan



                @can('admins', auth()->user())
                <li class="nav-item">
                    <a href="#" class="nav-link {{ strpos(Route::currentRouteName(), 'user.tenant.') === 0 ? 'active' : '' }} ">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Tenants
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('show', auth()->user())
                        <li class="nav-item">
                            <a href="{{ route('user.tenant.add') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Tenant</p>
                            </a>
                        </li>
                        @endcan
                        <li class="nav-item">
                            <a href="{{ route('user.tenant.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Tenant</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan


                @can('notEndUser', auth()->user())
                <li class="nav-item">
                    <a href="#" class="nav-link {{ strpos(Route::currentRouteName(), 'user.') === 0 && !str_contains(Route::currentRouteName(), 'tenant') ? 'active' : '' }} ">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            End-Users
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        @can('show', auth()->user())
                            <li class="nav-item">
                                <a href="{{ route('user.add') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add End-User</p>
                                </a>
                            </li>
                        @endcan

                        @if(auth()->user()->is_tenant)
                            <li class="nav-item">
                                <a href="{{ route('user.tenant.consumers', auth()->user()) }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>View End-User</p>
                                </a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('user.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>View End-User</p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
                @endcan

                @can('notEndUser', auth()->user())
                <li class="nav-item">
                    <a href="#" class="nav-link {{ Route::currentRouteNamed('plant.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-building"></i>
                        <p>
                            Plants
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('show', auth()->user())
                        <li class="nav-item">
                            <a href="{{ route('plant.add') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Plant</p>
                            </a>
                        </li>
                        @endcan
                        @if(auth()->user()->is_tenant)
                            <li class="nav-item">
                                <a href="{{ route('user.tenant.plants', auth()->user()) }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>View Plants</p>
                                </a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('plant.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>View Plants</p>
                                </a>
                            </li>
                        @endif

                    </ul>
                </li>
                @endcan

                @can('admins', auth()->user())
                <li class="nav-item">
                    <a href="#" class="nav-link {{ Route::currentRouteNamed('price.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-money-bill"></i>
                        <p>
                            Pricing
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('show', auth()->user())
                        <li class="nav-item">
                            <a href="{{ route('price.add') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Price</p>
                            </a>
                        </li>
                        @endcan
                        <li class="nav-item">
                            <a href="{{ route('price.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Prices</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan

                @can('token', auth()->user())

                <li class="nav-item">
                    <a href="{{ route('price.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-gas-pump"></i>
                        <p>
                            Gas Price
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-coins"></i>
                        <p>
                            Meter Token
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('purchase.add') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Purchase Token</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-comment"></i>
                        <p>
                            Complaint
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('complaint.admin.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Raise Complaint</p>
                            </a>
                        </li>

                    </ul>
                </li>


                @endcan


                @can('admins', auth()->user())
                <li class="nav-item">
                    <a href="#" class="nav-link {{ strpos(Route::currentRouteName(), 'payment.') === 0  ? 'active' : '' }} ">
                        <i class="nav-icon fas fa-credit-card"></i>
                        <p>
                            Payment Report
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('payment.search') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Generate Report</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-comment"></i>
                        <p>
                            Complaint
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('complaint.admin.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Complaints</p>
                            </a>
                        </li>

                    </ul>
                </li>
                @endcan
                @if(auth()->user()->is_tenant)

                <li class="nav-item">
                    <a href="{{ route('price.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-gas-pump"></i>
                        <p>
                            Gas Price
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link {{ strpos(Route::currentRouteName(), 'payment.') === 0  ? 'active' : '' }} ">
                        <i class="nav-icon fas fa-credit-card"></i>
                        <p>
                            Purchase Report
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('payment.tenant.search') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Generate Report</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-comment"></i>
                        <p>
                            Complaint
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('complaint.admin.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Raise Complaint</p>
                            </a>
                        </li>

                    </ul>
                </li>
                @endcan



                @can('show', auth()->user())

                <li class="nav-item">

                    <a href="#" class="nav-link {{ strpos(Route::currentRouteName(), 'audit.') === 0  ? 'active' : '' }}">
                        <i class="nav-icon fas fa-briefcase"></i>
                        <p>
                            Career
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('career.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Publish Vacancy</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('career.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Vacancies</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">

                    <a href="#" class="nav-link {{ strpos(Route::currentRouteName(), 'audit.') === 0  ? 'active' : '' }}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            News
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('news.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Upload News</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('news.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View News</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">

                    <a href="#" class="nav-link {{ strpos(Route::currentRouteName(), 'audit.') === 0  ? 'active' : '' }}">
                        <i class="nav-icon fas fa-history"></i>
                        <p>
                            Audit Log
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('audit.search') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Generate Log</p>
                            </a>
                        </li>
                    </ul>

                </li>
                @endcan


                <li class="nav-item">
                    <a href="{{ route('password.create') }}" class="nav-link">
                        <i class="nav-icon fas fa-key"></i>
                        <p>
                            Change Password
                        </p>
                    </a>

                </li>

                <li class="nav-item">
                    <a href="{{ route('user.show', auth()->user()->id) }}" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Profile
                        </p>
                    </a>

                </li>

                <li class="nav-item mt-2">
                    <form action="{{ route('logout') }}" method="post" class="text-center">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            Logout
                        </button>
                    </form>

                </li>

            </ul>
        </nav>
    </div>
</aside>

