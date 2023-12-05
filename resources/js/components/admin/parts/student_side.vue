<template>
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
  
  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
      <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
      </div>
      <div class="sidebar-brand-text mx-3">student</div>
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
  
  <li class="nav-item">
      <router-link class="nav-link collapsed" to="/student/payments" data-toggle="collapse" data-target="#attendance"
          aria-expanded="true" aria-controls="attendance">
          <i class="fas fa-fw fa-cog"></i>
          <span>Account/Payments</span>
      </router-link>
    
  </li>
   
  <li class="nav-item">
      <router-link class="nav-link collapsed" to="/student/show-attendance" data-toggle="collapse" data-target="#attendance"
          aria-expanded="true" aria-controls="attendance">
          <i class="fas fa-fw fa-cog"></i>
          <span>Attendance</span>
      </router-link>
    
  </li>

  <li class="nav-item">
      <router-link class="nav-link collapsed" to="/student/show-notes" data-toggle="collapse" data-target="#notes"
          aria-expanded="true" aria-controls="notes">
          <i class="fas fa-fw fa-cog"></i>
          <span>Notes Management </span>
      </router-link>
      <div id="notes" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Custom Components:</h6>
              <router-link class="collapse-item" to="/student/show-notes">Show Notes</router-link>           
          </div>
      </div>
  </li>
  <li class="nav-item">
      <router-link class="nav-link collapsed" to="/student/show-assignment" data-toggle="collapse" data-target="#Assignment"
          aria-expanded="true" aria-controls="Assignment">
          <i class="fas fa-fw fa-cog"></i>
          <span>Assignment </span>
      </router-link>
      <div id="Assignment" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Custom Components:</h6>
              <router-link class="collapse-item" to="/student/show-assignment">Show Assignment</router-link>           
          </div>
      </div>
  </li>
  <li class="nav-item">
      <router-link class="nav-link collapsed" to="/student/show-class" data-toggle="collapse" data-target="#Class"
          aria-expanded="true" aria-controls="Class">
          <i class="fas fa-fw fa-cog"></i>
          <span> Classes </span>
      </router-link>
     
  </li>
  <li class="nav-item">
      <router-link class="nav-link collapsed" to="/student/marksheet-show" data-toggle="collapse" data-target="#MarksSheet"
          aria-expanded="true" aria-controls="MarksSheet">
          <i class="fas fa-fw fa-cog"></i>
          <span>MarksSheet </span>
      </router-link>
      <div id="MarksSheet" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Custom Components:</h6>
              <router-link class="collapse-item" to="/student/marksheet-show">Marks Sheets</router-link>           
              <router-link class="collapse-item" to="/student/exam-routing">Routing</router-link>           
          </div>
      </div>
  </li>
  <li class="nav-item">
      <router-link class="nav-link collapsed" to="/student/notice" data-toggle="collapse" data-target="#notice"
          aria-expanded="true" aria-controls="notice">
          <i class="fas fa-fw fa-cog"></i>
          <span>Notice  </span>
      </router-link>
      <!-- <div id="notice" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Custom Components:</h6>
              <router-link class="collapse-item" to="/student/notices">Notices</router-link>           
          
          </div>
      </div> -->
  </li>
  </ul>
  </template>