<!-- Left Sidebar Start -->
<div class="app-sidebar-menu">
    <div class="h-100" data-simplebar>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <div class="logo-box">
                <a href="{{ route('second', ['dashboard', 'index'])}}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="/images/logo-sm.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="/images/logo-light.png" alt="" height="24">
                    </span>
                </a>
                <a href="{{ route('second', ['dashboard', 'index'])}}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="/images/logo-sm.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="/images/logo-dark.png" alt="" height="24">
                    </span>
                </a>
            </div>

            <ul id="side-menu">

                <li class="menu-title">Menu</li>

                <li>
                    <a href="#sidebarDashboards" data-bs-toggle="collapse">
                        <i data-feather="home"></i>
                        <span> Dashboard </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarDashboards">
                        <ul class="nav-second-level">
                             <li><a href="{{ route('second', ['dashboard', 'index'])}}" class="tp-link">CRM</a></li>
                             <li><a href="{{ route('second', ['dashboard', 'ecommerce'])}}" class="tp-link">eCommerce</a></li>
                        </ul>
                    </div>
                </li>
                <li class="menu-title">Profile</li>
                <li>
                    <a href="#sidebarProfile" data-bs-toggle="collapse">
                        <i data-feather="database"></i>
                        <span> Profile </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarProfile">
                      <ul class="nav-second-level">
                        <li><a  href="{{ route('any', 'setting/profiles')}}" class="tp-link" wire:current>Information</a></li>
                        <li><a  href="{{ route('any', 'profile/companies')}}" class="tp-link" wire:current>Companies</a></li>
                        <li><a  href="{{ route('any', 'profile/regions') }}" class="tp-link" wire:current>Regions</a></li>
                        <li><a  href="{{ route('any', 'profile/departs') }}" class="tp-link" wire:current>Departs</a></li>
                      </ul>
                    </div>
                </li>
                <li>
                    <a href="#sidebarMaster" data-bs-toggle="collapse">
                        <i data-feather="archive"></i>
                        <span> Master </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarMaster">
                      <ul class="nav-second-level">
                        <li><a href="{{ route('any', 'master/employees')}}" class="tp-link" wire:current>Employees</a></li>
                        <li><a href="{{ route('any', 'master/suppliers')}}" class="tp-link" wire:current>Suppliers</a></li>
                        <li><a href="{{ route('any', 'master/customers')}}" class="tp-link" wire:current>Customers</a></li>
                        <li><a href="{{ route('any', 'master/expeditons')}}" class="tp-link" wire:current>Expeditions</a></li>
                      </ul>
                    </div>
                </li>
                <li>
                    <a href="#sidebarProduct" data-bs-toggle="collapse">
                        <i data-feather="server"></i>
                        <span> Product </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarProduct">
                      <ul class="nav-second-level">
                        <li><a href="{{ route('any', 'product/prodsetting')}}" class="tp-link" wire:current>Setting</a></li>
                        <li><a href="{{ route('any', 'product/products')}}" class="tp-link" wire:current>Products</a></li>
                      </ul>
                    </div>
                </li>
                <li class="menu-title">Inventory</li>
                <li>
                    <a href="#sidebarInventory" data-bs-toggle="collapse">
                        <i data-feather="bookmark"></i>
                        <span> Purchase </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarInventory">
                      <ul class="nav-second-level">
                        <li><a  href="{{ route('any', 'inventory/intorder')}}" class="tp-link" wire:current>Internal Order</a></li>
                        <li><a  href="{{ route('any', 'inventory/quorder')}}" class="tp-link" wire:current>Quotation Order</a></li>
                        <li><a  href="{{ route('any', 'inventory/puorder')}}" class="tp-link" wire:current>Purchase Order</a></li>
                        <li><a  href="{{ route('any', 'inventory/mutout')}}" class="tp-link" wire:current>Mutation Out</a></li>
                        <li><a  href="{{ route('any', 'inventory/mutin')}}" class="tp-link" wire:current>Mutation In</a></li>
                    </ul>
                    </div>
                </li>
                <li class="menu-title">Sales</li>
                <li>
                    <a href="#sidebarcoffee" data-bs-toggle="collapse">
                        <i data-feather="coffee"></i>
                        <span> Cafe / Resto</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarcoffee">
                      <ul class="nav-second-level">
                        <li><a href="{{ route('second', ['error', 'error-404'])}}" class="tp-link" wire:current>Dashboard</a></li>
                        <li><a href="{{ route('second', ['error', 'error-404'])}}" class="tp-link" wire:current>Cafe Table</a></li>
                        <li><a href="{{ route('second', ['error', 'error-404'])}}" class="tp-link" wire:current>Cafe Product</a></li>
                        <li><a href="{{ route('second', ['error', 'error-404'])}}" class="tp-link" wire:current>Cafe Cashier</a></li>
                        <li><a href="{{ route('second', ['error', 'error-404'])}}" class="tp-link" wire:current>Cafe Waiters</a></li>
                        <li><a href="{{ route('second', ['error', 'error-404'])}}" class="tp-link" wire:current>Cafe Kitchen</a></li>
                    </ul>
                    </div>
                </li>
                <li>
                    <a href="#sidebarSales" data-bs-toggle="collapse">
                        <i data-feather="shopping-cart"></i>
                        <span> Sales Retail</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarSales">
                      <ul class="nav-second-level">
                        <li><a href="{{ route('second', ['error', 'error-404'])}}" class="tp-link" wire:current>Price List</a></li>
                        <li><a href="{{ route('second', ['error', 'error-404'])}}" class="tp-link" wire:current>Retail</a></li>
                        <li><a href="{{ route('second', ['error', 'error-404'])}}" class="tp-link" wire:current>Service</a></li>
                    </ul>
                    </div>
                </li>
                 <li>
                    <a href="#sidebarDelivery" data-bs-toggle="collapse">
                        <i data-feather="truck"></i>
                        <span> Delivery</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarDelivery">
                      <ul class="nav-second-level">
                        <li><a href="{{ route('any', 'sales/delivery')}}" class="tp-link" wire:current>Delivery</a></li>
                        <li><a href="{{ route('any', 'sales/return')}}" class="tp-link" wire:current>Return</a></li>
                    </ul>
                    </div>
                </li>
                <li class="menu-title">Finance</li>
                <li>
                    <a href="#sidebartrello" data-bs-toggle="collapse">
                        <i data-feather="trello"></i>
                        <span> Accounting</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebartrello">
                      <ul class="nav-second-level">
                        <li><a href="{{ route('second', ['error', 'error-404'])}}" class="tp-link" wire:current>Chart Of Account</a></li>
                        <li><a href="{{ route('second', ['error', 'error-404'])}}" class="tp-link" wire:current>Initial Balance</a></li>
                        <li><a href="{{ route('second', ['error', 'error-404'])}}" class="tp-link" wire:current>Cash / Bank In</a></li>
                        <li><a href="{{ route('second', ['error', 'error-404'])}}" class="tp-link" wire:current>Cash / Bank Out</a></li>
                        <li><a href="{{ route('second', ['error', 'error-404'])}}" class="tp-link" wire:current>Jurnal Transaction</a></li>
                        <li><a href="{{ route('second', ['error', 'error-404'])}}" class="tp-link" wire:current>Jurnal Adjusment</a></li>
                      </ul>
                    </div>
                </li>
                <li>
                    <a href="#sidebarRepfinance" data-bs-toggle="collapse">
                        <i data-feather="clipboard"></i>
                        <span> Reporting</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarRepfinance">
                      <ul class="nav-second-level">
                        <li><a href="{{ route('second', ['error', 'error-404'])}}" class="tp-link" wire:current>Ledger</a></li>
                        <li><a href="{{ route('second', ['error', 'error-404'])}}" class="tp-link" wire:current>Expend</a></li>
                     </ul>
                    </div>
                </li>
                <li class="menu-title">Website</li>
                <li>
                    <a href="#sidebarWebsite" data-bs-toggle="collapse">
                        <i data-feather="globe"></i>
                        <span> Website</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarWebsite">
                      <ul class="nav-second-level">
                        <li><a href="{{ route('any', 'website/configs')}}" class="tp-link" wire:current>Config</a></li>
                        <li><a href="{{ route('any', 'website/category')}}" class="tp-link" wire:current>Category</a></li>
                        <li><a href="{{ route('any', 'website/clients')}}" class="tp-link" wire:current>Clients</a></li>
                        <li><a href="{{ route('any', 'website/downloads')}}" class="tp-link" wire:current>Downloads</a></li>
                        <li><a href="{{ route('any', 'website/gallerys')}}" class="tp-link" wire:current>Gallerys</a></li>
                        <li><a href="{{ route('any', 'website/news')}}" class="tp-link" wire:current>News</a></li>
                        <li><a href="{{ route('any', 'website/promos')}}" class="tp-link" wire:current>Promo</a></li>
                        <li><a href="{{ route('any', 'website/services')}}" class="tp-link" wire:current>Services</a></li>
                        <li><a href="{{ route('any', 'website/staffs')}}" class="tp-link" wire:current>Staff</a></li>
                        <li><a href="{{ route('any', 'website/videos')}}" class="tp-link" wire:current>Videos</a></li>
                     </ul>
                    </div>
                </li>
                <li class="menu-title">Pages</li>
                <li>
                    <a href="#sidebarAuth" data-bs-toggle="collapse">
                        <i data-feather="users"></i>
                        <span> Authentication </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarAuth">
                        <ul class="nav-second-level">
                             <li><a href="{{ route('second', ['auth', 'login'])}}" class="tp-link">Log In</a></li>
                             <li><a href="{{ route('second', ['auth', 'register'])}}" class="tp-link">Register</a></li>
                             <li><a href="{{ route('second', ['auth', 'recoverpw'])}}" class="tp-link">Recover Password</a></li>
                             <li><a href="{{ route('second', ['auth', 'lockscreen'])}}" class="tp-link">Lock Screen</a></li>
                             <li><a href="{{ route('second', ['auth', 'confirm-mail'])}}" class="tp-link">Confirm Mail</a></li>
                             <li><a href="{{ route('second', ['auth', 'verification'])}}" class="tp-link">Email Verification</a></li>
                             <li><a href="{{ route('second', ['auth', 'logout'])}}" class="tp-link">Logout</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#sidebarError" data-bs-toggle="collapse">
                        <i data-feather="alert-octagon"></i>
                        <span> Error Pages </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarError">
                        <ul class="nav-second-level">
                             <li><a href="{{ route('second', ['error', 'error-404'])}}" class="tp-link">Error 404</a></li>
                             <li><a href="{{ route('second', ['error', 'error-500'])}}" class="tp-link">Error 500</a></li>
                             <li><a href="{{ route('second', ['error', 'error-503'])}}" class="tp-link">Error 503</a></li>
                             <li><a href="{{ route('second', ['error', 'error-429'])}}" class="tp-link">Error 429</a></li>
                             <li><a href="{{ route('second', ['error', 'offline-page'])}}" class="tp-link">Offline Page</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#sidebarExpages" data-bs-toggle="collapse">
                        <i data-feather="file-text"></i>
                        <span> Utility </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarExpages">
                        <ul class="nav-second-level">
                             <li><a href="{{ route('second', ['utility', 'starter'])}}" class="tp-link">Starter</a></li>
                             <li><a href="{{ route('second', ['utility', 'profile'])}}" class="tp-link">Profile</a></li>
                             <li><a href="{{ route('second', ['utility', 'pricing'])}}" class="tp-link">Pricing</a></li>
                             <li><a href="{{ route('second', ['utility', 'timeline'])}}" class="tp-link">Timeline</a></li>
                             <li><a href="{{ route('second', ['utility', 'invoice'])}}" class="tp-link">Invoice</a></li>
                             <li><a href="{{ route('second', ['utility', 'faqs'])}}" class="tp-link">FAQs</a></li>
                             <li><a href="{{ route('second', ['utility', 'gallery'])}}" class="tp-link">Gallery</a></li>
                             <li><a href="{{ route('second', ['utility', 'maintenance'])}}" class="tp-link">Maintenance</a></li>
                             <li><a href="{{ route('second', ['utility', 'coming-soon'])}}" class="tp-link">Coming Soon</a></li>
                        </ul>
                    </div>
                </li>
                <li class="menu-title mt-2">Apps</li>
                <li>
                    <a href="{{ route('any', 'todolist')}}" class="tp-link">
                        <i data-feather="columns"></i>
                        <span> Todo List </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('any', 'contacts')}}" class="tp-link">
                        <i data-feather="map-pin"></i>
                        <span> Contacts </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('any', 'calendar')}}" class="tp-link">
                        <i data-feather="calendar"></i>
                        <span> Calendar </span>
                    </a>
                </li>
                <li class="menu-title mt-2">General</li>
                <li>
                    <a href="#sidebarBaseui" data-bs-toggle="collapse">
                        <i data-feather="package"></i>
                        <span> Components </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarBaseui">
                        <ul class="nav-second-level">
                             <li><a href="{{ route('second', ['components', 'accordions'])}}" class="tp-link">Accordions</a></li>
                             <li><a href="{{ route('second', ['components', 'alerts'])}}" class="tp-link">Alerts</a></li>
                             <li><a href="{{ route('second', ['components', 'badges'])}}" class="tp-link">Badges</a></li>
                             <li><a href="{{ route('second', ['components', 'breadcrumb'])}}" class="tp-link">Breadcrumb</a></li>
                             <li><a href="{{ route('second', ['components', 'buttons'])}}" class="tp-link">Buttons</a></li>
                             <li><a href="{{ route('second', ['components', 'cards'])}}" class="tp-link">Cards</a></li>
                             <li><a href="{{ route('second', ['components', 'collapse'])}}" class="tp-link">Collapse</a></li>
                             <li><a href="{{ route('second', ['components', 'dropdowns'])}}" class="tp-link">Dropdowns</a></li>
                             <li><a href="{{ route('second', ['components', 'video'])}}" class="tp-link">Embed Video</a></li>
                             <li><a href="{{ route('second', ['components', 'grid'])}}" class="tp-link">Grid</a></li>
                             <li><a href="{{ route('second', ['components', 'images'])}}" class="tp-link">Images</a></li>
                             <li><a href="{{ route('second', ['components', 'list'])}}" class="tp-link">List Group</a></li>
                             <li><a href="{{ route('second', ['components', 'modals'])}}" class="tp-link">Modals</a></li>
                             <li><a href="{{ route('second', ['components', 'placeholders'])}}" class="tp-link">Placeholders</a></li>
                             <li><a href="{{ route('second', ['components', 'pagination'])}}" class="tp-link">Pagination</a></li>
                             <li><a href="{{ route('second', ['components', 'popovers'])}}" class="tp-link">Popovers</a></li>
                             <li><a href="{{ route('second', ['components', 'progress'])}}" class="tp-link">Progress</a></li>
                             <li><a href="{{ route('second', ['components', 'scrollspy'])}}" class="tp-link">Scrollspy</a></li>
                             <li><a href="{{ route('second', ['components', 'spinners'])}}" class="tp-link">Spinners</a></li>
                             <li><a href="{{ route('second', ['components', 'tabs'])}}" class="tp-link">Tabs</a></li>
                             <li><a href="{{ route('second', ['components', 'tooltips'])}}" class="tp-link">Tooltips</a></li>
                             <li><a href="{{ route('second', ['components', 'typography'])}}" class="tp-link">Typography</a></li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="{{ route('any', 'widgets')}}" class="tp-link">
                        <i data-feather="aperture"></i>
                        <span> Widgets </span>
                    </a>
                </li>

                <li>
                    <a href="#sidebarAdvancedUI" data-bs-toggle="collapse">
                        <i data-feather="cpu"></i>
                        <span> Extended UI </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarAdvancedUI">
                        <ul class="nav-second-level">
                             <li><a href="{{ route('second', ['extended', 'carousel'])}}" class="tp-link">Carousel</a></li>
                             <li><a href="{{ route('second', ['extended', 'notifications'])}}" class="tp-link">Notifications</a></li>
                             <li><a href="{{ route('second', ['extended', 'offcanvas'])}}" class="tp-link">Offcanvas</a></li>
                             <li><a href="{{ route('second', ['extended', 'range-slider'])}}" class="tp-link">Range Slider</a></li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarIcons" data-bs-toggle="collapse">
                        <i data-feather="award"></i>
                        <span> Icons </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarIcons">
                        <ul class="nav-second-level">
                             <li><a href="{{ route('second', ['icons', 'feather-icons'])}}" class="tp-link">Feather Icons</a></li>
                             <li><a href="{{ route('second', ['icons', 'mdi-icons'])}}" class="tp-link">Material Design Icons</a></li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarForms" data-bs-toggle="collapse">
                        <i data-feather="briefcase"></i>
                        <span> Forms </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarForms">
                        <ul class="nav-second-level">
                             <li><a href="{{ route('second', ['forms', 'elements'])}}" class="tp-link">General Elements</a></li>
                             <li><a href="{{ route('second', ['forms', 'validation'])}}" class="tp-link">Validation</a></li>
                             <li><a href="{{ route('second', ['forms', 'quilljs'])}}" class="tp-link">Quilljs Editor</a></li>
                             <li><a href="{{ route('second', ['forms', 'pickers'])}}" class="tp-link">Picker</a></li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarTables" data-bs-toggle="collapse">
                        <i data-feather="table"></i>
                        <span> Tables </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarTables">
                        <ul class="nav-second-level">
                             <li><a href="{{ route('second', ['tables', 'basic'])}}" class="tp-link">Basic Tables</a></li>
                             <li><a href="{{ route('second', ['tables', 'datatables'])}}" class="tp-link">Data Tables</a></li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarCharts" data-bs-toggle="collapse">
                        <i data-feather="pie-chart"></i>
                        <span> Apex Charts </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarCharts">
                        <ul class="nav-second-level">
                             <li><a href="{{ route('second', ['charts', 'line'])}}" class="tp-link">Line</a></li>
                             <li><a href="{{ route('second', ['charts', 'area'])}}" class="tp-link">Area</a></li>
                             <li><a href="{{ route('second', ['charts', 'column'])}}" class="tp-link">Column</a></li>
                             <li><a href="{{ route('second', ['charts', 'bar'])}}" class="tp-link">Bar</a></li>
                             <li><a href="{{ route('second', ['charts', 'mixed'])}}" class="tp-link">Mixed</a></li>
                             <li><a href="{{ route('second', ['charts', 'timeline'])}}" class="tp-link">Timeline</a></li>
                             <li><a href="{{ route('second', ['charts', 'rangearea'])}}" class="tp-link">Range Area</a></li>
                             <li><a href="{{ route('second', ['charts', 'funnel'])}}" class="tp-link">Funnel</a></li>
                             <li><a href="{{ route('second', ['charts', 'candlestick'])}}" class="tp-link">Candlestick</a></li>
                             <li><a href="{{ route('second', ['charts', 'boxplot'])}}" class="tp-link">Boxplot</a></li>
                             <li><a href="{{ route('second', ['charts', 'bubble'])}}" class="tp-link">Bubble</a></li>
                             <li><a href="{{ route('second', ['charts', 'scatter'])}}" class="tp-link">Scatter</a></li>
                             <li><a href="{{ route('second', ['charts', 'heatmap'])}}" class="tp-link">Heatmap</a></li>
                             <li><a href="{{ route('second', ['charts', 'treemap'])}}" class="tp-link">Treemap</a></li>
                             <li><a href="{{ route('second', ['charts', 'pie'])}}" class="tp-link">Pie</a></li>
                             <li><a href="{{ route('second', ['charts', 'radialbar'])}}" class="tp-link">Radialbar</a></li>
                             <li><a href="{{ route('second', ['charts', 'radar'])}}" class="tp-link">Radar</a></li>
                             <li><a href="{{ route('second', ['charts', 'polararea'])}}" class="tp-link">Polar</a></li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarMaps" data-bs-toggle="collapse">
                        <i data-feather="map"></i>
                        <span> Maps </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarMaps">
                        <ul class="nav-second-level">
                             <li><a href="{{ route('second', ['maps', 'googlemap'])}}" class="tp-link">Google Maps</a></li>
                             <li><a href="{{ route('second', ['maps', 'vectormap'])}}" class="tp-link">Vector Maps</a></li>
                        </ul>
                    </div>
                </li>

            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
</div>
<!-- Left Sidebar End -->
