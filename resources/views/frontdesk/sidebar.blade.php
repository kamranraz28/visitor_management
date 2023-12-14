<div class="profile-sidebar" style="background-color: #fffcec; min-height: 600px;">

    <nav class="dashboard-menu">
        <!-- Your menu items go here -->
        <ul class="navbar-nav">
            <li>
                <a href="{{route('dashboard')}}">
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{route('department_list')}}">
                    <span>Departments</span>
                </a>
            </li>
            <li>
                <a href="{{route('staff_list')}}">
                    <span>Staffs</span>
                </a>
            </li>

            <li>
                <a href="{{route('reason_list')}}">
                    <span>Reasons</span>
                </a>
            </li>

            <li>
                <a href="{{route('total_visitor')}}">
                    <span>Total Visitor</span>
                </a>
            </li>
            <li>
                <a href="{{route('new_visitor')}}">
                    <span>New Visitors Application</span>
                </a>
            </li>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Reports
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                <a class="dropdown-item" href="{{route('departmentWiseReport')}}">Department wise visiting report</a>
                <a class="dropdown-item" href="{{route('dayWiseReport')}}">Date wise visiting report</a>
                <a class="dropdown-item" href="{{route('reasonWiseReport')}}">Reason wise visiting report</a>
            </div>
        </li>

        <li>
                <a href="{{route('interviewee_registration')}}">
                    <span>Interviewee/Worker Registration</span>
                </a>
            </li>

            <li>
                <a href="{{route('worker_registration')}}">
                    <span>Worker Registration</span>
                </a>
            </li>
        </ul> 
    </nav>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
