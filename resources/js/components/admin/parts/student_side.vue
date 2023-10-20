<template>
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
  
  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
      <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
      </div>
      <div class="sidebar-brand-text mx-3">Students</div>
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
      <router-link class="nav-link collapsed" to="/admin/show-notes" data-toggle="collapse" data-target="#attendance"
          aria-expanded="true" aria-controls="attendance">
          <i class="fas fa-fw fa-cog"></i>
          <span>Attendance</span>
      </router-link>
      <div id="attendance" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Custom Components:</h6>
              <router-link class="collapse-item" to="/admin/show-notes">Show Notes</router-link>           
              <router-link class="collapse-item" to="/admin/add-notes">Add Notes</router-link>           
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
  <li class="nav-item">
      <router-link class="nav-link collapsed" to="/admin/show-notes" data-toggle="collapse" data-target="#Class"
          aria-expanded="true" aria-controls="Class">
          <i class="fas fa-fw fa-cog"></i>
          <span> Class Management </span>
      </router-link>
      <div id="Class" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Custom Components:</h6>
              <router-link class="collapse-item" to="/admin/show-notes">Show Notes</router-link>           
              <router-link class="collapse-item" to="/admin/add-notes">Add Notes</router-link>           
          </div>
      </div>
  </li>
  <li class="nav-item">
      <router-link class="nav-link collapsed" to="/admin/show-notes" data-toggle="collapse" data-target="#Marks"
          aria-expanded="true" aria-controls="Marks">
          <i class="fas fa-fw fa-cog"></i>
          <span>Marks Management </span>
      </router-link>
      <div id="Marks" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Custom Components:</h6>
              <router-link class="collapse-item" to="/admin/show-notes">Show Notes</router-link>           
              <router-link class="collapse-item" to="/admin/add-notes">Add Notes</router-link>           
          </div>
      </div>
  </li>
  <li class="nav-item">
      <router-link class="nav-link collapsed" to="/admin/show-notes" data-toggle="collapse" data-target="#notes"
          aria-expanded="true" aria-controls="notes">
          <i class="fas fa-fw fa-cog"></i>
          <span>Notice  </span>
      </router-link>
      <div id="notes" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Custom Components:</h6>
              <router-link class="collapse-item" to="/admin/show-notes">Show Notes</router-link>           
              <router-link class="collapse-item" to="/admin/add-notes">Add Notes</router-link>           
          </div>
      </div>
  </li>
  </ul>
  </template>