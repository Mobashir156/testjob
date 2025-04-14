<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <span class="nav-link">
                        {{ auth()->user()->role === 'headmaster' ? 'Headmaster' : (auth()->user()->role === 'teacher' ? 'Teacher' : 'Student') }} Dashboard
                    </span>
                </li>
            </ul>
        </div>
    </div>
</nav>
