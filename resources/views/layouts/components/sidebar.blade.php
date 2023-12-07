@if(auth()->check())
    <!-- User is logged in, show the sidebar -->
    <aside id="sidebar" class="sidebar">

        <!-- Sidebar Navigation for Dashboard -->
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>
        </ul>

        <!-- Sidebar Navigation for Category -->
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#form-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-tags-fill"></i><span>Category</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="form-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('admin.categories.index') }}">
                            <i class="bi bi-circle"></i><span>List of categories</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.categories.create') }}">
                            <i class="bi bi-circle"></i><span>Create new category</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

        <!-- Sidebar Navigation for Car -->
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-car-front-fill"></i><span>Car</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('admin.cars.index') }}">
                            <i class="bi bi-circle"></i><span>List of cars</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.cars.create') }}">
                            <i class="bi bi-circle"></i><span>Create new car</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

        <!-- Sidebar Navigation for Device -->
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-floppy-fill"></i><span>Device</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('admin.devices.index') }}">
                            <i class="bi bi-circle"></i><span>List of devices</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.devices.create') }}">
                            <i class="bi bi-circle"></i><span>Create new device</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

        <!-- Sidebar Navigation for Product -->
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-box2-heart-fill"></i><span>Product</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="tables-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('admin.products.index') }}">
                            <i class="bi bi-circle"></i><span>List of products</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.products.create') }}">
                            <i class="bi bi-circle"></i><span>Create new product</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

        <!-- Sidebar Navigation for Student -->
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-backpack2-fill"></i><span>Student</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="charts-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('admin.students.index') }}">
                            <i class="bi bi-circle"></i><span>List of students</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.students.create') }}">
                            <i class="bi bi-circle"></i><span>Create new student</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

    </aside>
@else
    <!-- // -->
@endif
