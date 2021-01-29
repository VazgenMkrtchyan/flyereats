@extends('helpers.installation-wizard.layout-wizard')

@section('meta-title', trans('installation.title_installed'))

@section('content')

    <h1><i class="fa fa-battery-full"></i> {{ trans('installation.script_installed') }}</h1>

    <div class="bs-callout bs-callout-success">
        {{ trans('installation.installed_info', ['admin_link' => route('admin.sessions.create')]) }}
    </div>

@stop