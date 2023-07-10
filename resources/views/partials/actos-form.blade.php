<div class="tab-pane show active" id="datos" role="tabpanel" aria-labelledby="datos-tab">
    <form action="{{ $action === 'insert' ? route('actos.insert') : route('actos.update') }}" method="POST" style="width: 450px;">
        @csrf
        <input type="hidden" id="Id_acto" name="Id_acto"/>
        <div class="form-group">
            <div class="row">
                <div class="col">
                    <label class="form-label" for="Fecha">Fecha&nbsp;<span class="required" title="Campo requerido">*</span></label>
                    <input class="form-control" type="date" placeholder="Fecha" id="Fecha" name="Fecha" required/>
                </div>
                <div class="col">
                    <label class="form-label" for="Hora">Hora&nbsp;<span class="required" title="Campo requerido">*</span></label>
                    <input class="form-control" type="time" placeholder="Hora" id="Hora" name="Hora" required/>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label" for="Titulo">Titulo&nbsp;<span class="required" title="Campo requerido">*</span></label>
            <input class="form-control" type="text" placeholder="Titulo del acto" id="Titulo" name="Titulo" maxlength="50" required/>
        </div>
        <div class="form-group">
            <label class="form-label" for="Descripcion_corta">Descripción corta&nbsp;<span class="required" title="Campo requerido">*</span></label>
            <textarea class="form-control" placeholder="Descripción corta" rows="3" id="Descripcion_corta" name="Descripcion_corta" required maxlength="200" resize="none"></textarea>
        </div>
        <div class="form-group">
            <label class="form-label" for="Descripcion_corta">Descripción larga&nbsp;<span class="required" title="Campo requerido">*</span></label>
            <textarea class="form-control" placeholder="Descripción larga" rows="6" id="Descripcion_larga" name="Descripcion_larga" required maxlength="1000"></textarea>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col">
                    <label class="form-label" for="Num_asistentes">Número de asistentes&nbsp;<span class="required" title="Campo requerido">*</span></label>
                    <input class="form-control" type="number" placeholder="Número de asistentes" id="Num_asistentes" name="Num_asistentes" maxlength="3" min="1" required/>
                </div>
                <div class="col">
                    <label class="form-label" for="Id_tipo_acto">Tipo de acto&nbsp;<span class="required" title="Campo requerido">*</span></label>
                    <select class="form-control" id="Id_tipo_acto" name="Id_tipo_acto" required>
                        <option value=""></option>
                        @foreach ($tiposActos as $reg)
                            <option value="{{ $reg['Id_tipo_acto'] }}">{{ $reg['Descripcion'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-primary" name="{{ $action }}">{{ $actionText }}</button>
        <button type="button" class="btn btn-danger" onclick="volver()">Volver</button>
    </form>
</div>

@php
    $estadoAccion = session('estadoAccion');
    if ($estadoAccion) {
        $class = '';
        $mensaje = '';
        if ($estadoAccion == 'ok') {
            $class = 'text-bg-success';
            $mensaje = 'Datos actualizados correctamente';
        } else if ($estadoAccion == 'ko') {
            $class = 'text-bg-danger';
            $mensaje = 'Error en la actualización de datos';
        }
        echo '<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                <div id="liveToast" class="toast '.$class.'" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">
                    <div class="toast-header">
                        <i class="fa '.($estadoAccion == 'ok' ? 'fa-check-circle' : 'fa-times-circle').'" aria-hidden="true"></i>&nbsp;<strong class="me-auto">'.$mensaje.'</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        '.($estadoAccion == 'ok' ? 'Los datos se han actualizado correctamente en la base de datos.' : 'Los datos no se han podido actualizar en la base de datos.').'
                    </div>
                </div>
            </div>';
        echo '<script>
                var myToast = document.getElementById("liveToast");
                var bsToast = new bootstrap.Toast(myToast);
                bsToast.show();
                setTimeout(function() {
                    bsToast.hide();
                }, 5000);
                </script>';
        session()->forget('estadoAccion');
    }
@endphp


<script>
    function volver() {
        window.location.href = "actos";
    }
</script>
