<div class="d-flex flex-column flex-shrink-0 p-3 bg-dark text-white" style="width: 280px; height: 100vh;">
    <a href="{{ route('dashboard') }}"
        class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <span class="fs-4">{{ config('app.name') }}</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <!-- Dashboard - Always visible to authenticated users -->
        <li class="nav-item">
            <a href="{{ route('dashboard') }}"
                class="nav-link @if (request()->routeIs('dashboard')) active @else text-white @endif">
                <i class="fas fa-tachometer-alt me-2"></i>
                Dashboard
            </a>
        </li>

        <!-- Teachers Menu - Only for headmasters -->
        @if (auth()->user()->hasPermission('teachers.view'))
            <li>
                <a href="{{ route('teachers.index') }}"
                    class="nav-link @if (request()->routeIs('teachers.*')) active @else text-white @endif">
                    <i class="fas fa-chalkboard-teacher me-2"></i>
                    Teachers
                </a>
            </li>
        @endif

        <!-- Students Menu -->
        @if (auth()->user()->hasPermission('students.view_all'))
            <li>
                <a href="{{ route('students.index') }}"
                    class="nav-link @if (request()->routeIs('students.index')) active @else text-white @endif">
                    <i class="fas fa-users me-2"></i>
                    @if (auth()->user()->hasPermission('students.view_all'))
                        All Students
                    @else
                        My Students
                    @endif
                </a>
            </li>
        @endif

        <!-- Add Student - For teachers -->
        @if (auth()->user()->hasPermission('students.create'))
            <li>
                <a href="{{ route('students.create') }}"
                    class="nav-link @if (request()->routeIs('students.create')) active @else text-white @endif">
                    <i class="fas fa-user-plus me-2"></i>
                    Add Student
                </a>
            </li>
        @endif

        <!-- Tasks Menu -->
        @php
            $user = auth()->user();
            $isStudent = $user->role === 'student';
            $isActive = request()->routeIs('tasks.index') || request()->routeIs('tasks.student.index');
        @endphp

        @if ($isStudent || $user->role === 'teacher' || $user->role === 'headmaster')
            <li>
                <a href="{{ $isStudent ? route('tasks.student.index') : route('tasks.index') }}"
                    class="nav-link {{ $isActive ? 'active' : 'text-white' }}">
                    <i class="fas fa-tasks me-2"></i>
                    {{ $isStudent ? 'My Tasks' : 'Tasks' }}
                </a>
            </li>
        @endif

        <!-- Announcements Menu -->
        @if (auth()->user()->hasPermission('announcements.view'))
            <li>
                <a href="{{ auth()->user()->hasPermission('announcements.create')
                    ? route('announcements.index')
                    : route('announcements.student.index') }}"
                    class="nav-link @if (request()->routeIs('announcements.*')) active @else text-white @endif">
                    <i class="fas fa-bullhorn me-2"></i>
                    Announcements
                </a>
            </li>
        @endif

        <!-- Profile - Always visible to authenticated users -->
        <li>
            <a href="{{ route('profile.edit') }}"
                class="nav-link @if (request()->routeIs('profile.*')) active @else text-white @endif">
                <i class="fas fa-user me-2"></i>
                Profile
            </a>
        </li>
    </ul>
    <hr>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
            id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://via.placeholder.com/32" alt="Profile" width="32" height="32"
                class="rounded-circle me-2">
            <strong>{{ auth()->user()->name }}</strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item">Sign out</button>
                </form>
            </li>
        </ul>
    </div>
</div>
