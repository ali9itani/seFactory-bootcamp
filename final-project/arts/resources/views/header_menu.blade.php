@if (Auth::guest())
    <div id="header-user-div"  >
        <a class="text-color-white" href="{{ url('/login') }}">Login</a>
    </div>
@else
    <!-- username and user icon tat is clickableto select an option -->
    <div id="header-user-div" class="header-icons" >
        <span>{{ Auth::user()->username }}</span>
        <i id="options-icon" class="fa fa-user cursor-pointer"></i>
    </div>
    <div  id="header-options-block">
      <div class="arrow-up"></div>
      <div class="header-options-menu">
        <ul class="fix-list-ul header-options-ul">
            <li><a href="">Edit Profile</a></li>
            <li><a href="">Teams</a></li>
            <li><a href="">Followings</a></li>
            <li><a  class="fix-anchor" href="{{ url('/logout') }}"
            onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
            Logout
            </a></li>

            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </ul>
      </div>
    </div>
@endif