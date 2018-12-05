<form id="form-filter" action="{{ $route }}" method="post">
	<div class="box box-primary collapsed-box">
		<div class="box-header padding-0 margin-0 no-border">
			<h3 class="box-title">
				<i class="material-icons pull-left m-r-10">filter_list</i>
				Filtro <b>Avançado</b>
			</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-white bg-box-tools m-t--7 m-r--10" data-widget="collapse">
					<i class="fa fa-plus"></i>
					<div class="ripple-container"></div>
				</button>
			</div>
		</div>
		<div class="box-body js-filter-box">
			<div class="row line">
				<div class="col-md-3">
					<div class="form-group is-empty">
						<select name="column[]" data-name="column" class="form-control js-select">
							<option></option>
							@foreach($filterValues as $filterValue)
								<option
										value="{{$filterValue['column']}}"
										data-type="{{$filterValue['type']}}"
										@if(isset($filterValue['options']))data-values="{{ json_encode($filterValue['options']) }}" @endif
										@if(isset($filterValue['typeSelect']))data-relation="{{ $filterValue['typeSelect'] }}" @endif
										@if(isset($filterValue['fk_column']))data-fkcolumn="{{ $filterValue['fk_column'] }}" @endif
										@if(isset($filterValue['fk_table']))data-fktable="{{ $filterValue['fk_table'] }}" @endif
								>
									{{$filterValue['label']}}
								</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group is-empty">
						<select name="operator[]" data-name="operator"  class="form-control js-select">
							<option></option>
							<option value="{{ \App\Constants::FILTER_EQUAL }}">Igual a</option>
							<option value="{{ \App\Constants::FILTER_CONTAINS }}">Contém</option>
							<option value="{{ \App\Constants::FILTER_NOT_EQUAL }}">Diferente de</option>
							<option value="{{ \App\Constants::FILTER_START_WITH }}">Começa com</option>
							<option value="{{ \App\Constants::FILTER_END_WITH }}">Termina com</option>
							<option value="{{ \App\Constants::FILTER_GREATER_THAN }}">Maior que</option>
							<option value="{{ \App\Constants::FILTER_GREATER_OR_EQUAL }}">Maior ou igual que</option>
							<option value="{{ \App\Constants::FILTER_LESS_THAN }}">Menor que</option>
							<option value="{{ \App\Constants::FILTER_LESS_OR_EQUAL }}">Menor ou igual que</option>
							<option value="{{ \App\Constants::FILTER_DATE_GREATER_THAN }}">A partir de (data)</option>
							<option value="{{ \App\Constants::FILTER_DATE_LESS_THAN }}">Até (data)</option>
						</select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group is-empty fix-select">
						<input type="text" name="value[]" data-name="value" placeholder="Valor" class="form-control">
					</div>
				</div>
				<div class="col-md-3">
					<div class="row">
						<div class="col-xs-9">
							<div class="form-group is-empty">
								<select name="plus[]" data-name="plus" class="form-group js-select">
									<option value="and">E</option>
									<option value="or">OU</option>
								</select>
							</div>
						</div>
						<div class="col-xs-3">
							<button type="button" class="btn btn-default btn-sm js-add-filter p-r-10 p-l-10 m-t-35">
								<i class="fa fa-plus"></i>
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="box-footer padding-0 m-b--15">
			<div class="row bg-gray-light">
				<div class="col-md-12">
					<button class="btn btn-info js-filter btn-raised pull-right" type="button">Filtrar</button>
					<button class="btn btn-default pull-right clear-filter m-r-10" type="reset">LIMPAR</button>
				</div>
			</div>
		</div>
	</div>
</form>
