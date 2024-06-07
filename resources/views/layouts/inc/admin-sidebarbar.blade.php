@if(auth()->check())
@if(auth()->user()->role === 'admin')
<!-- Admin sidebar navigation -->
<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="{{ url('/admin/dashboard')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <!-- Admin specific links -->
                <div class="sb-sidenav-menu-heading">Manage</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseClientsAdmin" aria-expanded="false" aria-controls="collapseClientsAdmin">
                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                    Manage Clients
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseClientsAdmin" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('admin.clients.index') }}">View Clients</a>
                        <a class="nav-link" href="{{ route('admin.clients.create') }}">Add Client</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseVehiclesAdmin" aria-expanded="false" aria-controls="collapseVehiclesAdmin">
                    <div class="sb-nav-link-icon"><i class="fas fa-car"></i></div>
                    Manage Vehicles
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseVehiclesAdmin" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('admin.vehicles.index') }}">View Vehicles</a>
                        <a class="nav-link" href="{{ route('admin.vehicles.create') }}">Add Vehicle</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseRepairsAdmin" aria-expanded="false" aria-controls="collapseRepairsAdmin">
                    <div class="sb-nav-link-icon"><i class="fas fa-tools"></i></div>
                    Manage Repairs
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseRepairsAdmin" aria-labelledby="headingThree" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('admin.repairs.index') }}">View Repairs</a>
                        <a class="nav-link" href="{{ route('admin.repairs.create') }}">Add Repair</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseSparePartsAdmin" aria-expanded="false" aria-controls="collapseSparePartsAdmin">
                    <div class="sb-nav-link-icon"><i class="fas fa-cogs"></i></div>
                    Manage Spare Parts
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseSparePartsAdmin" aria-labelledby="headingFour" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('admin.spare_parts.index')}}">View Spare Parts</a>
                     
                    </nav>
                </div>
                <!-- Manage invoices -->
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseInvoicesAdmin" aria-expanded="false" aria-controls="collapseInvoicesAdmin">
                    <div class="sb-nav-link-icon"><i class="fas fa-file-invoice"></i></div>
                    Manage Invoices
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseInvoicesAdmin" aria-labelledby="headingFive" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('admin.invoices.index') }}">View Invoices</a>
                        <a class="nav-link" href="{{ route('admin.invoices.create') }}">Add Invoice</a>
                        <a class="nav-link" href="{{ route('admin.invoices.report') }}">Report Invoice</a>
                    </nav>
                </div>
                <!-- Manage appointments -->
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseAppointmentsAdmin" aria-expanded="false" aria-controls="collapseAppointmentsAdmin">
                    <div class="sb-nav-link-icon"><i class="fas fa-calendar-alt"></i></div>
                    Manage Appointments
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseAppointmentsAdmin" aria-labelledby="headingSix" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('admin.appointments.index') }}">View Appointments</a>
                        <a class="nav-link" href="{{ route('admin.appointments.create') }}">Add Appointment</a>
                    </nav>
                </div>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as: Admin</div>
            <!-- Display admin name or any other info here -->
        </div>
    </nav>
</div>


@elseif (auth()->user()->role === 'mechanic')
    <!-- Mechanic sidebar navigation -->
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link {{ Request::route()->named('mechanic.dashboard') ? 'active' : '' }}" href="{{ route('mechanic.dashboard') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <!-- Mechanic specific links -->
                    <div class="sb-sidenav-menu-heading">Manage</div>
                    
                    <!-- Manage Repairs -->
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseRepairsMechanic" aria-expanded="false" aria-controls="collapseRepairsMechanic">
                        <div class="sb-nav-link-icon"><i class="fas fa-tools"></i></div>
                        Manage Repairs
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseRepairsMechanic" aria-labelledby="headingRepairs" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link {{ Request::route()->named('mechanic.repairs.index') ? 'active' : '' }}" href="{{ route('mechanic.repairs.index') }}">View Repairs</a>
                            <a class="nav-link {{ Request::route()->named('mechanic.repairs.create') ? 'active' : '' }}" href="{{ route('mechanic.repairs.create') }}">Create Repair</a>
                        </nav>
                    </div>

                    <!-- Manage Appointments -->
                    <a class="nav-link {{ Request::route()->named('mechanic.appointments.index') ? 'active' : '' }}" href="{{ route('mechanic.appointments.index') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-calendar-alt"></i></div>
                        Manage Appointments
                    </a>

                    <!-- Manage Spare Parts -->
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseSparePartsMechanic" aria-expanded="false" aria-controls="collapseSparePartsMechanic">
                        <div class="sb-nav-link-icon"><i class="fas fa-cogs"></i></div>
                        Manage Spare Parts
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseSparePartsMechanic" aria-labelledby="headingSpareParts" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link {{ Request::route()->named('mechanic.spare_parts.index') ? 'active' : '' }}" href="{{ route('mechanic.spare_parts.index') }}">View Spare Parts</a>
                        </nav>
                    </div>

                    
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as: Mechanic</div>
                <!-- Display mechanic name or any other info here -->
            </div>
        </nav>
    </div>




        @elseif(auth()->user()->role === 'client')
        <!-- Client sidebar navigation -->
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link {{ Request::route()->named('client.dashboard') ? 'active' : '' }}" href="{{ route('client.dashboard') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Manage</div>
                        <a class="nav-link {{ Request::route()->named('client.appointments.create') || Request::route()->named('client.appointments.store') || Request::route()->named('client.appointments.index') ? 'active' : '' }}" href="{{ route('client.appointments.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-calendar-alt"></i></div>
                            Appointments
                        </a>
                        <a class="nav-link {{ Request::route()->named('client.invoices.index') || Request::route()->named('client.invoices.show') ? 'active' : '' }}" href="{{ route('client.invoices.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-file-invoice"></i></div>
                            Invoices
                        </a>
                        <a class="nav-link {{ Request::route()->named('client.repairs.history') ? 'active' : '' }}" href="{{ route('client.repairs.history') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-tools"></i></div>
                            Repairs
                        </a>
                        <a class="nav-link {{ Request::route()->named('client.vehicles.index') || Request::route()->named('client.vehicles.create') || Request::route()->named('client.vehicles.edit') ? 'active' : '' }}" href="{{ route('client.vehicles.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-car"></i></div>
                            Vehicles
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as: Client</div>
                    <!-- Display client name or any other info here -->
                </div>
            </nav>
        </div>
    @endif
@endif