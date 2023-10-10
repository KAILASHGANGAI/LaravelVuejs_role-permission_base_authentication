<template>
  <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Admin</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <Router-link class="nav-link" to="/admin">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></Router-link>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Interface
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <router-link class="nav-link collapsed" to="/admin/students" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Students</span>
    </router-link>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Components:</h6>
            <router-link class="collapse-item" to="/admin/add_student">Add Students</router-link>
            <router-link class="collapse-item" to="/admin/student-idcard">Students Id Card</router-link>
           
        </div>
    </div>
</li>

<li class="nav-item">
    <router-link class="nav-link collapsed" to="/admin/staff-details" data-toggle="collapse" data-target="#Staff"
        aria-expanded="true" aria-controls="Staff">
        <i class="fas fa-fw fa-cog"></i>
        <span>Staff members</span>
    </router-link>
    <div id="Staff" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Components:</h6>
            <router-link class="collapse-item" to="/admin/add-staff-members">Add Staff</router-link>           
        </div>
    </div>
</li>
<li class="nav-item">
    <router-link class="nav-link collapsed" to="/admin/period-details" data-toggle="collapse" data-target="#Class"
        aria-expanded="true" aria-controls="Class">
        <i class="fas fa-fw fa-cog"></i>
        <span>Class Management</span>
    </router-link>
    <div id="Class" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Components:</h6>
            <router-link class="collapse-item" to="/admin/add-period">Add Class/Period</router-link>           
        </div>
    </div>
</li>
<li class="nav-item">
    <router-link class="nav-link collapsed" to="/admin/attendance-details" data-toggle="collapse" data-target="#Attendance"
        aria-expanded="true" aria-controls="Attendance">
        <i class="fas fa-fw fa-cog"></i>
        <span>Attendance</span>
    </router-link>
    <div id="Attendance" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Components:</h6>
            <router-link class="collapse-item" to="/admin/add-attendance">Add Attendance</router-link>           
        </div>
    </div>
</li>
<li class="nav-item">
    <router-link class="nav-link collapsed" to="/admin/account-details" data-toggle="collapse" data-target="#Account"
        aria-expanded="true" aria-controls="Account">
        <i class="fas fa-fw fa-cog"></i>
        <span>Account</span>
    </router-link>
    <div id="Account" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Components:</h6>
            <router-link class="collapse-item" to="/admin/payment">Add Payments</router-link>           
            <router-link class="collapse-item" to="/admin/expenditure">Expenditure Records</router-link>           
        </div>
    </div>
</li>
<li class="nav-item">
    <router-link class="nav-link collapsed" to="/admin/show-books" data-toggle="collapse" data-target="#Libreary"
        aria-expanded="true" aria-controls="Libreary">
        <i class="fas fa-fw fa-cog"></i>
        <span>Libreary Management</span>
    </router-link>
    <div id="Libreary" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Components:</h6>
            <router-link class="collapse-item" to="/admin/add-books">Add Books</router-link>           
            <router-link class="collapse-item" to="/admin/take-books">Take Books</router-link>           
            <router-link class="collapse-item" to="/admin/return-books">Return Books</router-link>           
        </div>
    </div>
</li>
<li class="nav-item">
    <router-link class="nav-link collapsed" to="/admin/exam-show" data-toggle="collapse" data-target="#Exam"
        aria-expanded="true" aria-controls="Exam">
        <i class="fas fa-fw fa-cog"></i>
        <span>Exam Management</span>
    </router-link>
    <div id="Exam" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Components:</h6>
            <router-link class="collapse-item" to="/admin/add-exam">Add Exam type</router-link>           
            <router-link class="collapse-item" to="/admin/exam-routing">Routing</router-link>           
        </div>
    </div>
</li>
<li class="nav-item">
    <router-link class="nav-link collapsed" to="/admin/marksheet-show" data-toggle="collapse" data-target="#MarksSheet"
        aria-expanded="true" aria-controls="MarksSheet">
        <i class="fas fa-fw fa-cog"></i>
        <span>MarksSheet </span>
    </router-link>
    <div id="MarksSheet" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Components:</h6>
            <router-link class="collapse-item" to="/admin/marksheet-show">Marks Sheets</router-link>           
            <!-- <router-link class="collapse-item" to="/admin/exam-routing">Routing</router-link>            -->
        </div>
    </div>
</li>
<li class="nav-item">
    <router-link class="nav-link collapsed" to="/admin/show-notes" data-toggle="collapse" data-target="#notes"
        aria-expanded="true" aria-controls="notes">
        <i class="fas fa-fw fa-cog"></i>
        <span>Notes Management </span>
    </router-link>
    <div id="notes" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Components:</h6>
            <router-link class="collapse-item" to="/admin/show-notes">Show Notes</router-link>           
            <router-link class="collapse-item" to="/admin/add-notes">Add Notes</router-link>           
        </div>
    </div>
</li>
<li class="nav-item">
    <router-link class="nav-link collapsed" to="/admin/show-notes" data-toggle="collapse" data-target="#Assignment"
        aria-expanded="true" aria-controls="Assignment">
        <i class="fas fa-fw fa-cog"></i>
        <span>Assignment </span>
    </router-link>
    <div id="Assignment" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Components:</h6>
            <router-link class="collapse-item" to="/admin/show-assignment">Show Assignment</router-link>           
            <router-link class="collapse-item" to="/admin/add-assignment">Add Assignment</router-link>           
        </div>
    </div>
</li>
<!-- Nav Item - Utilities Collapse Menu -->
<!-- <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-wrench"></i>
        <span>Utilities</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Utilities:</h6>
            <a class="collapse-item" href="utilities-color.html">Colors</a>
            <a class="collapse-item" href="utilities-border.html">Borders</a>
            <a class="collapse-item" href="utilities-animation.html">Animations</a>
            <a class="collapse-item" href="utilities-other.html">Other</a>
        </div>
    </div>
</li> -->


<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Administration
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
        aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-fw fa-folder"></i>
        <span>Website Management</span>
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <router-link class="collapse-item" to="/admin/slider">Slider</router-link>           
            <router-link class="collapse-item" to="/admin/about">About</router-link>           
            <router-link class="collapse-item" to="/admin/events">Events</router-link>           
            <router-link class="collapse-item" to="/admin/notices">Notices</router-link>           
            <router-link class="collapse-item" to="/admin/gallery">Gallery</router-link>           
            <router-link class="collapse-item" to="/admin/faculty-members">Faculty Member</router-link>           
            <router-link class="collapse-item" to="/admin/news">News</router-link>           
            <router-link class="collapse-item" to="/admin/testimonials">Testimonials</router-link>           
           
        </div>
    </div>
</li>
<li class="nav-item">
    <router-link class="nav-link collapsed" to="/admin/show-notes" data-toggle="collapse" data-target="#general"
        aria-expanded="true" aria-controls="general">
        <i class="fas fa-fw fa-cog"></i>
        <span>General Setting </span>
    </router-link>
    <div id="general" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Components:</h6>
            <router-link class="collapse-item" to="/admin/subjects">Subjects</router-link>  
            <router-link class="collapse-item" to="/admin/settings">
                            Settings
                        </router-link>        
                        <router-link  class="collapse-item" to="/admin/general-settings">
                            General Details
                        </router-link>
        </div>
    </div>
</li>



<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>



</ul>
</template>