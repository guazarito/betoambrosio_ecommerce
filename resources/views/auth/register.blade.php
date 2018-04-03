@extends('layout')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="{{asset('js/cep.js')}}"></script>


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
             <h1 id="cadastro_title">Cadastro</h1>
            <div class="panel panel-default">
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        
                        @if (sizeof($errors)>0)
                        <style>
                            #cep-auto-inputs{
                                display: block;
                            }
                        </style>
                        @endif
                           
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nome completo</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Ex: José da Silva" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

			<div class="form-group{{ $errors->has('celular') ? ' has-error' : '' }}">
                            <label for="celular" class="col-md-4 control-label">Celular</label>

                            <div class="col-md-6">
                                <input id="celular" type="text" class="form-control" name="celular" value="{{ old('celular') }}" placeholder="Ex: (16)99999-0000" required autofocus>

                                @if ($errors->has('celular'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('celular') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Ex: jose@email.com.br" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <br>
                        <div id="endereco_envio">
                            <div class="form-group{{ $errors->has('cep') ? ' has-error' : '' }}">
                                <label for="cep" class="col-md-4 control-label">CEP</label>

                                <div class="col-md-6">
                                    <input id="cep" type="text" class="form-control" name="cep" value="{{ old('cep') }}" placeholder="Ex: 13322-032" required autofocus>
                                        <span class="help-block-cep">
                                            <strong>CEP inválido!</strong>
                                        </span>
                                    @if ($errors->has('cep'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('cep') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>  
                            <div id="cep-auto-inputs">
                             <div class="form-group{{ $errors->has('estado') ? ' has-error' : '' }}">
                                <label for="estado" class="col-md-4 control-label">Estado</label>

                                <div class="col-md-6">
                                    <input id="estado" maxlength="2" type="text" class="form-control cep-auto" name="estado" value="{{ old('estado') }}" required autofocus>

                                    @if ($errors->has('estado'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('estado') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>  
 
                             <div class="form-group{{ $errors->has('cidade') ? ' has-error' : '' }}">
                                <label for="cidade" class="col-md-4 control-label">Cidade</label>

                                <div class="col-md-6">
                                    <input id="cidade" type="text" class="form-control cep-auto" name="cidade" value="{{ old('cidade') }}" required autofocus>

                                    @if ($errors->has('cidade'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('cidade') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>  
 
                             <div class="form-group{{ $errors->has('bairro') ? ' has-error' : '' }}">
                                <label for="bairro" class="col-md-4 control-label">Bairro</label>

                                <div class="col-md-6">
                                    <input id="bairro" type="text" class="form-control cep-auto" name="bairro" value="{{ old('bairro') }}" required autofocus>

                                    @if ($errors->has('bairro'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('bairro') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>                            
 
                             <div class="form-group{{ $errors->has('rua') ? ' has-error' : '' }}">
                                <label for="rua" class="col-md-4 control-label">Rua/Av</label>

                                <div class="col-md-6">
                                    <input id="rua" type="text" class="form-control cep-auto" name="rua" value="{{ old('rua') }}" required autofocus>

                                    @if ($errors->has('endereco'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('rua') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>                                 
   
                             <div class="form-group{{ $errors->has('numero') ? ' has-error' : '' }}">
                                <label for="numero" class="col-md-4 control-label">Número</label>

                                <div class="col-md-6">
                                    <input id="numero" type="text" class="form-control" name="numero" value="{{ old('numero') }}" placeholder="Ex: 1234" required autofocus>

                                    @if ($errors->has('numero'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('numero') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>    

                             <div class="form-group{{ $errors->has('complemento') ? ' has-error' : '' }}">
                                <label for="complemento" class="col-md-4 control-label">Complemento</label>

                                <div class="col-md-6">
                                    <input id="complemento" type="text" class="form-control" name="complemento" value="{{ old('complemento') }}" placeholder="Ex: Apto 103" >

                                    @if ($errors->has('complemento'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('complemento') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>   
                                
                            </div> <!-- cep-auto-inputs-->   
                        </div>
                        <br>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Senha</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" placeholder="******" required autofocus>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirmação Senha</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="******" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-warning">
                                    Cadastrar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
