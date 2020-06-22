@extends('layouts.app', ['title' => __('User Management')])

@section('content')
    @include('users.partials.header', ['title' => __('Alta de Cheque')])

    {{-- agregado --}}
    <div id="app2">
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Cheque Para: ' . $provider->nombre) }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('providers.index') }}" class="btn btn-sm btn-primary">{{ __('Volver a la Lista') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('checks.store') }}" autocomplete="off" class="formulario">
                            @csrf

                            <input type="text" value="{{ $provider->id }}" name="provider_id" hidden>
                            <h6 class="heading-small text-muted mb-4">{{ __('Información del Cheque') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('numeroCheque') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-nombre">{{ __('Número del Cheque') }}</label>
                                    <input type="text" name="numeroCheque" id="input-numeroCheque" class="form-control form-control-alternative{{ $errors->has('numeroCheque') ? ' is-invalid' : '' }}" placeholder="{{ __('Número del Cheque') }}" value="{{ old('numeroCheque') }}" required autofocus>

                                    @if ($errors->has('numeroCheque'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('numeroCheque') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('monto') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-cuit">{{ __('Monto en Pesos') }}</label>
                                    <input type="number" name="monto" id="input-monto" class="form-control form-control-alternative{{ $errors->has('monto') ? ' is-invalid' : '' }}" placeholder="{{ __('Monto en Pesos') }}" value="{{ old('monto') }}" required autofocus>

                                    @if ($errors->has('monto'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('monto') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('destinatario') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-domicilio">{{ __('Destinado a') }}</label>
                                    <input type="text" name="destinatario" id="input-destinatario" class="form-control form-control-alternative{{ $errors->has('destinatario') ? ' is-invalid' : '' }}" placeholder="{{ __('Destinado a') }}" value="{{ old('destinatario') }}" required>

                                    @if ($errors->has('destinatario'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('destinatario') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('fecha') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-email">{{ __('Fecha') }}</label>
                                    <input type="date" name="fecha" id="input-fecha" class="form-control form-control-alternative{{ $errors->has('fecha') ? ' is-invalid' : '' }}" placeholder="{{ __('Fecha') }}" value="{{ old('fecha') }}" required>

                                    @if ($errors->has('fecha'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('fecha') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                {{-- <div class="form-group{{ $errors->has('numeroFactura') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-domicilio">{{ __('Factura N°') }}</label>
                                    <input type="text" name="numeroFactura" id="input-numeroFactura" class="form-control form-control-alternative{{ $errors->has('numeroFactura') ? ' is-invalid' : '' }}" placeholder="{{ __('Factura N°') }}" value="{{ old('numeroFactura') }}" required>

                                    @if ($errors->has('numeroFactura'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('numeroFactura') }}</strong>
                                        </span>
                                    @endif
                                </div> --}}

                                {{-- agregado --}}


                                        <div class="form-group{{ $errors->has('numeroFactura') ? ' has-danger' : '' }}" v-for="(input,k) in inputs" :key="k">
                                            <div class="form-row">
                                                <div class="col">


                                                    <label class="form-control-label" for="input-email">{{ __('N° de Factura') }}</label>
                                                    <input id="numFactura" type="text" class=" form-control form-control-alternative{{ $errors->has('numeroFactura') ? ' is-invalid' : '' }}"
                                                            v-model="input.name" name="numeroFactura[]" placeholder="{{ __('N° Factura') }}" value="{{ old('numeroFactura') }}" required>
                                                    <span>
                                                        <i class="fas fa-minus-circle text-danger" @click="remove(k)" v-show="k || ( !k && inputs.length > 1)"></i>
                                                        <i class="fas fa-plus-circle text-success" @click="add(k)" v-show="k == inputs.length-1"></i>
                                                    </span>

                                                    @if ($errors->has('numeroFactura'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('numeroFactura') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>

                                                <div class="col">
                                                    <label class="form-control-label" for="input-monto">{{ __('Monto $') }}</label>
                                                    <input type="text" class="monto form-input form-control form-control-alternative{{ $errors->has('montoFactura') ? ' is-invalid' : '' }}"  name="montoFactura[]" placeholder="{{ __('Monto $') }}" value="{{ old('montoFactura') }}" required  onkeyup="sumar();">

                                                    @if ($errors->has('montoFactura'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('montoFactura') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <span>El resultado es: </span> <span id="spTotal"></span>





                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Guardar') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    {{-- agregado --}}
    </div>

        @include('layouts.footers.auth')
    </div>
    {{-- @push('main')
        <script>
            const formulario = document.querySelector('.formulario');
            formulario.addEventListener('submit',function(e){
                e.preventDefault();
                 const inputs = formulario.querySelectorAll('.form-input [value=""]')
                 const val = inputs.values
                console.log(val)
            })

            const array1 = [1, 2, 3, 4];

        </script>
    @endpush --}}

    <script>
        /* Sumar dos números. */
        function sumar() {

            var total = 0;

            $(".monto").each(function() {

            if (isNaN(parseFloat($(this).val()))) {

                total += 0;

            } else {

                total += parseFloat($(this).val());

            }

            });

            //alert(total);
            document.getElementById('spTotal').innerHTML = total;

            }
    </script>

@endsection
