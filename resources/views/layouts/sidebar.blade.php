  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview">
          <a href="{{ url('/') }}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="treeview">
          <a href="{{ url('manage/akun') }}">
            <i class="fa fa-child"></i>
            <span>Akun</span>
          </a>
        </li>
        <li class="treeview">
          <a href="{{ url('manage/datamaster') }}">
            <i class="fa fa-database"></i>
            <span>Input Data Master</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="fa fa-folder"></i>
            <span>Inventori</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('manage/inventori') }}"><i class="fa fa-circle-o"></i> Barang</a></li>
            <li><a href="{{ url('manage/tipemerk') }}"><i class="fa fa-circle-o"></i> Kategori dan Merk</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="{{ url('manage/toko') }}">
            <i class="fa fa-cart-plus"></i>
            <span>Toko</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i>
            <span>Karyawan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('manage/karyawan') }}"><i class="fa fa-circle-o"></i> Karyawan</a></li>
            <li><a href="{{ url('manage/gaji') }}"><i class="fa fa-circle-o"></i> Gaji</a></li>
            <li><a href="{{ url('manage/hutang') }}"><i class="fa fa-circle-o"></i> Hutang</a></li>
            <li><a href="{{ url('manage/presensi') }}"><i class="fa fa-circle-o"></i> Presensi</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="{{ url('manage/transaksi') }}">
            <i class="fa fa-money"></i>
            <span>Transaksi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="{{ url('manage/kontak') }}">
            <i class="fa fa-address-book-o "></i>
            <span>Kontak Penjual</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>