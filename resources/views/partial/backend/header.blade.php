      <nav class="navbar">
          <a href="#" class="sidebar-toggler">
              <i data-feather="menu"></i>
          </a>
          <div class="navbar-content">
              <form class="search-form">
                  <div class="input-group">
                      <div class="input-group-text">
                          <i data-feather="search"></i>
                      </div>
                      <input type="text" class="form-control" id="navbarForm" placeholder="ابحث هنا ...">
                  </div>
              </form>
              <ul class="navbar-nav">

                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button"
                          data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i data-feather="bell"></i>
                          <div class="indicator">
                              <div class="circle"></div>
                          </div>
                      </a>
                      <div class="dropdown-menu p-0" aria-labelledby="notificationDropdown">
                          <div class="px-3 py-2 d-flex align-items-center justify-content-between border-bottom">
                              <p>الاشعارات</p>
                              <a href="javascript:;" class="text-muted">مسح</a>
                          </div>

                          <div class="px-3 py-2 d-flex align-items-center justify-content-center border-top">
                              <a href="javascript:;">عرض الكل</a>
                          </div>
                      </div>
                  </li>
                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
                          data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <img class="wd-30 ht-30 rounded-circle" src="#" alt="التفاصيل الشخصيه">
                      </a>
                      <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
                          <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
                              <div class="mb-3">
                                  @if (auth()->user()->user_image != '')
                                      <img class="wd-80 ht-80 rounded-circle"
                                          src="{{ asset('assets/users/' . auth()->user()->user_image) }}"
                                          alt="">
                                  @else
                                      <img class="wd-80 ht-80 rounded-circle"
                                          src="{{ asset('assets/users/avatar.svg') }}" alt="">
                                  @endif
                              </div>
                              <div class="text-center">
                                  <p class="tx-16 fw-bolder">{{ auth()->user()->full_name }}</p>
                                  <p class="tx-12 text-muted"> {{ auth()->user()->email }}</p>
                              </div>
                          </div>
                          <ul class="list-unstyled p-1">
                              <li class="dropdown-item py-2">
                                  <a href="{{ route('admin.account_settings') }}" class="text-body ms-0">
                                      <i class="me-2 icon-md" data-feather="user"></i>
                                      <span>الملف الشخصي</span>
                                  </a>
                              </li>
                              @if (auth()->check() &&
                                      auth()->user()->hasRole('admin') &&
                                      auth()->user()->ability('admin', 'manage_supervisors,show_supervisors'))
                                  <li class="dropdown-item py-2">
                                      <a class="text-body ms-0" href="{{ route('admin.supervisors.index') }}">
                                          <i class="me-2 icon-md" data-feather="shield"></i>
                                          <span>المشرفين</span>
                                      </a>
                                  </li>
                              @endif


                              <li class="dropdown-item py-2">
                                  <a class="text-body ms-0" href="javascript:void(0);"
                                      onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                      <i class="me-2 icon-md" data-feather="log-out"></i>
                                      <span>تسجيل خروج</span>
                                  </a>
                                  <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                      @csrf
                                  </form>
                              </li>

                          </ul>
                      </div>
                  </li>
              </ul>
          </div>
      </nav>
