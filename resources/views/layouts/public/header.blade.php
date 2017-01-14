<style>
/*.container-fluid{
  background: #66e0ff;
}*/
.brand-image {                
  position: absolute;
  left: 0px;
  top: 0px;       
  margin-left: 0px;
  padding: 6px;
}
.app-title{
  position: absolute;
  padding-top: 17px;
  font-size: 12px;
  margin : 0 auto;

}
</style>

<header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="{{ url('/') }}">
            <img class="brand-image" alt="Brand" src="{{ asset('assets/img/logo-metro.png') }}" width="160">
              <div class="app-title"><b>Metro</b>Elektronik</div>
          </a>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>