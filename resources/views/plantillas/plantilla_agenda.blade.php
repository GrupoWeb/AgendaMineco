<div class=" container sobre">
    <div class="col-md-12 col-lg-12 col-12 col-sm-12 col-xl-12">
        <div class="card border-shadow">
            <div class="card-header bg-info">Agendar Nuevo Evento</div>
            <div class="card-body">
                {!! Form::open(['id'=>'form_eventos', 'method'=>'POST' , 'onsubmit' => 'event.preventDefault(); return false', 'autocomplete'=>'off']) !!}
                <div class="modal-body">   
                    <div class="form-group">
                        {!! Form::label('Accion_id','Acción:') !!}<span class="text-danger ml-1">*</span>
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
                        <data-component></data-component> 
                    </div>
                    <div class="form-group">
                        <label for="Dobservaciones">Observaciones:</label>
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
</div> 