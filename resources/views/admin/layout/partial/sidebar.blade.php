<!--sidebar wrapper -->
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Admin</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{url('admin/dashboard')}}" class="has-arrow">
                <div class=""><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li class="menu-label">Home</li>
        <li>
            <a href="{{ url('admin/home-banner') }}">
                <div class="parent-icon"><i class='bx bx-cookie'></i>
                </div>
                <div class="menu-title">Home Banner</div>
            </a>
        </li>
        <li>
            <a href="{{ url('admin/manage-size') }}">
                <div class="parent-icon"><i class='bx bx-cookie'></i>
                </div>
                <div class="menu-title">Manage Size</div>
            </a>
        </li>
        <li>
            <a href="{{ url('admin/manage-color') }}">
                <div class="parent-icon"><i class='bx bx-cookie'></i>
                </div>
                <div class="menu-title">Manage Color</div>
            </a>
        </li>
        <li>
            <a href="{{ url('admin/manage-coupon') }}">
                <div class="parent-icon"><i class='bx bx-cookie'></i>
                </div>
                <div class="menu-title">Manage Coupon</div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cart'></i>
                </div>
                <div class="menu-title">Attributes</div>
            </a>
            <ul>
                <li> <a href="{{ url('admin/attribute-name') }}"><i class="bx bx-right-arrow-alt"></i>Attribute Name</a></li>
                <li> <a href="{{ url('admin/attribute-value') }}"><i class="bx bx-right-arrow-alt"></i>Attribute Value</a></li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cart'></i>
                </div>
                <div class="menu-title">Category</div>
            </a>
            <ul>
                <li> <a href="{{ url('admin/category') }}"><i class="bx bx-right-arrow-alt"></i>Category</a></li>
                <li> <a href="{{ url('admin/category-attribute') }}"><i class="bx bx-right-arrow-alt"></i>Category Attribute</a></li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cart'></i>
                </div>
                <div class="menu-title">Product</div>
            </a>
            <ul>
                <li> <a href="{{ url('admin/product') }}"><i class="bx bx-right-arrow-alt"></i>Product</a></li>
                {{-- <li> <a href="{{ url('admin/category-attribute') }}"><i class="bx bx-right-arrow-alt"></i>Category Attribute</a></li> --}}
            </ul>
        </li>

        <li class="menu-label">Brand</li>
        <li>
            <a href="{{ url('admin/brand') }}">
                <div class="parent-icon"><i class='bx bx-cookie'></i>
                </div>
                <div class="menu-title">Brand</div>
            </a>
        </li>

        <li class="menu-label">Tax</li>
        <li>
            <a href="{{ url('admin/tax') }}">
                <div class="parent-icon"><i class='bx bx-cookie'></i>
                </div>
                <div class="menu-title">Tax</div>
            </a>
        </li>

        <li class="menu-label">Pages</li>

        <li>
            <a href="{{ url('admin/profile') }}">
                <div class="parent-icon"><i class="bx bx-user-circle"></i>
                </div>
                <div class="menu-title">User Profile</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</div>
<!--end sidebar wrapper -->
