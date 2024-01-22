<!-- Header -->
<header class="main-header " id="header">
    <nav class="navbar navbar-static-top navbar-expand-lg">
      <!-- Sidebar toggle button -->
      <button id="sidebar-toggler" class="sidebar-toggle">
        <span class="sr-only">Toggle navigation</span>
      </button>
      <!-- search form -->
      <div class="search-form d-none d-lg-inline-block">
        <div class="input-group">
          <button type="button" name="search" id="search-btn" class="btn btn-flat">
            <i class="mdi mdi-magnify"></i>
          </button>
          <input type="text" name="query" id="search-input" class="form-control" placeholder="Search..."
            autofocus autocomplete="off" />
        </div>
        <div id="search-results-container">
          <ul id="search-results"></ul>
        </div>
      </div>

      <div class="navbar-right ">
        <ul class="nav navbar-nav">
          <!-- User Account -->
          <li class="dropdown user-menu">
            <button href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
              <img src="{{ asset('img/trika.png') }}" class="user-image" alt="User Image" />
              <span class="d-none d-lg-inline-block">{{ auth()->user()->name }}</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-right">
              <!-- User image -->
              <li class="dropdown-header">
                <img src="{{ asset('img/trika.png') }}" class="img-circle" alt="User Image" />
                <div class="d-inline-block">
                  {{ auth()->user()->name }}
                  <small class="pt-1">Role: {{ auth()->user()->role }}</small>
                  <small class="pt-1">{{ auth()->user()->email }}</small>
                </div>
              </li>
              <li class="dropdown-footer">
                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="nav-link d-flex align-items-center gap-2">
                      
                      <i class="mdi mdi-logout"></i>
                      
                      Logout
                    </button>
                </form>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>

