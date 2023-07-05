@extends('gentelella.layouts.app')

@section('content')

<div class="x_panel modal-content">
    <div class="x_title">
       <h2>Usuários</h2>
       <ul class="nav navbar-right panel_toolbox">
          <a href="{{url('user/create')}}" class="btn-circulo btn  btn-success btn-md  pull-right " data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Novo Usuário"> Novo Usuário </a>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_panel">
       <div class="x_content">
         <table id="tb_user" class="table table-hover table-striped compact" style="width: 100%;">
            <thead>
               <tr>
                  <th>Nome do Usuário</th>
                  <th>E-mail</th>
                  <th>Acesso ADM Panel</th>
                  <th>Ações</th>
               </tr>
            </thead>   
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{$user->nome}}</td>
                        <td>{{$user->email}}</td>
                        <td> @if($user->admpanel == 0)
                           <a
                           id="btn_send"                     
                           class="btn btn-success btn-xs action botao_acao btn_send" 
                           href="{{route('liberar', $user->id)}}"
                           title="Enviar">  
                           <i class=" ">Liberar Acesso</i>
                        </a>
                            
                         @elseif($user->id == Auth::User()->id)                      
                       
                         <p style="color: #ff0000; text-align: left;">‎‎ ‎ ‎Seu Usuário</p>
                            
                        @else
                        <a
                        id="btn_send"                     
                        class="btn btn-danger btn-xs action botao_acao btn_send" 
                        href="{{route('proibir', $user->id)}}"
                        title="Enviar">  
                        <i class=" ">Retirar Acesso</i>
                     </a>
         
                     @endif 
                   </td>
                        <td> <a
                           id="btn_exclui_funcionario"
                           class="btn btn-danger btn-xs action botao_acao btn_excluir"
                           data-toggle="tooltip" 
                           data-funcionario = {{$user->id}}
                           data-placement="bottom" 
                           title="Excluir Funcionario"> 
                           <i class="glyphicon glyphicon-remove "></i>
                        </a> </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
       </div>
    </div>
 </div>

@endsection

@push('scripts')

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script> 
$(document).ready(function(){
      var tb_user = $("#tb_user").DataTable({
         language: {
               'url' : '{{ asset('js/portugues.json') }}',
         "decimal": ",",
         "thousands": "."
         },
         stateSave: true,
         stateDuration: -1,
         responsive: true,
      })
   });



   $("table#tb_user").on("click", "#btn_exclui_funcionario",function(){
			
         let valor = $(this).data('valor');
         let btn = $(this);
         
         if( valor == 'desabilitado' )
         { 
            console.log('entrou')
            event.preventDefault();
            funcoes.notificationRight("top", "right", "danger", "Esse usuário não tem permissão para executar essa Ação!");
            return
         }else{
            let id = $(this).data('funcionario');
				// console.log(id);
				let btn = $(this);
				swal({
					title: "Atenção!",
					text: "Excluir permanentemente um Funcionário",
					icon: "warning",
					buttons: {
							cancel: {
								text: "Cancelar",
								value: "cancelar",
								visible: true,
								closeModal: true,
							},
							ok: {
								text: "Sim, Confirmar!",
								value: 'excluir',
								visible: true,
								closeModal: true,
							}
					}
				}).then(function(resultado) {
					if (resultado === 'excluir') {
							$.post("{{ url('/user/') }}/" + id, {
								id: id,
								_method: "DELETE",
								_token: "{{ csrf_token() }}",
							}).done(function() {
								location.reload();
							});
					}
				});
         }
      });
</script>
@endpush