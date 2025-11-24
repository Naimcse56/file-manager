<aside class="sidebar-wrapper" data-simplebar="true">
   <div class="sidebar-header">
      <div>
         <img src="{{ asset('assets/images/logo.jpg') }}" class="logo-icon" alt="logo icon">
      </div>
      <div>
         <h4 class="logo-text">{{ env('APP_NAME') }}</h4>
      </div>
      <div class="toggle-icon ms-auto"><i class="bi bi-chevron-double-left"></i></div>
   </div>

   <!--navigation-->
   <ul class="metismenu" id="menu">

      <li>
         <a href="{{route('home')}}">
            <div class="parent-icon"><i class="bi bi-house-door"></i>
            </div>
            <div class="menu-title">Dashboard</div>
         </a>
      </li>
      {{-- USER MANAGEMENT / SYSTEM SETTING --}}
      @canany(['role-list', 'user-list'])
      <li>
         <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="bi bi-grid"></i></div>
            <div class="menu-title">User Management</div>
         </a>
         <ul>
            @can('user-list')
            <li class="@if (Route::is('user.*')) mm-active @endif">
               <a href="{{ route('user.index') }}">
                  <i class="bi bi-arrow-right-short"></i>User Information
               </a>
            </li>
            @endcan

            @canany(['role-list','role-permission'])
            <li class="@if (Route::is('user-management.*')) mm-active @endif">
               <a href="{{ route('user-management.role-index') }}">
                  <i class="bi bi-arrow-right-short"></i>Role Permission Assign
               </a>
            </li>
            @endcanany

            @can('user-list')
            <li class="@if (Route::is('email_configure')) mm-active @endif">
               <a href="{{ route('email_configure') }}">
                  <i class="bi bi-arrow-right-short"></i>Email Config
               </a>
            </li>
            @endcan
         </ul>
      </li>
      @endcanany


      {{-- FILE MANAGER --}}
      <li class="@if (Route::is('file-manager.*') || Route::is('folder.*')) mm-active @endif">
         <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="bi bi-folder2-open"></i></div>
            <div class="menu-title">File Manager</div>
         </a>
         <ul>
            <li class="@if (Route::is('file-manager.index')) mm-active @endif">
               <a href="{{ route('file-manager.index') }}">
                  <i class="bi bi-arrow-right-short"></i>All Files
               </a>
            </li>

            <li class="@if (Route::is('folder.index')) mm-active @endif">
               <a href="{{ route('folder.index') }}">
                  <i class="bi bi-arrow-right-short"></i>Folders
               </a>
            </li>

            <li class="@if (Route::is('file-manager.upload')) mm-active @endif">
               <a href="{{ route('file-manager.upload') }}">
                  <i class="bi bi-arrow-right-short"></i>Upload Files
               </a>
            </li>

            <li class="@if (Route::is('file-manager.trash')) mm-active @endif">
               <a href="{{ route('file-manager.trash') }}">
                  <i class="bi bi-arrow-right-short"></i>Recycle Bin
               </a>
            </li>
         </ul>
      </li>


      {{-- SHARED FILE LINKS --}}
      <li class="@if (Route::is('share-links.*')) mm-active @endif">
         <a href="{{ route('share-links.index') }}">
            <div class="parent-icon"><i class="bi bi-share"></i></div>
            <div class="menu-title">Shared Files</div>
         </a>
      </li>


      {{-- ACTIVITY LOG (Admin Only) --}}
      <li class="@if (Route::is('activity-log.*')) mm-active @endif">
         <a href="{{ route('activity-log.index') }}">
            <div class="parent-icon"><i class="bi bi-clipboard-data"></i></div>
            <div class="menu-title">Activity Logs</div>
         </a>
      </li>

   </ul>
   <!--end navigation-->
</aside>
