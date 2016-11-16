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
                    
                    <div class="form-group has-feedback">
                    <label for="modulename" class="col-sm-2 control-label">Module Name</label>
                    <div class="col-sm-6">
                    <input type="text" name="modulename" id="modulename" class="form-control">
                    <span class="fa fa-asterisk text-red form-control-feedback"></span>
                    </div>
                    </div>
                    <div class="form-group">
                    <label for="moduleremark" class="col-sm-2 control-label">Module Remark</label>
                    <div class="col-sm-8">
                    <textarea class="form-control" name="moduleremark" id="moduleremark" cols="30" rows="5"></textarea>
                    </div>
                    </div>
                    <div class="form-group has-feedback">
                    <label for="moduleurl" class="col-sm-2 control-label">Module Url</label>
                    <div class="col-sm-6">
                    <input type="text" name="moduleurl" id="moduleurl" class="form-control">
                    <span class="fa fa-asterisk text-red form-control-feedback"></span>
                    </div>
                    </div>   
                    <div class="form-group has-feedback">
                    <label for="moduleparent" class="col-sm-2 control-label">Module Parent</label>
                    <div class="col-sm-6">
                    <select name="moduleparent" id="moduleparent" class="form-control">
                        <option value="">1</option>
                        <option value="">2</option>
                        <option value="">3</option>
                        <option value="">4</option>
                        <option value="">5</option>
                    </select>
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
