@extends('layouts.master') 
@section('content')
  <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Agendar Eventos</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="home">Home</a></li>
                  <li class="breadcrumb-item active">Eventos</li>
                </ol>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </div>
      
          <div class="container">
                <div class="card ">
                    <div class="card-header bg-info">Agendar Nuevo Evento</div>
                    <div class="card-body">
                            {!! Form::open(['id'=>'form_contratos', 'method'=>'POST' , 'onsubmit' => 'event.preventDefault(); return false', 'autocomplete'=>'off']) !!}
                                        <div class="modal-body">
                                            <h5><strong>Partida presupuestaria número 1</strong></h5>
                                            <div class="form-group">
                                                {!! Form::label('financiamiento_id','Fuente de financiamiento') !!}<span class="text-danger ml-1">*</span>
                                                {!! Form::select('financiamiento_id', DB::table('financiamientos')->pluck('financiamiento','id'), null, ['class' => 'form-control', 'placeholder' => '', 'required']) !!}
                                            </div>
                                            <div class="form-group">
                                                <label for="partida_presupuestaria">Partida presupuestaria número 1</label><span class="text-danger ml-1">*</span>
                                                <input type="text" id="partida_presupuestaria" name="partida_presupuestaria" class="form-control" required>
                                            </div>
                                            <br>
                                            <h5><strong>Partida presupuestaria número 2 (Opcional)</strong></h5>
                                            <div class="form-group">
                                                {!! Form::label('financiamiento2_id','Fuente de financiamiento número 2 ') !!}
                                                {!! Form::select('financiamiento2_id', DB::table('financiamientos')->pluck('financiamiento','id'), null, ['class' => 'form-control', 'placeholder' => '']) !!}
                                            </div>
                                            <div class="form-group">
                                                <label for="partida_presupuestaria2">Partida presupuestaria número 2</label>
                                                <input type="text" id="partida_presupuestaria2" name="partida_presupuestaria2" class="form-control">
                                            </div>
                                            <input type="hidden" id="contratista_id" name="contratista_id" value="{{$contratista->id}}">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary" id="boton_editar_contrato"><i class="fa fa-save fa-lg mr-2"></i>Guardar información</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close fa-lg mr-2"></i>Cerrar</button>
                                        </div>
                            {!! Form::close() !!}
                    </div>
                </div>
          </div>
            
  </div>
@endsection
 
@section('javascript')
    <!-- jQuery -->
    <script src="{{ asset('/dist/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('/dist/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="{{ asset('/dist/plugins/morris/morris.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('/dist/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
    <!-- jvectormap -->
    <script src="{{ asset('/dist/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('/dist/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('/dist/plugins/knob/jquery.knob.js') }}"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="{{ asset('/dist/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- datepicker -->
    <script src="{{ asset('/dist/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="{{ asset('/dist/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
    <!-- Slimscroll -->
    <script src="{{ asset('/dist/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('/dist/plugins/fastclick/fastclick.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('/dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('/dist/js/pages/dashboard.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('/dist/js/demo.js') }}"></script>
@stop