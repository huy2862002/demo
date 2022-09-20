<div class="sidebar">
  <!-- Sidebar user panel (optional) -->
  <div style="text-align: center; margin: 12px auto">
      <a href="{{route('loginForm')}}" class="d-block">NGUYỄN QUANG HUY</a><hr>
  </div>
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
      <li class="nav-item">
        <a href="{{route('server.dashboard')}}" class="nav-link">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>
            Dashboard
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{route('server.category.list')}}" class="nav-link">
          <i class="nav-icon fas fa-th"></i>
          <p>
            Danh Mục
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{route('server.category.list')}}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Danh Sách</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('server.category.addForm')}}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Thêm Mới</p>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a href="{{route('server.product.list')}}" class="nav-link">
          <i class="nav-icon fas fa-copy"></i>
          <p>
            Sản Phẩm
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{route('server.product.list')}}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Danh Sách</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('server.product.addForm')}}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Thêm Mới</p>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a href="{{route('server.order.list')}}" class="nav-link">
          <i class="nav-icon fas fa-edit"></i>
          <p>
            Đơn Hàng
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-chart-pie"></i>
          <p>
            Thống Kê
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{route('server.analysis.order')}}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Đơn Hàng</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/tables/data.html" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Sản Phẩm</p>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">
        <i class="nav-icon far fa-calendar-alt"></i>
          <p>
            Ship Fee
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{route('server.ship.list')}}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Danh Sách</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('server.ship.addForm')}}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Thêm Ship Fee</p>
            </a>
          </li>
        </ul>
      </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon far fa-plus-square"></i>
                <p>
                   Code Giảm Giá
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('server.code.list')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                            Danh Sách
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('server.code.addForm')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                       Thêm Mã
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-columns"></i>
                <p>
                    Thuộc Tính
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('server.att.list')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        Danh Sách
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('server.att.addForm')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        Thêm Thuộc Tính
                    </a>
                </li>
            </ul>
        </li>
      <li class="nav-header">EXAMPLES</li>
      <li class="nav-item">
        <a href="pages/calendar.html" class="nav-link">
          <i class="nav-icon far fa-calendar-alt"></i>
          <p>
            Calendar
            <span class="badge badge-info right">2</span>
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="pages/gallery.html" class="nav-link">
          <i class="nav-icon far fa-image"></i>
          <p>
            Gallery
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="pages/kanban.html" class="nav-link">
          <i class="nav-icon fas fa-columns"></i>
          <p>
            Kanban Board
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon far fa-envelope"></i>
          <p>
            Mailbox
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="pages/mailbox/mailbox.html" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Inbox</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/mailbox/compose.html" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Compose</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/mailbox/read-mail.html" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Read</p>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-book"></i>
          <p>
            Pages
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="pages/examples/invoice.html" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Invoice</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/examples/profile.html" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Profile</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/examples/e-commerce.html" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>E-commerce</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/examples/projects.html" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Projects</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/examples/project-add.html" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Project Add</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/examples/project-edit.html" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Project Edit</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/examples/project-detail.html" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Project Detail</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/examples/contacts.html" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Contacts</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/examples/faq.html" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>FAQ</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/examples/contact-us.html" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Contact us</p>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-search"></i>
          <p>
            Search
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="pages/search/simple.html" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Simple Search</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/search/enhanced.html" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Enhanced</p>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-header">MISCELLANEOUS</li>
      <li class="nav-item">
        <a href="iframe.html" class="nav-link">
          <i class="nav-icon fas fa-ellipsis-h"></i>
          <p>Tabbed IFrame Plugin</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="https://adminlte.io/docs/3.1/" class="nav-link">
          <i class="nav-icon fas fa-file"></i>
          <p>Documentation</p>
        </a>
      </li>
      <li class="nav-header">MULTI LEVEL EXAMPLE</li>
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="fas fa-circle nav-icon"></i>
          <p>Level 1</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-circle"></i>
          <p>
            Level 1
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Level 2</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>
                Level 2
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>Level 3</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>Level 3</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>Level 3</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Level 2</p>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="fas fa-circle nav-icon"></i>
          <p>Level 1</p>
        </a>
      </li>
      <li class="nav-header">LABELS</li>
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon far fa-circle text-danger"></i>
          <p class="text">Important</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon far fa-circle text-warning"></i>
          <p>Warning</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon far fa-circle text-info"></i>
          <p>Informational</p>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.sidebar-menu -->
</div>
