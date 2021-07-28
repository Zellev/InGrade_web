<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav" onclick="myFunction(event)" id="navList">
						@if(auth()->user()->role == 'siswa')
						<li class="{{ Request::is('dashboard') ? 'active' : '' }}"><a href="{{ url('/dashboard') }}"><i class="lnr lnr-home"></i><span>Dashboard</span></a></li>
						<li><a href="siswa/{{auth()->user()->siswa->id}}/profile_ku" class=""><i class="lnr lnr-users"></i><span>Profil Ku</span></a></li>

						@elseif(auth()->user()->role == 'admin')
						<!--form-1-->
						<li class="{{ Request::is('$url') ? 'active' : '' }}"><a href="{{ $url=url('/dashboard') }}"><i class="lnr lnr-home"></i><span>Dashboard</span></a></li>
						<!--form-2-->
						<li class="{{ Request::is('siswa') ? 'active' : '' }}"><a href="{{ url('/siswa') }}" ><i class="lnr lnr-users"></i><span>Siswa</span></a></li>
						<li class="{{ Request::is('guru') ? 'active' : '' }}"><a href="{{ url('/guru') }}" ><i class="lnr lnr-users"></i><span>Guru</span></a></li>
						<li class="{{ Request::is('matpel') ? 'active' : '' }}"><a href="{{ url('/matpel') }}" ><i class="lnr lnr-book"></i><span>Mata Pelajaran</span></a></li>

						@else
						<li class="{{ Request::is('dashboard') ? 'active' : '' }}"><a href="{{ url('/dashboard') }}"><i class="lnr lnr-home"></i><span>Dashboard</span></a></li>
						<li><a href="/guru/{{auth()->user()->guru->id}}/profile_ku" class=""><i class="lnr lnr-user"></i><span>Profil Ku</span></a></li>
						<li class="{{ Request::is('siswa') ? 'active' : '' }}"><a href="{{ url('/siswa') }}" class=""><i class="lnr lnr-users"></i><span>Siswa</span></a></li>	
						@endif
						
					</ul>
				</nav>
		</div>
</div>