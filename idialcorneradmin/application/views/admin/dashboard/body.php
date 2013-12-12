
<body data-show-sidebar-toggle-button="true" data-fixed-sidebar="false">


<!--creative-->
<div id="wrapper">
<header id="header" class="navbar navbar-inverse">
    <div class="navbar-inner">
        <div class="container">
            <div class="brand-wrap pull-left">
                <div class="brand-img">
                    <a class="brand" href="#">
                        <img src="{base_url}/images/iDialLogo.png" alt="" style="width: 60px;">
                    </a>
                </div>
            </div>

            <div id="header-right" class="clearfix">
                <div id="nav-toggle" data-toggle="collapse" data-target="#navigation" class="collapsed">
                    <i class="icon-caret-down"></i>
                </div>
                <div id="header-functions" class="pull-right">
                    <div id="user-info" class="clearfix">
                                <span class="info">
                                	Welcome
                                    <span class="name">Admin iDial</span>
                                </span>
                        <div class="avatar">
                            <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                                <img src="{base_url}images/pp.jpg" alt="Avatar">
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="profile.html"><i class="icol-user"></i> My Profile</a></li>
                                <li><a href="#"><i class="icol-layout"></i> My Invoices</a></li>
                                <li class="divider"></li>
                                <li><a href="{site_url}action/logout"><i class="icol-key"></i> Logout</a></li>
                            </ul>
                        </div>
                    </div>
                   {html_logout}
                </div>
            </div>
        </div>
    </div>
</header>

<div id="content-wrap">
<div id="content">
<div id="content-outer">
<div id="content-inner">
<aside id="sidebar">
    <nav id="navigation" class="collapse">
        <ul>
            <li {dashboard}>
                 <span title="General">
                    <i class="icon-home"></i>
				    <span class="nav-title">General</span>
                  </span>
                <ul class="inner-nav">
                    <li><a href="{site_url}dashboard"><i class="icol-dashboard"></i> Dashboard</a></li>
                    <li><a href="{site_url}config"><i class="icol-cog"></i> Main Store</a></li>
                    <li><a href="{site_url}background"><i class="icol-cog"></i> Web Background colour</a></li>

                </ul>
            </li>
            <li {catalog}>
                <span title="Table">
                    <i class="icon-mobile-phone"></i>
				    <span class="nav-title">Catalog</span>
                </span>
                <ul class="inner-nav">
                    <li><a href="{site_url}category"><i class="icol-databases"></i>Manage Category</a></li>
                    <li><a href="{site_url}brand"><i class="icos-tags"></i> Manage Brand</a></li>
                    <li><a href="{site_url}product"><i class="icos-iphone-3g"></i>Manage Products</a></li>

                </ul>
            </li><!---->
            <li {extra}>
                <span title="Extra">
                    <i class="icon-gift"></i>
					<span class="nav-title">Extra</span>
                </span>
                <ul class="inner-nav">
                    <li><a href="{site_url}page"><i class="icol-plugin"></i> Page</a></li>
                    <li><a href="{site_url}subscriber"><i class="icol-user"></i> Subscriber</a></li>

                </ul>
            </li>

        </ul>
    </nav>
</aside>

<div id="sidebar-separator"></div>

    <section id="main" class="clearfix">
        <div id="main-header" class="page-header">
            <ul class="breadcrumb">
                <li>
                    <i class="icon-home"></i>iDial
                    <span class="divider">&raquo;</span>
                </li>
                <li>
                    <a href="{site_url}{pageContentLink}">{pageContent}</a>
                </li>
            </ul>

            <h1 id="main-heading">
                {pageContent} <span>{pageContent2}</span>
            </h1>

        </div>
