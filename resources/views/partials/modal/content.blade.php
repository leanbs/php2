<div class="modal-dialog modal-{{ $modalSize }}" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                    <i class="fa fa-times"></i>
                </span>
            </button>
            <h4 class="modal-title" id="myModalLabel">{{ $modalTitle }}</h4>
        </div><!-- /.modal-header -->

        <div class="modal-body">
            <div id="modal-alert-fail" class="alert alert-danger alert-dismissable" hidden role="alert">
            </div>

            <div id="modal-alert-success" class="alert alert-success alert-dismissable" hidden role="alert">
            </div>

            @yield('content')
        </div><!-- /.modal-body -->

        <div id="modal-progress" class="modal-footer" hidden>
            <div class="text-center">
                <i class="fa fa-spinner fa-spin fa-lg"></i>
            </div>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
