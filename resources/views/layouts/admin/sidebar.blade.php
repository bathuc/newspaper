<ul class="sidebar-menu" data-widget="tree">
    <li class="header">MENU</li>
    <?php $url = URL::current();?>
    <li {{ strpos($url, 'dashboard') ? 'class=active' : '' }} >
        <a href="{{ route('admin.dashboard') }}"><i class="fa fa-link"></i> <span>Dashboard</span></a>
    </li>
    <li {{ strpos($url, 'post') ? 'class=active' : '' }}>
        <a href="{{ route('admin.post') }}"><i class="fa fa-link"></i> <span>Post</span></a>
    </li>
    <li {{ strpos($url, 'caterory') ? 'class=active' : '' }}>
        <a href="{{ route('admin.category') }}"><i class="fa fa-link"></i> <span>Caterory</span></a>
    </li>
</ul>
