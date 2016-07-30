@include('admin/_header')

    <div class="container">
        <div class="row">
        
            <div class="col-md-10 col-md-offset-1">
            
                <div class="panel panel-default">
                    <div class="panel-heading">
                    	Website infos
                    </div>
                    
                    <div class="panel-body">
                
        				{!! Form::model($website, ['url' => '/admin/website', 'id' => 'website_form', 'class' => 'form-horizontal', 'role' => 'form']) !!}
        				
                    		<input type="hidden" name="id" value="{{ $website->id }}">
            
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Name</label>
        
                                <div class="col-md-6">
                                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
        
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
            
                            <div class="form-group{{ $errors->has('host') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Host</label>
        
                                <div class="col-md-6">
        							{!! Form::text('host', null, ['class' => 'form-control']) !!}
        							
                                    @if ($errors->has('host'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('host') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
            
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">E-Mail Address</label>
        
                                <div class="col-md-6">
                                    {!! Form::text('email', null, ['class' => 'form-control']) !!}
        
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
            
                            <div class="form-group{{ $errors->has('active') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Active</label>
        
                                <div class="col-md-6">
                                	<div class="btn-group button-switch" data-toggle="buttons">
                                        <label class="btn btn-default" data-active-class="btn-success" data-inactive-class="btn-default">
                                        	{!!  Form::radio('active', 1, ['autocomplete' => 'off']); !!} Active
                                        </label>
                                        <label class="btn btn-default" data-active-class="btn-danger" data-inactive-class="btn-default">
                                        	{!!  Form::radio('active', 0, ['autocomplete' => 'off']); !!} Inactive
                                        </label>
            						</div>
        
                                    @if ($errors->has('active'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('active') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
            
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4 text-right">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-sign-in"></i>Submit
                                    </button>
                                </div>
                            </div>
        
                        {!! Form::close() !!}
                        
               		</div>
                
                </div>
            
                <div class="panel panel-danger hidden" id="delete_panel">
                    <div class="panel-heading">
                		<a data-toggle="collapse" href="#collapse_danger" class=" text-danger">
                        	Danger zone	
                    	</a>
                    </div>
                    <div id="collapse_danger" class="panel-collapse collapse">
                    	<div class="panel-body">
                    	
        					{!! Form::open(['url' => '/admin/website/delete', 'id' => 'delete_form', 'class' => 'form-horizontal', 'role' => 'form']) !!}
        				
                        		<input type="hidden" name="id" value="{{ $website->id }}">
                
                                <div class="form-group">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fa fa-btn fa-delete"></i>Delete website
                                        </button>
                                    </div>
                                </div>
        
                        	{!! Form::close() !!}
                        
                    	</div>
                    </div>
                </div>
            </div>
                
            </div>
        </div>
    </div>
    
	{!! Asset::container('jquery')->scripts() !!}
	{!! Asset::container('bootstrap')->scripts() !!}
	{!! Asset::container('button-switch')->scripts() !!}
	{!! Asset::container('ajax-form')->scripts() !!}
	
	<script type="text/javascript">
    	+function($){

			if ($('#website_form').find('input[name="id"]').val() === "") {
        		$('#delete_panel').hide();
			}
    		$('#delete_panel').removeClass('hidden');

    		$('.button-switch').buttonswitch();

    		$('#website_form').ajaxform({
        		locale: 'fr',
        		resetOnSuccess: false,
        		callback: function(callback_vars) {
        			$('#website_form, #delete_form').find('input[name="id"]').val(callback_vars.id);
        			$('#delete_panel').slideDown();
        		}
    		});

    		$('#delete_form').ajaxform({
        		locale: 'fr',
        		callback: function(callback_vars) {
					var redirect_url = '/admin';
					if (callback_vars !== 'undefined' && callback_vars.redirect_url !== 'undefined')
					{
						redirect_url = callback_vars.redirect_url;
					}
					setTimeout('window.location.replace("' + callback_vars.redirect_url + '")', 2000);
        		}
    		});

//     		function initPage() {
// 				if ($('#website_form').find('input[name="id"]').val() !== "") {
// 					$('#delete_panel').slideUp();
// 				}
//     		};
    		
    	}(jQuery);
	</script>
	
@include('admin/_footer')