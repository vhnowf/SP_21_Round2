@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.feedback.title') }}
    </div>
    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.feedbacks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.feedback.fields.id') }}
                        </th>
                        <td>
                            {{ $feedback->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.feedback.fields.email') }}
                        </th>
                        <td>
                            {{ $feedback->email ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.feedback.fields.subject') }}
                        </th>
                        <td>
                            {{ $feedback->subject }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.feedback.fields.content') }}
                        </th>
                        <td>
                            {{ $feedback->content }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.feedback.fields.created_at') }}
                        </th>
                        <td>
                            {{ $feedback->created_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.feedbacks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection