@extends('common')
@section('content')
<div class='row'>
    <div class='col-md-8 col-md-offset-2'>
        <!-- Box -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Add a new module</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <form action="{{ url('/manage/addmodule') }}" method="post" class="form-horizontal">
                <div class="box-body">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    @if (count($errors) > 0)
                    <span class="text-danger">
                        <strong>{{ $errors->first() }}</strong>
                    </span>
                    @endif
                    
                    <div class="form-group">
                        <label for="modulename" class="col-sm-2 control-label">Module Name<sup>*</sup></label>
                        <div class="col-sm-6">
                            <input type="text" name="modulename" id="modulename" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="moduleroute" class="col-sm-2 control-label">Module Route<sup>*</sup></label>
                        <div class="col-sm-6">
                            <input type="text" name="moduleroute" id="moduleroute" class="form-control">
                        </div>
                    </div>   
                    <div class="form-group">
                        <label for="assigngroup" class="col-sm-2 control-label">Assign Group<sup>*</sup></label>
                        <div class="col-sm-6">
                            <select name="assigngroup" id="assigngroup" class="form-control">
                                @foreach ( $groups as $k => $v )
                                <option value="{{ $v->id }}">{{ $v->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="quicklink" class="col-sm-2 control-label">Quick Link</label>
                        <div class="checkbox">
                    <label>
                    <input type="checkbox" name="quicklink" id="quicklink">
                  </label>
                  </div>
                    </div>
                    
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <button class="btn bg-purple btn-flat pull-right" type="submit">Submit</button>
                    <button class="btn btn-default btn-flat" type="reset">Cancel</button>
                </div><!-- /.box-footer-->
            </form>
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection
