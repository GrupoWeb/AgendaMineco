<div class="content-wrapper">
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"></h1>
          </div>
          <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="home">Home</a></li>
                <li class="breadcrumb-item active">Eventos</li>
              </ol>
          </div>
        </div>
      </div>
    </div>
    
      <editar-component></editar-component>  

    
    {{-- <div class="card-body">
      <div class="container">
            <div class="card border-shadow">
                <div class="card-header bg-info">Editar Evento</div>
                <div class="card-body">
                  {!! Form::open(['id'=>'form_eventos', 'method'=>'POST' , 'onsubmit' => 'event.preventDefault(); return false', 'autocomplete'=>'off']) !!}
                    <div class="modal-body">   
                        <div class="form-group">
                            {!! Form::label('Accion_id','Tema:') !!}<span class="text-danger ml-1">*</span>
                            <textarea-component></textarea-component> 
                        </div>
                        <div class="form-group">
                          {!! Form::label('resposable_id','Responsable:') !!}<span class="text-danger ml-1">*</span>
                          {!! Form::select('responsable_id', array(
                                '0' => 'Seleccione una Opción',
                                '1' => 'Ministro Acisclo Valladares', 
                                '2' => 'Lic. Rolando del Cid',
                                '3' => 'Viceministra Nora Torres',
                                '4' => 'otros'
                                )
                                  , '0', ['class' => 'form-control', 'placeholder' => '']) !!}
                        </div>
                        <br>
                        <div class="form-group">                                 
                           
                            
                        </div>
                        <div class="form-group">
                          <label for="Dobservaciones">Anotaciones:</label>
                          {!! Form::textarea('Dobservaciones',null,['class' => 'form-control','rows' => 4]) !!}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="btn_guardar"><i class="fa fa-save fa-lg mr-2"></i>Guardar información</button>
                    </div>
                  {!! Form::close() !!}

                </div>
            </div> 
      </div>           
    </div> --}}
    {{-- <div class="container-fluid col-11 col-lg-11 col-sm-11 col-xl-11">
        <table-componet ></table-componet>  
    </div>
    <br> --}}
           
</div>