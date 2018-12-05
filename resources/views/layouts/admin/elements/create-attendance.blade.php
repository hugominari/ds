<div class="modal fade" id="makeAttendance" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-full-height modal-right modal-notify modal-info hidden" role="document">
		<div class="modal-content">
			{!! Form::open(['route' => 'attendance.store', 'method' => 'POST', 'class' => 'ajax-form']) !!}
				<div class="modal-header">
					<p class="heading lead">Registrar Atendimento</p>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true" class="white-text">×</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="text-center">
						<i class="fas fa-headset fa-4x mb-3 animated rotateIn"></i>
						<p>
							<strong>Preencha os dados</strong>
						</p>
					</div>
					<hr>
					{{ Form::cText('name', '', 'Nome do cliente') }}
					{{ Form::cText('cpf', '', 'CPF', ['class' => 'form-control cpf']) }}
					<div class="row">
						<div class="col-md-12">
							{{ Form::cSelect('type_call_id', '', 'Tipo de Atendimento', $typeAttendances) }}
						</div>
					</div>
					{{ Form::cDateInline('date', '', 'Data do atendimento') }}
					{{ Form::cTextarea('description', '', 'Descrição', ['rows' => 2]) }}
				</div>
				<div class="modal-footer justify-content-center">
					<a type="button" class="btn btn-primary waves-effect waves-light js-submit">Salvar
						<i class="fa fa-paper-plane ml-1"></i>
					</a>
					<a type="button" class="btn btn-outline-primary waves-effect" data-dismiss="modal">Cancelar</a>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>