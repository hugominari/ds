@extends('layouts.admin.default')

@push('styles')
    {{ Html::style('plugins/datatables/DataTables-1.10.18/css/jquery.dataTables.min.css') }}
@endpush

@push('scripts')
    {!! Html::script('plugins/datatables/DataTables-1.10.18/js/jquery.dataTables.min.js') !!}
    {!! Html::script('js/pages/basic.min.js') !!}
@endpush

@section('content')
    <section class="content-header">
        <div class="row m-b-10">
            <div class="col-md-8">
                <h1><i class="fas fa-rss-square"></i> Feeds de Notícias</h1>
            </div>
            <div class="col-md-4">
                <a href="{{ route('dashboard') }}" class="display-inline-block pull-right m-t-11">
                    <button class="btn btn-white"><i class="fa fa-arrow-circle-left m-r-5"></i> Voltar</button>
                </a>
            </div>
        </div>
    </section>
   
    <section class="content">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
                {!! Form::open(['route' => 'basic.create', 'method' => 'POST', 'class' => 'ajax-form']) !!}
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                Cadastro de Feed
                            </div>
                            <div class="card-body">
                                {{ Form::cText('name', '', 'Nome do Feed') }}
                                {{ Form::cText('url', '', 'Site') }}
                            </div>
                            <div class="card-footer d-none">
                                {{ Form::cText('id', '', '', ['class' => 'hide']) }}
                                {{ Form::cText('model', 'feeds', '', ['class' => 'hide']) }}
                            </div>
                        </div>
                    </div>
                </div>
                @component('components.fixed-actions')@endcomponent
                {!! Form::close() !!}
            </div>
            <div class="col-lg-7 col-md-7 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="box-title text-capitalize">Listagem</h3>
                    </div>
                    <div class="card-body">
                        <table class="dataTable no-footer w-r-100" data-source="{!! route('basic.list', 'feeds') !!}" data-type="datatables">
                            <thead>
                                <tr>
                                    <th data-slug="name" class="sort default-sort">Nome</th>
                                    <th data-slug="url" class="sort">Site</th>
                                    <th data-slug="action" class="no-sort">Ações</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection