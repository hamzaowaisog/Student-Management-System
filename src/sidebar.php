<?php

if(!isset($_SESSION['username'])){
    header('location:login.php');
}

$role_id = $_SESSION['role'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css"  rel="stylesheet" />
    <link href="output.css"rel="stylesheet" />
</head>
<body>
    
<button data-drawer-target="sidebar-multi-level-sidebar" data-drawer-toggle="sidebar-multi-level-sidebar" aria-controls="sidebar-multi-level-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
   <span class="sr-only">Open sidebar</span>
   <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
   <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
   </svg>
</button>
<?php if($role_id == 1){ ?>
<aside id="sidebar-multi-level-sidebar" class="bg-slate-700 absolute top-0 mt-20 left-0 z-40 w-64 h-screen transition-transform -translate-x-full lg:translate-x-0" aria-label="Sidebar">
   <div class="h-full px-3 py-4 overflow-y-auto bg-slate-700 dark:bg-gray-800">
      <ul class="space-y-2 font-medium">  
         <li>
            <button type="button" class="flex items-center w-full p-2 text-base transition duration-75 rounded-lg group text-xl hover:bg-zinc-400 text-white " aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                  <span class="flex-1 ms-2 text-left whitespace-nowrap">Users</span>
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                     <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                  </svg>
            </button>
            <ul id="dropdown-example" class="hidden ms-3 py-2 space-y-2">
                  <li>
                     <a href="#" class="flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group text-white hover:bg-zinc-400 sidebar-link" data-url="adduser.php">Add user</a>
                  </li>
                  <li>
                     <a href="#" class="flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group text-white hover:bg-zinc-400 sidebar-link" data-url="delete_user.php">Delete user</a>
                  </li>
                  <li>
                    <a href="#"class="flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group text-white hover:bg-zinc-400 sidebar-link" data-url="viewuser.php">View users</a>
                  </li>
            </ul>
         </li>
         <li>
            <button type="button" class="flex items-center w-full p-2 text-base transition duration-75 rounded-lg group text-xl hover:bg-zinc-400 text-white " aria-controls="dropdown-example1" data-collapse-toggle="dropdown-example1">
                  <span class="flex-1 ms-2 text-left whitespace-nowrap">Courses</span>
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                     <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                  </svg>
            </button>
            <ul id="dropdown-example1" class="hidden ms-3 py-2 space-y-2">
                  <li>
                     <a href="#" class="flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group text-white hover:bg-zinc-400 sidebar-link" data-url="addcourse.php">Add Course</a>
                  </li>
                  <li>
                     <a href="#" class="flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group text-white hover:bg-zinc-400 sidebar-link" data-url="deletecourse.php">Delete Course</a>
                  </li>
                  <li>
                    <a href="#"class="flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group text-white hover:bg-zinc-400 sidebar-link"data-url="editcourse.php">Edit Course</a>
                  </li>
            </ul>
         </li>
         <li>
            <button type="button" class="flex items-center w-full p-2 text-base transition duration-75 rounded-lg group text-xl hover:bg-zinc-400 text-white " aria-controls="dropdown-example2" data-collapse-toggle="dropdown-example2">
                  <span class="flex-1 ms-2 text-left whitespace-nowrap">Instructors</span>
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                     <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                  </svg>
            </button>
            <ul id="dropdown-example2" class="hidden ms-3 py-2 space-y-2">
                  <li>
                     <a href="#" class="flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group sidebar-link text-white hover:bg-zinc-400" data-url="assigncourse.php">Assign Course</a>
                  </li>
                  <li>
                     <a href="#" class="flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group sidebar-link text-white hover:bg-zinc-400" data-url="manage_schedule.php">Manage Schedule</a>
                  </li>
                  <li>
                    <a href="#"class="flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group sidebar-link text-white hover:bg-zinc-400" data-url="deleteschedule.php">Remove Schedule</a>
                  </li>
            </ul>
         </li>
            <li>
            <button type="button" class="flex items-center w-full p-2 text-base transition duration-75 rounded-lg group text-xl hover:bg-zinc-400 text-white " aria-controls="dropdown-example3" data-collapse-toggle="dropdown-example3">
                  <span class="flex-1 ms-2 text-left whitespace-nowrap">Grades</span>
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                     <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                  </svg>
            </button>
            <ul id="dropdown-example3" class="hidden ms-3 py-2 space-y-2">
                  <li>
                     <a href="#" class="flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group sidebar-link text-white hover:bg-zinc-400" data-url="viewgradeadmin.php">View Grades</a>
                  </li>
            </ul>
         </li>
         <li>
            <button type="button" class="flex items-center w-full p-2 text-base transition duration-75 rounded-lg group text-xl hover:bg-zinc-400 text-white " aria-controls="dropdown-example4" data-collapse-toggle="dropdown-example4">
                  <span class="flex-1 ms-2 text-left whitespace-nowrap">Attendance</span>
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                     <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                  </svg>
            </button>
            <ul id="dropdown-example4" class="hidden ms-3 py-2 space-y-2">
                  <li>
                     <a href="#" class="flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group sidebar-link text-white hover:bg-zinc-400" data-url="attendanceadmin.php">View Attendance</a>
                  </li>
            </ul>
         </li>
         <li>
            <button type="button" class="flex items-center w-full p-2 text-base transition duration-75 rounded-lg group text-xl hover:bg-zinc-400 text-white " aria-controls="dropdown-example5" data-collapse-toggle="dropdown-example5">
                  <span class="flex-1 ms-2 text-left whitespace-nowrap">Profile</span>
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                     <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                  </svg>
            </button>
            <ul id="dropdown-example5" class="hidden ms-3 py-2 space-y-2">
                  <li>
                     <a href="#" class="flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group sidebar-link text-white hover:bg-zinc-400" data-url="updateprofile.php">Edit Profile</a>
                  </li>
            </ul>
         </li>
      </ul>
   </div>
</aside>
<?php } ?>
<?php if($role_id == 3){ ?>
   <aside id="sidebar-multi-level-sidebar" class="bg-slate-700 absolute top-0 mt-20 left-0 z-40 w-64 h-screen transition-transform -translate-x-full lg:translate-x-0" aria-label="Sidebar">
   <div class="h-full px-3 py-4 overflow-y-auto bg-slate-700 dark:bg-gray-800">
      <ul class="space-y-2 font-medium">  
         <li>
            <button type="button" class="flex items-center w-full p-2 text-base transition duration-75 rounded-lg group text-xl hover:bg-zinc-400 text-white " aria-controls="dropdown-student-1" data-collapse-toggle="dropdown-student-1">
                  <span class="flex-1 ms-2 text-left whitespace-nowrap">My Grades</span>
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                     <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                  </svg>
            </button>
            <ul id="dropdown-student-1" class="hidden ms-3 py-2 space-y-2">
                  <li>
                     <a href="#" class="flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group sidebar-link text-white hover:bg-zinc-400">View Grades</a>
                  </li>
            </ul>
         </li>
         <li>
            <button type="button" class="flex items-center w-full p-2 text-base transition duration-75 rounded-lg group text-xl hover:bg-zinc-400 text-white " aria-controls="dropdown-student-2" data-collapse-toggle="dropdown-student-2">
                  <span class="flex-1 ms-2 text-left whitespace-nowrap">Attendance</span>
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                     <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                  </svg>
            </button>
            <ul id="dropdown-student-2" class="hidden ms-3 py-2 space-y-2">
                  <li>
                     <a href="#" class="flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group sidebar-link text-white hover:bg-zinc-400">View Attendance</a>
                  </li>
            </ul>
         </li>
         <li>
            <button type="button" class="flex items-center w-full p-2 text-base transition duration-75 rounded-lg group text-xl hover:bg-zinc-400 text-white " aria-controls="dropdown-example5" data-collapse-toggle="dropdown-example5">
                  <span class="flex-1 ms-2 text-left whitespace-nowrap">Profile</span>
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                     <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                  </svg>
            </button>
            <ul id="dropdown-example5" class="hidden ms-3 py-2 space-y-2">
                  <li>
                     <a href="#" class="flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group sidebar-link text-white hover:bg-zinc-400" data-url="updateprofile.php">Edit Profile</a>
                  </li>
            </ul>
         </li>
      </ul>
   </div>
</aside>
<?php } ?>
<?php if($role_id == 2){ ?>
   <aside id="sidebar-multi-level-sidebar" class="bg-slate-700 absolute top-0 mt-20 left-0 z-40 w-64 h-screen transition-transform -translate-x-full lg:translate-x-0" aria-label="Sidebar">
   <div class="h-full px-3 py-4 overflow-y-auto bg-slate-700 dark:bg-gray-800">
      <ul class="space-y-2 font-medium">  
         <li>
            <button type="button" class="flex items-center w-full p-2 text-base transition duration-75 rounded-lg group text-xl hover:bg-zinc-400 text-white " aria-controls="dropdown-faculty-1" data-collapse-toggle="dropdown-faculty-1">
                  <span class="flex-1 ms-2 text-left whitespace-nowrap">Attendance</span>
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                     <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                  </svg>
            </button>
            <ul id="dropdown-faculty-1" class="hidden ms-3 py-2 space-y-2">
                  <li>
                     <a href="#" class="flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group sidebar-link text-white hover:bg-zinc-400" data-url="attendancefaculty.php">Take Attendance</a>
                  </li>
            </ul>
         </li>
         <li>
            <button type="button" class="flex items-center w-full p-2 text-base transition duration-75 rounded-lg group text-xl hover:bg-zinc-400 text-white " aria-controls="dropdown-faculty-2" data-collapse-toggle="dropdown-faculty-2">
                  <span class="flex-1 ms-2 text-left whitespace-nowrap">Grades</span>
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                     <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                  </svg>
            </button>
            <ul id="dropdown-faculty-2" class="hidden ms-3 py-2 space-y-2">
                  <li>
                     <a href="#" class="flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group sidebar-link text-white hover:bg-zinc-400" data-url="gradingfaculty.php">Grade Assignments</a>
                  </li>
                  <li>
                     <a href="#" class="flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group sidebar-link text-white hover:bg-zinc-400" data-url="viewgradesfaculty.php">View Grades</a>
                  </li>
            </ul>
         </li>
         <li>
            <button type="button" class="flex items-center w-full p-2 text-base transition duration-75 rounded-lg group text-xl hover:bg-zinc-400 text-white " aria-controls="dropdown-faculty-3" data-collapse-toggle="dropdown-faculty-3">
                  <span class="flex-1 ms-2 text-left whitespace-nowrap">Students</span>
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                     <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                  </svg>
            </button>
            <ul id="dropdown-faculty-3" class="hidden ms-3 py-2 space-y-2">
                  <li>
                     <a href="#" class="flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group sidebar-link text-white hover:bg-zinc-400" data-url="viewstudent.php">View Student</a>
                  </li>
            </ul>
         </li>
         <li>
            <button type="button" class="flex items-center w-full p-2 text-base transition duration-75 rounded-lg group text-xl hover:bg-zinc-400 text-white " aria-controls="dropdown-example5" data-collapse-toggle="dropdown-example5">
                  <span class="flex-1 ms-2 text-left whitespace-nowrap">Profile</span>
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                     <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                  </svg>
            </button>
            <ul id="dropdown-example5" class="hidden ms-3 py-2 space-y-2">
                  <li>
                     <a href="#" class="flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group sidebar-link text-white hover:bg-zinc-400" data-url="updateprofile.php">Edit Profile</a>
                  </li>
            </ul>
         </li>
      </ul>
   </div>
</aside>
<?php } ?>



<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>
