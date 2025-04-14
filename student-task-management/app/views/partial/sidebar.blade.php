<div class="d-flex flex-column flex-shrink-0 p-3 bg-dark text-white" style="width: 280px; height: 100vh;">
    <a href="{{ route('dashboard') }}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <span class="fs-4">{{ config('app.name') }}</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link @if(request()->routeIs('dashboard')) active @else text-white @endif">
                <i class="fas fa-tachometer-alt me-2"></i>
                Dashboard
            </a>
        </li>

        @can('createTeacher', App\Models\User::class)
            <li>
                <a href="{{ route('teachers.index') }}" class="nav-link @if(request()->routeIs('teachers.*')) active @else text-white @endif">
                    <i class="fas fa-chalkboard-teacher me-2"></i>
                    Teachers
                </a>
            </li>
            <li>
                <a href="{{ route('students.index') }}" class="nav-link @if(request()->routeIs('students.index')) active @else text-white @endif">
                    <i class="fas fa-users me-2"></i>
                    All Students
                </a>
            </li>
            <li>
                <a href="{{ route('announcements.index') }}" class="nav-link @if(request()->routeIs('announcements.*')) active @else text-white @endif">
                    <i class="fas fa-bullhorn me-2"></i>
                    Announcements
                </a>
            </li>
        @endcan

        @can('createStudent', App\Models\User::class)
            <li>
                <a href="{{ route('students.create') }}" class="nav-link @if(request()->routeIs('students.create')) active @else text-white @endif">
                    <i class="fas fa-user-plus me-2"></i>
                    Add Student
                </a>
            </li>
            <li>
                <a href="{{ route('students.index') }}" class="nav-link @if(request()->routeIs('students.index')) active @else text-white @endif">
                    <i class="fas fa-users me-2"></i>
                    My Students
                </a>
            </li>
            <li>
                <a href="{{ route('tasks.index') }}" class="nav-link @if(request()->routeIs('tasks.index')) active @else text-white @endif">
                    <i class="fas fa-tasks me-2"></i>
                    Tasks
                </a>
            </li>
        @endcan

        @if(auth()->user()->isStudent())
            <li>
                <a href="{{ route('tasks.student.index') }}" class="nav-link @if(request()->routeIs('tasks.student.*')) active @else text-white @endif">
                    <i class="fas fa-tasks me-2"></i>
                    My Tasks
                </a>
            </li>
            <li>
                <a href="{{ route('announcements.student.index') }}" class="nav-link @if(request()->routeIs('announcements.student.*')) active @else text-white @endif">
                    <i class="fas fa-bullhorn me-2"></i>
                    Announcements
                </a>
            </li>
        @endif

        <li>
            <a href="{{ route('profile.edit') }}" class="nav-link @if(request()->routeIs('profile.*')) active @else text-white @endif">
                <i class="fas fa-user me-2"></i>
                Profile
            </a>
        </li>
    </ul>
    <hr>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://via.placeholder.com/32" alt="Profile" width="32" height="32" class="rounded-circle me-2">
            <strong>{{ auth()->user()->name }}</strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item">Sign out</button>
                </form>
            </li>
        </ul>
    </div>
</div>
