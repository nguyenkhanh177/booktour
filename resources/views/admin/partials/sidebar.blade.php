<aside class="app-navbar">
    <!-- begin sidebar-nav -->
    <div class="sidebar-nav scrollbar scroll_light">
        <ul class="metismenu " id="sidebarNav">
            <li><a href="{{ route('admin') }}" aria-expanded="false"><i class="nav-icon ti ti-comment"></i><span
                        class="nav-title">Trang chủ</span></a> </li>
            <li><a href="{{ route('admin.tour') }}" aria-expanded="false"><i class="nav-icon ti ti-email"></i><span
                        class="nav-title">Tour</span></a> </li>
            <li><a href="{{ route('admin.hotel') }}" aria-expanded="false"><i class="nav-icon ti ti-user"></i><span
                        class="nav-title">Hotel</span></a> </li>
            <li><a href="{{ route('admin.restaurant') }}" aria-expanded="false"><i class="nav-icon ti ti-user"></i><span
                        class="nav-title">Restaurant</span></a> </li>
            <li><a href="{{ route('admin.car') }}" aria-expanded="false"><i class="nav-icon ti ti-user"></i><span
                        class="nav-title">Car</span></a> </li>
            <li><a href="{{ route('admin.menu') }}" aria-expanded="false"><i class="nav-icon ti ti-user"></i><span
                        class="nav-title">Menu</span></a> </li>
            <li><a href="{{ route('admin.booking.index') }}" aria-expanded="false"><i
                        class="nav-icon ti ti-user"></i><span class="nav-title">Booking</span></a> </li>
            <li><a href="{{ route('admin.user.index') }}" aria-expanded="false"><i class="nav-icon ti ti-user"></i><span
                        class="nav-title">User</span></a> </li>
            {{-- <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i
                        class="nav-icon ti ti-calendar"></i><span class="nav-title">Calendar</span></a>
                <ul aria-expanded="false">
                    <li> <a href='calendar-full.html'>Full Calendar</a> </li>
                    <li> <a href='calendar-list.html'>Calendar List</a> </li>
                </ul>
            </li> --}}
        </ul>
    </div>
    <!-- end sidebar-nav -->
</aside>