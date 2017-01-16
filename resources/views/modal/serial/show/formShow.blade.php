<style type="text/css">
  fieldset.scheduler-border {
    border: 1px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
}

    legend.scheduler-border {
        font-size: 1.2em !important;
        font-weight: bold !important;
        text-align: left !important;
        width:auto;
        padding:0 10px;
        border-bottom:none;
    }
</style>

<fieldset class="scheduler-border">
    <legend class="scheduler-border">Tambah Serial</legend>
    <div class="control-group">
      {!! Form::open(['url' => 'shoppingCart', 'method' => 'post', 'name' =>'addserialform']) !!}
        <div class="col-md-4" style="padding: 5px;">
          <div class="form-group">
              {!! Form::label('serial', 'Serial') !!}
              {!! Form::text('serial', '', [
                  'class'       => 'form-control',
                  'placeholder' => 'Serial',
                  (isset($disabled) ? 'disabled' : ''),
              ]) !!}
          </div>
        </div>
        <div class="col-md-4" style="padding: 5px;">
          <div class="form-group">
              {!! Form::label('stok', 'Stok') !!}
              {!! Form::text('jumlah', '', [
                  'class'       => 'form-control',
                  'placeholder' => 'Stok',
                  (isset($disabled) ? 'disabled' : ''),
              ]) !!}
          </div>
        </div>
        <div class="col-md-4" style="padding: 5px;">
          <div class="form-group">
              <br>
              <a id="btn-save-serial" class="btn btn-success" style="margin-top: 5px;"><i class="fa fa-plus"></i> Tambah</a>
          </div>
        </div>
    </div>
</fieldset>


<table id="table-serial" class="table-inventori table table-bordered table-hover table-striped">
  <thead>
      <tr>
        <th>Serial kode</th>
        <th>Stok</th>
        <th>Action</th>
      </tr>
  </thead>
  <tfoot>
    <tr>
      <th></th>
      <th></th>
      <th></th>
    </tr>
  </tfoot>
</table>

<script type="text/javascript">
  $("#btn-save-serial").click(function(e){   

    var data = new FormData(document.forms.namedItem("addserialform"));    
    var id = "{{ $id }}";
    data.append('id', id);
      $.ajax({
        url         : 'inventori/serial/add',                                                       
        type        : 'post',
        data        : data,
        contentType : false,
        processData : false,
        error : function(response)
        {
            alert('Terjadi kesalahan \nSolusi: \n1) Pastikan semua kolom terisi. \n2) Muat ulang laman web.');
        },
        success : function(response)
        {
            $('.form-control').val('');         
            $('#table-serial').DataTable().ajax.reload();  
        }
      });      
    e.preventDefault();                                
  });

  $(document).ready(function() {
      var elementTable = $('#table-serial');

      var options = {
          'columnDefs': [
              {
                  'className' : 'text-center text-nowrap',
                  'targets'   : [0, 2]
              },
          ],
          'processing' : true,
          'serverSide' : true,
          'ajax'       : 'inventori/serial/table/{{ $id }}',
          'columns'    : [
              { 'data': 'serial', 'name': 'serial.serial' },
              { 'data': 'jumlah', 'name': 'serial.jumlah' },
              { 'data': 'Action', 'name': 'Action', 'orderable': false, 'searchable': false },
          ],
          initComplete: function () {
              this.api().columns().every(function () {
                  var column = this;
                  var input = document.createElement("input");
                  $(input).appendTo($(column.footer()).empty())
                  .on('change', function () {
                      column.search($(this).val()).draw();
                  });
              });
          }
      };

      /**
       * Trigger data table & setup modal ajax
       */
      setDataTable(elementTable, options);

      elementTable.on('draw.dt', function () {
          elementTable.find('[data-toggle=tooltip]').tooltip();

          setupModal();
      });
  });

  function ubahSerial(data){
            var btnId = data.id;
            var splitId = btnId.split("-");

            var jumlah = $("#jumlah-"+splitId[1]).val();
            var serial = $("#serial-"+splitId[1]).val();


            $.ajax({
                type: "post",
                url: "inventori/serial/edit",
                data: "id="+splitId[1]+"&jumlah="+jumlah+"&serial="+serial,
                cache: false,
                beforeSend: function (xhr) {
                    var token = $("meta[name='csrf_token']").attr("content");

                    if (token) {
                         return xhr.setRequestHeader("X-CSRF-TOKEN", token);
                    }
                },
                error : function(response)
                {                                    
                    var error = response.responseJSON;
                    var errorHtml = "";
                    var n = 1;
                    $.each(error, function(key, value){
                        errorHtml += n + ") " + value[0] + "\n";
                        n++;
                    });

                    alert(errorHtml);


                },
                success : function(response)
                {
                    
                    
                        alert(response);    
                        $('#table-serial').DataTable().ajax.reload();     
                       
                             
                }
            });
        }  

          function hapusSerial(data){
            var btnId = data.id;
            var splitId = btnId.split("-");



            $.ajax({
                type: "post",
                url: "inventori/serial/delete",
                data: "id="+splitId[1],
                cache: false,
                beforeSend: function (xhr) {
                    var token = $("meta[name='csrf_token']").attr("content");

                    if (token) {
                         return xhr.setRequestHeader("X-CSRF-TOKEN", token);
                    }
                },
                error : function(response)
                {                                    
                    var error = response.responseJSON;
                    var errorHtml = "";
                    var n = 1;
                    $.each(error, function(key, value){
                        errorHtml += n + ") " + value[0] + "\n";
                        n++;
                    });

                    alert(errorHtml);


                },
                success : function(response)
                {
                    
                    
                        alert(response);    
                        $('#table-serial').DataTable().ajax.reload();     
                       
                             
                }
            });
        } 
</script>