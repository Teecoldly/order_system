  <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin5">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="p-t-30">
                    <?php  if($_SESSION["status_user"]==2 || $_SESSION["status_user"]==3 ){?>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="index.php" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">หน้าแรก</span></a></li>
                    <?php  } ?>
                      <?php  if($_SESSION["status_user"]==1 || $_SESSION["status_user"]==3 ){?>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="personnel.php" aria-expanded="false"><i class="mdi mdi-account"></i><span class="hide-menu">บุคลากร</span></a></li>
                        <?php } ?>
                        <?php  if($_SESSION["status_user"]==3){?>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="semester.php" aria-expanded="false"><i class="mdi mdi-calendar"></i><span class="hide-menu">เพิ่มปีการศึกษา</span></a></li>
                        <?php } ?>
                     
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-book"></i><span class="hide-menu">วิชา</span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="subject.php" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu">เพิ่มการสอน</span></a></li>
                                <li class="sidebar-item"><a href="subject_type.php" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu">เพิ่มวิชา</span></a></li>
                            </ul>
                        </li>
                     
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-paperclip"></i><span class="hide-menu">จัดการวัสดุ</span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="product.php" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu">ข้อมูลสินค้า</span></a></li>
                                <li class="sidebar-item"><a href="product_type.php" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu">ข้อมูลประเภทสินค้า</span></a></li>
                            </ul>
                        </li>
                        <?php  if($_SESSION["status_user"]==2 || $_SESSION["status_user"]==3 ){?>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="history_order.php" aria-expanded="false"><i class="mdi mdi-history"></i><span class="hide-menu">ประวัติรายการขอซื้อวัสดุ</span></a></li>
                        <?php  } ?>
  
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== --> 