<section>
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="{{asset('backend_asset/images/user.png')}}" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ShopOwner</div>
                    <div class="email">shopowner@email.com</div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">

                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                        <i class="fa fa-list" style="color: #fff; margin-top: 9px;"></i>
                            <span style="font-weight: bold;">Products</span>
                        
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="/category"> 
                                    <i class="fa fa-align-justify" style="color: #fff; margin-top: 6px;"></i>
                                    <span style="font-weight: bold;"> Category </span>
                                </a>
                            </li>

                            <li>
                                <a href="/sub_category">
                                    <i class="fa fa-align-left" style="color: #fff; margin-top: 6px;"></i>
                                    <span style="font-weight: bold;"> Sub Category </span>
                                </a>
                            </li>

                            <li>
                                <a href="/product">
                                    <i class="fa fa-list-alt" style="color: #fff; margin-top: 6px;"></i>
                                    <span style="font-weight: bold;"> Product </span>
                                </a>
                            </li>                          
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="fa fa-users" style="color: #fff; margin-top: 9px;"></i>
                            <span style="font-weight: bold;">People</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="/supplier">
                                    <i class="fa fa-address-card-o" style="color: #fff; margin-top: 6px;"></i>
                                    <span style="font-weight: bold;"> Supplier </span>
                                </a>
                            </li>
                            <li>
                                <a href="/customer">
                                    <i class="fa fa-address-card" style="color: #fff; margin-top: 6px;"></i>
                                    <span style="font-weight: bold;"> Customer </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-user-o" style="color: #fff; margin-top: 6px;"></i>
                                    <span>User</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="fa fa-shopping-bag" style="color: #fff; margin-top: 9px;"></i>
                            <span style="font-weight: bold;">Purchase</span>
                        </a>
                        <ul class="ml-menu">

                            <li>
                                <a href="/purchase_list">
                                    <i class="fa fa-list-ul" style="color: #fff; margin-top: 6px;"></i>
                                    <span style="font-weight: bold;"> Purchase List</span>
                                </a>
                            </li>

                            <li>
                                <a href="/purchase_transaction">
                                    <i class="fa fa-money" style="color: #fff; margin-top: 6px;"></i>
                                    <span style="font-weight: bold;"> Purchase Transaction</span>
                                </a>
                            </li>

                            <li>
                                <a href="/purchase_create">
                                    <i class="fa fa-plus-square" style="color: #fff; margin-top: 6px;"></i>
                                    <span style="font-weight: bold;">Purchase Create</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="fa fa-shopping-cart" style="color: #fff; margin-top: 9px;"></i>
                            <span style="font-weight: bold;">Sales</span>
                        </a>
                        <ul class="ml-menu">

                            <li>
                                <a href="/sale_list">
                                    <i class="fa fa-list-ul" style="color: #fff; margin-top: 6px;"></i>
                                    <span style="font-weight: bold;"> Sale List </span>
                                </a>
                            </li>
                            
                            <li>
                                <a href="/sale_transaction">
                                    <i class="fa fa-money" style="color: #fff; margin-top: 6px;"></i>
                                    <span style="font-weight: bold;"> Sale Transaction </span>
                                </a>
                            </li>

                            <li>
                                <a href="/sale_create">
                                    <i class="fa fa-shopping-basket" style="color: #fff; margin-top: 6px;"></i>
                                    <span style="font-weight: bold;"> POS </span>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="fa fa-sliders" style="color: #fff; margin-top: 9px;"></i>
                            <span style="font-weight: bold;">Configuration</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="#">
                                    <i class="fa fa-cogs" style="color: #fff; margin-top: 6px;"></i>
                                    <span style="font-weight: bold;"> General Settings </span>
                                </a>
                            </li>
                            <li>
                                <a href="/unit">
                                    <i class="fa fa-balance-scale" style="color: #fff; margin-top: 6px;"></i>
                                    <span style="font-weight: bold;">Unit</span>
                                </a>
                            </li>
                            <li>
                                <a href="/vat">
                                    <i class="fa fa-try" style="color: #fff; margin-top: 6px;"></i>
                                    <span style="font-weight: bold;">Vat</span>
                                </a>
                            </li>

                            <li>
                                <a href="/discount">
                                    <i class="fa fa-gift" style="color: #fff; margin-top: 6px;"></i>
                                    <span style="font-weight: bold;">Discount</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="fa fa-files-o" style="color: #fff; margin-top: 9px;"></i>
                            <span style="font-weight: bold;">Reports</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="/stock_report">
                                    <i class="fa fa-database" style="color: #fff; margin-top: 6px;"></i>
                                    <span style="font-weight: bold;"> Stock Report </span>
                                </a>
                            </li>                         
                        </ul>
                    </li>



                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright" style="font-weight: bold; font-size: 14px;">
                    &copy; 2019 - 2020  <br> <a href="javascript:void(0);"><span style="color: black;">Developed by</span> MuKhTeR</a>.
                </div>
            </div>
            <!-- #Footer -->
        </aside>

<section class="content">