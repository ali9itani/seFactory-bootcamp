@if (Auth::guest())
    <div id="header-user-div"  >
        @if(Request::path() == 'login')
            <a class="text-color-white fix-anchor" href="{{ url('/register') }}">Register</a>
        @else 
            <a class="text-color-white fix-anchor" href="{{ url('/login') }}">Login</a>
        @endif
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
            <li><a href="{{ url('profile/me/display') }}" >Edit Profile</a></li>
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