<div id="sidebar-nav" class="sidebar">
	<div class="sidebar-scroll">
		<nav>
			<ul class="nav">
				<li><a href="/" class="@if (Request::segment(1) == '') active @endif"><i class="lnr lnr-home"></i> <span>Главная</span></a></li>
				<li>
					<a href="#subTemplates" data-toggle="collapse" class="@if ((in_array(Request::segment(1), array('templates')) && in_array(Request::segment(2), array('1','2','3'))) || (in_array(Request::segment(1), array('aliases')) && in_array(Request::segment(2), array('1','2','3')))) active @else collapsed @endif"><i class="lnr lnr-book"></i> <span>Шаблоны</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
					<div id="subTemplates" class="@if ((in_array(Request::segment(1), array('templates')) && in_array(Request::segment(2), array('1','2','3'))) || (in_array(Request::segment(1), array('aliases')) && in_array(Request::segment(2), array('1','2','3')))) collapse in @else collapse @endif">
						<ul class="nav">
							<li><a href="/templates/1" class="@if ((Request::segment(1) == 'templates' && Request::segment(2) == '1') || (in_array(Request::segment(1), array('aliases')) && Request::segment(2) == '1')) active @endif"><i class="lnr lnr-file-empty"></i> <span>Оферты</span></a></li>
							<li><a href="/templates/2" class="@if ((Request::segment(1) == 'templates' && Request::segment(2) == '2') || (in_array(Request::segment(1), array('aliases')) && Request::segment(2) == '2')) active @endif"><i class="lnr lnr-file-empty"></i> <span>Заявления</span></a></li>
						</ul>
					</div>
				</li>
				<li>
					<a href="#subDirectories" data-toggle="collapse" class="@if (in_array(Request::segment(1), array('users','okopfs','countries','prefixes'))) active @else collapsed @endif"><i class="lnr lnr-list"></i> <span>Справочники</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
					<div id="subDirectories" class="@if (in_array(Request::segment(1), array('users','okopfs','countries','prefixes'))) collapse in @else collapse @endif">
						<ul class="nav">
							<li><a href="/users" class="@if (Request::segment(1) == 'users') active @endif"><i class="lnr lnr-users"></i> <span>Операторы</span></a></li>
							<li><a href="/okopfs" class="@if (Request::segment(1) == 'okopfs') active @endif"><i class="lnr lnr-layers"></i> <span>ОКОПФ</span></a></li>
							<li><a href="/countries" class="@if (Request::segment(1) == 'countries') active @endif"><i class="lnr lnr-earth"></i> <span>Страны</span></a></li>
							<li><a href="/prefixes" class="@if (Request::segment(1) == 'prefixes') active @endif"><i class="lnr lnr-pilcrow"></i> <span>Префиксы</span></a></li>
						</ul>
					</div>
				</li>
				<li><a href="/log" class="@if (Request::segment(1) == 'log') active @endif"><i class="lnr lnr-layers"></i> <span>Лог доступа</span></a></li>
				<li><a href="/settings" class="@if (Request::segment(1) == 'settings') active @endif"><i class="lnr lnr-cog"></i> <span>Настройки</span></a></li>
				<li><a href="/email-registry" class="@if (Request::segment(1) == 'email-registry') active @endif"><i class="lnr lnr-list"></i> <span>Реестр E-mail адресов</span></a></li>
			</ul>
		</nav>
	</div>
</div>
